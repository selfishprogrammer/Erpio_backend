<?php
require_once('../DB/db.php');
header('Access-Control-Allow-Origin: *');
$json = file_get_contents("php://input");
$object = json_decode($json, true);
$employee_id = $object['employee_id'];
$password = $object['password'];


$check_login = mysqli_query($conn, "select * from `employee` where `employee_id`='$employee_id' and `password`='$password'");
$nums_of_record = mysqli_num_rows($check_login);

if ($nums_of_record > 0) {
    $check_employee_status = mysqli_query($conn, "select * from `employee` where `employee_id`='$employee_id' and `employee_status`='active'");
    $nums = mysqli_num_rows($check_employee_status);
    if ($nums > 0) {
        $row = mysqli_fetch_assoc($check_login);
        $msg = array('data' => 'Successfully LoggedIn !', 'status' => 'true',  'details' => $row);
        echo json_encode($msg);
    } else {
        $row = mysqli_fetch_assoc($check_login);
        $msg = array('data' => 'Please verify your EmployeeID!', 'status' => 'notActive');
        echo json_encode($msg);
    }
} else {
    $msg = array('data' => 'EmployeeID Or Password Incorrect! or not Exist', 'status' => 'false');
    echo json_encode($msg);
}
