<?php session_start();
require "../vendor/autoload.php";
use Classes\DeviceToEmployee;

if(isset($_POST['submit'])){
    $devToEmp = new DeviceToEmployee($_POST['employeeId'], $_POST['deviceId']);
}else{
    header("Location: ../dashboard.php");
}
?>