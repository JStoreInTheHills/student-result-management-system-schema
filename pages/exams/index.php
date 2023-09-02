<?php

// session_start();    

// if(!isset($_SESSION['alogin']) || (time() - $_SESSION['last_login_timestamp']) > 1500 || !isset($_SESSION['role_id'])){
//         header("Location: /login");
//         exit;
//   }else{
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">
                            Manage Exams
                        </h1>
                    </div>

                    <nav aria-label="breadcrumb mb-3">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/index">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">All Exams</li>
                        </ol>
                    </nav>

                    <!-- <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong>The table below shows the list of all the streams in the school.</strong>
                        <hr>
                        <p class="mb-0">Streams are used to hold classes. 
                            Click on the stream to view more details or add a new stream
                            and start setting it up.</p>
                    </div> -->

                    <!-- <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border border-bottom-primary h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                             <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Total Number of Classes 
                                                </div>
                                            <div class="h1 mb-0 font-weight-bold text-gray-800" id="all_classes"></div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#"> <i class="fas fa-book-reader fa-2x text-info-300"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <!-- Start of Row -->
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card mb-4 shadow">
                                <div class="card-header">
                                    <span class="text-primary font-weight-bold">
                                        <i class="fas fa-book-reader"></i> All Exams</span>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="exam_table" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Creation Date</th>
                                                    <th>Exam Name</th>
                                                    <th>Exam Out Of</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!------------------------------------------------------------------------------------------------->
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <span class="text-primary font-weight-bold">
                                        <i class="fas fa-book-reader"></i> Add New Exam</span>
                                </div>
                                <div class="card-body">
                                    <form id="exam_form">
                                        <div class="form-group row">
                                            <div class="col-sm-12 mb-3 mb-sm-0">
                                                <label class="text-primary" for="exam_name">Enter Exam Name</label>
                                                <input type="text" id="exam_name" name="exam_name" autocomplete="off"
                                                    class="form-control" placeholder="End Term Exam, Mid Term Exam">
                                                <small id="emailHelp" class="form-text text-muted">Name cannot
                                                    be less than 3 digits.</small>

                                                <label class="text-primary" for="exam_out_of">Enter Exam Out of</label>
                                                <input type="number" id="exam_out_of" name="exam_out_of" autocomplete="off"
                                                    class="form-control" placeholder="10">

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary float-right" name="submit"
                                                type="submit">Save</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Row  -->

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


    <script src="/dist/js/main.min.js"></script>
    <script src="/dist/js/utils/utils.js"></script>
    <script src="/dist/js/exams/exam.js"></script>

</body>

</html>

<?php #} ?>