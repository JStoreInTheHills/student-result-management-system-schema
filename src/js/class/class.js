/**
 * This is the official javascript file for class page.
 */

const title = $("#title").html("Manage || Classes");

// classtable datatables. 
const classTable = $("#class_table").DataTable({
  autoWidth: true,
  info: true,
  ajax: {
    url: "queries/classes/get_all_classes.php",
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
        class_name: "class_name",
        class_id: "class_id",
      },
      render: function (data) {
        return `<a href="./view/class_view?classid=${data.class_id}">${data.class_name}</a>`;
      },
    },
    {
      targets: 2,
      data: "class_code",
    },
    {
      targets: 3,
      data: "stream_name"
    },
    {
      targets: 4,
      data: "isActive",
      render: function (data) {
        if (data === "1") {
          return `<span class="badge badge-pill badge-success">Active</span>`;
        } else {
          return `<span class="badge badge-pill badge-danger">Closed</span>`;
        }
      }
    }
  ],
});

// select2 to pick the streams to populate. 
const stream_id = $("#stream_id").select2({
  placeholder: "Type to Search Stream",
  theme: "bootstrap4",
  width: "100%",
  ajax: {
    url: "queries/classes/get_all_class_during_add_stream.php",
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
  },
});

const classForm = $("#class_form").validate({
  rules: {
    class_name: {
      required: true,
    },
    class_code: {
      required: true,
      maxlength: 4,
    },
    stream_id: {
      required: true,
    },
  },
  errorClass: "text-danger",

  invalidHandler: function (event, validator) {
    var errors = validator.numberOfInvalids();
    if (errors) {
      var message =
        errors == 1 ? "You missed 1 field" : `You missed ${errors} fields`;
      $("div.error span").html(message);
      $("div.error").show();
    } else {
      $("div.error").hide();
    }
  },

  submitHandler: function (form) {
    $.ajax({
        url: "queries/classes/add_class.php",
        method: "POST",
        data: $(form).serialize(),
      })
      .done(function (response) {
        let arr = JSON.parse(response);
        if (arr.success === true) {
          iziToast.success({
            title: "Success",
            position: "bottomLeft", // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
            message: arr.message,
            transitionIn: "bounceInLeft",
            onClosed: () => {
              classTable.ajax.reload(null, false);
              $("#class_form").each(function () {
                this.reset();
              });
            },
          });
        } else {
          iziToast.error({
            title: "Error",
            position: "bottomLeft",
            message: arr.message,
          });
        }
      })
      .fail(() => {
        iziToast.error({
          title: "Error",
          position: "topRight", // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
          message: "POST URI not found. ",
        });
      });
  },
});

$('[data-toggle="datepicker"]').datepicker({
  format: "dd-mm-yyyy",
  autoHide: true,
});

let toast = {
  question: () => {
    return new Promise((resolve) => {
      iziToast.error({
        title: "Warning!",
        titleSize: 40,
        message: "Are you sure you want to delete this stream? This process is Irreversible",
        timeout: 200000,
        close: false,
        overlay: true,
        position: "center",
        buttons: [
          [
            "<button><b>YES</b></button>",
            function (instance, toast, button, e, inputs) {
              instance.hide({
                transitionOut: "fadeOut"
              }, toast, "button");
              resolve();
            },
            false,
          ],
          [
            "<button>NO</button>",
            function (instance, toast, button, e, inputs) {
              instance.hide({
                transitionOut: "fadeOut"
              }, toast, "button");
            },
          ],
        ],
      });
    });
  },
};

const del = (data) => {
  toast.question().then(function () {
    $.ajax({
        url: "./queries/delete_class.php",
        type: "POST",
        data: {
          id: data,
        },
      })
      .done(function (response) {
        let s = JSON.parse(response);
        if (s.success === true) {
          iziToast.success({
            type: "Success",
            position: "topRight",
            transitionIn: "bounceInLeft",
            message: s.message,
            overlay: true,
            onClosing: function () {
              classTable.ajax.reload(null, false);
            },
          });
        } else {
          iziToast.error({
            type: "Error",
            message: s.message,
            overlay: true,
          });
        }
      })
      .fail(function () {
        iziToast.error({
          type: "Error",
          message: "Error",
        });
      });
  });
};


setInterval(() => {
  classTable.ajax.reload(null, false);
  streamFunction();
}, 1000000);
