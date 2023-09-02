<!-- MODEL TO USE: STUDENT_DETAILS -->
<!-- this page contains details about a student. 
    the details are attributes like phone number, guardian name, physical address,
    and when this details were added. 
    This is where we can make students inactive or active.  
-->

<!-- MODEL TO USE: ACADEMIC_YEAR_CLASS_STUDENTS -->
<!-- We can also show the classes he has been in through the years. 
    This is also the page the student will log in to and if this is the case
    when the student chooses the class for an academic year, 
    the exam result for the year should be displayed.   
-->


<!DOCTYPE html>
<html lang="en">
<?php include "../../../resources/views/css_files.html"; ?>

<body>

    <div id="wrapper">
        <?php include "../../../resources/views/sidebar.html"; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include '../../../resources/views/topbar.php' ?>

                <!-- the start of the container fluid -->
                <div class="container-fluid">

                    <!-- previous page button link -->
                    <a class="btn btn-md text-primary mb-2" onclick="goBack()"> <i class="fas fa-arrow-left"></i> Back
                        to previous page</a>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-3">
                        <h1 class="h3 mb-0 text-gray-900" id="heading"></h1>

                        <div class="btn-group">

                            <button id="edit_student_btn" class="btn btn-primary btn-md" data-toggle="modal"
                                data-target="#edit_student"> Edit Student
                            </button>
                        </div>
                    </div>

                    <!-- Admisssion number and the date of admission -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-2">
                        <h1 class="h5 mb-0 text-gray-900" id="email">Admission Number: 9293/23</h1>
                        <h1 class="h5 mb-0 text-gray-900" id="CreationDate">Date Admitted: 19, April 2023</h1>
                    </div>

                    <!-- Date of Birth and the status of the student -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-2">
                        <h1 class="h4" id="status"><span class="badge badge-pill badge-danger">Inactive</span></h1>
                    </div>

                    <hr class="my-2">

                    <div class="alert alert-info alert-dismissible fade show mb-1" role="alert">
                        <strong>Use this page to manage student profile, edit the profile and make the student
                            inactive or active. </strong>
                        <hr class="my-2">
                        <div class="d-sm-flex align-items-center justify-content-between mb-0">
                            <p class="mb-0">Click on the buttons to view more details and features.</p>
                        </div>
                    </div>

                    <hr class="my-2">

                    <!-- the chart section and row for the student details.   -->
                    <div class="row mb-3">
                        <!--  the chart section which shows the student yearly performance.  -->
                        <div class="col-lg-8">
                            <div class="card shadow">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Overall Yearly Students Performance
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- the student details, including details from phone number, guardians name, and the rest -->
                        <div class="col-lg-4">
                            <div class="card shadow">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">More Student Details</h6>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li id="age" class="list-group-item">Age:</li>
                                        <li id="Gender" class="list-group-item">Gender:</li>
                                        <li id="DOB" class="list-group-item">Phone Number:</li>
                                        <li id="status" class="list-group-item">Guardian Name:</li>
                                        <li id="status" class="list-group-item">Physical Address:</li>
                                        <li id="status" class="list-group-item">Date of Birth:</li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- the class datatable row, showing the classes the student was in the different academic years. -->
                    <!-- WE essentially group by the year id.  -->
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="card shadow">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Academic Classes in the Academic Years
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="student_classes_table" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Admission Date</th>
                                                    <th>Class Name</th>
                                                    <th>Class Code</th>
                                                    <th>Academic Year</th>
                                                    <th class="text-center">Status</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <?php include '../../../resources/views//footer.html' ?>


        </div>


        <script src="/dist/js/main.min.js"></script>
        <script src="/dist/js/utils/utils.js"></script>
        <script>
            const title = $("#title").html("Manage Students");
            const heading = $("#heading").html("Salim Juma Silaha ~ (9293/23)");
            const student_classes_table = $("#student_classes_table").DataTable({
                ajax: {
                    url: "",
                    dataSrc: "",
                    type: "GET",
                },
                columnDefs: []
            });
        </script>
</body>

</html>