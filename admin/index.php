<?php
require('../connection/pdo.php');
include('../sugarhelper.php');
$db = new DatabaseConnect();

$rollno = isset($_SESSION['RollNo']) ? $_SESSION['RollNo'] : null;
$roletype = isset($_SESSION['RoleType']) ? $_SESSION['RoleType'] : null;

if (isset($_SESSION['RollNo']) && isset($_SESSION['RoleType'])) {

    if ($roletype === 'Admin') {
        $db->query("SELECT * from user where RollNo = ?");
        $db->bind(1, $_SESSION['RollNo']);
        $currentuser = $db->single();
        // dd($currentuser);
        // $name = $currentuser['Name'];
        // $category = $currentuser['Category'];
        $email = $currentuser['Email'];
        $mobno = $currentuser['MobNo'];

        // message count 
        $db->query("SELECT * FROM message");
        $messages = $db->set();

        // books count
        $db->query("SELECT * FROM book;");
        $books = $db->set();

        // // prrevious
        $db->query("SELECT * FROM borrowrecords AS br where status = 'borrowed' order by borrowdate desc");
        $previous_records = $db->set();

        // ISSUE
        $db->query("SELECT * FROM borrowrecords AS br where status = 'borrowrequest'");
        $borrow_request = $db->set();



        // RENEW
        $db->query("SELECT * FROM renewalrequest where status = 'pending'");
        $renew_request = $db->set();

        // Return 
        $db->query("SELECT * FROM returnrequest;");
        $return_request = $db->set();


        // // current issue books

        // $db->query("SELECT 
        // record.BookId,RollNo,Title,Due_Date,Date_of_Borrow,datediff(curdate(),Due_Date) 
        // AS x FROM  `record`,book WHERE Date_of_Borrow is NOT NULL and Date_of_Return is NULL and book.Bookid = record.BookId");
        // $current_issuebooks = $db->set();
?>

        <!DOCTYPE html>
        <html lang="en">

        <!-- Mirrored from designreset.com/equation/html/vertical-light-menu/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 22 Oct 2024 11:15:16 GMT -->

        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
            <title>PCB CATALOGUING SYSTEM</title>
            <link rel="icon" type="image/x-icon" href="../src/assets/img/favicon.ico" />
            <link href="../dashboard-assets/layouts/vertical-light-menu/css/light/loader.css" rel="stylesheet" type="text/css" />
            <link href="../dashboard-assets/layouts/vertical-light-menu/css/dark/loader.css" rel="stylesheet" type="text/css" />
            <script src="../dashboard-assets/layouts/vertical-light-menu/loader.js"></script>

            <!-- BEGIN GLOBAL MANDATORY STYLES -->
            <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
            <link href="../dashboard-assets/src/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
            <link href="../dashboard-assets/layouts/vertical-light-menu/css/light/plugins.css" rel="stylesheet" type="text/css" />
            <link href="../dashboard-assets/layouts/vertical-light-menu/css/dark/plugins.css" rel="stylesheet" type="text/css" />
            <!-- END GLOBAL MANDATORY STYLES -->

            <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
            <link href="../dashboard-assets/src/plugins/src/apex/apexcharts.css" rel="stylesheet" type="text/css">
            <link href="../dashboard-assets/src/assets/css/light/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
            <link href="../dashboard-assets/src/assets/css/dark/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" href="../dashboard-assets/src/assets/css/structure.css">
            <link rel="stylesheet" href="../dashboard-assets/src/assets/css/perfect-scrollbar.css">
            <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES 
     
    C:\laragon\www\pcbthesis\dashboard-assets\src\assets\css\structure.css
    -->
            <link rel="stylesheet" href="../dashboard-assets/src/plugins/src/sweetalerts2/sweetalerts2.css">
            <link href="../dashboard-assets/src/plugins/css/light/sweetalerts2/custom-sweetalert.css" rel="stylesheet" type="text/css" />
            <script src="../dashboard-assets/src/plugins/src/sweetalerts2/sweetalerts2.min.js"></script>
        </head>

        <body class="layout-boxed">
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



                    <ul class="navbar-item flex-row ms-lg-auto ms-0">



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
                                    <a href="#">
                                        <img src="./images/log.png" class="navbar-logo d-none" alt="logo">
                                    </a>
                                    <a href="#">
                                        <img src="../images/logo.png" class="navbar-logo" alt="logo" width="46" height="46">
                                    </a>
                                </div>

                                <div class="nav-item theme-text">
                                    <a href="#" class="nav-link"> PCB </a>
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
                                    <h6 class="">Admin</h6>
                                    <!-- <p class=""><?php echo $category; ?></p> -->
                                </div>
                            </div>
                        </div>

                        <div class="shadow-bottom"></div>
                        <ul class="list-unstyled menu-categories" id="accordionExample">






                            <li class="menu menu-heading">
                                <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg><span>ADMIN AND PAGES</span></div>
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
                                        <span>ADMIN</span>
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                            <polyline points="9 18 15 12 9 6"></polyline>
                                        </svg>
                                    </div>
                                </a>
                                <ul class="collapse submenu list-unstyled show" id="users" data-bs-parent="#accordionExample">
                                    <li class="active">
                                        <a href="./"> Profile </a>
                                    </li>
                                    <li>
                                        <a href="./admin-account-settings"> Account Settings </a>
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
                                        <a href="./message-page"> Messages</a>
                                    </li>
                                    <li>
                                        <a href="./all-books"> All Books </a>
                                    </li>
                                    <li>
                                        <a href="./all-return-records"> All Return Records </a>
                                    </li>
                                    <li>
                                        <a href="./manage-students"> Manage Students </a>
                                    </li>
                                    <li>
                                        <a href="./book-issue-requests"> Borrow Requests </a>
                                    </li>
                                    <li>
                                        <a href="./book-renew-requests"> Renew Requests </a>
                                    </li>
                                    <li class="active">
                                        <a href="./book-return-requests"> Return Requests </a>
                                    </li>
                                    <li>
                                        <a href="./currently-issued-books"> Currently Issued Books </a>
                                    </li>

                                </ul>
                            </li>
                            <li class="menu">
                                <!-- <a href="./logout.php" aria-expanded="false" class="dropdown-toggle">
                                    <div class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                        </svg>

                                        <span>Logout</span>
                                    </div>
                                </a> -->
                                <button id="logoutbtn" class="dropdown-toggle" style="border: none; border: 0; outline: none;">
                                    <div class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                        </svg>

                                        <span>Logout</span>
                                    </div>
                                </button>
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
                            <!-- <div class="page-meta">
                        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Users</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Profile</li>
                            </ol>
                        </nav>
                    </div> -->
                            <!-- /BREADCRUMB -->

                            <div class="row layout-spacing ">

                                <!-- Content -->
                                <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">
                                    <div class="user-profile">
                                        <div class="widget-content widget-content-area">
                                            <div class="d-flex justify-content-between">
                                                <h3 class="">Profile</h3>
                                                <a href="./admin-account-settings.php" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3">
                                                        <path d="M12 20h9"></path>
                                                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                                    </svg></a>
                                            </div>
                                            <div class="text-center user-info">
                                                <img src="../dashboard-assets/src/assets/img/profile-30.png" alt="avatar">
                                                <p class="">Admin</p>
                                            </div>
                                            <div class="user-info-list">

                                                <div class="">
                                                    <ul class="contacts-block list-unstyled">
                                                        <li class="contacts-block__item">
                                                            <div class="d-flex align-items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee me-3">
                                                                    <path d="M18 8h1a4 4 0 0 1 0 8h-1"></path>
                                                                    <path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path>
                                                                    <line x1="6" y1="1" x2="6" y2="4"></line>
                                                                    <line x1="10" y1="1" x2="10" y2="4"></line>
                                                                    <line x1="14" y1="1" x2="14" y2="4"></line>
                                                                </svg>
                                                                <p class="stud-info">User: <strong>Admin</strong></p>

                                                            </div>
                                                        </li>


                                                        <li class="contacts-block__item">

                                                            <div class="d-flex align-items-center">
                                                                <a href="mailto:example@mail.com"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail me-3">
                                                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                                                        <polyline points="22,6 12,13 2,6"></polyline>
                                                                    </svg>
                                                                    Email: <?php echo $email; ?></a>
                                                                <!-- <p class="stud-info">Category: <strong>BSIT</strong></p> -->
                                                            </div>
                                                        </li>
                                                        <li class="contacts-block__item">

                                                            <div class="d-flex align-items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone me-3">
                                                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                                                </svg>
                                                                <p class="stud-info">Mobile: <strong><?php echo $mobno; ?></strong></p>
                                                            </div>
                                                        </li>
                                                    </ul>

                                                    <ul class="list-inline mt-4">
                                                        <li class="list-inline-item mb-0">
                                                            <a class="btn btn-info btn-icon btn-rounded" href="javascript:void(0);">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                                                </svg>

                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <a class="btn btn-danger btn-icon btn-rounded" href="javascript:void(0);">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                                                </svg>

                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <a class="btn btn-dark btn-icon btn-rounded" href="javascript:void(0);">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github">
                                                                    <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
                                                                </svg>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">

                                    <div class="usr-tasks ">
                                        <div class="widget-content widget-content-area">
                                            <h3 class="">Notification Summary</h3>
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <!-- <th>Progress</th> -->
                                                            <th>Counts</th>
                                                            <th class="text-center">Navigate</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Borrow Request</td>
                                                            <!-- <td>
                                                        <div class="progress br-30">
                                                            <div class="progress-bar br-30 bg-danger" role="progressbar" style="width: 29.56%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td> -->

                                                            <td>
                                                                <?php echo count($borrow_request); ?>
                                                            </td>
                                                            <td class="text-center ">
                                                                <a class="btn btn-outline-success mb-2 me-auto " href="./book-issue-requests">view</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Renew Request</td>
                                                            <!-- <td>
                                                        <div class="progress br-30">
                                                            <div class="progress-bar br-30 bg-danger" role="progressbar" style="width: 29.56%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td> -->
                                                            <td>

                                                                <?php echo count($renew_request); ?>
                                                            </td>
                                                            <td class="text-center ">
                                                                <a class="btn btn-outline-success mb-2 me-auto " href="./book-renew-requests">view</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Return Request</td>
                                                            <!-- <td>
                                                        <div class="progress br-30">
                                                            <div class="progress-bar br-30 bg-danger" role="progressbar" style="width: 29.56%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td> -->
                                                            <td>
                                                                <?php echo count($return_request); ?>

                                                            </td>
                                                            <td class="text-center ">
                                                                <a class="btn btn-outline-success mb-2 me-auto " href="./book-return-requests">view</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>All Books</td>

                                                            <td>
                                                                <?php echo count($books); ?>

                                                            </td>
                                                            <td class="text-center">
                                                                <a class="btn btn-outline-success mb-2 me-auto " href="./all-books">view</a>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>Currently Issued Books</td>
                                                            <!-- <td>
                                                        <div class="progress br-30">
                                                            <div class="progress-bar br-30 bg-success" role="progressbar" style="width: 78.03%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td> -->
                                                            <td>
                                                                <?php echo count($previous_records); ?>

                                                            </td>
                                                            <td class="text-center">

                                                                <a class="btn btn-outline-success mb-2 me-auto " href="./currently-issued-books">view</a>
                                                            </td>
                                                        </tr>



                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>



                        </div>

                    </div>



                </div>
                <!--  END CONTENT AREA  -->
            </div>
            <!-- END MAIN CONTAINER -->

            <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
            <script src="../dashboard-assets/src/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="../dashboard-assets/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js"></script>
            <script src="../dashboard-assets/src/plugins/src/mousetrap/mousetrap.min.js"></script>
            <script src="../dashboard-assets/src/plugins/src/waves/waves.min.js"></script>
            <script src="../dashboard-assets/layouts/vertical-light-menu/app.js"></script>
            <!-- END GLOBAL MANDATORY SCRIPTS -->

            <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
            <script src="../dashboard-assets/src/plugins/src/apex/apexcharts.min.js"></script>
            <script src="../dashboard-assets/src/assets/js/dashboard/dash_1.js"></script>
            <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
            <script>
                let logoutbtn = document.querySelector('#logoutbtn');
                logoutbtn.addEventListener('click', function() {
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: "btn btn-success",
                            cancelButton: "btn btn-danger"
                        },
                        buttonsStyling: true
                    });
                    swalWithBootstrapButtons.fire({
                        title: "Logout?",
                        // text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Confirm",
                        cancelButtonText: "Cancel",
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            swalWithBootstrapButtons.fire({
                                title: "Logging out...",
                                text: "Redirecting to login page...",
                                icon: "success"
                            });
                            setTimeout(function() {
                                window.location.href = './logout.php';


                            }, 2000);
                        }

                    });
                });
            </script>

        </body>

        <!-- Mirrored from designreset.com/equation/html/vertical-light-menu/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 22 Oct 2024 11:15:55 GMT -->

        </html>

<?php } else {
        header('Location:../student/');
    }
} else {
    header('Location:./login/index.php');
    exit;
}
