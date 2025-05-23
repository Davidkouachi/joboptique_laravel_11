((o, t) => {
    t(".eg-toastr-default").on("click", function(t) {
        t.preventDefault(), toastr.clear(), o.Toast("This is a note for deafult toast message.", "info")
    }), t(".eg-toastr-bottom-center").on("click", function(t) {
        t.preventDefault(), toastr.clear(), o.Toast("This is a note for bottom center toast message.", "info", {
            position: "bottom-center"
        })
    }), t(".eg-toastr-bottom-right").on("click", function(t) {
        t.preventDefault(), toastr.clear(), o.Toast("This is a note for bottom right toast message.", "info")
    }), t(".eg-toastr-bottom-left").on("click", function(t) {
        t.preventDefault(), toastr.clear(), o.Toast("This is a note for bottom left toast message.", "info", {
            position: "bottom-left"
        })
    }), t(".eg-toastr-bottom-full").on("click", function(t) {
        t.preventDefault(), toastr.clear(), o.Toast("This is a note for bottom full width toast message.", "info", {
            position: "bottom-full"
        })
    }), t(".eg-toastr-top-center").on("click", function(t) {
        t.preventDefault(), toastr.clear(), o.Toast("This is a note for top center toast message.", "info", {
            position: "top-center"
        })
    }), t(".eg-toastr-top-right").on("click", function(t) {
        t.preventDefault(), toastr.clear(), o.Toast("This is a note for top right toast message.", "info", {
            position: "top-right"
        })
    }), t(".eg-toastr-top-left").on("click", function(t) {
        t.preventDefault(), toastr.clear(), o.Toast("This is a note for top left toast message.", "info", {
            position: "top-left"
        })
    }), t(".eg-toastr-top-full").on("click", function(t) {
        t.preventDefault(), toastr.clear(), o.Toast("This is a note for top full width toast message.", "info", {
            position: "top-full"
        })
    }), t(".eg-toastr-info").on("click", function(t) {
        t.preventDefault(), toastr.clear(), o.Toast("This is a note for bottom right toast message.", "info")
    }), t(".eg-toastr-success").on("click", function(t) {
        t.preventDefault(), toastr.clear(), o.Toast("This is a note for success toast message.", "success")
    }), t(".eg-toastr-warning").on("click", function(t) {
        t.preventDefault(), toastr.clear(), o.Toast("This is a note for warning toast message.", "warning")
    }), t(".eg-toastr-error").on("click", function(t) {
        t.preventDefault(), toastr.clear(), o.Toast("This is a note for error toast message.", "error")
    }), t(".eg-toastr-dark").on("click", function(t) {
        t.preventDefault(), toastr.clear(), o.Toast("This is dark version note of toast message.", "info", {
            ui: "is-dark"
        })
    }), t(".eg-toastr-no-icon").on("click", function(t) {
        t.preventDefault(), toastr.clear(), o.Toast("This is without icon note of toast message.", "info", {
            icon: !1
        })
    }), t(".eg-toastr-with-title").on("click", function(t) {
        t.preventDefault(), toastr.clear(), o.Toast("<h5>Update Successfully</h5><p>Your profile has been successfully updated.</p>", "success")
    })
})(NioApp, jQuery);