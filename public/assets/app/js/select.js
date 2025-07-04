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
            url: $('#url').attr('content') + '/api/select_societe',
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
            url: $('#url').attr('content') + '/api/select_assurance',
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
            url: $('#url').attr('content') + '/api/select_taux',
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
            url: $('#url').attr('content') + '/api/select_client',
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

    window.select_client_vente = function (id) 
    {
        const selectElement2 = $(id);
        selectElement2.empty();
        selectElement2.append($('<option>', {
            value: '',
            text: '',
        }));

        $.ajax({
            url: $('#url').attr('content') + '/api/select_client',
            method: 'GET',
            success: function(response) {
                const data = response.data;

                data.forEach(function(item) {
                    selectElement2.append($('<option>', {
                        value: item.matricule,
                        text: item.nomprenom+' - '+item.cel,
                        'data-taux': item.taux,
                    }));
                });
            },
            error: function() {
                // showAlert('danger', 'Impossible de generer le code automatiquement');
            }
        });
    }

    window.select_client_facturation = function (id) 
    {
        const selectElement2 = $(id);
        selectElement2.empty();
        selectElement2.append($('<option>', {
            value: '',
            text: '',
        }));

        $.ajax({
            url: $('#url').attr('content') + '/api/select_client',
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

        $.ajax({
            url: $('#url').attr('content') + '/api/select_traitement',
            method: 'GET',
            success: function(response) {
                const datad = response.data;

                datad.forEach(function(item) {
                    selectElement2.append($('<option>', {
                        value: item.id,
                        text: item.libelle,
                        selected: item.id != null && item.id != '' && item.id == data,
                    }));
                });
            },
            error: function() {
                // showAlert('danger', 'Impossible de generer le code automatiquement');
            }
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

        $.ajax({
            url: $('#url').attr('content') + '/api/select_type_verre',
            method: 'GET',
            success: function(response) {
                const datad = response.data;

                datad.forEach(function(item) {
                    selectElement2.append($('<option>', {
                        value: item.id,
                        text: item.libelle,
                        selected: item.id != null && item.id != '' && item.id == data,
                    }));
                });
            },
            error: function() {
                // showAlert('danger', 'Impossible de generer le code automatiquement');
            }
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

    window.select_code_proforma_vente = function (id) 
    {
        const selectElement2 = $(id);
        selectElement2.empty();
        selectElement2.append(
            $('<option>', {
                value: '0',
                text: 'Aucun',
            })
        );

        $.ajax({
            url: $('#url').attr('content') + '/api/select_code_proforma_vente',
            method: 'GET',
            success: function(response) {
                const data = response.data;

                data.forEach(function(item) {
                    selectElement2.append($('<option>', {
                        value: item.code,
                        text: item.code,
                    }));
                });
            },
            error: function() {
                // showAlert('danger', 'Impossible de generer le code automatiquement');
            }
        });
    }

    window.select_op_magasin = function (id) 
    {
        const selectElement2 = $(id);
        selectElement2.empty();
        selectElement2.append(
            $('<option>', {
                value: '0',
                text: 'Tous',
            })
        );

        $.ajax({
            url: $('#url').attr('content') + '/api/select_op_magasin',
            method: 'GET',
            success: function(response) {
                const data = response.data;

                data.forEach(function(item) {
                    selectElement2.append($('<option>', {
                        value: item.id,
                        text: item.nom,
                    }));
                });
            },
            error: function() {
                // showAlert('danger', 'Impossible de generer le code automatiquement');
            }
        });
    }

    window.select_annee = function (id) 
    {
        const selectElement = $(id);
        selectElement.empty();
        
        const currentYear = new Date().getFullYear();
        const startYear = 2022;

        // Ajouter les années en ordre décroissant
        for (let year = currentYear; year >= startYear; year--) {
            const option = $('<option>', {
                value: year,
                text: year,
                selected: year === currentYear
            });

            selectElement.append(option);
        }
    };

    window.select_magasin = function (id, callback) 
    {
        const selectElement2 = $(id);
        selectElement2.empty();

        $.ajax({
            url: $('#url').attr('content') + '/api/select_op_magasin',
            method: 'GET',
            success: function(response) {
                const data = response.data;

                data.forEach(function(item) {
                    selectElement2.append($('<option>', {
                        value: item.id,
                        text: item.nom,
                    }));
                });

                // Appelez le callback une fois que tout est terminé
                if (typeof callback === 'function') {
                    callback();
                }
            },
            error: function() {
                // showAlert('danger', 'Impossible de generer le code automatiquement');

                if (typeof callback === 'function') {
                    callback(); // Appelez le callback même en cas d'erreur
                }
            }
        });
    }

    window.select_type_message = function (id) 
    {
        const selectElement2 = $(id);
        selectElement2.empty();
        selectElement2.append($('<option>', {
            value: '',
            text: '',
            'data-message': '',
        }));

        $.ajax({
            url: $('#url').attr('content') + '/api/select_type_message',
            method: 'GET',
            success: function(response) {
                const data = response.data;

                data.forEach(function(item) {
                    selectElement2.append($('<option>', {
                        value: item.id,
                        text: item.type,
                        'data-message': item.message,
                    }));
                });

                // Recharger Select2 après la mise à jour des options
                selectElement2.select2();
            },
            error: function() {
                // showAlert('danger', 'Impossible de generer le code automatiquement');
            }
        });
    }


});