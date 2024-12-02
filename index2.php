<?php
require('dbconn.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" contents="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css" type="text/css" media="all">


</head>

<body style="background-image: url('images/1.jpg'); /* Change 'your-image.jpg' to your actual image file name */
            background-size: cover; /* Makes the image cover the entire body */
            background-position: center;">

    <div style="padding-top: 4%;">
        <div class="con">
            <h1>PCB CATALOGUING SYSTEM</h1>
        </div>

        <div class="login">

            <div class="container">
                <img src="images/logo.png" alt="Logo" class="logo">
                <form action="index.php" method="post" style="margin-top: -10px;">
                    <input type="text" Name="RollNo" placeholder="Student No" style="margin-top: -10%;" required="">
                    <input type="password" Name="Password" placeholder="Password" required="">
                    <div class="send-button">
                        <input type="submit" name="signin" ; value="Sign In">
                    </div>
                    <div class="send">
                        <input onclick="openModal()" type="submit" value="Sign Up">
                    </div>
                </form>
                <!-- Button to open the modal -->
                <p>By creating an account, you agree to our terms and conditions</p>
            </div>
        </div>
    </div>

    <!-- Sign Up Modal -->
    <div id="signupModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Sign Up</h2>
            <form action="signup.php" method="post" onsubmit="return validateForm()">
                <input type="text" name="Name" placeholder="Name" required>
                <input type="text" name="Email" placeholder="Email" required>
                <input type="password" name="Password" placeholder="Password" required minlength="8" title="Password must be at least 8 characters long">
                <input type="text" name="PhoneNumber" placeholder="Phone Number (e.g., 09123456789)" required pattern="^09\d{9}$" title="Must start with 09 and be 11 digits long">
                <input type="text" name="RollNo" placeholder="Student Number (e.g., 12-12345)" required pattern="^\d{2}-\d{5}$" title="Format: 12-12345">
                <br>
                <select name="Category" id="Category" style="background-color: black; color: white; border: 1px solid #ccc; padding: 10px;">
                    <option value="BSIT" style="background-color: black; color: white;">BSIT</option>
                    <option value="BSIS" style="background-color: black; color: white;">BSIS</option>
                    <option value="BSCS" style="background-color: black; color: white;">BSCS</option>
                    <option value="ACT" style="background-color: black; color: white;">ACT</option>
                    <option value="BEED" style="background-color: black; color: white;">BEED</option>
                    <option value="BECAED" style="background-color: black; color: white;">BECAED</option>
                </select>
                <br><br>

                <div class="send-button" style="margin-right: 27%;">
                    <input type="button" onclick="openModal()" value="Sign Up">
                </div>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['signin'])) {
        $u = $_POST['RollNo'];
        $p = $_POST['Password'];


        $sql = "select * from LMS.user where RollNo='$u'";

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $x = $row['Password'];
        $y = $row['Type'];
        if (strcasecmp($x, $p) == 0 && !empty($u) && !empty($p)) { //echo "Login Successful";
            $_SESSION['RollNo'] = $u;


            if ($y == 'Admin')
                header('location:admin/index.php');
            else
                header('location:student/index.php');
        } else {
            echo "<script type='text/javascript'>alert('Failed to Login! Incorrect StudentNo or Password')</script>";
        }
    }

    if (isset($_POST['signup'])) {
        $name = $_POST['Name'];
        $email = $_POST['Email'];
        $password = $_POST['Password'];
        $mobno = $_POST['PhoneNumber'];
        $rollno = $_POST['RollNo'];
        $category = $_POST['Category'];
        $type = 'Student';

        $sql = "insert into LMS.user (Name,Type,Category,RollNo,EmailId,MobNo,Password) values ('$name','$type','$category','$rollno','$email','$mobno','$password')";

        if ($conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>alert('Registration Successful')</script>";
        } else {
            //echo "Error: " . $sql . "<br>" . $conn->error;
            echo "<script type='text/javascript'>alert('User Exists')</script>";
        }
    }

    ?>

    <script>
        // Modal JavaScript functions
        function openModal() {
            document.getElementById('signupModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('signupModal').style.display = 'none';
        }

        // Close the modal if the user clicks outside of it
        window.onclick = function(event) {
            const modal = document.getElementById('signupModal');
            if (event.target == modal) {
                closeModal();
            }
        }

        function validateForm() {
            const email = document.querySelector('input[name="Email"]').value;
            if (!email.endsWith('@pcb.edu.ph')) {
                alert('Email must end with @pcb.edu.ph');
                return false;
            }
            return true;
        }
    </script>
    <script>
        function checkRollNo(rollNo) {
            if (existingRollNos.includes(rollNo)) {
                alert('This Roll Number is already in use. Please use a different Roll Number.');
                return false; // Prevents form submission if needed
            }
        }
    </script>


</body>

</html>