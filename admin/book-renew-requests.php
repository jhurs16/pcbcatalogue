<?php
require('../connection/pdo.php');
include('../sugarhelper.php');
$db = new DatabaseConnect();

$rollno = isset($_SESSION['RollNo']) ? $_SESSION['RollNo'] : null;

if (isset($_SESSION['RollNo'])) {






    // books count
    $db->query("SELECT * FROM book;");
    $books = $db->set();

    // $db->query("SELECT * FROM record, book, renew WHERE renew.BookId=book.BookId AND renew.RollNo=record.RollNo AND renew.BookId=record.BookId");
    // $renew_request = $db->set();

    $db->query("SELECT rr.*, br.*, b.Title AS bookname FROM renewalrequest rr
INNER JOIN borrowrecords br ON rr.recordid = br.recordid
INNER JOIN book b ON b.BookId = br.bookid WHERE rr.`status` = 'pending';");
    $renew_request = $db->set();


    //dd($renew_request);
    // Decode JSON string back to a PHP array
    // $authorsjson = json_decode($bookauthor["Author"], true);

    // Now $authors is an array you can work with in PHP
    //var_dump($authorsjson);


?>
    <!DOCTYPE html>
    <html lang="en">

    <!-- Mirrored from designreset.com/equation/html/vertical-light-menu/table-datatable-custom.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 22 Oct 2024 11:23:48 GMT -->

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

        <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
        <link rel="stylesheet" type="text/css" href="../dashboard-assets/src/plugins/src/table/datatable/datatables.css">

        <link rel="stylesheet" type="text/css" href="../dashboard-assets/src/plugins/css/light/table/datatable/dt-global_style.css">
        <link rel="stylesheet" type="text/css" href="../dashboard-assets/src/plugins/css/light/table/datatable/custom_dt_custom.css">

        <link rel="stylesheet" type="text/css" href="../dashboard-assets/src/plugins/css/dark/table/datatable/dt-global_style.css">
        <link rel="stylesheet" type="text/css" href="../dashboard-assets/src/plugins/css/dark/table/datatable/custom_dt_custom.css">

        <!-- END PAGE LEVEL CUSTOM STYLES -->


        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link rel="stylesheet" href="../dashboard-assets/src/plugins/src/filepond/filepond.min.css">
        <link rel="stylesheet" href="../dashboard-assets/src/plugins/src/filepond/FilePondPluginImagePreview.min.css">
        <link href="../dashboard-assets/src/plugins/src/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../dashboard-assets/src/plugins/src/sweetalerts2/sweetalerts2.css">

        <link href="../dashboard-assets/src/plugins/css/light/filepond/custom-filepond.css" rel="stylesheet" type="text/css" />
        <link href="../dashboard-assets/src/assets/css/light/components/tabs.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="../src/assets/css/light/elements/alert.css">

        <link href="../dashboard-assets/src/plugins/css/light/sweetalerts2/custom-sweetalert.css" rel="stylesheet" type="text/css" />
        <link href="../dashboard-assets/src/plugins/css/light/notification/snackbar/custom-snackbar.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="../dashboard-assets/src/assets/css/light/forms/switches.css">
        <link href="../dashboard-assets/src/assets/css/light/components/list-group.css" rel="stylesheet" type="text/css">

        <link href="../dashboard-assets/src/assets/css/light/users/account-setting.css" rel="stylesheet" type="text/css" />



        <link href="../dashboard-assets/src/plugins/css/dark/filepond/custom-filepond.css" rel="stylesheet" type="text/css" />
        <link href="../dashboard-assets/src/assets/css/dark/components/tabs.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="../dashboard-assets/src/assets/css/dark/elements/alert.css">

        <link href="../dashboard-assets/src/plugins/css/dark/sweetalerts2/custom-sweetalert.css" rel="stylesheet" type="text/css" />
        <link href="../dashboard-assets/src/plugins/css/dark/notification/snackbar/custom-snackbar.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="../dashboard-assets/src/assets/css/dark/forms/switches.css">
        <link href="../dashboard-assets/src/assets/css/dark/components/list-group.css" rel="stylesheet" type="text/css">

        <link href="../dashboard-assets/src/assets/css/dark/users/account-setting.css" rel="stylesheet" type="text/css" />

        <style>
            #authors-container {
                display: flex;
                gap: 5px;
                flex-wrap: wrap;
                margin-bottom: 10px;
            }

            #authors-container span {
                color: #fff;
                padding: 6px 0 6px 8px;
                ;
                font-weight: 500;
                font-size: 14px;
                background: #2196f3;
                border-radius: 4px;
            }

            #authors-container span button {
                background: none;
                border: none;
                border: 0;
                outline: none;
                color: #e7515a;
                font-size: 16px;
                font-weight: 700;
            }
        </style>
        <!--  END CUSTOM STYLE FILE  -->
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
                                <h6 class="">ADMIN</h6>

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

                        <li class="menu">
                            <a href="#users" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
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
                            <ul class="collapse submenu list-unstyled " id="users" data-bs-parent="#accordionExample">
                                <li>
                                    <a href="./"> Profile </a>
                                </li>
                                <li>
                                    <a href="./user/user-account-settings"> Account Settings </a>
                                </li>
                            </ul>
                        </li>

                        <li class="menu active">
                            <a href="#pages" data-bs-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
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
                            <ul class="collapse submenu list-unstyled show" id="pages" data-bs-parent="#accordionExample">
                                <li>
                                    <a href="./message-page"> Messages</a>
                                </li>
                                <li>
                                    <a href="./all-books"> All Books </a>
                                </li>
                                <li>
                                    <a href="./manage-students"> Manage Students </a>
                                </li>
                                <li>
                                    <a href="./book-issue-requests"> Borrow Requests </a>
                                </li>
                                <li class="active">
                                    <a href="./book-renew-requests"> Renew Requests </a>
                                </li>
                                <li>
                                    <a href="./book-return-requests"> Return Requests </a>
                                </li>
                                <li>
                                    <a href="./currently-issued-books"> Currently Issued Books </a>
                                </li>

                            </ul>
                        </li>
                        <li class="menu">
                            <!-- <a href="logout.php" aria-expanded="false" class="dropdown-toggle">
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




                <!-- NAVIGATION  TABS START -->
                <div class="layout-px-spacing">

                    <div class="middle-content container-xxl p-0">

                        <!-- BREADCRUMB -->
                        <div class="page-meta">
                            <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <!-- <li class="breadcrumb-item"><a href="#">Users</a></li> -->
                                    <li class="breadcrumb-item active" aria-current="page">All Book Renew Request</li>
                                </ol>
                            </nav>
                        </div>
                        <!-- /BREADCRUMB -->

                        <div class="account-settings-container layout-top-spacing">

                            <div class="account-content">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <h2>Book Renew Requests </h2>

                                        <ul class="nav nav-pills" id="animateLine" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="animated-underline-home-tab" data-bs-toggle="tab" href="#animated-underline-home" role="tab" aria-controls="animated-underline-home" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                                    </svg>
                                                    Renew Requests</button>
                                            </li>
                                            <!--
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="animated-underline-profile-tab" data-bs-toggle="tab" href="#animated-underline-profile" role="tab" aria-controls="animated-underline-profile" aria-selected="false" tabindex="-1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 0 0 2.25-2.25V6a2.25 2.25 0 0 0-2.25-2.25H6A2.25 2.25 0 0 0 3.75 6v2.25A2.25 2.25 0 0 0 6 10.5Zm0 9.75h2.25A2.25 2.25 0 0 0 10.5 18v-2.25a2.25 2.25 0 0 0-2.25-2.25H6a2.25 2.25 0 0 0-2.25 2.25V18A2.25 2.25 0 0 0 6 20.25Zm9.75-9.75H18a2.25 2.25 0 0 0 2.25-2.25V6A2.25 2.25 0 0 0 18 3.75h-2.25A2.25 2.25 0 0 0 13.5 6v2.25a2.25 2.25 0 0 0 2.25 2.25Z" />
                                                    </svg>
                                                    Renew Requests</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="animated-underline-preferences-tab" data-bs-toggle="tab" href="#animated-underline-preferences" role="tab" aria-controls="animated-underline-preferences" aria-selected="false" tabindex="-1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                                    </svg>
                                                    Return Requests</button>
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
                                        <div class="row layout-spacing">

                                            <div class="col-lg-12">
                                                <div class="statbox widget box box-shadow">
                                                    <div class="widget-content widget-content-area">
                                                        <table id="style-3" class="table style-3 dt-table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>Student Number</th>
                                                                    <th>Book Id</th>
                                                                    <th>Book Name</th>
                                                                    <th>Renewals Left</th>


                                                                    <th class="text-center">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php


                                                                foreach ($renew_request as $rrequest):


                                                                    $bookid = $rrequest['bookid'];
                                                                    $rollno = $rrequest['userid'];
                                                                    $name = $rrequest['bookname'];
                                                                    $renewals = $rrequest['renewalsleft'];
                                                                    $recordid = $rrequest['recordid'];
                                                                ?>


                                                                    <tr>

                                                                        <td class="text-center">
                                                                            <?php echo $rollno; ?>
                                                                        </td>

                                                                        <td class="text-center">
                                                                            <?php echo $bookid; ?>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <?php echo $name; ?>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <?php echo $renewals; ?>
                                                                        </td>




                                                                        <td class="text-center">

                                                                            <?php if ($renewals > 0): ?>
                                                                                <button class="btn btn-success mb-2 me-1" onclick="showacceptModal(
                                                                                '<?php echo $name; ?>',
                                                                                '<?php echo $bookid; ?>',
                                                                                '<?php echo $rollno; ?>', 
                                                                                'accept',
                                                                                '<?php echo $recordid; ?>'
                                                                            )">Accept</button>
                                                                            <?php endif; ?>

                                                                            <button class="btn btn-danger mb-2 me-1" onclick="showacceptModal('<?php echo $name; ?>','<?php echo $bookid; ?>','<?php echo $rollno; ?>', 'reject', '<?php echo $recordid; ?>')">Reject</button>

                                                                        </td>

                                                                    </tr>
                                                                <?php endforeach; ?>


                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="animated-underline-profile" role="tabpanel" aria-labelledby="animated-underline-profile-tab">
                                        <div class="row">


                                            <div class="col-xl-6 col-lg-12 col-md-12 layout-spacing">
                                                <div class="section general-info payment-info">
                                                    <div class="info">
                                                        <h6 class="">Add Book</h6>
                                                        <p>Fill up the following <span class="text-success">fields</span> and submit to add your book.</p>

                                                        <div class="row mt-2">
                                                            <form method="POST" id="addbookform">
                                                                <div class="col-12">

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Name</label>
                                                                        <input type="text" class="form-control" id="addbookname" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="form-label ">Author</label>
                                                                    <p class="text-success">You can add multiple authors, by pressing add.</p>
                                                                    <div class="mb-3 d-flex">

                                                                        <!-- <input type="text" class="form-control add-billing-address-input"> -->
                                                                        <input type="text" class="form-control" id="author-input" placeholder="Enter author and press Add button">

                                                                        <button class="btn btn-info text-nowrap ms-2" id="addauthorbtn" type="button">Add</button>
                                                                    </div>
                                                                    <div id="authors-container" class="d-flex"></div>
                                                                    <input type="hidden" name="authors" id="authors">
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Publisher</label>
                                                                        <input type="text" class="form-control" id="addbookpublisher">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Year</label>
                                                                        <input type="number" class="form-control" id="addbookyear">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Number of Copies</label>
                                                                        <input type="number" class="form-control" id="addbookcopies" value="0">
                                                                    </div>
                                                                </div>
                                                                <button class="btn btn-primary mt-4" type="submit">Save</button>
                                                            </form>

                                                        </div>


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
                <!-- NAVIGATION TABS END  -->
                <!--  BEGIN FOOTER  -->
                <!-- <div class="footer-wrapper">
                    <div class="footer-section f-section-1">
                        <p class="">Copyright © <span class="dynamic-year">2024</span> <a target="_blank" href="../../index.html">DesignReset</a>, All rights reserved.</p>
                    </div>
                    <div class="footer-section f-section-2">
                        <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg></p>
                    </div>
                </div> -->
                <!--  END CONTENT AREA  -->
            </div>
            <!--  END CONTENT AREA  -->
        </div>

        <div id="modal-container"></div>
        <div id="modal-edit-container"></div>
        <div id="modal-delete-container"></div>
        <div id="modal-add-container"></div>
        <div id="modal-accept-container"></div>
        <!-- END MAIN CONTAINER -->


        <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
        <script src="./scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="../dashboard-assets/src/plugins/src/global/vendors.min.js"></script>
        <script src="../dashboard-assets/src/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../dashboard-assets/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="../dashboard-assets/src/plugins/src/mousetrap/mousetrap.min.js"></script>
        <script src="../dashboard-assets/src/plugins/src/waves/waves.min.js"></script>
        <script src="../dashboard-assets/layouts/vertical-light-menu/app.js"></script>


        <script src="../dashboard-assets/src/assets/js/custom.js"></script>
        <script src="../dashboard-assets/src/plugins/src/sweetalerts2/sweetalerts2.min.js"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

        <!-- END GLOBAL MANDATORY SCRIPTS -->

        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="../dashboard-assets/src/plugins/src/table/datatable/datatables.js"></script>
        <!-- modal details show  -->
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
            let authors = [];

            // Add author on Enter key press
            // console.log(document.getElementById('author-input'))
            // document.getElementById('author-input').addEventListener('keypress', function(e) {
            //     if (e.key === 'Enter') {
            //         e.preventDefault();

            //         const author = this.value.trim();
            //         if (author && !authors.includes(author)) { // Avoid duplicates
            //             authors.push(author);
            //             renderAuthors();
            //             this.value = ''; // Clear input
            //         }
            //     }
            // });
            let addauthor = document.querySelector("#addauthorbtn");
            let authordata = document.getElementById('author-input')
            $('#bookiddelete').val();
            addauthor.addEventListener('click', function(e) {
                e.preventDefault();
                const author = authordata.value.trim();
                if (author && !authors.includes(author)) { // Avoid duplicates
                    authors.push(author);
                    renderAuthors();
                    author.value = ''; // Clear input
                    authordata.value = ''; //
                }
            });

            // Render authors list with remove functionality
            function renderAuthors() {
                const container = document.getElementById('authors-container');
                container.innerHTML = ''; // Clear container

                authors.forEach((author, index) => {
                    const authorSpan = document.createElement('span');
                    authorSpan.innerText = author;
                    authorSpan.style.marginRight = '5px';
                    // authorSpan.style.padding = '5px';

                    // Add remove button (X) for each author
                    const removeButton = document.createElement('button');
                    removeButton.innerText = 'X';
                    removeButton.style.marginLeft = '5px';
                    removeButton.style.cursor = 'pointer';

                    // Remove author on click
                    removeButton.addEventListener('click', function() {
                        authors.splice(index, 1); // Remove author from array
                        renderAuthors(); // Re-render the list
                    });

                    // Append author and remove button to the container
                    authorSpan.appendChild(removeButton);
                    container.appendChild(authorSpan);
                });

                // Update hidden input with JSON-encoded authors array
                document.getElementById('authors').value = JSON.stringify(authors);

            }
        </script>
        <script>
            function createModal(title, publisher, year, availability) {
                return `
        <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="background: #fff">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Book Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <svg> ... </svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6>Name: <strong>${title}</strong></h6>
                        <p>Publisher: <strong>${publisher}</strong></p>
                        <p>Year: <strong>${year}</strong></p>
                        <p>Availability:
                            <span class="shadow-none badge badge-${availability > 0 ? 'success': 'danger'}">${availability}</span>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn btn-success" data-bs-dismiss="modal"><i class="flaticon-cancel-12"></i> OK</button>

                    </div>
                </div>
            </div>
        </div>
        `;


            }

            function showModal(title, publisher, year, availability) {
                // var myModal = new bootstrap.Modal(document.getElementById('myModal'));
                // myModal.show();
                // const myModal = new bootstrap.Modal(document.getElementById('myModal'), options)
                // myModal.show();

                let existingModal = document.getElementById('exampleModal');
                if (existingModal) {
                    var bsModal = bootstrap.Modal.getInstance(existingModal); // Get the existing Bootstrap modal instance
                    if (bsModal) {
                        bsModal.dispose(); // Dispose the modal instance (clean up event listeners, etc.)
                    }
                    existingModal.remove(); // Remove the modal from the DOM
                }


                const modalcontainer = document.getElementById('modal-container');
                modalcontainer.innerHTML = createModal(title, publisher, year, availability);

                var modalElement = document.getElementById('exampleModal');

                // Ensure the modal is properly initialized by Bootstrap
                modalElement.addEventListener('shown.bs.modal', function() {
                    console.log('Modal is now shown');
                });

                // Initialize and show the modal
                var myModal = new bootstrap.Modal(modalElement);
                myModal.show();

            }

            // request issue book

            function issueBook(bookId, rollno) {


                $.ajax({
                    url: './sql-actions/request-book-issue.php',
                    type: 'GET',
                    data: {
                        bookId,
                        rollno
                    }, // Pass an action parameter for login
                    success: function(response) {
                        // Clear previous error messages


                        let res = JSON.parse(response);
                        // console.log("studentnumber=>", studentnumber)
                        if (res.status === 'error') {
                            if (res.message.request) {
                                Swal.fire({
                                    title: "Already Sent",
                                    text: res.message.request,
                                    icon: "error",
                                    //showConfirmButton: true,
                                });
                            }
                        } else {
                            Swal.fire({
                                title: "Success",
                                text: "Successfully Requested!",
                                icon: "success",
                                // showConfirmButton: false,
                            });
                            // Redirect on successful sign-in
                            // setTimeout(function() {
                            // // window.location.href = 'student/index-assets.php';
                            // location.reload();

                            // }, 2000);

                        }
                    }
                });
            }

            /// EDIT THE BOOKS

            function editbookmodal(title, publisher, year, availability, bookid) {
                return `
        <div class="modal fade " id="editbookmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="background: #fff">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Book Update</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <svg> ... </svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="editbook" onsubmit="updateBookNow(event)">
                            <div class="row mb-4">
                                <input type="hidden" class="form-control" id="bookid" value="${bookid}">
                                <div class="col-sm-12">
                                    <label for="bookname" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="bookname" value="${title}" required>
                                </div>
                            </div>
                            <div class="row mb-4">

                                <div class="col-sm-12">
                                    <label for="publisher" class="form-label">Publisher</label>
                                    <input type="text" class="form-control" id="publisher" value="${publisher}" required>
                                </div>
                            </div>

                            <div class="row mb-4">

                                <div class="col-sm-12">
                                    <label for="year" class="form-label">Year</label>
                                    <input type="text" class="form-control" id="year" value="${year}" required>
                                </div>
                            </div>
                            <div class="row mb-4">

                                <div class="col-sm-12">
                                    <label for="availability" class="form-label">Availability</label>
                                    <input type="number" class="form-control" id="availability" value="${availability}" required>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-success">Update</button>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn btn-danger" data-bs-dismiss="modal"><i class="flaticon-danger-12"></i> Cancel</button>

                    </div>
                </div>
            </div>
        </div>
        `;
            }


            /// ADD BOOK


            // ACCEPT BOOK
            function acceptbookModal(title, bookid, rollno, issueaction, recordid) {
                return `
        <div class="modal fade " id="acceptbookmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="background: #fff">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Book: ${issueaction} renew request</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <svg> ... </svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="acceptbookform" onsubmit="acceptBookNow(event)">
                            <div class="row mb-4">
                                <input type="hidden" class="form-control" id="acceptbookid" value="${bookid}">
                                <input type="hidden" class="form-control" id="acceptbookrollno" value="${rollno}">
                                <input type="hidden" class="form-control" id="acceptbooktitle" value="${title}">
                                <input type="hidden" class="form-control" id="acceptrejectbook" value="${issueaction}">
                                <input type="hidden" class="form-control" id="acceptrejectrecordid" value="${recordid}">
                                <h6>Are you sure you want to ${issueaction} this renew request?</h6>
                                <p>Student Id: ${rollno}</p>
                                <p>Book Name: ${title}</p>
                         
                            </div>




                            <button type="submit" class="btn btn-info">Confirm</button>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn btn-danger" data-bs-dismiss="modal"><i class="flaticon-danger-12"></i> Cancel</button>

                    </div>
                </div>
            </div>
        </div>
        `;
            }

            function showeditModal(title, publisher, year, availability, bookid) {
                // var myModal = new bootstrap.Modal(document.getElementById('myModal'));
                // myModal.show();
                // const myModal = new bootstrap.Modal(document.getElementById('myModal'), options)
                // myModal.show();

                let existingeditModal = document.getElementById('editbookmodal');
                if (existingeditModal) {
                    var bseditModal = bootstrap.Modal.getInstance(existingeditModal); // Get the existing Bootstrap modal instance
                    if (bseditModal) {
                        bseditModal.dispose(); // Dispose the modal instance (clean up event listeners, etc.)
                    }
                    existingeditModal.remove(); // Remove the modal from the DOM
                }


                const modaleditcontainer = document.getElementById('modal-edit-container');
                modaleditcontainer.innerHTML = editbookmodal(title, publisher, year, availability, bookid);

                var modalElement = document.getElementById('editbookmodal');

                // Ensure the modal is properly initialized by Bootstrap
                modalElement.addEventListener('shown.bs.modal', function() {
                    console.log('Modal is now shown');
                });

                // Initialize and show the modal
                var myModal = new bootstrap.Modal(modalElement);
                myModal.show();

            }

            function showaddModal() {


                let existingaddModal = document.getElementById('addbookmodal');
                if (existingaddModal) {
                    var bsaddModal = bootstrap.Modal.getInstance(existingaddModal); // Get the existing Bootstrap modal instance
                    if (bsaddModal) {
                        bsaddModal.dispose(); // Dispose the modal instance (clean up event listeners, etc.)
                    }
                    existingaddModal.remove(); // Remove the modal from the DOM
                }


                const modaladdcontainer = document.getElementById('modal-add-container');
                modaladdcontainer.innerHTML = addbookmodal();

                var modalElement = document.getElementById('addbookmodal');

                // Ensure the modal is properly initialized by Bootstrap
                modalElement.addEventListener('shown.bs.modal', function() {
                    console.log('Modal is now shown');
                });

                // Initialize and show the modal
                var myModal = new bootstrap.Modal(modalElement);
                myModal.show();

            }

            function showacceptModal(title, bookid, rollno, issueaction, recordid) {

                // var myModal = new bootstrap.Modal(document.getElementById('myModal'));
                // myModal.show();
                // const myModal = new bootstrap.Modal(document.getElementById('myModal'), options)
                // myModal.show();
                console.log('recordid is now=>', recordid);

                let existingacceptModal = document.getElementById('acceptbookmodal');
                if (existingacceptModal) {
                    var bsacceptModal = bootstrap.Modal.getInstance(existingacceptModal); // Get the existing Bootstrap modal instance
                    if (bsacceptModal) {
                        bsacceptModal.dispose(); // Dispose the modal instance (clean up event listeners, etc.)
                    }
                    existingacceptModal.remove(); // Remove the modal from the DOM
                }


                const modalacceptcontainer = document.getElementById('modal-accept-container');
                modalacceptcontainer.innerHTML = acceptbookModal(title, bookid, rollno, issueaction, recordid);

                var modalElement = document.getElementById('acceptbookmodal');

                // Ensure the modal is properly initialized by Bootstrap
                modalElement.addEventListener('shown.bs.modal', function() {
                    console.log('Modal is now shown');
                });

                // Initialize and show the modal
                var myModal = new bootstrap.Modal(modalElement);
                myModal.show();

            }

            function updateBookNow(event) {

                event.preventDefault();
                //$('#editbook').submit(function(event) {
                // event.preventDefault();
                let bookid = $('#bookid').val();
                let bookname = $('#bookname').val();
                let publisher = $('#publisher').val();
                let year = $('#year').val();
                let availability = $('#availability').val();


                $.ajax({
                    url: './sql-actions/update-book.php',
                    type: 'POST',
                    data: {
                        bookid,
                        bookname,
                        publisher,
                        year,
                        availability

                    }, // Pass an action parameter for login
                    success: function(response) {


                        let res = JSON.parse(response);
                        if (res.status === 'success') {
                            Swal.fire({
                                title: "Success",
                                text: "Book successfully updated! Reloading the page..",
                                icon: "success",

                            });
                            setTimeout(function() {
                                // window.location.href = 'student/index-assets.php';
                                location.reload();

                            }, 2000);
                        }
                    }
                });
                //}); //
            }

            function deleteBookNow(event) {

                event.preventDefault();
                //$('#editbook').submit(function(event) {
                // event.preventDefault();
                let bookid = $('#bookiddelete').val();
                let bookname = $('#bookname').val();



                $.ajax({
                    url: './sql-actions/delete-book.php',
                    type: 'POST',
                    data: {
                        bookid,
                        bookname,


                    }, // Pass an action parameter for login
                    success: function(response) {


                        let res = JSON.parse(response);
                        if (res.status === 'success') {
                            Swal.fire({
                                title: "Success",
                                text: "Book successfully deleted! Reloading the page..",
                                icon: "success",

                            });
                            setTimeout(function() {
                                // window.location.href = 'student/index-assets.php';
                                location.reload();

                            }, 2000);
                        }
                    }
                });
                //}); //
            }


            // accept issue request
            function acceptBookNow(event) {

                event.preventDefault();
                //$('#editbook').submit(function(event) {
                // event.preventDefault();
                let bookid = $('#acceptbookid').val();
                let bookrollno = $('#acceptbookrollno').val();
                let booktitle = $("#acceptbooktitle").val();
                let acceptrejectbook = $("#acceptrejectbook").val();
                let recordid = $("#acceptrejectrecordid").val();

                console.log("Accept=>", bookid)

                $.ajax({
                    url: './sql-actions/request-book-renewal.php',
                    type: 'POST',
                    data: {
                        bookid,
                        bookrollno,
                        booktitle,
                        action: acceptrejectbook,
                        recordid


                    }, // Pass an action parameter for login
                    success: function(response) {


                        let res = JSON.parse(response);
                        if (res.status === 'success') {
                            Swal.fire({
                                title: "Success",
                                text: "Request successfully updated! Reloading the page..",
                                icon: "success",

                            });
                            setTimeout(function() {
                                // window.location.href = 'student/index-assets.php';
                                location.reload();

                            }, 2000);
                        } else if (res.status === 'error') {
                            Swal.fire({
                                title: "Error",
                                text: "There was an error aceppting this Borrow request. Please try again",
                                icon: "error",

                            });

                        }
                    }
                });
                //}); //
            }

            // add book
            $('#addbookform').submit(function(event) {
                event.preventDefault();

                let authors = $("#authors").val();
                let addbookname = $("#addbookname").val();
                let addbookpublisher = $("#addbookpublisher").val();
                let addbookyear = $("#addbookyear").val();
                let addbookcopies = $("#addbookcopies").val();



                $.ajax({
                    url: './sql-actions/add-book.php',
                    type: 'POST',
                    data: {
                        authors,
                        addbookname,
                        addbookpublisher,
                        addbookyear,
                        addbookcopies,

                    }, // Pass an action parameter for login
                    success: function(response) {
                        // Clear previous error messages


                        let res = JSON.parse(response);
                        // console.log("studentnumber=>", studentnumber)
                        if (res.status === 'error') {
                            if (res.message.bookexist) {


                                Swal.fire({
                                    title: "Book Already Exist",
                                    text: "Book is already registered.",
                                    icon: "error",
                                    // showConfirmButton: false,
                                });
                            }
                        } else {
                            Swal.fire({
                                title: "Successfully Added",
                                text: "Reloading the page..",
                                icon: "success",
                                // showConfirmButton: false,
                            });
                            // Redirect on successful sign-in
                            setTimeout(function() {
                                location.reload();
                            }, 2000);

                        }
                    }
                });
            });
            // endof addbook
        </script>
        <script>
            // var e;
            c1 = $('#style-1').DataTable({
                headerCallback: function(e, a, t, n, s) {
                    e.getElementsByTagName("th")[0].innerHTML = `
                <div class="form-check form-check-primary d-block">
                    <input class="form-check-input chk-parent" type="checkbox" id="form-check-default">
                </div>`
                },
                columnDefs: [{
                    targets: 0,
                    width: "30px",
                    className: "",
                    orderable: !1,
                    render: function(e, a, t, n) {
                        return `
                    <div class="form-check form-check-primary d-block">
                        <input class="form-check-input child-chk" type="checkbox" id="form-check-default">
                    </div>`
                    }
                }],
                "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                    "<'table-responsive'tr>" +
                    "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                "oLanguage": {
                    "oPaginate": {
                        "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                        "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                    },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                    "sLengthMenu": "Results :  _MENU_",
                },
                "lengthMenu": [5, 10, 20, 50],
                "pageLength": 10
            });

            multiCheck(c1);

            c2 = $('#style-2').DataTable({
                headerCallback: function(e, a, t, n, s) {
                    e.getElementsByTagName("th")[0].innerHTML = `
                <div class="form-check form-check-primary d-block new-control">
                    <input class="form-check-input chk-parent" type="checkbox" id="form-check-default">
                </div>`
                },
                columnDefs: [{
                    targets: 0,
                    width: "30px",
                    className: "",
                    orderable: !1,
                    render: function(e, a, t, n) {
                        return `
                    <div class="form-check form-check-primary d-block new-control">
                        <input class="form-check-input child-chk" type="checkbox" id="form-check-default">
                    </div>`
                    }
                }],
                "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                    "<'table-responsive'tr>" +
                    "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                "oLanguage": {
                    "oPaginate": {
                        "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                        "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                    },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                    "sLengthMenu": "Results :  _MENU_",
                },
                "lengthMenu": [5, 10, 20, 50],
                "pageLength": 10
            });

            multiCheck(c2);

            c3 = $('#style-3').DataTable({
                "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                    "<'table-responsive'tr>" +
                    "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                "oLanguage": {
                    "oPaginate": {
                        "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                        "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                    },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                    "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [5, 10, 20, 50],
                "pageLength": 10
            });

            multiCheck(c3);
        </script>
        <!-- END PAGE LEVEL SCRIPTS -->
    </body>

    <!-- Mirrored from designreset.com/equation/html/vertical-light-menu/table-datatable-custom.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 22 Oct 2024 11:23:48 GMT -->

    </html>

<?php } ?>