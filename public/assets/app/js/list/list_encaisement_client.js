$(document).ready(function () {

    window.list_facture_client = function () {

        let client = $('#client').val();

        // Ajouter le préchargeur
        let preloader_ch = `
            <div id="preloader_ch">
                <div class="spinner_preloader_ch"></div>
            </div>
        `;
        $("body").append(preloader_ch);

        $.ajax({
            url: '/api/list_facture_client/'+client,
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $("#preloader_ch").remove();

                const facture = data.data;
                const donne = data.donne;

                const table = $('.table_facture_client');
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
                                        <span class="title">${item.code}</span>
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="badge ${item.regle == 1 ? 'bg-success' : 'bg-danger'}"> 
                                        ${item.regle == 1 ? 'Soldé' : 'Non-soldé'}
                                    </span>

                                </td>
                                <td class="nk-tb-col">
                                    <span class="badge text-primary"> 
                                        ${item.total ? item.total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') : '0'} Fcfa
                                    </span>

                                </td>
                                <td class="nk-tb-col">
                                    <span class="badge text-warning"> 
                                        ${item.partassurance ? item.partassurance.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') : '0'} Fcfa
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="badge text-success"> 
                                        ${item.partclient ? item.partclient.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') : '0'} Fcfa
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-amount"> 
                                        ${item.taured ? item.taured.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') : '0'} %
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="badge text-danger"> 
                                        ${item.reste ? item.reste.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') : '0'} Fcfa
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-amount" >
                                        ${formatDateHeure(item.date)}
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <ul class="nk-tb-actions gx-1">
                                        <li>
                                            <div class="drodown"><a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul class="link-list-opt no-bdr">
                                                        ${item.regle == null ? 
                                                        `<li>
                                                            <a  href="#"
                                                                class="toggle text-success btn-plus"
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#Versement"
                                                                data-code="${item.code}"
                                                                data-matricule="${item.matricule}"
                                                                data-reste="${item.reste}"
                                                            >
                                                                <em class="icon ni ni-plus-circle"></em>
                                                                <span>Effectuer un Versement</span>
                                                            </a>
                                                        </li>` : ``}
                                                        <li>
                                                            <a  href="#"
                                                                class="text-warning btn-pdf"
                                                                data-code="${item.code}"
                                                                data-matricule="${item.matricule}"
                                                            >
                                                                <em class="icon ni ni-printer"></em>
                                                                <span>Facture</span>
                                                            </a>
                                                        </li>
                                                        ${item.versement.length > 0 ? 
                                                        `<li>
                                                            <a  href="#"
                                                                class="text-primary btn-recu"
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#modalLarge" 
                                                                data-code="${item.code}"
                                                                data-matricule="${item.matricule}"
                                                                data-versement='${JSON.stringify(item.versement)}'
                                                            >
                                                                <em class="icon ni ni-list"></em>
                                                                <span>Recu Paiement</span>
                                                            </a>
                                                        </li>` : ``}
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        `);

                        table.find("tbody").append(row);

                        $('#total').text('Montant Total : '+donne['total'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')+' Fcfa');
                        $('#payer').text('Montant Payer : '+donne['payer'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')+' Fcfa');
                        $('#non_payer').text('Montant non-payer : '+donne['non_payer'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')+' Fcfa');
                    });

                    initializeDataTable(".table_facture_client", { responsive: { details: true } });
                } else {
                    initializeDataTable(".table_facture_client", { responsive: { details: true } });

                    $('#total').text('Montant Total : 0 Fcfa');
                    $('#payer').text('Montant Payer : 0 Fcfa');
                    $('#non_payer').text('Montant non-payer : 0 Fcfa');

                }
            },
            error: function() {
                $("#preloader_ch").remove();
                initializeDataTable(".table_facture_client", { responsive: { details: true } });

                $('#total').text('Montant Total : 0 Fcfa');
                $('#payer').text('Montant Payer : 0 Fcfa');
                $('#non_payer').text('Montant non-payer : 0 Fcfa');
            }
        });
        
    }

    $('.table_facture_client').off('click', '.btn-pdf').on('click', '.btn-pdf', function () {
        const code = $(this).data('code');
        const matricule = $(this).data('matricule');

        // Ajouter le préchargeur
        let preloader_ch = `
            <div id="preloader_ch">
                <div class="spinner_preloader_ch"></div>
            </div>
        `;
        $("body").append(preloader_ch);

        $.ajax({
            url: '/api/imp_fac_vente/'+code+'/'+matricule,
            method: 'GET',
            success: function(response) {
                $("#preloader_ch").remove();

                if (response.success) {

                    PDF_Facture_Vente(response.client, response.pres, response.produits,$('#agence').val());

                } else if (response.error) {

                    showAlert("Alert", "Echec de l'opération ", "error");
                    console.log(response.message);

                } else {

                    showAlert("Alert", "Une erreur est survenue ", "error");

                }

            },
            error: function() {
                $("#preloader_ch").remove();
                showAlert("Alert", "Une erreur est survenue ", "error");
            }
        });

    });

    $('.table_facture_client').on('click', '.btn-recu', function () {
        
        let code = $(this).data('code');
        let matricule = $(this).data('matricule');
        let versementData = $(this).data("versement");

        const div = $('#contenu_versement');
        div.empty();
        $.each(versementData, function(index, item) {

            let row = $(`
                <li>
                    <a href="#" data-id="${item.id}" class="btn btn-primary mb-2 btn_recu_vers">
                        <em class="icon ni ni-printer"></em>
                        <span>Versement ${index+1} (${item.montant.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')} Fcfa)</span>
                    </a>
                </li>
            `);
            div.append(row);
        })

        // Ajout d'un gestionnaire d'événements pour récupérer l'id du versement
        $('#contenu_versement').off('click', '.btn_recu_vers').on('click', '.btn_recu_vers', function () {
            let versementId = $(this).data('id');

            var modal = bootstrap.Modal.getInstance(document.getElementById('modalLarge'));
            modal.hide();

            // Ajouter le préchargeur
            let preloader_ch = `
                <div id="preloader_ch">
                    <div class="spinner_preloader_ch"></div>
                </div>
            `;
            $("body").append(preloader_ch);

            $.ajax({
                url: '/api/imp_fac_recu/'+code+'/'+matricule+'/'+versementId,
                method: 'GET',
                success: function(response) {
                    $("#preloader_ch").remove();

                    if (response.success) {

                        PDF_Recu_Paiement(response.facture, response.recu);

                    } else if (response.error) {

                        showAlert("Alert", "Echec de l'opération ", "error");
                        console.log(response.message);

                    } else {

                        showAlert("Alert", "Une erreur est survenue ", "error");

                    }

                },
                error: function() {
                    $("#preloader_ch").remove();
                    showAlert("Alert", "Une erreur est survenue ", "error");
                }
            });

        });

    });

    $('.table_facture_client').on('click', '.btn-plus', function () {
        const code = $(this).data('code');
        const matricule = $(this).data('matricule');
        const reste = $(this).data('reste');

        $('#input_code').val(code);
        $('#input_matricule').val(matricule);

        $('#montant_payer').val(reste.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
        $('#montant_verser').val(0);
        $('#montant_restant').val(0);
        $('#obs').val(null);
        $('#date_livraison').val(null);

    });

    $("#client").on("change", list_facture_client); 

});