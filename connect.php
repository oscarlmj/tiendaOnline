<?php
    $servername="localhost";
    $username="mitiendaonline";
    $pass="v5EKL4TuljXCe*)[";
    $db="mitiendaonline";

    try{
        $conn = new PDO("mysql:host=$servername;dbname=$db" ,$username,$pass);

        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //echo "Conexion realizada con éxito";
    }catch(PDOException $e)
    {
        //echo "Conexion fallida<br>".$e->getMessage();
    }
?>