$(document).ready(function () {

    select_client_vente('#client');
    select_remise('#remise');

    addDesignation();

    $('#client').on('change', function() {
        let selectedOption = $(this).find(':selected');
        let taux = selectedOption.data('taux');
        $('#taux').val(taux);

        const matricule = $(this).val();

        $.ajax({
            url: '/api/select_client_prescription/'+matricule,
            method: 'GET',
            success: function(response) {
                const data = response.data;

                if (data.length > 0) {
                    const prescription = data[0];

                    // Remplir les valeurs du tableau pour l'Œil Droit
                    $('#sphere_OD').text(prescription.OD.sphere);
                    $('#cylindre_OD').text(prescription.OD.cylindre);
                    $('#axe_OD').text(prescription.OD.axe);
                    $('#addition_OD').text(prescription.OD.addition);

                    // Remplir les valeurs du tableau pour l'Œil Gauche
                    $('#sphere_OG').text(prescription.OG.sphere);
                    $('#cylindre_OG').text(prescription.OG.cylindre);
                    $('#axe_OG').text(prescription.OG.axe);
                    $('#addition_OG').text(prescription.OG.addition);

                } else {

                    $('#sphere_OD, #cylindre_OD, #axe_OD, #addition_OD').text('');
                    $('#sphere_OG, #cylindre_OG, #axe_OG, #addition_OG').text('');

                    showAlert("Alert", "Le client n'a pas de préscription", "warning");
                }
                
            },
            error: function() {
                console.error('Erreur lors de la récupération des prescriptions.');
            }
        });

    });

    $("#btn_ajouter").on("click", addDesignation);

    function addDesignation() {
        const contenuDiv = $('#contenu');
        addContenu(contenuDiv);
    }

    function addContenu(contenuDiv) {

        const index = contenuDiv.children('.contenu_enfant').length + 1;

        const div = $(`
            <div class="contenu_enfant card-inner border border-1 rounded mb-5">
                <div class="card-header">
                    <h5 class="card-title text-center Title_produit">Produit ${index}</h5>
                </div>
                <div class="row g-gs mt-1">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label class="form-label">Désignation</label>
                            <div class="form-control-wrap">
                                <div class="form-icon form-icon-right">
                                    <em class="icon ni ni-archived"></em>
                                </div>
                                <input type="text" class="form-control designation" placeholder="Saisie Obligatoire">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Prix</label>
                            <div class="form-control-wrap">
                                <div class="form-icon form-icon-right">Fcfa</div>
                                <input type="tel" class="form-control prix" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label class="form-label">Quantité</label>
                            <div class="form-control-wrap">
                                <input type="tel" class="form-control quantite" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Total</label>
                            <div class="form-control-wrap">
                                <div class="form-icon form-icon-right">Fcfa</div>
                                <input readonly type="tel" class="form-control total" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group text-center">
                            <a class="btn btn-md btn-outline-danger suppr-btn">
                                <em class="icon ni ni-trash"></em>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        `);

        contenuDiv.append(div);

        checkContenu(contenuDiv);

        // Ajouter un event listener pour le bouton supprimer
        div.find('.suppr-btn').on('click', function() {
            div.remove();
            checkContenu(contenuDiv);
            updateIndexes(contenuDiv);
            updateMontantTotal(contenuDiv);
        });

        div.find('.prix').on('input', function() {

            let parent = $(this).closest('.contenu_enfant');
            let prix = parseFloat(parent.find('.prix').val().replace(/[^0-9]/g, '')) || 0;
            let quantite = parseInt(parent.find('.quantite').val().replace(/[^0-9]/g, '')) || 0;
            let total = prix * quantite;
            parent.find('.total').val(total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));

            if (!parent.find('.prix').val() || parent.find('.prix').val() == 0) {
                parent.find('.prix').val(0);
            }

            let rawValue = 0;
            rawValue = parseInt(parent.find('.prix').val().replace(/[^0-9]/g, ''));
            $(this).val(rawValue.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));

            updateMontantTotal(contenuDiv);
        });

        div.find('.quantite').on('input', function() {

            let parent = $(this).closest('.contenu_enfant');
            let prix = parseFloat(parent.find('.prix').val().replace(/[^0-9]/g, '')) || 0;
            let quantite = parseInt(parent.find('.quantite').val().replace(/[^0-9]/g, '')) || 0;
            let total = prix * quantite;
            parent.find('.total').val(total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));

            if (!parent.find('.quantite').val() || parent.find('.quantite').val() == 0) {
                parent.find('.quantite').val(0);
            }

            let rawValue = 0;
            rawValue = parseInt(parent.find('.quantite').val().replace(/[^0-9]/g, ''));
            $(this).val(rawValue);
                
            updateMontantTotal(contenuDiv);
        });
    }

    function updateIndexes(contenuDiv) {
        contenuDiv.find('.Title_produit').each(function(index) {
            $(this).text(`Produit ${index + 1}`);
        });
    }

    function checkContenu(contenuDiv) {
        const divBtn = $('#div_btn');

        if (contenuDiv.children('.contenu_enfant').length > 0) {
            divBtn.show();
        } else {
            divBtn.hide();
        }
    }

    function updateMontantTotal(contenuDiv) {

        let montantTotal = 0;
        let montantPatient = 0;

        // Calcul du montant total
        contenuDiv.find('.contenu_enfant').each(function() {
            let total = parseFloat($(this).find('.total').val().replace(/[^0-9]/g, '')) || 0;

            if (isNaN(total)) {
                showAlert("ALERT", 'Vérifier les prix et quantités des Produits s\'il vous plaît.', "warning");
                return false;  // Arrêter la boucle si une erreur est trouvée
            }

            montantTotal += total;  // Ajouter au montant total
        });

        // Vérification de la remise
        let remise = parseFloat($('#remise').val().replace(/[^0-9.-]/g, '')) || 0; // Remplacer tous les caractères non numériques sauf le point et le tiret

        // Calcul du montant à payer en fonction de la remise
        if (!isNaN(remise) && remise !== 0) {
            montantPatient = montantTotal - ((montantTotal * remise) / 100);  // Calcul avec la remise
        } else {
            montantPatient = montantTotal;  // Pas de remise, montant total à payer
        }

        // Mise à jour des champs avec les montants formatés
        $('#mTotal').val(montantTotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));  // Utiliser la fonction formatPrice pour un affichage avec des séparateurs de milliers
        $('#netPayer').val(montantPatient.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));  // Utiliser formatPrice pour le montant à payer
    }

    $('#remise').on('change', function() {
        const contenuDiv = $('#contenu');
        updateMontantTotal(contenuDiv);
    });

    function restForm()
    {
        $("#client").val(null);
        $("#taux").val(null);
        $("#choix_assurance").val(0).trigger('change');
        $("#date").val(null);

        $('#sphere_OD, #cylindre_OD, #axe_OD, #addition_OD').text('');
        $('#sphere_OG, #cylindre_OG, #axe_OG, #addition_OG').text('');

        $("#code_proforma").val(null);
        $('#statut_code_proforma').val(0);
        $('#valeur_code_proforma').val(null);
        $("#netAssurance").val(0);
        $("#remise").val(0).trigger('change');
        $("#netPayer").val(0);
        $("#mTotal").val(0);

        $('#btn_check').hide();
        $('#btn_search').show();

        $('#contenu').empty();

        addDesignation();
    }

    $("#btn_search").on("click", function() {
        let code = $("#code_proforma").val().trim();

        if (!code) {
           showAlert("Alert", "Veuillez saisir un code proforma Si une proforma a été délivrée", "warning");
           return;
        } else {
           searchProforma(code); 
        }  
    });

    $("#code_proforma").on("input", function() {

        $('#btn_check').hide();
        $('#btn_search').show();
        $('#statut_code_proforma').val(0);
    });

    function searchProforma(code)
    {
        // Ajouter le préchargeur
        let preloader_ch = `
            <div id="preloader_ch">
                <div class="spinner_preloader_ch"></div>
            </div>
        `;
        $("body").append(preloader_ch);

        $.ajax({
            url: '/api/rech_code_proforma_vente/'+code,
            method: 'GET',
            success: function(response) {
                const data = response.data;
                $("#preloader_ch").remove();

                $('#btn_check').hide();
                $('#btn_search').show();

                if (response.success) {
                    
                    if (data.valide != 1) {

                        $('#btn_check').show();
                        $('#btn_search').hide();
                        $('#statut_code_proforma').val(1);
                        $('#valeur_code_proforma').val(data.code);

                    } else if (data.valide == 1) {

                        showAlert("Alert", "Cette Facture Proforma à déjà été validé", "info");
                    }

                } else if (response.existeP) {

                    showAlert("Alert", "Facture Proforma introuvable", "warning");
                } else {

                    showAlert("Alert", "Echec de l'opération", "error");
                }
                
            },
            error: function() {
                $("#preloader_ch").remove();
                showAlert("Erreur", "Une erreur est survenue", "error");
            }
        });
    }

});