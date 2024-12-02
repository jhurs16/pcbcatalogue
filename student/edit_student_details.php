<?php
ob_start();
require('../connection/pdo.php');
include('../sugarhelper.php');
$db = new DatabaseConnect();

$rollno = $_SESSION['RollNo'] ? $_SESSION['RollNo'] : null;
if ($rollno) {
    $db->query("SELECT * from user where RollNo = ? ");
    $db->bind(1, $rollno);
    $current_user = $db->single();
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LMS</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/style.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
    </head>

    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                    <i class="icon-reorder shaded"></i></a>
                <a class="brand">Polytechnic College of Botolan</a>
            </div>
        </div>
        </div>
        <!-- /navbar -->
        <div class="wrapper">
            <div class="row">
                <div class="sidebar">
                    <ul class="widget widget-menu unstyled" style="font-size: 23px">
                        <li class="active"><a href="index.php"><i class="menu-icon icon-home"></i>Home
                            </a></li>
                        <li><a href="message.php"><i class="menu-icon icon-inbox"></i>Messages</a>
                        </li>
                        <li><a href="book.php"><i class="menu-icon icon-book"></i>All Books </a></li>
                        <li><a href="history.php"><i class="menu-icon icon-tasks"></i>Previously Borrowed Books </a></li>
                        <li><a href="current.php"><i class="menu-icon icon-list"></i>Currently Issued Books </a></li>
                    </ul>
                    <ul>
                        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                        <li><a href="logout.php" class="btn btn-danger" style="font-size: 25px;width: 70%;font-family: sans-serif;">Logout</a></li>
                    </ul>
                </div>
                <!--/.sidebar-->
            </div>
            <!--/.span3-->
            <div class="span9">
                <div class="module">
                    <div class="module-head">
                        <h3>Update Details</h3>
                    </div>
                    <div class="module-body">


                        <?php


                        $name = $current_user['Name'];
                        $category = $current_user['Category'];
                        $email = $current_user['EmailId'];
                        $mobno = $current_user['MobNo'];
                        $pswd = $current_user['Password'];
                        ?>

                        <form class="form-horizontal row-fluid" action="edit_student_details.php?id=<?php echo $rollno ?>" method="post">

                            <div class="control-group">
                                <label class="control-label" for="Name"><b>Name:</b></label>
                                <div class="controls">
                                    <input type="text" id="Name" name="Name" value="<?php echo $name ?>" class="span8" required>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="Category"><b>Category:</b></label>
                                <div class="controls">
                                    <select name="Category" tabindex="1" value="SC" data-placeholder="Select Category" class="span6">
                                        <option value="<?php echo $category ?>"><?php echo $category ?> </option>
                                        <option value="GEN">GEN</option>
                                        <option value="OBC">OBC</option>
                                        <option value="SC">SC</option>
                                        <option value="ST">ST</option>
                                    </select>
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label" for="EmailId"><b>Email Id:</b></label>
                                <div class="controls">
                                    <input type="text" id="EmailId" name="EmailId" value="<?php echo $email ?>" class="span8" required>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="MobNo"><b>Mobile Number:</b></label>
                                <div class="controls">
                                    <input type="text" id="MobNo" name="MobNo" value="<?php echo $mobno ?>" class="span8" required>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="Password"><b>New Password:</b></label>
                                <div class="controls">
                                    <input type="password" id="Password" name="Password" value="<?php echo $pswd ?>" class="span8" required>
                                </div>
                            </div>

                            <div class="control-group">
                                <div class="controls">
                                    <button type="submit" name="submit" class="btn-primary">
                                        <center>Update Details</center>
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

            <!--/.span9-->
        </div>
        </div>
        <!--/.container-->
        </div>


        <!--/.wrapper-->
        <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
        <script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="scripts/common.js" type="text/javascript"></script>

        <?php
        if (isset($_POST['submit'])) {
            $rollno = $_GET['id'];
            $name = $_POST['Name'];
            $category = $_POST['Category'];
            $email = $_POST['EmailId'];
            $mobno = $_POST['MobNo'];
            $pswd = $_POST['Password'];

            $sql1 = "update LMS.user set Name='$name', Category='$category', EmailId='$email', MobNo='$mobno', Password='$pswd' where RollNo='$rollno'";



            if ($conn->query($sql1) === TRUE) {
                echo "<script type='text/javascript'>alert('Success')</script>";
                header("Refresh:0.01; url=index.php", true, 303);
            } else { //echo $conn->error;
                echo "<script type='text/javascript'>alert('Error')</script>";
            }
        }
        ?>

    </body>

    </html>

<?php

}
?>