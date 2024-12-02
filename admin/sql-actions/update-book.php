<?php
require('../../connection/pdo.php');
include('../../sugarhelper.php');
$db = new DatabaseConnect();
/**
 *  UPDATE STUDENT PROFILE
 */

$response = ['status' => 'success', 'message' => []];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // dd($_POST);
    // exit();
    $bookid = $_POST["bookid"];
    $bookname = $_POST["bookname"];
    $publisher = $_POST["publisher"];
    $year = $_POST["year"];
    $availability = $_POST["availability"];
    $datereceived = $_POST["datereceived"] == '' ? NULL : $_POST["datereceived"];
    $callno = $_POST["callno"];
    $authoreditor = $_POST["authoreditor"];
    $edition = $_POST["edition"];
    $vol = $_POST["vol"];
    $pages = $_POST["pages"];
    $sourceoffund = $_POST["sourceoffund"];
    $cost = $_POST["cost"];
    $remarks = $_POST["remarks"];
    $section = $_POST["section"];
    $placeofpublication = $_POST["placeofpublication"];
    $isbn = $_POST["isbn"];


    $db->query("UPDATE book set Title = ?, Publisher = ? , Year = ?, Availability = ?, DateReceived =?, CallNo = ?, AuthorEditor = ?, Edition = ?, Vol = ?, Pages = ?, Sourceoffund = ?, Cost = ?, Remarks = ?, Section = ?, PlaceOfPublication = ? , ISBN = ?  where BookId = ?");
    $db->bind(1, $bookname);
    $db->bind(2, $publisher);
    $db->bind(3, $year);
    $db->bind(4, $availability);

    $db->bind(5,  $datereceived);
    $db->bind(6, $callno);
    $db->bind(7, $authoreditor);
    $db->bind(8, $edition);
    $db->bind(9, $vol);
    $db->bind(10, $pages);
    $db->bind(11, $sourceoffund);
    $db->bind(12, $cost);
    $db->bind(13, $remarks);
    $db->bind(14, $section);
    $db->bind(15, $placeofpublication);
    $db->bind(16, $isbn);
    $db->bind(17, $bookid);

    $updatesuccess = $db->execute();
    if ($updatesuccess) {
        $response['status'] = 'success';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Failed to update book data';
    }

    // Send the response as JSON
    echo json_encode($response);
}
