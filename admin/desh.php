<?php

session_start();

include "../config.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $sql = "UPDATE Producto SET Estado = 'Deshabilitado' WHERE nombre = :nombre";
    header("Location: inventario.php");
    unset($pdo);
}


?>