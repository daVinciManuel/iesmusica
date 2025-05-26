<?php
function createSession($user){
  session_start();
  var_dump($user);
  $_SESSION['userid'] = $user[0]['customerid'] ;
  $_SESSION['username'] = $user[0]['firstname'] . ' ' . $user[0]['lastname'];
  $_SESSION['usercomp'] = isset($user[0]['comp']) ? $user[0]['comp'] : '';
}
function guardarNumIntentos($attempts){
  setcookie('numAttempts',strval($attempts),time() + 5 * 60, '/');
}
function resetNumIntentos(){
  setcookie('numAttempts','',time() - 999999, '/');
}
