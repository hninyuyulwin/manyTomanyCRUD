<?php 
ini_set("display_errors", 1);
  include_once "common/header.php";
  include_once "config/database.php";
  include_once "classes/User.php";
  include_once "classes/Hobby.php";
?>

<?php
  $db = new Database();
  $conn = $db->connect();

  $user = new User($conn);
  $user_id = isset($_GET['id']) ? $_GET['id'] : '';
  $user->id = $user_id;
  if($user->delete()){
    header('location:index.php?Userdelete=success');
  }
?>

<?php include_once "common/footer.php";?>