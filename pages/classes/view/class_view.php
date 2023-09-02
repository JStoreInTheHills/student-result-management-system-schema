<?php 

// include "../../layouts/utils/redirect.php";

// if(!isset($_SESSION['alogin']) || (time() - $_SESSION['last_login_timestamp']) > 1500 || !isset($_SESSION['role_id'])){
//     redirectToHomePage();
// }else{
//       $_SESSION['last_login_timestamp'] = time();
  ?>
<!DOCTYPE html>
<html lang="en">

<?php include "../../../resources/views/css_files.html";?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include "../../../resources/views/sidebar.html"; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include '../../../resources/views/topbar.php' ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-3">
                        <h1 class="h2 mb-0 text-gray-800" id="heading"></h1>

                        <div class="btn-group">

                            <button class="btn btn-md btn-primary" type="button" data-toggle="modal"
                                data-target="#modal_aside_left">
                                Add Class Teacher</button>

                            <button class="btn btn-sm btn-outline-primary" type="button" data-toggle="modal"
                                data-target="#edit_this_class">
                                Edit this Stream
                            </button>


                        </div>
                    </div>

                    <div class="d-sm-flex align-items-center justify-content-between mb-2">
                        <h5 class="h5 mb-0 " id="class_teacher"><span><i class="text-gray-800"> Stream Name:
                                    <a id="stream2_name" href=""></a> </i></span> </h1>

                            <h5 class="h5 mb-0 " id="creation_date"> Date Class Was Created: <span><i
                                        class="text-gray-800" id="creationdate"></i></span> </h1>
                    </div>

                    <div class="d-sm-flex align-items-center justify-content-between mb-2">
                        <h5 class="h5 mb-0" id="class_teacher"><span><i class="text-gray-800"> Stream Teachers Name: <a
                                        id="classTeacher"></a></i></span> </h1>

                    </div>

                    <div class="alert alert-info" role="alert">
                        <h6 class="alert-heading"><strong>Use this page to view, edit and add exams and students for the
                                stream.
                            </strong></h6>
                        <hr>
                        <p class="mb-0">Use the cards to monitor your students and the number of exams the class has sat
                            for.</p>
                    </div>

                    <nav aria-label="breadcrumb mb-3">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/index">Home</a></li>
                            <li class="breadcrumb-item"><a href="/class/class">Class</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a id="bread_list"></a></li>
                        </ol>
                    </nav>

                    <hr class="my-2">

                    <!-- <div class="row"> -->
                    <!-- Total Students -->
                    <!-- <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs text-primary font-weight-bold text-uppercase mb-1">Total
                                                Students
                                            </div>
                                            <a class="h4 mb-0 font-weight-bold text-gray-800" href="#view_class_student"
                                                id="total_students_in_class"></a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                    <!-- Exams Declared -->
                    <!-- <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs text-primary font-weight-bold text-uppercase mb-1">Total
                                                Exams
                                            </div>
                                            <a class="h4 mb-0 font-weight-bold text-gray-800"
                                                id="total_exams_in_class"></a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-edit fa-2x text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                    <!-- Subjects Declared -->
                    <!-- <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs text-primary font-weight-bold text-uppercase mb-1">Total
                                                Subjects
                                            </div>
                                            <a class="h4 mb-0 font-weight-bold text-gray-800"
                                                id="total_subjects_in_class"></a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-graduate fa-2x text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> -->

                    <!-- <nav class="mb-4">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#exams"
                                role="tab" aria-controls="exams" aria-selected="true"> <span><i
                                        class="fas fa-chalkboard "></i></span> Exams </a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#students"
                                role="tab" aria-controls="students" aria-selected="false"> <span><i
                                        class="fas fa-users"></i></span> All Students</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#subjects"
                                role="tab" aria-controls="nav-contact" aria-selected="false"> <span><i
                                        class="fas fa-address-book"></i></span> All Subjects and Teachers </a>
                        </div>
                    </nav> -->

                    <!-- Content Row -->
                    <!-- <div class="row">
                        <div class="col-lg-12">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="exams" role="tabpanel"
                                    aria-labelledby="nav-home-tab">

                                    <div class="alert alert-primary" role="alert">
                                        <h6 class="alert-heading">This is the Exam card and tab. It holds the exam
                                            performance chart and the exams table.</h6>
                                        <hr>
                                        <p class="mb-0">Use the cards to monitor your students and the number of exams
                                            the class has sat for.</p>
                                    </div>

                                    <div class="card mb-2">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Class Exam Charts</h6>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="exams_charts" height="60"></canvas>
                                        </div>
                                    </div>
                                    <div class="card shadow mb-2">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">All Class Exams</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="view_class_exams" width="100%"
                                                    cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>Published At</th>
                                                            <th>Exam Name</th>
                                                            <th>Term Name</th>
                                                            <th>Exam Period</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="students" role="tabpanel"
                                    aria-labelledby="nav-profile-tab">
                                    <div class="card mb-4 shadow">
                                        <div class="card-header text-primary">
                                            <span><i class="fas fa-users"></i></span>
                                            Class Students
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="view_class_student" width="100%"
                                                    cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>Student Name</th>
                                                            <th>Adm No</th>
                                                            <th>Reg Date</th>
                                                            <th>Gender</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>

                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="subjects" role="tabpanel"
                                    aria-labelledby="nav-contact-tab">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="view_class_subjects" width="100%"
                                                    cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>Subject Name</th>
                                                            <th>Subject Code</th>
                                                            <th>Subject Teacher</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>

                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include '../../../resources/views/footer.html' ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <?php include '../../resources/views/logout_modal.html' ?>

    <?php include "./modals/add_class_exam.html" ?>

    <!-- Add class teacher to the class modal -->
    <?php include "./includes/add_class_teacher.html" ?>

    <?php include "./modals/edit_this_class.html" ?>

    <script src="/dist/js/main.min.js"></script>
    <script src="/dist/js/utils/utils.js"></script>
    <script src="/dist/js/classes/view_class.js"></script>
</body>


</html>
<?php #} ?>