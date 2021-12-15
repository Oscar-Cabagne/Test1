<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Escommerce/class/Vendedor.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/Escommerce/class/Cliente.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/Escommerce/class/Producto.php';
    session_start();

    if( isset( $_SESSION['user'] ) ){
        //$db = new database();
        $actual = unserialize( $_SESSION['user'] );
    }

    if( isset( $_SESSION['carrito'] ) ){
        $productos = array();
        $msg = $_SESSION['carrito'];
        $db = new database();
        foreach( $_SESSION['carrito'] as $id ){
            $res = $db->buscarProducto( "*", $id ); // Hay que iterar
            $producto = new Producto( $res['idProducto'], $res['marca'] . " " . $res['modelo'], $res['precio'], $res['caracteristicas'], $res['idCategoria'], $res['urlImg'] );
            $productos []= $producto;
        }
        /*if( isset( $res ) ){
            $msg = $res;
            $producto = new Producto( $res['idProducto'], $res['marca'] . " " . $res['modelo'], $res['precio'], $res['caracteristicas'], $res['idCategoria'], $res['urlImg'] );
        }else{
            //$msg = "Algo salió mal en la consulta";
            $msg = $_SESSION['carrito'];
        }*/
    }else{
        $msg = "No hay carrito";
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
    <title>Confirmar pedido</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../sass/main.css">
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

    <!--Inicio de barra de navegacion-->
    <nav class="navbar navbar-expand-lg navbar-light bg-sombra">
        <div class="container-md logo">
            <a href="index.php"><img src="../assets/images/LogoProyecto.png" alt="Logo E-scommerce"></a>
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
                            <a class="nav-link" href="./tienda.php">Categor&iacute;as</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Ofertas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Vender</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav-borde nav-ul">
                        <li class="nav-item">
                            <!--<a class="nav-link" href="/Escommerce/pages/registro.php">Crea tu cuenta</a>-->
                            <a class="nav-link" href="registrarCuenta.php">Crea tu cuenta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Ingresa</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Mis compras</a>
                        </li>
                        <li class="nav-item carrito">
                            <a class="nav-link" href="./carrito.php"><img
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

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./index.php" id="indexBread"><img
                                        src="https://img.icons8.com/material-sharp/24/000000/home.png" />Inicio</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Carrito</li>
                            <li class="breadcrumb-item active" aria-current="page">Pago</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <form action="#" class="checkout__form">
                <div class="row">
                    <div class="col-lg-8">
                        <h5>Detalles de cobro:</h5>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Nombre(s) <span>*</span></p>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Apellidos <span>*</span></p>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="checkout__form__input">
                                    <p>Pa&iacute;s <span>*</span></p>
                                    <input type="text">
                                </div>
                                <div class="checkout__form__input">
                                    <p>Direcci&oacute;n <span>*</span></p>
                                    <input type="text" placeholder="Street Address">
                                    <input type="text" placeholder="Apartment. suite, unite ect ( optinal )">
                                </div>
                                <div class="checkout__form__input">
                                    <p>Ciudad <span>*</span></p>
                                    <input type="text">
                                </div>
                                <div class="checkout__form__input">
                                    <p>Estado/Delegaci&oacute;n <span>*</span></p>
                                    <input type="text">
                                </div>
                                <div class="checkout__form__input">
                                    <p>C&oacute;digo postal <span>*</span></p>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Tel&eacute;fono <span>*</span></p>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Email <span>*</span></p>
                                    <input type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="checkout__order">
                            <h5>Su pedido</h5>
                            <div class="checkout__order__product">
                                <ul>
                                    <li>
                                        <span class="top__text">Productos</span>
                                        <span class="top__text__right">Total</span>
                                    </li>
                                    <?php
                                        $total = 0;
                                        foreach( $productos as $producto ){
                                        if( isset( $producto ) ){
                                            $total += $producto->getPrecio();
                                    ?>
                                    <li><?php echo $producto->Nombre; ?><span>$ <?php echo $producto->getPrecio(); ?></span></li>
                                    <?php
                                        }}
                                    ?>
                                </ul>
                            </div>
                            <div class="checkout__order__total">
                                <ul>
                                    <li>Subtotal <span><?php echo $total; ?></span></li>
                                    <li>Envio <span>!Free</span></li>
                                    <li>Total <span><?php echo $total; ?></span></li>
                                </ul>
                            </div>
                            <div class="checkout__order__widget">
                                <label for="check-payment">
                                    Pago con tarjeta
                                    <input type="checkbox" id="check-payment">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="paypal">
                                    PayPal
                                    <input type="checkbox" id="paypal">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <button type="submit" class="site-btn">Confirmar orden</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Checkout Section End -->

    <!-- Categorias Banner Inicio -->
    <div class="instagram">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg"
                        data-setbg="../assets/images/categorias/banner-categorias/banner-makeup.jpg">
                        <div class="instagram__text">
                            <a href="#">Maquillaje</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg"
                        data-setbg="../assets/images/categorias/banner-categorias/banner-skincare.jpg">
                        <div class="instagram__text">
                            <a href="#">Skin Care</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg"
                        data-setbg="../assets/images/categorias/banner-categorias/banner-ninos.jpg">
                        <div class="instagram__text">
                            <a href="#">Moda para ni&ntilde;os</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg"
                        data-setbg="../assets/images/categorias/banner-categorias/banner-moda.jpg">
                        <div class="instagram__text">
                            <a href="#">Moda para todos</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg"
                        data-setbg="../assets/images/categorias/banner-categorias/banner-mascotas.jpg">
                        <div class="instagram__text">
                            <a href="#">Para tu mascota</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg"
                        data-setbg="../assets/images/categorias/banner-categorias/banner-hogar.jpg">
                        <div class="instagram__text">
                            <a href="#">Decoraci&oacute;n para el hogar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Categorias Banner Fin -->

    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 footPago">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="./index.php"><img src="../assets/images/LogoProyecto.png" alt=""></a>
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
</body>

</html>