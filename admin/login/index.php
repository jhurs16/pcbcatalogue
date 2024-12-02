<?php
session_start();
$rollno = isset($_SESSION['RollNo']) ? $_SESSION['RollNo'] : null;
$rollno = isset($_SESSION['RollNo']) ? $_SESSION['RollNo'] : null;
$roletype = isset($_SESSION['RoleType']) ? $_SESSION['RoleType'] : null;

if (!isset($_SESSION['RollNo']) && !isset($_SESSION['RoleType'])) {
?>

    <!DOCTYPE html>
    <html lang="zxx">

    <!-- Mirrored from storage.googleapis.com/theme-vessel-items/checking-sites/logdy-2-html/HTML/main/login-16.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 22 Oct 2024 11:05:05 GMT -->

    <head>

        <!-- End Google Tag Manager -->
        <title>Logdy - Login and Register Form HTML5 Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <!-- Custom Stylesheet -->
        <link type="text/css" rel="stylesheet" href="../../assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="../../assets/css/skins/default.css">

        <!-- External CSS libraries -->
        <link type="text/css" rel="stylesheet" href="../../assets/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="../../assets/fonts/font-awesome/css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="../../assets/fonts/flaticon/font/flaticon.css">

        <!-- Favicon icon -->
        <link rel="shortcut icon" href="../../assets/img/favicon.ico" type="image/x-icon">

        <!-- Google fonts -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPoppins:400,500,700,800,900%7CRoboto:100,300,400,400i,500,700">
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../../dashboard-assets/src/plugins/src/sweetalerts2/sweetalerts2.css">
        <link href="../../dashboard-assets/src/plugins/css/light/sweetalerts2/custom-sweetalert.css" rel="stylesheet" type="text/css" />
        <style>
            .login-box {
                display: none;
                opacity: 0;
                transition: opacity 0.5s ease-in-out;
            }

            /* Show the form that's active */
            .login-box.active {
                display: flex;
                opacity: 1;
            }

            #emailidcon {
                position: relative;
            }

            .email-error {
                color: #fff;
                position: absolute;
                left: -44%;
                z-index: 2;
                top: 14px;
                background: #e65a5a;
                padding: 6px 10px;
                border-radius: 10px;
                display: none;
            }
        </style>
        <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
        <script src="../../dashboard-assets/src/plugins/src/sweetalerts2/sweetalerts2.min.js"></script>
    </head>

    <body id="top">

        <div class="page_loader"></div>

        <!-- Login 16 start -->
        <div class="login-16">
            <div class="login-16-inner">
                <div class="container">
                    <!-- SIGN IN FORM START -->
                    <div id="signinFormCon" class="row login-box active">
                        <div class="col-lg-6 align-self-center pad-0">
                            <div class="form-section align-self-center">
                                <div class="logo">
                                    <!-- <a href="login-16.html">
                                    <img src="assets/img/logos/logo.png" alt="logo">
                                </a> -->
                                    <h2 style="color: #fff; text-transform: uppercase;">Admin Login</h2>
                                </div>
                                <h3>Sign Into Your Account</h3>
                                <form method="POST" id="signinform">
                                    <div class="form-group clearfix">

                                        <div class="form-box">
                                            <input type="text" name="RollNo" placeholder="Username" class="form-control" id="rollno" aria-label="Roll Number" required>
                                            <i class="flaticon-user-1"></i>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <div class="form-box">
                                            <input name="password" type="password" class="form-control" autocomplete="off" id="password" placeholder="Password" aria-label="Password" required>
                                            <i class="flaticon-password"></i>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <button type="submit" name="signin" class="btn btn-primary btn-lg btn-theme w-100">Login</button>
                                    </div>
                                </form>

                                <!-- <p>Don't have an account? <a href="#" id="toggle-signup">Register here</a></p> -->
                            </div>
                        </div>
                        <div class="col-lg-6 align-self-center pad-0 bg-img">
                            <div class="info clearfix">
                                <div class="box">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <div class="content" style="top: -22px;">

                                        <div class="logo">
                                            <a href="index.php">
                                                <img src="../../images/logo.png" alt="logo" style="height: 120px;">
                                            </a>
                                        </div>
                                        <h3>PCB CATALOGUING SYSTEM</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- SIGNIN FORM ENDS -->


                </div>
                <div class="ocean">
                    <div class="wave"></div>
                    <div class="wave"></div>
                </div>
            </div>
        </div>
        <!-- Login 16 end -->

        <!-- External JS libraries -->
        <script src="../../assets/js/jquery.min.js"></script>
        <!-- <script src="assets/js/popper.min.js"></script> -->
        <script src="../../assets/js/bootstrap.bundle.min.js"></script>
        <!-- <script src="assets/js/app.js"></script> -->
        <!-- Custom JS Script -->

        <script>
            $(document).ready(function() {



                // FOR SIGIN FORM
                $('#signinform').submit(function(event) {
                    event.preventDefault();
                    let rollno = $('#rollno').val();
                    let password = $('#password').val();

                    $.ajax({
                        url: '../../authentication/sign-in.php',
                        type: 'POST',
                        data: {
                            rollno,
                            password,
                            actionform: 'adminlogin'
                        }, // Pass an action parameter for login
                        success: function(response) {
                            // Clear previous error messages
                            $('#rollnoError').text('');
                            $('#passwordError').text('');

                            let res = JSON.parse(response);
                            if (res.status === 'error') {
                                if (res.message.response) {


                                    Swal.fire({
                                        title: "Incorrect id or password",
                                        text: "Please check the fields before submitting your info",
                                        icon: "error",
                                        // showConfirmButton: false,
                                    });
                                }

                            } else {
                                Swal.fire({
                                    title: "Successfully Login",
                                    text: "Redirecting to admin dashboard...",
                                    icon: "success",
                                    showConfirmButton: false,
                                });
                                // Redirect on successful sign-in
                                setTimeout(function() {
                                    window.location.href = '../';
                                }, 2000);

                            }
                        }
                    });
                }); // end of sigin




            });
        </script>
    </body>



    </html>

<?php } else {

    if ($roletype === 'Admin') {
        header('Location:../');
    } else {
        header('Location:../../student/');
    }
}
