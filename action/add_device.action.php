<?php session_start();
require "../vendor/autoload.php";
use Classes\Devices;

if(isset($_POST['add_device'])){
    $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
    if(!empty($data['device_name']) && !empty($data['device_code']) ){
        $devices = new Devices();
        $devices->setDevices($data);
        $devices->storeDevices();
    }else{
        $_SESSION['message'] = "Device name and device code fields must be filled in";
            header("Location: ../dashboard.php");
    }
}
?>