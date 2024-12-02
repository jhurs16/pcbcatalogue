<?php
include 'dbconn.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the book ID from the URL
if (isset($_GET['id'])) {
    $bookid = intval($_GET['id']);

    // Prepare SQL statements to delete from all relevant tables
    $sql1 = "DELETE FROM LMS.record WHERE BookId = ?";
    $sql2 = "DELETE FROM LMS.renew WHERE BookId = ?";
    $sql3 = "DELETE FROM LMS.return WHERE BookId = ?";
    $sql4 = "DELETE FROM LMS.author WHERE BookId = ?";
    $sql5 = "DELETE FROM LMS.book WHERE BookId = ?";

    // Prepare and bind
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("i", $bookid);
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("i", $bookid);
    $stmt3 = $conn->prepare($sql3);
    $stmt3->bind_param("i", $bookid);
    $stmt4 = $conn->prepare($sql4);
    $stmt4->bind_param("i", $bookid);
    $stmt5 = $conn->prepare($sql5);
    $stmt5->bind_param("i", $bookid);

    // Execute the statements
    $stmt1->execute();
    $stmt2->execute();
    $stmt3->execute();
    $stmt4->execute();
    $stmt5->execute();

    // Close statements
    $stmt1->close();
    $stmt2->close();
    $stmt3->close();
    $stmt4->close();
    $stmt5->close();

        echo "<script>alert('All records for Book $bookid removed successfully.'); window.location.href='book.php';</script>";
    }  {
        // Rollback the transaction if something failed
        $conn->rollback();
        echo "<script>alert('Error removing records: " . $e->getMessage() . "'); window.location.href='book.php';</script>";
    }


// Close connection
$conn->close();
?>
