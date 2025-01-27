$(document).ready(function () {

    // Fonction pour afficher une alerte avec SweetAlert
    function showAlert(title, message, icon) {
        Swal.fire({
            title: title,
            text: message,
            icon: icon,
        });
    }

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
        let preloader_ch = `
            <div id="preloader_ch">
                <div class="spinner_preloader_ch"></div>
            </div>
        `;
        $("body").append(preloader_ch);

        // Première requête : rafraîchir le token CSRF
        $.ajax({
            url: "/refresh-csrf",
            method: "GET",
            success: function (response_crsf) {
                $('meta[name="csrf-token"]').attr("content", response_crsf.csrf_token);

                // Deuxième requête : authentification
                $.ajax({
                    url: "/api/traitement_login",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": response_crsf.csrf_token,
                    },
                    data: {
                        login: login,
                        password: password,
                    },
                    success: function (response) {
                        $("#preloader_ch").remove();

                        if (response.success) {

                            Swal.fire({
                                title: "Rédirection en cours...",
                                html: "Veuillez patienter.",
                                timerProgressBar: !0,
                                allowOutsideClick: false,
                                showConfirmButton: false,
                                onBeforeOpen: () => {
                                    Swal.showLoading();
                                },
                            });

                            redirectTo(response.login);

                        } else if (response.error) {
                            showAlert("Alert", "Login ou Mot de passe incorrect", "warning");
                        }
                    },
                    error: function () {
                        $("#preloader_ch").remove();
                        showAlert("Erreur", "Erreur lors de l'authentification.", "error");
                    },
                });
            },
            error: function () {
                $("#preloader_ch").remove();
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
            window.location.href = "/";
        }
    }

});
