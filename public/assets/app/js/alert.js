$(document).ready(function () {

    window.showAlert = function (title, message, icon) {
        Swal.fire({
            title: title,
            text: message,
            icon: icon,
        });
    }

    window.showAlert2 = function (title, message, icon) {
        NioApp.Toast(
            `<p>${message}.</p>`, 
            `${icon}`, 
            {
                position: "top-center"
            }
        );
        // `<h5>${title}</h5><p>${message}.</p>`, 
    }

});
