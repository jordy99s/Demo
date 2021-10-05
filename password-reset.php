<?php
    session_start();

    include("config.php");
    include("functions.php");

    $correo = "";
    $username_err = "";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(empty(trim($_POST['correo']))){
            $username_err = "Por favor, ingrese su correo";
        }else{
            $correo = $_POST['correo'];
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <title>Olvidé mi Contraseña</title>
    <style>
        <?php include "main.css" ?>
    </style>
</head>
<body>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form" method="post">
            <h1 class="form-title">Olvidé mi contraseña</h1>
            <?php 
                if(!empty($login_err)){
                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                }        
            ?>
            <div class="form-group">
                <input type="text" name="correo" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $correo; ?>" autofocus placeholder="Correo Electrónico">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <button class="btn btn-primary" type="submit">Restablecer Contraseña</button>
            <button class="btn btn-secondary ml-2" type="button" onclick="cancelFunction()">Cancelar</button>
        </form>
    </div>
    <script src="main.js"></script>
</body>
</html>