<?php
namespace Classes;

use Classes\Devices;

class DevicesController extends Devices
{
    public function showDevices(){
        $result = $this->getDevices();
        return $result;
    }

    public function showOneDevice($id){
        $result = $this->getOneDevice($id);
        return $result;
    }
}