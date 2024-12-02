<?php
require('../../connection/pdo.php');
include('../../sugarhelper.php');
$db = new DatabaseConnect();
/**
 *  UPDATE STUDENT PROFILE
 */

$response = ['status' => 'success', 'message' => []];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // message, record, renew, return
    $studentid = $_POST["studentid"];


    // Send the response as JSON
    // $db->query("DELETE from user where RollNo = ?");
    // $db->bind(1, $studentid);
    // $db->execute();

    // $response['status'] = 'success';
    try {
        $db->beginTransaction();

        $db->query("SELECT * from message where RollNo = ?");
        $db->bind(1, $studentid);
        $usermessage = $db->single();

        if ($usermessage) {
            // delete from message table
            $db->query("DELETE from message where RollNo = ?");
            $db->bind(1, $studentid);
            $db->execute();
        }

        $db->query("SELECT * from record where RollNo = ?");
        $db->bind(1, $studentid);
        $userrecord = $db->single();

        if ($userrecord) {
            // delete from record table
            $db->query("DELETE from record where RollNo = ?");
            $db->bind(1, $studentid);
            $db->execute();
        }

        $db->query("SELECT * from renew where RollNo = ?");
        $db->bind(1, $studentid);
        $userrenew = $db->single();

        if ($userrenew) {
            // delete from renew table
            $db->query("DELETE from renew where RollNo = ?");
            $db->bind(1, $studentid);
            $db->execute();
        }

        $db->query("SELECT * from `return` where RollNo = ?");
        $db->bind(1, $studentid);
        $userreturn = $db->single();

        if ($userreturn) {
            // delete from renew table
            $db->query("DELETE from `return`where RollNo = ?");
            $db->bind(1, $studentid);
            $db->execute();
        }


        $db->query("DELETE from user where RollNo = ?");
        $db->bind(1, $studentid);
        $db->execute();
        $db->commit();
        $response['status'] = 'success';
    } catch (PDOException $e) {
        $db->rollback();
        $response['status'] = 'error';
    }
    echo json_encode($response);
}
