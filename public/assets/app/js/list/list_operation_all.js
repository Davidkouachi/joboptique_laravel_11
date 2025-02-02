$(document).ready(function () {

    window.list_operation_all = function () {

        let date1 = $('#Date1').val();
        let date2 = $('#Date2').val();
        let magasin = $('#magasin_id').val();

        $.ajax({
            url: '/api/list_operation_all/'+date1+'/'+date2+'/'+magasin,
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                const operation = data.data;
                const donne = data.donne;

                // Détruire l'instance DataTable existante (si elle existe)
                const table = $('.table_operation');
                if ($.fn.DataTable.isDataTable(table)) {
                    table.DataTable().destroy();
                }

                // Effacer le contenu du tableau
                table.find("tbody").empty();

                if (operation.length > 0) {

                    // const table = $('.table_client');
                    // table.DataTable().destroy();

                    $.each(operation, function(index, item) {

                        const row = $(`
                            <tr>
                                <td class="nk-tb-col">
                                    <span class="tb-amount">${index + 1}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="badge ${item.type === 'sortie' ? 'bg-danger' : (item.type === 'entree' ? 'bg-success' : (item.type_operation === 4 || item.type_operation === 5   ? 'bg-warning' : 'bg-secondary'))}">
                                        ${item.type ? item.type : (item.type_operation === 4 ? 'Ouverture de caisse' : (item.type_operation === 5   ? 'Fermeture de caisse' : 'Systéme'))}
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="badge ${item.type === 'sortie' ? 'bg-danger' : (item.type === 'entree' ? 'bg-success' : (item.type_operation === 4 || item.type_operation === 5   ? 'bg-warning' : 'bg-secondary'))}">
                                        ${(item.type === 'sortie' ? '-' : (item.type === 'entree' ? '+' : ''))} 
                                        ${item.montant ? item.montant.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') : '0'} Fcfa
                                    </span>

                                </td>
                                <td class="nk-tb-col" >
                                    <span class="tb-amount" >
                                        ${item.login}
                                    </span>
                                </td>
                                <td class="nk-tb-col" >
                                    <span class="badge bg-primary" >
                                        ${item.magasin_nom}
                                    </span>
                                </td>
                                <td class="nk-tb-col" >
                                    <span class="tb-amount}" >
                                       ${formatDateHeure(item.dateop)}
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-amount" >
                                        ${formatDateHeure(item.created_at)}
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
                                                                class="text-warning btn-detail"
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#modalLarge" 
                                                                data-codeop="${item.codeop}"
                                                                data-type="${item.type}"
                                                                data-typeop="${item.type_operation}"
                                                                data-libelle="${item.libelle}"
                                                                data-montant="${item.montant}"
                                                                data-magasin="${item.magasin_nom}"
                                                                data-dateop="${item.dateop}"
                                                                data-login="${item.login}"
                                                                data-created_at="${item.created_at}"
                                                                data-numop="${item.num_operation}"
                                                            >
                                                                <em class="icon ni ni-eye"></em>
                                                                <span>Détail</span>
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

                        $('#total').text('Total : '+donne['total'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')+' Fcfa');
                        $('#entrer').text('Entrer : + '+donne['entree'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')+' Fcfa');
                        $('#sortie').text('Sortie : - '+donne['sortie'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')+' Fcfa');

                        // $(`#detail-${item.matricule}`).on('click', function() {
                        //     console.log(item.nomprenom);
                        //     $('#m_nom').text(item.nomprenom);
                        // });

                        // $(`#delete-${item.id}`).on('click', function() {
                        //     $('#litIddelete').val(item.id);
                        // });
                    });

                    initializeDataTable(".table_operation", { responsive: { details: true } });
                } else {
                    initializeDataTable(".table_operation", { responsive: { details: true } });

                    $('#total').text('Total : 0 Fcfa');
                    $('#entrer').text('Entrer : + 0 Fcfa');
                    $('#sortie').text('Sortie : - 0 Fcfa');

                }
            },
            error: function() {
                initializeDataTable(".table_operation", { responsive: { details: true } });

                $('#total').text('Total : 0 Fcfa');
                $('#entrer').text('Entrer : + 0 Fcfa');
                $('#sortie').text('Sortie : - 0 Fcfa');
            }
        });
        
    }

    $('.table_operation').on('click', '.btn-detail', function () {
            const codeop = $(this).data('codeop');
            const type = $(this).data('type');
            const typeop = $(this).data('typeop');
            const libelle = $(this).data('libelle');
            const montant = $(this).data('montant');
            const magasin = $(this).data('magasin');
            const dateop = $(this).data('dateop');
            const login = $(this).data('login');
            const created_at = $(this).data('created_at');
            const numop = $(this).data('numop');

            let solde;
            if (type == 'entree') {
                solde = '+ '+montant.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')+' Fcfa';
            } else if (type == 'sortie') {
                solde = '- '+montant.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')+' Fcfa';
            } else {
                solde = montant.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')+' Fcfa';
            }

            let op;
            if (type == 'entree') {
                op = 'Entrer d\'argent';
            } else if (type == 'sortie') {
                op = 'Sortie d\'argent';
            } else if (typeop == 4) {
                op = 'Ouverture de la caisse';
            } else if (typeop == 5) {
                op = 'Fermeture de la caisse';
            }

            $('#d_creer_par').text('Créer par '+login);
            $('#d_datecreat').text('Le '+formatDate(created_at));

            $('#d_type').text(op);
            $('#d_motif').text(libelle);
            $('#d_montant').text(solde);
            $('#d_magasin').text(magasin);
            $('#d_dateop').text('Le '+formatDateHeure(created_at));
            $('#d_num').text(numop ?? 'Aucun');


        });

    list_operation_all();
    $("#btn_search").on("click", list_operation_all);

});