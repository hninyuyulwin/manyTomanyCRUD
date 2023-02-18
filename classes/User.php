<?php
class User{
  public $name;
  public $phone;
  public $gender;
  public $last_insertUser;
  public $id;

  private $conn;
  private $table_name;

  public function __construct($db){
    $this->conn = $db;
    $this->table_name = "users";
  }

  public function create_user(){
    $query = "INSERT INTO ". $this->table_name ." SET name=?,phone=?,gender=?";
    $obj = $this->conn->prepare($query);

    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->phone = htmlspecialchars(strip_tags($this->phone));
    $this->gender = htmlspecialchars(strip_tags($this->gender));

    if ($obj->execute([$this->name,$this->phone,$this->gender])) {
      $this->last_insertUser = $this->conn->lastInsertId();
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

  public function get_all_userhobby()
  {
    $sql = "SELECT u.*, GROUP_CONCAT(h.name SEPARATOR ', ') AS hobbies
            FROM users u
            LEFT JOIN user_hobbies ON u.id = user_hobbies.user_id
            LEFT JOIN hobbies h ON user_hobbies.hobby_id = h.id
            GROUP BY u.id";
    $obj = $this->conn->prepare($sql);
    $obj->execute();
    return $obj->fetchAll(PDO::FETCH_ASSOC);
  }
  
  public function single_data()
  {
    $sql_query = "SELECT * FROM ". $this->table_name. " WHERE id=?";
    $obj = $this->conn->prepare($sql_query);
    $obj->execute([$this->id]);
    return $obj->fetch(PDO::FETCH_ASSOC);
  }

  public function checkBoxChecked(){
    $sql = "SELECT hobbies.* FROM hobbies
            INNER JOIN user_hobbies ON hobbies.id = user_hobbies.hobby_id
            WHERE user_hobbies.user_id =?";
    $obj = $this->conn->prepare($sql);
    $obj->execute([$this->id]);
    return $obj->fetchAll(PDO::FETCH_ASSOC);
  }

  public function update()
  {
    $update_query = "UPDATE ". $this->table_name ." SET name =?,phone=?,gender=? WHERE id = ?";
    $query_object = $this->conn->prepare($update_query);

    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->phone = htmlspecialchars(strip_tags($this->phone));
    $this->gender = htmlspecialchars(strip_tags($this->gender));
    $this->id = htmlspecialchars(strip_tags($this->id));

    if($query_object->execute([$this->name,$this->phone,$this->gender,$this->id])){
      return true;
    }else{
      return false;
    }
  }

  public function delete()
  {
    $delete_query = "DELETE FROM ". $this->table_name. " WHERE id = ?";
    $query_object = $this->conn->prepare($delete_query);
    if ($query_object->execute([$this->id])) {
      return true;
    }
    return false;
  }
}
?>