<?php
    session_start();

    include("config.php");
    include("functions.php");

    $correo = $pass = $confirm_password = "";
    $username_err = $passwrod_err = $confirm_password_err = "";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(empty(trim($_POST['correo']))){
            $username_err = "Por favor, ingrese su correo";
        }else{
            $correo = $_POST['correo'];
        }

        if(empty(trim($_POST["pass"]))){
            $password_err = "Por favor, ingrese su contraseña";
        }elseif(strlen(trim($_POST["pass"])) < 6){
            $password_err = "La contraseña debe contener más de 6 caracteres";
        }else{
            //$pass = $_POST['pass'];
        }
        
        //Verificamos la confirmacion de password
        if(empty(trim($_POST["confirm_password"]))){
            // Validamos que se ingresó una contraseña
            $confirm_password_err = "Por favor, confirmar contraseña";
        }else{
            if($_POST["pass"] != $_POST["confirm_password"]){
                $confirm_password_err = "Las contraseñas no coinciden";
            }else{
                $pass = $_POST["pass"];
            }
        }

        if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
            $sql = "UPDATE Usuarios SET pass = :pass WHERE correo = :correo";
            
            if($stmt = $pdo->prepare($sql)){
                $stmt->bindParam(":correo",$param_correo, PDO::PARAM_STR);
                $stmt->bindParam(":pass",$param_password, PDO::PARAM_STR);

                $param_correo = $correo;
                $param_password = password_hash($pass, PASSWORD_DEFAULT);

                if($stmt->execute()){
                    header("Location: login.php");
                }else{
                    $login_err = "Algo salió mal";
                }
                
            }
            //Close statement
            unset($stmt);
        }

        unset($pdo);
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
            <div class="form-group">
                <input type="password" name="pass" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" autofocus placeholder="Contraseña">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>" autofocus placeholder="Confirmar Contraseña">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <button class="btn btn-primary" type="submit">Restablecer Contraseña</button>
            <button class="btn btn-secondary ml-2" type="button" onclick="cancelFunction()">Cancelar</button>
        </form>
    </div>
    <script src="main.js"></script>
</body>
</html>