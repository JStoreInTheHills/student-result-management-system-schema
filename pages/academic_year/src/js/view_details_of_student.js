// Declaration of a string holding the URI location values.
const stid_id_queryString = window.location.search;
// Creating an object that holds the values of the argurments in the URI.
// The URI is passed as an argurment.
const student_id_urlParams = new URLSearchParams(stid_id_queryString);
// Variable holding the value of the class unique id
const stid = student_id_urlParams.get("stid");

// declared variables in the DOM. 
const title = $("#title"),
    heading = $("#heading"),
    students_name = $("#students_name"),
    isActive = $("#status"),
    gender = $("#Gender"),
    RegDate = $("#RegDate"),
    RollId = $("#RollId"),
    error = $("#error"),
    class_name = $("#class_name"),
    year_name = $("#academic_year"), class_teacher = $("#class_teacher"),
    markStudentBtn = $("#markStudentBtn");


let has_student_completed;

const mark_as_complete_btn = $("#mark_as_complete_btn");

async function fetch_student_details() {
    // we fetch the academic_year_class_students details (active, name, hasCompleted). 
    const response = await fetch(`../../../../queries/view_details_of_students/get_student_details?stid=${stid}`);
    const data = await response.text();
    const parsed = JSON.parse(data);

    const student_details = parsed;

    // ---------------- function to fill the student details for the student details page 
    fill_student_details_in_page(student_details);

    // if hasCompleted is 0 then button is Mark student as complete
    // else mark the student incomplete. 

    // if the students status is inactive the button becomes disabled and a 
    // message on the screen showing that you need to activate the student. 
    //# join btn academic_year, academic_year_class, academic_class_student # 

}
// we fetch the academic_class details (academic_class)
// if the class status is inactive then the button needs to be disabled.  

// a button to turn the student to complete or notComplete

fetch_student_details();

// ----------------- fxn to fill student details in the page
function fill_student_details_in_page(student_details) {
    student_details.forEach(element => {
        title.html(`${element.first_name} ${element.middle_name} ${element.last_name} | ${element.roll_id}`);
        heading.html(`${element.first_name} ${element.middle_name} ${element.last_name} - (${element.roll_id})`);
        students_name.html(`${element.first_name} ${element.middle_name} ${element.last_name}`);
        RollId.html(`${element.roll_id}`);
        RegDate.html(`${element.created_at}`);
        class_name.html(element.class_name);

        year_name.html(element.academic_name);

        class_teacher.html(`${element.teacher_name1} ${element.teacher_name2}`);

        // initialize the has_student_completed field with value from the database. 
        has_student_completed = element.hasCompleted;

        // fxn to get the hasCompleted_status of the student, the parameter used is the object fetched from the database.
        get_students_hasComplete_status();

        // fxn to get the gender of a student, the parameter used is the object fetched from the database. 
        get_gender_of_student(element);

        // fxn to check to see if the studentis active, the parameter used is object fetched from the database. 
        check_to_see_if_student_is_active(element);
    });
}

// -------------------- fxn to check if the student is active in the student table. 
// -------------------- possibilities of this is when the student no longer attend classes. 
function check_to_see_if_student_is_active(element) {
    if (element.isActive == 1) {
        isActive.html(`<span class="badge badge-pill badge-success">Active</span>`);
        error.html(`
             <div class="alert alert-warning" role="alert">
                        <h6 class="alert-heading">
                            <strong>This page contains information about the student details in the academic year class.
                                Use this page to mark student as either complete or incomplete.</strong></h6>
                        <hr>
                        <p class="mb-0">Use the tables below to view more details of the student.</p>
                    </div>
        `)
    } else {
        isActive.html(`<span class="badge badge-pill badge-danger">InActive</span>`);
        $("#markStudentBtn").prop("disabled", true);
        error.html(`
             <div class="alert alert-danger" role="alert">
                        <h6 class="alert-heading">
                            <strong>Info: The current student is inactive, consult your system administrator for guidance on 
                            activation of this student. </strong></h6>
                        <hr>
                        <p class="mb-0">You cannot perform operations on an inactive student.</p>
                    </div>
        
        `)
    }
}

// fxn to check the gender of the student and populate it on the page. 
// 1 - Male, 2 - Female. 
function get_gender_of_student(element) {
    if (element.gender == 1) {
        gender.html(`Male`);
    } else {
        gender.html(`Female`);
    }
}

// fxn to mark student as either complete or incomplete. 
// incomplete students cannot move to the next class. 
function get_students_hasComplete_status() {
    if (has_student_completed == 1) {
        markStudentBtn.html("Mark as Incomplete");
    } else {
        markStudentBtn.html("Mark as Complete");
    }
}


// // fxn to markstudent as complete, we open a left modal, where a password of the administrator has to be entered inorder to 
// // authenticate the process. 
// const auth_modal = $("#auth_modal").modal({
//     show: true,
// });

