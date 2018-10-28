<?php
namespace Classes;

use PDO;
use Classes\Database\Db;

class DeviceToEmployee extends Db
{
    private $deviceId;
    private $employeeId;

    public function __construct($employeeId, $deviceId){
        $this->employeeId = $employeeId;
        $this->deviceId = $deviceId;
        
        if($this->checkForSame() > 0){
            $_SESSION['message'] = "Siam darbuotojui toks irenginys jau priskirtas";
            header("Location: ../dashboard.php");
        }else{
            $this->storeData();
            $_SESSION['message'] = "Irenginys sekmingai priskirtas darbuotojui";
            header("Location: ../dashboard.php");
        }
    }

    private function checkForSame(){
        $sql = "SELECT * FROM employees_devices WHERE employeeId = '$this->employeeId' AND deviceId = '$this->deviceId'";
        $result = $this->query($sql)->rowCount();
        return $result;
    }

    private function storeData(){
        $sql = "INSERT INTO employees_devices (employeeId, deviceId) VALUES (:employeeId, :deviceId)";
        $result = $this->query($sql, [
            'employeeId' => $this->employeeId,
            'deviceId' => $this->deviceId
        ]);
    }
}