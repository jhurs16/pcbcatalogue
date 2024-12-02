<?php
require('../connection/pdo.php');
include('../sugarhelper.php');
$db = new DatabaseConnect();
?>

<?php
$rollno = $_SESSION['RollNo'] ? $_SESSION['RollNo'] : null;
if ($rollno) {
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
            <div class="Search">
                <form class="form-horizontal row-fluid" action="history.php" method="post">
                    <div class="control-group">
                        <label class="control-label" for="Search"><b>Search:</b></label>
                        <div class="controls">
                            <input type="text" id="title" name="title" placeholder="Enter Book Name/Book Id." class="span8" required>
                            <button type="submit" name="submit" class="btn">Search</button>
                        </div>
                    </div>
                </form>
                <br>
                <?php
                // $rollno = $_SESSION['RollNo'];
                // if (isset($_POST['submit'])) {
                //     $s = $_POST['title'];
                //     $sql = "select * from LMS.record,LMS.book where RollNo = '$rollno' and Date_of_Borrow is NOT NULL and Date_of_Return is NULL and book.Bookid = record.BookId and (record.BookId='$s' or Title like '%$s%')";
                // } else
                //     $sql = "select * from LMS.record,LMS.book where RollNo = '$rollno' and Date_of_Borrow is NOT NULL and Date_of_Return is NULL and book.Bookid = record.BookId";

                // $result = $conn->query($sql);
                // $rowcount = mysqli_num_rows($result);

                if (count($current_records) < 1):
                    echo "<br><center><h2><b><i>No Results</i></b></h2></center>";
                else:


                ?>
                    <div class="main-content" style="padding-top: 110px;">
                        <div class="table-container">
                            <table class="table" id="tables">
                                <thead>
                                    <tr>
                                        <th>Book id</th>
                                        <th>Book name</th>
                                        <th>Issue Date</th>
                                        <th>Due date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php


                                    //$result=$conn->query($sql);
                                    foreach ($current_records as $current):
                                        $bookid = $current['BookId'];
                                        $name = $current['Title'];
                                        $issuedate = $current['Date_of_Borrow'];
                                        $duedate = $current['Due_Date'];
                                        $renewals = $current['Renewals_left'];

                                    ?>

                                        <tr>
                                            <td><?php echo $bookid ?></td>
                                            <td><?php echo $name ?></td>
                                            <td><?php echo $issuedate ?></td>
                                            <td><?php echo $duedate ?></td>
                                            <td>
                                                <center>
                                                    <?php
                                                    if ($renewals)
                                                        echo "<a href=\"renew_request.php?id=" . $bookid . "\" class=\"btn btn-success\">Renew</a>";
                                                    ?>
                                                    <a href="return_request.php?id=<?php echo $bookid; ?>" class="btn btn-primary">Return</a>
                                                </center>
                                            </td>
                                        </tr>
                                <?php
                                    endforeach;
                                endif; ?>
                                </tbody>
                            </table>
                        </div>
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