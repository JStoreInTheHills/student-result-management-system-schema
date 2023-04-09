const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);

const year_id = urlParams.get("year_id");

const all_exams_this_year = $("#all_exams_this_year");

const year_id_input = $("#year_id_input").val(year_id);



//Variable holding the year inputs
const year_form = $("#year_form");

// Edit Year button to modify the years details.
const edit_academic_year = $("#edit_academic_year");

let year_acroynm;

//Add Terms to Academic Year Form Name.
const term_name = $("#term_name").select2({
  placeholder: "Type to search an academic term",
  theme: "bootstrap4",
  width: "100%",
  ajax: {
    url: "../queries/view_academic_year/get_academic_terms.php",
    type: "POST",
    dataType: "json",
    delay: 250,
    data: function(params){
      return {
        searchTerm: params.term
      };
    }, processResults: function(response){
      return{
        results: response,
      };
    }, 
    cache: true,
  }
});

async function init() {
  const year = {};
  const request = await fetch(`../queries/academic_year/get_year_details.php?year_id=${year_id}`);
  const response = await request.text();
  const parsed = JSON.parse(response);

  parsed.forEach((item) => {
    year.year_name = item.academic_name;
    year.created_at = item.created_at;
    year.status = item.isActive;
  });

  return year;
}

const alerts = $("#alert");

async function setYearDetails() {
  const year = await init();
  $("#title").append(`Academic Year - ${year.year_name}`);
  $("#title").append(`Academic Year - ${year.year_name}`);
  $("#heading").val(`${year.year_name}`);
  $("#bread_list").html(`${year.year_name}`);
  edit_academic_year.html(`Delete This Academic Year`);
  $("#creation_date").html(`Created At : ${year.created_at}`);

  year_acroynm = year.year_name;

  if (year.status === "1") {
    $("#status").html(
      ` <span class="badge badge-pill badge-success">Active</span>`
    );
    alerts.html(`
            <div class="alert alert-info alert-dismissible fade show" role="alert">
              <strong>View Academic year ${year.year_name} and its terms. All the terms performance for the year ${year.year_name} in the school are defined on the table below.</strong>
            <hr>
              <p class="mb-0">Click on edit Academic year to modify or click on one of the terms 
                to view more details and the performance</p>
            </div>
        `);
  } else {
    $("#status").html(
      ` <span class="badge badge-pill badge-danger">InActive</span>`
    );
    alerts.html(`
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>View Academic year ${year.year_name} and its terms. All the terms performance for the year ${year.year_name} in the school are defined on the table below.</strong>
    <hr>
      <p class="mb-0">Click on edit Academic year to modify or click on one of the terms 
        to view more details and the performance</p>
    </div>
`);
  }
}
setYearDetails();

// FUNCTION TO GET THE TERMS AND PLACE THEM ON A SELECT OPTION.
// const get_terms = () => {
//   $.ajax({
//     url: "../queries/view_academic_year/get_academic_terms.php",
//     type: "GET",
//   }).done((resp) => {
//     const arr = JSON.parse(resp);

//     if (arr.length == 0) {
//       $("#card_alert")
//         .html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
//           <strong>Terms have not yet been added. </strong>
//         <hr>
//           <p class="mb-0">Please add terms to proceed</p>
//         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//             <span aria-hidden="true">&times;</span>
//         </button>
//         </div>`);

//       $("#form_submit").prop(`disable`);
//     }

//     arr.forEach((item) => {
//       term_name.append(
//         `<option value="${item.term_id}">${item.term_name}</option>`
//       );
//     });
//   });
// };

// get_terms();

year_form.submit((event) => {
  const formData = {
    year_id: year_id,
    term_id: term_name.val(),
  };
  $.ajax({
    url: "../queries/view_academic_year/add_term_to_year.php",
    type: "GET",
    dataSrc: "",
    data: formData,
  }).done((resp) => {
    const arr = JSON.parse(resp);
    if (arr.success == true) {
      iziToast.success({
        type: "Success",
        position: "bottomLeft",
        transitionIn: "bounceInLeft",
        message: arr.message,
        zindex: 999,
        overlay: true,
        onClosing: () => {
          term_year_table.ajax.reload(null, false);
        },
      });
    } else {
      iziToast.error({
        type: "Error",
        position: "bottomLeft",
        transitionIn: "bounceInLeft",
        message: arr.message,
        zindex: 999,
        overlay: true,
      });
    }
  });

  event.preventDefault();
});

