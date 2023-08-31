<?php
include("lib/conexao.php");
include("lib/enviarArquivo.php");
include('lib/protect.php');
protect(1);

if (isset($_POST['enviar'])) {

    $cnpj = $mysqli->escape_string($_POST['cnpj']);
    $nome = $mysqli->escape_string($_POST['nome_jur']);
    $email = $mysqli->escape_string($_POST['email']);
    $creditos = $mysqli->escape_string($_POST['credito']);
    $senha = $mysqli->escape_string($_POST['senha']);
    $rsenha = $mysqli->escape_string($_POST['rsenha']);
    $admin = $mysqli->escape_string($_POST['admin']);

    $erro = array();
    if (empty($nome))
        $erro[] = "Preencha o nome";

    if (empty($email))
        $erro[] = "Preencha o e-mail";

    if (empty($creditos))
        $creditos = 0;

    if (empty($senha))
        $erro[] = "Preencha a senha";

    if ($rsenha != $senha)
        $erro[] = "As senhas não batem";

    if (count($erro) == 0) {

        $senha = password_hash($senha, PASSWORD_DEFAULT);
        $mysqli->query("INSERT INTO usuarios (cnpj, nome_jur, email, senha, credito, admin, data_cadastro) VALUES(
            '$cnpj', 
            '$nome', 
            '$email', 
            '$senha',
            '$creditos',
            '$admin',
             NOW()
        )");
        die("<script>location.href=\"painel.php?p=gerenciar_usuarios\";</script>");
    }
}

?>
<!-- Page-header start -->
<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-6">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>Cadastrar Usuário</h4>
                    <span>Preencha as informações e clique em Salvar</span>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="painel.php">
                            <i class="icofont icofont-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="painel?p=gerenciar_usuarios">
                            Gerenciar Usuário
                        </a>
                    </li>
                    <li class="breadcrumb-item">Cadastrar Usuário</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Page-header end -->

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <?php if (isset($erro) && count($erro) > 0) {
            ?>
                <div class="alert alert-danger" role="alert">
                    <?php foreach ($erro as $e) {
                        echo "$e<br>";
                    } ?>
                </div>
            <?php
            }
            ?>

            <div class="card">
                <div class="card-header">
                    <h5>Formulário de Cadastro</h5>
                </div>
                <div class="card-block">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">CNPJ</label>
                                    <input id="inputCNPJ" type="text" name="cnpj" class="form-control" maxlength="15" placeholder="00.000.000/0000-00">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Nome</label>
                                    <input id="inputRazaoSocial" type="text" name="nome_jur" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">E-mail</label>
                                    <input type="text" name="email" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Créditos</label>
                                    <input type="text" name="credito" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Senha</label>
                                    <input type="text" name="senha" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Repita a senha</label>
                                    <input type="text" name="rsenha" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Tipo</label>
                                    <select name="admin" class="form-control">
                                        <option value="0">Usuário</option>
                                        <option value="1">Admin</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <a href="painel.php?p=gerenciar_usuarios" class="btn btn-primary btn-round"><i class="ti-arrow-left"></i> Voltar</a>
                                <button type="submit" name="enviar" value="1" class="btn btn-success btn-round float-right"><i class="ti-save"></i> Salvar</button>
                            </div>
                        </div>
                    </form>
                    <!-- Bootstrap core JavaScript -->
                    <script src="vendor/jquery/jquery.min.js"></script>
                    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                    <!-- Scripts Adicionais -->
                    <script src="assets/js/custom.js"></script>
                    <script src="assets/js/owl.js"></script>
                    <script src="assets/js/slick.js"></script>
                    <script src="assets/js/accordions.js"></script>

                    <script type="text/javascript" src="../assets/js/jquery/jquery.min.js"></script>
                    <script type="text/javascript" src="../assets/js/jquery-ui/jquery-ui.min.js"></script>
                    <script type="text/javascript" src="../assets/js/popper.js/popper.min.js"></script>
                    <script type="text/javascript" src="../assets/js/bootstrap/js/bootstrap.min.js"></script>
                    <!-- jquery slimscroll js -->
                    <script type="text/javascript" src="../assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>
                    <!-- modernizr js -->
                    <script type="text/javascript" src="../assets/js/modernizr/modernizr.js"></script>
                    <script type="text/javascript" src="../assets/js/modernizr/css-scrollbars.js"></script>
                    <script type="text/javascript" src="../assets/js/common-pages.js"></script>
                    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
                    <script type="text/javascript" src="../assets/js/services/validationCNPJ.js"></script>
                    <script type="text/javascript" src="../assets/js/mascaras.js"></script>
                </div>
            </div>
        </div>
    </div>
</div>