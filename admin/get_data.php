<?php

    include_once("../config.php");
    $sql = $pdo->prepare("SELECT nombre, apellido, correo, rol FROM Usuarios WHERE rol = 'Administrador' OR rol = 'Empleado'");
    $sql -> execute();
    $rows = array();
    while($row = $sql->fetch()){
        $rows[] = $row;
    }
    echo json_encode($rows);

?>