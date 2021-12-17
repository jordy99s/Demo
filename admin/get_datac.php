<?php

    include_once("../config.php");  
    $sql = $pdo->prepare("SELECT nombre, apellido, correo, rol FROM Usuarios WHERE rol = 'Usuario'");
    $sql -> execute();
    $rows = array();
    while($row = $sql->fetch()){
        $rows[] = $row;
    }
    echo json_encode($rows);

?>