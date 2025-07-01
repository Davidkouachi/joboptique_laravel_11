$(document).ready(function () {

    $('#cadre_ouverture_caisse').hide();
    $('#cadre_fermeture_caisse').hide();

    function caisseVerf() {

        $.ajax({
            url: $('#url').attr('content') + '/api/caisseVerf/' + $('#id_agence').val(),
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

        preloader('start');

        $.ajax({
            url: $('#url').attr('content') + '/api/caisseOuvert/'+id_agence+'/'+login,
            method: 'GET',
            success: function(response) {
                preloader('end');

                if (response.success) {
                    $('#cadre_ouverture_caisse').hide();
                    $('#cadre_fermeture_caisse').show();
                    showAlert2("Succès", "Caisse Ouverte", "success");
                } else if (response.success_deja) {
                    $('#cadre_ouverture_caisse').hide();
                    $('#cadre_fermeture_caisse').show();
                    showAlert2("Information", "La caisse est déjà ouverte", "info");
                } else {
                    showAlert2("Alert", "Un erreur est survenue lors de l'ouverture de la caisse", "error");
                }
            
            },
            error: function() {
                preloader('end');
                showAlert2("Erreur", "Un erreur est survenue", "error");
            }
        });
    }

    function caisseFermer() {

        let id_agence = $('#id_agence').val();
        let login = $('#login').val();

        preloader('start');

        $.ajax({
            url: $('#url').attr('content') + '/api/caisseFermer/'+id_agence+'/'+login,
            method: 'GET',
            success: function(response) {
                preloader('end');

                if (response.success) {
                    $('#cadre_ouverture_caisse').show();
                    $('#cadre_fermeture_caisse').hide();
                    showAlert2("Succès", "Caisse Fermer", "success");
                } else if (response.success_deja) {
                    $('#cadre_ouverture_caisse').hide();
                    $('#cadre_fermeture_caisse').show();
                    showAlert2("Information", "La caisse est déjà fermer", "info");
                } else {
                    showAlert2("Alert", "Un erreur est survenue lors de la fermeture de la caisse", "error");
                }
            
            },
            error: function() {
                preloader('end');
                showAlert2("Erreur", "Un erreur est survenue", "error");
            }
        });
    }

    caisseVerf();
    $("#btn_ouverture_caisse").on("click", caisseOuvert);
    $("#btn_fermeture_caisse").on("click", caisseFermer);

    urlHistorique($('#login').val().trim());
    historiqueBtnMenu();

    const today = new Date().toISOString().split('T')[0];
    $('#Date1, #Date2').attr('max', today);
    $('#Date2').attr('min', $('#Date1').val());

    $('#Date1').on('change', function() {
        const date1Value = $(this).val();
        const $date2 = $('#Date2');

        if ($date2.val() && new Date(date1Value) > new Date($date2.val())) {
            $date2.attr('min', date1Value);
            $date2.val(date1Value);
        } else {
            $date2.attr('min', date1Value);
        }
    });

});