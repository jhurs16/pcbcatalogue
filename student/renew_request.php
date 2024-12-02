<?php
require('dbconn.php');

$id = $_GET['id'];
$roll = $_SESSION['RollNo'];

// Check if a record already exists
$checkSql = "SELECT * FROM LMS.renew WHERE RollNo='$roll' AND BookId='$id'";
$result = $conn->query($checkSql);

if ($result->num_rows > 0) {
    // Record already exists
    echo "<script type='text/javascript'>
            alert('Request Already Sent.');
            window.location.href='current.php';
          </script>";
} else {
    // Prepare insert statement
    $sql = "INSERT INTO LMS.renew (RollNo, BookId) VALUES ('$roll', '$id')";

    if ($conn->query($sql) === TRUE) {
        // Insertion successful
        echo "<script type='text/javascript'>
                alert('Request Sent to Admin.');
                window.location.href='current.php';
              </script>";
    } else {
        // Insertion failed
        echo "<script type='text/javascript'>
                alert('Error: " . $conn->error . "');
                window.location.href='current.php';
              </script>";
    }
}

$conn->close();
?>