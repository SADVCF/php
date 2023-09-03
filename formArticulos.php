<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Formulario de artículos</title>
</head>
<body>

	<?php 
		include "funciones.php";
    //Verificamos si el usuario está autorizado a través de una cookie.
		if (!isset($_COOKIE['datos_usuario']) or ($_COOKIE['datos_usuario']  != "autorizado"))
        {
      // Si no está autorizado, mostramos por mensaje: "No tienes permisos".
			echo "No tienes permisos";
			  }
        else
        { // Si el usuario está autorizado, comprobamos si se ha enviado el parámetro "Editar" por GET.
			    if(isset($_GET["Editar"]))
            { // Si se ha enviado, buscamos el producto correspondiente en la base de datos y lo guardamos en la variable $producto.

				$producto= mysqli_fetch_array(getProducto($_GET["Editar"]));
			      }        // Si no se ha enviado el parámetro "Editar" por GET, comprobamos si se ha enviado el parámetro "Borrar" por GET.

            else if (isset($_GET["Borrar"]))
            {        // Si se ha enviado, buscamos el producto correspondiente en la base de datos y lo guardamos en la variable $producto.

				$producto=mysqli_fetch_array(getProducto($_GET["Borrar"]));                
			      } 
                    // Si no se ha enviado ni "Editar" ni "Borrar" por GET, creamos nuevo producto vacío.
            else
            {
              $producto=["id"=>"","name"=>"","cost"=>0,"price"=>0];
              //Estos valores se asignarán por defecto cuando enviemos campos vacíos
            }
         }
  	?>
<!-- Mostramos un formulario con campos para introducir los datos del producto. -->
			  <form action ="formArticulos.php" action="GET">
              <p>ID: 
                    <!-- Creamos un campo oculto para guardar el ID del producto. -->
            <input type="hidden" name="id" value="<?php echo $producto['id'];?>">
                    <!-- Mostramos el ID del producto en un campo de texto deshabilitado para el usuario. -->

            <input type="text"  value="<?php echo $producto['id'];?> " disabled>
             </p>
              <p><label> Nombre: </label>        <!-- Creamos un campo para introducir el nombre del producto. -->

                <input type="text" name= "name" value = "<?php echo $producto['name']; ?>">
              </p>
              <p><label> Coste: </label>         <!-- Creamos un campo para introducir el coste del producto. -->

                <input type="number" name="cost" value="<?php echo $producto['cost']; ?>">
              </p>
              <p><label> Precio: </label>         <!-- Creamos un campo para introducir el precio del producto. -->

                  <input type="number" name="price" value="<?php echo $producto['price']; ?>">
              </p>
              <p><label> Categoría: </label>         <!-- Creamos un campo para seleccionar la categoría del producto. -->

                  <select name="category" value="">
                  <?php pintaCategorias($producto['id']);?> 
                  </select>
              </p>

						  <?php //Mostramos los diferentes botones en base a si existen sus respectivas variables
                  if (isset($_GET['Editar']))
                  {
                      echo "<input type='submit' name='click' value= 'Editar'>";

                  } 
                  else if(isset($_GET['Borrar']))
                  { 
                      echo "<input type ='submit' name='click' value='Borrar'>";
                  }
                  else 
                  {                     
                      echo "<input type='submit' name='click' value='Anadir'>";             
                          
                  }
                  ?> </form>

                <?php //En función del botón sobre el que se ha hecho click llamamos a su respectiva función
                  if (isset ($_GET["click"]))
                  {
                  
                      switch ($_GET["click"])
                      {
                          case 'Editar':
                              if(editarProducto($_GET["id"], $_GET["name"],$_GET["cost"], $_GET["price"],$_GET["category"]))
                                {
                                echo "Artículo modificado</p><br><a href='articulos.php'>Volver a lista de artículos<a>"; 
                               
                                }
                              else
                                {
                                  echo " No se ha modificado el producto";
                                }
                              break;

                            case 'Borrar':
                                if(borrarProducto($_GET["id"]))
                                {
                                    echo "Se ha borrado el producto.</p><br><a href='articulos.php'>Volver a lista de artículos<a>";
                                                                
                                }
                                else
                                {
                                    echo "No se ha borrado.</p><br><a href='articulos.php'>Volver a lista de artículos<a>";
                                }
                              break;

                            case 'Anadir':
                              if(anadirProducto($_GET["name"],$_GET["cost"],$_GET["price"],$_GET["category"]))
                                {
                                    echo " Se ha añadido el producto: ".$_GET['name']."</p><br> <a href='articulos.php'>Volver a lista de artículos<a> </p>";                               
                                }
                                  
                                else
                                {
                                     echo "No se ha añadido ningún producto.<br><a href='articulos.php'>Volver a lista de artículos<a>";
                                }   
                                 break;
                        }
					          }
                
					?>
	
</body>
</html>