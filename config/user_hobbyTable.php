<?php
  include_once "database.php";

  $db = new Database();
  $connection = $db->connect();

  try {
    $sql = "CREATE TABLE IF NOT EXISTS user_hobbies (
      user_id INT,
      hobby_id INT,
      PRIMARY KEY (user_id, hobby_id),
      FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
      FOREIGN KEY (hobby_id) REFERENCES hobbies(id) ON DELETE CASCADE ON UPDATE CASCADE
    )";

    $connection->exec($sql);
    echo "USER_HOBBY Table Created Success!";
  } catch (Exception $e) {
    echo $e->getMessage();
  }
  $connection = null;
?>
