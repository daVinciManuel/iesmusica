<?php
  session_start();
  session_unset();
  session_destroy();
  setcookie('PHPSESSID','', time() -9999999999, '/');
  header('Location:../index.php');
