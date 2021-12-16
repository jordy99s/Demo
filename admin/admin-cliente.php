<?php 
   session_start();
 
   // Check if the user is logged in, if not then redirect him to login page
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: ../index.php");
       exit;
   }

   require_once "../config.php";

   $nombre = $apellido = $correo = $password = "";
   $nombre_err = $apellido_err = $correo_err = $password_err = $admin_clientes_err = "";

   if($_SERVER['REQUEST_METHOD'] == "POST"){
    //    Verifico los campos
        if(empty(trim($_POST["nombre"]))){
            $nombre_err = "Por favor, ingrese un nombre";
        }else{
            $nombre = $_POST["nombre"];
        }

        if(empty(trim($_POST["apellido"]))){
            $apellido_err = "Por favor, ingrese el apellido";
        }else{
            $apellido = $_POST["apellido"];
        }

        //Verifico que haya ingresado un correo
        if(empty(trim($_POST["correo"]))){
            $correo_err = "Por favor, ingrese su correo";
        }else{
        // Preparamos un SELECT
            $sql = "SELECT UserId FROM Usuarios WHERE correo = :correo";
        
            if($stmt = $pdo->prepare($sql)){
                // Amarramos las variables al prepared statement como parámetros
                $stmt->bindParam(":correo", $param_correo, PDO::PARAM_STR);
            
                // Establecemos los parámetros
                $param_correo = trim($_POST["correo"]);
            
                // Ejecutamos el prepared statement
                if($stmt->execute()){
                
                    if($stmt->rowCount() == 1){
                        $correo_err = "Este correo ya se encuentra registrado";
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
        if(empty(trim($_POST["password"]))){
            $password_err = "Por favor, ingrese su contraseña";
        }elseif(strlen(trim($_POST["password"])) < 6){
            $password_err = "La contraseña debe contener más de 6 caracteres";
        }else{
            $pass = $_POST['password'];
        }
    
    
        if(empty($correo_err) && empty($password_err) && empty($nombre_err) && empty($apellido_err))
        {
            //Guardar en la base
            $sql = "INSERT INTO Usuarios (nombre, apellido, correo, rol, pass) VALUES (:nombre, :apellido, :correo, Cliente, :pass)";
    
            if($stmt = $pdo->prepare($sql)){
                $stmt->bindParam(":nombre", $param_nombre, PDO::PARAM_STR);
                $stmt->bindParam(":apellido",$param_apellido, PDO::PARAM_STR);
                $stmt->bindParam(":correo",$param_correo, PDO::PARAM_STR);
                $stmt->bindParam(":pass",$param_password, PDO::PARAM_STR);
    
                //Establecemos los parametros
                $param_nombre = $nombre;
                $param_apellido = $apellido;
                $param_correo = $correo;
                $param_password = password_hash($pass, PASSWORD_DEFAULT);
    
                //Ejecutamos el procedimiento 
    
                if($stmt->execute()){
                    header("Location: admin-cliente.php");
                }else{
                $admin_clientes_err = "Algo salió mal";
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="jordy4vz" content="">

    <title>Empleados Dashboard</title>

        <!-- Custom fonts for this template -->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body id="page-top">
    <div id="wrapper">

        <!-- SIDE NAVBAR -->
        <?php
            include 'admin-navbar.php';
        ?>
        <!-- end -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- MAIN CONTENT -->
            <div id="content">
                <!-- TOP NAVBAR -->
                <?php
                    include 'navbar-top.php'
                ?>
                 <!-- MAIN CONTAINER -->
                 <div class="container">
                     <!-- Page Heading -->
                     <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Clientes</h1>
                    </div>
                    <?php 
                    if(!empty($admin_clientes_err)){
                        echo '<div class="alert alert-danger">' . $admin_clientes_err . '</div>';
                    }        
                    ?>
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-9 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Registro de Clientes</h6>
                                </div>
                                <div class="card-body">
                                    <form class="form" id="registroclientes" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                        <?php 
                                            if(!empty($admin_clientes_err)){
                                                echo '<div class="alert alert-danger">' . $admin_clientes_err . '</div>';
                                            }        
                                        ?>    
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" name="nombre" id="nombre" placeholder="Nombre" class="form-control <?php echo (!empty($nombre_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nombre; ?>">
                                                <span class="invalid-feedback"><?php echo $nombre_err; ?></span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="nombre">Apellido</label>
                                                <input type="text" name="apellido" id="apellido" placeholder="Apellido" class="form-control <?php echo (!empty($apellido_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $apellido; ?>">
                                                <span class="invalid-feedback"><?php echo $apellido_err; ?></span>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="nombre">Correo electrónico</label>
                                                <input type="text" name="correo" id="correo" placeholder="Correo electrónico" class="form-control <?php echo (!empty($correo_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $correo; ?>">
                                                <span class="invalid-feedback"><?php echo $correo_err; ?></span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="nombre">Contraseña</label>
                                                <input type="password" name="password" id="password" placeholder="Contraseña" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                                                <span class="invalid-feedback"><?php echo $password_err; ?></span>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group-col md-6">
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                                <button type="reset" class="btn btn-secondary">Cancelar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <!-- Termina cambio -->
                
                <div class="container-fluid">
                    <!-- Content Row -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Información de Clientes</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Correo</th>
                                            <th>Rol</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Correo</th>
                                            <th>Rol</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
            </div>
        </div>

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cerrar Sesión</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecciona "Salir" si estás listo para terminar tu sesión.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="adminlogout.php">Salir</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable( {
                "ajax" : {
                    "url" : "get_datac.php",
                    "dataSrc" : ""
                },
                "columns" : [
                    {"data" : "nombre"},
                    {"data" : "apellido"},
                    {"data" : "correo"},
                    {"data" : "rol"}
                ]
            } );
        } );
    </script>

</body>
</html>