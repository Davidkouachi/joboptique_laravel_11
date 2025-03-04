$(document).ready(function () {
    
    $("#formulaire_type_message").on("submit", function (event) {
        event.preventDefault();

        let type = $("#type_nom");
        let message = $("#type_message");

        if (!type.val().trim() || !message.val().trim() ) {
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

        $.ajax({
            url: "/api/insert_type_message",
            method: "GET",
            data: {
                type: type.val(),
                message: message.val(),
            },
            success: function (response) {
                $("#preloader_ch").remove();

                if (response.success) {

                    type.val(null);
                    message.val(null);
                    $('#char_count_type').text('0/100');
                    list_message_all();
                    showAlert("Succès", "Opération éffectuée", "success");

                } else if (response.error) {
                    showAlert("Alert", "Echec de l\'opération", "error");
                    console.log(response.message);
                }
            },
            error: function () {
                $("#preloader_ch").remove();
                showAlert("Erreur", "Erreur est survenu, veuillez réessayer.", "error");
                console.log(response.message);
            },
        });
    });

});