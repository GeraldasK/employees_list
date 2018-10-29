<?php
namespace Classes;

use Classes\Employees;

class EmployeesPagination extends Employees
{
    private $result_per_pages = 12;
    private $number_of_result;

    
    public function showEmployees($param1){
        $this->employeesPerPage();

        $start_point = $param1;
        $result_per_pages = $this->result_per_pages;
        $result = $this->getEmployees($start_point, $result_per_pages);
        return $result;
    }

    private function employeesPerPage(){
        $this->number_of_result = $this->getNumberOfEmployees();
        return $this->number_of_result;
    }

    public function numberOfPages(){
        $result = ceil($this->number_of_result/$this->result_per_pages);
        return $result;
    }

    public function getStartPoint($number){
        $start_point = ($number - 1) * $this->result_per_pages;
        return $start_point;
    }
}
?>