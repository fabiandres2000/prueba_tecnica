<?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $dbname = "prueba_tecnica_dev";
    // Conectar
    $db = new mysqli($server, $user, $password, $dbname);
    // Comprobar conexión
    if($db->connect_error){
        die("La conexión ha fallado, error número " . $db->connect_errno . ": " . $db->connect_error);
    }
?>