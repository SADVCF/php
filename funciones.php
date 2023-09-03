<?php 

	include "consultas.php";

	// Función que pinta las opciones de las categorías en un select

	function pintaCategorias($defecto) {
		// Completar...	
		// Obtienemos la lista de usuarios de la base de datos
		$categorias=getCategorias();
		while ($fila=mysqli_fetch_assoc($categorias))
		{
			if($fila["category_id"]==$defecto)
			{
				echo "<option value=".$fila["id"].">".$fila["name"]."</option>";
			}
			else 
			{
				echo "<option value= ".$fila["id"].">".$fila["name"]."</option>";
			}
		}

	}
	
	// Función con la que pintamos la tabla de usuarios
	function pintaTablaUsuarios(){
		// Completar...	
		$lista_usuarios=getListaUsuarios();
		// Pintamos la estructura básica de la tabla

		echo "<table>\n
		<tr>\n
		<th>Nombre</th>\n
		<th>e-mail</th>\n
		<th>Autorizado</th>\n
		</tr>\n";
		// Iteramos sobre los usuarios y pintamos sus datos en la tabla
		while($fila=mysqli_fetch_assoc($lista_usuarios))
			{
				//En caso de tener permisos establecemos el nombre de usuario en negrita
			if($fila['enabled']==1)
			{
				echo "<tr>\n
			<td><b>".$fila['full_name']."<b></td>\n
			<td>".$fila['email']."</td>\n";
				echo "<td>".$fila['enabled']."</td>\n";
			}
				//En caso de no tener permisos el nombre de usuario no está en negrita
			else
			{echo "<tr>\n
				<td>".$fila['full_name']."</td>\n
				<td>".$fila['email']."</td>\n";
				echo "<td>".$fila['enabled']."</td>\n";
			}
		}
	}

		// Función con la que pintamos la tabla de productos
	function pintaProductos($orden) {
		// Completar...	
		// Obtienemos los productos de la base de datos ordenados por el campo especificado
		$productos = getProductos($orden);
            
            echo  "<table> \n
            <tr> <a href='formArticulos.php'>Añadir producto</a>\n
			<br>
            <th> <a href='articulos.php?orden=id'>ID</a></th> \n
            <th> <a href='articulos.php?orden=name'>Nombre</a></th>  \n
            <th> <a href='articulos.php?orden=cost'>Coste</a></th> \n 
            <th> <a href='articulos.php?orden=price'>Precio</a></th>  \n
            <th> <a href='articulos.php?orden=Categoria'>Categoria</a></th> \n
            <th> Acciones</th>
			</tr>  \n";
			// Iteramo sobre los productos y pintamos sus datos en la tabla
            while ($fila = mysqli_fetch_assoc($productos))
			{
                echo "<tr> \n
            <td> " . $fila['id'] . " </td> \n
            <td> " . $fila['name'] . " </td> \n
            <td> " . $fila['cost'] . " </td> \n
            <td> " . $fila['price'] . " </td> \n
            <td> " . $fila['Categoria'] ." </td> \n";    
			//Establecemos los botones editar y borrar al lado de cada producto cuando el usuario tiene permisos
    		if(getPermisos()==1) 
				{
        		echo 	"<td> <a class='boton' href='formArticulos.php?Editar=" . $fila['id'] . "'>Editar </a> "
                		. "- <a class='boton' href='formArticulos.php?Borrar=". $fila['id'] . "'>Borrar </a>
                		</td> \n ";
              
    			}
    		}//En caso de no tener permisos estos botones no se mostrarán
 			echo "</table>";
	}

?>