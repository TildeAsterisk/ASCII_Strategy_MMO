<?php
session_start();
include_once("header.php");

if (isset($_POST['login'])){
  if(isset($_SESSION['uid'])){
    echo "You are already logged in.";
  }
  else{
    $username = protect($mysql,$_POST["username"]);
    $password = protect($mysql,$_POST["password"]);

    $login_check=mysqli_query($mysql,"SELECT `id` FROM `user` WHERE `username`='$username' AND `password`='".md5($password)."'") or die(mysqli_error($mysql));
    if(mysqli_num_rows($login_check) == 0){
      echo "Invalid username/Password combination.";
    }
    else{
      $get_id=mysqli_fetch_assoc($login_check);
      $_SESSION['uid'] = $get_id['id'];

      // Start output buffering
      ob_start();

      header("Location: main.php");
      
      // End output buffering
      ob_end_flush();
    }
  }
}
else{
  echo "You have visited this page incorrectly!";
}


?>