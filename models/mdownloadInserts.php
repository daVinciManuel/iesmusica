<?php
function getInvoiceId(){
  $conn = conexion();
  try{
    $stmt = $conn->prepare('SELECT max(InvoiceId) FROM Invoice');
    $stmt->execute();
    $id = $stmt->fetchColumn();
    $id += 1;
  }catch(PDOException $e){
    echo 'Error in query Tracks: ' . $e->getMessage();
    $id = null;
  }
  return $id;
}
function getInvoiceLineId($id){
  $conn = conexion();
  try{
    $stmt = $conn->prepare('SELECT max(InvoiceLineId) FROM InvoiceLine WHERE InvoiceId = :id');
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    $id = $stmt->fetchColumn();
    if(is_null($id)){
      $id = 1;
    }else{
      $id += 1;
    }
  }catch(PDOException $e){
    echo 'Error in query Tracks: ' . $e->getMessage();
    $id = null;
  }
  return $id;
}
function insertInvoice($invoiceId,$customerId,$date,$price){
  $conn = conexion();
  $conn->beginTransaction();
  $done = false;
  try{
    $sql = 'INSERT INTO Invoice(InvoiceId,CustomerId,InvoiceDate,Total)
    VALUES(:InvoiceId,:CustomerId,:date,:price)';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':InvoiceId',$invoiceId);
    $stmt->bindParam(':CustomerId',$customerId);
    $stmt->bindParam(':date',$date);
    $stmt->bindParam(':price',$price);
    $stmt->execute();
    $conn->commit();
    $done = true;
  }catch(PDOException $e){
    $conn->rollback();
    echo "Error inserting invoice: ".$e->getMessage();
  }
  $conn = null;
  return $done;
}
function insertInvoiceLine($invoiceId,$tracks){
  if(is_array($tracks)){
      $conn = conexion();
    $invoiceLineId = getInvoiceLineId($invoiceId); 
    foreach($tracks as $t){
      $conn->beginTransaction();
      $done = false;
      try{
        $sql = 'INSERT INTO InvoiceLine(InvoiceLineId,InvoiceId,TrackId,UnitPrice,Quantity)
        VALUES(:InvoiceLineId,:InvoiceId,:TrackId,:UnitPrice,:Quantity)';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':InvoiceLineId',$invoiceLineId);
        $stmt->bindParam(':InvoiceId',$invoiceId);
        $stmt->bindParam(':TrackId',$t['TrackId']);
        $stmt->bindParam(':UnitPrice',$t['UnitPrice']);
        $stmt->bindParam(':Quantity',$t['Quantity']);
        $stmt->execute();
        $conn->commit();
        $done = true;
      }catch(PDOException $e){
        $conn->rollback();
        echo "Error inserting invoice: ".$e->getMessage();
      }
      $invoiceLineId +=1;
    }
  }
  $conn = null;
  return $done;
}
