<?php
session_start();
$rollno = isset($_SESSION['RollNo']) ? $_SESSION['RollNo'] : null;
// if (isset($rollno)) {
//     if ($_SESSION["RollNo"] != "ADMIN") {
//         var_dump("You are login.. as student");
//     } else {
//         var_dump("You are login.. as admin");
//     }
// } else {
//     var_dump("You are not login");
// }
$rollno = isset($_SESSION['RollNo']) ? $_SESSION['RollNo'] : null;
$roletype = isset($_SESSION['RoleType']) ? $_SESSION['RoleType'] : null;

if (!isset($_SESSION['RollNo']) && !isset($_SESSION['RoleType'])) {

?>

    <!DOCTYPE html>
    <html lang="zxx">

    <!-- Mirrored from storage.googleapis.com/theme-vessel-items/checking-sites/logdy-2-html/HTML/main/login-16.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 22 Oct 2024 11:05:05 GMT -->

    <head>

        <!-- End Google Tag Manager -->
        <title>PCB CATALOGUING SYSTEM</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <!-- Custom Stylesheet -->
        <link type="text/css" rel="stylesheet" href="./assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="assets/css/skins/default.css">

        <!-- External CSS libraries -->
        <link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="assets/fonts/font-awesome/css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="assets/fonts/flaticon/font/flaticon.css">

        <!-- Favicon icon -->
        <!-- <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon"> -->

        <!-- Google fonts -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPoppins:400,500,700,800,900%7CRoboto:100,300,400,400i,500,700">
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

        <link rel="stylesheet" href="./dashboard-assets/src/plugins/src/sweetalerts2/sweetalerts2.css">
        <link href="./dashboard-assets/src/plugins/css/light/sweetalerts2/custom-sweetalert.css" rel="stylesheet" type="text/css" />
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
        <script src="./dashboard-assets/src/plugins/src/sweetalerts2/sweetalerts2.min.js"></script>

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
                                    <h2 style="color: #fff; text-transform: uppercase;">Login</h2>
                                </div>
                                <h3>Sign Into Your Account</h3>
                                <form method="POST" id="signinform">
                                    <div class="form-group clearfix">

                                        <div class="form-box">
                                            <input type="text" name="RollNo" placeholder="User" class="form-control" id="rollno" aria-label="Roll Number">
                                            <i class="flaticon-user-1"></i>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <div class="form-box">
                                            <input name="password" type="password" class="form-control" autocomplete="off" id="password" placeholder="Password" aria-label="Password">
                                            <i class="flaticon-password"></i>
                                        </div>
                                    </div>
                                    <!-- <div class="checkbox form-group clearfix">
                                    <div class="form-check float-start">
                                        <input class="form-check-input" type="checkbox" id="rememberme">
                                        <label class="form-check-label" for="rememberme">
                                            Remember me
                                        </label>
                                    </div>
                                    <a href="forgot-password-16.html" class="link-light float-end forgot-password">Forgot your password?</a>
                                </div> -->
                                    <div class="form-group clearfix">
                                        <button type="submit" name="signin" class="btn btn-primary btn-lg btn-theme w-100">Login</button>
                                    </div>
                                </form>

                                <p>Don't have an account? <a href="#" id="toggle-signup">Register here</a></p>
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
                                                <img src="images/logo.png" alt="logo" style="height: 120px;">
                                            </a>
                                        </div>
                                        <h3>PCB CATALOGUING SYSTEM</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- SIGNIN FORM ENDS -->


                    <!-- SIGN UP FORM START -->
                    <div id="signupFormCon" class="row login-box">

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
                                                <img src="images/logo.png" alt="logo" style="height: 120px;">
                                            </a>
                                        </div>
                                        <h3>PCB CATALOGUING SYSTEM</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 align-self-center pad-0">
                            <div class="form-section align-self-center">
                                <div class="logo">
                                    <h2 style="color: #fff; text-transform: uppercase;">Student Sign Up</h2>
                                </div>
                                <!-- <h3>Sign Up</h3> -->
                                <form method="POST" id="signupform">
                                    <div class="form-group clearfix">
                                        <div class="form-box">
                                            <input type="text" name="studentname" placeholder="Name" class="form-control" id="studentname" aria-label="Student Name" required>
                                            <!-- <i class="flaticon-user-1"></i> -->
                                        </div>
                                    </div>
                                    <div class="form-group clearfix" id="emailidcon">
                                        <div class="email-error">Invalid email address</div>
                                        <div class="form-box">
                                            <input type="email" name="signupemail" placeholder="Email" class="form-control" id="signupemail" aria-label="Email" required>

                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="form-box">
                                            <input name="password" type="password" class="form-control" autocomplete="off" id="signuppassword" placeholder="Password" aria-label="Password" required>
                                            <!-- <i class="flaticon-password"></i> -->
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="form-box">
                                            <input type="text" class="form-control" name="phonenumber" placeholder="Phone Number (e.g., 09123456789)" required pattern="^09\d{9}$" title="Must start with 09 and be 11 digits long" autocomplete="off" id="phonenumber">
                                            <!-- <i class="flaticon-phone"></i> -->
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="form-box">
                                            <input type="text" class="form-control" id="studentnumber" name="studentnumber" placeholder="Student Number (e.g., 12-12345)" required pattern="^\d{2}-\d{5}$" title="Format: 12-12345">
                                            <!-- <i class="fi fi-rr-phone-rotary"></i> -->
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <select name="category" id="category" class="form-control form-select">
                                            <option value="BSIT" style="background-color: black; color: white;">BSIT</option>
                                            <option value="BSIS" style="background-color: black; color: white;">BSIS</option>
                                            <option value="BSCS" style="background-color: black; color: white;">BSCS</option>
                                            <option value="ACT" style="background-color: black; color: white;">ACT</option>
                                            <option value="BEED" style="background-color: black; color: white;">BEED</option>
                                            <option value="BECAED" style="background-color: black; color: white;">BECAED</option>
                                        </select>
                                        <!-- <i class="flaticon-phone"></i> -->
                                    </div>

                                    <div class="form-group clearfix">
                                        <button type="submit" class="btn btn-primary btn-lg btn-theme w-100" id="signupsubmit">Sign Up</button>
                                    </div>
                                </form>

                                <p>Already have an account? <a href="#" id="toggle-signin">Signin here</a></p>

                            </div>
                        </div>
                    </div>
                    <!-- SIGN UP FORM END -->
                </div>
                <div class="ocean">
                    <div class="wave"></div>
                    <div class="wave"></div>
                </div>
            </div>
        </div>
        <!-- Login 16 end -->

        <!-- External JS libraries -->
        <script src="assets/js/jquery.min.js"></script>
        <!-- <script src="assets/js/popper.min.js"></script> -->
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <!-- <script src="assets/js/app.js"></script> -->
        <!-- Custom JS Script -->

        <script>
            $(document).ready(function() {

                // FORM SWITCHING
                // Toggle to Sign Up form
                $('#toggle-signup').click(function() {
                    $('#signinFormCon').removeClass('active');
                    $('#signupFormCon').addClass('active');
                });

                // Toggle to Sign In form
                $('#toggle-signin').click(function() {

                    $('#signinFormCon').addClass('active');
                    $('#signupFormCon').removeClass('active');
                });

                // FOR SIGIN FORM
                $('#signinform').submit(function(event) {
                    event.preventDefault();
                    let rollno = $('#rollno').val();
                    let password = $('#password').val();

                    $.ajax({
                        url: './authentication/sign-in.php',
                        type: 'POST',
                        data: {
                            rollno,
                            password,
                            actionform: 'studentlogin'
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
                                    text: "Redirecting to student dashboard...",
                                    icon: "success",
                                    showConfirmButton: false,
                                });
                                // Redirect on successful sign-in
                                setTimeout(function() {
                                    window.location.href = 'student/';
                                }, 2000);

                            }
                        }
                    });
                }); // end of sigin


                // start of signup
                $('#signupform').submit(function(event) {
                    event.preventDefault();
                    let studentname = $('#studentname').val();
                    let password = $('#signuppassword').val();
                    let phonenumber = $('#phonenumber').val();
                    let studentnumber = $('#studentnumber').val();
                    let category = $('#category').val();
                    let signupemail = $('#signupemail').val();

                    $.ajax({
                        url: './authentication/sign-up.php',
                        type: 'POST',
                        data: {
                            studentname,
                            signupemail,
                            password,
                            phonenumber,
                            studentnumber,
                            category,
                            action: 'signup'
                        }, // Pass an action parameter for login
                        success: function(response) {
                            // Clear previous error messages


                            let res = JSON.parse(response);
                            // console.log("studentnumber=>", studentnumber)
                            if (res.status === 'error') {
                                if (res.message.email) {


                                    Swal.fire({
                                        title: "Email Already Exist",
                                        text: "Email address is already registered.",
                                        icon: "error",
                                        // showConfirmButton: false,
                                    });
                                } else if (res.message.rollno) {
                                    Swal.fire({
                                        title: "StudentID Already Exist",
                                        text: "Student number is already registered.",
                                        icon: "error",
                                        // showConfirmButton: false,
                                    });
                                }
                            } else {
                                Swal.fire({
                                    title: "Successfully Sigup",
                                    text: "Redirecting to student dashboard...",
                                    icon: "success",
                                    showConfirmButton: false,
                                });
                                // Redirect on successful sign-in
                                setTimeout(function() {
                                    window.location.href = 'student/';
                                }, 2000);

                            }
                        }
                    });
                });
                // endof signup

                // function validateForm() {
                //     const email = document.querySelector('input[name="signupemail"]').value;
                //     if (!email.endsWith('@pcb.edu.ph')) {
                //         $("#email-error").val = "invalid email address";
                //         return false;
                //     }
                //     return true;
                // }
                let email = $("#signupemail");
                let emailerror = $(".email-error");
                let signupbtn = $("#signupsubmit");
                email.on('keyup', function() {
                    // console.log("Email");
                    const email = document.querySelector('input[name="signupemail"]').value;
                    if (!email.endsWith('@pcb.edu.ph')) {
                        emailerror.css("display", "block");
                        signupbtn.attr("disabled", true);
                        return false;
                    } else {
                        emailerror.css("display", "none");
                        signupbtn.attr("disabled", false);
                    }
                    return true;
                });
            });
        </script>
    </body>



    </html>

<?php } else {

    if ($roletype === 'Admin') {
        header('Location:./admin/');
    } else {
        header('Location:./student/');
    }
}
