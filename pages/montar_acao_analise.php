<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<?php
include("lib/conexao.php");
include("lib/enviarArquivo.php");
include('lib/protect.php');
protect(1);

$error = false;


if (isset($_GET['id'])) {
    $iduniq = $_GET['id'];
    $id_usuario = $_GET['id_usuario'];
    $_SESSION['id_externo'] = $id_usuario;
    $sql_query = $mysqli->query("SELECT * FROM dados_acoes WHERE iduniq = '$iduniq' AND id = '$id_usuario'") or die($mysqli->error);
    $passos = $sql_query->fetch_assoc();
} else {
    die("<script>location.href=\"painel.php?p=gerenciar_acoes\";</script>");
}


//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//   $request = md5(implode($_POST));
//   if (isset($_SESSION['last_request']) && $_SESSION['last_request'] == $request) {
//      die("<script>location.href=\"painel.php?p=gerenciar_acoes\";</script>"); // Método temporario
//  } else {
//      $_SESSION['last_request']  = $request;
//  }
//}

$sql_query = $mysqli->query("SELECT * FROM usuarios WHERE id = '$id_usuario'") or die($mysqli->error);
$usuario = $sql_query->fetch_assoc();


$sql_reus = "SELECT * FROM reus WHERE iduniq='$iduniq'";
$sql_query2 = $mysqli->query($sql_reus) or die($mysqli->error);
$sql_query_conferencia = $mysqli->query($sql_reus) or die($mysqli->error);
$num_reus = $sql_query2->num_rows;
$num_reus_conferencia = $sql_query_conferencia->num_rows;

$sql_arquivo_especifico = "SELECT * FROM arquivos WHERE idprocesso='$iduniq' AND tipo_documento='1'";
$sql_query_especifico = $mysqli->query($sql_arquivo_especifico) or die($mysqli->error);
$num_arquivo_especifico = $sql_query_especifico->num_rows;

$sql_arquivo_conferencia = "SELECT * FROM arquivos WHERE id_usuario='$id_usuario' AND tipo_documento='0'";
$sql_query_conferencia2 = $mysqli->query($sql_arquivo_conferencia) or die($mysqli->error);
$num_arquivo_conferencia = $sql_query_conferencia2->num_rows;

$sql_arquivo_especifico_conferencia = "SELECT * FROM arquivos WHERE idprocesso='$iduniq' AND tipo_documento='1'";
$sql_query_especifico_conferencia = $mysqli->query($sql_arquivo_especifico_conferencia) or die($mysqli->error);
$num_arquivo_especifico_conferencia = $sql_query_especifico_conferencia->num_rows;

$sql_query_imovel_conferencia = "SELECT * FROM dados_acoes WHERE iduniq = '$iduniq'";
$dados_imovel_conferencia_query = $mysqli->query($sql_query_imovel_conferencia) or die($mysqli->error);
$num_dados_imovel_query = $dados_imovel_conferencia_query->num_rows;

$sql_dados_usuario = "SELECT * FROM usuarios WHERE id = '$id_usuario'";
$sql_query_dados_usuario = $mysqli->query($sql_dados_usuario) or die($mysqli->error);

$sql_dados_adicionais = "SELECT * FROM dados_adicionais WHERE id_usuario = '$id_usuario'";
$sql_query_dados_adicionais = $mysqli->query($sql_dados_adicionais) or die($mysqli->error);

