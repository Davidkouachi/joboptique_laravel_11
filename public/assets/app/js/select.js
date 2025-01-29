$(document).ready(function () {

    window.select_societe = function (id) 
    {
        const selectElement2 = $(id);
        selectElement2.empty();
        selectElement2.append($('<option>', {
            value: '',
            text: '',
        }));

        $.ajax({
            url: '/api/select_societe',
            method: 'GET',
            success: function(response) {
                const data = response.data;

                data.forEach(function(item) {
                    selectElement2.append($('<option>', {
                        value: item.id,
                        text: item.libelle,
                    }));
                });
            },
            error: function() {
                // showAlert('danger', 'Impossible de generer le code automatiquement');
            }
        });
    }

    window.select_assurance = function (id) 
    {
        const selectElement2 = $(id);
        selectElement2.empty();
        selectElement2.append($('<option>', {
            value: '',
            text: '',
        }));

        $.ajax({
            url: '/api/select_assurance',
            method: 'GET',
            success: function(response) {
                const data = response.data;

                data.forEach(function(item) {
                    selectElement2.append($('<option>', {
                        value: item.code,
                        text: item.denomination,
                    }));
                });
            },
            error: function() {
                // showAlert('danger', 'Impossible de generer le code automatiquement');
            }
        });
    }

    window.select_taux = function (id) 
    {
        const selectElement2 = $(id);
        selectElement2.empty();
        selectElement2.append($('<option>', {
            value: '',
            text: '',
        }));

        $.ajax({
            url: '/api/select_taux',
            method: 'GET',
            success: function(response) {
                const data = response.data;

                data.forEach(function(item) {
                    selectElement2.append($('<option>', {
                        value: item.id,
                        text: item.valeur+'%',
                    }));
                });
            },
            error: function() {
                // showAlert('danger', 'Impossible de generer le code automatiquement');
            }
        });
    }

    window.select_client_prescription = function (id) 
    {
        const selectElement2 = $(id);
        selectElement2.empty();
        selectElement2.append($('<option>', {
            value: '',
            text: '',
        }));

        $.ajax({
            url: '/api/select_client',
            method: 'GET',
            success: function(response) {
                const data = response.data;

                data.forEach(function(item) {
                    selectElement2.append($('<option>', {
                        value: item.matricule,
                        text: item.nomprenom+' - '+item.cel,
                    }));
                });
            },
            error: function() {
                // showAlert('danger', 'Impossible de generer le code automatiquement');
            }
        });
    }

    window.sphere_prescription = function (id,data) 
    {
        const selectElement2 = $(id);
        selectElement2.empty();
        selectElement2.append($('<option>', {
            value: '',
            text: '',
        }));

        for (var i = -20; i <= 20; i += 0.25) {
           selectElement2.append($('<option>', {
                value: i,
                text: i > 0 ? `+${i}` : i,
                selected: data != null && data != '' && data == i,
            })); 
        }
    }

    window.cylindre_prescription = function (id,data) 
    {
        const selectElement2 = $(id);
        selectElement2.empty();
        selectElement2.append($('<option>', {
            value: '',
            text: '',
        }));

        for (var i = -20; i <= 20; i += 0.25) {
           selectElement2.append($('<option>', {
                value: i,
                text: i > 0 ? `+${i}` : i,
                selected: data != null && data != '' && data == i
            })); 
        }
    }

    window.axe_prescription = function (id,data) 
    {
        const selectElement2 = $(id);
        selectElement2.empty();
        selectElement2.append($('<option>', {
            value: '',
            text: '',
        }));

        for (var i = 0; i <= 360; i++) {
           selectElement2.append($('<option>', {
                value: i,
                text: `${i}°`,
                selected: data != null && data != '' && data == i
            })); 
        }
    }

    window.addition_prescription = function (id,data) 
    {
        const selectElement2 = $(id);
        selectElement2.empty();
        selectElement2.append($('<option>', {
            value: '',
            text: '',
        }));

        for (var i = -20; i <= 20; i += 0.25) {
           selectElement2.append($('<option>', {
                value: i,
                text: i > 0 ? `+${i}` : i,
                selected: data != null && data != '' && data == i
            })); 
        }
    }

    window.traitement_prescription = function (id,data) 
    {
        const selectElement2 = $(id);
        selectElement2.empty();
        selectElement2.append($('<option>', {
            value: '',
            text: '',
        }));

        const options = [
            {id: 1, text: "PHOTOGRAY" },
            {id: 2, text: "ANTIREFLET" },
            {id: 3, text: "PHOTOGRAY + ANTIREFLET" },
            {id: 4, text: "TEINTE A" },
            {id: 5, text: "TEINTE AB" },
            {id: 6, text: "BLUE BAN" },
            {id: 7, text: "TRANSITION" },
            {id: 8, text: "BLUE CUT" },
            {id: 9, text: "BLUE BAN + PHOTOGRAY" },
            {id: 10, text: "BLUE BAN + TRANSITION" },
            {id: 11, text: "BLUE BAN + UV" },
        ];

        options.forEach(function(option) {

            selectElement2.append($('<option>', {
                value: option.id,
                text: option.text,
                selected: data != null && data != '' && data == option.id,
            }));
        });
    }

    window.type_verre_prescription = function (id,data) 
    {
        const selectElement2 = $(id);
        selectElement2.empty();
        selectElement2.append($('<option>', {
            value: '',
            text: '',
        }));

        const options = [
            {id: 1, text: "SIMPLE FOYER" },
            {id: 2, text: "DOUBLE FOYER" },
            {id: 3, text: "AFOCAL" },
            {id: 4, text: "PROGRESSIF" },
        ];

        options.forEach(function(option) {

            selectElement2.append($('<option>', {
                value: option.id,
                text: option.text,
                selected: data != null && data != '' && data == option.id,
            }));
        });
    }

    window.select_remise = function (id) 
    {
        const selectElement2 = $(id);
        selectElement2.empty();

        for (var i = 0; i <= 100; i++) {
           selectElement2.append($('<option>', {
                value: i,
                text: `-${i}% de réduction`,
                selected: i == 0,
            })); 
        }
    }

});