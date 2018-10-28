<?php
session_start();
require "../vendor/autoload.php";
use Classes\Employees;

if(isset($_POST['submit'])){
    $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
    $employees = new Employees();
    $employees->updateEmployee($data);
    $_SESSION['message'] = "Darbuotojo duomenys atnaujinti";
    header("Location: ../dashboard.php");
}else{
    header("Location: ../dashboard.php");
}
?>