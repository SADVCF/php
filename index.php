<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Index.php</title>
</head>
<body>

	<?php
	
		include "consultas.php";

	?>
	<!--Formulario de login: usuario y correo-->

	<form action="index.php" method="POST">
		<p><label for="usuario">Usuario: </label><input type="text" name="usuario"></p>
		<p><label for="correo">Correo: </label><input type="email" name="correo"></p>
		<p><input type="submit" name="entrar" value="Entrar"></p>
	</form>
	
	<?php
		//Si se ha pulsado el botón "Entrar"
		if (isset($_POST['entrar']))
		{
			//Obtenemos los datos ingresados por el usuario
			$nombre=$_POST['usuario'];
			$correo=$_POST['correo'];
			//Determinamos el tipo de usuario según los datos ingresados
			$tipoUsuario=tipoUsuario($nombre, $correo);

			//Creamos una cookie con los datos del usuario
			setcookie("datos_usuario", $tipoUsuario, time()+1986);

			//Mostramos un mensaje de bienvenida según el tipo de usuario
			switch ($tipoUsuario)
			{
				case 'superadmin':
					echo "Bienvenido $nombre, Pulsa <a href='usuarios.php'>AQUÍ</a> para entrar
					al panel de usuarios.";
					break;
				case 'autorizado':
					echo "Bienvenido $nombre, Pulsa <a href='articulos.php'>AQUÍ</a> para entrar
					al panel de artículos.";
					break;
				case 'registrado':
					echo "Bienvenido $nombre, Pulsa <a href='articulos.php'>AQUÍ</a> para entrar
					al panel de artículos.";
					break;
				default:
					echo "El usuario no está registrado en el sistema";
					break;
			}
		}
	?>
</body>
</html>