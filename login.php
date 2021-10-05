<?php 

    session_start();

	include("config.php");
	include("functions.php");
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

		if(!empty($correo) && !empty($pass) && !is_numeric($correo))
		{

			//read from database
			$query = "select * from usuarios where correo = '$correo'";
			$result = mysqli_query($link, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['pass'] === $pass)
					{

						$_SESSION['UserId'] = $user_data['UserId'];
						header("Location: index.php");
						die;
					}else{
                        $login_err = "Correo/Contraseña Incorrectos";
                    }
				}else{
                    $login_err = "No encontrado";
                }
			}
		}else
		{
			$login_err = "No ha ingresado datos";
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
            <p class="form-text form-hidden">
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