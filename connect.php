<?php
    $servername="localhost";
    $username="admin";
    $pass="V)BUF6G)AQr8D.Iz";
    $db="usuarios";

    try{
        $conn = new PDO("mysql:host=$servername;dbname=$db" ,$username,$pass);

        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //echo "Conexion realizada con éxito";
    }catch(PDOException $e)
    {
        //echo "Conexion fallida<br>".$e->getMessage();
    }
?>