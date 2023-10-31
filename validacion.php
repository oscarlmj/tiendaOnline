<?php

function valida_nombre($nombre){
    $expresionValoresValidos = '/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]+$/u';
    if(preg_match($expresionValoresValidos, $nombre) && !empty($nombre) && ((strlen($nombre) > 1) && (strlen($nombre) < 50)) && ctype_upper($nombre[0]))
        return true;
    else
    return false;
}

function valida_precio($precio){
    if($numero.is_integer)
    return true;
    else
    return false;
}

function valida_imagen($imagen){
    $regex_formato = "#^.+\.(".implode('|', $formatos).")$#";

    if(preg_match($regex_formato, $_FILE["archivo"]["name"]))
    return true;
    else
    return false;
}


?>