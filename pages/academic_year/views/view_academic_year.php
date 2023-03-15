<?php

// include "../../layouts/utils/redirect.php";

// if(!isset($_SESSION['alogin']) || (time() - $_SESSION['last_login_timestamp']) > 1500 || !isset($_SESSION['role_id'])){
//   redirectToHomePage();
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

                    <div class="d-sm-flex align-items-center justify-content-between">
                        <a class="btn btn-md text-primary mb-2" onclick="goBack()">
                            <i class="fas fa-arrow-left"></i> Back to previous page</a>
                    </div>

                    <div class="d-sm-flex align-items-center justify-content-between mb-2">

                        <form id="edit_year_form" style="width:50%;">
                            <input type="hidden" name="year_id" id="year_id">
                            <input style="border-width:0px; border:none; font-size: 1.5em; background-color:#f8f9fc"
                                class="form-control text-gray-800 edit_school_input" type="text" name="heading"
                                id="heading">
                        </form>

                        <div class="btn-group">
                            <button class="btn btn-sm btn-primary" id="add-class-to-academic-year">Add Class to Academic Year</button>
                            <button id="edit_academic_year" class="btn btn-sm btn-outline-danger"></button>
                        </div>
                    </div>

                    <div class="d-sm-flex align-items-center justify-content-between mb-3">
                        <h1 id="creation_date" class="h5 mb-0 text-gray-600"> </h1>
                        <h1 id="status" class="h5 mb-0"></h1>
                    </div>

                    <hr class="my-2">

                    <span id="alert"></span>

                    <nav aria-label="breadcrumb mb-3">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/index">Home</a></li>
                            <li class="breadcrumb-item"><a href="/academic_year/year">Academic Year</a></li>
                            <li id="bread_list" class="breadcrumb-item active" aria-current="page"></li>
                        </ol>
                    </nav>

                    <div class="row">
                        <!-- <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-primary  h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Exams This Year</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"
                                                id="all_exams_this_year"></div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#"> <i class="fas fa-book-reader fa-2x text-info-300"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-primary  h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Students Registered This Year</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"
                                                id="all_students_registered_this_year"></div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#"> <i class="fas fa-users fa-2x text-info-300"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>

                    <nav class="mb-4">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-academic-term-tab" data-toggle="tab" href="#nav-academic-term"
                                role="tab" aria-controls="nav-academic-term" aria-selected="true"> <span><i
                                        class="fas fa-chalkboard "></i></span> Terms in the Academic Year</a>
                            <a class="nav-item nav-link" id="nav-academic-year-performance-tab" data-toggle="tab" href="#nav-academic-year-performance"
                                role="tab" aria-controls="nav-academic-year-performance" aria-selected="false"> <span><i
                                        class="fas fa-book-reader"></i></span> Classes in the Academic Year</a>
                        </div>
                    </nav>

                    <!-- start of row -->
                    
                        
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-academic-term" role="tabpanel"
                                    aria-labelledby="nav-academic-term-tab">

                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        <strong>All the Academic Terms for this year, are shown on the table below. </strong>
                                        <hr>
                                        <p class="mb-0">To add an academic term to the Academic Year. Choose the term from 
                                        the option list on the right and click on Save. </p>
                                        <hr>
                                        <p><strong> Note! Terms that are inActive will not appear on this option list.</strong></p>
                                    </div>

                                    <div class="row">
                                    
                                        <div class="col-lg-8">
                                            <div class="card shadow mb-4">
                                                <div class="card-header text-primary font-weight-bold">
                                                    Academic Year Terms
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped" width="100%" cellspacing="0"
                                                            id="term_year_table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Date Added</th>
                                                                    <th>Term Name</th>
                                                                    <th>Status</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="card mb-4">
                                                <div class="card-header text-primary font-weight-bold">
                                                    Add Terms to Academic Year
                                                </div>
                                                <div class="card-body">
                                                    <span id="card_alert"></span>
                                                    <form id="year_form" class="user">
                                                        <div class="form-group row">
                                                            <div class="col-md-12 mb-3 mb-sm-0">
                                                                <label class="text-primary" for="term_name">Choose Term Name:</label>
                                                                <select class="form-control" name="term_name" id="term_name">
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="btn-group float-right">
                                                            <button class="btn btn-primary" name="submit" type="submit"
                                                                id="form_submit">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                     </div>

                                </div>

                                <div class="tab-pane fade" id="nav-academic-year-performance" role="tabpanel"
                                    aria-labelledby="nav-academic-year-performance-tab">

                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        <strong>All the Classes for this year, are shown on the table below. </strong>
                                        <hr>
                                        <p class="mb-0">To add a class to this academic year. Click the Add class to Academic Year
                                        and add the class. Lastly click on the save button.</p>
                                    </div>

                                    <div class="card shadow mb-4">
                                        <div class="card-header text-primary font-weight-bold">
                                            End Year Class Performance
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped" width="100%" cellspacing="0"
                                                    id="class_end_year_table">
                                                    <thead>
                                                        <tr>
                                                            <th>Date Class Added to the Year</th>
                                                            <th>Class Name</th>
                                                            <th>Class Code</th>
                                                            <th>Class Teacher</th>
                                                            <th>Stream Name</th>
                                                            <th>Class Status</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                      
                            <!------------------------------------------------------------------------------------------------->
                            

                   
                    <!-- endo of row -->



                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <?php include '../../../resources/views//footer.html' ?>
        </div>
        <!-- End of Content Wrapper -->
        <?php #include '../../layouts/utils/logout_modal.html' ?>
    </div>
    <!-- End of Page Wrapper -->


    <script src="/dist/js/main.min.js"></script>
    <script src="/dist/js/utils/utils.js"></script>
    <script src="/dist/js/years/view_academic_year.js"></script>
</body>

</html>

<?php #}?>