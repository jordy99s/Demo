<?php
    include("../config.php");
    if($_POST['action'] == 'edit')
    {
        $data = array(
            ':nombre'  => $_POST['nombre'],
            ':precio'  => $_POST['precio'],
            ':cantidad'   => $_POST['cantidad'],
            ':estado'   => $_POST['estado'],
            ':ProductoId'    => $_POST['ProductoId']
        );

        $query = "
            UPDATE Producto 
            SET nombre = :nombre, 
            precio = :precio, 
            cantidad = :cantidad, 
            estado = :estado 
            WHERE ProductoId = :ProductoId
            ";
            $statement = $pdo->prepare($query);
            $statement->execute($data);
            echo json_encode($_POST);
    }

    if($_POST['action'] == 'delete')
    {
        $query = "
            UPDATE Producto SET Estado = 'Deshabilitado' 
            WHERE ProductoId = '".$_POST["ProductoId"]."'
            ";
        $statement = $pdo->prepare($query);
        $statement->execute();
        echo json_encode($_POST);
    }


?>