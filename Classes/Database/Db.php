<?php
namespace Classes\Database;
use PDO;

class Db
{
    private const SERVERNAME = "localhost";
    private  const USERNAME = "root";
    private const PASSWORD = "";
    private const DBNAME = "emplolist";

    protected function connect(){
        try{
            return new PDO('mysql:host='.SELF::SERVERNAME.";dbname=".SELF::DBNAME, SELF::USERNAME, SELF::PASSWORD);
        }
        catch(Exception $e){
            echo "Negalima prisijungti prie duomenu bazes";
        }
    }

    protected function query($sql, $params = []){
        $sth = $this->connect()->prepare($sql);
        $sth->execute($params);
        return $sth;
    }
}

?>