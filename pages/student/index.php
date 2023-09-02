<?php ?>

<!DOCTYPE html>
<html lang="en">
<?php include "../../resources/views/css_files.html";?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include "../../resources/views/sidebar.html"; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div class="content">
                <?php include '../../resources/views/topbar.php'; ?>

                <div class="container-fluid">

                    <!-- Previous button -->
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <a class="btn btn-md text-primary mb-2" onclick="goBack()"> <i class="fas fa-arrow-left"></i>
                            Back
                            to previous page</a>
                    </div>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Manage All Students</h1>

                        <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#add_student_modal">Add
                            New Student</button>
                    </div>

                    <nav aria-label="breadcrumb mb-3">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/index">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Manage All Students</li>
                        </ol>
                    </nav>

                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Use this page to manage all the students. Click on a student
                            to view more details about the student and also add more students details. </strong>
                        <hr>
                        Click on Add New Student to add a new student.
                    </div>

                    <!-- horizontal line  -->
                    <hr class="my-3">

                    <!-- nav tab to help navigate easily on the page other than a long scroll -->
                    <nav class="mb-4">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <!-- the active student nav item -->
                            <a class="nav-item nav-link active" id="nav-active-student-tab" data-toggle="tab"
                                href="#nav-active-student" role="tab" aria-controls="nav-academic-term"
                                aria-selected="true"> <span><i class="fas fa-users"></i></span> Manage Active Students
                            </a>

                            <!-- the inactive students nav item -->
                            <a class="nav-item nav-link" id="nav-inactive-student-tab" data-toggle="tab"
                                href="#nav-inactive-student" role="tab" aria-controls="nav-academic-year-performance"
                                aria-selected="false"> <span><i class="fas fa-book-reader"></i></span> Manage Inactive
                                Students </a>
                        </div>
                    </nav>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-active-student" role="tabpanel"
                            aria-labelledby="nav-active-student-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        <strong>This tab pane shows all the active students in the school.
                                        </strong>
                                        <hr>
                                        Click on a student to view more details about the student.
                                    </div>

                                    <div class="card shadow mb-4">
                                        <div class="card-header d-sm-flex align-items-center justify-content-between">
                                            <span class="text-primary font-weight-bold">Manage Active Students</span>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped" width="100%" cellspacing="0"
                                                    id="student_table">
                                                    <thead>
                                                        <tr>
                                                            <th>Created At</th>
                                                            <th>Student Name</th>
                                                            <th>Adm No.</th>
                                                            <th>Gender</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="nav-inactive-student" role="tabpanel"
                            aria-labelledby="nav-inactive-student-tab">

                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>This tab pane shows all the inactive students in the school.
                                        </strong>
                                        <hr>
                                        Click on a student to view more details about the student, you can also make a student active.
                                    </div>

                            <div class="card shadow mb-4">
                                <div class="card-header d-sm-flex align-items-center justify-content-between">
                                    <span class="text-primary font-weight-bold">Inactive Students</span>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" width="100%" cellspacing="0"
                                            id="inactive_student_table">
                                            <thead>
                                                <tr>
                                                    <th>Created At</th>
                                                    <th>Student Name</th>
                                                    <th>Adm No.</th>
                                                    <th>Gender</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <?php include "./_partials/add_new_student_modal.html" ?>

    <script src="/dist/js/main.min.js"></script>
    <script src="/dist/js/utils/utils.js"></script>
    <script src="/dist/js/students/student.js"></script>
</body>

</html>