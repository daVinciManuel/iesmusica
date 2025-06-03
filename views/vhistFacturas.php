<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SPOTIFY - IES Leonardo Da Vinci - Alquiler Películas</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
  </head>
   

   
  <body>
   

    <div class="container ">
      <!--Aplicacion-->
    <div class="card border-success mb-3" style="max-width: 30rem;">
    <div class="card-header">Consultar Factura - SPOTIFY Leonardo Da Vinci</div>
    <div class="card-body">
      <B>Nombre Cliente:</B> <?php echo $_SESSION['username']; ?> <BR>
      <B>Id Cliente:</B> <?php echo $_SESSION['userid']; ?> <BR>
      <B>Compañia:</B> <?php echo $_SESSION['usercomp']; ?> <BR><BR>
      <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
      <B>Número Factura: </B><select name="facturas" class="form-control">

<?php
  if(isset($facturas)){
    $optionTags = '';
    foreach($facturas as $f){
      $optionTags .= "<option value='". $f['InvoiceId']."'>Factura ".$f['InvoiceId']."</option>";
    }
    if(isset($optionTags)){
      echo $optionTags;
    }
  }
?>

      </select>

		<BR>
		<BR>		
		<div>
      <input type="submit" value="Datos Factura" name="request" class="btn btn-warning disabled">
			<input type="submit" value="Volver" name="Volver" class="btn btn-warning disabled">
		</div>		
	</form>
	<!-- FIN DEL FORMULARIO -->

    <?php if(isset($factSelected)){ ?>
      <table border='1'>
        <thead>
          <tr>
            <th>Factura</th>
            <th>Fecha</th>
            <th>Monto</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo $factSelected['id'];?></td>
            <td><?php echo $factSelected['date'];?></td>
            <td><?php echo $factSelected['price'];?></td>
          </tr>
        </tbody>
      </table>
          <br>
      <table border='1'>
        <thead>
          <tr>
            <th>Pista</th>
            <th>Precio Unidad</th>
            <th>Cantidad</th>
          </tr>
        </thead>
        <tbody>
              <?php foreach($info as $f){ ?>
          <tr>
            <td><?php echo $f['Name'];?></td>
            <td><?php echo $f['UnitPrice'];?></td>
            <td><?php echo $f['Quantity'];?></td>
          </tr>
    <?php } ?>
        </tbody>
      </table>
    <?php } ?>
		  <BR><a href="./logout.php">Cerrar Sesión</a>
  </div>

</body>
</html>

