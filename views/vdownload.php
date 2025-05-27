<html>
   <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>SPOTIFY - IES Leonardo Da Vinci</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
  </head>

   
  <body>
    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Descargar Canciones - SPOTIFY Leonardo Da Vinci</div>
		<div class="card-body">
	
	    

	<!-- INICIO DEL FORMULARIO -->
<form action="" method="post">

<B>Nombre Cliente:</B> <?php echo $_SESSION['username']; ?> <BR>
<B>Id Cliente:</B> <?php echo $_SESSION['userid']; ?> <BR>
<B>Compañia:</B> <?php echo $_SESSION['usercomp']; ?> <BR><BR>
	
<label for="cancion"><B>Selecciona canción: </B></label>
<select name="cancion" class="form-control">

<?php
  if(isset($tracks)){
    foreach($tracks as $t){
      $optionList .= '<option value='.$t['TrackId'].'>'.$t['Name']. ' - ' .$t['Composer'].' : '.$t['UnitPrice'].'&euro;</option>';
    }
    if(isset($optionList)){
      echo $optionList;
    }
  }
?>
		</select><br><br>
			
		<div>
			<input type="submit" value="Agregar a Cesta" name="agregar" class="btn btn-warning disabled">
			<input type="submit" value="Descargar" name="descargar" class="btn btn-warning disabled">
			<input type="submit" value="Vaciar Cesta" name="vaciar" class="btn btn-warning disabled">
			<input type="submit" value="Volver" name="volver" class="btn btn-warning disabled">
			
		</div>	
				
	</form>
	<!-- FIN DEL FORMULARIO -->
	</div>	
  </div>



</body>
</html>
