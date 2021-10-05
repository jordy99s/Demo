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
    <title>¿Quiénes Somos?</title>
</head>
<body>
    <!--HEADER-->
    <?php
        include 'lognavbar.php';
    ?>
    <!--CUERPO-->
    <section class="banner-container">
        <div class="img-container">
            <img src="images/personas.png" alt="personas">
        </div>
        <div class="ntext-container">
            <p>Entregando más alla de productos de calidad, confianza y servicio a nuetros clientes</p>
        </div>
    </section>

    <section class="somos-container">
        <div class="left-text-container">
            <h3>¿Quiénes Somos?</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Magni et adipisci, sint repellendus esse dolores accusamus reiciendis ducimus maiores quo doloribus, tempora dolore. Velit odio quis nemo, maxime unde quos.</p>
        </div>
        <div class="right-text-container">
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsum minima laborum id sequi eum fugit aspernatur sit impedit fugiat recusandae perspiciatis excepturi voluptatum distinctio, cumque alias, quia vitae amet aliquam.</p>
        </div>
    </section>

    <section class="mission-container">
        <div class="top-text-container">
            <h2>Misión</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur possimus consequatur magnam tempore eum? Quidem libero rem repellendus aut nihil nemo ad praesentium neque sapiente. Est, dolorem! Necessitatibus, quaerat voluptas.</p>
        </div>
        <div class="bottom-text-container">
            <h2>Visión</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur exercitationem sint, commodi nesciunt pariatur aperiam aliquam, saepe doloribus vero molestiae aliquid voluptates sequi vitae voluptate consequuntur provident unde nam? Vel?</p>
        </div>
    </section>

    <section class="last-container">
        <div class="icons-container">
            <h3>Nuestros Valores</h3>
            <p>¡Es la confianza de nuestros clientes!</p>
            <div class="valores-items">
                <ul>
                    <li>Liderazgo</li>
                    <li>Lealtad</li>
                    <li>Honestidad</li>
                    <li>Integridad</li>
                    <li>Compromiso</li>
                </ul>
            </div>
        </div>
        
        <div class="last-img-container">
            <img src="images/hombre.png" alt="hombre">
        </div>
    </section>

    <!--MAPA-->
    <section class="mapa">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3901.604035599522!2d-86.21916318548483!3d12.070742191451346!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f73ffa06bc8f84f%3A0x610afe5d6406b1be!2sMateriales%20de%20Construcci%C3%B3n%20San%20Gabriel!5e0!3m2!1sen!2sni!4v1628635837856!5m2!1sen!2sni" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </section>
    <!--FOOTER-->
    <?php
        include 'footer.php';
    ?>
    <!--FIN FOOTER-->
    <!--Script-->
    <script src="app.js"></script>
    <!--Fin-->
</body>
</html>