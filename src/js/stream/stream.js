/**
 * This is the official js page for the stream class.
 */

const stream_form = $("#stream_form");
const class_count = $("#all_classes");

const title = $("#title").html("Manage || Streams");

// This is the stream datatable.
const stream_table = $("#stream_table").DataTable({
  order: [[2, "desc"]],
  ajax: {
    url: "./queries/get_all_streams.php",
    type: "GET",
    dataSrc: "",
  },
  columnDefs: [
    {
      targets: 0,
      data: "created_at",
    },
    {
      targets: 1,
      data: {
        stream_name: "stream_name",
        stream_id: "stream_id",
      },
      render: function (data) {
        return `<a href="./views/view_stream?stream_id=${data.stream_id}">${data.stream_name}</a>`;
      },
    },
    {
      targets: 2,
      data: "stream_code",     
    },
    {
      targets: 3,
      data: "isActice",
      width: "5%",
      render: function (data) {
        if (data === "1") {
          return `<span class="badge badge-pill badge-success">Active</span>`;
        } else {
          return `<span class="badge badge-pill badge-danger">Closed</span>`;
        }
      },
    },
  ],
});

// SUBMIT FORM BUT CHECK SOME VALIDATIONS.
stream_form.validate({
  rules: {
    stream_name: "required",
    stream_code: "required"
  },
  messages: {
    stream_name: {
      required: "Class Name is required",
    },
     stream_code: {
      required: "Class code is required",
    },
  },
  errorClass: "text-danger",

  invaidHandler: (event, validator) => {
    const errors = validator.numberOfInvalids();
    if (errors) {
      var message =
        errors == 1 ? `You missed 1 field` : `You missed ${errors} fields`;
      $("#toast").html(`<div class="alert alert-danger" role="alert">
          <h4 class="alert-heading"><span><i class="fas fa-exclamation-triangle"></i></span>
          ${message}
           </h4>
          <hr>
          <p class="mb-0">${message}</p>
        </div>`);
      $("#toast").show();
    } else {
      $("#toast").hide();
    }
  },

  submitHandler: (form) => {
    $.ajax({
      url: "./queries/add_stream.php",
      method: "POST",
      data: $(form).serialize(),
      dataSrc: "",
    }).done((response) => {
      const s = JSON.parse(response);
      if (s.success === true) {
        iziToast.success({
          title: "Success",
          position: "bottomLeft",
          transitionIn: "bounceInLeft",
          overlay: true,
          message: s.message,
          onClosing: function () {
            stream_table.ajax.reload(null, false);
            all_classes();
            $("#stream_form").each(function () {
              this.reset();
            });
          },
        });
      } else {
        iziToast.error({
          title: "Error",
          overlay: true,
          progressBar: false,
          position: "bottomLeft",
          message: s.message,
          transitionIn: "bounceInLeft",
        });
      }
    });
  },
});

// Function to get all the classes in the system.
// const all_classes = () => {
//   $.ajax({
//     url: "../utils/get_all_streams.php",
//     method: "GET",
//   }).done(function (response) {
//     const res = JSON.parse(response);
//     res.forEach((i) => {
//       class_count.html(`${i.streams}`);
//     });
//   });
// };
// all_classes();

// Question Toast.
// const toast = {
//   question: () => {
//     return new Promise((resolve) => {
//       iziToast.error({
//         title: "Warning! ",
//         message: `Are you Sure you want to delete this Class? Note this will remove all the stream and exam that
//         belong to this class`,
//         timeout: 2000000,
//         close: false,
//         titleSize: "50",
//         messageColor: "black",
//         icon: "fas fa-exclamation",
//         overlay: true,
//         displayMode: "once",
//         id: "question",
//         zindex: 999,
//         position: "center",
//         buttons: [
//           [
//             "<button><b>YES</b></button>",
//             function (instance, toast, button, e, inputs) {
//               instance.hide({ transitionOut: "fadeOut" }, toast, "button");
//               resolve();
//             },
//             false,
//           ],
//           [
//             "<button>NO</button>",
//             function (instance, toast, button, e, inputs) {
//               instance.hide({ transitionOut: "fadeOut" }, toast, "button");
//             },
//           ],
//         ],
//       });
//     });
//   },
// };

// // Function to delete a stream.
// const deleteStream = (stream_id) => {
//   toast.question().then(() => {
//     $.ajax({
//       url: "./queries/delete_stream.php",
//       type: "POST",
//       data: {
//         stream_id: stream_id,
//       },
//     })
//       .done((response) => {
//         const r = JSON.parse(response);
//         if (r.success === true) {
//           iziToast.success({
//             type: "Success",
//             message: r.message,
//             position: "topRight",
//             progressBar: false,
//             transitionIn: "bounceInLeft",
//             onClosing: () => {
//               stream_table.ajax.reload(null, false);
//             },
//           });
//         } else {
//           iziToast.error({
//             type: "Error",
//             message: r.message,
//           });
//         }
//       })
//       .fail(function (response) {
//         iziToast.error({
//           type: "Error",
//           message: "Error Check Again",
//         });
//       });
//   });
// };

// Refresh the stream table.
setInterval(function () {
  stream_table.ajax.reload(null, false);
  all_classes();
}, 1000000);
