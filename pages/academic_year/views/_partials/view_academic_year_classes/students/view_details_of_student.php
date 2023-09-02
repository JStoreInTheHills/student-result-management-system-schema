<!DOCTYPE html>
<html lang="en">

<!-- CSS FILES -->
<?php include "../../../../../../resources/views/css_files.html";?>

<body>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include "../../../../../../resources/views/sidebar.html"; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include '../../../../../../resources/views/topbar.php'; ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between">
                        <a class="btn btn-md text-primary mb-2" onclick="goBack()">
                            <i class="fas fa-arrow-left"></i> Back to previous page</a>
                    </div>


                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800" id="heading"> </h1>
                        <button type="button" class="btn btn-primary" id="markStudentBtn" data-toggle="modal"
                            data-target="#auth_modal"></button>
                    </div>

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h4 class="h4 mb-0 text-gray-800" id="academic_year"></h4>
                        <h4 class="h4 mb-0 text-gray-800" id="class_name"></h4>
                    </div>

                    <span id="error"></span>

                    <nav class="mb-3">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                                role="tab" aria-controls="nav-home" aria-selected="true"> <span><i
                                        class="fas fa-user-graduate"></i></span> Students Performance</a>
                            <!-- <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                                role="tab" aria-controls="nav-profile" aria-selected="false"> <span><i
                                        class="fas fa-chalkboard"></i></span> Term Performance</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact"
                                role="tab" aria-controls="nav-contact" aria-selected="false"> <span><i
                                        class="fas fa-address-book"></i></span> Academic Year Performance</a> -->

                        </div>
                    </nav>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                    aria-labelledby="nav-home-tab">
                                    <!-- Area Chart -->
                                    <div class="alert alert-info alert-dismissible fade show mb-1" role="alert">
                                        <strong>This chart shows the gradual performance of the student over a period of
                                            exams.</strong>
                                        <hr>
                                        <p class="mb-0">The y-axis holds the marks of the exams and the x-axis holds the
                                            exam. </p>
                                    </div>
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary"><span><i
                                                        class="fas fa-user-graduate"></i></span> Students Performance
                                                Curve
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart-area">
                                                <canvas id="myAreaChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <p class="text-center">Overall Exam Performance</p>
                                    <hr>
                                    <div class="alert alert-info alert-dismissible fade show mb-1" role="alert">
                                        <strong>This table shows the exam performance of the student and the total marks
                                            obtained against an Academic year.</strong>
                                        <hr>
                                        <p class="mb-0">Click on an exam to view exam performance. </p>
                                    </div> -->
                                    <!-- Bar Graph -->
                                    <!-- <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">
                                                <span><i class="fas fa-users"></i></span> Overall Exam Performance</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped " id="overrall_exam_table"
                                                    width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>Date Published</th>
                                                            <th>Exam Name</th>
                                                            <th>Term</th>
                                                            <th>Year</th>
                                                            <th>Total Marks</th>
                                                        </tr>
                                                    </thead>

                                                </table>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                                <!-- <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                    aria-labelledby="nav-profile-tab">
                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        <strong>This table shows the term performance of the student.</strong>
                                        <hr>
                                        <p class="mb-0">It combines all the exams in the term. Click on a term to view
                                            students performance for that term.</p>
                                    </div>

                                    <div class="card shadow mb-4">
                                        <div
                                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="mx font-weight-bold text-primary">Term Performance</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped " id="term_performance_table"
                                                    width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>Term</th>
                                                            <th>Academic Year</th>
                                                        </tr>
                                                    </thead>

                                                </table>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                    aria-labelledby="nav-contact-tab">

                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        <strong>This table shows the academic year performance of the student.</strong>
                                        <hr>
                                        <p class="mb-0">It combines all the term performance in the academic year. Click
                                            on an year to view students performance for that specific academic year.</p>
                                    </div>

                                    <div class="card shadow mb-4">
                                        <div
                                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="mx font-weight-bold text-primary">Academic year Performance</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped " id="academic_year_performance"
                                                    width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>Academic Year</th>
                                                            <th>Created At</th>
                                                        </tr>
                                                    </thead>

                                                </table>
                                            </div>
                                        </div>

                                    </div>


                                </div> -->
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!--Students Details -->
                            <div class="card mb-2">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"> Students Details</h6>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li id="students_name" class="list-group-item"></li>
                                        <li id="RollId" class="list-group-item"></li>
                                        <li id="Gender" class="list-group-item"></li>
                                        <li id="status" class="list-group-item"></li>
                                        <li id="RegDate" class="list-group-item"></li>

                                    </ul>
                                </div>
                            </div>

                            <div class="card mb-4">
                                <div class="card-header d-sm-flex align-items-center justify-content-between  py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Class Details</h6>

                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li id="class_teacher" class="list-group-item"></li>
                                        <li id="year_name" class="list-group-item"></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <?php include '../../../../../../resources/views/footer.html'; ?>

        </div>
        <!-- End of Content Wrapper -->

        <!-- Modal for authentication.  -->
        <?php include '../../../../../../resources/views/admin/authenticate_modal.html'; ?>

        <!-- The modal to  -->

    </div>
    <!-- End of Page Wrapper -->

    <script src="/dist/js/main.min.js"> </script>
    <script src="/dist/js/utils/utils.js"></script>
    <script src="/dist/js/years/view_details_of_student.js"></script>
    <script src="/resources/views/admin/authenticate.js"></script>
</body>
</body>

</html>