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


});