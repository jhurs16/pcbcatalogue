<?php
require 'dbconn.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['id'])) {
    $rollno = $_GET['id'];

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Array of tables to delete from
        $tables = ['LMS.record', 'LMS.renew', 'LMS.return', 'LMS.message', 'LMS.recommendations', 'LMS.user'];

        // Loop through each table and delete records
        foreach ($tables as $table) {
            $deleteSql = "DELETE FROM $table WHERE RollNo = ?";
            $stmt = $conn->prepare($deleteSql);
            if (!$stmt) {
                throw new Exception("Prepare failed for $table: " . $conn->error);
            }
            $stmt->bind_param("s", $rollno);
            $stmt->execute();
            $stmt->close();
        }

        // Commit the transaction
        $conn->commit();

        echo "<script>alert('All records for Student $rollno removed successfully.'); window.location.href='student.php';</script>";
    } catch (Exception $e) {
        // Rollback the transaction if something failed
        $conn->rollback();
        echo "<script>alert('Error removing records: " . $e->getMessage() . "'); window.location.href='student.php';</script>";
    }
}
$conn->close();
?>
