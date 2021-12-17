<?php

    include_once("../config.php");
    $sql = $pdo->prepare("SELECT ProductoId, nombre, cantidad, precio, imagen FROM Producto");
    $sql -> execute();
    $rows = array();
    while($row = $sql->fetch()){
        $rows[] = $row;
    }
    echo json_encode($rows);

?>