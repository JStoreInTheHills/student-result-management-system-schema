
<!-- Topbar -->
<nav class="navbar navbar-expand navbar-dark bg-white topbar mb-3 static-top shadow">

     <!-- Sidebar Toggle (Topbar) -->
     <a id="sidebarToggleTop" class="btn mr-3 text-dark">
        <i class="fa fa-bars"></i>
    </a>

    <form id="form_edit_school">
        <h3 type="text" id="index_heading"></h3>
    </form>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="text-primary fas fa-bell"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">2</span>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                    Notifications Center
                </h6>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        
                        <div class="font-weight-bold">
                            <div>Hi there! <?php echo htmlentities($_SESSION['alogin']); ?>. Welcome to 
                        Al Madrasatul Munawwarah Al Islamiyyah </div>
                            <div class="small text-gray-500">Salim Juma · 58m</div>
                        </div>
                    </a>

                    <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-900 small">
                    <?php echo htmlentities($_SESSION['alogin']); ?>
                </span>
                <img class="img-profile rounded-circle" src="/src/img/download.png">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right animated--grow-in" aria-labelledby="userDropdown">

                <a href="/settings/profile" class="dropdown-item">
                    Manage My Account
                </a>

                <a href="#" class="dropdown-item">
                    Create a Task
                </a>

                <hr class="sidebar-divider my-1">

                <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-lg fa-fw mr-2 text-danger"></i>
                    Sign Out
                </a>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->
