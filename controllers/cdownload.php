<?php
require_once 'checksesion.php';

require_once '../db/connect.php';
require_once '../models/mdownload.php';
$tracks = getAllTracks();

if(isset($_POST['agregar'])){
  include_once './fndownload.php';
  $carrito = addToCart($_POST['cancion']);
  saveCart($carrito);
    echo 'cart["track"]: ';
  print_r($_SESSION['cart']['track']);
    echo '<br>';
    echo 'cart["cantidad"]: ';
  var_dump($_SESSION['cart']['cantidad']);
    echo '<br>';
}
if(isset($_POST['descargar'])){
  if(!isset($_SESSION['cart'])){
    echo '<br><b>ERROR: carrito vacio<b><br>';
  }else{
  include_once 'fnRedsys.php';
  include_once './fndownload.php';
    $price = calcPrice($tracks,$_SESSION['cart']);
    echo 'precio total: ';
    var_dump($price);
    echo '<br>';
    $redsysData = setRedsysValues($price);
    pagar($redsysData);
  }
}
if(isset($_POST['vaciar'])){
  include_once './fndownload.php';
  cleanCart();
}
if(isset($_POST['volver'])){
  header('Location: ./cwelcome.php');
}
if(isset($_GET)){
  $pagoOK = redsysHandle($_GET['Ds_SignatureVersion'],$_GET['Ds_MerchantParameters'],$_GET['Ds_Signature']);
  if($pagoOK){
    // guardar en DB
  }
}

echo '<br><br>';
require '../views/vdownload.php';
