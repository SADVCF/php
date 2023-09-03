<?php 

	function crearConexion() 
	{
		// Cambiar en el caso en que se monte la base de datos en otro lugar
		$host = "localhost";
		$user = "root";
		$pass = "";
		$database = "contraseña";

		//Establecemos conexión con la base de datos
		$conexion=mysqli_connect($host,$user,$pass,$database);
		//Devolvemos la conexión establecida
		return $conexion;
	}

		//Cerramos la base de datos llamando a la funcion 
	function cerrarConexion($conexion) 
	{
		// Completar...
		//Cerramos la conexión
		mysqli_close($conexion);
	}


?>
