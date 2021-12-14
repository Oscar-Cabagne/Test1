<?php
    require $_SERVER['DOCUMENT_ROOT'].'/Escommerce/class/db.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/Escommerce/class/Cliente.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/Escommerce/class/Vendedor.php';
    session_start();

    if( isset( $_SESSION['user'] ) ){
        //$db = new database();
        $actual = unserialize( $_SESSION['user'] );
    }
       
if( $_POST )
    {
        $rfc = $actual->rfc;
        $idCategoria = htmlspecialchars($_POST['categoria']);
        $precio = htmlspecialchars($_POST['precio']);
        $marca = htmlspecialchars($_POST['marca']);
        $modelo = htmlspecialchars( $_POST['modelo'] );
        $caracteristicas = htmlspecialchars( $_POST['caracteristicas'] );
        $urlImg = htmlspecialchars( $_POST['urlImg'] );
        $oferta="no";
        $db = new database();
	$msg=$db->agregarProducto($rfc, $idCategoria, $precio, $marca, $modelo, $caracteristicas, $urlImg, $oferta);

	echo $msg;

        
    }
   

?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Convertirse en vendedor</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="../sass/main.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="../css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="../css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../css/ashion.css" type="text/css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/notifications.css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-sombra">
        <div class="container-md logo">
            <a href="index.html"><img src="../assets/images/LogoProyecto.png" alt="Logo E-scommerce"></a>
        </div>

        <div class="nav-texto">
            <div class="container-md nav-busqueda">
                <form class="flex-fill d-flex busqueda">
                    <input class="form-control me-2" type="search" placeholder="Buscar productos" aria-label="Search">
                    <button class="btn btn-outline-principal" type="submit">Buscar</button>
                    <button class="btn nav-toggle" type="button" aria-label="Abrir menu">
                        <img src="https://img.icons8.com/ios-glyphs/30/000000/menu--v1.png" />
                    </button>
                </form>
            </div>
            <div class="container-md nav-colapsada-vertical">
                <div class="navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav-borde nav-ul">
                        <li class="nav-item">
                            <a class="nav-link" href="./tienda.html">Categor&iacute;as</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Ofertas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Vender</a>
                        </li>
                    </ul>

                    <?php
                        if( isset( $_SESSION['user'] ) ){
                    ?>
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav-borde nav-ul">
                                <li class="nav-item">
                                    <!--<a class="nav-link" href="/Escommerce/pages/registro.php">Crea tu cuenta</a>-->
                                    <?php
                                        echo "<p>" . $actual->usuario . "</p>";
                                        //print_r( $nombre )
                                    ?>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logout.php">Salir</a>
                                </li>
                            </ul>
                    <?php
                        }else{
                    ?>
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav-borde nav-ul">
                                <li class="nav-item">
                                    <!--<a class="nav-link" href="/Escommerce/pages/registro.php">Crea tu cuenta</a>-->
                                    <a class="nav-link" href="registrarCuenta.php">Crea tu cuenta</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="login.php">Ingresa</a>
                                </li>
                            </ul>
                    <?php  
                        }
                    ?>

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Mis compras</a>
                        </li>
                        <li class="nav-item carrito">
                            <a class="nav-link" href="./carrito.html"><img
                                    src="https://img.icons8.com/fluency-systems-regular/22/000000/shopping-cart-loaded.png" /><span
                                    class="badge bg-secundario" id="cantidad-carrito"></span></a>
                            <div id="carrito">
                                <table id="lista-carrito"
                                    class="u-full-width table table-sm .table-responsive-sm .table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Imagen</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                                <a href="#" id="vaciar-carrito" class="button u-full-width vacio">Vaciar Carrito</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!--Fin de barra de navegacion-->
    <main class="container-fluid">
        <form class="clearfix" action="ser-vendedor.php" method="post">
            <section class="w-50 h-100 float-start max-"><!--SECCION IZQUIERDA MARCA MODELO ETC-->
                
                <div class="w-75 calcular d-inline-flex">
                    <input class="form-control text-center" type="text" name="urlImg" maxlength="300" placeholder="URL de la im�gen" required>
                </div>
                <div class="w-75 calcular d-inline-flex">
                    <input class="form-control text-center" type="text" name="marca" maxlength="100" placeholder="Marca de producto" required>
                </div>
                <div class="w-75 calcular d-inline-flex">
                    <input class="form-control text-center" type="text" name="modelo" maxlength="100" placeholder="Modelo de producto" required>
                </div>
                <div class="w-75 calcular d-inline-flex">
                    <input class="form-control text-center" type="number" name="precio" placeholder="Precio de producto" required>
                </div>
                <div class="calcular d-inline-flex w-50">
                    <select class="text-center w-100" name="categoria" required>
                        <option value="0">Ropa mujer</option>
                        <option value="1">Ropa hombre</option>
                        <option value="2">Ropa ni�o</option>
                        <option value="3">Ropa ni�a</option>
                        <option value="4">Ropa beb�</option>
                        <option value="5">Celular</option>
                        <option value="6">Aud�fonos</option>
                        <option value="7">Monitores</option>
                        <option value="8">Teclados</option>
                        <option value="9">Ratones</option>
                        <option value="10">Jard�n</option>
                        <option value="11">Muebes</option>
                        <option value="12">Electrodom�sticos</option>
                        <option value="13">Maquillaje</option>
                        <option value="14">Skincare</option>
                        <option value="15">Cremas</option>
                        <option value="16">Shampoo</option>
                        <option value="17">Jabones</option>
                    </select>
                </div>
            </section><!--SECCION IZQUIERDA MARCA MODELO ETC-->

            <section class="w-50 float-end"><!--SECCION DEECHA CARACTERISTICAS-->
                <div class=" w-75 calcular">
                    <label for="caracteristicas" class="form-label h1 text-center m-auto d-block">Caracter�sticas</label>
                    <textarea class="form-control" name="caracteristicas" id="caracteristicas" rows="25" cols="20" maxlength="500" required></textarea>
                </div>
                <div class="calcular">
                    <button class="d-block btn btn-dark w-75" type="submit" value="enviar">Envia producto</button>
                </div>
            </section><!--SECCION DEECHA CARACTERISTICAS-->
        </form>
    </main>

    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 footPago">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="./index.html"><img src="../assets/images/LogoProyecto.png" alt=""></a>
                        </div>
                        <p>Tenemos los mejores metodos de pago!</p>
                        <div class="footer__payment">
                            <a href="#"><img src="../assets/images/payment/payment-1.png" alt=""></a>
                            <a href="#"><img src="../assets/images/payment/payment-2.png" alt=""></a>
                            <a href="#"><img src="../assets/images/payment/payment-3.png" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 footCuenta">
                    <div class="footer__widget">
                        <h6>Mi cuenta</h6>
                        <ul>
                            <li><a href="#">Mi cuenta</a></li>
                            <li><a href="#">Mis compras</a></li>
                            <li><a href="#">Carrito</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.magnific-popup.min.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/mixitup.min.js"></script>
    <script src="../js/jquery.countdown.min.js"></script>
    <script src="../js/jquery.slicknav.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/jquery.nicescroll.min.js"></script>
    <script src="../js/bootstrap.js"></script>

    <script src="../js/main.js"></script>
    <script src="../js/app.js"></script>
    <script src="../js/notifications.js"></script>
    <script src="../js/ser-vendedor.js"></script>
</body>

</html>