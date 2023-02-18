<?php 
  include_once "common/header.php";
  include_once "config/database.php";
  include_once "classes/Hobby.php";
?>

<?php
  $db = new Database();
  $conn = $db->connect();

  $hobby = new Hobby($conn);
  $hobby_id = isset($_GET['id']) ? $_GET['id'] : '';
  $hobby->id = $hobby_id;
  if($hobby->delete()){
    header('location:hobby.php?Hobbydelete=success');
  }
?>

<?php include_once "common/footer.php";?>