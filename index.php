<?php 
    session_start();
    //include("config.php");
	include("functions.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <title>Ferretería San Gabriel</title>
    <style>
       <?php include "styles.css" ?>
    </style>
</head>
<body>
    <!--HEADER-->
    <?php
        include 'lognavbar.php';
    ?>
    <!--CUERPO-->
    <div class="main">
        <div class="main-container">
            <div class="img-container">
                <img src="images/Ferreteria.png" alt="" id="main-img">
            </div>
        </div>
    </div>
    <div class="services">
        <h1>Nuestros Servicios</h1>
        <div class="services-container">
            <div class="services-card">
                <img src="images/Ceramicas.png" alt="Ceramicas">
                <h2>Cerámica</h2>
                <button>Ver más</button>
            </div>
            <div class="services-card">
                <img src="images/fontaneria.png" alt="fontaneria">
                <h2>Fontanería</h2>
                <button>Ver más</button>
            </div>
            <div class="services-card">
                <img src="images/interiores.png" alt="interiores">
                <h2>Diseños de Interiores</h2>
                <button>Ver más</button>
            </div>
            <div class="services-card">
                <img src="images/Construccion.png" alt="materiales">
                <h2>Materiales de Construcción</h2>
                <button>Ver más</button>
            </div>
            <div class="services-card">
                <img src="images/Pintura.png" alt="pinturas">
                <h2>Pintura</h2>
                <button>Ver más</button>
            </div>
            <div class="services-card">
                <img src="images/maquinaria.png" alt="maquinas">
                <h2>Maquinaria</h2>
                <button>Ver más</button>
            </div>
        </div>

        <!--SLIDESHOW-->
        <h1>Nuestras Marcas</h1>
        <div class="slide">

            <input type="radio" name="images" id="i1" checked>
            <input type="radio" name="images" id="i2">
            <input type="radio" name="images" id="i3">
            <input type="radio" name="images" id="i4">
            <input type="radio" name="images" id="i5">
            <input type="radio" name="images" id="i6">

            <div class="slide-img" id="uno">
                <img src="images/truper-1.svg" alt="trupper-logo">
                    <label for="i3" class="pre"> <p class="arrow"><i class="fas fa-chevron-left"></i> </p> </label>
                    <label for="i2" class="nxt"> <p class="arrow"><i class="fas fa-chevron-right"></i></p> </label>
            </div>
            <div class="slide-img" id="dos">
                <img src="images/sur-logo.png" alt="sur-logo">
                    <label for="i1" class="pre"><p class="arrow"><i class="fas fa-chevron-left"></i> </p></label>
                    <label for="i3" class="nxt"><p class="arrow"><i class="fas fa-chevron-right"></i></p></label>
            </div>
            <div class="slide-img" id="tres">
                <img src="images/holcim-logo.png" alt="holcim-logo">
                    <label for="i2" class="pre"><p class="arrow"><i class="fas fa-chevron-left"></i> </p></label>
                    <label for="i4" class="nxt"><p class="arrow"><i class="fas fa-chevron-right"></i></p></label>
            </div>
            <div class="slide-img" id="cuatro">
                <img src="images/lanco_logo.png" alt="lanco-logo">
                    <label for="i3" class="pre"><p class="arrow"><i class="fas fa-chevron-left"></i> </p></label>
                    <label for="i5" class="nxt"><p class="arrow"><i class="fas fa-chevron-right"></i></p></label>
            </div>
            <div class="slide-img" id="cinco">
                <img src="images/Black-Decker-Logo.png" alt="bldckr-logo">
                    <label for="i4" class="pre"><p class="arrow"><i class="fas fa-chevron-left"></i> </p></label>
                    <label for="i6" class="nxt"><p class="arrow"><i class="fas fa-chevron-right"></i></p></label>
            </div>
            <div class="slide-img" id="seis">
                <img src="images/modelo-logo.png" alt="modelo-logo">
                    <label for="i5" class="pre"><p class="arrow"><i class="fas fa-chevron-left"></i> </p></label>
                    <label for="i1" class="nxt"><p class="arrow"><i class="fas fa-chevron-right"></i></p></label>
            </div>

            <div class="nav-dots">
                <label for="i1" class="dots" id="dot1"></label>
                <label for="i2" class="dots" id="dot2"></label>
                <label for="i3" class="dots" id="dot3"></label>
                <label for="i4" class="dots" id="dot4"></label>
                <label for="i5" class="dots" id="dot5"></label>
                <label for="i6" class="dots" id="dot6"></label>
            </div>

        </div>
    </div>
    
    <!--FOOTER-->
    <?php
        include 'footer.php';
    ?>
    <!--FIN FOOTER-->
    <script src="app.js" ></script>
</body>
</html>