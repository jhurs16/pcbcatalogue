<?php
require('../connection/pdo.php');
include('../sugarhelper.php');
$db = new DatabaseConnect();

$rollno = isset($_SESSION['RollNo']) ? $_SESSION['RollNo'] : null;

if (isset($_SESSION['RollNo'])) {






    // books count
    $db->query("SELECT *, cc.courseid AS ccid, cc.name AS coursename FROM user u
INNER JOIN studentdetails AS sd 
ON sd.userid = u.RollNo
INNER JOIN coursecategory cc ON u.category = cc.courseid
WHERE `type` = 'student' ORDER BY Name ASC;");
    $students = $db->set();


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
        <link rel="stylesheet" href="../dashboard-assets/src/plugins/src/sweetalerts2/sweetalerts2.css">
        <link href="../dashboard-assets/src/plugins/css/light/sweetalerts2/custom-sweetalert.css" rel="stylesheet" type="text/css" />
        <script src="../dashboard-assets/src/plugins/src/sweetalerts2/sweetalerts2.min.js"></script>
        <!-- END PAGE LEVEL CUSTOM STYLES -->
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
                                <li class="active">
                                    <a href="./manage-students"> Manage Students </a>
                                </li>
                                <li>
                                    <a href="./book-issue-requests"> Borrow Requests </a>
                                </li>
                                <li>
                                    <a href="./book-renew-requests"> Renew Requests </a>
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
                <div class="layout-px-spacing">

                    <div class="middle-content container-xxl p-0">

                        <!-- BREADCRUMB -->
                        <div class="page-meta">
                            <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                                <ol class="breadcrumb">

                                    <li class="breadcrumb-item active" aria-current="page">All Students</li>
                                </ol>
                            </nav>
                        </div>
                        <!-- /BREADCRUMB -->

                        <div class="seperator-header">

                        </div>

                        <div class="row layout-spacing">
                            <div class="col-lg-12">
                                <div class="statbox widget box box-shadow">
                                    <div class="widget-content widget-content-area">
                                        <table id="style-3" class="table style-3 dt-table-hover">
                                            <thead>
                                                <tr>

                                                    <th class="text-center">Student Name</th>
                                                    <th class="text-center">Student Number</th>
                                                    <th class="text-center">Email Address</th>

                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($students as $student):

                                                    $email = $student['Email'];
                                                    $name = $student['LastName'] . ", " . $student['FirstName'] . " " . $student['MiddleName'] ?? '';
                                                    $studentid = $student['RollNo'];
                                                    $category = $student['coursename'];
                                                    $mobno = $student['MobNo'];
                                                    $fname = $student['FirstName'];
                                                    $mname = $student['MiddleName'];
                                                    $lname = $student['LastName'];
                                                    $userid = $student['userid'];

                                                ?>
                                                    <tr>

                                                        <td>
                                                            <?php echo $name; ?>
                                                        </td>


                                                        <td class="text-center">
                                                            <?php echo $studentid; ?>

                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo $email; ?>

                                                        </td>
                                                        <td class="text-center">
                                                            <button class="btn btn-info mb-2 me-1" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                                name, rollno, email, category, mobno
                                                                onclick="showModal(
                                                                '<?php echo $name; ?>',
                                                                '<?php echo $userid; ?>',
                                                                '<?php echo $email; ?>',
                                                                '<?php echo $category; ?>', 
                                                                '<?php echo $mobno; ?>',
                                                                '<?php echo $fname; ?>',
                                                                '<?php echo $mname; ?>',
                                                                '<?php echo $lname; ?>'
                                                                )">Details</button>



                                                            <button class="btn btn-danger mb-2 me-1" onclick="showdeleteModal('<?php echo $name; ?>', '<?php echo $studentid; ?>')">Remove</button>

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
                <!--  END CONTENT AREA  -->
            </div>
            <!--  END CONTENT AREA  -->
        </div>

        <div id="modal-container"></div>
        <div id="modal-edit-container"></div>
        <div id="modal-delete-container"></div>
        <!-- END MAIN CONTAINER -->


        <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
        <script src="../dashboard-assets/src/plugins/src/global/vendors.min.js"></script>
        <script src="../dashboard-assets/src/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../dashboard-assets/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="../dashboard-assets/src/plugins/src/mousetrap/mousetrap.min.js"></script>
        <script src="../dashboard-assets/src/plugins/src/waves/waves.min.js"></script>
        <script src="../dashboard-assets/layouts/vertical-light-menu/app.js"></script>


        <script src="../dashboard-assets/src/assets/js/custom.js"></script>
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

            function createModal(name, rollno, email, category, mobno, fname, mname, lname) {
                return `
<div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background: #fff">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Student Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <svg> ... </svg>
                </button>
            </div>
            <div class="modal-body">
            <h6>First Name: <strong>${fname}</strong></h6>
            <h6>Middle Name: <strong>${mname}</strong></h6>
            <h6>Last Name: <strong>${lname}</strong></h6>
            <p>Student Number: <strong>${rollno}</strong></p>
            <p>Email: <strong>${email}</strong></p>
            <p>Category: <strong>${category}</strong></p>
            <p>Mobile Number: <strong>${mobno}</strong></p>
           
            </div>
            <div class="modal-footer">
                <button class="btn btn btn-success" data-bs-dismiss="modal"><i class="flaticon-cancel-12"></i> OK</button>
                
            </div>
        </div>
    </div>
</div>
`;


            }

            function showModal(name, rollno, email, category, mobno, fname, mname, lname) {
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
                modalcontainer.innerHTML = createModal(name, rollno, email, category, mobno, fname, mname, lname);

                var modalElement = document.getElementById('exampleModal');

                // Ensure the modal is properly initialized by Bootstrap
                modalElement.addEventListener('shown.bs.modal', function() {
                    console.log('Modal is now shown');
                });

                // Initialize and show the modal
                var myModal = new bootstrap.Modal(modalElement);
                myModal.show();

            }



            /// EDIT THE BOOKS


            // DELETE BOOK
            function removestudentmodal(name, studid) {
                return `
                    <div class="modal fade " id="deletestudentmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content" style="background: #fff">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Student</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <svg> ... </svg>
                                    </button>
                                </div>
                                <div class="modal-body">
                            <form method="POST" id="deletestudent" onsubmit="deleteStudentNow(event)">
                                    <div class="row mb-4">
                                        <input type="hidden" class="form-control" id="studentiddelete" value="${studid}" >
                                        
                                        <h6>Are you sure you want to delete this Student?</h6>
                                        <p>Student Name: ${name}</p>
                                    </div>

                                    <button type="submit" class="btn btn-warning" >Confirm</button>
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


            function showdeleteModal(name, studid) {
                // var myModal = new bootstrap.Modal(document.getElementById('myModal'));
                // myModal.show();
                // const myModal = new bootstrap.Modal(document.getElementById('myModal'), options)
                // myModal.show();
                console.log(" studid =>", studid);
                let existingdeletetModal = document.getElementById('deletestudentmodal');
                if (existingdeletetModal) {
                    var bsdeleteModal = bootstrap.Modal.getInstance(existingdeletetModal); // Get the existing Bootstrap modal instance
                    if (bsdeleteModal) {
                        bsdeleteModal.dispose(); // Dispose the modal instance (clean up event listeners, etc.)
                    }
                    existingdeletetModal.remove(); // Remove the modal from the DOM
                }


                const modaldeletecontainer = document.getElementById('modal-delete-container');
                modaldeletecontainer.innerHTML = removestudentmodal(name, studid);

                var modalElement = document.getElementById('deletestudentmodal');

                // Ensure the modal is properly initialized by Bootstrap
                modalElement.addEventListener('shown.bs.modal', function() {
                    console.log('Modal is now shown');
                });

                // Initialize and show the modal
                var myModal = new bootstrap.Modal(modalElement);
                myModal.show();

            }


            function deleteStudentNow(event) {

                event.preventDefault();
                //$('#editbook').submit(function(event) {
                // event.preventDefault();
                let studentid = $('#studentiddelete').val();




                $.ajax({
                    url: './sql-actions/delete-student.php',
                    type: 'POST',
                    data: {
                        studentid,



                    }, // Pass an action parameter for login
                    success: function(response) {


                        let res = JSON.parse(response);
                        if (res.status === 'success') {
                            Swal.fire({
                                title: "Success",
                                text: "Student successfully deleted! Reloading the page..",
                                icon: "success",

                            });
                            setTimeout(function() {
                                // window.location.href = 'student/index-assets.php';
                                //location.reload();

                            }, 2000);
                        } else {
                            Swal.fire({
                                title: "Error",
                                text: "Warning: You can\'t delete this student, Possible reason is: \nStudent is associated with message, record, return, and renew table. Please delete them first.",
                                icon: "error",

                            });
                        }

                    }
                });
                //}); // 
            }
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