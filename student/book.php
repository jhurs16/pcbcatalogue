<?php
require('../connection/pdo.php');
include('../sugarhelper.php');
$db = new DatabaseConnect();
?>

<?php
$rollno = isset($_SESSION['RollNo']) ? $_SESSION['RollNo'] : null;
if ($rollno) {


    $db->query("SELECT * FROM book
              ORDER BY Availability DESC;");
    $books = $db->set();
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
                <!--/.span3-->
                <div class="search">
                    <form action="book.php" method="post" class="search-form">
                        <div class="control-group">
                            <a style="font-size: 25px; color: black;font-family: cursive;">Search:</a>
                            <input type="text" id="title" name="title" placeholder="Enter Name/ID of Book" class="span8" style="font-size: 20px" required>
                            <button type="submit" name="submit" class="btn">Search</button>
                        </div>
                    </form>
                    <br>
                    <?php
                    // if (isset($_POST['submit'])) {
                    //     $s = $_POST['title'];
                    //     $sql = "select * from LMS.book where BookId='$s' or Title like '%$s%'";
                    // } else
                    //     $sql = "select * from LMS.book order by Availability DESC";

                    // $result = $conn->query($sql);
                    // $rowcount = mysqli_num_rows($result);

                    if (count($books) < 1):
                        echo "<br><center><h2><b><i>No Results</i></b></h2></center>";
                    else:


                    ?>
                </div>
                <div class="main-content">
                    <div class="table-container">
                        <table class="table" id="tables">
                            <thead>
                                <tr>
                                    <th>Book name</th>
                                    <th>Availability</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                //$result=$conn->query($sql);
                                foreach ($books as $book):
                                    $bookid = $book['BookId'];
                                    $name = $book['Title'];
                                    $avail = $book['Availability'];
                                ?>
                                    <tr>
                                        <td><?php echo $name ?></td>
                                        <td><b><?php
                                                if ($avail > 0)
                                                    echo "<font color=\"green\">AVAILABLE</font>";
                                                else
                                                    echo "<font color=\"red\">NOT AVAILABLE</font>";

                                                ?>

                                            </b></td>
                                        <td>
                                            <center><a href="bookdetails.php?id=<?php echo $bookid; ?>" class="btn btn-primary">Details</a>
                                                <?php
                                                if ($avail > 0)
                                                    echo "<a href=\"issue_request.php?id=" . $bookid . "\" class=\"btn btn-success\">Issue</a>";
                                                ?>
                                            </center>
                                        </td>
                                    </tr>
                            <?php
                                endforeach;
                            endif;
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!--/.span3-->
                    <!--/.span9-->

                    <!--/.span3-->
                    <!--/.span9-->
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

<?php } else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>