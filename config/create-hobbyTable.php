<?php
  include_once "database.php";

  $db = new Database();
  $connection = $db->connect();

  try {
    $sql = "CREATE TABLE IF NOT EXISTS hobbies (
      id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
      name VARCHAR(50) NOT NULL,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $connection->exec($sql);
    echo "Hobby Table Created Success!";
  } catch (Exception $e) {
    echo $e->getMessage();
  }
  $connection = null;

?>
