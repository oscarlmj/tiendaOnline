<?php
//Incluye el archivo donde se realizan las validacion, e indica que requiere del archivo de conexion para poder ejecutarse.
include("validacion.php");
require("connect.php");

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
        $imagen = $_FILES['imagen']['name'];
        $categoria = $_POST['categoria'];
    

        //Realiza las validaciones de los campos del form.
        $validacion=valida_nombre($nombre);

        //En caso de ser true la validacion, realiza las acciones indicadas.
        if($validacion)
        {
            try{
                //Almacena en la variable la sentencia SQL a ejecutar.
                $sql = "INSERT INTO productos (Nombre, Precio, Imagen, Categoría) VALUES ('$nombre', '$precio', '$imagen', '$categoria')";
                //Realiza la sentencia.
                $conn->exec($sql);
                //En caso de inserción, redirige al usuario a la pagina principal donde vera el producto añadido.
                header( 'Location: ./index.php' ) ;
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
        <fieldset>
            <legend>Datos del prodcuto</legend>
            <form action="crear_producto.php" method="POST" enctype="multipart/form-data" name="form" autocomplete="off">
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
                    <select name="categoria" id="categoria">
                    <?php foreach ($resultados as $cat) {
                        echo "<option value={$cat['Id']}>{$cat['Nombre']}</option>";
                    }?>
                    </select>
                </label>
                <input type="submit" name="submit" value="Insertar">
            </form>
        </fieldset>
    </div>
</body>
</html>