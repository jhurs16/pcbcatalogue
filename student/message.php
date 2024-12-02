<?php
require('../connection/pdo.php');
include('../sugarhelper.php');
$db = new DatabaseConnect();
?>

<?php
$rollno = $_SESSION['RollNo'] ? $_SESSION['RollNo'] : null;
if ($rollno) {
    $db->query("SELECT * FROM message WHERE RollNo='$rollno'
              ORDER BY Date DESC,Time DESC;");
    $messages = $db->set();
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
            <div class="main-content" style="padding-top: 110px;">
                <div class="table-container">
                    <table class="table" id="tables">
                        <thead>
                            <tr>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($messages as $msg):
                            ?>
                                <tr>
                                    <td><?php echo $msg['Msg']; ?></td>
                                    <td><?php echo $msg['Date']; ?></td>
                                    <td><?php echo $msg['Time']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!--/.span3-->

                <!--/.span9-->
            </div>
        </div>
        <!--/.container-->
        </div>
        </div>


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

<?php } else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>