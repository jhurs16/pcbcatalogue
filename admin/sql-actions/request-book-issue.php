<?php
require('../../connection/pdo.php');
include('../../sugarhelper.php');
$db = new DatabaseConnect();

$response = ['status' => 'success', 'message' => []];
$rollno = $_GET['rollno'];
$bookid = $_GET['bookId'];
$db->query("SELECT * FROM record 
WHERE  RollNo = ? 
AND BookId = ?");
$db->bind(1, $rollno);
$db->bind(2, $bookid);
$bookissue = $db->single();

if ($bookissue) {
    $response['status'] = 'error';
    $response['message']['request'] = 'Request already sent!';
} else {
    $db->query("INSERT INTO record (RollNo, BookId, Date_of_Borrow, Time) VALUES (?,?, CURDATE(),CURTIME())");
    $db->bind(1, $rollno);
    $db->bind(2, $bookid);
    $db->execute();
    $response['status'] = 'success';
    $response['message']['request'] = 'Request sent successfully!';
}

// Send the response as JSON

echo json_encode($response);
