<?php 
    //Iniciamos la sesion
    session_start();

	require_once "config.php";
	
    //include("functions.php");


    $correo = $pass = "";
    $username_err = $password_err = $login_err = "";

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		
        //Verifico que haya ingresado un correo
        if(empty(trim($_POST["correo"]))){
            $username_err = "Por favor, ingrese su correo";
        }else{
            $correo = $_POST['correo'];
        }
        //Verifico que haya ingresado una contraseña
        if(empty(trim($_POST["pass"]))){
            $password_err = "Por favor, ingrese su contraseña";
        }else{
            $pass = $_POST['pass'];
        }

		if(empty($username_err) && empty($password_err))
		{
            //Preparamos el select
            $sql = "SELECT UserId, nombre, apellido, correo, rol, pass FROM usuarios WHERE correo = :correo";
			if($stmt = $pdo->prepare($sql)){
                $stmt->bindParam(":correo", $param_username, PDO::PARAM_STR);
                //Establecemos los parametros
                $param_username = trim($_POST["correo"]);
                //Ejecutamos el procedimiento
                if($stmt->execute()){
                    //Verificamos si el correo existe
                    //Si es asi, entonces verificamos el password
                    if($stmt->rowCount() == 1){
                        if($row = $stmt->fetch()){
                            $id = $row["UserId"];
                            $nombre = $row["nombre"];
                            $apellido = $row["apellido"]; 
                            $correo = $row["correo"];
                            $rol = $row["rol"];
                            $hashed_password = $row["pass"];
                            if(password_verify($pass, $hashed_password)){
                                //El password es correcto para iniciar una nueva sesion
                                session_start();

                                //Guardamos info en variables de sesion
                                $_SESSION["loggedin"] = true;
                                $_SESSION["UserId"] = $id;
                                $_SESSION["nombre"] = $nombre;
                                $_SESSION["apellido"] = "$apellido";
                                $_SESSION["correo"] = $correo;
                                $_SESSION["rol"] = $rol;

                                if($rol == 0){
                                    header("location:admin/admin-page.php");
                                }else if($rol == 1){
                                    header("location:index.php");
                                }
                            }else{
                                $login_err = "Contraseña Incorrecta";
                            }
                        }
                    }else{
                        $login_err = "Correo Incorrecto";
                    }
                }else{
                    echo "Opp! Something went wrong. Please try again later";
                }

                unset($stmt);
            }
		}
        //Cerramos la conexion
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
    <title>Login</title>
    <style>
        <?php include "main.css" ?>
    </style>
</head>
<body>
    <div class="container">
        <!--lOGIN-->
        <form class="form" id="login" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h1 class="form-title">Inicio de Sesión</h1>
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
            <button class="btn btn-primary" type="submit">Ingresar</button>
            <button class="btn btn-secondary" type="button" onclick="cancelFunction()">Cancelar</button>
            <p class="form-text ">
                <a href="./password-reset.php"  class="form-link">Olvidé mi Contraseña</a>
            </p>
            <p class="form-text">
                <a class="form-link" href="./signup.php" id="linkCreateAccount">¿No tienes una cuenta? Crear Cuenta</a>
            </p>
        </form>
    </div>
    <script src="main.js"></script>
</body>
</html>