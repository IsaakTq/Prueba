<?php

    $host = "bqv8psvn60deiv2py7sg-mysql.services.clever-cloud.com";
    $User = "ugmds8pu21kim5ip";
    $pass = "X0cT9sqQIwtGFTprb2tK";

    $db = "bqv8psvn60deiv2py7sg";

    $conexion = mysqli_connect($host, $User, $pass, $db);

    if (!$conexion){
        echo "Conexion fallida";
    }
?>