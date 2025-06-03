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
	
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
            Facturas entre las fechas:
            <br>
            DESDE <input type="date" name="fecha_desde">
            <br>
            HASTA <input type="date" name="fecha_hasta">
		
		<BR>
		<BR>		
		<div>
		    <input type="submit" value="Datos Factura" name="enviar" class="btn btn-warning disabled">
			<input type="submit" value="Volver" name="Volver" class="btn btn-warning disabled">
		</div>		
	</form>
	<!-- FIN DEL FORMULARIO -->
    <?php if(isset($facturas)){ ?>
      <table border='1'>
        <thead>
          <tr>
            <th>Factura</th>
            <th>Fecha</th>
            <th>Monto</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($facturas as $f){ ?>
          <tr>
            <td><?php echo $f['InvoiceId'];?></td>
            <td><?php echo $f['InvoiceDate'];?></td>
            <td><?php echo $f['Total'];?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php } ?>
  </div>



</body>
</html>

