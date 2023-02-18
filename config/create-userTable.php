<?php
  ini_set("display_errors", 1);
  include_once "database.php";

  $db = new Database();
  $connection = $db->connect();
  try {
    $sql = "CREATE TABLE users(
      id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
      name VARCHAR(50) NOT NULL,
      phone VARCHAR(11) NOT NULL,
      gender VARCHAR(9) NOT NULL,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $connection->exec($sql);
    echo "User Table Created Success!";
  } catch (Exception $e) {
    echo $e->getMessage();
  }
  $connection = null;
?>
