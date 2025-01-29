$(document).ready(function () {

    window.list_proforma_all = function () {
        $.ajax({
            url: '/api/list_proforma_all',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                const proforma = data.data;

                // Détruire l'instance DataTable existante (si elle existe)
                const table = $('.table_proforma');
                if ($.fn.DataTable.isDataTable(table)) {
                    table.DataTable().destroy();
                }

                // Effacer le contenu du tableau
                table.find("tbody").empty();

                if (proforma.length > 0) {

                    // const table = $('.table_client');
                    // table.DataTable().destroy();

                    $.each(proforma, function(index, item) {

                        const row = $(`
                            <tr>
                                <td class="nk-tb-col">
                                    <span class="tb-amount">${index + 1}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-amount">${item.code}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-amount">
                                        ${item.nomclient}
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-amount">+225 ${item.contact}</span>
                                </td>
                                <td class="nk-tb-col" >
                                    <span class="tb-amount ${ item.valide == 1 ? `text-success` : `text-danger` }" >
                                        ${ item.valide == 1 ? `Oui` : `Non` }
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
                                                        <li>
                                                            <a  href="#"
                                                                class="text-primary btn-pdf"
                                                                data-code="${item.code}"
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

                        // $(`#detail-${item.matricule}`).on('click', function() {
                        //     console.log(item.nomprenom);
                        //     $('#m_nom').text(item.nomprenom);
                        // });

                        // $(`#delete-${item.id}`).on('click', function() {
                        //     $('#litIddelete').val(item.id);
                        // });
                    });

                    initializeDataTable(".table_proforma", { responsive: { details: true } });
                } else {
                    initializeDataTable(".table_proforma", { responsive: { details: true } });
                }
            },
            error: function() {
                initializeDataTable(".table_proforma", { responsive: { details: true } });
            }
        });

        $('.table_proforma').on('click', '.btn-pdf', function () {
            const code = $(this).data('code');

            // Ajouter le préchargeur
            let preloader_ch = `
                <div id="preloader_ch">
                    <div class="spinner_preloader_ch"></div>
                </div>
            `;
            $("body").append(preloader_ch);

            $.ajax({
                url: '/api/imp_fac_proforma/'+code,
                method: 'GET',
                success: function(response) {
                    $("#preloader_ch").remove();

                    if (response.success) {

                        PDF_Facture_Proforma(response.client, response.pres, response.produits,$('#agence').val());

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
        
    }

    list_proforma_all();

});