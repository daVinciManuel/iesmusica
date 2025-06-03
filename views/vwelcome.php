<?php ?>
<html>
   
   <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SPOTIFY - IES Leonardo Da Vinci</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    </head>
   
    <body>
   

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Usuario SPOTIFY Leonardo Da Vinci</div>
		<div class="card-body">
<B>Nombre Cliente:</B> <?php echo $_SESSION['username']; ?> <BR>
	<B>Id Cliente:</B> <?php echo $_SESSION['userid']; ?> <BR>
<B>Compañia:</B> <?php echo $_SESSION['usercomp']; ?> <BR><BR>
			
		<!--Formulario con botones -->
		<input type="button" value="Descargar Canciones" onclick="window.location.href='./cdownload.php'" class="btn btn-warning disabled">
		
		<input type="button" value="Historial Facturas" onclick="window.location.href='./chistFacturas.php'" class="btn btn-warning disabled">
		
		<input type="button" value="Consultar Facturas Por Fecha" onclick="window.location.href='./cfacturasFecha.php'" class="btn btn-warning disabled"><BR>
		
		  <BR><a href="./logout.php">Cerrar Sesión</a>
	</div>  
	  
	  
     
   </body>
   
</html>
