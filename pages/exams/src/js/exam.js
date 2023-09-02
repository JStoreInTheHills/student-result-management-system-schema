const title = $("#title").html("Manage || Exams");
const exam_table = $("#exam_table").DataTable({
    ajax: {
        url: "./queries/populate_the_exam_datatables.php",
        type: "GET",
        dataSrc: "",
    },
    order: [
        [2, "desc"]
    ],
    columnDefs: [{
            targets: 0,
            data: "created_at",
        }, {
            targets: 1,
            data: "exam_name"
        },
        {
            targets: 2,
            data: "exam_out_of"
        },
        {
            targets: 3,
            data: "isActive",
            render: (data) => {
                if (data == "1") {
                    return `<span class="badge badge-pill badge-success">Active</span>`;
                } else {
                    return `<span class="badge badge-pill badge-danger">InActive</span>`;
                }
            }
        }
    ]
});
const exam_form = $("#exam_form").validate({
    rules: {
        exam_name: "required",
        exam_out_of: {
            required: true,
            number: true,
        },
    },
    messages: {},
    submitHandler: (form) => {
        $.ajax({
            url: "./queries/insert_exam_to_the_database.php",
            type: "POST",
            data: $(form).serialize(),
        }).done(function (response) {
            var r = JSON.parse(response);
            if (r.success === true) {
                iziToast.success({
                    message: r.message,
                    position: "bottomLeft",
                    type: "Success",
                    transitionIn: "bounceInLeft",
                    overlay: true,
                    zindex: 999,
                    messageColor: "black",
                    onClosing: function () {
                        exam_table.ajax.reload(null, false);
                        $("#exam_form").each(function () {
                            this.reset();
                        });
                    },
                    progressBar: false,
                });
            } else {
                iziToast.error({
                    message: r.message,
                    position: "bottomLeft",
                    type: "Error",
                    overlay: true,
                    zindex: 999,
                    transitionIn: "bounceInLeft",
                    progressBar: false,
                    messageColor: "black",
                });
            }
        });
    },
    invalidHandler: function (event, validator) {
        var errors = validator.numberOfInvalids();
        if (errors) {
            var message =
                errors == 1 ? "You missed 1 field" : `You missed ${errors} fields`;
            $("div.errors span").html(message);
            $("div.errors").show();
        } else {
            $("div.errors").hide();
        }
    },
})