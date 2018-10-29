<?php
session_start();
require "../vendor/autoload.php";
use Classes\devices;

if(isset($_POST['delete'])){
    $devices = new devices();
    $id = htmlspecialchars($_POST['id']);
    $devices->deleteDevice($id);
    $_SESSION['message'] = "Įrenginys ištrintas";
    header("Location: ../dashboard.php");
}else{
    header("Location: ../dashboard.php");
}
?>