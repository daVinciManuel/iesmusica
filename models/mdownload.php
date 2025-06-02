<?php
function getAllTracks(){
  $conn = conexion();
  try{
    $stmt = $conn->prepare('SELECT TrackId,Name,Composer,UnitPrice FROM Track');
    $stmt->execute();
    $tracks = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }catch(PDOException $e){
    echo 'Error in query Tracks: ' . $e->getMessage();
    $tracks = null;
  }
  return $tracks;
}
