<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<?php
include("lib/conexao.php");
include("lib/enviarArquivo.php");
include('lib/protect.php');
include('verifica_passos.php');
include('controle_passos.php');
include('mensagem.php');
protect(0);
$error = false;
?>

<?php

if (!$_SESSION['iduniq']) {
    die("<script>location.href=\"painel.php?p=gerenciar_acoes\";</script>");
}

if (isset($_POST['passo1'])) { ?>
    <script>
        $(document).ready(function() {
            $("#2").trigger("click");
        });
    </script>
<?php }
if (isset($_POST['passo4'])) { ?>
    <script>
        $(document).ready(function() {
            $("#5").trigger("click");
        });
    </script>
<?php }

if (isset($_POST['passo5'])) {
    $erro = array();
    if ($_SESSION['passo_reus'] + $_SESSION['passo_imovel'] + $_SESSION['passo_credito'] + $_SESSION['passo_upload'] < 4) {
        $erro[] = "Complete todos os 4 passos anteriores";
    } else {
        $sql_code_arquivo = "UPDATE dados_acoes SET passo_5 = '1' WHERE iduniq = '$iduniq'";
        $inserido_arquivo = $mysqli->query($sql_code_arquivo);
        $_SESSION['passo_conferencia'] = 1;
        die("<script>location.href=\"painel.php?p=gerenciar_acoes\";</script>");
    }
}
include('consultas.php');
?>
<section>
    <div class="container align-items-end">
        <div class="accordion" id="accordionExample">
            <div class="steps">
                <progress id="progress" value=0 max=100></progress>
                <div class="step-item">
                    <button class="step-button text-center" type="button" id="1" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        1
                    </button>
                    <div class="step-title">
                        Réus
                    </div>
                </div>
                <div class="step-item">
                    <button class="step-button text-center collapsed" id="2" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        2
                    </button>
                    <div class="step-title">
                        Imóvel
                    </div>
                </div>
                <div class="step-item">
                    <button class="step-button text-center collapsed" id="3" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        3
                    </button>
                    <div class="step-title">
                        Crédito
                    </div>
                </div>
                <div class="step-item">
                    <button class="step-button text-center collapsed" id="4" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        4
                    </button>
                    <div class="step-title">
                        Documentação
                    </div>
                </div>
                <div class="step-item">
                    <button class="step-button text-center collapsed" id="5" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        5
                    </button>
                    <div class="step-title">
                        Conferência
                    </div>
                </div>
            </div>


            <div class="mb-0">
                <div id="headingOne">

                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">



                    <div class="card">
                        <div class="card-header">
                            <h5>Polo ativo</h5>
                        </div>
                        <div class="card-block">

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="">Autor: </label><br><?php echo $usuario['nome_jur']; ?>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="">CNPJ: </label><br><?php echo $usuario['cnpj']; ?>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="">E-mail: </label><br><?php echo $usuario['email']; ?>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="page-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Polo passivo</h5>
                                    </div>
                                    <div class="card-block table-border-style ml-3 mr-3">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Nome</th>
                                                        <th>CPF/CNPJ</th>
                                                        <th>Endereço</th>
                                                    </tr>
                                                </thead>
                                                <?php if ($num_reus + $num_reus_jur == 0) {
                                                    $_SESSION['reu_error'] = 0; ?>
                                                    <tr>
                                                        <td colspan="5">Nenhum réu adicionado nesse processo</td>

                                                    </tr>
                                                    <?php } else {
                                                    $_SESSION['reu_error'] = 1;
                                                    $contador = 0;
                                                    while ($reus = $sql_query2->fetch_assoc()) {
                                                        $contador = $contador + 1;
                                                    ?>
                                                        <form id="pessoa_fisica_<?php echo $contador ?>" action="painel.php?p=deletar_reus" method="POST" ;>
                                                            <tr>
                                                                <th scope="row"><?php echo $reus['nome_reu']; ?></th>
                                                                <td><?php echo $reus['cpf_reu']; ?></td>
                                                                <td><?php echo $reus['endereco_reu']; ?>
                                                                    <input type="hidden" name="nome_reu" value="<?php echo $reus['nome_reu']; ?>" class="form-control">
                                                                    <input type="hidden" name="idreus" value="<?php echo $reus['id_reu']; ?>.1" class="form-control">
                                                                    <input type="hidden" name="iduniq" value="<?php echo $reus['iduniq']; ?>.1" class="form-control">
                                                                <td> <button onclick="return confirmSubmit(event, document.getElementById('pessoa_fisica_<?php echo $contador ?>'))" type="submit" name="deletar_reus" class="btn btn-danger float-right">Remover</button></td>
                                                            </tr>
                                                        </form>

                                                    <?php
                                                    } ?>

                                                    <?php
                                                    $contador = 0;
                                                    while ($reus_jur = $sql_query_jur->fetch_assoc()) {
                                                        $contador = $contador + 1;
                                                    ?>

                                                        <form id="pessoa_juridica_<?php echo $contador ?>" action="painel.php?p=deletar_reus" method="POST" ;>

                                                            <tr>
                                                                <th scope="row"><?php echo $reus_jur['nome_reu']; ?></th>
                                                                <td><?php echo $reus_jur['cnpj']; ?></td>
                                                                <td><?php echo $reus_jur['endereco_reu']; ?>
                                                                    <input type="hidden" name="nome_reu" value="<?php echo $reus_jur['nome_reu']; ?>" class="form-control">
                                                                    <input type="hidden" name="idreus" value="<?php echo $reus_jur['id_reu']; ?>.2" class="form-control">
                                                                    <input type="hidden" name="iduniq" value="<?php echo $reus_jur['id_uniq']; ?>.2" class="form-control">
                                                                <td> <button onclick="return confirmSubmit(event, document.getElementById('pessoa_juridica_<?php echo $contador ?>'))" type="submit" name="deletar_reus" class="btn btn-danger float-right">Remover</button></td>

                                                            </tr>
                                                        </form>
                                                <?php
                                                    }
                                                } ?>
                                            </table>
                                        </div>
                                        <div class="col-lg-12">
                                            <form id="passo1" action="" method="POST"><br>
                                                <?php if ($_SESSION['reu_error'] == 1) { ?>
                                                    <button type="submit" name="passo1" id="passo_concluido_1" form="passo1" class="btn btn-success btn-round float-right"><i class="ti-arrow-right"></i>Próximo Passo</button>

                                                <?php } ?>
                                            </form>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card">
                        <div class="dados_reus">
                            <div class="card-header page-header-title">
                                <h4>Inserir réu</h4>
                            </div>
                            <div class="card-block">
                                <label>
                                    <input type="radio" name="tipo_pessoa" value="1" checked>&nbsp;Pessoa Física&nbsp;&nbsp;&nbsp;&nbsp;
                                </label>
                                <label>
                                    <input type="radio" name="tipo_pessoa" value="0">&nbsp;Pessoa Jurídica
                                </label>
                            </div>
                            <div class="pessoa_fisica card-block">
                                <!-- onsubmit="return validateForm('inserirReuFisica')" -->
                                <form onsubmit="return validateForm('inserirReuFisica')" action="painel.php?p=enviar_pessoa_fisica" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="nome_reu">Nome</label>
                                                <input type="text" name="nome_reu" id="nome_reu" class="form-control inserirReuFisica" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="cpf_reu">CPF</label>
                                                <input type="text" name="cpf_reu" id="cpf_reu" class="form-control cpfMask inserirReuFisica" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="">Gênero:</label><br>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" name="genero_pfisica" id="genero_pfisica_masculino" value="o" required>
                                                <label class="form-check-label" for="genero_pfisica_masculino"> Masculino </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" name="genero_pfisica" id="genero_pfisica_feminino" value="a" required>
                                                <label class="form-check-label" for="genero_pfisica_feminino"> Feminino </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="endereco_reu">Endereço</label>
                                                <input type="text" name="endereco_reu" id="endereco_reu" class="form-control inserirReuFisica" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="cep_reu">CEP</label>
                                                <input type="text" name="cep_reu" id="cep_reu" class="form-control cepMask inserirReuFisica" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="profissao_reu">Profissão</label>
                                                <input type="text" name="profissao_reu" id="profissao_reu" class="form-control inserirReuFisica" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="estadocivil_reu">Estado Civil</label>
                                                <input type="text" name="estadocivil_reu" id="estadocivil_reu" class="form-control inserirReuFisica" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="estado_reu">Estado</label>
                                                <select name="estado_reu" id="estado_reu" class="form-select inserirReuFisica" required>
                                                    <option selected disabled value="">Selecione o estado</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="cidade_reu">Cidade</label>
                                                <select name="cidade_reu" id="cidade_reu" class="form-select inserirReuFisica" required>
                                                    <option selected disabled value="">Selecione a cidade</option>
                                                    <option disabled value="">--Escolha o estado primeiro--</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <a href="painel.php?p=gerenciar_acoes" class="btn btn-success btn-round"><i class="ti-arrow-left"></i> Voltar</a>
                                        <button type="submit" name="enviar_reus" class="btn btn-success btn-round float-right"><i class="ti-save"></i> Inserir Réu</button>
                                    </div>
                                </form>
                            </div>

                            <div class="pessoa_juridica card-block">
                                <form onsubmit="return validateForm('inserirReuJuridica')" action="painel.php?p=enviar_pessoa_juridica" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="nome_reu_jur">Nome</label>
                                                <input type="text" name="nome_reu_jur" id="nome_reu_jur" class="form-control inserirReuJuridica" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="cnpj_reu_jur">CNPJ</label>
                                                <input type="text" name="cnpj_reu_jur" id="cnpj_reu_jur" class="cnpjMask form-control inserirReuJuridica" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Gênero:</label><br>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="genero_pjuridica" id="genero_pjuridica_masculino" value="o" required>
                                                    <label class="form-check-label" for="genero_pjuridica_masculino"> Masculino </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="genero_pjuridica" id="genero_pjuridica_feminino" value="a" required>
                                                    <label class="form-check-label" for="genero_pjuridica_feminino"> Feminino </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="endereco_reu_jur">Endereço</label>
                                                <input type="text" name="endereco_reu_jur" id="endereco_reu_jur" class="form-control inserirReuJuridica" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="cep_reu_jur">CEP</label>
                                                <input type="text" name="cep_reu_jur" id="cep_reu_jur" class="form-control cepMask inserirReuJuridica" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="estado_reu_jur">Estado</label>
                                                <select name="estado_reu_jur" id="estado_reu_jur" class="form-select inserirReuJuridica" required>
                                                    <option selected disabled value="">Selecione o estado</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="cidade_reu_jur">Cidade</label>
                                                <select name="cidade_reu_jur" id="cidade_reu_jur" class="form-select inserirReuJuridica" required>
                                                    <option selected disabled value="">Selecione a cidade</option>
                                                    <option disabled value="">--Escolha o estado primeiro--</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="card-header page-header-title">
                                            <label>
                                                <h4>Dados do Representante</h4>
                                            </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <br>
                                            <div class="form-group">
                                                <label for="nome_representante">Nome do Representante</label>
                                                <input type="text" name="nome_representante" id="nome_representante" class="form-control inserirReuJuridica" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <br>
                                            <div class="form-group">
                                                <label for="cpf_representante">CPF do Representante</label>
                                                <input type="text" name="cpf_representante" id="cpf_representante" class="form-control cpfMask inserirReuJuridica" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="nacionalidade_representante">Nacionalidade do Representante</label>
                                                <input type="text" name="nacionalidade_representante" id="nacionalidade_representante" class="form-control inserirReuJuridica" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <a href="painel.php?p=gerenciar_acoes" class="btn btn-success btn-round"><i class="ti-arrow-left"></i> Voltar</a>
                                        <button type="submit" name="enviar_reus_jur" class="btn btn-success btn-round float-right"><i class="ti-save"></i> Inserir Réu</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>



                </div>
            </div>
            <div class="card mb-0">

                <div id="headingTwo">

                </div>

                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">


                    <div class="imovel card shadow-none">
                        <div class="imovel card-header">
                        </div>
                        <?php if (isset($_SESSION['passo_imovel'])) {

                            $sql_query_imovel = $mysqli->query("SELECT * FROM dados_acoes WHERE id = '$id' AND iduniq = '$iduniq'") or die($mysqli->error);
                            $dados_imovel = $sql_query_imovel->fetch_assoc();
                        } ?>

                        <div class="imovel card-block">
                            <form action="painel.php?p=certidao" method="POST" ;>
                                <div class="certidao col-lg-12">
                                    <button onclick="return confirmSubmit2(event, document.getElementById('certidao'))" type="submit" name="certidao" value="1" class="certidao btn btn-success btn-round float-right"><i class="ti-save"></i>Obter Certidão</button>
                                </div>
                            </form>
                            <form onsubmit="return validateForm('inserirImovelInput')" class="imovel needs-validation" action="painel.php?p=enviar_imovel" method="POST" enctype="multipart/form-data" novalidate>
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
                                            <input type="text" value="<?php if (isset($_SESSION['passo_imovel'])) {
                                                                            echo $dados_imovel['edificio'];
                                                                        } ?>" name="edificio" id="edificio" class="form-control inserirImovelInput" required>
                                        </div>
                                    </div>
                                    <div class="imovel col-lg-5">
                                        <div class="imovel form-group">
                                            <label for="cartorio_registro">Cartório do registro</label>
                                            <input type="text" value="<?php if (isset($_SESSION['passo_imovel'])) {
                                                                            echo $dados_imovel['cartorio_registro'];
                                                                        } ?>" name="cartorio_registro" id="cartorio_registro" class="form-control inserirImovelInput" required>
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
                                    <div class="imovel col-lg-10">
                                        <div class="form-group">
                                            <label for="">Observação (Opcional)</label>
                                            <textarea value="" name="obs" class="form-control"><?php if (isset($_SESSION['passo_imovel'])) {
                                                                                                    echo $dados_imovel['obs'];
                                                                                                } ?></textarea>
                                        </div>
                                    </div>



                                    <div class="imovel col-lg-12">
                                        <button type="submit" name="enviar_imovel" value="1" class="imovel btn btn-success btn-round float-right"><i class="ti-save"></i>Salvar edição</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div>

                <div id="headingThree">

                </div>

                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card card-block">
                        <div class="">
                            <?php if (isset($_SESSION['passo_credito'])) {
                                $sql_query_creditoedit = $mysqli->query("SELECT * FROM dados_acoes WHERE id = '$id' AND iduniq = '$iduniq'") or die($mysqli->error);
                                $dados_creditoedit = $sql_query_creditoedit->fetch_assoc();
                            }
                            ?>
                            <div class="">
                                <form action="painel.php?p=enviar_credito" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                    <div class="card card-block">


                                        <div class="row d-flex align-items-end">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="">Período do crédito (Data inicial)</label>
                                                    <input type="date" value="<?php if (isset($_SESSION['passo_credito'])) {
                                                                                    echo $dados_creditoedit['periodo_inicio'];
                                                                                } ?>" name="periodo_inicio" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="">Período do crédito (Data final)</label>
                                                    <input type="date" value="<?php if (isset($_SESSION['passo_credito'])) {
                                                                                    echo $dados_creditoedit['periodo_final'];
                                                                                } ?>" name="periodo_final" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label for="">Valor devido</label>
                                                    <input type="text" value="<?php if (isset($_SESSION['passo_credito'])) {
                                                                                    echo $dados_creditoedit['valor_devido'];
                                                                                } ?>" name="valor_devido" class="form-control maskMoney" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label for="">Meses devido</label>
                                                    <input type="number" max="999" min="0" name="meses_devido" value="<?php if (isset($_SESSION['passo_credito'])) {
                                                                                                                            echo $dados_creditoedit['meses_devido'];
                                                                                                                        } ?>" class="form-control threeDigits" required>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="descumpridocheckbox">
                                        <div class="card-header pb-2">

                                            <h5>Existe acordo descumprido?</h5>
                                            <?php
                                            if (isset($dados_creditoedit['acordo_descumprido'])) { ?>
                                                <label>
                                                    <input name="tipo" value="1" type="radio" class="form-check-input" required> Sim
                                                </label>
                                                <label>
                                                    <input name="tipo" value="0" type="radio" class="form-check-input ml-1" required> Não
                                                </label>

                                            <?php } else { ?>
                                                <input name="tipo" value="1" type="radio">&nbsp;Sim&nbsp;
                                                <input name="tipo" value="0" type="radio" checked>Não

                                            <?php } ?>

                                        </div>
                                    </div>

                                    <div class="descumprido card card-block">
                                        <div class="card-header pt-0">
                                            <h5>Preencha os dados referente ao acordo descumprido</h5>
                                        </div>
                                        <div class="row d-flex align-items-end">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="">Período do crédito (Data inicial)</label>
                                                    <input type="date" value="<?php if (isset($_SESSION['passo_credito'])) {
                                                                                    echo $dados_creditoedit['periodo_inicio_descumprido'];
                                                                                } ?>" name="periodo_inicio_descumprido" class="form-control acordoDescumprido">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="">Período do crédito (Data final)</label>
                                                    <input type="date" value="<?php if (isset($_SESSION['passo_credito'])) {
                                                                                    echo $dados_creditoedit['periodo_final_descumprido'];
                                                                                } ?>" name="periodo_final_descumprido" class="form-control acordoDescumprido">
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label for="">Valor devido</label>
                                                    <input type="text" value="<?php if (isset($_SESSION['passo_credito'])) {
                                                                                    echo $dados_creditoedit['valor_devido_descumprido'];
                                                                                } ?>" name="valor_devido_descumprido" class="form-control maskMoney acordoDescumprido">
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label for="">número de parcelas devidas</label>
                                                    <input type="text" value="<?php if (isset($_SESSION['passo_credito'])) {
                                                                                    echo $dados_creditoedit['meses_devido_descumprido'];
                                                                                } ?>" name="meses_devido_descumprido" class="form-control acordoDescumprido">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" name="enviar_credito" class="imovel btn btn-success btn-round float-right"><i class="ti-arrow-right"></i>Próximo passo</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="headingFour">

                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                    <div class="page-header card p-3">
                        <label for="file" class="mb-3">
                            <p>Selecione os arquivos referentes a esta ação</p>
                            A certidão do imóvel e o cálculo do crédito são documentos essenciais para o êxito da ação.
                        </label>
                        <div class="row m-0">
                            <div class="card card-block col-xxl-4">
                                <form method="POST" enctype="multipart/form-data" action="painel.php?p=enviar_arquivos_especificos">
                                    <div class="col-lg-12">
                                        <div class="input-file-container">
                                            <input class="input-file " name="arquivos" type="file" id="my-file">
                                            <label tabindex="0" for="my-file" class="input-file-trigger ">Selecionar</label>
                                        </div>
                                        <p class="file-return"></p>
                                    </div>
                                    <div class="col-lg-12 d-flex justify-content-center align-items-center">
                                        <div class="form-group mt-3" style="width: 100%;">
                                            <label for="">Tipo de arquivo</label>
                                            <select name="nome" class="form-select">
                                                <option value="" selected disabled>Selecione o tipo</option>
                                                <option value="Certidão do imóvel">Certidão do imóvel</option>
                                                <option value="Cálculo">Cálculo</option>
                                                <option value="Documento do acordo descumprido">Documento do acordo descumprido</option>
                                                <option value="Documentos adicionais sobre a ação">Documentos adicionais sobre a ação</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 d-flex justify-content-end align-items-center">
                                        <button name="upload" class="btn btn-success btn-round" type="submit">Enviar arquivo</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-xxl-8">
                                <div class="card p-2">
                                    <div class="card-header p-2">
                                        <h5>Lista de arquivos enviados</h5>
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
                                                <?php if ($num_arquivo_especifico == 0) { ?>
                                                    <tr>
                                                        <td colspan="5">Nenhuma arquivo enviado</td>
                                                    </tr>
                                                    <?php } else {
                                                    $_SESSION['arquivo_error'] = 1;
                                                    while ($arquivos = $sql_query_especifico->fetch_assoc()) {
                                                        if (($arquivos['tipo_documento']) == 1) {
                                                    ?>
                                                            <tr>
                                                                <th scope="row"><a target="_blank" href="<?php echo $arquivos['path']; ?>"><?php echo substr($arquivos['nome_arquivo'], 0, 30); ?></a></th>
                                                                <td><?php echo date("d/m/Y - H:i", strtotime($arquivos['data_envio'])); ?></td>
                                                                <td><?php echo $arquivos['tipo']; ?>
                                                                <td><?php echo substr($arquivos['size'], 0, 3); ?>KB
                                                                <td><?php echo $arquivos['nome']; ?>
                                                                <td> <a href="painel.php?p=deletar_arquivo&iduniq=<?php echo $arquivos['iduniq']; ?>">Deletar</a></td>
                                                            </tr>
                                                <?php
                                                        }
                                                    }
                                                } ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <form id="passo4" action="" method="POST">
                                <?php if (isset($_SESSION['arquivo_error'])) { ?>
                                    <button type="submit" name="passo4" id="passo_concluido_4" form="passo4" class="btn btn-success btn-round float-right"><i class="ti-arrow-right"></i>Próximo Passo</button>

                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>

                <div id="headingFive">

                </div>
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                    <div class="card card-body">

                        <h3 class="text-center">Conferência dos dados da ação</h3>
                        <hr>
                        <div class="col-lg-12">
                            <form id="passo5" action="" method="POST"><br>
                                <?php
                                $passo_1 = $_SESSION['passo_reus'];
                                $passo_2 = $_SESSION['passo_imovel'];
                                $passo_3 = $_SESSION['passo_credito'];
                                $passo_4 = $_SESSION['passo_upload'];
                                $passo_5 = $_SESSION['passo_conferencia'];
                                if ($passo_1 + $passo_2 + $passo_3 + $passo_4 == 4) {
                                ?>
                                    <button type="submit" name="passo5" id="passo_concluido_5" form="passo5" class="btn btn-success btn-round float-right">Concluir ação</button>

                                <?php } ?>
                            </form>
                        </div>
                        <div class="page-body card card-body">
                            <div class="row m-0">
                                <div class="col-sm-12">
                                    <div class="card-header">
                                        <h4>Réus inseridos <?php if (!isset($_SESSION['passo_reus'])) {
                                                                echo "- Não concluído";
                                                            } elseif ($_SESSION['passo_reus'] == 0) {
                                                                echo "- Não concluído";
                                                            } else {
                                                                echo "✔";
                                                            } ?></h4>
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
                        <div class="page-body">
                            <div class="row m-0">
                                <div class="col-sm-12 card card-body">
                                    <div class="card-header">
                                        <h4>Dados do imóvel <?php if (!isset($_SESSION['passo_imovel'])) {
                                                                echo "- Não concluído";
                                                            } elseif ($_SESSION['passo_imovel'] == 0) {
                                                                echo "- Não concluído";
                                                            } else {
                                                                echo "✔";
                                                            } ?></h4>
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
                                        <?php } else { ?>


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
                            <div class="row m-0">
                                <div class="col-sm-12 card card-body">
                                    <div class="card-header">
                                        <h4>Dados do crédito <?php if (!isset($_SESSION['passo_credito'])) {
                                                                    echo "- Não concluído";
                                                                } elseif ($_SESSION['passo_credito'] == 0) {
                                                                    echo "- Não concluído";
                                                                } else {
                                                                    echo "✔";
                                                                } ?></h4>
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
                            <div class="row m-0">
                                <div class="col-sm-12 card card-body">
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
                            <div class="row m-0">
                                <div class="col-sm-12 card card-body">
                                    <div class="card-header">
                                        <h4>Documentação Específica <?php if (!isset($_SESSION['passo_upload'])) {
                                                                        echo "- Não concluído";
                                                                    } elseif ($_SESSION['passo_upload'] == 0) {
                                                                        echo "- Não concluído";
                                                                    } else {
                                                                        echo "✔";
                                                                    } ?></h4>
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
                                                    while ($arquivos_especifico_conferencia = $sql_query_especifico_conferencia->fetch_assoc()) { ?>
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
    $(document).ready(function() {
        //Masks
        jQuery(function($) {
            $(".cnpjMask").mask("99.999.999/9999-99");
            $(".cpfMask").mask("999.999.999-99");
            $(".cepMask").mask("99999-99");
        });

        // set the cursor position to the beginning of the input field on the first click
        jQuery(function($) {
            let maskedInputs = $(".cnpjMask, .cpfMask, .cepMask");
            let firstClick = true;
            maskedInputs.click(function() {
                if (firstClick) {
                    $(this).caret(0);
                    firstClick = false;
                }
            });
            maskedInputs.focusout(function() {
                firstClick = true;
            })
        });

        $(function() {
            $('.maskMoney').maskMoney({
                prefix: 'R$ ',
                thousands: '.',
                decimal: ','
            });
        });
    });
</script>
<script>
    function confirmSubmit(event, form) {
        event.preventDefault(); // prevent the default form submission behavior

        Swal.fire({
            title: 'Tem certeza que deseja remover?',
            text: "Essa decisão não poderá ser revertida!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim!'
        }).then((result) => {
            if (result.isConfirmed) {
                // submit the form that was clicked
                form.submit();
            }
        })
    }
</script>
<script>
    function confirmSubmit2(event, form) {
        event.preventDefault(); // prevent the default form submission behavior

        Swal.fire({
            title: 'Deseja que a BNL requeira a certidão?',
            html: "Para requerer a certidão é preciso o número da matrícula e o cartório do registro da unidade devedora.<br>No caso de faltar essas informações será necessário requerer a busca nos cartórios da cidade.<br>O valor do requerimento varia, conforme o tipo e a cidade.<br>Cada Estado tem sua taxa de emolumentos.<br>A BNL cobra uma pequena taxa pelo serviço, no valor de R$ 30,00, que será abatido quando da propositura da ação.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim!'
        }).then((result) => {
            if (result.isConfirmed) {
                // submit the form that was clicked
                form.submit();
            }
        })
    }
</script>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
<script src="pages/js/nomearquivo.js"></script>
<script src="pages/js/checkInputs.js"></script>
<script src="pages/js/estadosCidadesSelects.js"></script>
<script>
    //Aplicando API de estados e cidades nos selects
    $(document).ready(function() {
        estadosCidadesSelects('estado_reu_jur', 'cidade_reu_jur')
        estadosCidadesSelects('estado_reu', 'cidade_reu')
    });
</script>
<script>
    $(document).ready(function() {
        $(".pessoa_juridica").hide();
        $(".descumprido").hide();
    });
    $("input:radio[name=tipo]").on("change", function() {
        if ($(this).val() == "1") {
            $(".descumprido").show();
            $(".acordoDescumprido").prop("required", true);
        } else if ($(this).val() == "0") {
            $(".descumprido").hide();
            $(".acordoDescumprido").prop("required", false);
        }
    });

    $("input:radio[name=tipo_pessoa]").on("change", function() {
        if ($(this).val() == "1") {
            $(".pessoa_fisica").show();
            $(".pessoa_juridica").hide();
        } else if ($(this).val() == "0") {
            $(".pessoa_fisica").hide();
            $(".pessoa_juridica").show();
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('.threeDigits').on('input', function() {
            if ($(this).val().length > 3) {
                $(this).val($(this).val().substring(0, 3));
            }
        });
    });
</script>
<?php
if (isset($dados_creditoedit['acordo_descumprido'])) {
    if ($dados_creditoedit['acordo_descumprido'] == 0) {
?>
        <script>
            $(document).ready(function() {
                $(".descumprido").hide();
            });
        </script>

    <?php } elseif ($dados_creditoedit['acordo_descumprido'] == 1) { ?>
        <script>
            $(document).ready(function() {
                $(".descumprido").show();
            });
        </script>
<?php


    }
} ?>