const formData = {
  year_id: year_id,
};

// TABLE HOLDING THE ACADEMICS YEAR TERMS.
const term_year_table = $("#term_year_table").DataTable({
  ajax: {
    url: "./../queries/view_academic_year/get_view_academic_year_terms.php",
    dataSrc: "",
    type: "GET",
    data: formData,
  },
  columnDefs: [{
      targets: 1,
      data: {
        term_name: "term_name",
        academic_terms_id: "academic_terms_id",
      },
      render: (data) => {
        return `<a href="./view_academic_year_term_performance?academic_term_id=${data.academic_terms_id}&year_id=${year_id}">${data.term_name}</a>`;
      },
    },
    {
      targets: 0,
      data: "created_at",
    },

    {
      targets: 2,
      data: "isActive",
      render: function (data) {
        if (data === "1") {
          return `<span class="badge badge-pill badge-success">Active</span>`;
        } else {
          return `<span class="badge badge-pill badge-danger">InActive</span>`;
        }
      },
    },
    {
      targets: 3,
      data: {
        status: "status",
        term_year_id: "term_year_id",
      },
      render: (data) => {
        return `
          <div>
            <a onClick="editTermFromYear(${data.term_year_id}, ${data.status})">
              <span><i class="fas fa-edit text-primary"></i></span>
            </a>
            
            <a onClick="deleteTermFromYear(${data.term_year_id})">
              <span><i class="fas fa-trash text-danger"></i></span>
            </a>
          </div>
          `;
      },
    },
  ],
});

const questionToast = {
  question: () => {
    return new Promise((resolve) => {
      iziToast.error({
        title: "Warning",
        icon: "fas fa-exclamation-triangle",
        message: "Are you Sure you want to change the status of this term?",
        timeout: 20000,
        close: false,
        position: "center",
        buttons: [
          [
            "<button><b>YES</b></button>",
            function (instance, toast, button, e, inputs) {
              instance.hide({
                  transitionOut: "fadeOut",
                },
                toast,
                "button"
              );
              resolve();
            },
            false,
          ],
          [
            "<button>NO</button>",
            function (instance, toast, button, e, inputs) {
              instance.hide({
                  transitionOut: "fadeOut",
                },
                toast,
                "button"
              );
            },
          ],
        ],
      });
    });
  },
};

function editTermFromYear(term_id, status) {
  questionToast.question().then(function () {
    let s;
    if (status == 1) {
      s = 0;
    } else {
      s = 1;
    }
    $.ajax({
      url: "../queries/makeTermYearInactive.php",
      type: "POST",
      data: {
        status: s,
        term_year_id: term_id,
      },
    }).done(function (resp) {
      const l = JSON.parse(resp);
      if (l.success == true) {
        iziToast.success({
          type: "Success",
          message: l.message,
          position: "topRight",
          transitionIn: "bounceInRight",
          onClosing: () => {
            term_year_table.ajax.reload(null, false);
          },
        });
      } else {
        iziToast.error({
          type: "Error",
          message: l.message,
          position: "topRight",
          transitionIn: "bounceInRight",
        });
      }
    });
  });
}
// TABLE HOLDING THE CLASSES THAT BELONG TO THE ACADEMIC YEAR WHOSE ID IS year_id.
const classes_table_ = $("#classes_table_").DataTable({
  ajax: {
    url: "../queries/view_academic_year/get_all_classes_for_classes_datatable_.php",
    dataSrc: "",
    type: "GET",
    data: formData,
  },
  columnDefs: [{
      targets: 0,
      data: "created_at"
    },
    {
      targets: 1,
      data: "class_name"
    },
    {
      targets: 2,
      data: "class_code"
    },
    {
      targets: 3,
      data: {
        teacher_id: "teacher_id",
        first_name: "first_name",
        second_name: "second_name",
        last_name: "last_name"
      },
      render: function (data) {
        return `<a href="/${data.teacher_id}"> ${data.first_name} ${data.second_name} ${data.last_name}</a>`
      }
    },
    {
      targets: 4,
      data: "stream_name"
    },

    {
      targets: 5,
      data: "isActive"
    }


  ],
});

