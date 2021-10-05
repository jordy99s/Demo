<?php 
    session_start();
    include("config.php");
	include("functions.php");

	$user_data = check_login($link);
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
    <title>Novedades</title>
</head>
<body>
    <!--BARRA DE NAVEGACION-->
    <?php
        include 'lognavbar.php';
    ?>
    <!--CUERPO-->
    <section class="first-container">
        <div class="container-wrapper">
            <div class="img-box">
                <img src="images/wpp-logo.png" alt="whatsapp-logo">
            </div>
            <div class="text-container">
                <h2>¿Tienes nuestro WhatsApp?</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et pariatur sequi, cupiditate officia eligendi</p>
                <button class="btn-wpp">+505 55555555</button>
            </div>
        </div>
    </section>

    <section class="second-container">
        <div class="container-wrapper">
            <div class="text-container">
                <h2>Promociones por Membresía San Gabriel</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et pariatur sequi, cupiditate officia eligendi</p>
                <button class="btn-read">Leer Más</button>
            </div>
            <div class="img-box">
                <img src="images/constructor.png" alt="constructor">
            </div>
        </div>
    </section>
    
    <section class="third-container">
        <div class="container-wrapper">
            <div class="img-box">
                <img src="images/cocina.png" alt="cocina">
            </div>
            <div class="text-container">
                <h2>Nuevos tipos de cerámica para interiores de cocina</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et pariatur sequi, cupiditate officia eligendi</p>
                <button class="btn-read">Leer Más</button>
            </div>
        </div>
    </section>

    <section class="fourth-container">
        <div class="container-wrapper">
            <div class="text-container">
                <h2>Nuevas Combinaciones de Cemento y Gypsum</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et pariatur sequi, cupiditate officia eligendi</p>
                <button class="btn-read">Leer Más</button>
            </div>
            <div class="img-box">
                <img src="images/Building.png" alt="edificio">
            </div>
        </div>
    </section>

    <!--FOOTER-->
    <?php
        include 'footer.php';
    ?>
    <!--FIN FOOTER-->
    <script src="app.js"></script>
</body>
</html>