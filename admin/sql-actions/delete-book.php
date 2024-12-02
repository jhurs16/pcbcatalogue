<?php
require('../../connection/pdo.php');
include('../../sugarhelper.php');
$db = new DatabaseConnect();
/**
 *  UPDATE STUDENT PROFILE
 */

$response = ['status' => 'success', 'message' => []];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {




    // dd($bookid);


    // if ($deletebook) {
    //     $response['status'] = 'success';
    // } else {
    // }
    try {
        $bookid = $_POST["bookid"];
        $db->query("DELETE from book where BookId = ?");
        $db->bind(1, $bookid);
        $db->execute();
        $response['status'] = 'success';
    } catch (PDOException $e) {
        $response['status'] = 'error';
        $response['message']['error'] = 'Warning: You can\'t delete this book, Possible reason is: \nBook is associated with the author or record table. Please delete them first then delete this book for safety purposes.';
    }
    // Send the response as JSON
    echo json_encode($response);
}
