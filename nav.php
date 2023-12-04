<?php
session_start();

if(empty($_SESSION['usuario']))
{
    header('Location: ./form_login.php');
    exit();
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
            <a href="listar_productos.php" class="<?php echo ($url[2] == '/listar_productos.php') ? 'seleccionado' : ''; ?>"><li>Listado</li></a>
            <a href="crear_producto.php" class="<?php echo ($url[2] == '/crear_producto.php') ? 'seleccionado' : ''; ?>"><li>Crear producto</li></a>
            <a href="editar_producto.php" class="<?php echo ($url[2] == '/editar_producto.php') ? 'seleccionado' : ''; ?>"><li>Editar producto</li></a>
            <a href="eliminar_producto.php" class="<?php echo ($url[2] == '/eliminar_producto.php') ? 'seleccionado' : ''; ?>"><li>Eliminar producto</li></a>
        </ol>
        <a href="./close.php"><input type="image" src="./img/close.png" alt="close" id="close"></a>
    </header>
</body>
</html>