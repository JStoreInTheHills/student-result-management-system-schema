// setting the page title. 
const title = $("#title").html("Manage Students");

// table holding all the student in the school, and all their attributes. 
const student_table = $("#student_table").DataTable({
    ajax: {
        url: "./queries/students/to_populate_the_student_datatables_table.php",
        type: "GET",
        dataSrc: ""
    },
    columnDefs: [{
            targets: 0,
            data: "created_at",
        },
        {
            targets: 1,
            data: {
                first_name: "first_name",
                middle_name: "middle_name",
                last_name: "last_name",
                students_id : "students_id"
            },
            render: ((data) => {
                return `<a href="./views/student_details?s_id=${data.students_id}">${data.first_name} ${data.middle_name} ${data.last_name}</a>`;
            })
        }, {
            targets: 2,
            data: "roll_id",
        },
        {
            targets: 3,
            data: "gender",
            render: ((data) => {
                if (data == 1) {
                    return "Male"
                } else {
                    return "Female"
                }
            })
        },
        {
            targets: 4,
            data: "isActive",
            render: ((data) => {
                if (data === "1") {
                    return `<span class="badge badge-pill badge-success">Active</span>`;

                } else {
                    return `<span class="badge badge-pill badge-danger">Inactive</span>`;

                }
            })
        }
    ]
});

// the student modal form validation, checks to see if all the conditions are met during form submittion.
const add_student_form = $("#add_student_form").validate({
    // the rules to be followed
    rules: {
        first_name: "required",
        middle_name: "required",
        last_name: "required",
        gender: "required",
        roll_id: "required"
    },

    errorClass: "alert alert-danger",
    // messages to be shown if the rules are not followed
    messages: {
        first_name: "This field is required",
        middle_name: "Middle Name is required",
        last_name: "Last name is required",
        roll_id: "Admission Number is required",
        gender: "Gender is required."
    },
    // the submitHandler to send the request to the server when all the field have met the condition
    submitHandler: (form) => {
        $.ajax({
            url: "./queries/students/to_add_students_to_the_datatables.php",
            type: "POST",
            data: $(form).serialize()
        }).done((response) => {
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
                        student_table.ajax.reload(null, false);
                        $("#add_student_form").each(function () {
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
        })
    },
    // errorHandler to handle errors in the form submittion.    
    invalidHandler: function (event, validator) {
        // 'this' refers to the form
        var errors = validator.numberOfInvalids();
        if (errors) {
            var message = errors == 1 ?
                'You missed 1 field. It has been highlighted' :
                'You missed ' + errors + ' fields. They have been highlighted';
            $("div.error span").html(message);
            $("div.error").show();
        } else {
            $("div.error").hide();
        }
    }
})

// the date of birth bootstrap datepicker 
$('[data-toggle="datepicker"]').datepicker({
    format: "yyyy-mm-dd",
    autoHide: true,
});

// inactive student datatables holding student who are inactive. 
const inactive_student_table = $("#inactive_student_table").DataTable({});