<?php
namespace Classes;
use Classes\Database\Db;
// use Classes\Database\Db;

class Users extends Db
{
    private $email;
    private $password;

    public function setUser($email, $password){
        $this->email = $email;
        $this->password = $password;
    }
    
    private function checkUser(){
        $sql = "SELECT email, password FROM users WHERE email = '$this->email' AND password = '$this->password'";
        $result = $this->query($sql)->rowCount();
        return $result;
    }

    public function logUser(){
        if($this->checkUser() > 0 ){
            $_SESSION['message'] = "Sveiki, Jus esate prisijunges";
            $_SESSION['user'] = $this->email;
            header("Location: ../dashboard.php");
        }else{
            $_SESSION['message'] = "Klaidingai nurodėte vartotojo vardą arba spalptažodį";
            header("Location: ../login.php");
        }
    }
}

?>