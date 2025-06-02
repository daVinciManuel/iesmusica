<?php
function getFacturasOf($user){
  $conn = conexion();
  try{
    $stmt = $conn->prepare('SELECT InvoiceId,InvoiceDate,Total FROM Invoice WHERE CustomerId = :customerid');
    $stmt->bindParam(':customerid',$user);
    $stmt->execute();
    $facturas = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }catch(PDOException $e){
    echo 'Error extracting invoice data: ' . $e->getMessage();
    $facturas = null;
  }
  $conn = null;
  return $facturas;
}
