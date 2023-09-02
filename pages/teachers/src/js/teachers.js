  const county_address = $("#county_id"); // placeholder for county select dropdown/
  const teachers_spec = $("#teachers_spec"); // placeholder for the teachers subject dropdown.

  const title = $("#title").html("Manage || Teachers");

  const teacher_table = $("#teachers_table").DataTable({
    autoWidth: true,
    ajax: {
      url: "./queries/teachers/getTeachers.php",
      type: "GET",
      dataSrc: "",
    },
    columnDefs: [{
        targets: 0,
        data: "created_at",
      },
      {
        targets: 1,
        data: {
          first_name: "first_name",
          second_name: "second_name",
          last_name: "last_name",
          teacher_id: "teacher_id",
          username: "username"
        },
        render: (data) => {
          let teacher = `${data.first_name} ${data.second_name} ${data.last_name}`
          return `<a href="./views/view_teachers?teachers_id=${data.teacher_id}">${teacher} ~ ${data.username} <a>`;
        },
      },
      {
        targets: 2,
        data: "id_no",
      },
      {
        targets: 3,
        data: "email_address",
        render: function (data) {
          return `<a href="mailto:${data}">${data}</a>`;
        },
      },
      {
        targets: 4,
        data: "phone_number",
      },
      {
        targets: 5,
        data: "isActive",
        render: function (data) {
          if (data === "1") {
            return `<span class="badge badge-pill badge-success">Active</span>`;
          } else {
            return `<span class="badge badge-pill badge-danger">In Active</span>`;
          }
        },
      },
    ],
  });

  const teachers_userId = $("#teachers_userId").select2({
    theme: "bootstrap4",
    placeholder: "Type to search for username",
    width: "100%",
    ajax: {
      url: "./queries/teachers/getUsersIdToFillTheOption",
      type: "POST",
      dataType: "json",
      delay: 250,
      data: function (params) {
        return {
          searchTerm: params.term,
        };
      },
      processResults: function (response) {
        return {
          results: response,
        };
      },
      cache: true,
    }
  });

  const teachers_form = $("#teachers_form").validate({
    errorClass: "text-danger",
    submitHandler: function (form) {
      $.ajax({
        type: "POST",
        url: "./queries/teachers/insertTeachers",
        data: $(form).serialize(),
      }).done((response) => {
        let res = JSON.parse(response);

        if (res.success === true) {
          iziToast.success({
            title: "Success",
            icon: "fas fa-user",
            transitionIn: "bounceInLeft",
            position: "topRight",
            message: res.message,
            onClosing: function () {
              teacher_table.ajax.reload(null, false);
              $("#add_class_teacher").modal({
                show: false
              });
              $("#teachers_form").each(function () {
                this.reset();
              });
            },
          });
        } else {
          iziToast.error({
            title: "Error",
            icon: "fas fa-user",
            transitionIn: "bounceInLeft",
            position: "bottomRight",
            message: res.message,
          });
        }
      })
    }
  })

  // const getCounties = () => {
  //   $.ajax({
  //     url: "./queries/get_counties.php",
  //     dataSrc: "",
  //   }).done(function (response) {
  //     let res = JSON.parse(response);
  //     res.forEach((element) => {
  //       county_address.append(
  //         `<option value="${element.id}">${element.code} ~ ${element.name}</option>`
  //       );
  //     });
  //   });
  // };
  // getCounties();

  // const getSubjects = () => {
  //   $.ajax({
  //     url: "./queries/get_subjects.php",
  //     type: "GET",
  //     dataSrc: "",
  //   }).done((response) => {
  //     const result = JSON.parse(response);
  //     result.forEach((element) => {
  //       teachers_spec.append(
  //         `<option value = "${element.subject_id}">${element.SubjectName}</option>`
  //       );
  //     });
  //   });
  // };
  // getSubjects();

  // function getTeacherUsersId() {
  //   $.ajax({
  //     url: "./queries/getUsersIdToFillTheOption",
  //     type: "GET",
  //   }).done((resp) => {
  //     const r = JSON.parse(resp);
  //     r.forEach((item) => {
  //       teachers_userId.append(
  //         `<option class="text-primary" value=${item.user_id}>${item.username} ~ ( ${item.email_address} )</option>`
  //       );
  //     });
  //   });
  // }

  // getTeacherUsersId();

  // const questionToast = {
  //   question: () => {
  //     return new Promise((resolve) => {
  //       iziToast.question({
  //         title: "Warning",
  //         icon: "fas fa-exclamation-triangle",
  //         message: "Are you Sure you want to delete this teacher?",
  //         timeout: 20000,
  //         close: false,
  //         position: "center",
  //         buttons: [
  //           [
  //             "<button><b>YES</b></button>",
  //             function (instance, toast, button, e, inputs) {
  //               instance.hide({
  //                 transitionOut: "fadeOut"
  //               }, toast, "button");
  //               resolve();
  //             },
  //             false,
  //           ],
  //           [
  //             "<button>NO</button>",
  //             function (instance, toast, button, e, inputs) {
  //               instance.hide({
  //                 transitionOut: "fadeOut"
  //               }, toast, "button");
  //             },
  //           ],
  //         ],
  //       });
  //     });
  //   },
  // };

  // const deleteTeacher = (teachers_id) => {
  //   questionToast.question().then(function () {
  //     $.ajax({
  //         url: "./queries/delete_teacher.php",
  //         type: "POST",
  //         data: {
  //           teachers_id: teachers_id,
  //         },
  //       })
  //       .done(function (response) {
  //         let r = JSON.parse(response);
  //         if (r.success === true) {
  //           iziToast.success({
  //             type: "Success",
  //             position: "topRight",
  //             message: r.message,
  //             onClosing: function () {
  //               teacher_table.ajax.reload(null, false);
  //             },
  //           });
  //         }
  //       })
  //       .fail(function () {
  //         iziToast.error({
  //           type: "Error",
  //           message: "Error Check Again",
  //         });
  //       });
  //   });
  // };

  // const getTeachersCount = () => {
  //   $.ajax({
  //     url: "./queries/get_teachers_count.php",
  //     type: "GET",
  //   }).done((response) => {
  //     let teachers = JSON.parse(response);
  //     teachers.forEach((i) => {
  //       $("#all_students").html(`${i.teachers}`);
  //     });
  //   });
  // };
  // getTeachersCount();