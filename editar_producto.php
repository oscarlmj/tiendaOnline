<?php
//Incluye los archivos para realizar las validaciones y conectarse a la bbdd.
include("validacion.php");
include("nav.php");
require("connect.php");

//Establece el directorio para almacenar las imagenes.
$destino = "./img/";
opendir($destino);


    if(!empty($_GET))
    {
        //Almacena el id en una variable.
        $id = $_GET['id'];
    
        try {
            //Consulta para las categorías.
            $consulta = $conn->prepare("SELECT * FROM `categorías`");
            $consulta->execute();
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
        
            //Consulta para mostrar los datos del producto.
            $consulta = $conn->prepare("SELECT * FROM `productos` WHERE id = $id");
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $campos = $resultado[0];
    
            
        } catch (PDOException $e) {
            echo "Error al recuperar los datos: " . $e->getMessage();
            die();
        }
        
        if (isset($_POST['nombre']) && isset($_POST['precio']) && !empty($_POST['categoria'])) {
            //Almacena los valores del form en sus respectivas variables.
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $categoria = $_POST['categoria'];
        
            //Realiza la validacion de los camppos.
            $validacion = valida_nombre($nombre);
        
            //En caso de validacion correcta, ejecuta el programa.
            if ($validacion) {
                try {
                    //Comprueba si se inserto una imagen en el formulario y actualiza la imagen del producto.
                    if (isset($_FILES['imagen']['name']) && !empty($_FILES['imagen']['name'])) {
                        $imagen_nombre = $_FILES['imagen']['name'];
                        $nombre_temporal = $_FILES['imagen']['tmp_name'];
                        $ruta_imagen = $destino . $imagen_nombre;
    
                        //Mueve la imagen al directorio.
                        move_uploaded_file($nombre_temporal, $ruta_imagen);
    
                        //Ejecuta la sentencia.
                        $sql = "UPDATE `productos` SET `Precio` = '$precio', `Categoría` = '$categoria', `Imagen` = '$ruta_imagen', `Nombre` = '$nombre' WHERE `productos`.`id` = '$id'";
                    } else {
                        // Si no se proporciona una nueva imagen, mantener la imagen actual en la base de datos
                        $sql = "UPDATE `productos` SET  `Nombre` = '$nombre', `Precio` = '$precio', `Categoría` = '$categoria' WHERE `productos`.`id` = '$id'";
                    }
    
                    $conn->exec($sql);
    
                    //Redirige al usuario al index.php, para evitar que al refrescar la pagina inserte de nuevo los datos en la BBDD, ya que se almacenan en la caché.
                    header('Location: ./listar_productos.php');
                }
                catch (PDOException $e) {
                    echo $sql . "<br>" . $e->getMessage();
                }
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar producto</title>
    <link rel="stylesheet" href="./CSS/index.css">
</head>
<body>
    <div id="opciones">
        <!-- Verificar si se proporciona un ID en la URL -->
        <?php if (empty($_GET['id'])): ?>
            <form action="editar_producto.php" method="GET">
                <fieldset>
                    <legend>Seleccionar Producto</legend>
                    <label for="producto_select">
                        Producto
                        <select name="id" id="producto_select">
                            <!--Ejecuta la sentancia para obtener el nombre de los productos-->
                            <?php $consulta = $conn->prepare("SELECT * FROM productos");
                                  $consulta->execute();
                                  $productos = $consulta->fetchAll(PDO::FETCH_ASSOC);?>
                            <!--Muestra el nombre de los productos en el desplegable-->
                            <?php foreach ($productos as $producto): ?>
                                <option value="<?php echo $producto['id']; ?>"><?php echo $producto['Nombre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <input type="submit" value="Seleccionar">
                </fieldset>
            </form>
        <?php else: ?>
            <!--Muestra el form con los datos del producto seleccionado en el index.php -->
            <form action="editar_producto.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data" name="form" autocomplete="off">            
        <fieldset>
            <legend>Datos para modificar</legend>
                <label for="">
                    Nombre
                    <input type="text" name="nombre" id="nombre" value=<?php echo $campos['Nombre']?>>
                </label>
                <label for="">
                    Precio
                    <input type="text" name="precio" id="precio" value=<?php echo $campos['Precio']?>>
                </label>
                <label for="">
                    Imagen
                    <input type="file" name="imagen" id="imagen">
                </label>
                <label for="">
                    Categoría
                    <select name="categoria" id="categoria">
                    <?php foreach ($resultados as $cat) {
                        if($cat['Id']==$campos['Categoría'])
                        echo "<option value={$cat['Id']} selected>{$cat['Nombre']}</option>";
                        else
                        echo "<option value={$cat['Id']}>{$cat['Nombre']}</option>";
                    }?>
                    </select>
                </label>
                <input type="submit" name="submit" value="Modificar">   
            </fieldset>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>