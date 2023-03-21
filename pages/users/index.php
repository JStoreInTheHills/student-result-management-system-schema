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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800" id="heading"> <span><i class="fas fa-users"></i></span>
                            Manage All Users
                        </h1>
                        <div class="btn-group">

                            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#add_class_teacher">
                                <span><i class="fas fa-users"></i> </span> Add New User
                            </button>

                            <!-- <a class="btn btn-outline-primary btn-xs" target="_blank"
                                href="/reports/teacher/all_teachers">
                                <span><i class="fas fa-file-pdf"></i> </span> Print Report</a> -->

                        </div>
                    </div>

                    <nav aria-label="breadcrumb mb-3">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/index">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a>All Users</a></li>
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
                        <strong>Use this page to manage all the users.</strong>
                        <hr>
                        <p class="mb-0">Choose a user by clicking a user and view more details about the user.</p>
                    </div>

                    <hr class="my-3">

                    <!-- start of row -->
                    <div class="row">

                        <div class="col-lg-12">
                            <div id="main_content" class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="mx font-weight-bold text-primary"> <span><i class="fas fa-users"></i></span>
                                        All User</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="users_table" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Date Created</th>
                                                    <th>User Name</th>
                                                    <th>Email Address</th>
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

    <div class="modal fade" id="add_class_teacher" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="class_teacher_modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="class_teacher_modal">
                        <span><i class="fas fa-users"></i></span> Add User</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="teachers_form">

                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Before you add a teacher, first add a user in the Users module.</strong>
                            <hr>
                            Click here <a href="/admin/pages/new_user" class="alert-link">Users</a> 
                                to add a new user before you continue.

                        </div>
                        <hr>

                        <span><i class="fas fa-user mr-2"></i></span>
                        <label for="teachers_name" class="text-primary">Personal Information </label>

                        <div class="form-group">
                            <label class="text-primary" for="user_name">User Name: </label>
                            <input type="text" name="user_name" id="user_name" class="form-control"
                                placeholder="Enter username" required>
                        </div>
                        <div class="form-group">
                            <label class="text-primary" for="email_address">Email Address:
                            </label>
                            <input type="email" name="email_address" id="email_address" class="form-control"
                                placeholder="Enter email address" required>
                        </div>
                       
                            <div class="form-group">
                                <label class="text-primary" for="password">Password: </label>
                                <input type="password" name="password" id="password"
                                    class="form-control" required>
                            </div>
                            <div class="form-group">
                               <label class="text-primary" for="password">Re Enter Password: </label>
                                <input type="password" name="re-password" id="re-password"
                                    class="form-control" required>
                            </div>

                    </form>
                </div>

                <div class="modal-footer btn-group">
                    <button class="btn btn-primary" type="submit" id="add_teacher_submit">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>


    <script src="/dist/js/main.min.js"></script>
    <script src="/dist/js/utils/utils.js"></script>
    <script src="/dist/js/user/user.js"></script>
    
</body>

</html>

<?php #} ?>