$outorgante_0 = $sql_query_dados_usuario->fetch_assoc();
$outorgante_1 = $sql_query_dados_adicionais->fetch_assoc();
?>
<section>
    <div class="page-body">
        <div class="row">
            <div class="card col-sm-12">
                <div class="card shadow-none">
                    <div class="card-header">
                        <label for="mostrar_contrato">
                            <h4>Dados complementares</h4>
                        </label>
                        <input type="checkbox" name="mostrar_contrato" id="mostrar_contrato" value="1">
                    </div>
                    <form action="painel.php?p=contrato" method="post">
                        <div class="contrato">
                            <div>
                                <div>
                                    <!------------------------------------------ INPUT PARA FORMA DE PAGAMENTO ----------------------------->
                                    <div>
                                        <div id="sexo" class="shadow-sm p-3 mb-3 bg-body rounded"> 
                                            <h5 class="subtitulo mb-3"> Gênero </h5>
                                            <input type="radio" name="tsexo" id="Masc" value="o" checked> <label for="Masc">Masculino</label>
                                            <input type="radio" name="tsexo" id="Fem" value="a"> <label for="Fem">Feminino</label>
                                        </div>
                                        <div class="shadow-sm p-3 mb-3 bg-body rounded">
                                            <div class="mb-3">
                                                <label for="spf">
                                                    <h5> Parte fixa </h5>
                                                </label>
                                                <input type="checkbox" name="sempartefixa" id="spf" checked>
                                            </div>
                                            <div class="partefixatotal">
                                                <div class="input-group mb-3">
                                                    <label class="input-group-text" for="fixa">
                                                        <strong>Valor total (parte fixa): </strong>
                                                    </label>
                                                    <input class="entradas form-control" type="text" name="valortotal" id="fixa" size="10" style="max-width: 200px;">
                                                    <label class="input-group-text" for="valorextensofixa">
                                                        Valor por extenso:
                                                    </label>
                                                    <input name="totalporextenso" type="text" class="entradas form-control" id="valorextensofixa" size="40" value="" style="max-width: 200px;">
                                                </div>
                                                <p class="mb-3">
                                                    <strong>Forma de Pagamento:</strong>
                                                    <input type="radio" name="pagamento" id="vista" value="1">
                                                    <label for="vista">à vista</label>
                                                    <input type="radio" name="pagamento" id="parcela" value="2">
                                                    <label for="parcela"> parcelado </label>
                                                    <input type="radio" name="pagamento" id="fase" value="3">
                                                    <label for="fase">por fase processual</label>
                                                </p>

                                                <!------------------------------------------ FORMULARIO DE PAGAMENTO A VISTA -------------------------->


                                                <!--<form name="pagamentovista" id="pagavista" >-->

                                                <div class="paganoato input-group" id="paganoato" style="margin-bottom: 0px;">
                                                    <div class="form-check mt-2" style="padding-left: 0px;">
                                                        <span class="subtitulo form-check-label">
                                                            Pagamento na data da assinatura do contrato?
                                                        </span>
                                                    </div>
                                                    <div class="form-check mt-2">
                                                        <input type="radio" name="dtapga" id="yespga" value="spga" checked>
                                                        <label class="form-check-label" for="yespga">Sim</label>
                                                    </div>
                                                    <div class="form-check mt-2">
                                                        <input type="radio" name="dtapga" id="nopga" value="npga">
                                                        <label class="form-check-label" for="nopga">Não</label>
                                                    </div>
                                                    <div class="opcaonao form-check" style="margin-bottom: 0px;">
                                                        <div class="input-group">
                                                            <label class="input-group-text" for="dtapagavista">Data do pagamento</label>
                                                            <input name="datavista" type="text" class="entradas form-control" id="dtapagavista" size="10" style="max-width: 150px;">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--</form>-->

                                                <!---------------------------------------------------- FORMULARIO DAS PARCELAS ---------------------------------	-->

                                                <!--<form name="pagamentoparcelado" id="pagaparcela">-->
                                                <div class="parcela mt-3">
                                                    <div>
                                                        <p><strong>Parcelas</strong></p>
                                                        <div class="input-group mb-3">
                                                            <label class="input-group-text" for="entrada"> Valor da entrada: </label>
                                                            <input name="valorentrada" type="text" class="entradas form-control" id="entrada" size="10" style="max-width: 200px;">
                                                            <label class="input-group-text" class="input-group-text" for="valorextenso"> Valor por extenso:</label>
                                                            <input name="porextensoentrada" type="text" class="entradas form-control" id="valorextensoentrada" size="60" value="" style="max-width: 200px;"> <br>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <label class="input-group-text" for="dataentrada"> Data de pagamento da entrada</label>
                                                            <input name="datadaentrada" type="text" class="entradas form-control" id="dataentrada" size="6" style="max-width: 200px;"> <br>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <label class="input-group-text" for="numparcelas">Quantidade de parcelas</label>
                                                            <input name="qtdeparcelas" type="text" class="entradas form-control" id="numparcelas" size="1" style="max-width: 200px;">
                                                            <label class="input-group-text" for="valorparcela"> Valor de uma parcela </label>
                                                            <input name="valparcela" type="text" class="entradas form-control" id="valorparcela" size="10" value="" style="max-width: 200px;">
                                                            <br>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <label class="input-group-text" for="valorextenso"> Valor por extenso</label> <input name="porextensoparcela" type="text" class="entradas form-control" id="valorextensoparcela" size="60" value="" style="max-width: 200px;"> <br>
                                                        </div>
                                                        <div class="periodoparcela" id="periodicidade">
                                                            <p> <strong>Periodicidade</strong>:
                                                                &nbsp;&nbsp;&nbsp;
                                                                <label><input type="radio" name="RadioGroup1" value="mensal" id="RadioGroup1_1" checked>
                                                                    Mensal</label>
                                                                &nbsp;&nbsp;&nbsp;
                                                                <label><input type="radio" name="RadioGroup1" value="outra" id="RadioGroup1_3">
                                                                    outra</label>
                                                                <br>
                                                            <div class="input-group mb-3">
                                                                <label class="input-group-text" for="diaparcela"> todo dia </label> <input type="text" class="entradas form-control" name="diadaparcela" id="diaparcela" size="1" style="max-width: 200px;"> <label class="input-group-text" for="diaparcela"> de cada
                                                                    mês, a partir de </label> <input type="text" name="parcelainicial" class="entradas form-control" size="6" style="max-width: 200px;"> <label class="input-group-text" for="diaparcela"> até </label> <input type="text" name="parcelafinal" class="entradas form-control" size="6" style="max-width: 200px;">.
                                                            </div>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <!--</form>-->


                                                <!-- ------------------------------------- FORMULARIO DE PAGAMENTO POR FASE PROCESSUAL ----------------------------- -->

                                                <div class="faseprocesso">
                                                    <div>
                                                        <p><strong>Pagamento por fase processual</strong></p>
                                                        <p>
                                                        <div class="input-group mb-0 d-flex justify-content-between" style="max-width: 350px; max-height: 40px;">
                                                            <label class="form-check mt-2" style="padding: 0px;">
                                                                <input type="checkbox" class="FasesProcessuaus" value="6" name="FasesProcessuaus_6">
                                                                Procuração
                                                            </label>
                                                            <a class="valorfase6 form-check">
                                                                <div class="input-group">
                                                                    <label class="input-group-text" for="valorfase6">Valor:</label>
                                                                    <input class="form-control" type="text" id="valorfase6" name="valorfase6" style="max-width: 100px">
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="input-group mb-0 d-flex justify-content-between" style="max-width: 350px; max-height: 40px;">
                                                            <label class="form-check mt-2" style="padding: 0px;">
                                                                <input type="checkbox" class="FasesProcessuaus" value="0" name="FasesProcessuaus_0">
                                                                Protocolo
                                                            </label>
                                                            <a class="valorfase0 form-check">
                                                                <div class="input-group">
                                                                    <label class="input-group-text" for="valorfase0">Valor:</label>
                                                                    <input class="form-control" type="text" id="valorfase0" name="valorfase0" style="max-width: 100px">
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="input-group mb-0 dflex justify-content-between" style="max-width: 350px; max-height: 40px;">
                                                            <label class="form-check mt-2" style="padding: 0px;">
                                                                <input type="checkbox" class="FasesProcessuaus" value="1" name="FasesProcessuaus_1">
                                                                Audiência de Instrução
                                                            </label>
                                                            <a class="valorfase1 form-check">
                                                                <div class="input-group">
                                                                    <label class="input-group-text" for="valorfase1">Valor:</label>
                                                                    <input class="form-control" type="text" id="valorfase1" name="valorfase1" style="max-width: 100px">
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="input-group mb-0 dflex justify-content-between" style="max-width: 350px; max-height: 40px;">
                                                            <label class="form-check mt-2" style="padding: 0px;">
                                                                <input type="checkbox" class="FasesProcessuaus" value="2" name="FasesProcessuaus_2">
                                                                Perícia
                                                            </label>
                                                            <a class="valorfase2 form-check">
                                                                <div class="input-group">
                                                                    <label class="input-group-text" for="valorfase2">Valor:</label>
                                                                    <input class="form-control" type="text" id="valorfase2" name="valorfase2" style="max-width: 100px">
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="input-group mb-0 dflex justify-content-between" style="max-width: 350px; max-height: 40px;">
                                                            <label class="form-check mt-2" style="padding: 0px;">
                                                                <input type="checkbox" class="FasesProcessuaus" value="3" name="FasesProcessuaus_3">
                                                                Recurso 2ª Instância
                                                            </label>
                                                            <a class="valorfase3 form-check">
                                                                <div class="input-group">
                                                                    <label class="input-group-text" for="valorfase3">Valor:</label>
                                                                    <input class="form-control valorfase" type="text" id="valorfase3" name="valorfase3" style="max-width: 100px">
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="input-group mb-0 dflex justify-content-between" style="max-width: 350px; max-height: 40px;">
                                                            <label class="form-check mt-2" style="padding: 0px;">
                                                                <input type="checkbox" class="FasesProcessuaus" value="4" name="FasesProcessuaus_4">
                                                                Recurso ao STJ
                                                            </label>
                                                            <a class="valorfase4 form-check">
                                                                <div class="input-group">
                                                                    <label class="input-group-text" for="valorfase4">Valor:</label>
                                                                    <input class="form-control valorfase" type="text" id="valorfase4" name="valorfase4" style="max-width: 100px">
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="input-group mb-0 dflex justify-content-between" style="max-width: 350px; max-height: 40px;">
                                                            <label class="form-check mt-2" style="padding: 0px;">
                                                                <input type="checkbox" class="FasesProcessuaus" value="5" name="FasesProcessuaus_5">
                                                                Recurso ao STF
                                                            </label>
                                                            <a class="valorfase5 form-check">
                                                                <div class="input-group">
                                                                    <label class="input-group-text" for="valorfase5">Valor:</label>
                                                                    <input class="form-control valorfase" type="text" id="valorfase5" name="valorfase5" style="max-width: 100px">
                                                                </div>
                                                            </a>
                                                        </div>
                                                        </p>
                                                    </div>
                                                </div>
                                                <!--</form>-->
                                            </div>
                                        </div>

                                        <!-- --------------------------------------------- Quadro da Parte Variavel - percentagem ----------------------------- -->

                                        <div class="shadow-sm p-3 mb-3 bg-body rounded">
                                            <div class="mb-3">
                                                <label for="spv">
                                                    <h5>Parte Variável</h5>
                                                </label>
                                                <input type="checkbox" name="sempartevariavel" value="1" id="spv" checked>
                                            </div>

                                            <!-- FORMULARIO DO PERCENTAGEM	-->

                                            <div class="partevariaveltotal">
                                                <div class="porcentual">
                                                    <div>
                                                        <p class="mb-3">
                                                            <strong>Porcentagem sobre o êxito</strong>
                                                        </p>
                                                        <div class="input-group mb-3">
                                                            <label class="input-group-text" for="percentual">Porcentagem [%]:</label>
                                                            <input name="prcthono" type="text" class="entradas form-control" id="percentual" size="1" value="" style="max-width: 200px;">
                                                            <label class="input-group-text" for="valorextensoporcento"> &nbsp;&nbsp;Porcentagem por extenso:</label>
                                                            <input name="porextenso" type="text" class="entradas form-control" id="valorextensoporcento" size="4" value="" style="max-width: 200px;">
                                                            <label class="input-group-text" for="valorextensoporcento">... por cento.</label>
                                                            <br>
                                                        </div>
                                                        <div class="datapagaporcento" id="pagaporcento">
                                                            <p>
                                                                <span class="subtitulo"> Pagamento na data do recebimento? </span>
                                                                <input type="radio" name="dtaporcento" id="yesporcento" value="s" checked>
                                                                <label for="yesporcento">Sim</label>
                                                                <input type="radio" name="dtaporcento" id="noporcento" value="n">
                                                                <label for="noporcento">Não</label>
                                                            </p>
                                                            <p class="prazopagapercentual input-group">
                                                                <label class="mr-3 mt-1" for="prazopagar">prazo do pagamento:
                                                                </label>
                                                                <input name="prazopagar" type="text" class="entradas form-control" id="prazopagar" size="1" value="05" style="max-width: 50px;">
                                                                <label class="input-group-text" for="prazopagar">... dias após o recebimento.</label>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="quadro shadow-sm p-3 mb-2 bg-body rounded">
                                            <div class="mb-3">
                                                <label for="novaclausula">
                                                    <h5>Cláusula extra</h5>
                                                </label>
                                                <input id="novaclausula" type="checkbox" name="novaclausula" value="1" />
                                            </div>
                                            <a class="clausula" id="newclause">
                                                <textarea class="form-control" name="clasulaextra" rows="3" placeholder="Cláusula extra 01."></textarea>.
                                            </a>
                                        </div>

                                        <!-- ---------------------------------------------------- FORMULARIO TESTEMUNHAS ----------------------------------------------    -->

                                        <div class="quadro shadow-sm p-3 mb-3 bg-body rounded">
                                            <div style="max-width: 700px;">
                                                <div class="mb-3">
                                                    <h5> Testemunhas </h5>
                                                </div>
                                                <div class="input-group">
                                                    <label class="input-group-text" for="testemunha1">1 - nome:</label>
                                                    <input class="form-control" type="text" name="test1" id="testemunha1" size="30">
                                                    <label class="input-group-text" for="cpftestemunha1">CPF:</label>
                                                    <input class="form-control" type="text" name="cpftest1" id="cpftestemunha1">
                                                </div>
                                                <div class="input-group">
                                                    <label class="input-group-text" for="testemunha2">2 - nome:</label>
                                                    <input class="form-control" type="text" name="test2" id="testemunha2" size="30">
                                                    <label class="input-group-text" for="cpftestemunha2">CPF:</label>
                                                    <input class="form-control" type="text" name="cpftest2" id="cpftestemunha2">
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <button id="gerarProcesso" class="imovel btn btn-success btn-round float-right">Contrato</button>
                            </div>
                        </div>
                    </form>
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button id="download-pdf-procuracao" class="imovel btn btn-success btn-round float-right">Procuração</button>

    <h3>Conferência dos dados da ação</h3>
    <hr>
    <div class="page-body">
        <div class="row">
            <div class="card col-sm-12">
                <div class="card shadow-none">
                    <div class="card-header">
                        <h4>Réus inseridos</h4>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nome do réu</th>
                                        <th>CPF</th>
                                        <th>Profissão</th>
                                        <th>CEP</th>
                                        <th>Estado</th>
                                        <th>Cidade</th>
                                        <th>Endereço</th>
                                    </tr>
                                </thead>
                                <?php if ($num_reus_conferencia == 0) { ?>
                                    <tr>
                                        <td colspan="5">Nenhum réu adicionado nesse processo</td>

                                    </tr>
                                    <?php } else {
                                    while ($reus_conferencia = $sql_query_conferencia->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $reus_conferencia['nome_reu']; ?></th>
                                            <td><?php echo $reus_conferencia['cpf_reu']; ?>
                                            <td><?php echo $reus_conferencia['profissao_reu']; ?>
                                            <td><?php echo $reus_conferencia['cep_reu']; ?>
                                            <td><?php echo $reus_conferencia['estado_reu']; ?>
                                            <td><?php echo $reus_conferencia['cidade_reu']; ?>
                                            <td><?php echo $reus_conferencia['endereco_reu']; ?>

                                        </tr>
                                <?php
                                    }
                                } ?>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="page-body">
        <div class="row">
            <div class="card col-sm-12">
                <div class="card-header">
                    <h4>Dados do imóvel</h4>
                </div>
                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table">

                            <thead>

                                <tr>
                    </div>
                    <?php ?>
                    <th>Unidade</th>
                    <th>Edifício</th>
                    <th>Cartório do registro</th>
                    <th>Número da matrícula</th>
                    <th>Livro e fls</th>
                    </thead>


                    <?php
                    $dados_imovel_conferencia = $dados_imovel_conferencia_query->fetch_assoc();
                    if (!$dados_imovel_conferencia['unidade'] || !$dados_imovel_conferencia['edificio'] || !$dados_imovel_conferencia['cartorio_registro'] || !$dados_imovel_conferencia['matricula'] || !$dados_imovel_conferencia['livrofls']) { ?>
                        <tr>
                            <td colspan="5">Nenhum imóvel inserido</td>
                        </tr>
                    <?php } else {



                    ?>


                        <tr>

                            <td><?php echo $dados_imovel_conferencia['unidade'] ?></td>
                            <td><?php echo $dados_imovel_conferencia['edificio'] ?></td>
                            <td><?php echo $dados_imovel_conferencia['cartorio_registro'] ?>
                            <td><?php echo $dados_imovel_conferencia['matricula'] ?>
                            <td><?php echo $dados_imovel_conferencia['livrofls'] ?>
                        </tr>

                    <?php } ?>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div class="page-body">
        <div class="row">
            <div class="card col-sm-12">
                <div class="card-header">
                    <h4>Dados do crédito</h4>
                </div>
                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table">

                            <thead>

                                <tr>
                    </div>
                    <?php ?>
                    <th>Data inicial</th>
                    <th>Data final</th>
                    <th>Valor devido</th>
                    <th>Meses totais devidos</th>
                    </thead>


                    <?php
                    if (!$dados_imovel_conferencia['periodo_inicio'] || !$dados_imovel_conferencia['periodo_final'] || !$dados_imovel_conferencia['valor_devido'] || !$dados_imovel_conferencia['meses_devido']) { ?>
                        <tr>
                            <td colspan="5">Nenhum cálculo de crédito inserido</td>
                        </tr>
                    <?php } else {



                    ?>


                        <tr>

                            <td><?php echo $dados_imovel_conferencia['periodo_inicio'] ?></td>
                            <td><?php echo $dados_imovel_conferencia['periodo_final'] ?></td>
                            <td><?php echo $dados_imovel_conferencia['valor_devido'] ?>
                            <td><?php echo $dados_imovel_conferencia['meses_devido'] ?>
                        </tr>

                    <?php } ?>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div class="page-body">
        <div class="row">
            <div class="card col-sm-12">
                <div class="card-header">
                    <h4>Documentação geral</h4>
                </div>
                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr><?php if ($error) {
                                    ?>
                                        <div class="alert alert-danger" role="alert">
                                        <?php
                                        echo "$error<br>";
                                    }
                                        ?>
                                        </div>
                                        <th>Título do arquivo</th>
                                        <th>Data de envio e Horário</th>
                                        <th>Extensão</th>
                                        <th>Tamanho</th>
                                        <th>Tipo</th>
                                </tr>
                            </thead>
                            <?php if ($num_arquivo_conferencia == 0) { ?>
                                <tr>
                                    <td colspan="5">Nenhuma arquivo enviado</td>
                                </tr>
                                <?php } else {
                                while ($arquivos_conferencia = $sql_query_conferencia2->fetch_assoc()) {


                                ?>
                                    <tr>
                                        <th scope="row"><a target="_blank" href="<?php echo $arquivos_conferencia['path']; ?>"><?php echo substr($arquivos_conferencia['nome_arquivo'], 0, 30); ?></a></th>
                                        <td><?php echo date("d/m/Y - H:i", strtotime($arquivos_conferencia['data_envio'])); ?></td>
                                        <td><?php echo $arquivos_conferencia['tipo']; ?>
                                        <td><?php echo substr($arquivos_conferencia['size'], 0, 3); ?>KB
                                        <td><?php echo $arquivos_conferencia['nome']; ?>
                                    </tr>
                            <?php

                                }
                            } ?>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <div class="page-body">
        <div class="row">
            <div class="card col-sm-12">
                <div class="card-header">
                    <h4>Documentação Específica</h4>
                </div>
                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr><?php if ($error) {
                                    ?>
                                        <div class="alert alert-danger" role="alert">
                                        <?php
                                        echo "$error<br>";
                                    }
                                        ?>
                                        </div>
                                        <th>Título do arquivo</th>
                                        <th>Data de envio e Horário</th>
                                        <th>Extensão</th>
                                        <th>Tamanho</th>
                                        <th>Tipo</th>
                                </tr>
                            </thead>
                            <?php if ($num_arquivo_especifico_conferencia == 0) { ?>
                                <tr>
                                    <td colspan="5">Nenhuma arquivo enviado</td>
                                </tr>
                                <?php } else {
                                while ($arquivos_especifico_conferencia = $sql_query_especifico_conferencia->fetch_assoc()) {


                                ?>
                                    <tr>
                                        <th scope="row"><a target="_blank" href="<?php echo $arquivos_especifico_conferencia['path']; ?>"><?php echo substr($arquivos_especifico_conferencia['nome_arquivo'], 0, 30); ?></a></th>
                                        <td><?php echo date("d/m/Y - H:i", strtotime($arquivos_especifico_conferencia['data_envio'])); ?></td>
                                        <td><?php echo $arquivos_especifico_conferencia['tipo']; ?>
                                        <td><?php echo substr($arquivos_especifico_conferencia['size'], 0, 3); ?>KB
                                        <td><?php echo $arquivos_especifico_conferencia['nome']; ?>
                                    </tr>
                            <?php

                                }
                            } ?>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>


    </div>


    </div>

