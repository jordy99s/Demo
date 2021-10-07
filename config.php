<?php
    /* Credenciales de la base de datos y el servidor */
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'demo');
    
    /*Intento de conexion con la base de datos */
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    // Verifico la conexion
    if($link === false){
        die("ERROR: No pudo conectarse. " . mysqli_connect_error());
    }
?>