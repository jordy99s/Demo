<?php

    include_once("../config.php");
    $sql = $pdo->prepare("SELECT * FROM Producto");
    $sql -> execute();
    $rows = array();
    while($row = $sql->fetch()){
        $rows[] = $row;
    }
    echo json_encode($rows);

?>