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

        let ageYears = today.getFullYear() - birthDate.getFullYear();
        let monthDiff = today.getMonth() - birthDate.getMonth();
        let dayDiff = today.getDate() - birthDate.getDate();

        // Ajustement pour les mois et jours
        if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
            ageYears--;
            monthDiff += 12; // Compte les mois restants de l'année précédente
        }

        // Ajustement des jours pour éviter des mois incomplets
        if (dayDiff < 0) {
            const prevMonth = new Date(today.getFullYear(), today.getMonth(), 0); // Dernier jour du mois précédent
            dayDiff += prevMonth.getDate();
            monthDiff--;
        }

        // Si l'âge est inférieur à un an, retourner les mois et jours
        if (ageYears === 0) {
            if (monthDiff === 0) {
                return `${dayDiff} jour${dayDiff > 1 ? 's' : ''}`; // Retourne les jours si < 1 mois
            }
            return `${monthDiff} mois${dayDiff > 0 ? ` et ${dayDiff} jour${dayDiff > 1 ? 's' : ''}` : ''}`;
        }

        // Retourne l'âge en années
        return `${ageYears} an${ageYears > 1 ? 's' : ''}`;
    };


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

    window.formatPrice = function (prix) {
        // Remove all non-numeric characters except the comma
        prix = prix.replace(/[^\d,]/g, '');

        // Convert comma to dot for proper float conversion
        prix = prix.replace(',', '.');

        // Convert to float and round to the nearest whole number
        let number = Math.round(parseInt(prix));
        if (isNaN(number)) {
            return '';
        }

        // Format the number with dot as thousands separator
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

});
