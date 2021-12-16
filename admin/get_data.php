<?php
 
$con = mysqli_connect("localhost", "root", "", "demo");
$result = mysqli_query($con, "SELECT nombre, apellido, correo, rol FROM Usuarios WHERE rol = 'Administrador' AND rol = 'Empleado'");
$rows = array();
while($row = mysqli_fetch_array($result)){
    $rows[] = $row;
}
echo json_encode($rows);

?>