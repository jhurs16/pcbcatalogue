<?php
include('../connection/pdo.php');
include('../sugarhelper.php');
$db = new DatabaseConnect();
$response = ['status' => 'success', 'message' => []];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['studentname'];
    $email = $_POST['signupemail'];
    $password = $_POST['password'];
    $mobno = $_POST['phonenumber'];
    $rollno = $_POST['studentnumber'];
    $category = $_POST['category'];
    $type = 'Student';

    htmlspecialchars($name);
    htmlspecialchars($email);
    htmlspecialchars($password);
    htmlspecialchars($mobno);
    htmlspecialchars($rollno);
    htmlspecialchars($category);


    $db->query("SELECT * FROM user WHERE RollNo = ?");
    $db->bind(1, $rollno);
    $check_studid = $db->set();

    $db->query("SELECT * FROM user WHERE EmailId = ?");
    $db->bind(1, $email);
    $check_email = $db->set();


    if ($check_studid) {
        // dd("student id is exist=>" . $check_studid);
        $response['status'] = 'error';
        $response['message']['rollno'] = 'Student ID is already exists.';
    } else if ($check_email) {

        $response['status'] = 'error';
        $response['message']['email'] = 'Email is already taken.';
    } else {
        $response['status'] = 'success';
        $response['message']['response'] = 'Successfully created an account.';

        $_SESSION['RollNo'] = $rollno;
        $_SESSION['RoleType'] = $type;
        // insert data if successful Name,Type,Category,RollNo,EmailId,MobNo,Password
        $db->query("INSERT INTO user(Name,Type,Category,RollNo,EmailId,MobNo,Password) VALUES(?,?,?,?,?,?,?)");
        $db->bind(1, $name);
        $db->bind(2, $type);
        $db->bind(3, $category);
        $db->bind(4, $rollno);
        $db->bind(5, $email);
        $db->bind(6, $mobno);
        $db->bind(7, $password);

        $db->execute();
    }

    // Send the response as JSON
    echo json_encode($response);
}
