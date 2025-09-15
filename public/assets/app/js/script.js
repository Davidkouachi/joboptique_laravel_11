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

    $('#logoutBtn').on('click', function (e) {
        e.preventDefault();

        const ModalDeco = `
            <div id="preloaderLogout" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%;
                background: rgba(255,255,255,0.8); z-index: 9999; display: flex; align-items: center; justify-content: center;">
                <div style="text-align: center;">
                    <div class="spinner-border text-danger" role="status"></div>
                    <p style="margin-top: 10px; font-weight: bold;">Déconnexion en cours...</p>
                </div>
            </div>`;

        // Ajoute le préloader
        $('body').append(ModalDeco);

        // Optionnel : petit délai pour voir le préloader
        setTimeout(function () {
            window.location.href = $('#logoutBtn').attr('href');
        }, 1000); // 1 seconde
    });

    // // Fonction pour afficher l'overlay offline
    // function showOfflinePage() {
    //     if ($('#offline-page').length === 0) {
    //         var offlineHtml = `
    //         <div id="offline-page" style="
    //             position: fixed;
    //             top: 0;
    //             left: 0;
    //             width: 100%;
    //             height: 100%;
    //             background: #fff;
    //             z-index: 9999;
    //             text-align: center;
    //             padding-top: 100px;
    //         ">
    //             <div class="nk-app-root">
    //                 <div class="nk-main ">
    //                     <div class="nk-wrap nk-wrap-nosidebar">
    //                         <div class="nk-content ">
    //                             <div class="nk-block nk-block-middle wide-md mx-auto">
    //                                 <div class="nk-block-content nk-error-ld text-center">
    //                                     <img style="margin-top: -200px; margin-bottom: -100px;" class="nk-error-gfx" src="assets/images/disconnect.avif">
    //                                     <div class="wide-xs mx-auto mt-n5">
    //                                         <h3 class="nk-error-title">
    //                                             📡 Pas de connexion Internet
    //                                         </h3>
    //                                         <p class="nk-error-text">
    //                                             Il semble que votre connexion Internet soit interrompue. Veuillez vérifier votre connexion Internet ou revenez plus tard.
    //                                         </p>
    //                                         <a class="btn btn-lg btn-round btn-dim btn-outline-secondary mt-2" href="#">
    //                                             <span>Réssayer</span>
    //                                             <em class="icon ni ni-reload"></em>
    //                                         </a>
    //                                     </div>
    //                                 </div>
    //                             </div>
    //                         </div>
    //                     </div>
    //                 </div>
    //             </div>
    //         </div>`;
    //         $('body').append(offlineHtml);
    //     }
    // }

    // // Vérification initiale
    // if (!navigator.onLine) {
    //     showOfflinePage();
    // }

    // // Détecte perte de connexion
    // $(window).on('offline', function() {
    //     showOfflinePage();
    // });

    // // Détecte retour de connexion
    // $(window).on('online', function() {
    //     location.reload(); // recharge la page automatiquement
    // });

});