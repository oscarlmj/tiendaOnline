<?php
include("validacion.php");

$nombre_formulario=$_POST["nombre_formulario"];

$validacion=valida_nombre($_POST["nombre"]) && valida_precio($_POST["precio"])  && valida_imagen($_FILES['name']);
?>
