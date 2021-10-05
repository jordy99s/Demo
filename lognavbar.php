<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.dropdown {
  float: left;
  max-width: 1300px;
}

.dropdown .dropbtn {
  font-size: 1rem;  
  border: none;
  outline: none;
  color: orange;
  padding: 14px 16px;
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
  padding: 12px 16px;
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
    font-size: 1.6rem;
  }
}

</style>
<!--BARRA DE NAVEGACION-->
<nav class="navbar">
    <div class="navbar-container">
        <a href="./index.php" id="navbar-logo"><img src="images/logocomp.png" alt=""></a> <!--CAMBIAR SAN GABRIEL POR UNA IMAGEN (<i></i>)-->
        <div class="navbar-toggle" id="mobile-menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <ul class="navbar-menu">
            <li class="navbar-item">
                <a href="index.php" class="navbar-links">Inicio</a>
            </li>
            <li class="navbar-item">
                <a href="somos.php" class="navbar-links">¿Quiénes Somos?</a>
            </li>
            <li class="navbar-item">
                <a href="productos.php" class="navbar-links">Productos</a>
            </li>
            <li class="navbar-item">
                <a href="novedades.php" class="navbar-links">Novedades</a>
            </li>
            <li class="navbar-btn">
                <?php if (!empty($_SESSION['UserId'])) { ?>
                    <div class="dropdown">
                        <button class="dropbtn">Hola, <?php echo $user_data['nombre'] ?> <i class="fa fa-caret-down"></i> </button>
                        <div class="dropdown-content">
                            <a href="#">Ver Perfil</a>
                            <a href="./logout.php">Cerrar Sesión</a>
                        </div>
                    </div> 
                    <?php } else { ?>
                      <a href="login.php" class="button">Acceder</a>
                <?php } ?>
            </li>
        </ul>
    </div>
</nav>