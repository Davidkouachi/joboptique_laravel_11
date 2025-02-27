$(document).ready(function () {

    window.list_vente_all = function () {
        $.ajax({
            url: '/api/list_vente_all',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                const proforma = data.data;

                // Détruire l'instance DataTable existante (si elle existe)
                const table = $('.table_vente');
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
                                    <span class="tb-amount">${item.client}</span>
                                </td>
                                <td class="nk-tb-col" >
                                    <span class="tb-amount ${ item.regle == 1 ? `text-success` : `text-danger` }" >
                                        ${ item.regle == 1 ? `Oui` : `Non` }
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-amount">
                                        ${item.total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')} Fcfa
                                    </span>
                                </td>
                                <td class="nk-tb-col" >
                                    <span class="tb-amount}" >
                                        ${ item.partassurance == null ? 0 : item.partassurance.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') } Fcfa
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-amount">
                                        ${item.partclient.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')} Fcfa
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
                                                                data-matricule="${item.matricule}"
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

                    initializeDataTable(".table_vente", { responsive: { details: true } });
                } else {
                    initializeDataTable(".table_vente", { responsive: { details: true } });
                }
            },
            error: function() {
                initializeDataTable(".table_vente", { responsive: { details: true } });
            }
        });

        $('.table_vente').off('click', '.btn-pdf').on('click', '.btn-pdf', function () {
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
        
    }

    list_vente_all();

});