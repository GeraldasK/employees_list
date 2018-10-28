<?php
namespace Classes;

use PDO;
use Classes\Database\Db;

class Employees extends Db
{   
    private $full_name;
    private $birth_date;
    private $city;
    private $phone_number;
    private $email;
    private $id;
    

    public function setEmployees($data){
        $this->full_name = $data['full_name'];
        $this->birth_date = $data['birth_date'];
        $this->city = $data['city'];
        $this->phone_number = $data['phone_number'];
        $this->email = $data['email'];
    }

    // su siuo metodu tikrinu ar lenteleje nera yrasytas toks darbuotojas
    private function checkEmployees(){
        $sql = "SELECT full_name FROM employees WHERE full_name = '$this->full_name'";
        $result = $this->query($sql)->rowCount();
        return $result;
    }

    //Issaugau duomenis Duomenu bazeje
    public function storeEmployees(){
        if($this->checkEmployees() > 0){
            $_SESSION['message'] = "Darbuotojas su tokiu vardu jau įtrauktas";
            header("Location: ../dashboard.php");
        }else{
            $sql = "INSERT INTO employees (full_name, birth_date, city, phone_number, email)
            VALUES (:full_name, :birth_date, :city, :phone_number, :email)";
            $result = $this->query($sql, [
                'full_name' => $this->full_name,
                'birth_date' => $this->birth_date,
                'city' => $this->city,
                'phone_number' => $this->phone_number,
                'email' => $this->email
            ]);
            $_SESSION['message'] = "Darbuotojas sekmingai pridetas";
            header("Location: ../dashboard.php");
        }
    }

    //Su siuo metodu pasiemu tam tikra darbuotoju skaiciu per puslapi
    public function getEmployees($start_point, $result_per_page){
        $sql="SELECT *
        FROM employees ORDER BY full_name
        LIMIT $start_point, $result_per_page";
        $result = $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    
    protected function getAllEmployees(){
        $sql="SELECT *
        FROM employees ORDER BY full_name";
        $result = $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //metodas su kurio pasiemu viena darbuotoja (reikalingas EDIT);
    public function getOneEmployee($id){
        $sql="SELECT *
        FROM employees WHERE id='$id'";
        $result = $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //metodas kuris atnaujina darbuotojus
    public function updateEmployee($data){

        $this->full_name = $data['full_name'];
        $this->birth_date = $data['birth_date'];
        $this->city = $data['city'];
        $this->phone_number = $data['phone_number'];
        $this->email = $data['email'];
        $this->id = $data['id'];

        $sql = "UPDATE employees SET full_name = :full_name, birth_date = :birth_date , city = :city,
        phone_number = :phone_number, email = :email WHERE id = :id";

        $result = $this->query($sql, [
            'full_name' => $this->full_name,
            'birth_date' => $this->birth_date,
            'city' => $this->city,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'id' => $this->id
        ]);
    }

    //metodas kuris istrina darbuotojus
    public function deleteEmployee($id){
        $sql = "DELETE FROM employees WHERE id = '$id'";
        $this->query($sql);
    }

    //metodas su kuriuo suzinau kiek darbuotoju irasyta duomenu bazeje (reikalinga puslapiavimui)
    protected function getNumberOfEmployees(){
        $sql = "SELECT id FROM employees";
        $result = $this->query($sql)->rowCount();
        return $result;
    }
}

?>