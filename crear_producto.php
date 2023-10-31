<?php
include("validacion.php");
require("connect.php");



$validacion=valida_nombre($_POST["nombre"]) && valida_precio($_POST["precio"])  && valida_imagen($$imagen=$_FILES["imagen"]['name']);

if($validacion)
{
    $nombre=$_POST["nombre"];
$precio=$_POST["precio"];
$categoria=$_POST["categoria"];
$imagen=$_FILES['imagen']['name'];
    $insert="INSERT INTO productos(Nombre,Precio,Imagen,Categoría) VALUES ($nombre,$precio,$imagen;$categoria)";
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
            <form action="crear_producto.php" method="POST" enctype="multipart/form-data">
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
                    <input type="text" name="categoria" id="categoria">
                </label>
                <input type="submit" value="Insertar">
            </form>
        </fieldset>
    </div>
</body>
</html>