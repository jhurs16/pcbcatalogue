<?php
require('../../connection/pdo.php');
include('../../sugarhelper.php');
$db = new DatabaseConnect();

$response = ['status' => 'success', 'message' => []];
$studentnumber = $_POST['studentnumber'];
$message = $_POST['message'];

$db->query("SELECT * FROM user WHERE RollNo = ? AND Type = 'Student'");
$db->bind(1, $studentnumber);
$validstudent = $db->single();

if ($validstudent) {
    $db->query("INSERT INTO message (RollNo, Msg, Date, Time) VALUES (?,?, CURDATE(),CURTIME())");
    $db->bind(1, $studentnumber);
    $db->bind(2, $message);
    $db->execute();
    $response['status'] = 'success';
    $response['message']['send'] = 'Message sent successfully!';
} else {
    $response['status'] = 'error';
}



// Send the response as JSON

echo json_encode($response);
