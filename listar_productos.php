<?php
include("./nav.php");
//Hace uso del archivo connect.php para realizar la conexion.
require("./connect.php");
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

    <div id="contenido">
        <!--Crea una tabla para mostrar los datos-->
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
                //Muestra la imagen del producto por pantalla.
                echo "<td><img src={$fila['Imagen']} width=45px></td>";
                echo"<td>";
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
                        echo 'Portatiles';
                        break;
                }
                echo"</td>";
                echo"<td><a href='./editar_producto.php?id={$fila['id']}'><img src='./img/edit.png' width=25px></td>";
            echo"</tr>";
        }?>
    </table>
    </div>
</body>
</html>