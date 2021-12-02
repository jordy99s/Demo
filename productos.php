<?php 
    session_start();
	include("functions.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <style>
       <?php include "styles.css" ?>
    </style>
    <style>
        .dropdown {
            float: left;
            width: 100%;
        }

        .dropdown .dropbtn {
            font-size: 1rem;  
            border: 2px solid #707070;
            outline: none;
            color: #707070;
            padding: 6px 10px;
            background-color: inherit;
            font-family: inherit;
        }

        .dropdown:hover .dropbtn {
            background-color: #ddd;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            float: none;
            color: black;
            padding: 6px 10px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        @media screen and (max-width: 960px){
            .dropdown .dropbtn {
                font-size: 1.5rem;
            }
        }

    </style>    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <title>Productos</title>
</head>
<body>
    <!--HEADER-->
    <!-- SHOPPING CART -->
    <nav class="shopping-navbar">
        <div class="shopping-container">
            <a href="index.php" id="shopping-logo"><img src="images/logocomp.png" alt=""></a>
            <div class="navbar-toggle" id="mobile-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            <ul class="shopping-menu">
                <li class="shopping-btn">
                    <div class="dropdown">
                        <button class="dropbtn">General <i class="fas fa-caret-down"></i></button>
                        <div class="dropdown-content">
                            <a href="#">Destacado</a>
                            <a href="#">Materiales de Construcción</a>
                            <a href="#">Pinturas</a>
                            <a href="#">Lavanderos</a>
                            <a href="#">Accesorios para pintar</a>
                            <a href="#">Grifería</a>
                            <a href="#">Cerraduras</a>
                            <a href="#">Cerámica</a>
                        </div>
                    </div>
                </li>
                <li class="shopping-search">
                    <input type="search" placeholder="Buscar"><a href="#"><i class="fa fa-search"></i></a>
                </li>
                <li class="shopping-user">
                    <?php if (!empty($_SESSION['UserId'])) { ?>
                        <div class="user-welcome">
                            Bienvenido, <?php echo htmlspecialchars($_SESSION["nombre"]) ?>
                        </div>
                        <?php } else { ?>
                            <div class="user-welcome">
                                <a href="login.php" class="init">Inicie Sesión</a>
                            </div>
                    <?php } ?>
                    
                </li>
                <li class="shopping-cart">
                    <button type="button" data-toggle="modal" data-target="#cart"><i class="fas fa-shopping-cart"></i> (<span class="total-count"></span>)</button><button class="clear-cart btn btn-danger">Clear Cart</button></div>
                </li>
            </ul>  
        </div>
    </nav>
    <!--CUERPO-->
    <div class="products">
        <h1>Nuestros Productos</h1>
        <div class="products-container">
            <div class="product-card">
                <div class="product-image">
                    <img src="images/prod/HOLCIM.png" alt="Cemento">
                </div>
                <div class="product-info">
                    <p>Cemento Holcim Fuerte Gris</p>
                    <div class="cantidad">
                        <div class="c-text">
                            Precio: C$ 409.36
                        </div>
                        <!-- <button class="btn-menos">-</button><input type="text" size="2" autofocus placeholder="1"><button class="btn-mas">+</button> -->
                    </div>
                    <div class="button-group">
                        <a href="#" data-name="Cemento Holcim" data-price="409.36" class="btn-add add-to-cart">Agregar al carrito</a>
                        <button class="btn-ver">Ver más</button>
                    </div>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <img src="images/prod/brocha_uro_cod_21380.png" alt="brocha">
                </div>
                <div class="product-info">
                    <p>Brocha Pintura URO 5/8</p>
                    <div class="cantidad">
                        <div class="c-text">
                            Precio: C$ 85.00
                        </div>
                        <!-- <button class="btn-menos">-</button><input type="text" size="2" autofocus placeholder="1"><button class="btn-mas">+</button> -->
                    </div>
                    <div class="button-group">
                        <a href="#" class="btn-add add-to-cart" data-name="Brocha Pintura" data-price="85.00" >Agregar al carrito</a>
                        <button class="btn-ver">Ver más</button>
                    </div>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <img src="images/prod/Cemento cemex blanco 50kg.png" alt="cemex">
                </div>
                <div class="product-info">
                    <p>Cemento Cemex Blanco</p>
                    <div class="cantidad">
                        <div class="c-text">
                            Precio: C$ 999.99
                        </div>
                        <!-- <button class="btn-menos">-</button><input type="text" size="2" autofocus placeholder="1"><button class="btn-mas">+</button> -->
                    </div>
                    <div class="button-group">
                        <a href="#" class="btn-add add-to-cart" data-name="Cemento Cemex" data-price="409.36">Agregar al carrito</a>
                        <button class="btn-ver">Ver más</button>
                    </div>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <img src="images/prod/Anticorrosivo-Poliuretano-GLN-rojo-478x500.png" alt="corro">
                </div>
                <div class="product-info">
                    <p>Anticorrosivo Poliuretano LANCO</p>
                    <div class="cantidad">
                        <div class="c-text">
                            Precio: C$ 999.99
                        </div>
                        <!-- <button class="btn-menos">-</button><input type="text" size="2" autofocus placeholder="1"><button class="btn-mas">+</button> -->
                    </div>
                    <div class="button-group">
                        <a href="#" class="btn-add add-to-cart" data-name="Anticorrosivo Lanco" data-price="409.36">Agregar al carrito</a>
                        <button class="btn-ver">Ver más</button>
                    </div>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <img src="images/prod/pintura-lat-3100.png" alt="corro">
                </div>
                <div class="product-info">
                    <p>Pintura SUR Látex 3100</p>
                    <div class="cantidad">
                        <div class="c-text">
                            Precio: C$ 999.99
                        </div>
                        <!-- <button class="btn-menos">-</button><input type="text" size="2" autofocus placeholder="1"><button class="btn-mas">+</button> -->
                    </div>
                    <div class="button-group">
                        <a href="#" class="btn-add add-to-cart" data-name="Sur Goltex" data-price="409.36">Agregar al carrito</a>
                        <button class="btn-ver">Ver más</button>
                    </div>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <img src="images/prod/pinturas-sur-goltex-n-8.png" alt="corro">
                </div>
                <div class="product-info">
                    <p>Pintura SUR Goltex</p>
                    <div class="cantidad">
                        <div class="c-text">
                            Precio: C$ 999.99
                        </div>
                        <!-- <button class="btn-menos">-</button><input type="text" size="2" autofocus placeholder="1"><button class="btn-mas">+</button> -->
                    </div>
                    <div class="button-group">
                        <a href="#" class="btn-add add-to-cart" data-name="Sur Latex" data-price="409.36">Agregar al carrito</a>
                        <button class="btn-ver">Ver más</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- Modal -->
    
    <!--FOOTER-->
    <?php
        include 'footer.php';
    ?>
    <!--FIN FOOTER-->
    <script>
        <?php
            include 'cart.js';
        ?>
    </script>
    <script>
        <?php
            include 'app.js';
        ?>
    </script>
</body>
</html>