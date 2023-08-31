<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">

    <title>BNL - Assessoria jurídica para condomínios</title>


</head>

<body>
    <div class="imovel card">

   
        <div class="imovel card-block">
            <div class="imovel form-group">
                <p class="form-control inserirImovelInput">
                <h4> <b> Certidão Imobiliária </b></h4>
                A certidão do imóvel prova a sua propriedade.
                O proprietário é o condômino responsável pelas obrigações condominiais. <br>
                Portanto a certidão é documento necessário para indicar quem responde judicialmente. <br>
                No caso de o condomínio precisar da certidão, a BNL pode a requerer. Basta preencher o número da
                matrícula e o cartório do registro.<br>
                Se não houver tais informações, será preciso pedir busca nos cartórios, antes de pedir a certidão.<br>
                Esse serviço depende do tempo de cada cartório para atendimento.<br>
                </p>
            </div>
            <hr>
            <!--<form action="painel.php?p=certidao" method="POST" ;>-->
                <!--<div class="certidao col-lg-12">
                                    <button onclick="return confirmSubmit2(event, document.getElementById('certidao'))" type="submit" name="certidao" value="1" class="certidao btn btn-success btn-round float-right"><i class="ti-save"></i>Obter Certidão</button>
                                </div>
            </form>-->
            <form onsubmit="return validateForm('inserirImovelInput')" class="imovel needs-validation"
                action="painel.php?p=enviar_imovel" method="POST" enctype="multipart/form-data" novalidate>
                <div class="imovel row d-flex align-items-end">
                    <div class="imovel col-lg-2">
                        <div class="imovel form-group">
                            <label for="unidade">Unidade, número ou lote</label>
                            <input type="text" value="<?php if (isset($_SESSION['passo_imovel'])) {
                                echo $dados_imovel['unidade'];
                            } ?>" name="unidade" id="unidade" class="form-control inserirImovelInput" required>
                        </div>
                    </div>
                    <div class="imovel col-lg-8">
                        <div class="imovel form-group">
                            <label for="edificio">Edifício, logradouro ou quadra</label>
                            <input type="text" value="
                            
                            <?php if (isset($_SESSION['passo_imovel'])) {
                                echo $dados_imovel['edificio'];
                            } ?>
                            
                            " name="edificio" id="edificio" class="form-control inserirImovelInput" required>
                        </div>
                    </div>
                    <div class="imovel col-lg-5">
                        <div class="imovel form-group">
                            <label for="cartorio_registro">Cartório do registro</label>
                            <input type="text" value="<?php if (isset($_SESSION['passo_imovel'])) {
                                echo $dados_imovel['cartorio_registro'];
                            } ?>" name="cartorio_registro" id="cartorio_registro"
                                class="form-control inserirImovelInput" required>
                        </div>
                    </div>

                    <div class="imovel col-lg-2">
                        <div class="imovel form-group">
                            <label for="matricula">Número da matrícula</label>
                            <input type="text" value="<?php if (isset($_SESSION['passo_imovel'])) {
                                echo $dados_imovel['matricula'];
                            } ?>" name="matricula" id="matricula" class="form-control inserirImovelInput" required>
                        </div>
                    </div>
                    <div class="imovel col-lg-3">
                        <div class="imovel form-group">
                            <label for="livrofls">Livro e fls</label>
                            <input type="text" value="<?php if (isset($_SESSION['passo_imovel'])) {
                                echo $dados_imovel['livrofls'];
                            } ?>" name="livrofls" id="livrofls" class="form-control inserirImovelInput" required>
                        </div>
                    </div>
                    <div class="imovel col-lg-3">
                        <div class="imovel form-group">
                            <label for="livrofls">Cidade</label>
                            <input type="text" value="<?php if (isset($_SESSION['passo_imovel'])) {
                                echo $dados_imovel['cidade'];
                            } ?>" name="cidade_certidao" id="cidade_certidao" class="form-control inserirImovelInput" required>
                        </div>
                    </div>
                    <div class="imovel col-lg-3">
                        <div class="imovel form-group">
                            <label for="livrofls">Estado</label>
                            <input type="text" value="<?php if (isset($_SESSION['passo_imovel'])) {
                                echo $dados_imovel['cidade'];
                            } ?>" name="estado_certidao" id="estado_certidao" class="form-control inserirImovelInput" required>
                        </div>
                    </div>


                    <div class="imovel col-lg-10">
                        <div class="form-group">
                            <label for="">Observação (Opcional)</label>
                            <textarea value="" name="obs" class="form-control"><?php if (isset($_SESSION['passo_imovel'])) {
                                echo $dados_imovel['obs'];
                            } ?></textarea>
                        </div>
                    </div>



                    <div class="imovel col-lg-12">
                        <button type="submit" name="requer_certidao" value="1"
                            class="imovel btn btn-success btn-round float-right"><i class="ti-agenda"></i>Requerer
                            certidão</button>
                    </div>
                </div>
            </form>
        </div>




        <?php

include("lib/conexao.php");
include("lib/enviarArquivo.php");
include('lib/protect.php');


        if (isset($_POST['requer_certidao'])) {

            $unidade = $mysqli->escape_string($_POST['unidade']);
            $edificio = $mysqli->escape_string($_POST['edificio']);
            $cartorio_registro = $mysqli->escape_string($_POST['cartorio_registro']);
            $matricula = $mysqli->escape_string($_POST['matricula']);
            $livrofls = $mysqli->escape_string($_POST['livrofls']);
            $obs = $mysqli->escape_string($_POST['obs']);
            $iduniq = $_SESSION['iduniq'];

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


                $sql_code = "UPDATE dados_acoes SET unidade = '$unidade' , edificio = '$edificio', cartorio_registro = '$cartorio_registro',
     matricula = '$matricula', livrofls = '$livrofls', obs = '$obs', passo_2 = '1' WHERE iduniq = '$iduniq'";


                $inserido = $mysqli->query($sql_code);
                if (!$inserido) {
                    $erro[] = "Falha ao inserir no banco de dados: " . $mysqli->error;
                } else {
                    $_SESSION['passo_imovel'] = 1;
                    $_SESSION['controle_click3'] = 1;
                    $_SESSION['msg'] = 'Unidade ' . $unidade . ' inserido com sucesso';
                    $_SESSION['msg_control'] = 'success';
                    die("<script>location.href=\"painel.php?p=requer_certidao\";</script>");
                }
            } else {
                $_SESSION['msg'] = "Existe campos obrigatórios que precisam ser preenchidos";
                $_SESSION['msg_control'] = 'error';
                $_SESSION['controle_click2'] = 1;
                die("<script>location.href=\"painel.php?p=requer_certidao\";</script>");
            }
        }
        ?>

    </div>

</body>

</html>