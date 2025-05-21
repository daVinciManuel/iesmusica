<?php
if(isset($_POST['submit'])){//Si no se ha pulsado el boton de login cierra sesión
  if(isset($_POST['usuario']) && isset($_POST['clave'])) {//Si se han rellenado los campos del login
    include_once './db/connect.php';
    include_once './models/mlogin.php';
    $respuesta = getCustomerId($_POST['usuario'], $_POST['clave']);
    if(!is_null($respuesta) && is_array($respuesta) && sizeof($respuesta) == 1) {
      include_once './controllers/fnlogin.php';
      createSession($respuesta);
      echo '<br>';
      header("location:controllers/cwelcome.php");
    } else{
      echo "No existe ningun email con esa contrase&ntilde;a.";
    }
  } else {
    // warning user empty:
      if(!isset($_POST['usuario'])) {
        echo "No se ha proporcionado un usuario!";
      }
    // warning password empty:
      if(!isset($_POST['clave'])) {
        echo "No se ha proporcionado una contrase&ntilde;a!";
      }
    }
}





require_once './views/vlogin.php';
