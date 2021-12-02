<?php
    session_start();
    include("functions.php");
    include("config.php");

    $pass = $confirm_pass = "";
    $pass_err = $confirm_pass_err = $login_err = "";
    $id = $_SESSION["UserId"];

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(empty(trim($_POST["pass"]))){
            $pass_err = "Por favor, ingrese su contraseña";
        }elseif(strlen(trim($_POST["pass"])) < 6){
            $pass_err = "La contraseña debe contener más de 6 caracteres";
        }else{
            //$pass = $_POST['pass'];
        }
        //Verificamos la confirmacion de password
        if(empty(trim($_POST["confirm_pass"]))){
            // Validamos que se ingresó una contraseña
            $confirm_pass_err = "Por favor, confirmar contraseña";
        }else{
            if($_POST["pass"] != $_POST["confirm_pass"]){
                $confirm_pass_err = "Las contraseñas no coinciden";
            }else{
                $pass = $_POST["pass"];
            }
        }

        if(empty($pass_err) && empty($confirm_pass_err)){
            $sql = "UPDATE Usuarios SET pass = :pass WHERE UserId = :id";
            
            if($stmt = $pdo->prepare($sql)){
                $stmt->bindParam(":id",$param_id, PDO::PARAM_STR);
                $stmt->bindParam(":pass",$param_password, PDO::PARAM_STR);

                $param_id = $id;
                $param_password = password_hash($pass, PASSWORD_DEFAULT);

                if($stmt->execute()){
                    header("Location: profile.php");
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <style>
        <?php
            include 'styles.css';
        ?>
    </style>
</head>
<body>
    <!-- HEADER -->
    <?php
        include 'lognavbar.php';
    ?>
    <!-- BODY -->
    <div class="user-profile">
        <div class="side-container" id="mySideNav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="#" class="side-links active">Información de la Cuenta</a>
            <a href="#" class="side-links">Historial de Pedidos</a>
            <a href="#" class="side-links">Libro de Direcciones</a>
            <a href="#" class="side-links">Opciones de Pagos</a>
            <a href="#" class="side-links">Puntos</a>
        </div>
        <div class="profile-container">
            <span style="font-size: 16px; cursor:pointer" onclick="openNav()" >&#9776;</span>
            <h1>Información de la Cuenta</h1>
            <form class="info-cuenta" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="info">
                    <div class="data-group">
                        <label for="nombre">Nombre: </label>
                        <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($_SESSION["nombre"])?>" disabled>
                    </div>
                    <div class="data-group">
                        <label for="apellido">Apellido: </label>
                        <input type="text" name="apellido" id="apellido" value="<?php echo htmlspecialchars($_SESSION["apellido"])?>" disabled>
                    </div>
                    <div class="data-group">
                        <label for="mail">Correo: </label>
                        <input type="text" name="correo" id="correo" value="<?php echo htmlspecialchars($_SESSION["correo"])?>" disabled>
                    </div>
                </div>
                <div class="data-group">
                    <input type="checkbox" name="op" id="checkbox">
                    <label for="change">Cambiar contraseña</label>
                </div>
                <?php 
                    if(!empty($login_err)){
                        echo '<div class="alert alert-danger">' . $login_err . '</div>';
                    }        
                ?>
                <div class="contra">
                    <!-- <div class="data-group">
                        <label for="contra">Contraseña Actual: </label>
                        <input type="password" name="pass" id="pass" disabled>
                    </div> -->
                    <div class="data-group">
                        <label for="novacontra">Nueva Contraseña: </label>
                        <input type="password" name="pass" id="pass" class="<?php echo (!empty($pass_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $pass; ?>" disabled>
                        <span class="invalid-feedback"><?php echo $pass_err ?></span>
                    </div>
                    <div class="data-group">
                        <label for="confirmar">Confirmar Contraseña: </label>
                        <input type="password" name="confirm_pass" id="confirm_pass" class="<?php echo (!empty($confirm_pass_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_pass; ?>" disabled>
                        <span class="invalid-feedback"><?php echo $confirm_pass_err ?></span>
                    </div>
                </div>
                <div class="data-button">
                    <button type="submit">Guardar</button>
                    <a href="#" class="btn-cancelar" hidden>Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    <!-- Footer -->
    <?php
        include 'footer.php';
    ?>
<script src="app.js"></script>
<script>
    function openNav(){
        document.getElementById("mySideNav").style.width = "400px";
    }

    function closeNav(){
        document.getElementById("mySideNav").style.width = "0";
    }

    //CHECKBOX
    document.getElementById('checkbox').onchange = function(){
        // document.getElementById('pass').disabled = !this.checked;
        document.getElementById('pass').disabled = !this.checked;
        document.getElementById('confirm_pass').disabled = !this.checked;
    };
</script>
</body>
</html>