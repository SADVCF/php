<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Articulos</title>
</head>
<body>

	<?php 

		include "funciones.php";

	?>

	<h1>Lista de artículos</h1>

	<?php 
	//Verificamos si el usuario tiene permiso para acceder y le decimos que no tiene acceso en caso de no estar autorizado
	if(!isset($_COOKIE['datos_usuario']) || $_COOKIE['datos_usuario'] !== "autorizado") 
	{
		echo "No tienes permisos de acceso.";
	} else 
	{
		// Si tiene permisos de "autorizado" entonces habilitamos la función añadir producto
		if (getPermisos() === 1) 
		{
			if(isset($_GET['Anadir'])) 
			{
				if(anadirProducto($_GET["name"],$_GET["cost"],$_GET["price"],$_GET["category"])) 
				{
					echo "Se ha añadido ".$_GET['name'].".";
				} else 
				{
					echo "No se ha añadido ningún producto.";
				}   
			}
		}
		//Ordenamos lor productos en función del parámetro 'órden
		$orden = isset($_GET["orden"]) ? $_GET["orden"] : "id";
		pintaProductos($orden);
	}
?>
    <a href="index.php" >Volver al inicio</a>

</body>
</html>