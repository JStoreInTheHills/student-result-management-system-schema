<?php

// include "../layouts/utils/redirect.php";

// if(!isset($_SESSION['alogin']) || (time() - $_SESSION['last_login_timestamp']) > 1500 || !isset($_SESSION['role_id'])){
//   redirectToHomePage();
// }else{
//       $_SESSION['last_login_timestamp'] = time();
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-2">
                        <a class="btn btn-md text-primary mb-2" onclick="goBack()"> <i class="fas fa-arrow-left"></i>
                            Back to previous page</a>
                    </div>

                    <div class="d-sm-flex align-items-center justify-content-between mb-2">
                        <h1 class="h3 text-gray-800">Manage All Classes </h1>
                    </div>

                    <div class="alert alert-info alert-dismissible fade show mb-2" role="alert">
                        <strong>Use this page to manage all your classes in the school. </strong>
                        <hr>
                        <p class="mb-0">The table below holds all the classes in the school, use it to select and
                            view more details about a class or modify existing classes. To add a new class, click the
                            Add New Class button on the right side.</p>

                    </div>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/index">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">All Classes</li>
                        </ol>
                    </nav>

                    <!-- Class Table Datatable example -->
                    <div id="class_main_content" class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <span><i class="fas fa-chalkboard-teacher"></i></span>
                                All Streams</h6>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button class="btn btn-outline-primary btn-sm">
                                    <span><i class="fas fa-file-pdf"></i></span> Generate Report
                                </button>

                                <button data-toggle="modal" data-target="#add_new_stream"
                                    class="btn btn-sm btn-primary">
                                    Add New Classes
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="class_table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Created At</th>
                                            <th>Class Name</th>
                                            <th>Class Code</th>
                                            <th>Stream Name</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include '../../resources/views/footer.html' ?>

        </div>
        <!-- End of Content Wrapper -->

        <?php include "./view/_partials/add_class_modal.html" ?>
    </div>
    <!-- End of Page Wrapper -->

    <?php #include '../layouts/utils/logout_modal.html'; ?>

    <script src="/dist/js/main.min.js"></script>
    <script src="/dist/js/utils/utils.js"></script>
    <script src="/dist/js/classes/class.js"></script>

</body>

</html>

<?php #} ?>