<?php
require('../../connection/pdo.php');
include('../../sugarhelper.php');
$db = new DatabaseConnect();
/**
 *  UPDATE STUDENT PROFILE
 */

$response = ['status' => 'success', 'message' => []];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST["action"] == "updateprofile") {

    // let userCurrentData = [{
    //     adminname: tempname,
    //     email: tempemail,
    //     password: temppass,
    //     phonenumber: tempmobno,

    // }]
    // let submittedData = [{
    //     adminname,
    //     email,
    //     password,
    //     phonenumber,


    // }]
    // dd($_POST["userCurrentData"][0]);

    $userCurrentEmail = $_POST["userCurrentData"][0]["email"];
    $differences = array_diff_assoc($_POST["submittedData"][0], $_POST["userCurrentData"][0]);


    $password = $_POST["password"];
    $email = $_POST["email"];

    // QUERY FOR CHECKING USER SIGNIN check student id existed
    $db->query("SELECT * FROM user 
    WHERE  RollNo = ? 
    AND Type = 'Admin'");
    $db->bind(1, 'ADMIN');
    $adminid = $db->single();





    if (empty($differences)) {
        $response['status'] = 'error';
        $response['message']['sameData'] = 'No changes detected.';
    } else {
        // Correct email and password, create a session and redirect
        // // Password doesn't match !password_verify($password, $user_exists['password']

        // Name='$name', Category='$category', EmailId='$email', MobNo='$mobno', Password='$pswd
        //userCurrentRollNo
        //  UPDATE the user profile
        $db->query("UPDATE user set Name = ? , EmailId = ?, MobNo = ?, Password =? where RollNo = 'ADMIN' and Type ='Admin'");
        $db->bind(1, $_POST["adminname"]);
        $db->bind(2, $_POST["email"]);
        $db->bind(3, $_POST["phonenumber"]);
        $db->bind(4, $_POST["password"]);


        $db->execute();


        $response['status'] = 'success';
    }

    // Send the response as JSON
    echo json_encode($response);
}