</section>

<!-- Page-header start -->
<!-- Page-header end -->



</div>
</div>
</div>
</div>

<script>
    var nome_jur = "<?php echo $outorgante_0["nome_jur"]; ?>"
    var cnpj = "<?php echo $outorgante_0["cnpj"]; ?>"
    var endereco_condominio = "<?php echo $outorgante_1["endereco_condominio"]; ?>"
    var cidade_condominio = "<?php echo $outorgante_1["cidade_condominio"]; ?>"
    var estado_condominio = "<?php echo $outorgante_1["estado_condominio"]; ?>"
    var cep_condominio = "<?php echo $outorgante_1["cep_condominio"]; ?>"
    var nome_representante = "<?php echo $outorgante_1["nome_representante"]; ?>"
    var cpf_representante = "<?php echo $outorgante_1["cpf_representante"]; ?>"
    var nacionalidade_representante = "<?php echo $outorgante_1["nacionalidade_representante"]; ?>"
    var profissao_representante = "<?php echo $outorgante_1["profissao_representante"]; ?>"
    var endereco_representante = "<?php echo $outorgante_1["endereco_representante"]; ?>"
    var cidade_representante = "<?php echo $outorgante_1["cidade_representante"]; ?>"
    var estado_representante = "<?php echo $outorgante_1["estado_representante"]; ?>"

    // <!----------------------------------------------------------- SCRIPT PARA PARTE FIXA ------------------------------------------------->

    $(document).ready(function() {
        $(".partefixatotal").show();
        $(".paganoato").hide();
        $(".opcaonao").hide();
        $(".parcela").hide();
        $(".faseprocesso").hide();
        $(".partevariaveltotal").show();
        $(".prazopagapercentual").hide();
        $(".clausula").hide();
        $(".opcaosim").hide();
        $(".contrato").hide();

    });
    $("input:checkbox[name=mostrar_contrato]").on("change", function() {
        if ($(this).is(':checked')) {
            $(".contrato").show();
        } else {
            $(".contrato").hide();
        }
    });
    $("input:checkbox[name=diaria]").on("change", function() {
        if ($(this).is(':checked')) {
            $(".opcaosim").show();
        } else {
            $(".opcaosim").hide();
        }
    });
    $("input:checkbox[name=sempartefixa]").on("change", function() {
        if ($(this).is(':checked')) {
            $(".partefixatotal").show();
        } else {
            $(".partefixatotal").hide();
        }
    });
    //<!------------------------------------------------ SCRIPT PARA PAGAMENTO A VISTA ------------------------------------------------------>
    $("input:radio[name=pagamento]").on("change", function() {
        if ($(this).val() == "1") {
            $(".paganoato").show();
        } else {
            $(".paganoato").hide();
        }

    });
    $("input:radio[name=dtapga]").on("change", function() {
        if ($(this).val() == "npga") {
            $(".opcaonao").show();
        } else {
            $(".opcaonao").hide();
        }
    });
    // SCRIPT PARA PARCELAS
    $("input:radio[name=pagamento]").on("change", function() {
        if ($(this).val() == "2") {
            $(".parcela").show();
        } else {
            $(".parcela").hide();
        }
    });

    //SCRIPT PARA PAGAMENTO POR FASE PROCESSUAL
    $("input:radio[name=pagamento]").on("change", function() {
        if ($(this).val() == "3") {
            $(".faseprocesso").show();
        } else {
            $(".faseprocesso").hide();
        }
    });
    // SCRIPT PARA PARTE VARIAVEL
    $("input:checkbox[name=sempartevariavel]").on("change", function() {
        if ($(this).is(':checked')) {
            $(".partevariaveltotal").show();
        } else {
            $(".partevariaveltotal").hide();
        }
    });
    //SCRIPT PARA PORCENTAGEM
    $("input:radio[name=dtaporcento]").on("change", function() {
        if ($(this).val() == "n") {
            $(".prazopagapercentual").show();
        } else {
            $(".prazopagapercentual").hide();
        }
    });
    $("input:checkbox[name=novaclausula]").on("change", function() {
        if ($(this).is(':checked')) {
            $(".clausula").show();
        } else {
            $(".clausula").hide();
        }
    });
</script>
<script src="pages/js/imprimirProcuracao.js"></script>