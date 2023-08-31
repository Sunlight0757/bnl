<?php

$erro = false;
if (isset($_POST['email']) || isset($_POST['senha'])) {

    include('lib/conexao.php');
    $email = $mysqli->escape_string($_POST['email']);
    $senha = $mysqli->escape_string($_POST['senha']);

    $sql_query = $mysqli->query("SELECT * FROM usuarios WHERE email = '$email'") or die($mysqli->error);
    $usuario = $sql_query->fetch_assoc();

    if(password_verify($senha, $usuario['senha'])) {
        if(!isset($_SESSION))
            session_start();
        $_SESSION['usuario'] = $usuario['id'];
        $_SESSION['admin'] = $usuario['admin'];
        header("Location: logado.php");
    } else {
        $erro = "Dados inválidos";
    }

}
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>BNL - Assessoria jurídica para condomínios</title>

    <!-- Bootstrap CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

   <!-- CSS Adicional -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatebml.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

        <!-- Favicon icon -->
        <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">

  </head>
    <body>

    <!-- Preloader Inicial -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- Preloader Final -->

    <!-- Header -->
    <div class="sub-header">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-xs-12">
            <ul class="left-info">
              <li><i class="fa fa-clock-o"></i>Segunda à Sexta das 09:00 à 17:00</li>
              <li><i class="fa fa-phone"></i>(65) 99981 - 4804</li>
            </ul>
          </div>
          <div class="col-md-4">
            <ul class="right-icons">
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-instagram"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    
    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brandi pr-0 mr-sm-1" href="index.html"><h2>Assessoria para Condomínios</h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="index.html"><i class="fa fa-home"></i>&nbsp;&nbsp;Principal
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="sobre.html" ><i class="fa fa-book"></i>&nbsp;&nbsp;Sobre
              </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="servicos.html"><i class="fa fa-tasks"></i>&nbsp;&nbsp;Serviços</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contato.html"><i class="fa fa-comment"></i>&nbsp;&nbsp;Contato</a>
              </li>
              <li class="nav-item">
              <li class="nav-item active">
                <a class="nav-link" href="entrar.php"><i class="fa fa-user"></i>&nbsp;&nbsp;Entrar</a>
                <span class="sr-only">(current)</span>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <div class="page-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1>BNL Assessoria</h1>
            <span>Mais de 40 anos de experiência no setor jurídico</span>
          </div>
        </div>
      </div>
    </div>
    <!-- Conteúdo da Página -->
    <section class="">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col">
                    <!-- Authentication card start -->
                    <div class="login-card card-block auth-body mr-auto ml-auto">
                        <form method="post" class="md-float-material">
                            <div class="auth-box">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-left txt-primary">Esqueceu sua senha?</h3> <br>Digite seu email e acesse-o para resetar a senha.
                                    </div>
                                </div>
                                <hr/>
                                <?php if($erro !== false) {
                                    ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo $erro; ?>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="input-group">
                                    <input type="email" name="email" class="form-control" placeholder="Seu e-mail">
                                    <span class="md-line"></span>
                                </div>
         
                                <div class="row m-t-25 text-left">
                                    <div class="col">
                                        <a href="entrar.php" class="text-left btn btn-link"><h5><i class="fa fa-arrow-left" aria-hidden="true"></i>Voltar</h5></a></p>
                                    </div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="green-btn btn btn-lg btn-block text-center m-b-20">Enviar</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <!-- end of form -->
                    </div>
                    <!-- Authentication card end -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
 <!-- Pre-loader end -->
    <!-- Parceiros -->
    <div class="partners">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="owl-partners owl-carousel">
  
              <div class="partner-item">
                <img src="assets/images/client-01.png" title="1" alt="1">
              </div>
  
              <div class="partner-item">
                <img src="assets/images/client-01.png" title="2" alt="2">
              </div>
  
              <div class="partner-item">
                <img src="assets/images/client-01.png" title="3" alt="3">
              </div>
  
              <div class="partner-item">
                <img src="assets/images/client-01.png" title="4" alt="4">
              </div>
  
              <div class="partner-item">
                <img src="assets/images/client-01.png" title="5" alt="5">
              </div>
  
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-4 text-center"><img class="footer-img" src="assets/images/PJE.jpg"></div>
        <div class="col-4 text-center"><img class="footer-img" src="assets/images/logoSTF.png"></div>
        <div class="col-4 text-center"><img class="footer-img" src="assets/images/logoSTJ.jpg"></div>
      </div>
    </div>
    </footer>
     <div class="sub-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <p>Rua General Vale, 321, sala 806, Cuiabá, MT - 78010-000 <br>© 2020 BNL Assessoria. Todos direitos reservados.
          </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts Adicionais -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/accordions.js"></script>

    <script type="text/javascript" src="assets/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="assets/js/modernizr/modernizr.js"></script>
    <script type="text/javascript" src="assets/js/modernizr/css-scrollbars.js"></script>
    <script type="text/javascript" src="assets/js/common-pages.js"></script>

    <script language = "text/Javascript"> 
      cleared[0] = cleared[1] = cleared[2] = 0; 
      function clearField(t){                  
      if(! cleared[t.id]){                
          cleared[t.id] = 1; 
          t.value='';       
          t.style.color='#fff';
          }
      }
    </script>

  </body>
</html>