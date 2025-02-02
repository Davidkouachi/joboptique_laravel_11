$(document).ready(function () {

    $('#solde').hide();
    $('#btn_fermer').hide();
    $('#btn_ouvert').hide();
    $('#chargement').hide();
    $('#div_operation').hide();
    $('#message').hide();

    Verfication_statut();
    select_client_vente('#client');

});