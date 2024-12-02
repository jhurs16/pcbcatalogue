<?php
require('../../connection/pdo.php');
include('../../sugarhelper.php');
$db = new DatabaseConnect();

$rollno = isset($_SESSION['RollNo']) ? $_SESSION['RollNo'] : null;

if (isset($_SESSION['RollNo'])) {


    $db->query("SELECT * from user where RollNo = ? and Type = 'ADMIN");
    $db->bind(1, $_SESSION['RollNo']);
    $currentuser = $db->single();
    // dd($currentuser);
    $name = $currentuser['Name'];
    $category = $currentuser['Category'];
    $email = $currentuser['EmailId'];
    $mobno = $currentuser['MobNo'];
    $password = $currentuser['Password'];
    // message count 
    $db->query("SELECT * FROM message WHERE RollNo='$rollno'
              ORDER BY Date DESC,Time DESC;");
    $messages = $db->set();

    // books count
    $db->query("SELECT * FROM book;");
    $books = $db->set();

    // prrevious
    $db->query("SELECT * FROM record AS rc
              INNER JOIN 
                book 
              ON rc.BookId = book.Bookid
              WHERE RollNo = '$rollno'
              AND Date_of_Borrow is NOT NULL 
              AND Date_of_Return is NOT NULL");
    $previous_records = $db->set();

    // current records
    $db->query("SELECT * FROM record AS rc
              INNER JOIN 
                book 
              ON rc.BookId = book.Bookid
              WHERE RollNo = '$rollno'
              AND Date_of_Borrow is NOT NULL 
              AND Date_of_Return is NOT NULL
              ORDER BY Date_of_Borrow DESC");
    $current_records = $db->set();
?>

    <!DOCTYPE html>
    <html lang="en">

    <!-- Mirrored from designreset.com/equation/html/vertical-light-menu/user-account-settings.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 22 Oct 2024 11:24:04 GMT -->

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        <title>Account Settings | EQUATION - Multipurpose Bootstrap Dashboard Template </title>
        <link rel="icon" type="image/x-icon" href="../src/assets/img/favicon.ico" />
        <link href="../../dashboard-assets/layouts/vertical-light-menu/css/light/loader.css" rel="stylesheet" type="text/css" />
        <link href="../../dashboard-assets/layouts/vertical-light-menu/css/dark/loader.css" rel="stylesheet" type="text/css" />
        <script src="../../dashboard-assets/layouts/vertical-light-menu/loader.js"></script>

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
        <link href="../../dashboard-assets/src/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../../dashboard-assets/layouts/vertical-light-menu/css/light/plugins.css" rel="stylesheet" type="text/css" />
        <link href="../../dashboard-assets/layouts/vertical-light-menu/css/dark/plugins.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->

        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link rel="stylesheet" href="../../dashboard-assets/src/plugins/src/filepond/filepond.min.css">
        <link rel="stylesheet" href="../../dashboard-assets/src/plugins/src/filepond/FilePondPluginImagePreview.min.css">
        <link href="../../dashboard-assets/src/plugins/src/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../../dashboard-assets/src/plugins/src/sweetalerts2/sweetalerts2.css">

        <link href="../../dashboard-assets/src/plugins/css/light/filepond/custom-filepond.css" rel="stylesheet" type="text/css" />
        <link href="../../dashboard-assets/src/assets/css/light/components/tabs.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="../src/assets/css/light/elements/alert.css">

        <link href="../../dashboard-assets/src/plugins/css/light/sweetalerts2/custom-sweetalert.css" rel="stylesheet" type="text/css" />
        <link href="../../dashboard-assets/src/plugins/css/light/notification/snackbar/custom-snackbar.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="../../dashboard-assets/src/assets/css/light/forms/switches.css">
        <link href="../../dashboard-assets/src/assets/css/light/components/list-group.css" rel="stylesheet" type="text/css">

        <link href="../../dashboard-assets/src/assets/css/light/users/account-setting.css" rel="stylesheet" type="text/css" />



        <link href="../../dashboard-assets/src/plugins/css/dark/filepond/custom-filepond.css" rel="stylesheet" type="text/css" />
        <link href="../../dashboard-assets/src/assets/css/dark/components/tabs.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="../../dashboard-assets/src/assets/css/dark/elements/alert.css">

        <link href="../../dashboard-assets/src/plugins/css/dark/sweetalerts2/custom-sweetalert.css" rel="stylesheet" type="text/css" />
        <link href="../../dashboard-assets/src/plugins/css/dark/notification/snackbar/custom-snackbar.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="../../dashboard-assets/src/assets/css/dark/forms/switches.css">
        <link href="../../dashboard-assets/src/assets/css/dark/components/list-group.css" rel="stylesheet" type="text/css">

        <link href="../../dashboard-assets/src/assets/css/dark/users/account-setting.css" rel="stylesheet" type="text/css" />


        <!--  END CUSTOM STYLE FILE  -->
    </head>

    <body class=" layout-boxed">

        <!-- BEGIN LOADER -->
        <div id="load_screen">
            <div class="loader">
                <div class="loader-content">
                    <div class="spinner-grow align-self-center"></div>
                </div>
            </div>
        </div>
        <!--  END LOADER -->

        <!--  BEGIN NAVBAR  -->
        <div class="header-container container-xxl">
            <header class="header navbar navbar-expand-sm expand-header">

                <a href="javascript:void(0);" class="sidebarCollapse">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </a>

                <div class="search-animated toggle-search">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <form class="form-inline search-full form-inline search" role="search">
                        <div class="search-bar">
                            <input type="text" class="form-control search-form-control  ml-lg-auto" placeholder="Search...">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x search-close">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </div>
                    </form>
                    <span class="badge badge-secondary">Ctrl + /</span>
                </div>

                <ul class="navbar-item flex-row ms-lg-auto ms-0">

                    <li class="nav-item dropdown language-dropdown">
                        <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="language-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="../src/assets/img/1x1/us.svg" class="flag-width" alt="flag">
                        </a>
                        <div class="dropdown-menu position-absolute" aria-labelledby="language-dropdown">
                            <a class="dropdown-item d-flex" href="javascript:void(0);"><img src="../src/assets/img/1x1/us.svg" class="flag-width" alt="flag"> <span class="align-self-center">&nbsp;English</span></a>
                            <a class="dropdown-item d-flex" href="javascript:void(0);"><img src="../src/assets/img/1x1/tr.svg" class="flag-width" alt="flag"> <span class="align-self-center">&nbsp;Turkish</span></a>
                            <a class="dropdown-item d-flex" href="javascript:void(0);"><img src="../src/assets/img/1x1/br.svg" class="flag-width" alt="flag"> <span class="align-self-center">&nbsp;Portuguese</span></a>
                            <a class="dropdown-item d-flex" href="javascript:void(0);"><img src="../src/assets/img/1x1/in.svg" class="flag-width" alt="flag"> <span class="align-self-center">&nbsp;Hindi</span></a>
                            <a class="dropdown-item d-flex" href="javascript:void(0);"><img src="../src/assets/img/1x1/de.svg" class="flag-width" alt="flag"> <span class="align-self-center">&nbsp;German</span></a>
                        </div>
                    </li>

                    <li class="nav-item theme-toggle-item">
                        <a href="javascript:void(0);" class="nav-link theme-toggle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-moon dark-mode">
                                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sun light-mode">
                                <circle cx="12" cy="12" r="5"></circle>
                                <line x1="12" y1="1" x2="12" y2="3"></line>
                                <line x1="12" y1="21" x2="12" y2="23"></line>
                                <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                                <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                                <line x1="1" y1="12" x2="3" y2="12"></line>
                                <line x1="21" y1="12" x2="23" y2="12"></line>
                                <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                                <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                            </svg>
                        </a>
                    </li>

                    <li class="nav-item dropdown notification-dropdown">
                        <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                            </svg><span class="badge badge-success"></span>
                        </a>

                        <div class="dropdown-menu position-absolute" aria-labelledby="notificationDropdown">
                            <div class="drodpown-title message">
                                <h6 class="d-flex justify-content-between"><span class="align-self-center">Messages</span> <span class="badge badge-primary">9 Unread</span></h6>
                            </div>
                            <div class="notification-scroll">
                                <div class="dropdown-item">
                                    <div class="media server-log">
                                        <img src="../src/assets/img/profile-16.jpg" class="img-fluid me-2" alt="avatar">
                                        <div class="media-body">
                                            <div class="data-info">
                                                <h6 class="">Kara Young</h6>
                                                <p class="">1 hr ago</p>
                                            </div>

                                            <div class="icon-status">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="dropdown-item">
                                    <div class="media ">
                                        <img src="../src/assets/img/profile-15.jpg" class="img-fluid me-2" alt="avatar">
                                        <div class="media-body">
                                            <div class="data-info">
                                                <h6 class="">Daisy Anderson</h6>
                                                <p class="">8 hrs ago</p>
                                            </div>

                                            <div class="icon-status">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="dropdown-item">
                                    <div class="media file-upload">
                                        <img src="../src/assets/img/profile-21.jpg" class="img-fluid me-2" alt="avatar">
                                        <div class="media-body">
                                            <div class="data-info">
                                                <h6 class="">Oscar Garner</h6>
                                                <p class="">14 hrs ago</p>
                                            </div>

                                            <div class="icon-status">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="drodpown-title notification mt-2">
                                    <h6 class="d-flex justify-content-between"><span class="align-self-center">Notifications</span> <span class="badge badge-secondary">16 New</span></h6>
                                </div>

                                <div class="dropdown-item">
                                    <div class="media server-log">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server">
                                            <rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect>
                                            <rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect>
                                            <line x1="6" y1="6" x2="6" y2="6"></line>
                                            <line x1="6" y1="18" x2="6" y2="18"></line>
                                        </svg>
                                        <div class="media-body">
                                            <div class="data-info">
                                                <h6 class="">Server Rebooted</h6>
                                                <p class="">45 min ago</p>
                                            </div>

                                            <div class="icon-status">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="dropdown-item">
                                    <div class="media file-upload">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                            <line x1="16" y1="13" x2="8" y2="13"></line>
                                            <line x1="16" y1="17" x2="8" y2="17"></line>
                                            <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg>
                                        <div class="media-body">
                                            <div class="data-info">
                                                <h6 class="">Kelly Portfolio.pdf</h6>
                                                <p class="">670 kb</p>
                                            </div>

                                            <div class="icon-status">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="dropdown-item">
                                    <div class="media ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                        </svg>
                                        <div class="media-body">
                                            <div class="data-info">
                                                <h6 class="">Licence Expiring Soon</h6>
                                                <p class="">8 hrs ago</p>
                                            </div>

                                            <div class="icon-status">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </li>

                    <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                        <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="avatar-container">
                                <div class="avatar avatar-sm avatar-indicators avatar-online">
                                    <img alt="avatar" src="../src/assets/img/profile-30.png" class="rounded-circle">
                                </div>
                            </div>
                        </a>

                        <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                            <div class="user-profile-section">
                                <div class="media mx-auto">
                                    <div class="emoji me-2">
                                        &#x1F44B;
                                    </div>
                                    <div class="media-body">
                                        <h5>Shaun Park</h5>
                                        <p>Project Leader</p>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-item">
                                <a href="user-profile.html">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg> <span>Profile</span>
                                </a>
                            </div>
                            <div class="dropdown-item">
                                <a href="app-mailbox.html">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-inbox">
                                        <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                                        <path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path>
                                    </svg> <span>Inbox</span>
                                </a>
                            </div>
                            <div class="dropdown-item">
                                <a href="auth-boxed-lockscreen.html">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg> <span>Lock Screen</span>
                                </a>
                            </div>
                            <div class="dropdown-item">
                                <a href="auth-boxed-signin.html">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg> <span>Log Out</span>
                                </a>
                            </div>
                        </div>

                    </li>
                </ul>
            </header>
        </div>
        <!--  END NAVBAR  -->

        <!--  BEGIN MAIN CONTAINER  -->
        <div class="main-container " id="container">

            <div class="overlay"></div>
            <div class="cs-overlay"></div>
            <div class="search-overlay"></div>

            <!--  BEGIN SIDEBAR  -->
            <div class="sidebar-wrapper sidebar-theme">

                <nav id="sidebar">

                    <div class="navbar-nav theme-brand flex-row  text-center">
                        <div class="nav-logo">
                            <div class="nav-item theme-logo">
                                <a href="index-2.html">
                                    <img src="../../images/logo.png" class="navbar-logo" alt="logo">
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
                                <img src="../images/profile.png" alt="avatar">
                            </div>
                            <div class="profile-content">
                                <h6 class="">Shaun Park</h6>
                                <p class="">Project Leader</p>
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
                                <li>
                                    <a href="../index-assets.php"> Profile </a>
                                </li>
                                <li class="active">
                                    <a href="./user-account-settings.php"> Account Settings </a>
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
                                    <a href="../message-page.php"> Messages</a>
                                </li>
                                <li>
                                    <a href="../all-books.php"> All Books </a>
                                </li>
                                <li>
                                    <a href="../previously-borrowed-books.php"> Previously Borrow Books </a>
                                </li>
                                <li>
                                    <a href="../currently-issued-books.php"> Currently Issued Books </a>
                                </li>

                            </ul>
                        </li>
                        <li class="menu">
                            <a href="../logout.php" aria-expanded="false" class="dropdown-toggle">
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
            <!--  END SIDEBAR  -->

            <!--  BEGIN CONTENT AREA  -->
            <div id="content" class="main-content">
                <div class="layout-px-spacing">

                    <div class="middle-content container-xxl p-0">

                        <!-- BREADCRUMB -->
                        <div class="page-meta">
                            <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <!-- <li class="breadcrumb-item"><a href="#">Users</a></li> -->
                                    <li class="breadcrumb-item active" aria-current="page">Account Settings</li>
                                </ol>
                            </nav>
                        </div>
                        <!-- /BREADCRUMB -->

                        <div class="account-settings-container layout-top-spacing">

                            <div class="account-content">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <h2>Update your profile</h2>

                                        <ul class="nav nav-pills" id="animateLine" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="animated-underline-home-tab" data-bs-toggle="tab" href="#animated-underline-home" role="tab" aria-controls="animated-underline-home" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                                    </svg> Home</button>
                                            </li>
                                            <!-- <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="animated-underline-profile-tab" data-bs-toggle="tab" href="#animated-underline-profile" role="tab" aria-controls="animated-underline-profile" aria-selected="false" tabindex="-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign">
                                                        <line x1="12" y1="1" x2="12" y2="23"></line>
                                                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                                    </svg> Payment Details</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="animated-underline-preferences-tab" data-bs-toggle="tab" href="#animated-underline-preferences" role="tab" aria-controls="animated-underline-preferences" aria-selected="false" tabindex="-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                        <circle cx="12" cy="7" r="4"></circle>
                                                    </svg> Preferences</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="animated-underline-contact-tab" data-bs-toggle="tab" href="#animated-underline-contact" role="tab" aria-controls="animated-underline-contact" aria-selected="false" tabindex="-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone">
                                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                                    </svg> Danger Zone</button>
                                            </li> -->
                                        </ul>
                                    </div>
                                </div>

                                <div class="tab-content" id="animateLineContent-4">
                                    <div class="tab-pane fade show active" id="animated-underline-home" role="tabpanel" aria-labelledby="animated-underline-home-tab">
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                                <form method="POST" id="updateformprofile">
                                                    <div class="info">
                                                        <h6 class="">General Information</h6>
                                                        <div class="row">
                                                            <div class="col-lg-11 mx-auto">
                                                                <div class="row">

                                                                    <!--                                                                 TEMP DATA FOR STORING USER INFO -->


                                                                    <input type="hidden" name="" id="tempname" value="<?php echo $name; ?>" />
                                                                    <input type="hidden" name="" id="tempcategory" value="<?php echo $category; ?>" />
                                                                    <input type="hidden" name="" id="tempemail" value="<?php echo $email; ?>" />
                                                                    <input type="hidden" name="" id="tempmobno" value="<?php echo $mobno; ?>" />
                                                                    <input type="hidden" name="" id="temppass" value="<?php echo $password; ?>" />
                                                                    <input type="hidden" name="" id="tempstudid" value="<?php echo $rollno; ?>" />

                                                                    <!-- <div class="col-xl-2 col-lg-12 col-md-4">
                                                                    <div class="profile-image  mt-4 pe-md-4"> -->

                                                                    <!-- // The classic file input element we'll enhance
                                                                        // to a file pond, we moved the configuration
                                                                        // properties to JavaScript -->

                                                                    <!-- <div class="img-uploader-content">
                                                                            <input type="file" class="filepond"
                                                                                name="filepond" accept="image/png, image/jpeg, image/gif" />
                                                                        </div>

                                                                    </div>
                                                                </div> -->
                                                                    <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">

                                                                        <div class="form">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="fullName">Name</label>
                                                                                        <input type="text" class="form-control mb-3" id="fullName" placeholder="Full Name" value="<?php echo $name; ?>">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="studentnumber">Student No</label>
                                                                                        <input type="text" class="form-control mb-3" id="studentnumber" placeholder="Designer" disabled value="<?php echo $rollno; ?>">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">

                                                                                        <label for="category">Category</label>
                                                                                        <select class="form-select mb-3" id="category">

                                                                                            <!-- <option>All Countries</option> -->
                                                                                            <?php $catlist = ["BSIT", "BSIS", "BSCS", "ACT", "BEED", "BECAED"];
                                                                                            foreach ($catlist as $cat) {
                                                                                            ?>
                                                                                                <option
                                                                                                    <?php if ($cat == $category) {
                                                                                                    ?>
                                                                                                    selected
                                                                                                    <?php } ?>><?php echo $cat; ?></option>
                                                                                            <?php } ?>
                                                                                            <!-- <option selected>BSIT</option>
                                                                                             <option>BSIS</option>
                                                                                            <option>BSCS</option>
                                                                                            <option>ACT</option>
                                                                                            <option>BEED</option>
                                                                                            <option>BECAED</option> -->


                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="email-address">Email Address</label>
                                                                                        <input type="email" class="form-control mb-3" id="email-address" placeholder="" value="<?php echo $email; ?>">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="phone">Mobile</label>
                                                                                        <input type="text" class="form-control mb-3" id="phone" placeholder="Write your phone number here" value="<?php echo $mobno; ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="password">Password</label>
                                                                                        <input type="password" class="form-control mb-3" id="password" value="<?php echo $password; ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <input type="hidden" value="userprofileupdate" id="userprofileupdate" />


                                                                                <div class="col-md-12 mt-1">
                                                                                    <div class="form-group text-end">
                                                                                        <button class="btn btn-secondary" type="submit" id="submitbtn">
                                                                                            save
                                                                                        </button>
                                                                                    </div>
                                                                                </div>

                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="animated-underline-profile" role="tabpanel" aria-labelledby="animated-underline-profile-tab">
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-12 col-md-12 layout-spacing">
                                                <div class="section general-info payment-info">
                                                    <div class="info">
                                                        <h6 class="">Billing Address</h6>
                                                        <p>Changes to your <span class="text-success">Billing</span> information will take effect starting with scheduled payment and will be refelected on your next invoice.</p>

                                                        <div class="list-group mt-4">
                                                            <label class="list-group-item">
                                                                <div class="d-flex w-100">
                                                                    <div class="billing-radio me-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="billingAddress" id="billingAddress1" checked>
                                                                        </div>
                                                                    </div>
                                                                    <div class="billing-content">
                                                                        <div class="fw-bold">Address #1</div>
                                                                        <p>2249 Caynor Circle, New Brunswick, New Jersey</p>
                                                                    </div>
                                                                    <div class="billing-edit align-self-center ms-auto">
                                                                        <button class="btn btn-dark">Edit</button>
                                                                    </div>
                                                                </div>
                                                            </label>

                                                            <label class="list-group-item">
                                                                <div class="d-flex w-100">
                                                                    <div class="billing-radio me-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="billingAddress" id="billingAddress2">
                                                                        </div>
                                                                    </div>
                                                                    <div class="billing-content">
                                                                        <div class="fw-bold">Address #2</div>
                                                                        <p>4262 Leverton Cove Road, Springfield, Massachusetts</p>
                                                                    </div>
                                                                    <div class="billing-edit align-self-center ms-auto">
                                                                        <button class="btn btn-dark">Edit</button>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                            <label class="list-group-item">
                                                                <div class="d-flex w-100">
                                                                    <div class="billing-radio me-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="billingAddress" id="billingAddress3">
                                                                        </div>
                                                                    </div>
                                                                    <div class="billing-content">
                                                                        <div class="fw-bold">Address #3</div>
                                                                        <p>2692 Berkshire Circle, Knoxville, Tennessee</p>
                                                                    </div>
                                                                    <div class="billing-edit align-self-center ms-auto">
                                                                        <button class="btn btn-dark">Edit</button>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                        </div>

                                                        <button class="btn btn-secondary mt-4 add-address">Add Address</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-6 col-lg-12 col-md-12 layout-spacing">
                                                <div class="section general-info payment-info">
                                                    <div class="info">
                                                        <h6 class="">Payment Method</h6>
                                                        <p>Changes to your <span class="text-success">Payment Method</span> information will take effect starting with scheduled payment and will be refelected on your next invoice.</p>

                                                        <div class="list-group mt-4">

                                                            <label class="list-group-item">
                                                                <div class="d-flex w-100">
                                                                    <div class="billing-radio me-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="paymentMethod" id="paymentMethod1">
                                                                        </div>
                                                                    </div>
                                                                    <div class="payment-card">
                                                                        <img src="../src/assets/img/card-mastercard.svg" class="align-self-center me-3" alt="americanexpress">
                                                                    </div>
                                                                    <div class="billing-content">
                                                                        <div class="fw-bold">Mastercard</div>
                                                                        <p>XXXX XXXX XXXX 9704</p>
                                                                    </div>
                                                                    <div class="billing-edit align-self-center ms-auto">
                                                                        <button class="btn btn-dark">Edit</button>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                            <label class="list-group-item">
                                                                <div class="d-flex w-100">
                                                                    <div class="billing-radio me-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="paymentMethod" id="paymentMethod2" checked>
                                                                        </div>
                                                                    </div>
                                                                    <div class="payment-card">
                                                                        <img src="../src/assets/img/card-americanexpress.svg" class="align-self-center me-3" alt="americanexpress">
                                                                    </div>
                                                                    <div class="billing-content">
                                                                        <div class="fw-bold">American Express</div>
                                                                        <p>XXXX XXXX XXXX 310</p>
                                                                    </div>
                                                                    <div class="billing-edit align-self-center ms-auto">
                                                                        <button class="btn btn-dark">Edit</button>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                            <label class="list-group-item">
                                                                <div class="d-flex w-100">
                                                                    <div class="billing-radio me-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="paymentMethod" id="paymentMethod3">
                                                                        </div>
                                                                    </div>
                                                                    <div class="payment-card">
                                                                        <img src="../src/assets/img/card-visa.svg" class="align-self-center me-3" alt="americanexpress">
                                                                    </div>
                                                                    <div class="billing-content">
                                                                        <div class="fw-bold">Visa</div>
                                                                        <p>XXXX XXXX XXXX 5264</p>
                                                                    </div>
                                                                    <div class="billing-edit align-self-center ms-auto">
                                                                        <button class="btn btn-dark">Edit</button>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                        </div>

                                                        <button class="btn btn-secondary mt-4 add-payment">Add Payment Method</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-6 col-lg-12 col-md-12 layout-spacing">
                                                <div class="section general-info payment-info">
                                                    <div class="info">
                                                        <h6 class="">Add Billing Address</h6>
                                                        <p>Changes your New <span class="text-success">Billing</span> Information.</p>

                                                        <div class="row mt-4">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Name</label>
                                                                    <input type="text" class="form-control add-billing-address-input">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Email</label>
                                                                    <input type="email" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Address</label>
                                                                    <input type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">City</label>
                                                                    <input type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Country</label>
                                                                    <select class="form-select">
                                                                        <option selected="">Choose...</option>
                                                                        <option value="united-states">United States</option>
                                                                        <option value="brazil">Brazil</option>
                                                                        <option value="indonesia">Indonesia</option>
                                                                        <option value="turkey">Turkey</option>
                                                                        <option value="russia">Russia</option>
                                                                        <option value="india">India</option>
                                                                        <option value="germany">Germany</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">ZIP</label>
                                                                    <input type="tel" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <button class="btn btn-primary mt-4">Add</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-6 col-lg-12 col-md-12 layout-spacing">
                                                <div class="section general-info payment-info">
                                                    <div class="info">
                                                        <h6 class="">Add Payment Method</h6>
                                                        <p>Changes your New <span class="text-success">Payment Method</span> Information.</p>

                                                        <div class="row mt-4">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Card Brand</label>
                                                                    <div class="invoice-action-currency">
                                                                        <div class="dropdown selectable-dropdown cardName-select">
                                                                            <a id="cardBrandDropdown" href="javascript:void(0);" class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../src/assets/img/card-mastercard.svg" class="flag-width" alt="flag"> <span class="selectable-text">Mastercard</span> <span class="selectable-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                                                                        <polyline points="6 9 12 15 18 9"></polyline>
                                                                                    </svg></span></a>
                                                                            <div class="dropdown-menu" aria-labelledby="cardBrandDropdown">
                                                                                <a class="dropdown-item" data-img-value="../src/assets/img/card-mastercard.svg" data-value="GBP - British Pound" href="javascript:void(0);"><img src="../src/assets/img/card-mastercard.svg" class="flag-width" alt="flag"> Mastercard</a>
                                                                                <a class="dropdown-item" data-img-value="../src/assets/img/card-americanexpress.svg" data-value="IDR - Indonesian Rupiah" href="javascript:void(0);"><img src="../src/assets/img/card-americanexpress.svg" class="flag-width" alt="flag"> American Express</a>
                                                                                <a class="dropdown-item" data-img-value="../src/assets/img/card-visa.svg" data-value="USD - US Dollar" href="javascript:void(0);"><img src="../src/assets/img/card-visa.svg" class="flag-width" alt="flag"> Visa</a>
                                                                                <a class="dropdown-item" data-img-value="../src/assets/img/card-discover.svg" data-value="INR - Indian Rupee" href="javascript:void(0);"><img src="../src/assets/img/card-discover.svg" class="flag-width" alt="flag"> Discover</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Card Number</label>
                                                                    <input type="text" class="form-control add-payment-method-input">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Holder Name</label>
                                                                    <input type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">CVV/CVV2</label>
                                                                    <input type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Card Expiry</label>
                                                                    <input type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <button class="btn btn-primary mt-4">Add</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="animated-underline-preferences" role="tabpanel" aria-labelledby="animated-underline-preferences-tab">
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-12 col-md-12 layout-spacing">
                                                <div class="section general-info">
                                                    <div class="info">
                                                        <h6 class="">Choose Theme</h6>
                                                        <div class="d-sm-flex justify-content-around">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                                                <label class="form-check-label" for="flexRadioDefault1">
                                                                    <img class="ms-3" width="100" height="68" alt="settings-dark" src="../src/assets/img/settings-light.svg">
                                                                </label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                                                <label class="form-check-label" for="flexRadioDefault2">
                                                                    <img class="ms-3" width="100" height="68" alt="settings-light" src="../src/assets/img/settings-dark.svg">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-6 col-lg-12 col-md-12 layout-spacing">
                                                <div class="section general-info">
                                                    <div class="info">
                                                        <h6 class="">Activity data</h6>
                                                        <p>Download your Summary, Task and Payment History Data</p>
                                                        <div class="form-group mt-4">
                                                            <button class="btn btn-primary">Download Data</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                                                <div class="section general-info">
                                                    <div class="info">
                                                        <h6 class="">Public Profile</h6>
                                                        <p>Your <span class="text-success">Profile</span> will be visible to anyone on the network.</p>
                                                        <div class="form-group mt-4">
                                                            <div class="switch form-switch-custom switch-inline form-switch-secondary mt-1">
                                                                <input class="switch-input" type="checkbox" role="switch" id="publicProfile" checked>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                                                <div class="section general-info">
                                                    <div class="info">
                                                        <h6 class="">Show my email</h6>
                                                        <p>Your <span class="text-success">Email</span> will be visible to anyone on the network.</p>
                                                        <div class="form-group mt-4">
                                                            <div class="switch form-switch-custom switch-inline form-switch-secondary mt-1">
                                                                <input class="switch-input" type="checkbox" role="switch" id="showMyEmail">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                                                <div class="section general-info">
                                                    <div class="info">
                                                        <h6 class="">Enable keyboard shortcuts</h6>
                                                        <p>When enabled, press <code class="text-success">ctrl</code> for help</p>
                                                        <div class="form-group mt-4">
                                                            <div class="switch form-switch-custom switch-inline form-switch-secondary mt-1">
                                                                <input class="switch-input" type="checkbox" role="switch" id="EnableKeyboardShortcut">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                                                <div class="section general-info">
                                                    <div class="info">
                                                        <h6 class="">Hide left navigation</h6>
                                                        <p>Sidebar will be <span class="text-success">hidden</span> by default</p>
                                                        <div class="form-group mt-4">
                                                            <div class="switch form-switch-custom switch-inline form-switch-secondary mt-1">
                                                                <input class="switch-input" type="checkbox" role="switch" id="hideLeftNavigation">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                                                <div class="section general-info">
                                                    <div class="info">
                                                        <h6 class="">Advertisements</h6>
                                                        <p>Display <span class="text-success">Ads</span> on your dashboard</p>
                                                        <div class="form-group mt-4">
                                                            <div class="switch form-switch-custom switch-inline form-switch-secondary mt-1">
                                                                <input class="switch-input" type="checkbox" role="switch" id="advertisements">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                                                <div class="section general-info">
                                                    <div class="info">
                                                        <h6 class="">Social Profile</h6>
                                                        <p>Enable your <span class="text-success">social</span> profiles on this network</p>
                                                        <div class="form-group mt-4">
                                                            <div class="switch form-switch-custom switch-inline form-switch-secondary mt-1">
                                                                <input class="switch-input" type="checkbox" role="switch" id="socialprofile" checked>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="animated-underline-contact" role="tabpanel" aria-labelledby="animated-underline-contact-tab">
                                        <div class="alert alert-arrow-right alert-icon-right alert-light-warning alert-dismissible fade show mb-4" role="alert">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                                <line x1="12" y1="16" x2="12" y2="16"></line>
                                            </svg>
                                            <strong>Warning!</strong> Please proceed with caution. For any assistance - <a href="javascript:void(0);">Contact Us</a>
                                        </div>

                                        <div class="row">
                                            <div class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                                                <div class="section general-info">
                                                    <div class="info">
                                                        <h6 class="">Purge Cache</h6>
                                                        <p>Remove the active resource from the cache without waiting for the predetermined cache expiry time.</p>
                                                        <div class="form-group mt-4">
                                                            <button class="btn btn-secondary btn-clear-purge">Clear</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                                                <div class="section general-info">
                                                    <div class="info">
                                                        <h6 class="">Deactivate Account</h6>
                                                        <p>You will not be able to receive messages, notifications for up to 24 hours.</p>
                                                        <div class="form-group mt-4">
                                                            <div class="switch form-switch-custom switch-inline form-switch-success mt-1">
                                                                <input class="switch-input" type="checkbox" role="switch" id="socialformprofile-custom-switch-success">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                                                <div class="section general-info">
                                                    <div class="info">
                                                        <h6 class="">Delete Account</h6>
                                                        <p>Once you delete the account, there is no going back. Please be certain.</p>
                                                        <div class="form-group mt-4">
                                                            <button class="btn btn-danger btn-delete-account">Delete my account</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!--  BEGIN FOOTER  -->
                <div class="footer-wrapper">
                    <div class="footer-section f-section-1">
                        <p class="">Copyright © <span class="dynamic-year">2024</span> <a target="_blank" href="../../index.html">DesignReset</a>, All rights reserved.</p>
                    </div>
                    <div class="footer-section f-section-2">
                        <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg></p>
                    </div>
                </div>
                <!--  END FOOTER  -->

            </div>
            <!--  END CONTENT AREA  -->
        </div>
        <!-- END MAIN CONTAINER -->

        <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
        <script src="../../dashboard-assets/src/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../../dashboard-assets/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="../../dashboard-assets/src/plugins/src/mousetrap/mousetrap.min.js"></script>
        <script src="../../dashboard-assets/src/plugins/src/waves/waves.min.js"></script>
        <script src="../../dashboard-assets/layouts/vertical-light-menu/app.js"></script>
        <!-- END GLOBAL MANDATORY SCRIPTS -->
        <!-- External JS libraries -->
        <script src="../../assets/js/jquery.min.js"></script>


        <!--  BEGIN CUSTOM SCRIPTS FILE  -->
        <script src="../../dashboard-assets/src/plugins/src/filepond/filepond.min.js"></script>
        <script src="../../dashboard-assets/src/plugins/src/filepond/FilePondPluginFileValidateType.min.js"></script>
        <script src="../../dashboard-assets/src/plugins/src/filepond/FilePondPluginImageExifOrientation.min.js"></script>
        <script src="../../dashboard-assets/src/plugins/src/filepond/FilePondPluginImagePreview.min.js"></script>
        <script src="../../dashboard-assets/src/plugins/src/filepond/FilePondPluginImageCrop.min.js"></script>
        <script src="../../dashboard-assets/src/plugins/src/filepond/FilePondPluginImageResize.min.js"></script>
        <script src="../../dashboard-assets/src/plugins/src/filepond/FilePondPluginImageTransform.min.js"></script>
        <script src="../../dashboard-assets/src/plugins/src/filepond/filepondPluginFileValidateSize.min.js"></script>
        <script src="../../dashboard-assets/src/plugins/src/notification/snackbar/snackbar.min.js"></script>
        <script src="../../dashboard-assets/src/plugins/src/sweetalerts2/sweetalerts2.min.js"></script>
        <script src="../../dashboard-assets/src/assets/js/users/account-settings.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!--  END CUSTOM SCRIPTS FILE  -->

        <script>
            // start of update profile
            $('#updateformprofile').submit(function(event) {
                event.preventDefault();

                console.log("preventDefault")
                let studentname = $('#fullName').val();
                let password = $('#password').val();
                let phonenumber = $('#phone').val();
                let studentnumber = $('#studentnumber').val();
                let category = $('#category').val();
                let email = $('#email-address').val();
                let updateData = $("#userprofileupdate");

                let tempname = $("#tempname").val();
                let tempcategory = $("#tempcategory").val();
                let tempemail = $("#tempemail").val();
                let tempmobno = $("#tempmobno").val();
                let temppass = $("#temppass").val();
                let tempstudid = $("#tempstudid").val();

                let userCurrentData = [{
                    studentname: tempname,
                    email: tempemail,
                    password: temppass,
                    phonenumber: tempmobno,
                    studentnumber: tempstudid,
                    category: tempcategory,
                }]
                let submittedData = [{
                    studentname,
                    email,
                    password,
                    phonenumber,
                    studentnumber,
                    category,

                }]
                $.ajax({
                    url: '../sql-actions/update-data.php',
                    type: 'POST',
                    data: {
                        studentname,
                        email,
                        password,
                        phonenumber,
                        studentnumber,
                        category,
                        action: 'updateprofile',
                        userCurrentData,
                        submittedData
                    }, // Pass an action parameter for login
                    success: function(response) {
                        // Clear previous error messages


                        let res = JSON.parse(response);
                        // console.log("studentnumber=>", studentnumber)
                        if (res.status === 'error') {
                            if (res.message.sameData) {
                                Swal.fire({
                                    title: "No Changes",
                                    text: "No changes has been made.",
                                    icon: "error",
                                    // showConfirmButton: false,
                                });
                            } else if (res.message.emailexist) {


                                Swal.fire({
                                    title: "Email Already Exist",
                                    text: "Email address is already registered.",
                                    icon: "error",
                                    // showConfirmButton: false,
                                });
                            }
                        } else {
                            Swal.fire({
                                title: "Successfully updated",
                                text: "Refreshing the page...",
                                icon: "success",
                                showConfirmButton: false,
                            });
                            // Redirect on successful sign-in
                            setTimeout(function() {
                                // window.location.href = 'student/index-assets.php';
                                location.reload();

                            }, 2000);

                        }
                    }
                });
            });
            // endof signup
        </script>
    </body>

    <!-- Mirrored from designreset.com/equation/html/vertical-light-menu/user-account-settings.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 22 Oct 2024 11:24:06 GMT -->

    </html>

<?php } ?>