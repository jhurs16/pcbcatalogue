<?php
require('../connection/pdo.php');
include('../sugarhelper.php');
$db = new DatabaseConnect();

$rollno = isset($_SESSION['RollNo']) ? $_SESSION['RollNo'] : null;
if (isset($_SESSION['RollNo'])) {


    $db->query("SELECT * from user where RollNo = ?");
    $db->bind(1, $_SESSION['RollNo']);
    $currentuser = $db->single();
    // dd($currentuser);
    $name = $currentuser['Name'];
    $category = $currentuser['Category'];
    $email = $currentuser['EmailId'];
    $mobno = $currentuser['MobNo'];
?>

    <div class="sidebar-wrapper sidebar-theme">

        <nav id="sidebar">

            <div class="navbar-nav theme-brand flex-row  text-center">
                <div class="nav-logo">
                    <div class="nav-item theme-logo">
                        <a href="#">
                            <img src="../images/logo.png" class="navbar-logo" alt="logo">
                        </a>
                    </div>
                    <div class="nav-item theme-text">
                        <a href="index-2.html" class="nav-link"> PCB </a>
                    </div>
                </div>
                <div class="nav-item sidebar-toggle">
                    <div class="btn-toggle sidebarCollapse">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left">
                            <polyline points="11 17 6 12 11 7"></polyline>
                            <polyline points="18 17 13 12 18 7"></polyline>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="profile-info">
                <div class="user-info">
                    <div class="profile-img">
                        <img src="./images/profile.png" alt="avatar">
                    </div>
                    <div class="profile-content">
                        <h6 class=""><?php echo $name; ?></h6>
                        <p class=""><?php echo $category; ?></p>
                    </div>
                </div>
            </div>

            <div class="shadow-bottom"></div>
            <ul class="list-unstyled menu-categories" id="accordionExample">






                <li class="menu menu-heading">
                    <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg><span>USER AND PAGES</span></div>
                </li>

                <li class="menu active">
                    <a href="#users" data-bs-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <span>User</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled show" id="users" data-bs-parent="#accordionExample">
                        <li class="active">
                            <a href="./index-assets.php"> Profile </a>
                        </li>
                        <li>
                            <a href="./user/user-account-settings.php"> Account Settings </a>
                        </li>
                    </ul>
                </li>

                <li class="menu">
                    <a href="#pages" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file">
                                <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                <polyline points="13 2 13 9 20 9"></polyline>
                            </svg>
                            <span>Pages</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="pages" data-bs-parent="#accordionExample">
                        <li>
                            <a href="./message-page.php"> Messages</a>
                        </li>
                        <li>
                            <a href="./all-books.php"> All Books </a>
                        </li>
                        <li>
                            <a href="./previously-borrowed-books.php"> Previously Borrow Books </a>
                        </li>
                        <li>
                            <a href="./currently-issued-books.php"> Currently Issued Books </a>
                        </li>

                    </ul>
                </li>
                <li class="menu">
                    <a target="_blank" href="../../documentation/index-2.html" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                            </svg>

                            <span>Logout</span>
                        </div>
                    </a>
                </li>


            </ul>


        </nav>

    </div>


<?php } ?>