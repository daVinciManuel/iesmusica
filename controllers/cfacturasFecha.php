<?php
require_once './checksesion.php';

require_once '../db/connect.php';
require_once '../models/mfacturasFecha.php';

if(isset($_POST) && isset($_POST['fecha_desde']) && isset($_POST['fecha_hasta'])){
  $desde = date_create($_POST['fecha_desde']);
  $hasta = date_create($_POST['fecha_hasta']);
  $fdesde = date_format($desde,'Y-m-d');
  $fhasta = date_format($hasta,'Y-m-d');

  echo 'fdesde: ';
  var_dump($fdesde);
  echo '<br>';
  echo 'fhasta: ';
  var_dump($fhasta);

  $facturas = getFacturasEntre($_SESSION['userid'],$fdesde,$fhasta);
}

if(isset($_POST['Volver'])){
  header('Location: ./cwelcome.php');
}

require_once '../views/vfacturasFecha.php';
