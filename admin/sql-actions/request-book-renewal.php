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

    $bookid = $_POST["bookid"];
    $bookrollno = $_POST["bookrollno"];
    $bookaction = $_POST["action"];
    $booktitle = $_POST["booktitle"];
    $recordid = $_POST["recordid"];
    // dd($bookid);


    // $db->query("SELECT Category from user where RollNo=?");
    // $db->bind(1, $bookrollno);
    // $usercat = $db->single();

    // $category = $usercat['Category'];
    // check if what kind of action is performed : accept-renew-request

    if ($bookaction == 'accept') {



        // update the borrow records
        $db->query("UPDATE borrowrecords
SET duedate = DATE_ADD(duedate, INTERVAL 1 DAY),
    renewalsleft = renewalsleft - 1,
    status = 'renewed'
WHERE recordid = ? AND renewalsleft > 0;");

        $db->bind(1, $recordid);
        $updateresult = $db->execute();



        if ($updateresult) {

            // update the renewal request status
            $db->query("UPDATE renewalrequest SET status = 'approved' WHERE recordid = ?;");
            $db->bind(1, $recordid);
            $db->execute();

            // insert data to renewal table


            $db->query("INSERT INTO renewals (record_id, renewal_date, new_due_date, renewal_count)
SELECT recordid, CURDATE(), duedate, renewalsleft-1
FROM borrowrecords
WHERE recordid = ?;");
            $db->bind(1, $recordid);
            $db->execute();


            $db->query("INSERT into message (userid,content,date,time) values (?,'Your request for renewal of BookId: $bookid with Bookname: $booktitle has been accepted',curdate(),curtime())");
            $db->bind(1, $bookrollno);
            $db->execute();

            $response['status'] = 'success';
        } else {
            $response['status'] = 'error';
        }
    } else {
        // FOR REJECTING RENEWAL

        $db->query("UPDATE renewalrequest SET status = 'denied' WHERE recordid = ?;");
        $db->bind(1, $recordid);
        $deniedresult = $db->execute();

        if ($deniedresult) {

            $db->query("INSERT into message (userid,content,date,time) values (?,'Your request for renewal of BookId: $bookid with Bookname: $booktitle has been rejected',curdate(),curtime())");
            $db->bind(1, $bookrollno);
            $db->execute();

            $response['status'] = 'success';
        } else {
            $response['status'] = 'error';
        }
    }
    echo json_encode($response);
}


/// =========
