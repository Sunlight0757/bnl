<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<?php
/*include("lib/conexao.php");
include("lib/enviarArquivo.php");
include('lib/protect.php');*/
$passo = false;
//protect(0);
$iduniq = false;


if (!$_POST) {
    if (!$iduniq) {
        $passo = false;
        $id_random = rand(62, 62);
        $iduniq = substr(str_shuffle("AaBbCcDdEeFfGgHhIiJjKkLlMmNnPpQqRrSsTtUuVvYyXxWwZz0123456789"), 0, $id_random);
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $request = md5(implode($_POST));
    if (isset($_SESSION['last_request']) && $_SESSION['last_request'] == $request) {
        die("<script>location.href=\"painel.php?p=gerenciar_acoes\";</script>"); // Método temporario
    } else {
        $_SESSION['last_request'] = $request;
    }
}

if (isset($_POST['enviar'])) {

    $titulo = $mysqli->escape_string($_POST['titulo']);
    $unidade = $mysqli->escape_string($_POST['unidade']);
    $edificio = $mysqli->escape_string($_POST['edificio']);
    $cartorio_registro = $mysqli->escape_string($_POST['cartorio_registro']);
    $matricula = $mysqli->escape_string($_POST['matricula']);
    $livrofls = $mysqli->escape_string($_POST['livrofls']);
    $obs = $mysqli->escape_string($_POST['obs']);
    $iduniq = $mysqli->escape_string($_POST['iduniq']);

    $erro = array();
    if (empty($unidade)) {
        $erro[] = "Preencha a unidade";
    }
    if (empty($edificio)) {
        $erro[] = "Preencha o edificio";
    }
    if (empty($cartorio_registro)) {
        $erro[] = "Preencha o cartorio de registro";
    }
    if (empty($matricula)) {
        $erro[] = "Preencha o número da matrícula";
    }
    if (empty($livrofls)) {
        $erro[] = "Preencha o livro e fls";
    }
    if (count($erro) == 0) {




        $sql_code = "INSERT INTO dados_acoes (id, titulo, unidade, edificio, cartorio_registro, matricula, livrofls, obs, data_inicial, passo_processo, iduniq) VALUES(

                '$id',
                '$titulo',
                '$unidade',
                '$edificio',
                '$cartorio_registro',
                '$matricula',
                '$livrofls',
                '$obs',
                NOW(),

                '2',
                '$iduniq')";


        $inserido = $mysqli->query($sql_code);
        if (!$inserido) {
            $erro[] = "Falha ao inserir no banco de dados: " . $mysqli->error;
        } else {
            $passo = "2";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    <title>BNL - Assessoria jurídica para condomínios</title>

    <!-- Bootstrap CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS Adicional -->
    <link rel="stylesheet" href="assets/css/templatebml.css">
    <link rel="stylesheet" href="assets/css/owl.css">
</head>

<body>
    <iframe src="http://localhost:8004/cpj-connect/#/" frameborder="2" width="1200" height="620" ></iframe>

   <!-- <div class="imovel card">

    <a href="http://localhost:8004/cpj-connect/#/">CPJ3C</a>

        <div class="imovel card-header">
        <h5>O valor da certidão e o prazo para entrega variam de acordo com a tabela de custas aprovada em cada estado e pela legislação local.</h5>

            <h3>Preencha os dados do imóvel:</h3>
        </div>
        <div class="imovel card-block">
            <form class="imovel" action="" method="POST" enctype="multipart/form-data">
                <div class="imovel row">
                    <div class="imovel imovel col-lg-5">
                        <div class="imovel form-group">
                            <label for="">Titulo da ação:</label>
                            <input type="text" name="titulo" class="form-control">
                        </div>
                    </div>
                    <div class="imovel col-lg-5">
                        <div class="imovel form-group">
                            <label for="">Unidade:</label>
                            <input type="text" name="unidade" class="form-control">
                        </div>
                    </div>
                    <div class="imovel col-lg-5">
                        <div class="imovel form-group">
                            <label for="">Edifício:</label>
                            <input type="text" name="edificio" class="form-control">
                        </div>
                    </div>
                    <div class="imovel col-lg-5">
                        <div class="imovel form-group">
                            <label for="">Cartório do registro:</label>
                            <input type="text" name="cartorio_registro" class="form-control">
                        </div>
                    </div>
                    <div class="imovel col-lg-5">
                        <div class="imovel form-group">
                            <label for="">Cidade:</label>
                            <input type="text" name="cidade_registro" class="form-control">
                        </div>
                    </div>


                    <div class="imovel col-lg-5">
                        <div class="imovel form-group">
                            <label for="">Número da matrícula</label>
                            <input type="text" name="matricula" class="form-control">
                        </div>
                    </div>
                    <div class="imovel col-lg-5">
                        <div class="imovel form-group">
                            <label for="">Livro e fls</label>
                            <input type="text" name="livrofls" class="form-control">
                        </div>
                    </div>
                    <div class="imovel col-lg-12">
                        <div class="form-group">
                            <label for="">Observação:</label>
                            <textarea name="obs" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="id_randomizer col-lg-5">
                        <div class="id_randomizer form-group">
                            <label for="">Id:</label>
                            <input type="text" value="<?php echo $iduniq ?>" name="iduniq" class="form-control">
                        </div>
                    </div>

                    <div class="imovel col-lg-3">
                        <a href="index.php?p=gerenciar_cursos" class="imovel btn btn-primary btn-round"><i
                                class="ti-arrow-left"></i> Voltar</a>
                        <button type="submit" name="enviar" value="1"
                            class="imovel btn btn-success btn-round float-right"><i class="ti-save"></i> Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    -->

</body>

</html>