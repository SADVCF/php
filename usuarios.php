<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Usuarios</title>
</head>
<body>

	<?php 

		include "funciones.php";

	//Verificamos si el valor de la cookie "datos_usuario" es diferente a "superadmin"
		if($_COOKIE['datos_usuario']!="superadmin")
		{
	//En caso de ser diferente no es superadmin, se lo indicamos por mensaje

			echo "No tiene permisos de acceso.";
		}
		else
		{//Si es superadmin, verificamos que el parámetro GET "Cambiar" esté establecido

			if(isset($_GET['Cambiar'])) 
				{// Si lo está, llamamos a la función "cambiarPermisos" del archivo "funciones.php"

					cambiarPermisos();
				}   
				// Llamamos a la función "pintaTablaUsuarios" del archivo "funciones.php"
					pintaTablaUsuarios();

			//Pintamos un formulario con un botón para cambiar los permisos y el valor de los permisos actuales obtenido de la función "getPermisos"
				echo("<form action ='usuarios.php' action='GET'>
				<p><input type ='submit' name='Cambiar' value='Cambiar permisos'> </p>  </form>
				<p>Los permisos actuales son: ") . getPermisos(); 
				echo "<br>";
		}
	?>
	<!-- Enlace para volver a la página inicial -->

	 <a href ='index.php'> Volver a inicio </a>

</body>
</html>