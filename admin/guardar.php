<?php
    include("../config.php");

    $productoId = $_POST["ProductoId"];
    $nombre = $_POST["nombre"];
    $cantidad = $_POST["cantidad"];
    $precio = $_POST["precio"];
    $estado = $_POST["estado"];
    $opcion = $_POST["opcion"];
    $informacion = [];


    function modificar($nombre, $cantidad, $precio, $estado, $productoId, $pdo){ 
            $query = "
                UPDATE Producto 
                SET nombre = :nombre, 
                precio = :precio, 
                cantidad = :cantidad, 
                estado = :estado 
                WHERE ProductoId = :ProductoId
            ";
            $statement = $pdo->prepare($query);
            $statement->execute();
            echo json_encode($_POST);
        }
        
        function eliminar($productoId, $pdo){
            $query = "
            UPDATE Producto SET Estado = 'Deshabilitado' 
            WHERE ProductoId = '".$_POST["ProductoId"]."'
            ";
            $statement = $pdo->prepare($query);
            $statement->execute();
            echo json_encode($_POST);
        }
        

?>