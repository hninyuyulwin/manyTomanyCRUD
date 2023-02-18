<?php
class Database{
  private $hostname;
  private $dbname;
  private $username;
  private $password;

  private $conn;

  public function connect(){
    $this->hostname = 'localhost';
    $this->dbname = 'task2';
    $this->username = 'root';
    $this->password = 'secret';
 
    try {
      $this->conn = new PDO("mysql:host=".$this->hostname.";dbname=".$this->dbname,$this->username,$this->password,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      ]);
      return $this->conn;
    } catch (Exception $e) {
      echo $e->getMessage();
    }
    $this->conn = null;
  }
}
?>