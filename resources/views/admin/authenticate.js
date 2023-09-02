// function to validate the authentification form.
let authenticate_form = $("#authenticate_form").validate({
    // the rules that the input field need to abide to. 
    rules: {
        email_address_auth: {
            required: true,
            email: true,
        },
        password_auth: {
            required: true,
        },
    },
    // the error bootstrap class the the error message needs.
    errorClass: "text-danger",

    // if everything else mathces, the submitHandler handles the request to the server
    // this creates a query with the database. 
    submitHandler: (form) => {

        // asynchronous request to the database server from the nginx server. 
        $.ajax({
            // the listening server side url. 
            url: "/resources/views/admin/queries/check_user_authentication",
            type: "POST",
            data: $(form).serialize(),
        }).done((response) => {
            const arr = JSON.parse(response);
            if (arr.success === true) {
                auth_modal.modal("hide");
                modal_aside_left.modal({
                    show: true,
                    keyboard: false,
                    backdrop: "static",
                });
            } else {
                const auth_fail_ = $("#auth_fail_").html(`
                    <div class="alert alert-danger" role="alert">
                                <p><strong>${arr.message}</strong></p>
                    </div>
                    `);

            }

        });

    }
});

