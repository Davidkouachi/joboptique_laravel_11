$(document).ready(function () {
    
    $("#formulaire_new_assurance").on("submit", function (event) {
        event.preventDefault();

        let nom = $("#nom");

        if (!nom.val().trim()) {
            showAlert("Alert","Veuillez remplir tous les champs obligatoire s'il vous plaît !!!","warning");
            return false;
        } 

        // Ajouter le préchargeur
        preloader('start');

        $.ajax({
            url: $('#url').attr('content') + "/api/insert_assurance",
            method: "GET",
            data: {
                nom: nom.val(),
                login: $("#login").val().trim(),
            },
            success: function (response) {
                preloader('end');

                if (response.success) {

                    restForm();
                    list_assurance_all();
                    showAlert("Succès", "Opération éffectuée", "success");

                } else if (response.existe) {
                    showAlert("Alert", "Cette assurance a déjà été enregistrer", "warning");
                } else {
                    showAlert("Alert", "Echec de l\'opération", "error");
                    console.log(response.message);
                }
            },
            error: function () {
                preloader('end');
                showAlert("Erreur", "Erreur est survenu, veuillez réessayer.", "error");
                console.log(response.message);
            },
        });
    });

    function restForm()
    {
        $("#nom").val(null);
    }

});