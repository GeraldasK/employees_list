<?php session_start();
require "../vendor/autoload.php";
use Classes\Employees;

if(isset($_POST['add_employer'])){
    $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
    if(!empty($data['full_name'])){
        $employees = new Employees();
        $employees->setEmployees($data);
        $employees->storeEmployees();
    }else{
        $_SESSION['message'] = "Darbuotojo vardo laukelis privalomas";
            header("Location: ../dashboard.php");
    }
}
?>