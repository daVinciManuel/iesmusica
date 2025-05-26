<?php
require_once 'checksesion.php';

require_once '../db/connect.php';
require_once '../models/mdownload.php';
$tracks = getAllTracks();

if(isset($_POST['agregar'])){
  addToCart($_POST['cancion']);
}
if(isset($_POST['descargar'])){

}
if(isset($_POST['vaciar'])){

}
if(isset($_POST['volver'])){
  header('Location: ./cwelcome.php');
}

require '../views/vdownload.php';
