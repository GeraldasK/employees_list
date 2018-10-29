<?php
session_start();
include "../vendor/autoload.php";
use Classes\Users;

if(isset($_POST['submit'])){
    $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
    $users = new Users ();
    $users->setUser($data['email'], $data['password']);
    $users->logUser();
}else{
    header("Location: ../login.php")
}
?>