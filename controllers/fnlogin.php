<?php
function createSession($user){
  session_start();
  var_dump($user);
  $_SESSION['userid'] = $user[0]['customerid'] ;
  $_SESSION['username'] = $user[0]['firstname'] . ' ' . $user[0]['lastname'];
  $_SESSION['usercompany'] = $user[0]['company'];
}
