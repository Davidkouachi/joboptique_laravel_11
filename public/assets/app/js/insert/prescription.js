$(document).ready(function () {
    select_client_prescription('#client');

    $('#client').on('change', function() {

        const matricule = $(this).val().trim();

        $.ajax({
            url: '/api/select_client_prescription/'+matricule,
            method: 'GET',
            success: function(response) {
                const data = response.data;

                if (data.length > 0) {
                    const prescription = data[0]; // Prendre la première prescription si plusieurs sont possibles

                    // Remplir les champs OD
                    sphere_prescription('#Sphere_OD', prescription.OD.sphere);
                    cylindre_prescription('#Cylindre_OD', prescription.OD.cylindre);
                    axe_prescription('#Axe_OD', prescription.OD.axe);
                    addition_prescription('#Addition_OD', prescription.OD.addition);
                    traitement_prescription('#Traitement_OD', prescription.OD.traitement);
                    type_verre_prescription('#Type_verre_OD', prescription.OD.type_verre);

                    // Remplir les champs OG
                    sphere_prescription('#Sphere_OG', prescription.OG.sphere);
                    cylindre_prescription('#Cylindre_OG', prescription.OG.cylindre);
                    axe_prescription('#Axe_OG', prescription.OG.axe);
                    addition_prescription('#Addition_OG', prescription.OG.addition);
                    traitement_prescription('#Traitement_OG', prescription.OG.traitement);
                    type_verre_prescription('#Type_verre_OG', prescription.OG.type_verre);

                } else {

                    sphere_prescription('#Sphere_OD',null);
                    cylindre_prescription('#Cylindre_OD',null);
                    axe_prescription('#Axe_OD',null);
                    addition_prescription('#Addition_OD',null);
                    traitement_prescription('#Traitement_OD',null);
                    type_verre_prescription('#Type_verre_OD',null);

                    sphere_prescription('#Sphere_OG',null);
                    cylindre_prescription('#Cylindre_OG',null);
                    axe_prescription('#Axe_OG',null);
                    addition_prescription('#Addition_OG',null);
                    traitement_prescription('#Traitement_OG',null);
                    type_verre_prescription('#Type_verre_OG',null);
                }
                
            },
            error: function() {
                console.error('Erreur lors de la récupération des prescriptions.');
            }
        });

    });

    $("#formulaire_prescription").on("submit", function (event) {
        event.preventDefault();

        let matricule = $("#client").val().trim();

        let sphere_OD = $("#Sphere_OD");
        let cylindre_OD = $("#Cylindre_OD");
        let axe_OD = $("#Axe_OD");
        let addition_OD = $("#Addition_OD");
        let traitement_OD = $("#Traitement_OD");
        let type_verre_OD = $("#Type_verre_OD");

        let sphere_OG = $("#Sphere_OG");
        let cylindre_OG = $("#Cylindre_OG");
        let axe_OG = $("#Axe_OG");
        let addition_OG = $("#Addition_OG");
        let traitement_OG = $("#Traitement_OG");
        let type_verre_OG = $("#Type_verre_OG");

        // Ajouter le préchargeur
        let preloader_ch = `
            <div id="preloader_ch">
                <div class="spinner_preloader_ch"></div>
            </div>
        `;
        $("body").append(preloader_ch);

        $.ajax({
            url: "/api/insert_prescription/"+matricule,
            method: "GET",
            data: {
                sphere_OD: sphere_OD.val() || null,
                cylindre_OD: cylindre_OD.val() || null,
                axe_OD: axe_OD.val() || null,
                addition_OD: addition_OD.val() || null,
                traitement_OD: traitement_OD.val() || null,
                type_verre_OD: type_verre_OD.val() || null,

                sphere_OG: sphere_OG.val() || null,
                cylindre_OG: cylindre_OG.val() || null,
                axe_OG: axe_OG.val() || null,
                addition_OG: addition_OG.val() || null,
                traitement_OG: traitement_OG.val() || null,
                type_verre_OG: type_verre_OG.val() || null,

                login: $("#login").val().trim(),
            },
            success: function (response) {
                $("#preloader_ch").remove();

                if (response.success) {

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