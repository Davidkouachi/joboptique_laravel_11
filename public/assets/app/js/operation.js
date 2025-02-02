$(document).ready(function () { 
    
    window.Verfication_statut = function () 
    {

        $('#btn_fermer').hide();
        $('#btn_ouvert').hide();
        $('#chargement').show();

        $.ajax({
            url: '/api/caisseVerf',
            method: 'GET',
            success: function(response) {
                const data = response.data;

                $('#chargement').hide();
                $('#solde').show();

                if (data.statut == 0) {
                    $('#btn_fermer').hide();
                    $('#btn_ouvert').show();
                    $('#div_operation').hide();
                    $('#solde').text(data.solde.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + 'Fcfa');
                } else {
                    $('#btn_fermer').show();
                    $('#btn_ouvert').hide();
                    $('#div_operation').show();
                    $('#solde').text(data.solde.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + 'Fcfa');
                }
            
            },
            error: function() {
                $('#message').show();
                $('#btn_fermer').hide();
                $('#btn_ouvert').hide();
                $('#chargement').hide();
                $('#div_operation').hide();
            }
        });
    }

    window.Verfication_solde = function () 
    {

        $.ajax({
            url: '/api/caisseVerf',
            method: 'GET',
            success: function(response) {
                const data = response.data;

                $('#solde').show();
                $('#solde').text(data.solde.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + 'Fcfa');
            
            },
            error: function() {
                console.log('une erreur est survenue lors de l\'actualisation de solde')
            }
        });
    }

    window.Ouverture_caisse = function () 
    {
        let id_agence = $('#id_agence').val();
        let login = $('#login').val();

        $('#chargement').show();
        $('#btn_fermer').hide();
        $('#btn_ouvert').hide();
        $('#div_operation').hide();

        $.ajax({
            url: '/api/caisseOuvert/'+id_agence+'/'+login,
            method: 'GET',
            success: function(response) {
                $('#chargement').hide();

                if (response.success) {
                    $('#btn_ouvert').hide();
                    $('#btn_fermer').show();
                    $('#div_operation').show();
                    list_operation_all();
                } else {
                    $('#btn_ouvert').show();
                    $('#btn_fermer').hide();
                    $('#div_operation').hide();
                }
            
            },
            error: function() {
                $('#chargement').hide();
                $('#btn_fermer').hide();
                $('#btn_ouvert').show();
                $('#div_operation').hide();
                $('#message').show();
            }
        });
    }

    window.Fermeture_caisse = function () 
    {
        let id_agence = $('#id_agence').val();
        let login = $('#login').val();

        $('#chargement').show();
        $('#btn_fermer').hide();
        $('#btn_ouvert').hide();
        $('#div_operation').hide();

        $.ajax({
            url: '/api/caisseFermer/'+id_agence+'/'+login,
            method: 'GET',
            success: function(response) {
                $('#chargement').hide();

                if (response.success) {
                    $('#btn_ouvert').show();
                    $('#btn_fermer').hide();
                    $('#div_operation').hide();
                } else {
                    $('#btn_ouvert').hide();
                    $('#btn_fermer').show();
                    $('#div_operation').show();
                }
            
            },
            error: function() {
                $('#chargement').hide();
                $('#btn_fermer').show();
                $('#btn_ouvert').hide();
                $('#div_operation').show();
                $('#message').show();
            }
        });
    }

    $('#btn_fermer').on('click', function() {

        Fermeture_caisse();
    });

    $('#btn_ouvert').on('click', function() {

        Ouverture_caisse();
        Verfication_solde();
    });

});