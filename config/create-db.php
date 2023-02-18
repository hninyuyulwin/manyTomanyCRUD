<?php
  define('DB_HOST','localhost');
  define('DB_USER','root');
  define('DB_PASS','secret');
  try {
      $conn = new PDO('mysql:host='.DB_HOST,DB_USER,DB_PASS,[
        PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION
      ]);
      $sql = "CREATE DATABASE IF  NOT EXISTS task2 CHARACTER SET utf8 COLLATE utf8_general_ci";
      $success = $conn->exec($sql);
      if ($success) {
        echo "Database Created Success";
      }
  } catch (PDOException $e) {
      echo "Failed to Create Database!!".$e->getMessage();
  }
  $conn = null;
?>