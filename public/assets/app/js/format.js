$(document).ready(function () {

    window.formatDate = function (dateString) {

        const date = new Date(dateString);
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
        const year = date.getFullYear();

        return `${day}/${month}/${year}`; // Format as dd/mm/yyyy
    }

    window.formatDateHeure = function (dateString) {

        const date = new Date(dateString);
            
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();

        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        const seconds = String(date.getSeconds()).padStart(2, '0');

        return `${day}/${month}/${year} à ${hours}:${minutes}:${seconds}`;
    }

    window.calculAge = function (dateString) {

        const birthDate = new Date(dateString);
        const today = new Date();

        let age = today.getFullYear() - birthDate.getFullYear();

        // Vérifie si l'anniversaire n'est pas encore passé cette année
        const monthDiff = today.getMonth() - birthDate.getMonth();
        const dayDiff = today.getDate() - birthDate.getDate();
        if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
            age--;
        }

        return age;
    }

    window.numberTel = function (id) {
        var inputElement = $(id); // Sélectionner l'élément avec son ID

        // Permettre uniquement les chiffres lors de la saisie
        inputElement.on('keypress', function (event) {
            const key = event.which || event.keyCode; // Récupérer le code de la touche
            // Vérifier si la touche n'est pas un chiffre ou les touches spéciales (backspace, delete, tab, etc.)
            if (
                (key < 48 || key > 57) && // Chiffres (0-9)
                key !== 8 && // Backspace
                key !== 46 && // Delete
                key !== 9 // Tab
            ) {
                event.preventDefault();
            }
        });

        // Écouter l'événement 'input' pour valider et nettoyer la saisie
        inputElement.on('input', function () {
            $(this).val($(this).val().replace(/[^0-9]/g, '')); // Remplacer tout ce qui n'est pas un chiffre
        });
    };

    window.numberTelLimit = function (id) {
        var inputElement = $(id); // Sélectionner l'élément avec son ID

        inputElement.on('input', function () {
            let value = $(this).val(); // Récupérer la valeur actuelle
            if (value.length > 10) {
                value = value.substring(0, 10); // Limiter à 10 caractères
            }
            $(this).val(value); // Mettre à jour la valeur nettoyée et limitée
        });
    };


});
