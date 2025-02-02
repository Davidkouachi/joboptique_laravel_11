$(document).ready(function () {

    $('#cadre_ouverture_caisse').hide();
    $('#cadre_fermeture_caisse').hide();

    window.caisseVerf = function () {

        $.ajax({
            url: '/api/caisseVerf',
            method: 'GET',
            success: function(response) {
                const data = response.data;

                if (data.statut == 0) {
                    $('#cadre_ouverture_caisse').show();
                    $('#cadre_fermeture_caisse').hide();
                } else {
                    $('#cadre_ouverture_caisse').hide();
                    $('#cadre_fermeture_caisse').show();
                }
            
            },
            error: function() {
                // showAlert('danger', 'Impossible de generer le code automatiquement');
            }
        });
    }

    window.caisseOuvert = function () {

        let id_agence = $('#id_agence').val();
        let login = $('#login').val();

        let preloader_ch = `
            <div id="preloader_ch">
                <div class="spinner_preloader_ch"></div>
            </div>
        `;
        $("body").append(preloader_ch);

        $.ajax({
            url: '/api/caisseOuvert/'+id_agence+'/'+login,
            method: 'GET',
            success: function(response) {
                $("#preloader_ch").remove();

                if (response.success) {
                    $('#cadre_ouverture_caisse').hide();
                    $('#cadre_fermeture_caisse').show();
                    showAlert("Succès", "Caisse Ouverte", "success");
                } else {
                    showAlert("Alert", "Un erreur est survenue lors de l'ouverture de la caisse", "error");
                }
            
            },
            error: function() {
                $("#preloader_ch").remove();
                showAlert("Erreur", "Un erreur est survenue", "error");
            }
        });
    }

    window.caisseFermer = function () {

        let id_agence = $('#id_agence').val();
        let login = $('#login').val();

        let preloader_ch = `
            <div id="preloader_ch">
                <div class="spinner_preloader_ch"></div>
            </div>
        `;
        $("body").append(preloader_ch);

        $.ajax({
            url: '/api/caisseFermer/'+id_agence+'/'+login,
            method: 'GET',
            success: function(response) {
                $("#preloader_ch").remove();

                if (response.success) {
                    $('#cadre_ouverture_caisse').show();
                    $('#cadre_fermeture_caisse').hide();
                    showAlert("Succès", "Caisse Fermer", "success");
                } else {
                    showAlert("Alert", "Un erreur est survenue lors de la fermeture de la caisse", "error");
                }
            
            },
            error: function() {
                $("#preloader_ch").remove();
                showAlert("Erreur", "Un erreur est survenue", "error");
            }
        });
    }

    caisseVerf();
    $("#btn_ouverture_caisse").on("click", caisseOuvert);
    $("#btn_fermeture_caisse").on("click", caisseFermer);

});