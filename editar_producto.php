<?php
//Incluye el archivo donde se realizan las validacion, e indica que requiere del archivo de conexion para poder ejecutarse.
include("validacion.php");
require("connect.php");
//Indica el destino de las imagenes subidas.
$destino="./img/";
opendir($destino);
$id=$_GET['id'];


//Recoge los datos del producto a modificar, y muestrael desplegable con las categorias.
try{
    //Consulta para las categorias.
    $consulta = $conn->prepare("SELECT * FROM `categorías`");
    $consulta->execute();
    $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

    //Consulta para mostrar los datos del producto.
    $consulta = $conn->prepare("SELECT * FROM `productos` WHERE id = $id");
    $consulta->execute();
    $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    $campos=$resultado[0];
} catch (PDOException $e){
    echo "Error al recuperar los datos: " . $e->getMessage();
    die();
}

//Comprueba que todos los campos del formulario esten rellenados.
    if(isset($_POST['nombre']) && isset($_POST['precio']) && !empty($_POST['categoria'])) {

        //Crea las variables con los valores de cada campo del form.
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $categoria = $_POST['categoria'];

        //Realiza las validaciones de los campos del form.
        $validacion=valida_nombre($nombre);

        //En caso de ser true la validacion, realiza las acciones indicadas.
        if($validacion)
        {
            try{
                if(isset($_FILES['imagen']['name']))
                {
                    //Almacena en variables el nombre y el nombre temporal de la imagen.
                    $imagen_nombre = $_FILES['imagen']['name'];
                    $nombre_temporal = $_FILES['imagen']['tmp_name'];
                    //Concatena el nombre de la imagen con la ruta para usarlo en el index.php para mostrar la imagen.
                    $ruta_imagen = $destino . $imagen_nombre;
                    //Mueve la imagen al directorio.
                    move_uploaded_file($nombre_temporal, $ruta_imagen);

                    //Almacena en la variable la sentencia SQL a ejecutar.
                    $sql = "UPDATE `productos` SET `Precio` = '$precio', `Categoría` = '$categoria', `Imagen` = '$ruta_imagen', `Nombre` = '$nombre' WHERE `productos`.`id` = '$id'";

                    //Ejecuta la sentencia.
                    $conn->exec($sql);
                    //Redirige al usuario al index.php para evitar que al actualizar la página inserte de nuevo los datos almacenados en la caché-
                    header('Location: ./index.php');                
                }
                else
                {
                    //Almacena en la variable la sentencia SQL a ejecutar.
                    $sql = "UPDATE `productos` SET  `Nombre` = '$nombre', `Precio` = '$precio', `Categoría` = '$categoria' WHERE `productos`.`id` = '$id'";

                    //Ejecuta la sentencia.
                    $conn->exec($sql);
                    //Redirige al usuario al index.php para evitar que al actualizar la página inserte de nuevo los datos almacenados en la caché-
                    header('Location: ./index.php');                
                }
            }
            catch(PDOException $e){
                //En caso de fallo muestra el error.
                echo $sql . "<br>" . $e -> getMessage();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BBDD Mi tienda Online</title>
    <link rel="stylesheet" href="./CSS/index.css">
</head>
<body>
    <header>
        <ol>
            <a href="./index.php"><li>Consultar listado</li></a>
            <a href="./crear_producto.php"><li>Crear producto</li></a>
            <li  id="fijado">Editar producto</li>
            <li>Eliminar producto</li>
        </ol>
    </header>
    <div id="opciones">
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
    </div>
</body>
</html>