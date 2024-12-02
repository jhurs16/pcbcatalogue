<?php
require('../../connection/pdo.php');
include('../../sugarhelper.php');
$db = new DatabaseConnect();
/**
 *  UPDATE STUDENT PROFILE
 */
//dd("what nw");

$response = ['status' => 'success', 'message' => []];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    //accept-issue-request
    $issue_date = date('Y-m-d'); // Format: YYYY-MM-DD
    $default_due_date = date('Y-m-d', strtotime($issue_date . ' +1 day'));

    $bookid = $_POST["bookid"];
    $bookrollno = $_POST["bookrollno"];
    $bookaction = $_POST["action"];
    $booktitle = $_POST["booktitle"];
    $recordid = $_POST["recordid"];
    $due_date = isset($_POST["due_date"]) ? $_POST["due_date"] : NULL;
    $days = isset($_POST["days"]) ? $_POST["days"] : NULL;
    // dd($bookid);



    // $db->query("SELECT Category from user where RollNo=?");
    // $db->bind(1, $bookrollno);
    // $usercat = $db->single();

    // $category = $usercat['Category'];
    // check if what kind of action is performed : accept-issue-request
    if ($bookaction == 'accept') {

        $db->query("UPDATE 
        borrowrecords SET borrowdate= CURDATE(),duedate=DATE_ADD(CURDATE(), INTERVAL 1 DAY), status = ?,renewalsleft=2 
        WHERE recordid=?");

        $db->bind(1, 'borrowed');
        $db->bind(2, $recordid);
        $updateresult = $db->execute();

        if ($updateresult) {
            // 
            // UPDATE book availability
            $db->query("UPDATE book SET Availability=Availability-1 where BookId=?");
            $db->bind(1, $bookid);
            $db->execute();

            // SEND MESSAGE
            $db->query("INSERT INTO message (userid,content,date,time) values (?,'Your request for issue of BookId: $bookid with Bookname: $booktitle has been accepted',curdate(),curtime())");
            $db->bind(1, $bookrollno);
            $db->execute();
            $response['status'] = 'success';
            $response['message']['response'] = 'Successfully Accepted.';
        } else {
            $response['status'] = 'error';
        }
    } // end of accept issue request
    else { // reject the request


        $db->query("DELETE FROM borrowrecords WHERE recordid=?");
        $db->bind(1, $recordid);

        $deleteresult = $db->execute();
        if ($deleteresult) {

            $db->query("INSERT into message (userid,content,date,time) values (?,'Your request for issue of BookId: $bookid, with name $booktitle has been rejected',curdate(),curtime())");
            $db->bind(1, $bookrollno);
            $db->execute();
            $response['status'] = 'success';
            $response['message']['response'] = 'Successfully Rejected.';
        } else {
            $response['status'] = 'error';
        }
    }
    //$response['status'] = 'success';
    // Send the response as JSON
    echo json_encode($response);
}


/// =========
