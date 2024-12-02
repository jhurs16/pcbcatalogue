<?php
require('dbconn.php');
?>

<?php
if ($_SESSION['RollNo']) {
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
        <!-- /navbar-inner -->
        </div>
        <!-- /navbar -->
        <div class="wrapper">

            <div class="row">
                <div class="span3">
                    <div class="sidebar">
                        <ul class="widget widget-menu unstyled" style="font-size: 23px">
                            <li class="active"><a href="index.php"><i class="menu-icon icon-home"></i>Home
                                </a></li>
                            <li><a href="message.php"><i class="menu-icon icon-inbox"></i>Messages</a>
                            </li>
                            <li><a href="student.php"><i class="menu-icon icon-user"></i>Manage Students </a>
                            </li>
                            <li><a href="book.php"><i class="menu-icon icon-book"></i>All Books </a></li>
                            <li><a href="addbook.php"><i class="menu-icon icon-edit"></i>Add Books </a></li>
                            <li><a href="requests.php"><i class="menu-icon icon-tasks"></i>Issue/Return Requests </a></li>
                            <li><a href="current.php"><i class="menu-icon icon-list"></i>Currently Issued Books </a></li>
                        </ul>
                        <ul>
                            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                            <li><a href="logout.php" class="btn btn-danger" style="font-size: 25px;width: 70%;font-family: sans-serif;">Logout</a></li>
                        </ul>
                    </div>
                    <!--/.sidebar-->
                </div>

                <div class="search">
                    <div style="padding-right: 300px;">
                        <center>
                            <a href="issue_requests.php" class="btn btn-info">Borrow Requests</a>
                            <a href="renew_requests.php" class="btn btn-info">Renew Request</a>
                            <a href="return_requests.php" class="btn btn-info">Return Requests</a>
                        </center>
                    </div>
                    <h1><i>Borrow Requests</i></h1>
                    <table class="table" id="tables">
                        <thead>
                            <tr>
                                <th>Student Number</th>
                                <th>Book Id</th>
                                <th>Book Name</th>
                                <th>Availabilty</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "select * from LMS.record,LMS.book where Date_of_Borrow is NULL and record.BookId=book.BookId order by Time";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                $bookid = $row['BookId'];
                                $rollno = $row['RollNo'];
                                $name = $row['Title'];
                                $avail = $row['Availability'];


                            ?>
                                <tr>
                                    <td><?php echo strtoupper($rollno) ?></td>
                                    <td><?php echo $bookid ?></td>
                                    <td><b><?php echo $name ?></b></td>
                                    <td><?php echo $avail ?></td>
                                    <td>
                                        <center>
                                            <?php
                                            if ($avail > 0) {
                                                echo "<a href=\"accept.php?id1=" . $bookid . "&id2=" . $rollno . "\" class=\"btn btn-success\">Accept</a>";
                                            }
                                            ?>
                                            <a href="reject.php?id1=<?php echo $bookid ?>&id2=<?php echo $rollno ?>" class="btn btn-danger">Reject</a>
                                        </center>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!--/.span3-->
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

    </body>

    </html>


<?php } else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>