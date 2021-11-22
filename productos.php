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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <title>Productos</title>
</head>
<body>
    <!-- CAMBIAR POR OTRO -->
    <!--HEADER-->
    <?php
        include 'lognavbar.php';
    ?>
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
                        <button class="btn-menos">-</button><input type="text" size="2" autofocus placeholder="1"><button class="btn-mas">+</button>
                    </div>
                    <div class="button-group">
                        <button class="btn-add">Agregar al carrito</button>
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
                        <button class="btn-menos">-</button><input type="text" size="2" autofocus placeholder="1"><button class="btn-mas">+</button>
                    </div>
                    <div class="button-group">
                        <button class="btn-add">Agregar al carrito</button>
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
                        <button class="btn-menos">-</button><input type="text" size="2" autofocus placeholder="1"><button class="btn-mas">+</button>
                    </div>
                    <div class="button-group">
                        <button class="btn-add">Agregar al carrito</button>
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
                        <button class="btn-menos">-</button><input type="text" size="2" autofocus placeholder="1"><button class="btn-mas">+</button>
                    </div>
                    <div class="button-group">
                        <button class="btn-add">Agregar al carrito</button>
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
                        <button class="btn-menos">-</button><input type="text" size="2" autofocus placeholder="1"><button class="btn-mas">+</button>
                    </div>
                    <div class="button-group">
                        <button class="btn-add">Agregar al carrito</button>
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
                        <button class="btn-menos">-</button><input type="text" size="2" autofocus placeholder="1"><button class="btn-mas">+</button>
                    </div>
                    <div class="button-group">
                        <button class="btn-add">Agregar al carrito</button>
                        <button class="btn-ver">Ver más</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--FOOTER-->
    <?php
        include 'footer.php';
    ?>
    <!--FIN FOOTER-->

    <script src="app.js"></script>
</body>
</html>