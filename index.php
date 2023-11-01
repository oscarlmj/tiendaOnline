<?php
require("./connect.php");

try {
    $consulta = $conn->prepare("SELECT * FROM productos");
    $consulta->execute();
    $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error al recuperar los datos: " . $e->getMessage();
    die();
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
            <li id="fijado">Mostrar lista de productos</li>
            <li>Crear producto</li>
            <li>Consultar listado</li>
            <li>Modificar producto</li>
            <li>Eliminar producto</li>
        </ol>
    </header>
    <div id="contenido">
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Imagen</th>
            <th>Categoría</th>
            <!-- Agrega más encabezados de columnas según tu tabla -->
        </tr>
        <?php foreach ($resultados as $fila) { ?>
            <tr>
                <td><?php echo $fila['id']; ?></td>
                <td><?php echo $fila['Nombre']; ?></td>
                <td><?php echo $fila['Precio']; ?></td>
                <td><?php echo $fila['Imagen']; ?></td>
                <td><?php switch($fila['Categoría'])
                {
                    case 1:
                        echo 'Componentes';
                        break;
                    case 2:
                        echo 'Perifericos';
                        break;
                    case 3:
                        echo 'Videojuegos';
                        break;
                } ?></td>
            </tr>
        <?php } ?>
    </table>
    </div>
</body>
</html>