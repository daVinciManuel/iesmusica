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
if(isset($_GET['Ds_SignatureVersion'])){
  include_once 'fnRedsys.php';
  $pagoInfo = redsysHandle($_GET['Ds_SignatureVersion'],$_GET['Ds_MerchantParameters'],$_GET['Ds_Signature']);
  if(is_array($pagoInfo)){
    echo 'pago ok';
    echo '<br>';
    // guardar en DB
    include_once '../models/mdownloadInserts.php';
    include_once './fndownload.php';
    $invoiceId = getInvoiceId();
    $factura = insertInvoice($invoiceId, $_SESSION['userid'], date('Y-m-d'), calcPrice($tracks,$_SESSION['cart']));

    $invoiceTracks = array();
    foreach($_SESSION['cart']['track'] as $trackId){
      array_push($invoiceTracks, array("TrackId" => $trackId, "UnitPrice" => getPrice($trackId, $tracks), "Quantity" => $_SESSION['cart']['cantidad'][$trackId]));
    }

    $lineaFactura = insertInvoiceLine($invoiceId,$invoiceTracks);

    if($factura == true && $lineaFactura == true){
      echo 'Inserts a db ok';
    echo '<br>';
    }
  }else{
    echo 'ERROR: codigo de respuesta de Redsys ' . $pagoInfo;
  }
  cleanCart();
}

echo '<br><br>';
require '../views/vdownload.php';
