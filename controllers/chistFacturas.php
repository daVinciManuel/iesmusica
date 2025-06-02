<?php
require_once './checksesion.php';

require_once '../db/connect.php';
require_once '../models/mhistFacturas.php';
$facturas = getFacturasOf($_SESSION['userid']);

if(isset($_POST['request'])){

  if(isset($_POST['facturas'])){
    foreach($facturas as $f){
      if($f['InvoiceId'] == $_POST['facturas']){
        $factSelected = array("id" => $f['InvoiceId'], "date" => $f['InvoiceDate'], "price" => $f['Total']);
        break;
      }
    }
  }

}

if(isset($_POST['Volver'])){
  header('Location: ./cwelcome.php');
}
require_once '../views/vhistFacturas.php';
