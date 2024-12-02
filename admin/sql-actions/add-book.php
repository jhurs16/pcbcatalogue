<?php
require('../../connection/pdo.php');
include('../../sugarhelper.php');
$db = new DatabaseConnect();
/**
 *  UPDATE STUDENT PROFILE
 */

$response = ['status' => 'success', 'message' => []];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    // $authors = $_POST["authors"];
    $bookname = $_POST["addbookname"];
    $publisher = $_POST["addbookpublisher"];
    $year = $_POST["addbookyear"];
    $availability = $_POST["addbookcopies"];
    $datereceived = $_POST["adddatereceived"] == '' ? NULL : $_POST["datereceived"];
    $callno = $_POST["addcallno"];
    $authoreditor = $_POST["addauthoreditor"];
    $edition = $_POST["addedition"];
    $vol = $_POST["addvol"];
    $pages = $_POST["addpages"];
    $sourceoffund = $_POST["addsourceoffund"];
    $cost = $_POST["addcost"];
    $remarks = $_POST["addremarks"];
    $section = $_POST["addsection"];
    $placeofpublication = $_POST["addplaceofpublication"];
    $isbn = $_POST["addisbn"];



    // books count
    $db->query("SELECT * FROM book WHERE Title = ?;");
    $db->bind(1, $bookname);
    $book = $db->single();
    // dd($book);
    if ($book) {

        $response['status'] = 'error';
        $response['message']['bookexist'] = 'Book already exists';
    } else {
        $db->query("INSERT INTO book(Title, Publisher, `Year`, `Availability`, `DateReceived`, `CallNo`,`AuthorEditor`, `Edition`, `Vol`, `Pages`, `Sourceoffund`,`Cost`,`Remarks`,`Section`,`PlaceOfPublication`,`ISBN`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $db->bind(1, $bookname);
        $db->bind(2, $publisher);
        $db->bind(3, $year);
        $db->bind(4, $availability);
        $db->bind(5, $datereceived);
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

        $db->execute();
        $response['status'] = 'success';
    }


    // Send the response as JSON
    echo json_encode($response);
}
