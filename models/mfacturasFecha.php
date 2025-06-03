<?php
function getFacturasEntre($user,$desde,$hasta){
  $conn = conexion();
  try{
    $sql = 'SELECT InvoiceId,InvoiceDate,Total FROM Invoice
    WHERE CustomerId = :customerid AND InvoiceDate >= :desde AND InvoiceDate <= :hasta';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':customerid',$user);
    $stmt->bindParam(':desde',$desde);
    $stmt->bindParam(':hasta',$hasta);
    $stmt->execute();
    $facturas = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }catch(PDOException $e){
    echo 'Error extracting invoice data: ' . $e->getMessage();
    $facturas = null;
  }
  $conn = null;
  return $facturas;
}
