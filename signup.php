<?php 

	require_once "config.php";
	//include("functions.php");

    $nombre = $apellido = $correo = $pass = $confirm_password = $rol = "";
    $nombre_err = $apellido_err = $username_err = $password_err = $login_err = $confirm_password_err = "";

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//Verifico los campos
        if(empty(trim($_POST["nombre"]))){
            $nombre_err = "Por favor, ingrese su nombre";
        }else{
            $nombre = $_POST["nombre"];
        }

        if(empty(trim($_POST["apellido"]))){
            $apellido_err = "Por favor, ingrese su apellido";
        }else{
            $apellido = $_POST["apellido"];
        }



         //Verifico que haya ingresado un correo
        if(empty(trim($_POST["correo"]))){
            $username_err = "Por favor, ingrese su correo";
        }else{
            // Preparamos un SELECT
            $sql = "SELECT UserId FROM usuarios WHERE correo = :correo";
            
            if($stmt = $pdo->prepare($sql)){
                // Amarramos las variables al prepared statement como parámetros
                $stmt->bindParam(":correo", $param_username, PDO::PARAM_STR);
                
                // Establecemos los parámetros
                $param_username = trim($_POST["correo"]);
                
                // Ejecutamos el prepared statement
                if($stmt->execute()){
                    
                    if($stmt->rowCount() == 1){
                        $username_err = "Este correo ya se encuentra registrado";
                    }else{
                        $correo = trim($_POST["correo"]);
                    }
                }else{
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Cerramos el statement
                unset($stmt);
            }
        }

        //Verifico que haya ingresado una contraseña
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


		if(empty($username_err) && empty($password_err) && empty($nombre_err) && empty($apellido_err) && empty($confirm_password_err))
		{

			//Guardar en la base
			$sql = "insert into usuarios (nombre, apellido, correo, rol, pass) values (:nombre, :apellido, :correo, 1, :pass)";

			if($stmt = $pdo->prepare($sql)){
                $stmt->bindParam(":nombre", $param_nombre, PDO::PARAM_STR);
                $stmt->bindParam(":apellido",$param_apellido, PDO::PARAM_STR);
                $stmt->bindParam(":correo",$param_username, PDO::PARAM_STR);
                // $stmt->bindParam('Usuario',$param_tipo, PDO::PARAM_STR);
                $stmt->bindParam(":pass",$param_password, PDO::PARAM_STR);

                //Establecemos los parametros
                $param_nombre = $nombre;
                $param_apellido = $apellido;
                $param_username = $correo;
                // $param_tipo = $tipo;
                $param_password = password_hash($pass, PASSWORD_DEFAULT);

                //Ejecutamos el procedimiento 

                if($stmt->execute()){
                    header("Location: login.php");
                }else{
                    $login_err = "Algo salió mal";
                }
                //Close statement
                unset($stmt);
            }

		}
        //Cierra la conexion
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
    <title>Registro</title>
    <style>
       <?php include "main.css" ?>
    </style>
</head>
<body>
    <div class="container">
        <form class="form" id="createAccount" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h1 class="form-title">Crear Cuenta</h1>
            <?php 
                if(!empty($login_err)){
                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                }        
            ?>
            <div class="form-group">
                <input type="text" class="form-control <?php echo (!empty($nombre_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nombre; ?>" name="nombre" autofocus placeholder="Nombre" pattern="[a-zA-Z]{1,}" title="El nombre no debe contener números" required>
                <span class="invalid-feedback"><?php echo $nombre_err; ?></span>
            </div>
            <div class="form-group">
                <input type="text" class="form-control <?php echo (!empty($apellido_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $apellido; ?>" name="apellido" autofocus placeholder="Apellido" pattern="[a-zA-Z]{1,}" title="El apellido no debe contener números" required>
                <span class="invalid-feedback"><?php echo $apellido_err; ?></span>
            </div>
            <div class="form-group">
                <input type="text" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $correo; ?>" name="correo" autofocus placeholder="Correo Electrónico">
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
            <button class="btn btn-primary" type="submit">Crear Cuenta</button>
            <button class="btn btn-secondary ml-2" type="button" onclick="cancelFunction()">Cancelar</button>
            <p class="form-text">
                <a class="form-link" href="login.php" id="linkLogin">¿Ya tienes una cuenta? Inicia Sesión</a>
            </p>
        </form>
    </div>
    <script src="main.js"></script>
</body>
</html>