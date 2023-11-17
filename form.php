<?php
include("./connect.php");
try{
    if(isset($_POST['name']) && isset($_POST['correo']) && isset($_POST['psw']))
    {
        $name=$_POST['name'];
        $usuario=$_POST['correo'];

        session_start();
        $_SESSION['usuario']=$usuario;

        $sql = $conn->prepare("SELECT contrasena_hash FROM usuarios WHERE nombre ='$name'");
        $sql->execute();
        $consulta=$sql->fetch(PDO::FETCH_ASSOC);
        $pass=$consulta['contrasena_hash'];
    
        if(password_verify($_POST['psw'],$pass))
        {
            echo("Contraseña correcta");
            header('Location: ./listar_productos.php');
        }
        else throw new Exception('Contraseña incorrecta');
    }
}catch (Exception $e) {
    echo $e->getMessage();
    die();
}
?>