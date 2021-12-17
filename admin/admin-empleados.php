<?php 
   session_start();
 
   // Check if the user is logged in, if not then redirect him to login page
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: ../index.php");
       exit;
   }
   require_once "../config.php";

   $nombre = $apellido = $correo = $password = $rol = "";
   $nombre_err = $apellido_err = $correo_err = $password_err = $rol_err = $admin_empleados_err = "";

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

        if(empty(trim($_POST["rol"]))){
            $rol_err = "Por favor, seleccione un rol";
        }else if($_POST["rol"] == 'Seleccionar'){
            $rol_err = "Por favor, seleccione un rol";
        }else{
            $rol = $_POST["rol"];
        }

        //Verifico que haya ingresado un correo
        if(empty(trim($_POST["correo"]))){
            $correo_err = "Por favor, ingrese su correo";
        }else{
            // Preparamos un SELECT
            $correo = trim($_POST["correo"]);
        }
    
        //Verifico que haya ingresado una contraseña
        if(empty(trim($_POST["password"]))){
            $password_err = "Por favor, ingrese su contraseña";
        }elseif(strlen(trim($_POST["password"])) < 6){
            $password_err = "La contraseña debe contener más de 6 caracteres";
        }else{
            $pass = $_POST['password'];
        }
        
    
        if(empty($correo_err) && empty($nombre_err) && empty($apellido_err) && empty($rol_err))
        {
            $sql = "SELECT UserId FROM Usuarios WHERE correo = :correo";
            if($stmt = $pdo->prepare($sql)){
                if($stmt -> rowCount() == 1){
                    $sql = "UPDATE Usuarios SET nombre = :nombre, apellido = :apellido, rol = :rol WHERE correo=:correo";
            
                    if($stmt = $pdo->prepare($sql)){
                        $stmt->bindParam(":nombre", $param_nombre, PDO::PARAM_STR);
                        $stmt->bindParam(":apellido",$param_apellido, PDO::PARAM_STR);
                        $stmt->bindParam(":correo",$param_correo, PDO::PARAM_STR);
                        $stmt->bindParam(":rol",$param_rol, PDO::PARAM_STR);
                        $stmt->bindParam(":pass",$param_password, PDO::PARAM_STR);
            
                        //Establecemos los parametros
                        $param_nombre = $nombre;
                        $param_apellido = $apellido;
                        $param_correo = $correo;
                        $param_rol = $rol;
            
                        //Ejecutamos el procedimiento 
            
                        if($stmt->execute()){
                            header("Location: admin-empleados.php");
                        }else{
                            $admin_empleados_err = "Algo salió mal";
                        }
                        //Close statement
                        unset($stmt);
                    }
                }else{
                         //Guardar en la base
                    $sql = "INSERT INTO Usuarios (nombre, apellido, correo, rol, pass) VALUES (:nombre, :apellido, :correo, :rol, :pass)";
            
                    if($stmt = $pdo->prepare($sql)){
                        $stmt->bindParam(":nombre", $param_nombre, PDO::PARAM_STR);
                        $stmt->bindParam(":apellido",$param_apellido, PDO::PARAM_STR);
                        $stmt->bindParam(":correo",$param_correo, PDO::PARAM_STR);
                        $stmt->bindParam(":rol",$param_rol, PDO::PARAM_STR);
                        $stmt->bindParam(":pass",$param_password, PDO::PARAM_STR);
            
                        //Establecemos los parametros
                        $param_nombre = $nombre;
                        $param_apellido = $apellido;
                        $param_correo = $correo;
                        $param_rol = $rol;
                        $param_password = password_hash($pass, PASSWORD_DEFAULT);
            
                        //Ejecutamos el procedimiento 
            
                        if($stmt->execute()){
                            header("Location: admin-empleados.php");
                        }else{
                            $admin_empleados_err = "Algo salió mal";
                        }
                        //Close statement
                        unset($stmt);
                    }
                }
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
                        <h1 class="h3 mb-0 text-gray-800">Empleados</h1>
                    </div>
                    <?php 
                    if(!empty($admin_empleados_err)){
                        echo '<div class="alert alert-danger">' . $admin_empleados_err . '</div>';
                    }        
                    ?>
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-9 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Registro de Empleados</h6>
                                </div>
                                <div class="card-body">
                                    <form class="form" id="registroempleados" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                        <?php 
                                            if(!empty($admin_empleados_err)){
                                                echo '<div class="alert alert-danger">' . $admin_empleados_err . '</div>';
                                            }        
                                        ?>    
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" name="nombre" id="nombre" placeholder="Nombre" class="form-control <?php echo (!empty($nombre_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nombre; ?>" required>
                                                <span class="invalid-feedback"><?php echo $nombre_err; ?></span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="nombre">Apellido</label>
                                                <input type="text" name="apellido" id="apellido" placeholder="Apellido" class="form-control <?php echo (!empty($apellido_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $apellido; ?>" required>
                                                <span class="invalid-feedback"><?php echo $apellido_err; ?></span>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="nombre">Correo electrónico</label>
                                                <input type="email" name="correo" id="correo" placeholder="Correo electrónico" class="form-control <?php echo (!empty($correo_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $correo; ?>" required>
                                                <span class="invalid-feedback"><?php echo $correo_err; ?></span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="nombre">Contraseña</label>
                                                <input type="password" name="password" id="password" placeholder="Contraseña" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" required>
                                                <span class="invalid-feedback"><?php echo $password_err; ?></span>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputRol">Rol</label>
                                                <select id="inputRol" onchange="rolSelection();" class="form-control">
                                                    <option>Seleccionar</option>
                                                    <option>Empleado</option>
                                                    <option>Administrador</option>
                                                </select>
                                                <input type="text" class="form-control <?php echo (!empty($rol_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $rol; ?>" name="rol" id="rol" required hidden>
                                                <span class="invalid-feedback"><?php echo $rol_err; ?></span>
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
                            <h6 class="m-0 font-weight-bold text-primary">Información de Empleados</h6>
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
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Correo</th>
                                            <th>Rol</th>
                                            <th>Acciones</th>
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

    <!-- DESHABILITAR MODAL -->
    <form action="" method="POST" id="Deshabilitar">
        <input type="text" name="ProductoId" id="ProductoId" hidden>
        <input type="hidden" id="opcion" name="opcion" value="eliminar">
        <div class="modal fade" id="modalDeshabilitar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Deshabilitar</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">¿Estás seguro que deseas deshabilitar este producto?</div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" id="deshabilitar-producto" data-dismiss="modal">Cancelar</button>
                        <a class="btn btn-danger" href="">Deshabilitar</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

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
           var table = $('#example').DataTable( {
                "ajax" : {
                    "url" : "get_data.php",
                    "dataSrc" : ""
                },
                "columns" : [
                    {"data" : "nombre"},
                    {"data" : "apellido"},
                    {"data" : "correo"},
                    {"data" : "rol"},
                    {"defaultContent" : "<button class='editar btn btn-primary'>Editar</button> <button class='deshabilitar btn btn-danger' data-toggle='modal' data-target='#modalDeshabilitar'>Deshabilitar</button>"}
                ],
                "language" : idioma_espanol
            } );
            $("#example tbody").on("click", ".editar", function(){
                var data = table.row($(this).parents("tr")).data();
                var  nombre = $("#nombre").val(data.nombre),
                    apellido = $("#apellido").val(data.apellido),
                    correo = $("#correo").val(data.correo),
                    rol = $("#rol").val(data.rol);
                    
            });
            $("#example tbody").on("click", ".deshabilitar", function(){
                var data = table.row($(this).parents("tr")).data();
            });
        } );

        var idioma_espanol = {
		    "sProcessing":     "Procesando...",
		    "sLengthMenu":     "Mostrar _MENU_ registros",
		    "sZeroRecords":    "No se encontraron resultados",
		    "sEmptyTable":     "Ningún dato disponible en esta tabla",
		    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
		    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		    "sInfoPostFix":    "",
		    "sSearch":         "Buscar:",
		    "sUrl":            "",
		    "sInfoThousands":  ",",
		    "sLoadingRecords": "Cargando...",
		    "oPaginate": {
		        "sFirst":    "Primero",
		        "sLast":     "Último",
		        "sNext":     "Siguiente",
		        "sPrevious": "Anterior"
		    },
		    "oAria": {
		        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
		    }
		}
    </script>
    <script>
        function rolSelection(){
            var d = document.getElementById("inputRol");
            var displayText = d.options[d.selectedIndex].text;
            document.getElementById("rol").value = displayText;
        }
    </script>
</body>
</html>