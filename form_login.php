<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="./CSS/index.css">
</head>
<body>
    <div id="opciones">
        <form action="form.php" method="post">
            <fieldset>
                <legend>Inicio de sesion</legend>
                <label for="name">
                    Nombre
                    <input type="text" name="name">
                </label>
                <label for="correo">
                    Email
                    <input type="email" name="correo">
                </label>
                <label for="psw">
                    Contraseña
                    <input type="password" name="psw">
                </label>
                <input type="submit">
            </fieldset>
        </form>
    </div>
</body>
</html>