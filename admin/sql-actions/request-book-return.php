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
    $dues = $_POST["dues"];
    $recordid  = $_POST["recordid"];
    $rtid  = $_POST["rtid"];
    // dd($bookid);

    // check if what kind of action is performed : accept-renew-request

    if ($bookaction == 'accept') {


        $db->query("UPDATE borrowrecords br SET returndate= CURDATE(), due = DATEDIFF(CURDATE(), duedate), status = 'returned'
WHERE recordid = ?;");
        $db->bind(1, $recordid);

        $rs = $db->execute();

        if ($rs) {
            // add penalty if overdue
            $db->query("SELECT * FROM borrowrecords WHERE recordid = ?");
            $db->bind(1, $recordid);
            $checkpenalty = $db->single();

            if ($checkpenalty) {
                if ($checkpenalty["due"] > 0) {
                    $db->query("INSERT INTO penalties(record_id, penalty_amount, remarks, penalty_date)
                VALUES(?,?,?,CURDATE());");
                    $db->bind(1, $recordid);
                    $db->bind(2, $checkpenalty["due"] * 5);
                    $db->bind(3, "Overdue");
                    $db->execute();
                }
            }

            $db->query("UPDATE book SET Availability=Availability+1 WHERE BookId=? ");
            $db->bind(1, $bookid);
            $db->execute();


            $db->query("DELETE FROM returnrequest WHERE rtid = ?");
            $db->bind(1, $rtid);
            $db->execute();


            // $db->query("DELETE FROM renew WHERE RollNo=? and BookId=?");
            // $db->bind(1, $bookrollno);
            // $db->bind(2, $bookid);
            // $db->execute();

            $db->query("INSERT into message (userid,content,date,time) values (?,'Your request for return of BookId: $bookid with Bookname: $booktitle has been accepted',curdate(),curtime())");
            $db->bind(1, $bookrollno);
            $db->execute();

            $response['status'] = 'success';
        } else {
            $response['status'] = 'error';
        }
    } // end of book action accept
    else { // reject return

        $db->query("DELETE FROM returnrequest WHERE rtid = ?");
        $db->bind(1, $rtid);

        $deleteresult = $db->execute();
        if ($deleteresult) {


            $db->query("INSERT into message (userid,content,date,time) values (?,'Your request for return of BookId: $bookid with Bookname: $booktitle has been rejected',curdate(),curtime())");
            $db->bind(1, $bookrollno);
            $db->execute();
        } else {
            $response['status'] = 'error';
        }
    }
    echo json_encode($response);
}


/// =========
