$(document).ready(function () {

    // Gestionnaire pour le formulaire de login
    $("#formulaire_login").on("submit", function (event) {
        event.preventDefault();

        let login = $("#login").val().trim();
        let password = $("#password").val().trim();

        if (!login || !password) {
            showAlert("Alert","Veuillez remplir tous les champs s'il vous plaît !!!","warning");
            return false;
        }

        // Ajouter le préchargeur
        preloader('start');

        // Première requête : rafraîchir le token CSRF
        $.ajax({
            url: $('#url').attr('content') + "/refresh-csrf",
            method: "GET",
            success: function (response_crsf) {
                $('meta[name="csrf-token"]').attr("content", response_crsf.csrf_token);

                // Deuxième requête : authentification
                $.ajax({
                    url: $('#url').attr('content') + "/api/traitement_login",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": response_crsf.csrf_token,
                    },
                    data: {
                        login: login,
                        password: password,
                    },
                    success: function (response) {
                        // preloader('end');

                        if (response.success) {

                            // Swal.fire({
                            //     title: "Rédirection en cours...",
                            //     html: "Veuillez patienter.",
                            //     timerProgressBar: !0,
                            //     allowOutsideClick: false,
                            //     showConfirmButton: false,
                            //     onBeforeOpen: () => {
                            //         Swal.showLoading();
                            //     },
                            // });

                            redirectTo(response.login);
                            preloader('end');

                        } else if (response.error) {
                            preloader('end');
                            showAlert("Alert", "Login ou Mot de passe incorrect", "warning");
                        }
                    },
                    error: function () {
                        preloader('end');
                        showAlert("Erreur", "Erreur lors de l'authentification.", "error");
                    },
                });
            },
            error: function () {
                preloader('end');
                showAlert("Erreur", "Une erreur est survenue lors de la recupération du token.", "error");
            },
        });
    });

    // Fonction pour gérer la redirection après authentification
    function redirectTo(login) {
        let userLogin = login;

        // Récupérer ou initialiser le tableau userPages
        let userPages = JSON.parse(localStorage.getItem("userPages")) || [];

        // Trouver l'utilisateur dans le tableau
        let userIndex = userPages.findIndex((user) => user.login === userLogin);

        if (userIndex !== -1) {
            window.location.href = userPages[userIndex].lastUrl;
        } else {
            window.location.href = $('#url').attr('content') + "/";
        }
    }

});
