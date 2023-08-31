<?php

include('lib/conexao.php');
include('lib/protect.php');
protect(0);

if (!isset($_SESSION))
    session_start();

$pagina = "inicial.php";
if (isset($_GET['p'])) {
    $pagina = $_GET['p'] . ".php";
}

$id = $_SESSION['usuario'];
$sql_query_admin = $mysqli->query("SELECT * FROM usuarios WHERE id = '$id'") or die($mysqli->error);
$dados_usuario = $sql_query_admin->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <title>BNL - Assessoria jurídica</title>
    <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="CodedThemes">
    <meta name="keywords"
        content="flat ui, admin  Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="CodedThemes">
    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/steps.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" type="text/css" href="assets/css/templatebml.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">

    <!-- Bootstrap CSS -->
    <!-- <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->

</head>

<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                        <a class="mobile-search morphsearch-search" href="#">
                            <i class="ti-search"></i>
                        </a>
                        <a href="painel.html">
                            <img height="65" src="assets/images/Logo_BNL.png" alt="Theme-Logo" />
                        </a>
                        <a class="mobile-options">
                            <i class="ti-more"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a>
                                </div>
                            </li>

                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <!-- <?php if (!isset($_SESSION['admin']) || !$_SESSION['admin']) { ?>
                                <li class="header-notification">
                                    <a href="#!">
                                        <i class="ti-money"></i>
                                        <span class="badge bg-c-pink"></span>
                                        <?php echo number_format($dados_usuario['credito'], 2, ',', '.'); ?>
                                    </a>
                                </li>
                            <?php } ?>-->
                            <li class="user-profile header-notification">
                                <a href="#!">
                                    <span>
                                        <?php echo $dados_usuario['nome_jur']; ?>
                                    </span>
                                    <i class="ti-angle-down"></i>
                                </a>
                                <ul class="show-notification profile-notification">
                                    <li>
                                        <a href="painel.php?p=perfil">
                                            <i class="ti-user"></i> Perfil
                                        </a>
                                    </li>
                                    <li>
                                        <a href="logout.php">
                                            <i class="ti-layout-sidebar-left"></i> Sair
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">
                            <?php if (!isset($_SESSION['admin']) || !$_SESSION['admin']) { ?>
                                <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Menu</div>
                                <ul class="pcoded-item pcoded-left-item">
                                    <li class="">
                                        <a href="painel.php">
                                            <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Página Inicial</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="painel.php?p=gerenciar_acoes">
                                            <span class="pcoded-micon"><i class="ti-briefcase"></i><b>D</b></span>
                                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Montar ação judicial</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="painel.php?p=documentacao_geral">
                                            <span class="pcoded-micon"><i class="ti-bag"></i><b>D</b></span>
                                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Documentos gerais</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="painel.php?p=calcular">
                                            <span class="pcoded-micon"><i class="ti-money"></i><b>D</b></span>
                                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Calcular crédito</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>

                                    
                                    <li class="">
                                        <a href="painel.php?p=requer_certidao">
                                            <span class="pcoded-micon"><i class="ti-agenda"></i><b>D</b></span>
                                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Requerer Certidão</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>

                                    <li class="">
                                        <a href="painel.php?p=cpj">
                                            <span class="pcoded-micon"><i class="ti-file"></i><b>D</b></span>
                                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Área judicial</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>

                                    <li class="">
                                        <a href="logout.php">
                                            <span class="pcoded-micon"><i class="ti-arrow-left"></i><b>D</b></span>
                                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Sair</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                </ul>
                            <?php } else { ?>
                                <div class="pcoded-navigatio-lavel" data-i18n="nav.category.forms"
                                    menu-title-theme="theme1">Menu</div>
                                <ul class="pcoded-item pcoded-left-item">
                                    <li class="">
                                        <a href="painel.php">
                                            <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Página Inicial</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="painel.php?p=gerenciar_processo">
                                            <span class="pcoded-micon"><i class="ti-bag"></i><b>D</b></span>
                                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Gerenciar Processos</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="painel.php?p=gerenciar_usuarios">
                                            <span class="pcoded-micon"><i class="ti-user"></i><b>D</b></span>
                                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Gerenciar Usuarios</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>

                                    <li class="">
                                        <a href="painel.php?p=relatorio">
                                            <span class="pcoded-micon"><i class="ti-file"></i><b>D</b></span>
                                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Relatório</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>

                                    <li class="">
                                        <a href="logout.php">
                                            <span class="pcoded-micon"><i class="ti-arrow-left"></i><b>D</b></span>
                                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Sair</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                </ul>
                            <?php } ?>
                        </div>

                    </nav>
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">

                            <div class="main-body">
                                <div class="page-wrapper">
                                    <?php include('pages/' . $pagina); ?>
                                </div>
                            </div>
                            <div id="styleSelector">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Warning Section Starts -->
    <!-- Older IE warning message -->
    <!--[if lt IE 9]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers
        to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script type="text/javascript" src="assets/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="assets/js/modernizr/modernizr.js"></script>
    <script type="text/javascript" src="assets/js/modernizr/css-scrollbars.js"></script>
    <!-- classie js -->
    <script type="text/javascript" src="assets/js/classie/classie.js"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="assets/js/script.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <script src="assets/js/demo-12.js"></script>
    <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- CDNs -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"
        integrity="sha512-yVcJYuVlmaPrv3FRfBYGbXaurHsB2cGmyHr4Rf1cxAS+IOe/tCqxWY/EoBKLoDknY4oI1BNJ1lSU2dxxGo9WDw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.2/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.2/vfs_fonts.js"></script>
</body>

</html>