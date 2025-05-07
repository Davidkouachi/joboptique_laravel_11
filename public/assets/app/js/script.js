$(document).ready(function () {

    $('#cadre_ouverture_caisse').hide();
    $('#cadre_fermeture_caisse').hide();

    function caisseVerf() {

        $.ajax({
            url: '/api/caisseVerf/' + $('#id_agence').val(),
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

    function caisseOuvert() {

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
                    showAlert2("Succès", "Caisse Ouverte", "success");
                } else {
                    showAlert2("Alert", "Un erreur est survenue lors de l'ouverture de la caisse", "error");
                }
            
            },
            error: function() {
                $("#preloader_ch").remove();
                showAlert2("Erreur", "Un erreur est survenue", "error");
            }
        });
    }

    function caisseFermer() {

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
                    showAlert2("Succès", "Caisse Fermer", "success");
                } else {
                    showAlert2("Alert", "Un erreur est survenue lors de la fermeture de la caisse", "error");
                }
            
            },
            error: function() {
                $("#preloader_ch").remove();
                showAlert2("Erreur", "Un erreur est survenue", "error");
            }
        });
    }

    caisseVerf();
    $("#btn_ouverture_caisse").on("click", caisseOuvert);
    $("#btn_fermeture_caisse").on("click", caisseFermer);

    urlHistorique($('#login').val().trim());
    historiqueBtnMenu();

});