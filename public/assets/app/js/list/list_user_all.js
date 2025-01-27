$(document).ready(function () {

    window.list_user_all = function () {
        $.ajax({
            url: '/api/list_client_all',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                const clients = data.data;

                // Détruire l'instance DataTable existante (si elle existe)
                const table = $('.table_client');
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
                                    <span class="tb-amount">${item.matricule}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-amount">
                                        ${item.sexe == 'M' ? `M.` : `Mme.`} ${item.nomprenom}
                                    </span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-amount">+225 ${item.cel}</span>
                                </td>
                                <td class="nk-tb-col" >
                                    <span class="tb-amount ${ item.matricule_assurance != null ? `text-success` : `text-danger` }" >
                                        ${ item.matricule_assurance != null ? `Oui` : `Non` }
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
                                                                id="detail-${item.matricule}" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#modalLarge" 
                                                                class="text-warning"
                                                                data-matricule="${item.matricule}" 
                                                                data-nom="${item.nom}" 
                                                                data-prenom="${item.prenom}" 
                                                                data-np="${item.nomprenom}" 
                                                                data-civilite="${item.sexe == 'M' ? `M.` : `Mme.`}" 
                                                                data-sexe="${item.sexe == 'M' ? `Masculin` : `Féminin`}" 
                                                                data-datenaiss="${formatDate(item.datenais)}" 
                                                                data-age="${calculAge(item.datenais)}"
                                                                data-profession="${item.profession != null ? item.profession : `Néant` }"
                                                                data-residence="${item.residence != null ? item.residence : `Néant` }"
                                                                data-contact="${item.cel != null ? '+225 '+item.cel : `Néant` }"
                                                                data-email="${item.email != null ? item.email : `Néant` }"
                                                                data-sondage="${item.sondage != null ? item.sondage : `Néant` }"
                                                                data-commercial="${item.commercial != null ? item.commercial : `Néant` }"
                                                                data-assurer="${item.matricule_assurance != null ? 'Client assurer' : `Client non-assurer` }"
                                                                data-assurance="${item.assurance != null ? item.assurance : `Néant` }"
                                                                data-societe="${item.societe != null ? item.societe : `Néant` }"
                                                                data-taux="${item.taux != null ? item.taux+'%' : `Néant` }"
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

                        table.on('click', '[id^="detail-"]', function() {
                            const matricule = $(this).data('matricule');
                            const nom = $(this).data('nom');
                            const prenom = $(this).data('prenom');
                            const np = $(this).data('np');
                            const civilite = $(this).data('civilite');
                            const sexe = $(this).data('sexe');
                            const datenaiss = $(this).data('datenaiss');
                            const age = $(this).data('age');
                            const profession = $(this).data('profession');
                            const residence = $(this).data('residence');
                            const contact = $(this).data('contact');
                            const email = $(this).data('email');
                            const sondage = $(this).data('sondage');
                            const commercial = $(this).data('commercial');
                            const assurer = $(this).data('assurer');
                            const assurance = $(this).data('assurance');
                            const societe = $(this).data('societe');
                            const taux = $(this).data('taux');
                            const matriculeass = $(this).data('matriculeass');
                            const dateenregistre = $(this).data('dateenregistre');

                            $('#d_matricule').text(matricule);
                            $('#d_nom').text(nom);
                            $('#d_prenom').text(prenom);
                            $('#d_np').text(`${civilite} ${np}`);
                            $('#d_sexe').text(sexe);
                            $('#d_datenaiss').text(datenaiss);
                            $('#d_age').text(age+' ans');
                            $('#d_profession').text(profession);
                            $('#d_residence').text(residence);
                            $('#d_tel').text(contact);
                            $('#d_email').text(email);
                            $('#d_sondage').text(sondage);
                            $('#d_commercial').text(commercial);
                            $('#d_assurer').text(assurer);
                            $('#d_assurance').text(assurance);
                            $('#d_societe').text(societe);
                            $('#d_taux').text(taux);
                            $('#d_matriculeass').text(matriculeass);
                            $('#d_datecreat').text('Date d\'enregistrement : '+dateenregistre);

                            if (matriculeass != 'Néant') {
                                $('#d_div_assurer1').show();
                                $('#d_div_assurer2').show();
                            } else {
                                $('#d_div_assurer1').hide();
                                $('#d_div_assurer2').hide();
                            }
                        });

                        // $(`#delete-${item.id}`).on('click', function() {
                        //     $('#litIddelete').val(item.id);
                        // });
                    });

                    initializeDataTable(".table_client", { responsive: { details: true } });
                } else {
                    initializeDataTable(".table_client", { responsive: { details: true } });
                }
            },
            error: function() {
                initializeDataTable(".table_client", { responsive: { details: true } });
            }
        });
    }

    list_user_all();

});