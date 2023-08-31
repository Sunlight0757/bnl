<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<?php
include("lib/conexao.php");
include("lib/enviarArquivo.php");
include('lib/protect.php');
$passo = false;
protect(0);


if (!$_POST) {
    $passo = false;
    $id_random = rand(62, 62);
    $iduniq = substr(str_shuffle("AaBbCcDdEeFfGgHhIiJjKkLlMmNnPpQqRrSsTtUuVvYyXxWwZz0123456789"), 0, $id_random);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $request = md5(implode($_POST));
    if (isset($_SESSION['last_request']) && $_SESSION['last_request'] == $request) {
        die("<script>location.href=\"painel.php?p=gerenciar_acoes\";</script>"); // Método temporario
    } else {
        $_SESSION['last_request']  = $request;
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

if (isset($_POST['enviar2'])) {

    $periodo_inicio = $mysqli->escape_string($_POST['periodo_inicio']);
    $valor_devido = $mysqli->escape_string($_POST['valor_devido']);
    $meses_devido = $mysqli->escape_string($_POST['meses_devido']);
    $multa = $mysqli->escape_string($_POST['multa']);
    $honorarios = $mysqli->escape_string($_POST['honorarios']);
    $iduniq = $mysqli->escape_string($_POST['iduniq']);

    $erro = array();
    if (empty($periodo_inicio)) {
        $erro[] = "Preencha o período";
    }
    if (empty($valor_devido)) {
        $erro[] = "Preencha o valor devido";
    }
    if (empty($meses_devido)) {
        $erro[] = "Preencha a quantidade de meses devido";
    }
    if (empty($honorarios)) {
        $erro[] = "Preencha a multa contratual";
    }
    if (empty($multa)) {
        $erro[] = "Preencha os honorários contratuais";
    }
    if (count($erro) == 0) {


        $sql_code = "UPDATE dados_acoes SET periodo_inicio = '$periodo_inicio', valor_devido = '$valor_devido', meses_devido = '$meses_devido' ,
         multa = '$multa', honorarios = '$honorarios', passo_processo = '3' WHERE iduniq = '$iduniq'";
        $inserido = $mysqli->query($sql_code);
        if (!$inserido) {
            $erro[] = "Falha ao inserir no banco de dados: " . $mysqli->error;
        } else {
            $passo = "3";
        }
    }
}



$sql_query = $mysqli->query("SELECT * FROM usuarios WHERE id = '$id'") or die($mysqli->error);
$usuario = $sql_query->fetch_assoc();
?>
<!-- Page-header start -->
<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-6">
            <div class="page-header-title">

                <div class="d-inline"><?php if ($passo < 2) { ?>
                        <h4>Montar ação - Passo 1</h4><?php } ?>
                    <?php if ($passo == 2) { ?>
                        <h4>Montar ação - Passo 2</h4><?php } ?>

                    <span>Preencha as informações e clique em Salvar</span>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
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
                    <h5>Informações do representante jurídico</h5>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Nome: </label><br><?php echo $usuario['nome_jur']; ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">E-mail: </label><br><?php echo $usuario['email']; ?>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">CNPJ: </label><br><?php echo $usuario['cnpj']; ?>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="imovel card">
                <div class="imovel card-header">
                    <h5>Formulário - Preencha com os dados do imóvel:</h5>
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
                            <div class="imovel col-lg-12">
                                <a href="index.php?p=gerenciar_cursos" class="imovel btn btn-primary btn-round"><i class="ti-arrow-left"></i> Voltar</a>
                                <button type="submit" name="enviar" value="1" class="imovel btn btn-success btn-round float-right"><i class="ti-save"></i> Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>



            <div class="descumpridocheckbox card">
                <div class="card-header">

                    <h5>Existe acordo descumprido?</h5>
                    <input name="tipo" id="descumprido" value="sim" type="checkbox">&nbsp;Sim
                    <div class="proximo"><br>
                        <hr>
                        <h5>Clique no botão abaixo para dar seguimento se não existir acordo descumprido</h5>
                        <hr>
                    </div>

                    <div class="col-lg-12">
                        <a href="painel.php" class="proximo btn btn-success btn-round"><i class="ti-arrow-right"></i> Próximo Passo</a>
                    </div>

                </div>
            </div>

            <div class="descumprido card">
                <div class="card-header">
                    <h5>Preencha os dados referente ao acordo descumprido</h5>
                </div>
                <div class="card-block">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="">Período do crédito</label>
                                    <input type="text" name="periodo_inicio" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="">Valor devido</label>
                                    <input type="text" name="valor_devido" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="">Meses devido</label>
                                    <input type="text" name="meses_devido" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="">Multa contratual</label>
                                    <input type="text" name="multa" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="">Honorarios contratuais</label>
                                    <input type="text" name="honorarios" class="form-control">
                                </div>
                            </div>
                            <div class="id_randomizer col-lg-5">
                                <div class="id_randomizer form-group">
                                    <label for="">Id:</label>
                                    <input type="text" value="<?php echo $iduniq ?>" name="iduniq" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" name="enviar2" class="btn btn-success btn-round"><i class="ti-save"></i> Salvar</button>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>

<?php if ($passo < 2) { ?>
    <script>
        $(document).ready(function() {
            $(".descumprido").hide();
            $(".descumpridocheckbox").hide();
        });
    </script>
<?php } ?>


<?php if ($passo == 2) { ?>
    <script>
        $(document).ready(function() {
            $(".descumprido").hide();
        });

        $("input:checkbox[name=tipo]").on("change", function() {
            if ($(this).is(':checked')) {
                $(".descumprido ").show();
                $(".proximo ").hide();
            } else {
                $(".descumprido ").hide();
                $(".proximo ").show();
            }
        });
        <?php
    } ?>
    </script>

    <?php if ($passo == 2) { ?>
        <script>
            $(document).ready(function() {
                $(".imovel").hide();
            });
        </script>
    <?php
    } ?>
    <script>
        $(document).ready(function() {
            $(".id_randomizer").hide();
        });
    </script>
