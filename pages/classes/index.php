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

                    <div class="d-sm-flex align-items-center justify-content-between mb-2">
                        <h1 class="h3 text-gray-800">Manage All Classes </h1>
                        <div class="btn-group">
                            <button data-toggle="modal" data-target="#add_new_stream" class="btn btn-sm btn-primary">
                                Add New Classes
                            </button>
                           
                        </div>

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
                             <button class="btn btn-outline-primary btn-sm">
                                <span><i class="fas fa-file-pdf"></i></span> Generate Report
                            </button>
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

        <!-- New Class Modal-->
        <div class="modal fade" id="add_new_stream" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="new_class_modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="new_class_modal">
                            <span><i class="fas fa-chalkboard"></i></span> Add a new Class</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                    </div>

                    <div class="modal-body">

                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Use this form to add a new class.</strong>
                            <hr>
                            <p class="mb-0">Field with the * mark are required</p>
                        </div>
                        <hr>
                        <form id="class_form" class="user">
                                <div class="form-group">
                                    <label class="text-primary" for="class_name">Class Name*</label>
                                    <input type="text" id="class_name" class="form-control" name="class_name"
                                        placeholder="E.g 'Raudha' , 'Thanawii' ">
                                </div>

                                <div class="form-group">
                                    <label class="text-primary" for="class_code">Class Unique Code*</label>
                                    <input type="text" id="class_code" class="form-control"
                                        name="class_code" placeholder="E.g '0CRB', 'OCRG'">
                                </div>

                                <div class="form-group">
                                    <label class="text-primary" for="stream_id">Choose a Stream*</label>
                                    <select style="width:100%" name="stream_id" id="stream_id" class="form-control">
                                    </select>
                                </div>

                                <div class="btn-group">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- End of Page Wrapper -->

    <?php include '../layouts/utils/logout_modal.html'; ?>

    <script src="/dist/js/main.min.js"></script>
    <script src="/dist/js/utils/utils.js"></script>
    <script src="/dist/js/classes/class.js"></script>

</body>

</html>

<?php #} ?>