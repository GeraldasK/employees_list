<?php
session_start();
require "../vendor/autoload.php";
use Classes\Employees;

if(isset($_POST['delete'])){
    $employees = new Employees();
    $employees->deleteEmployee($_POST['id']);
    $_SESSION['message'] = "Darbuotojas istrintas";
    header("Location: ../dashboard.php");
}else{
    header("Location: ../dashboard.php");
}
?>