<?php

    include_once("../config.php");
    $sql = $pdo->prepare("SELECT ProductoId, nombre, cantidad, precio, estado FROM Producto");
    $sql -> execute();
    $rows = array();
    while($row = $sql->fetch()){
        $rows[] = $row;
    }
    echo json_encode($rows);

    // include("../config.php");
    // $column = array("ProductoId", "nombre", "cantidad", "precio", "estado");
    // $query = "SELECT * FROM Producto";

    // if(isset($_POST["search"]["value"]))
    // {
    // $query .= '
    //     WHERE nombre LIKE "%'.$_POST["search"]["value"].'%" 
    //     OR cantidad LIKE "%'.$_POST["search"]["value"].'%" 
    //     OR precio LIKE "%'.$_POST["search"]["value"].'%" 
    //     OR estado LIKE "%'.$_POST["search"]["value"].'%" 
    //     ';
    // }

    // if(isset($_POST["order"]))
    // {
    //     $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
    // }
    // else
    // {
    //     $query .= 'ORDER BY ProductoId DESC ';
    // }
    //     $query1 = '';

    //     if($_POST["length"] != -1)
    //     {
    //     $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
    // }

    // $statement = $pdo -> prepare($query);
    // $statement -> execute();
    // $number_filter_row = $statement->rowCount();

    // $statement = $pdo->prepare($query . $query1);

    // $statement -> execute();
    // $result = $statement -> fetchAll();
    // $data = array();
    // foreach($result as $row){
    //     $sub_array = array();
    //     $sub_array[] = $row['ProductoId'];
    //     $sub_array[] = $row['nombre'];
    //     $sub_array[] = $row['cantidad'];
    //     $sub_array[] = $row['precio'];
    //     $sub_array[] = $row['estado'];
    //     $data[] = $sub_array;
    // }

    // function count_all_data($pdo)
    // {
    //     $query = "SELECT * FROM Producto";
    //     $statement = $pdo->prepare($query);
    //     $statement->execute();
    //     return $statement->rowCount();
    // }

    // $output = array(
    //     'draw'   => intval($_POST['draw']),
    //     'recordsTotal' => count_all_data($pdo),
    //     'recordsFiltered' => $number_filter_row,
    //     'data'   => $data
    // );
    // echo json_encode($output);

?>