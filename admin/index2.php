<?php
require('../connection/pdo.php');
include('../sugarhelper.php');
$db = new DatabaseConnect();
?>

<?php
$rollno = isset($_SESSION['RollNo']) ? $_SESSION['RollNo'] : null;
if (isset($_SESSION['RollNo']) && $rollno != 'ADMIN') {


    $db->query("SELECT * from user where RollNo = ?");
    $db->bind(1, $_SESSION['RollNo']);
    $currentuser = $db->single();
    // dd($currentuser);

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

                    <li><a href="logout.php" class="btn btn-danger" style="font-size: 25px;width: 70%;font-family: sans-serif;">Logout</a></li>
                </ul>
            </div>
            <!--/.sidebar-->
        </div>
        <!--/.span3-->

        <div class="container">
            <div class="span9">
                <div style="margin-top: 160px;margin-left: 35%;background-color: lightslategray; font-family: cursive; font-size: 20px;">
                    <center>
                        <div class="card" style="width: 100%;">
                            <img class="card-img-top" src="images/profile2.png" alt="Card image cap">
                            <div class="card-body">

                                <?php


                                $name = $currentuser['Name'];
                                $category = $currentuser['Category'];
                                $email = $currentuser['EmailId'];
                                $mobno = $currentuser['MobNo'];
                                ?>
                                <i>
                                    <h1 class="card-title" style="font-size: 50px">
                                        <center><?php echo $name ?></center>
                                    </h1>
                                    <br><br>
                                    <p><b>Student No: </B><?php echo $rollno ?></p>
                                    <br>
                                    <p><b>Category: </b><?php echo $category ?></p>
                                    <br>
                                    <p><b>Email ID: </b><?php echo $email ?></p>
                                    <br>
                                    <p><b>Mobile number: </b><?php echo $mobno ?></p>
                                    </b>
                                </i>

                            </div>
                        </div>
                        <br>
                        <a href="edit_student_details.php" class="btn btn-primary">Edit Details</a>
                    </center>
                </div>
            </div>
            <!--/.span9-->
        </div>
    </div>
    <!--/.container-->



    <!--/.wrapper-->
    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
    <script src="scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
    <script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="scripts/common.js" type="text/javascript"></script>

    </body>

    </html>


<?php } else { ?>


    <script>
        alert('Access Denied!!!');
        window.location.href = '../index.php';
    </script>
<?php } ?>