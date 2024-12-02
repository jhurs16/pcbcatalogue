<?php
require('../../connection/pdo.php');
include('../../sugarhelper.php');
$db = new DatabaseConnect();
/**
 *  UPDATE STUDENT PROFILE
 */

$response = ['status' => 'success', 'message' => []];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST["action"] == "updateprofile") {
    // dd($_POST["userCurrentData"][0]);
    $userCurrentRollNo = $_POST["userCurrentData"][0]["studentnumber"];
    $userCurrentEmail = $_POST["userCurrentData"][0]["email"];
    $differences = array_diff_assoc($_POST["submittedData"][0], $_POST["userCurrentData"][0]);

    // if (!empty($differences)) {
    //     echo "Changes detected in the following fields: ";
    //     print_r($differences);
    //     dd("Changes detected in the following fields: ");
    // } else {
    //     echo "No changes detected.";
    //     dd("No changes detected.");
    // }
    $rollnumber = $_POST["studentnumber"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    // QUERY FOR CHECKING USER SIGNIN check student id existed
    $db->query("SELECT * FROM user 
    WHERE  RollNo = ? 
    AND RollNo != ?");
    $db->bind(1, $rollnumber);
    $db->bind(2, $userCurrentRollNo);
    $studid = $db->single();



    // QUERY FOR CHECKING USER SIGNIN
    $db->query("SELECT * FROM user 
 WHERE EmailId = ? 
 AND RollNo != ?
 ");
    $db->bind(1, $email);
    $db->bind(2, $userCurrentRollNo);
    $email_exists = $db->single();

    if (empty($differences)) {
        $response['status'] = 'error';
        $response['message']['sameData'] = 'No changes detected.';
    } else if ($email_exists) {

        $response['status'] = 'error';
        $response['message']['emailexist'] = 'Email Address is already in use';
    } else {
        // Correct email and password, create a session and redirect
        // // Password doesn't match !password_verify($password, $user_exists['password']

        // Name='$name', Category='$category', EmailId='$email', MobNo='$mobno', Password='$pswd
        //userCurrentRollNo
        //  UPDATE the user profile
        $db->query("UPDATE user set Name = ?, Category =? , EmailId = ?, MobNo = ?, Password =? where RollNo = ?");
        $db->bind(1, $_POST["studentname"]);
        $db->bind(2, $_POST["category"]);
        $db->bind(3, $_POST["email"]);
        $db->bind(4, $_POST["phonenumber"]);
        $db->bind(5, $_POST["password"]);
        $db->bind(6, $_POST["studentnumber"]);

        $db->execute();


        $response['status'] = 'success';
    }

    // Send the response as JSON
    echo json_encode($response);
}
