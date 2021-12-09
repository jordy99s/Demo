<?php
 
$con = mysqli_connect("localhost", "root", "", "demo");
$result = mysqli_query($con, "SELECT ProductoId, nombre, cantidad, precio FROM Producto");
$rows = array();
while($row = mysqli_fetch_array($result)){
    $rows[] = $row;
}
echo json_encode($rows);

?>