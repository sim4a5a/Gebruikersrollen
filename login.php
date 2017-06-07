<?php
include 'DatabaseHandler.php';


if(!ISSET($_SESSION['ingelogged'])){
  $_SESSION['ingelogged'] = false;
}
if(!ISSET($_SESSION['role'])){
  $_SESSION['role'] = 'Gast';
}
if(ISSET($_POST['unset'])){
session_unset();
  $_SESSION['ingelogged'] = false;
  $_SESSION['role'] = 'Gast';
}
if(ISSET($_POST['submit']))
  {
    $sql = "SELECT * FROM users";
    $hond = new DatabaseHandler('localhost', 'login', 'root', 'Lente_2017');
    $res = $hond->readData($sql);
    foreach($res as $row){
      if($_SESSION['ingelogged'] == false && $row['username'] == $_POST['username'] && $row['password'] == $_POST['password']){
        $_SESSION['ingelogged'] = true;
        $_SESSION['username'] = $row['username'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['role'] = $row['role'];
      }
    }
  }
  if($_SESSION['ingelogged'] == false){
    echo "<form action='' method='POST' id='login'>
    <input type='text' name='username'>
    <input type='password' name='password'>
    <input type='submit' name='submit' value='login' /></form>";

  }
  else{
    echo '<form action="" method="POST" id="login">
    <input type="submit" name="unset" value="Log out" /></form>';

  }
?>
