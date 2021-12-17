<?php 
   session_start();
 
   // Check if the user is logged in, if not then redirect him to login page
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: ../index.php");
       exit;
   }

   require_once "../config.php";

   $nombre = $cantidad = $precio = $imagen = $ProductoId = "";
   $nombre_err = $cantidad_err = $precio_err = $imagen_err = $ProductoId_err = $insert_err = "";

   if($_SERVER['REQUEST_METHOD'] == "POST"){
    //    Verifico los campos

        if(empty(trim($_POST["nombre"]))){
            $nombre_err = "Por favor, ingrese un nombre";
        }else{
            $nombre = trim($_POST["nombre"]);
        }

        if(empty(trim($_POST["cantidad"]))){
            $cantidad_err = "Ingrese una cantidad";
        }elseif ($_POST["cantidad"] <= 0) {
            $cantidad_err = "Ingrese una cantidad mayor a 0";
        }else{
            $cantidad = $_POST["cantidad"];
        }

        $imagen = $_POST["imagen"];

        if(empty(trim($_POST["precio"]))){
            $precio_err = "Ingrese un precio";
        }elseif ($_POST["precio"] <= 0) {
            $precio_err = "Ingrese un precio mayor a 0";
        }else{
            $precio = $_POST["precio"];
        }

        if(empty($nombre_err) && empty($precio_err) && empty($cantidad_err)){
            // Hacemos una consulta
            $sql = "SELECT ProductoId FROM Producto WHERE ProductoId  = :ProductoId";

            if($stmt = $pdo->prepare($sql)){

                $stmt->bindParam(":ProductoId", $param_ProductoId, PDO::PARAM_STR);
                $param_ProductoId = trim($_POST["ProductoId"]);

                if($stmt->execute()){
                    if($stmt->rowCount() == 1){

                        $sql = "UPDATE Producto SET nombre = :nombre, cantidad = :cantidad, precio = :precio WHERE ProductoId = :ProductoId";

                        if($stmt = $pdo -> prepare($sql)){

                            
                            $stmt->bindParam(":nombre", $param_nombre, PDO::PARAM_STR);
                            $stmt->bindParam(":cantidad", $param_cantidad, PDO::PARAM_STR);
                            $stmt->bindParam(":precio", $param_precio, PDO::PARAM_STR);
                            $stmt->bindParam(":ProductoId", $param_ProductoId, PDO::PARAM_STR);
                            
                            
                            $param_nombre = $nombre;
                            $param_cantidad = $cantidad;
                            $param_precio = $precio;
                            $param_ProductoId = $ProductoId;

                            if($stmt -> execute()){
                                header("Location: inventario.php");
                            }else{
                                $insert_err = "Algo salió mal";
                            }
                            unset($stmt);
                        }
                    }else{
                        $sql = "INSERT INTO Producto (nombre, cantidad, precio, imagen, estado) VALUES (:nombre, :cantidad, :precio, :imagen, 'Habilitado')";

                        if($stmt = $pdo -> prepare($sql)){
                            $stmt->bindParam(":nombre", $param_nombre, PDO::PARAM_STR);
                            $stmt->bindParam(":cantidad", $param_cantidad, PDO::PARAM_STR);
                            $stmt->bindParam(":precio", $param_precio, PDO::PARAM_STR);
                            $stmt->bindParam(":imagen", $param_imagen, PDO::PARAM_STR);

                            $param_nombre = $nombre;
                            $param_cantidad = $cantidad;
                            $param_precio = $precio;
                            $param_imagen = $imagen;

                            if($stmt -> execute()){
                                header("Location: inventario.php");
                            }else{
                                $insert_err = "Algo salió mal";
                            }
                            unset($stmt);
                        }
                    }
                }
            }
            
        }

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

    <title>Inventario Dashboard</title>

        <!-- Custom fonts for this template -->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script>
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
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Productos</h1>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-9 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Registro de Productos</h6>
                                </div>
                                <div class="card-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                        <?php 
                                            if(!empty($insert_err)){
                                                echo '<div class="alert alert-danger">' . $insert_err . '</div>';
                                            }        
                                        ?>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <input hidden type="text" name="ProductoId" id="ProductoId" value="<?php echo $ProductoId; ?>" class="form-control <?php echo (!empty($ProductoId_err)) ? 'is-invalid' : ''; ?>">
                                                <label for="nombre">Nombre del Producto</label>
                                                <input type="text" name="nombre" id="nombre" class="form-control <?php echo (!empty($nombre_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nombre; ?>">
                                                <span class="invalid-feedback"><?php echo $nombre_err; ?></span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="imagen">Imagen</label> <br>
                                                <input type="file" accept="image/png, image/gif, image/jpeg" name="imagen" id="imagen" class="form-input <?php echo (!empty($imagen_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $imagen; ?>">
                                                <span class="invalid-feedback"><?php echo $imagen_err; ?></span>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="cantidad">Cantidad</label>
                                                <input type="number" name="cantidad" id="cantidad" class="form-control <?php echo (!empty($cantidad_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cantidad; ?>">
                                                <span class="invalid-feedback"><?php echo $cantidad_err; ?></span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="Precio">Precio</label>
                                                <input type="number" name="precio" id="precio" class="form-control <?php echo (!empty($precio_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $precio; ?>" step=".01">
                                                <span class="invalid-feedback"><?php echo $precio_err; ?></span>
                                                <input type="text" name="estado" id="estado" hidden>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group-col md-6">
                                                <button type="submit" class="btn btn-primary" value="Guardar">Guardar</button>
                                                <button type="reset" class="btn btn-secondary">Cancelar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Información de Productos</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tablaProducto" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ProductoId</th>
                                            <th>Nombre</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
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
           var table = $('#tablaProducto').DataTable( {
                "ajax" : {
                    "url" : "get_datap.php",
                    "dataSrc" : ""
                },
                "columns" : [
                    {"data" : "ProductoId"},
                    {"data" : "nombre"},
                    {"data" : "cantidad"},
                    {"data" : "precio"},
                    {"data" : "estado"},
                    {"defaultContent" : "<button class='editar btn btn-primary'>Editar</button> <button class='deshabilitar btn btn-danger' data-toggle='modal' data-target='#modalDeshabilitar'>Deshabilitar</button>"}
                ],
                "language" : idioma_espanol
            } );
            $("#tablaProducto tbody").on("click", ".editar", function(){
                var data = table.row($(this).parents("tr")).data();
                var ProductoId = $("#ProductoId").val(data.ProductoId),
                    nombre = $("#nombre").val(data.nombre),
                    cantidad = $("#cantidad").val(data.cantidad),
                    precio = $("#precio").val(data.precio),
                    estado = $("#estado").val(data.estado);
                    
            });
            $("#tablaProducto tbody").on("click", ".deshabilitar", function(){
                var data = table.row($(this).parents("tr")).data();
                var ProductoId = $("#Deshabilitar #ProductoId").val(data.ProductoId);
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
</body>
</html>