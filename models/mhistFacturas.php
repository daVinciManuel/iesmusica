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

function getInfoOfFactura($fact){
  $conn = conexion();
  try{
    $sql = 'SELECT Track.Name,InvoiceLine.UnitPrice,InvoiceLine.Quantity
    FROM InvoiceLine,Track
    WHERE InvoiceLine.InvoiceId = :InvoiceId
      AND InvoiceLine.TrackId = Track.TrackId';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':InvoiceId',$fact);
    $stmt->execute();
    $facturas = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }catch(PDOException $e){
    echo 'Error extracting invoice data: ' . $e->getMessage();
    $facturas = null;
  }
  $conn = null;
  return $facturas;
}
