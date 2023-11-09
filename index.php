<?php
require("./connect.php");

$directorio="./img/";
//Consulta para mostrar los datos de la base de datos en una tabla.
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
            <li id="fijado">Consultar listado</li>
            <a href="./crear_producto.php"><li>Crear producto</li></a>
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
        </tr>
        <!-- Recorre cada elemento de la BBDD para mostrar toda la informacion en la tabla -->
        <?php foreach ($resultados as $fila) {
            echo"<tr>";
                echo"<td>{$fila['id']}</td>";
                echo"<td>{$fila['Nombre']}</td>";
                echo"<td>{$fila['Precio']}</td>";
                echo"<td>{$fila['Imagen']}</td>";
                echo '<td><img src="' . $directorio . $fila['Imagen'] . '"></td>';
                //Dependiendo del ID de la categoría, muestra el nombre.
                switch($fila['Categoría'])
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
                }
                echo"</td>";
            echo"</tr>";
        }?>
    </table>
    </div>
</body>
</html>