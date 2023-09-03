<?php 

	include "conexion.php";
		// Función para determinar el tipo de usuario a partir del nombre y el correo electrónico
	function tipoUsuario($nombre, $correo)
	{

		//Creamos una conexión a la base de datos
		$BD= crearConexion();

		if(esSuperadmin($nombre,$correo))
		{	
			cerrarConexion($BD);
			return "superadmin";
		}
		else{
			// Si el usuario no es un superadmin, realizamos consulta en la base de datos para obtener los datos del usuario
			$sql="SELECT full_name, email, enabled FROM user WHERE full_name='$nombre' AND email='$correo'";
			$respuesta=mysqli_query($BD,$sql);
			//Cerramos la conexión
			cerrarConexion($BD);

			// Si la consulta devuelve resultados, comprobamos el valor de "enabled"
			if($datos=mysqli_fetch_array($respuesta)){
				if($datos["enabled"]==0)
				{
					// Si el valor de "enabled" es 0, se devuelve "registrado"
					return "registrado";
				}
				else if($datos["enabled"]==1)
				{
					// Si el valor de "enabled" es 1, se devuelve "autorizado"
					return "autorizado";
				}
				
			}
			else
			{
				// Si la consulta no devuelve resultados, se devuelve "no registrado"
				cerrarConexion($BD);
				return "no registrado";
			}
			cerrarConexion($BD);
		}
	}

		// Función para determinar si un usuario es superadmin a partir del nombre y el correo electrónico
	function esSuperadmin($nombre, $correo)
	{

		$BD=crearConexion();

		// Se realiza una consulta en la base de datos para obtener el id del superadmin correspondiente al usuario
		$sql="SELECT user.id FROM user INNER JOIN setup ON user.id=setup.superadmin_id WHERE user.full_name='$nombre'AND user.email='$correo'";
		$respuesta=mysqli_query($BD,$sql);

		// Si la consulta devuelve resultados, se cierra la conexión y se devuelve true
		if($datos=mysqli_fetch_array($respuesta))
		{
			cerrarConexion($BD);
			return true;
		}
		else
		{
			// Si la consulta no devuelve resultados, se cierra la conexión y se devuelve false
			cerrarConexion($BD);
			return false;
		}
	}

		// Función para obtener los permisos de la aplicación desde la tabla "setup"
	function getPermisos() 
	{

		$BD = crearConexion();

		// Se realiza una consulta en la base de datos para obtener los datos de la tabla "setup"
		$sql= "SELECT * FROM setup";
		$respuesta = mysqli_query($BD, $sql);

		// Se obtiene el valor de "management" y se cierra la conexión
		$resul= mysqli_fetch_assoc($respuesta);
		cerrarConexion($BD);

		return $resul["management"];
	}


	function cambiarPermisos() 
{
    // Obtenemos los permisos actuales
    $permisos= getPermisos();
    // Conectamos a la base de datos
    $BD= crearConexion();
    
    // Si los permisos son 1, actualizar la configuración para cambie a 0 y viceversa
    if (($permisos==1))
    {
        $sql = "UPDATE setup SET management = 0";
    }
    else if(($permisos ==0))
    {
        $sql = "UPDATE setup SET management =1";
    }
    
    // Ejecutar la consulta SQL y cerrar la conexión a la base de datos.
    $respuesta =mysqli_query($BD, $sql);
    cerrarConexion($BD);
    
    // Devolvemos el resultado de la consulta
    return $respuesta;
}


function getCategorias() 
{
    $BD= crearConexion();
    
    // Obtenemos todas las categorías de la tabla de categorías
    $sql= "SELECT id, name FROM category";
    $respuesta=mysqli_query($BD, $sql);
    
    // Cerramos la conexión a la base de datos y devolvemos el resultado de la consulta
    cerrarConexion($BD);
    return $respuesta;          	
}


function getListaUsuarios() 
{
    $BD=crearConexion();
    
    // Obtenemos la lista de usuarios de la tabla de usuarios
    $sql="SELECT full_name, email, enabled FROM user";
    $respuesta=mysqli_query($BD,$sql);
    
    cerrarConexion($BD);
    return $respuesta;
}


function getProducto($ID) 
{
    $BD= crearConexion();
    
    // Obtenemos los detalles del producto con el ID especificado de la tabla de productos
    $sql= "SELECT * FROM product WHERE id = $ID";
    $respuesta=mysqli_query($BD, $sql);
    
    cerrarConexion($BD);
    return $respuesta;
}


function getProductos($orden) 
{
    $BD= crearConexion();
    
    // Obtenemos los detalles de todos los productos y sus categorías de la tabla de productos y la tabla de categorías, ordenados por el parámetro de entrada
    $sql= "SELECT product.id, product.name, product.cost, product.price, category.name as Categoria FROM product INNER JOIN category
        WHERE product.category_id = category.id ORDER BY $orden";
    
    $respuesta=mysqli_query($BD, $sql);
    cerrarConexion($BD);
    
    return $respuesta;	
}

	// Función para agregar un nuevo producto a la base de datos
function anadirProducto($nombre, $coste, $precio, $categoria) 
{
	$BD= crearConexion();
	
	//Consulta SQL para insertar un nuevo registro en la tabla "product"
	$sql= "INSERT INTO product (name, cost, price, category_id)VALUES ('$nombre', '$coste', '$precio', '$categoria')";
	
	// Ejecutar la consulta SQL
	$respuesta=mysqli_query($BD, $sql);
	
	cerrarConexion($BD);
	
	return $respuesta;
}

// Función para eliminar un producto de la base de datos
function borrarProducto($id) 
{
	$BD= crearConexion();
	
	//Consulta SQL para eliminar un registro de la tabla "product" utilizando el ID especificado
	$sql= "DELETE FROM product WHERE id=$id";
	
	$respuesta=mysqli_query($BD, $sql);
	
	cerrarConexion($BD);
	
	return $respuesta;
}

// Función para actualizar un producto de la base de datos
function editarProducto($id, $nombre, $coste, $precio, $categoria) 
{
	$BD= crearConexion();
	
	// Consulta SQL para actualizar un registro de la tabla "product" utilizando el ID especificado
	$sql= "UPDATE product SET name ='$nombre' , cost ='$coste', price='$precio', category_id ='$categoria' WHERE id =$id";
	
	$respuesta=mysqli_query($BD, $sql);
	
	cerrarConexion($BD);
	
	return $respuesta;
}


?>