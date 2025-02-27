$(document).ready(function () {

    list_user_sms();
    numberTel("#ss_tel");
    numberTelLimit("#ss_tel");
    $('#btn_sendSMS').on('click', sendSMS);

    let selectedItems = new Set();

    function list_user_sms() {
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
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" value="${item.cel}" class="custom-control-input" id="pid-${index + 1}">
                                        <label class="custom-control-label" for="pid-${index + 1}"></label>
                                    </div>
                                </td>
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
                                <td class="nk-tb-col">
                                    <span class="tb-amount">${formatDateHeure(item.dateenregistre)}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="tb-amount">${timeAgo(item.dateenregistre)}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <ul class="nk-tb-actions gx-1">
                                        <li>
                                            <div class="drodown"><a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li>
                                                            <a  href="#" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#sendSMS" 
                                                                class="text-warning btn-sendsms"
                                                                data-matricule="${item.matricule}" 
                                                                data-np="${item.nomprenom}"
                                                                data-tel="${item.cel}" 
                                                            >
                                                                <em class="icon ni ni-send"></em>
                                                                <span>Envoi d'sms</span>
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
                    });

                    initializeDataTable(".table_client", { responsive: { details: true } });
                } else {
                    initializeDataTable(".table_client", { responsive: { details: true } });
                }

                updateCounter();
            },
            error: function() {
                initializeDataTable(".table_client", { responsive: { details: true } });
                updateCounter();
            }
        });

        $('.table_client').off('click', '.btn-sendsms').on('click', '.btn-sendsms', function () {

            const matricule = $(this).data('matricule');
            const np = $(this).data('np');
            const contact = $(this).data('tel');

            // $('#d_matricule').text(matricule);
            $('#ss_np').val(np);
            $('#ss_tel').val(contact);
            $('#ss_message').val(null);
 
        });  
    }

    function updateCounter() {
        let total = $(".table_client").DataTable().rows().count(); // Nombre total d'entrées dans DataTable
        let selected = selectedItems.size; // Nombre d'éléments sélectionnés globalement

        $("#selectedCount").text(selected);
        $("#totalCount").text(total);

        // Afficher ou masquer la balise <p> en fonction de la sélection
        if (total > 0) {
            $("p#selectionStatus").show();
            $('#selectionStatusCheckbox').show();
        } else {
            $("p#selectionStatus").hide();
            $('#selectionStatusCheckbox').hide();
        }

        // Afficher ou masquer le bouton "Envoyer" en fonction de la sélection
        if (selected > 0) {
            $("#btn_sendSMSmultiple").show(); // Afficher le bouton si des éléments sont sélectionnés
        } else {
            $("#btn_sendSMSmultiple").hide(); // Masquer le bouton si rien n'est sélectionné
        }
    }

    $(document).on("change", ".table_client tbody input[type='checkbox']", function () {
        let itemId = $(this).attr("id"); // ID unique de chaque checkbox

        if ($(this).is(":checked")) {
            selectedItems.add(itemId); // Ajouter l'élément sélectionné
        } else {
            selectedItems.delete(itemId); // Retirer l'élément si décoché
        }

        updateCounter();
    });

    $(document).on("change", "#pid-all", function () {
        let table = $(".table_client").DataTable(); // Obtenir l'instance de DataTable
        let allCheckboxes = $(".table_client tbody input[type='checkbox']"); // Récupérer toutes les cases à cocher

        if (this.checked) {
            // Si la case 'tout sélectionner' est cochée, ajouter tous les éléments du tableau au Set
            table.rows().every(function () { // Parcours de toutes les lignes, visibles et non visibles
                let itemId = this.node().querySelector('input[type="checkbox"]').id;
                selectedItems.add(itemId);
            });
            allCheckboxes.prop("checked", true); // Cocher toutes les cases à cocher
        } else {
            // Si la case 'tout sélectionner' est décochée, enlever tous les éléments du Set
            table.rows().every(function () {
                let itemId = this.node().querySelector('input[type="checkbox"]').id;
                selectedItems.delete(itemId);
            });
            allCheckboxes.prop("checked", false); // Décochez toutes les cases à cocher
        }

        updateCounter();
    });

    $('.table_client').on('draw.dt', function () {
        $(".table_client tbody input[type='checkbox']").each(function () {
            let itemId = $(this).attr("id");
            $(this).prop("checked", selectedItems.has(itemId)); // Mettre à jour l'état de chaque case
        });
    });

    $(document).on('click', '#btn_sendSMSmultiple', function () {
        // Récupérer toutes les cases à cocher sélectionnées
        const selectedCheckboxes = $(".table_client tbody input[type='checkbox']:checked");

        // Créer un tableau pour stocker les données des lignes sélectionnées
        let selectedClients = [];

        // Parcourir les cases sélectionnées et récupérer les données associées
        selectedCheckboxes.each(function() {
            const row = $(this).closest('tr'); // Trouver la ligne parent de la case cochée
            const matricule = row.find('td').eq(2).text(); // Récupérer la valeur du matricule
            const nom = row.find('td').eq(3).text().trim(); // Récupérer la valeur du nom et prénom
            const tel = row.find('td').eq(4).text().trim().replace(/^\+225|\s+/g, '');// Récupérer le numéro de téléphone

            selectedClients.push({ nom, tel });
        });

        // Vérifier si des éléments ont été sélectionnés
        // if (selectedClients.length > 0) {
            
        // } else {
        //     alert('Aucun client sélectionné');
        // }

        $(document).on('click', '#btn_sendSMSMULTIPLE', function () {
            event.preventDefault();

            let message = $('#sm_message').val();

            if (!message.trim()) {
                showAlert("Alert", "Veuillez saisir le message s'il vous plaît.", "info");
                return false;
            }

            var modal = bootstrap.Modal.getInstance(document.getElementById('sendSMSmultipleModal'));
            modal.hide();

            smsSenderMultipleAsync(selectedClients, message);
        });
    });

    function deselectAll() {
        // Désélectionner toutes les cases à cocher dans le tableau
        $(".table_client tbody input[type='checkbox']").prop("checked", false);

        // Si vous avez besoin de mettre à jour les éléments sélectionnés dans le Set ou autre variable
        selectedItems.clear();  // Supposons que vous utilisez un Set pour suivre les éléments sélectionnés
        updateCounter();  // Mise à jour du compteur ou de l'affichage de sélection
    }

    var maxLength = 100;
    
    $('#ss_message').on('input', function() {
        var currentLength = $(this).val().length;
        var remaining = maxLength - currentLength;
        
        // Met à jour le décompte des caractères
        $('#char_count').text(currentLength + '/' + maxLength);
        
        // Optionnel : Désactive l'écriture si le nombre de caractères est atteint
        if (remaining <= 0) {
            $(this).val($(this).val().substring(0, maxLength)); // Empêche l'ajout de plus de caractères
        }
    });

    $('#sm_message').on('input', function() {
        var currentLength = $(this).val().length;
        var remaining = maxLength - currentLength;
        
        // Met à jour le décompte des caractères
        $('#char_count_muktiple').text(currentLength + '/' + maxLength);
        
        // Optionnel : Désactive l'écriture si le nombre de caractères est atteint
        if (remaining <= 0) {
            $(this).val($(this).val().substring(0, maxLength)); // Empêche l'ajout de plus de caractères
        }
    });

    function sendSMS()
    {
        event.preventDefault();

        const contacts = [];

        let nom = $('#ss_np').val();
        let contact = $('#ss_tel').val();
        let message = $('#ss_message').val();

        if (contact.length !== 10 ) {
            showAlert("Alert", "Contact incomplet.", "info");
            return false;
        }

        if (!message.trim()) {
            showAlert("Alert", "Veuillez saisir le message s'il vous plaît.", "info");
            return false;
        }

        contacts.push({
            nom: nom,
            tel: contact,
        });

        var modal = bootstrap.Modal.getInstance(document.getElementById('sendSMS'));
        modal.hide();

        smsSenderMultipleAsync(contacts, message);
    }    

    function smsSenderMultipleAsync(contacts, message) {
        if (!Array.isArray(contacts) || contacts.length === 0) {
            showAlert('Erreur', 'Aucun contact valide à traiter.', 'error');
            return;
        }

        // Affichage du préloader
        $("body").append(`
            <div id="preloader_ch">
                <div class="spinner_preloader_ch"></div>
            </div>
        `);

        // Paramètres API (récupérés via Laravel)
        const params = {
            username: $('#API_SMS_USERNANME').val(),
            password: $('#API_SMS_PASSWORD').val(),
            serviceid: $('#API_SMS_SERVICEID').val(),
            sender: $('#API_SMS_SENDER').val(),
        };

        // Fonction d'envoi d'un SMS pour un contact
        const sendSMS = (contact) => {
            if (!contact.tel || typeof contact.tel !== 'string') {
                return Promise.resolve({ contact, success: false, error: 'Numéro invalide' });
            }

            const queryString = new URLSearchParams({
                ...params,
                msisdn: `+225${contact.tel.trim()}`, // Nettoyage du numéro
                msg: message.trim(),
            }).toString();

            return fetch(`https://api-public-2.mtarget.fr/messages?${queryString}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
            })
                .then(response => {
                    if (!response.ok) throw new Error(`Erreur HTTP: ${response.status}`);
                    return response.json();
                })
                .then(data => ({ contact, success: true, data }))
                .catch(error => ({ contact, success: false, error }));
        };

        // Exécution des requêtes en parallèle
        Promise.all(contacts.map(sendSMS))
            .then(results => {
                $('#preloader_ch').remove(); // Supprimer le préloader
                deselectAll();

                // Regroupement des résultats
                const successContacts = results.filter(r => r.success).map(r => r.contact);
                const failedContacts = results.filter(r => !r.success);

                // Affichage des résultats
                if (successContacts.length > 0) {
                    showAlert('Succès', `${successContacts.length}/${contacts.length} SMS envoyés avec succès.`, 'success');
                }

                if (failedContacts.length > 0) {
                    console.warn("Erreurs SMS:", failedContacts); // Pour debug dans la console
                    showAlert('Alerte', `${failedContacts.length}/${contacts.length} SMS n'ont pas été envoyés.`, 'warning');
                }

                if (contacts.length === 0 || failedContacts.length === contacts.length) {
                    showAlert('Alerte', `Échec total de l'envoi des SMS.`, 'error');
                }
            })
            .catch(error => {
                console.error("Erreur réseau:", error);
                $('#preloader_ch').remove();
                showAlert('Alerte', `Une erreur est survenue lors de l'envoi des SMS.`, 'danger');
            });
    }

});