<?php
require("C:/xampp/htdocs/tiendaOnline/connect.php");
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
            <li>Mostrar lista de productos</li>
            <li id="fijado">Crear producto</li>
            <li>Consultar listado</li>
            <li>Modificar producto</li>
            <li>Eliminar producto</li>
        </ol>
    </header>
    <div id="opciones">
        <fieldset>
            <legend>Datos del prodcuto</legend>
            <form action="crear_producto.php">
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
                    Categoria
                    <input type="text" name="categoria" id="categoria">
                </label>
            </form>
        </fieldset>
    </div>
</body>
</html>