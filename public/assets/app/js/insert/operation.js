$(document).ready(function () { 

    select_op_magasin('#magasin_id');
    numberTel("#montant");

    $('#solde').hide();
    $('#btn_fermer').hide();
    $('#btn_ouvert').hide();
    $('#chargement').hide();
    $('#div_operation').hide();
    $('#message').hide();

    Verfication_statut();

    $('#Date1').on('change', function() {
        const date1 = $(this).val();
        
        if (date1) {
            $('#Date2').val(date1);
            $('#Date2').attr('min', date1);
        }
    });

    $('#Date2').on('change', function() {
        const date2 = $(this).val();
        const date1 = $('#Date1').val();

        if (date2 && date1 && new Date(date2) < new Date(date1)) {
            $(this).val(date1);
        }
    });

    $('#montant').on('input', function() {

        let rawValue = 0;
        rawValue = parseInt($(this).val().replace(/[^0-9]/g, '')) || 0;
        $(this).val(rawValue.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
    });

    $("#formulaire_operation").on("submit", function (event) {
        event.preventDefault();

        let id_agence = $('#id_agence').val().trim();
        let login = $('#login').val().trim();

        let motif = $("#motif").val().trim();
        let montant = $("#montant").val().replace(/[^0-9]/g, '') || 0;
        let type = $("#type").val().trim();
        let dateop = $("#dateop").val().trim();

        // Ajouter le préchargeur
        preloader('start');

        $.ajax({
            url: "/api/insert_operation/"+id_agence+'/'+login,
            method: "GET",
            data: {
                motif: motif,
                montant: montant,
                type: type,
                dateop: dateop,
            },
            success: function (response) {
                preloader('end');

                if (response.success) {

                    Verfication_solde();
                    rest_form();
                    list_operation_all();
                    showAlert("Succès", "Opération éffectuée", "success");

                } else if (response.montant) {
                    showAlert("Alert", "Le montant saisir est supérieur au solde actuel de la caisse", "warning");
                } else if (response.caisser_fermer) {
                    showAlert("Alert", "La caisse est actuellement fermer", "info");
                } else if (response.error) {
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

    function rest_form()
    {
        $("#motif").val(null);
        $("#montant").val(0);
        $("#type").val(null);

        let now = new Date();
        let formattedDate = now.getFullYear() + "-" +
                        String(now.getMonth() + 1).padStart(2, '0') + "-" +
                        String(now.getDate()).padStart(2, '0');
                        
        $("#dateop").val(formattedDate);
    }

});