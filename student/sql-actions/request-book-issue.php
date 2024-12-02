<?php
require('../../connection/pdo.php');
include('../../sugarhelper.php');
$db = new DatabaseConnect();

$response = ['status' => 'success', 'message' => []];
$rollno = $_GET['rollno'];
$bookid = $_GET['bookId'];
$db->query("SELECT * FROM borrowrecords 
WHERE  userid = ? 
AND bookid = ? AND status = 'borrowrequest'");
$db->bind(1, $rollno);
$db->bind(2, $bookid);
$bookissue = $db->single();

$db->query("SELECT * FROM borrowrecords 
WHERE  userid = ? 
AND bookid = ? AND status = 'borrowed'");
$db->bind(1, $rollno);
$db->bind(2, $bookid);
$checkborrowed = $db->single();

if ($bookissue) {
    $response['status'] = 'error';
    $response['message']['request'] = 'Request already sent!';
} else if ($checkborrowed) {
    $response['status'] = 'error';
    $response['message']['request'] = 'This book is currently borrowed!';
} else {
    // $db->query("INSERT INTO record (RollNo, BookId, Date_of_Borrow, Time) VALUES (?,?, CURDATE(),CURTIME())");
    $db->query("INSERT INTO borrowrecords(userid, bookid, STATUS) VALUES(?,?,'borrowrequest')");
    $db->bind(1, $rollno);
    $db->bind(2, $bookid);
    $db->execute();
    $response['status'] = 'success';
    $response['message']['request'] = 'Request sent successfully!';
}

// Send the response as JSON

echo json_encode($response);
