<?php
include('../connection/pdo.php');
include('../sugarhelper.php');
$db = new DatabaseConnect();
// if (isset($_POST["signin"])) {
//     $rollnumber = $_POST["RollNo"];
//     $password = $_POST["Password"];

//     // QUERY FOR CHECKING USER SIGNIN
//     $db->query("SELECT * from user where RollNo = ? and password = ? ");
//     $db->bind(1, $rollnumber);
//     $db->bind(2, $password);
//     $user_exists = $db->single();

//     if ($user_exists) {
//         // dd($user_exists["RollNo"]);
//         $_SESSION['RollNo'] = $user_exists["RollNo"];
//         if ($user_exists["Type"] == 'Admin') {
//             header('location: ../admin/index.php');
//         } else {

//             header('location: ../student/index.php');
//         }
//     } else {
//         dd(value: "no user found.");
//     }
// }



$response = ['status' => 'success', 'message' => []];
$adminarray = ["Admin", "admin", "ADMIN"];
//$_POST['actionform'] === 'studentlogin')



// admin
if ($_SERVER['REQUEST_METHOD'] === 'POST' && in_array($_POST['rollno'], $adminarray)) {
    $rollnumber = $_POST["rollno"];
    $password = $_POST["password"];
    $type = 'Admin';


    // QUERY FOR CHECKING admin SIGNIN
    $db->query("SELECT * from user where RollNo = ? and password = ? and Type=?");
    $db->bind(1, $rollnumber);
    $db->bind(2, $password);
    $db->bind(3, $type);
    $user_exists = $db->single();


    if (!$user_exists) {

        $response['status'] = 'error';
        $response['message']['response'] = 'Incorrect roll number or password';
    } else {
        // Correct email and password, create a session and redirect
        // // Password doesn't match !password_verify($password, $user_exists['password']

        $_SESSION['RollNo'] = $user_exists["RollNo"];
        $_SESSION['RoleType'] = $type;
        $response['status'] = 'success';
    }

    // Send the response as JSON
    echo json_encode($response);
} else {
    $rollnumber = $_POST["rollno"];
    $password = $_POST["password"];
    $action = $_POST["actionform"];
    $type = 'Student';



    // QUERY FOR CHECKING USER SIGNIN
    $db->query("SELECT * from user where RollNo = ? and password = ? and Type = ?");
    $db->bind(1, $rollnumber);
    $db->bind(2, $password);
    $db->bind(3, 'Student');
    $user_exists = $db->single();


    if (!$user_exists) {

        $response['status'] = 'error';
        $response['message']['response'] = 'Incorrect roll number or password';
    } else {
        // Correct email and password, create a session and redirect
        // // Password doesn't match !password_verify($password, $user_exists['password']

        $_SESSION['RollNo'] = $user_exists["RollNo"];
        $_SESSION['RoleType'] = $type;
        $response['status'] = 'success';
    }

    // Send the response as JSON
    echo json_encode($response);
}
