<?php
include("validacion.php");
require("connect.php");

// Revisa la conexión a la base de datos
    if(isset($_POST['nombre']) && isset($_POST['precio']) && isset($_FILES['imagen']['name']) && !empty($_POST['categoria'])) {

        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $imagen = $_FILES['imagen']['name'];
        $categoria = $_POST['categoria'];
    
        
        $validacion=valida_nombre($nombre);
        if($validacion)
        {
            try{
                $sql = "INSERT INTO productos (Nombre, Precio, Imagen, Categoría) VALUES ('$nombre', '$precio', '$imagen', '$categoria')";
                // usar exec() porque no devuelva resultados
                $conn->exec($sql);
                //En caso de inserción, redirige al usuario a la pagina principal donde vera el producto añadido.
                header( 'Location: ./index.php' ) ;
            }
            catch(PDOException $e){
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
            <a href="./index.php"><li>Mostrar lista de productos</li></a>
            <li id="fijado">Crear producto</li>
            <li>Consultar listado</li>
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
                        <option value="1">Componentes</option>
                        <option value="2">Perifericos</option>
                        <option value="3">Portatiles</option>
                    </select>
                </label>
                <input type="submit" name="submit" value="Insertar">
            </form>
        </fieldset>
    </div>
</body>
</html>