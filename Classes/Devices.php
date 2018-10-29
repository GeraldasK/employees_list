<?php
namespace Classes;

use Classes\Database\Db;
use PDO;

class Devices extends Db
{
    private $device_category;
    private $device_name;
    private $device_code;
    private $id;

    public function setDevices($data){
        $this->device_category = $data['device_category'];
        $this->device_name = $data['device_name']." ".$data['device_code'];
        $this->device_code = $data['device_code'];
    }

    // Su siuo metodu tikrinu ar lenteleje jau yra irenginys su tokiu irenginio kodu;
    private function checkDevices(){
        $sql = "SELECT * FROM devices WHERE device_name LIKE '%$this->device_code'";
        $result = $this->query($sql)->rowCount();
        return $result;
    }

    // Sis metodas iraso duomenis i Db;
    public function storeDevices(){
        if($this->checkDevices() > 0){
            $_SESSION['message'] = "Toks irenginys jau yra";
            header("Location: ../dashboard.php");
        }else{
            $sql = "INSERT INTO devices (device_category, device_name)
            VALUES (:device_category, :device_name)";
            $result = $this->query($sql, [
                'device_category' => $this->device_category,
                'device_name' => $this->device_name
            ]);
            $_SESSION['message'] = "Irenginys sekmingai pridetas";
            header("Location: ../dashboard.php");
        }
    }

    // pasiemu viena irengini is duomenu bazes 
    public function getOneDevice($id){
        $sql="SELECT devices.device_name FROM devices LEFT JOIN employees_devices ON devices.id = employees_devices.deviceId WHERE employees_devices.employeeId = '$id'";
        $result = $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getDevices(){
        $sql = "SELECT * FROM devices ORDER BY device_category";
        $result = $this->query($sql)->fetchALL(PDO::FETCH_ASSOC);
        return $result;
    }

    // Irenginio istrinimas
    public function deleteDevice($id){
        $sql = "DELETE FROM devices WHERE id = '$id'";
        $this->query($sql);
    }
}

?>