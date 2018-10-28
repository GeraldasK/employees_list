<?php
session_start();
require "../vendor/autoload.php";
use Classes\devices;

if(isset($_POST['delete'])){
    $devices = new devices();
    $devices->deleteDevice($_POST['id']);
    $_SESSION['message'] = "Irenginys istrintas";
    header("Location: ../dashboard.php");
}else{
    header("Location: ../dashboard.php");
}
?>