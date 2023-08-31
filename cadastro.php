<?php
function limpar_texto($str)
{
  return preg_replace("/[^0-9]/", "", $str);
}


if (count($_POST) > 0) {

  include('lib/conexao.php');


  $erro = false;
  $cnpj = $mysqli->escape_string($_POST['cnpj']);
  $nome_jur = $mysqli->escape_string($_POST['nome_jur']);
  $email = $mysqli->escape_string($_POST['email']);
  $confirmar_email = $mysqli->escape_string($_POST['confirmar_email']);
  $senha_descriptografada = $mysqli->escape_string($_POST['senha']);
  $confirmar_senha = $mysqli->escape_string($_POST['confirmar_senha']);

  $email_valido = "SELECT * FROM usuarios WHERE email = '$email'";
  $cnpj_valido = "SELECT * FROM usuarios WHERE cnpj = '$cnpj'";

  $email_certo = $mysqli->query($email_valido) or die($mysqli->error);
  $cnpj_certo = $mysqli->query($cnpj_valido) or die($mysqli->error);

  if ($senha_descriptografada != $confirmar_senha) {
    $erro = "As senhas devem ser iguais.";
  }
  if ($confirmar_email != $email) {
    $erro = "Os e-mails devem ser iguais";
  }
  if (strlen($senha_descriptografada) < 6 || strlen($senha_descriptografada) > 16) {
    $erro = "A senha deve ter entre 6 e 16 caracteres.";
  }
  if (empty($cnpj)) {
    $erro = "Preencha o cnpj";
  }
  if (empty($nome_jur)) {
    $erro = "Preencha o nome";
  }
  if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erro = "Preencha o e-mail";
  }
  if ($email_certo->num_rows != 0 || $cnpj_certo->num_rows != 0) {
    $erro = "Email ou CNPJ já cadastrados";
  }
  if ($erro) {
    $erro = $erro;
  } else {
    $senha = password_hash($senha_descriptografada, PASSWORD_DEFAULT);
    $sql_code = "INSERT INTO usuarios (cnpj, nome_jur, email, senha, data_cadastro) 
        VALUES ('$cnpj','$nome_jur', '$email', '$senha', NOW())";
    $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
    unset($_POST);
    header("Location: entrar.php");
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
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
    rel="stylesheet">

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
  <!-- Google font-->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
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
          <!--<ul class="left-info">
            <li><i class="fa fa-clock-o"></i>Segunda à Sexta das 09:00 à 17:00</li>
            <li><i class="fa fa-phone"></i>(65) 99981 - 4804</li>
          </ul>-->
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
        <a class="navbar-brandi pr-0 mr-sm-1" href="index.html">
          <h2>Assessoria para Condomínios</h2>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
          aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.html"><i class="fa fa-home"></i>&nbsp;&nbsp;Principal
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="sobre.html"><i class="fa fa-book"></i>&nbsp;&nbsp;Sobre
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
          <div class="signup-card card-block auth-body mr-auto ml-auto">
            <form class="md-float-material" method="POST" action="">
              <div class="text-center">
              </div>
              <div class="auth-box">
                <div class="row m-b-20">
                  <div class="col-md-12">
                    <h3 class="text-center txt-primary">Cadastre a Pessoa Jurídica do Condomínio.</h3>
                  </div>

                </div>
                <hr />
                <?php if (isset($erro) && $erro !== 0) {
                  ?>
                  <div class="alert alert-danger" role="alert">
                    <?php echo $erro; ?>
                  </div>
                  <?php
                }
                ?>

                <div class="row">
                  <div class="col-sm-8">
                    <div class="input-group ">
                      <input id="inputCNPJ" type="text" value="<?php if (isset($_POST['cnpj']))
                        echo $_POST['cnpj']; ?>"
                        class="form-control" name="cnpj" maxlength="18" placeholder="00.000.000/0000-00">
                    </div>

                  </div>
                  <div class="col-sm-4">
                    <button type="button" onclick="validarCNPJClick()"
                      class="w-100 btn green-btn btn-md btn-block waves-effect text-center m-b-20">Verificar
                      CNPJ</button>
                  </div>

                  <span class="md-line"></span>
                </div>
                <div>
                  <p id="timerValidation"></p>
                </div>
                <div class="input-group">
                  <input id="inputRazaoSocial" type="text"
                    value="<?php if (isset($_POST['nome_jur']))
                      echo $_POST['nome_jur']; ?>" name="nome_jur"
                    class="form-control" placeholder="Nome da empresa">
                  <span class="md-line"></span>
                </div>
                <div class="input-group">
                  <input type="text" value="<?php if (isset($_POST['email']))
                    echo $_POST['email']; ?>" name="email"
                    class="form-control" placeholder="Escolha o endereço de E-mail">
                  <span class="md-line"></span>
                </div>
                <div class="input-group">
                  <input type="text"
                    value="<?php if (isset($_POST['confirmar_email']))
                      echo $_POST['confirmar_email']; ?>"
                    name="confirmar_email" class="form-control" placeholder="Confirme o endereço de E-mail">
                  <span class="md-line"></span>
                </div>
                <div class="input-group">
                  <input type="password" value="" name="senha" class="form-control" placeholder="Escolha sua senha">
                  <span class="md-line"></span>
                </div>
                <div class="input-group">
                  <input type="password" value="" name="confirmar_senha" class="form-control"
                    placeholder="Confirme sua senha">
                  <span class="md-line"></span>
                </div>
                <div class="input-group hidden_receita">
                  <input id="inputMunicipio" type="text" value="" name="municipio_jur" class="form-control"
                    placeholder="inputMunicipio">
                  <span class="md-line"></span>
                </div>
                <div class="input-group hidden_receita">
                  <input id="inputUF" type="text" value="" name="uf_jur" class="form-control" placeholder="inputUF">
                  <span class="md-line"></span>
                </div>
                <div class="input-group hidden_receita">
                  <input id="inputEndereco" type="text" value="" name="endereco_jur" class="form-control"
                    placeholder="inputEndereco">
                  <span class="md-line"></span>
                </div>
                <div class="input-group hidden_receita">
                  <input id="inputCep" type="text" value="" name="cep_jur" class="form-control" placeholder="inputCep">
                  <span class="md-line"></span>
                </div>

                <div class="row m-t-30">
                  <div class="col-md-12">
                    <button type="submit" class="green-btn btn btn-lg btn-block text-center m-b-20">Concluir
                      cadastro</button>
                  </div>
                </div>
                <hr />
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
  <!-- Parceiros
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
  </div> -->

  <!-- Footer
  <footer>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-4 text-center"><img class="footer-img" src="assets/images/PJE.jpg"></div>
        <div class="col-4 text-center"><img class="footer-img" src="assets/images/logoSTF.png"></div>
        <div class="col-4 text-center"><img class="footer-img" src="assets/images/logoSTJ.jpg"></div>
      </div>
    </div>
  </footer> -->
  <div class="sub-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <p>© 2022 BNL Assessoria. Todos direitos reservados.</p>
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

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
  <script type="text/javascript" src="assets/js/mascaras.js"></script>

  <script language="text/Javascript">
    cleared[0] = cleared[1] = cleared[2] = 0;

    function clearField(t) {
      if (!cleared[t.id]) {
        cleared[t.id] = 1;
        t.value = '';
        t.style.color = '#fff';
      }
    }
  </script>
  <script>
    $(document).ready(function () {
      $(".hidden_receita").hide();
    });
  </script>
  <!--Script local-->
  <script type="text/javascript" src="assets/js/services/validationCNPJ.js"></script>


</body>

</html>