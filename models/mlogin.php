<?php
//Función: getCustomerId
//Parámetros entrada: $conexion: id conexión; $usuario email introducido por pantalla; $clave clave introducido por pantalla
//Parámetros salida: devuelve el identificador de la conexión
function getCustomerId($usuario, $clave){
	$conn=conexion();
  try{
      $sql = $conn->prepare("SELECT customerid,firstname,lastname,company FROM Customer 
                WHERE email = '$usuario' AND customerid = '$clave'");
      $sql->execute();
      return $sql->fetchAll(PDO::FETCH_ASSOC);
  }catch(Exception $e){
      echo "<strong>ERROR: </strong>".$e->getMessage();
  }
  $conn = null;
}

