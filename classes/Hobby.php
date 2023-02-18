<?php
class Hobby{
  public $name;
  public $id;

  public $user_id;
  public $hobby_id;

  private $conn;
  private $table_name;

  public function __construct($db){
    $this->conn = $db;
    $this->table_name = "hobbies";
  }

  public function create_hobby(){
    $query = "INSERT INTO ". $this->table_name ." SET name=?";
    $obj = $this->conn->prepare($query);

    $this->name = htmlspecialchars(strip_tags($this->name));
    if ($obj->execute([$this->name])) {
      return true;
    }
    return false;
  }

  public function get_all_data()
  {
    $sql_query = "SELECT * FROM ". $this->table_name;
    $obj = $this->conn->prepare($sql_query);
    $obj->execute();
    return $obj->fetchAll();
  }

  public function single_data(){
    $query = "SELECT * from ". $this->table_name ." WHERE id =?";
    $obj = $this->conn->prepare($query);
    $obj->execute([$this->id]);
    return $obj->fetch(PDO::FETCH_ASSOC);
  }

  public function update()
  {
    $update_query = "UPDATE ". $this->table_name ." SET name =? WHERE id = ?";
    $query_object = $this->conn->prepare($update_query);

    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->id = htmlspecialchars(strip_tags($this->id));
    if($query_object->execute([$this->name,$this->id])){
      return true;
    }else{
      return false;
    }
  }

  public function delete()
  {
    $delete_query = "DELETE FROM ". $this->table_name. " WHERE id = ?";
    $query_object = $this->conn->prepare($delete_query);
    $this->id = htmlspecialchars(strip_tags($this->id));
    if ($query_object->execute([$this->id])) {
      return true;
    }
    return false;
  }

  public function create_userHobby()
  {
    $query = "INSERT INTO user_hobbies SET user_id=?,hobby_id=?";
    $obj = $this->conn->prepare($query);
    if ($obj->execute([$this->user_id,$this->hobby_id])) {
      return true;
    }
    return false;
  }

  public function delete_userHobby()
  {
    $query = "DELETE FROM user_hobbies WHERE user_id=?";
    $obj = $this->conn->prepare($query);
    if ($obj->execute([$this->user_id])) {
      return true;
    }
    return false;
  }
}
?>