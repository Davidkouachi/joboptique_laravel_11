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
                            <tr class="nk-tb-item">
                                <td class="nk-tb-col">
                                    <span class="tb-amount">${index + 1}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-amount">${item.matricule}</span>
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
                                        <li class="nk-tb-action-hidden" >
                                            <a  href="#"
                                                class="btn btn-trigger btn-icon btn-detail text-warning"
                                                title="Détails"
                                                data-matricule="${item.matricule}" 
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
                                                data-sondage="${item.sondage != null ? item.sondage : `Néant` }"
                                                data-commercial="${item.commercial != null ? item.commercial : `Néant` }"
                                                data-assurer="${item.assurance != null ? 'Client assurer' : `Client non-assurer` }"
                                                data-assurance="${item.assurance != null ? item.assurance_lib : `Néant` }"
                                                data-societe="${item.societe_assurance != null ? item.societe : `Néant` }"
                                                data-taux="${item.tauxes != null ? item.taux+'%' : `Néant` }"
                                                data-matriculeass="${item.matricule_assurance != null ? item.matricule_assurance : `Néant` }"
                                                data-dateenregistre="${formatDateHeure(item.dateenregistre)}"
                                            >
                                                <em class="icon ni ni-eye"></em>
                                            </a>
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

                    initializeDataTable(".table_client", { responsive: { details: true } });
                } else {
                    initializeDataTable(".table_client", { responsive: { details: true } });
                }
            },
            error: function() {
                initializeDataTable(".table_client", { responsive: { details: true } });
            }
        });

        $('.table_client').on('click', '.btn-detail', function (event) {
            event.preventDefault();

            const modalBody = `
                <div class="modal fade" tabindex="-1" id="modalLarge">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="card">
                                <div class="card-inner">
                                    <div class="team">
                                        <div class="user-card user-card-s2">
                                            <div class="user-avatar lg">
                                                <img height="80px" width="80px" class="rounded-pill border border-1" src="assets/images/user8.png" alt="">
                                            </div>
                                            <div class="user-info">
                                                <h6 id="d_np" ></h6> 
                                                <span class="sub-text" id="d_datecreat"></span>
                                            </div>
                                        </div>
                                        <div class="p-2" style="max-height: 400px;" data-simplebar >
                                            <ul class="team-info">
                                                <li><span>Matricule</span><span id="d_matricule" ></span></li>
                                                <li><span>Nom</span><span id="d_nom"></span></li>
                                                <li><span>Prénoms</span><span id="d_prenom" ></span></li>
                                                <li><span>Sexe</span><span id="d_sexe" ></span></li>
                                                <li><span>Date de maissance</span><span id="d_datenaiss" ></span></li>
                                                <li><span>Âge</span><span id="d_age"></span></li>
                                                <li><span>Profession</span><span id="d_profession"></span></li>
                                                <li><span>Résidence</span><span id="d_residence"></span></li>
                                                <li><span>Contact</span><span id="d_tel" ></span></li>
                                                <li><span>Email</span><span id="d_email" ></span></li>
                                                <li><span>Sondage</span><span id="d_sondage" ></span></li>
                                                <li><span>Commercial</span><span id="d_commercial" ></span></li>
                                                <li><span>Assurer</span><span id="d_assurer" ></span></li>
                                            </ul>
                                            <div class="user-card user-card-s2" id="d_div_assurer1">
                                                <div class="user-info">
                                                    <h6>Informations Assurance</h6>
                                                </div>
                                            </div>
                                            <ul class="team-info" id="d_div_assurer2">
                                                <li><span>Assurance</span><span id="d_assurance" ></span></li>
                                                <li><span>Taux</span><span id="d_taux" ></span></li>
                                                <li><span>Société</span><span id="d_societe" ></span></li>
                                                <li><span>Matricule Assurance</span><span id="d_matriculeass" ></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            $('body').append(modalBody);

            const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalLarge'));
            modal.show();

            const matricule = $(this).data('matricule');
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
            $('#d_np').text(np);
            $('#d_sexe').text(sexe);
            $('#d_datenaiss').text(datenaiss);
            $('#d_age').text(age);
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

            if (assurer === 'Client assurer') {
                $('#d_div_assurer1').show();
                $('#d_div_assurer2').show();
            } else {
                $('#d_div_assurer1').hide();
                $('#d_div_assurer2').hide();
            }
        });
        
    }

    list_user_all();

});