<?php

function valida_nombre($nombre){
    $expresionValoresValidos = '/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]+$/u';
    if(preg_match($expresionValoresValidos, $nombre) && !empty($nombre) && (strlen($nombre) > 1) && ctype_upper($nombre[0]))
        return true;
    else
    return false;
}

function valida_precio($precio){
    if($precio>0)
    return true;
    else
    return false;
}

function valida_imagen($imagen){
    $formatos = array("jpg", "gif", "png");
    $regex_formato = "#^.+\.(".implode('|', $formatos).")$#";

    if(preg_match($regex_formato, $_FILES["imagen"]['name']))
    return true;
    else
    return false;
}


?>