<?php
session_start();
if(is_null($_SESSION['userid'])){
  session_unset();
  session_destroy();
  setcookie('PHPSESSID','', time() -9999999999, '/');
  header('Location:../index.php');
}