function get_all_exams_this_year() {
  $.ajax({
    url: "/utils/get_all_exams_this_year.php",
    type: "GET",
    data: {
      year_id: year_id,
    },
  }).done(function (response) {
    const j = JSON.parse(response);
    j.forEach((item) => {
      all_exams_this_year.append(`${item.exams}`);
    });
  });
}

edit_academic_year.click(() => {
  $("#modal_aside_left").modal({
    show: true,
    keyboard: false,
    backdrop: "static",
  });
});

// get_all_exams_this_year();

setInterval(() => {
  class_end_year_table.ajax.reload();
}, 10000000);
// });

async function getAllStudentsRegisteredThisYear() {
  await setYearDetails();
  let year_name = year_acroynm;
  let start_query = year_name.slice(0, 4);
  let end_query = year_name.slice(5, 9);
  const request = await fetch(
    `../queries/fetch_all_registered_students_this_year?start=${start_query}&end=${end_query}`
  );
  const response = await request.text();

  const parsed = JSON.parse(response);

  $("#all_students_registered_this_year").html(parsed);
}

// getAllStudentsRegisteredThisYear();

$(".edit_school_input").on("keypress", (e) => {
  $("#year_id").val(year_id);
  if (e.which == 13) {
    $("#edit_year_form").validate({
      rules: {
        heading: "required",
      },
      errorClass: "text-danger",
      submitHandler: (form) => {
        $.ajax({
          url: "../queries/edit_academic_year.php",
          type: "post",
          data: $(form).serialize(),
        }).done((response) => {
          const arr = JSON.parse(response);
            if (arr.success == true) {
              iziToast.success({
                position: "bottomLeft",
                message: arr.message,
                messageColor: "black",
                overlay: true,
                zindex: 999,
                progressBar: false,
                onClosing: () => {
                  setYearDetails();
                },
              });
            } else {
              iziToast.error({
                position: "bottomLeft",
                message: arr.message,
                messageColor: "black",
                overlay: true,
                zindex: 999,
                progressBar: false,
              });
            }
        });
      },
    });
  }
});

function deleteTermFromYear(id) {
  $.post("../queries/Models/term_year/delete_term_from_year.php", {
    id: id,
  }).done(function (response) {
    const arr = JSON.parse(response);
    if (arr.success == true) {
      iziToast.success({
        message: arr.message,
        position: "bottomLeft",
        overlay: true,
        zindex: 999,
        onClosing: () => {
          term_year_table.ajax.reload(null, false);
        },
      });
    } else {
      iziToast.error({
        message: arr.message,
        position: "bottomLeft",
        overlay: true,
        zindex: 999,
      });
    }
  });
}

const class_id = $("#class_id").select2({
  width: "100%",
  theme: "bootstrap4",
  placeholder: "Type class name to search",
  ajax: {
    url: "../queries/view_academic_year/get_classes_to_be_added_to_academic_year_using_select2.php",
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

const class_teacher_id = $("#class_teacher_id").select2({
  theme: "bootstrap4",
  placeholder: "Type teachers name to search",
  width: "100%",
  ajax: {
    url: "../queries/view_academic_year/get_teachers_to_be_added_to_academic_year.php",
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

const add_class_to_year_form = $("#add_class_to_year_form").validate({
  rules: {
    class_id: "required",
    class_teacher_id: "required",
  },
  message: {
    class_id: "This field is reqired",
    class_teacher_id: "Teachers is required"
  },
  errorClass: "alert alert-danger",
  submitHandler: function (form) {
    $.ajax({
      url: "../queries/view_academic_year/add_classes_to_academic_year.php",
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
            classes_table_.ajax.reload(null, false);
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