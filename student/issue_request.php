<?php
require('dbconn.php');

$id = $_GET['id'];
$roll = $_SESSION['RollNo'];

// Check if a record already exists
$checkSql = "SELECT * FROM LMS.record WHERE RollNo='$roll' AND BookId='$id'";
$result = $conn->query($checkSql);

if ($result->num_rows > 0) {
    // Record already exists
    echo "<script type='text/javascript'>
            alert('Request Already Sent.');
            window.location.href='book.php';
          </script>";
} else {
    // Prepare insert statement
    $sql = "INSERT INTO LMS.record (RollNo, BookId, Time) VALUES ('$roll', '$id', CURTIME())";

    if ($conn->query($sql) === TRUE) {
        // Insertion successful
        echo "<script type='text/javascript'>
                alert('Request Sent to Admin.');
                window.location.href='book.php';
              </script>";
    } else {
        // Insertion failed
        echo "<script type='text/javascript'>
                alert('Error: " . $conn->error . "');
                window.location.href='book.php';
              </script>";
    }
}

$conn->close();
?>