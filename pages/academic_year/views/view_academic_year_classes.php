<!DOCTYPE html>
<html lang="en">

<?php include "../../../resources/views/css_files.html";?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "../../../resources/views/sidebar.html"; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar  -->
                <?php include '../../../resources/views/topbar.php' ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <a class="btn btn-md text-primary mb-2" onclick="goBack()"> <i class="fas fa-arrow-left"></i>
                            Back
                            to previous page</a>
                    </div>

                    <div class="d-sm-flex align-items-center justify-content-between mb-3">
                        <h4 class="h4 mb-0 text-gray-800" id="year_name_heading"></h4>
                    </div>

                    <div class="d-sm-flex align-items-center justify-content-between mb-3">
                        <h1 class="h1 mb-0 text-gray-800" id="class_name_heading"></h1>

                        <button class="btn btn-sm btn-primary" type="button" data-toggle="modal"
                            data-target="#edit_this_class">
                            Edit this Academic Year Class
                        </button>
                    </div>

                    <div class="d-sm-flex align-items-center justify-content-between mb-2">
                        <h5 class="h5 mb-0 " id="class_teacher">Stream Name: <span><i class="text-gray-800">
                                    <a id="stream2_name" href=""></a> </i></span> </h1>

                            <h5 class="h5 mb-0 " id="creation_date">Class Creation Date: <span><i class="text-gray-800"
                                        id="creationdate"></i></span> </h1>
                    </div>

                    <div class="d-sm-flex align-items-center justify-content-between mb-2">
                        <h5 class="h5 mb-0" id="class_teacher"> Class Teacher:<span><i> <a
                                        id="classTeacher"></a></i></span> </h1>

                    </div>

                    <div class="d-sm-flex align-items-center justify-content-between mb-2">
                        <h5 class="h5 mb-0 ">Max No. of Students per class (SPC): <span class="text-gray-800"
                                id="max_no_students"></span> </h1>

                            <h5 class="h5 mb-0">Max No of Exam for class (EPC): <span><i class="text-gray-800"
                                        id="max_no_exams"></i></span> </h1>
                    </div>
                    <!-- End of Page Heading -->

                    <div class="alert alert-warning" role="alert">
                        <h6 class="alert-heading">
                            <strong>This page contains information about the Academic Year Class.
                                You can use this page to add exams to the academic year class, you can use
                                this page to view, edit the academic year class.</strong>

                        </h6>
                        <hr>
                        <p class="mb-0">Use the tables below to view components of the Academic Year Class.</p>
                    </div>

                    <nav aria-label="breadcrumb mb-3">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/index">Home</a></li>
                            <li class="breadcrumb-item"><a href="/pages/classes/">Class</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a id="bread_list"></a></li>
                        </ol>
                    </nav>

                    <hr class="my-2">

                    <nav class="mb-4">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link " id="nav-home-tab" data-toggle="tab" href="#exams" role="tab"
                                aria-controls="exams" aria-selected="true"> <span><i
                                        class="fas fa-chalkboard "></i></span> All Exams in the Academic class </a>
                            <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#students"
                                role="tab" aria-controls="students" aria-selected="false"> <span><i
                                        class="fas fa-users"></i></span> All Students in the Academic class</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#subjects"
                                role="tab" aria-controls="nav-contact" aria-selected="false"> <span><i
                                        class="fas fa-address-book"></i></span> All Subjects and Teachers </a>
                        </div>
                    </nav>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- TAB PANE CONTENT. -->
                            <div class="tab-content" id="nav-tabContent">

                                <!-- Exam Tab Pane  -->
                                <div class="tab-pane fade" id="exams" role="tabpanel" aria-labelledby="nav-home-tab">

                                    <div class="alert alert-primary" role="alert">
                                        <h6 class="alert-heading">This is the Exam card and tab. It holds the exam
                                            performance chart and the exams table.</h6>
                                        <hr>
                                        <p class="mb-0">Use the cards to monitor your students and the number of exams
                                            the class has sat for.</p>
                                    </div>

                                    <div class="card shadow mb-2">
                                        <div
                                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                                            <h6 class="m-0 font-weight-bold text-primary">All Class Exams</h6>
                                            <button class="btn btn-sm btn-primary" type="button" data-toggle="modal"
                                                data-target="#add_class_term_exam">
                                                Add Termly Class Exam</button>

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
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- Student Tab Pane -->
                                <div class="tab-pane fade show active" id="students" role="tabpanel"
                                    aria-labelledby="nav-profile-tab">

                                    <div class="alert alert-info" role="alert">
                                        <h6 class="alert-heading">
                                            <strong>This tab contains details of all the students in these academic
                                                year.</strong>

                                        </h6>
                                        <hr>
                                        <p class="mb-0">Use the tables below to view details of the students and manage
                                            their activation
                                            <span class="badge badge-pill badge-success">Active</span></p>
                                    </div>

                                    <div class="card mb-4 shadow">
                                        <!-- card header -->
                                        <div class="card-header d-sm-flex align-items-center justify-content-between mb-3">
                                            <div class="text-primary font-weight-bold">
                                                Completed Students in the class.
                                            </div>

                                            <div class="btn-group">
                                                <button class="btn btn-primary" data-toggle="modal"
                                                    data-target="#add_student_modal">Add
                                                    Student to this class</button>
                                                <button class="btn btn-outline-primary">Mark All Student Complete</button>

                                            </div>
                                        </div>
                                        <!-- card body -->
                                        <div class="card-body mb-3">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="view_class_student" width="100%"
                                                    cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>Admission Date</th>
                                                            <th>Students Full Name</th>
                                                            <th>Admission No</th>
                                                            <th>Gender</th>
                                                            <th>Status</th>
                                                            <th class="text-center">Completed</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>

                                                </table>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <!-- Subject Tab Pane -->
                                <div class="tab-pane fade" id="subjects" role="tabpanel"
                                    aria-labelledby="nav-contact-tab">
                                    <div class="card  h-100 py-2">
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
                                <!-- END TAB PANE CONTENT -->
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include '../../../resources/views/footer.html' ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!--------------------------------  MODALS --------------------------------------------------------------------->
    <!-- Logout Modal.  -->
    <?php include '../../resources/views/logout_modal.html' ?>

    <!-- Add Students To Academic Year.   -->
    <?php include "./_partials/view_academic_year_classes/students/add_student_modal.html"; ?>
    <!---------------------------------END OF MODALS ------------------------------------------->

    <script src="/dist/js/main.min.js"></script>
    <script src="/dist/js/utils/utils.js"></script>
    <script src="/dist/js/years/view_academic_year_classes.js"></script>
</body>


</html>