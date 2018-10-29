<?php
session_start();
require "../vendor/autoload.php";
use Classes\Employees;

if(isset($_POST['delete'])){
    $employees = new Employees();
    $id = htmlspecialchars($_POST['id']);
    $employees->deleteEmployee($id);
    $_SESSION['message'] = "Darbuotojas istrintas";
    header("Location: ../dashboard.php");
}else{
    header("Location: ../dashboard.php");
}
?>