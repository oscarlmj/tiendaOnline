<?php
    $servername="localhost";
    $username="mitiendaonline";
    $db="mitiendaonline";

    try{
        $conn = new PDO("mysql:host=$servername;dbname=$db" ,$username);

        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        echo "Conexion realizada con éxito";
    }catch(PDOException $e)
    {
        echo "Conexion fallida<br>".$e->getMessage();
    }
?>