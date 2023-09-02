<?php
// include '../config/config.php';

// session_start();

// if(!isset($_SESSION['alogin']) || (time() - $_SESSION['last_login_timestamp']) > 1500 || !isset($_SESSION['role_id'])){
//   header("Location: /login");
//   exit;
// }else{
    // $_SESSION['last_login_timestamp'] = time();

?>

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
            <div id="content">

                <?php include '../../resources/views/topbar.php' ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <a class="btn btn-md text-primary mb-2" onclick="goBack()"> <i class="fas fa-arrow-left"></i>
                            Back
                            to previous page</a>
                    </div>

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800" id="heading"> <span><i class="fas fa-users"></i></span>
                            Manage All Teachers
                        </h1>
                    </div>

                    <nav aria-label="breadcrumb mb-3">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/index">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a>All Teachers</a></li>
                        </ol>
                    </nav>

                    <!-- <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Teachers </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="all_students"></div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#"> <i class="fas fa-users fa-2x text-info-300"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong>Specializations with "Subject Not Assigned" are Teachers with no subjects or
                            specifications assigned.</strong>
                        <hr>
                        <p class="mb-0">Choose a teacher to add a subject or specification to them.</p>
                    </div>

                    <hr class="my-3">

                    <!-- start of row -->
                    <div class="row">

                        <div class="col-lg-12">
                            <div id="main_content" class="card shadow mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="mx font-weight-bold text-primary"> <span><i
                                                class="fas fa-users"></i></span>
                                        All Teachers</h6>


                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a class="btn btn-outline-primary btn-xs" target="_blank"
                                            href="/reports/teacher/all_teachers">
                                            <span><i class="fas fa-file-pdf"></i> </span> Print Report</a>

                                        <button class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#add_class_teacher">
                                            <span><i class="fas fa-users"></i> </span> Add New Teachers
                                        </button>
                                    </div>


                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="teachers_table" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Created At</th>
                                                    <th>Teachers Name</th>
                                                    <th>ID Number</th>
                                                    <th>Email Address</th>
                                                    <th>Phone Number</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!------------------------------------------------------------------------------------------------->
                    </div>
                    <!-- endo of row -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include '../../resources/views/footer.html' ?>
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <?php include '../../resources/views/logout_modal.html' ?>

    <?php include './_partials/add_new_teacher_modal.html'?>

    <script src="/dist/js/main.min.js"></script>
    <script src="/dist/js/utils/utils.js"></script>
    <script src="/dist/js/teachers/teachers.js"></script>

</body>

</html>

<?php #} ?>