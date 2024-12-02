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
                <!--/.span3-->

                <div class="search">
                    <form action="student.php" method="post" class="search-form">
                        <div class="control-group">
                            <a style="font-size: 20px; color: black;">Search:</a>
                            <input type="text" id="title" name="title" placeholder="Enter Roll No of Student/Book Name/Book Id." class="span8" required>
                            <button type="submit" name="submit" class="btn">Search</button>
                        </div>
                    </form>
                    <br>
                    <?php
                    if (isset($_POST['submit'])) {
                        $s = $_POST['title'];
                        $sql = "select record.BookId,RollNo,Title,Due_Date,Date_of_Borrow,datediff(curdate(),Due_Date) as x from LMS.record,LMS.book where (Date_of_Borrow is NOT NULL and Date_of_Return is NULL and book.Bookid = record.BookId) and (RollNo='$s' or record.BookId='$s' or Title like '%$s%')";
                    } else
                        $sql = "select record.BookId,RollNo,Title,Due_Date,Date_of_Borrow,datediff(curdate(),Due_Date) as x from LMS.record,LMS.book where Date_of_Borrow is NOT NULL and Date_of_Return is NULL and book.Bookid = record.BookId";
                    $result = $conn->query($sql);
                    $rowcount = mysqli_num_rows($result);

                    if (!($rowcount))
                        echo "<br><center><h2><b><i>No Results</i></b></h2></center>";
                    else {


                    ?>
                        <table class="table" id="tables">
                            <thead>
                                <tr>
                                    <th>Student No.</th>
                                    <th>Book id</th>
                                    <th>Book name</th>
                                    <th>Issue Date</th>
                                    <th>Due date</th>
                                    <th>Dues</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php



                                //$result=$conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    $rollno = $row['RollNo'];
                                    $bookid = $row['BookId'];
                                    $name = $row['Title'];
                                    $issuedate = $row['Date_of_Borrow'];
                                    $duedate = $row['Due_Date'];
                                    $dues = $row['x'];

                                ?>

                                    <tr>
                                        <td><?php echo strtoupper($rollno) ?></td>
                                        <td><?php echo $bookid ?></td>
                                        <td><?php echo $name ?></td>
                                        <td><?php echo $issuedate ?></td>
                                        <td><?php echo $duedate ?></td>
                                        <td><?php if ($dues > 0)
                                                echo "<font color='red'>" . $dues . "</font>";
                                            else
                                                echo "<font color='green'>0</font>";
                                            ?>
                                    </tr>
                            <?php }
                            } ?>
                            </tbody>
                        </table>
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

    </body>

    </html>


<?php } else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>