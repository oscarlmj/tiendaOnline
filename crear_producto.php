<?php
//Incluye el archivo donde se realizan las validacion, e indica que requiere del archivo de conexion para poder ejecutarse.
include("validacion.php");
require("connect.php");
//Indica el destino de las imagenes subidas.
$destino="./img/";
opendir($destino);

try{
    $consulta = $conn->prepare("SELECT * FROM `categorías`");
    $consulta->execute();
    $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e){
    echo "Error al recuperar los datos: " . $e->getMessage();
    die();
}

//Comprueba que todos los campos del formulario esten rellenados.
    if(isset($_POST['nombre']) && isset($_POST['precio']) && isset($_FILES['imagen']['name']) && !empty($_POST['categoria'])) {

        //Crea las variables con los valores de cada campo del form.
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $imagen =$destino.$_FILES['imagen']['name'];
        $categoria = $_POST['categoria'];

        //Almacena en variables el nombre y el nombre temporal de la imagen.
        $imagen_nombre = $_FILES['imagen']['name'];
        $imagen_temporal = $_FILES['imagen']['tmp_name'];

        //Realiza las validaciones de los campos del form.
        $validacion=valida_nombre($nombre);

        //En caso de ser true la validacion, realiza las acciones indicadas.
        if($validacion)
        {
            try{

                $ruta_imagen = $destino . $imagen_nombre;
                //Almacena en la variable la sentencia SQL a ejecutar.
                $sql = "INSERT INTO productos (Nombre, Precio, Imagen, Categoría) VALUES ('$nombre', '$precio', '$imagen', '$categoria')";
                //Realiza la sentencia.
                $conn->exec($sql);

                //Mueve la imagen al directorio.
                move_uploaded_file($imagen_temporal, $destino . $imagen_nombre);                
                //En caso de inserción, redirige al usuario a la pagina principal donde vera el producto añadido.
                header('Location: ./index.php');
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
            <li id="fijado">Crear producto</li>
            <li>Modificar producto</li>
            <li>Eliminar producto</li>
        </ol>
    </header>
    <div id="opciones">
            <form action="crear_producto.php" method="POST" enctype="multipart/form-data" name="form" autocomplete="off">
            <fieldset>
            <legend>Datos del prodcuto</legend>
                <label for="">
                    Nombre
                    <input type="text" name="nombre" id="nombre">
                </label>
                <label for="">
                    Precio
                    <input type="text" name="precio" id="precio">
                </label>
                <label for="">
                    Imagen
                    <input type="file" name="imagen" id="imagen">
                </label>
                <label for="">
                    Categoría
                    <select name="categoria" id="categoria">
                    <?php foreach ($resultados as $cat) {
                        echo "<option value={$cat['Id']}>{$cat['Nombre']}</option>";
                    }?>
                    </select>
                </label>
                <input type="submit" name="submit" value="Insertar">
            </fieldset>
            </form>
    </div>
</body>
</html>