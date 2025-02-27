$(document).ready(function () {

    select_assurance('#assurance');
    select_client_facturation('#client');

    $("#type").val("assurance").trigger("change");

    // Gestion du changement de sélection
    $("#type").on("change", function () {
        let selectedValue = $(this).val();

        if (selectedValue === "assurance") {
            $("#assurance").val(null).trigger("change");
            $("#div_assurance").show();
            $("#div_client").hide();
        } else if (selectedValue === "client") {
            $("#client").val(null).trigger("change");
            $("#div_assurance").hide();
            $("#div_client").show();
        }
    });

    $('#date1').on('change', function() {
        const date1 = $(this).val();
        
        if (date1) {
            $('#date2').val(date1);
            $('#date2').attr('min', date1);
        }
    });

    $('#date2').on('change', function() {
        const date2 = $(this).val();
        const date1 = $('#date1').val();

        if (date2 && date1 && new Date(date2) < new Date(date1)) {
            $(this).val(date1);
        }
    });

    $("#btn_search").on("click", list_facturation);

    function list_facturation () {

        let type = $('#type').val();
        let assurance = $('#assurance').val();
        let client = $('#client').val();
        let date1 = $('#date1').val();
        let date2 = $('#date2').val();

        if (type == 'assurance' && !assurance.trim()) {
            showAlert("Alert","Veuillez selectionner un assurance s'il vous plaît","warning");
            return false;
        }

        if (type == 'client' && !client.trim()) {
            showAlert("Alert","Veuillez selectionner un client s'il vous plaît","warning");
            return false;
        }

        if (!date1.trim() && !date2.trim()) {
            showAlert("Alert","Veuillez verifier les dates s'il vous plaît","warning");
            return false;
        }

        // Ajouter le préchargeur
        let preloader_ch = `
            <div id="preloader_ch">
                <div class="spinner_preloader_ch"></div>
            </div>
        `;
        $("body").append(preloader_ch);

        $.ajax({
            url: '/api/list_facturation',
            method: 'GET',
            data: {
                type: type,
                assurance: assurance || null,
                client: client || null,
                date1: date1,
                date2: date2,
            },
            dataType: 'json',
            success: function(data) {
                $("#preloader_ch").remove();

                const facture = data.data;
                const total = data.total;

                const table = $('.table_facturation');
                if ($.fn.DataTable.isDataTable(table)) {
                    table.DataTable().destroy();
                }

                table.find("tbody").empty();

                if (facture.length > 0) {

                    $.each(facture, function(index, item) {

                        const row = $(`
                            <tr>
                                <td class="nk-tb-col">
                                    <span class="tb-amount">${index + 1}</span>
                                </td>
                                <td class="nk-tb-col" >
                                    <span class="tb-amount">
                                        <span class="title">${item.client}</span>
                                    </span>
                                </td>
                                <td class="nk-tb-col" >
                                    <span class="tb-amount">
                                        <span class="title">${item.assurance}</span>
                                    </span>
                                </td>
                                <td class="nk-tb-col" >
                                    <span class="tb-amount">
                                        <span class="title">${item.societe}</span>
                                    </span>
                                </td>
                                <td class="nk-tb-col" >
                                    <span class="tb-amount">
                                        <span class="title">${item.matricule_assurance}</span>
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="badge text-success"> 
                                        ${item.partassurance ? item.partassurance.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') : '0'} Fcfa
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-amount" >
                                        ${formatDate(item.datefacture)}
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <ul class="nk-tb-actions gx-1">
                                        <li>
                                            <div class="drodown"><a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li>
                                                            <a  href="#"
                                                                class="text-primary btn-pdf"
                                                                data-code_vente="${item.code_vente}"
                                                                data-partassurance="${item.partassurance}"
                                                                data-matricule_assurance="${item.matricule_assurance}"
                                                                data-client="${item.client}"
                                                                data-societe="${item.societe}"
                                                                data-assurance="${item.assurance}"
                                                                data-numfacture="${item.numfacture}"
                                                                data-datefacture="${item.datefacture}"
                                                            >
                                                                <em class="icon ni ni-printer"></em>
                                                                <span>Facture</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        `);

                        table.find("tbody").append(row);

                        $('#total').text('Montant Total : '+total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')+' Fcfa');
                    });

                    initializeDataTable(".table_facturation", { responsive: { details: true } });
                } else {
                    initializeDataTable(".table_facturation", { responsive: { details: true } });

                    $('#total').text('Montant Total : 0 Fcfa');

                }
            },
            error: function() {
                $("#preloader_ch").remove();
                initializeDataTable(".table_facturation", { responsive: { details: true } });

                $('#total').text('Montant Total : 0 Fcfa');
            }
        });
        
    }

    $('.table_facturation').off('click', '.btn-pdf').on('click', '.btn-pdf', function () {

        const data = {
            code_vente: $(this).data('code_vente'),
            partassurance: $(this).data('partassurance'),
            matricule_assurance: $(this).data('matricule_assurance'),
            client: $(this).data('client'),
            societe: $(this).data('societe'),
            assurance: $(this).data('assurance'),
            numfacture: $(this).data('numfacture'),
            datefacture: $(this).data('datefacture')
        };



        PDF_Facturation(data);

    });


});