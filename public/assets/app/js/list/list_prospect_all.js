$(document).ready(function () {

    window.list_prospect_all = function () {
        $.ajax({
            url: '/api/list_prospect_all',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                const clients = data.data;

                // Détruire l'instance DataTable existante (si elle existe)
                const table = $('.table_prospect');
                if ($.fn.DataTable.isDataTable(table)) {
                    table.DataTable().destroy();
                }

                // Effacer le contenu du tableau
                table.find("tbody").empty();

                if (clients.length > 0) {

                    // const table = $('.table_client');
                    // table.DataTable().destroy();

                    $.each(clients, function(index, item) {

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
                                        ${item.nomprenom}
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-amount">+225 ${item.cel}</span>
                                </td>
                                <td class="nk-tb-col" >
                                    <span class="tb-amount ${ item.assurance != null ? `text-success` : `text-danger` }" >
                                        ${ item.assurance != null ? `Oui` : `Non` }
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-amount" >
                                        ${formatDateHeure(item.dateenregistre)}
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
                                                                id="detail-${item.code}" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#modalLarge" 
                                                                class="text-warning btn-detail"
                                                                data-code="${item.code}" 
                                                                data-nom="${item.nom}" 
                                                                data-prenom="${item.prenom}" 
                                                                data-np="${item.nomprenom}"
                                                                data-sexe="${item.sexe == 'M' ? `Masculin` : `Féminin`}" 
                                                                data-datenaiss="${formatDate(item.datenais)}" 
                                                                data-age="${calculAge(item.datenais)}"
                                                                data-profession="${item.profession != null ? item.profession : `Néant` }"
                                                                data-residence="${item.residence != null ? item.residence : `Néant` }"
                                                                data-contact="${item.cel != null ? '+225 '+item.cel : `Néant` }"
                                                                data-email="${item.email != null ? item.email : `Néant` }"
                                                                data-obs="${item.obs != null ? item.obs : `Néant` }"
                                                                data-motif="${item.motif_visite != null ? item.motif_visite : `Néant` }"
                                                                data-commercial="${item.commercial != null ? item.commercial : `Néant` }"
                                                                data-assurer="${item.assurance != null ? 'Prospect assurer' : `Prospect non-assurer` }"
                                                                data-assurance="${item.assurance != null ? item.assurance_lib : `Néant` }"
                                                                data-societe="${item.societe_assurance != null ? item.societe : `Néant` }"
                                                                data-taux="${item.tauxes != null ? item.taux+'%' : `Néant` }"
                                                                data-matriculeass="${item.matricule_assurance != null ? item.matricule_assurance : `Néant` }"
                                                                data-dateenregistre="${formatDateHeure(item.dateenregistre)}"
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

                        // $(`#detail-${item.matricule}`).on('click', function() {
                        //     console.log(item.nomprenom);
                        //     $('#m_nom').text(item.nomprenom);
                        // });

                        // $(`#delete-${item.id}`).on('click', function() {
                        //     $('#litIddelete').val(item.id);
                        // });
                    });

                    initializeDataTable(".table_prospect", { responsive: { details: true } });
                } else {
                    initializeDataTable(".table_prospect", { responsive: { details: true } });
                }
            },
            error: function() {
                initializeDataTable(".table_prospect", { responsive: { details: true } });
            }
        });

        $('.table_prospect').on('click', '.btn-detail', function () {
            
            const code = $(this).data('code');
            const nom = $(this).data('nom');
            const prenom = $(this).data('prenom');
            const np = $(this).data('np');
            const sexe = $(this).data('sexe');
            const datenaiss = $(this).data('datenaiss');
            const age = $(this).data('age');
            const profession = $(this).data('profession');
            const residence = $(this).data('residence');
            const contact = $(this).data('contact');
            const email = $(this).data('email');
            const obs = $(this).data('obs');
            const motif = $(this).data('motif');
            const commercial = $(this).data('commercial');
            const assurer = $(this).data('assurer');
            const assurance = $(this).data('assurance');
            const societe = $(this).data('societe');
            const taux = $(this).data('taux');
            const matriculeass = $(this).data('matriculeass');
            const dateenregistre = $(this).data('dateenregistre');

            $('#d_code').text(code);
            $('#d_nom').text(nom);
            $('#d_prenom').text(prenom);
            $('#d_np').text(np);
            $('#d_sexe').text(sexe);
            $('#d_datenaiss').text(datenaiss);
            $('#d_age').text(age);
            $('#d_profession').text(profession);
            $('#d_residence').text(residence);
            $('#d_tel').text(contact);
            $('#d_email').text(email);
            $('#d_obs').text(obs);
            $('#d_motif').text(motif);
            $('#d_commercial').text(commercial);
            $('#d_assurer').text(assurer);
            $('#d_assurance').text(assurance);
            $('#d_societe').text(societe);
            $('#d_taux').text(taux);
            $('#d_matriculeass').text(matriculeass);
            $('#d_datecreat').text('Date d\'enregistrement : '+dateenregistre);

            if (assurer === 'Prospect assurer') {
                $('#d_div_assurer1').show();
                $('#d_div_assurer2').show();
            } else {
                $('#d_div_assurer1').hide();
                $('#d_div_assurer2').hide();
            }
        });
        
    }

    list_prospect_all();

});