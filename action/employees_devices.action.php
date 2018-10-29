<?php session_start();
require "../vendor/autoload.php";
use Classes\DeviceToEmployee;

if(isset($_POST['submit'])){
    $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
    $devToEmp = new DeviceToEmployee($data['employeeId'], $data['deviceId']);
}else{
    $_SESSION['message'] = "Ivyko klaida";
    header("Location: ../dashboard.php");
}
?>