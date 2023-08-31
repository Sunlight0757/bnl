<?php

include('lib/conexao.php');
include('lib/protect.php');
protect(0);
$sql_dadosextras = "SELECT * FROM dados_adicionais WHERE id_usuario ='$id'";
$sql_query_extras = $mysqli->query($sql_dadosextras) or die($mysqli->error);
if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    $sql_usuarios2 = "SELECT * FROM dados_certidao WHERE id_user='$id'";
    $sql_query2 = $mysqli->query($sql_usuarios2) or die($mysqli->error);
    $num_usuarios2 = $sql_query2->num_rows;

    $sql_usuarios = "SELECT * FROM dados_acoes WHERE id='$id' AND passo_5 = 1";
    $sql_query = $mysqli->query($sql_usuarios) or die($mysqli->error);
    $num_usuarios = $sql_query->num_rows;
} else {
    $sql_usuarios2 = "SELECT * FROM dados_certidao WHERE concluido=0";
    $sql_query2 = $mysqli->query($sql_usuarios2) or die($mysqli->error);
    $num_usuarios2 = $sql_query2->num_rows;

    $sql_usuarios = "SELECT * FROM dados_acoes WHERE passo_5 = 1";
    $sql_query = $mysqli->query($sql_usuarios) or die($mysqli->error);
    $num_usuarios = $sql_query->num_rows;
}

if ($sql_query_extras->num_rows == 0) {
    if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
?>

        <div class="dados_extras card">
            <div class="card-header page-header-title">
                <h4>Complete seu cadastro para montar ação judicial.</h4>
            </div>
            <div class="card-block">
                <form action="painel.php?p=complemento_cadastro" method="POST">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="">Endereço do Condomínio</label>
                                <input type="text" name="endereco_condominio" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="">Cidade do Condomínio</label>
                                <input type="text" name="cidade_condominio" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="">Estado do Condomínio</label>
                                <input type="text" name="estado_condominio" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="">CEP do Condomínio</label>
                                <input type="text" name="cep_condominio" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="">Nome do Representante</label>
                                <input type="text" name="nome_representante" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="">CPF do Representante</label>
                                <input type="text" name="cpf_representante" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="">Nacionalidade do Representante</label>
                                <input type="text" name="nacionalidade_representante" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="">Profissão do Representante</label>
                                <input type="text" name="profissao_representante" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="">Endereço do Representante</label>
                                <input type="text" name="endereco_representante" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="">Cidade do Representante</label>
                                <input type="text" name="cidade_representante" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="">Estado do Representante</label>
                                <input type="text" name="estado_representante" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" name="enviar_complemento" class="btn btn-success btn-round float-right"><i class="ti-save"></i>Concluir</button>
                    </div>
                </form>
            </div>
        </div>
    <?php }
}
if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    if ($sql_query_extras->num_rows != 0) {

    ?>
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Ações em análise</h5>
                        </div>
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Réu</th>
                                            <th>Data</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <?php if ($num_usuarios == 0) { ?>
                                        <tr>
                                            <td colspan="5">Nenhuma ação em análise</td>
                                        </tr>
                                        <?php } else {

                                        while ($usuario = $sql_query->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <th scope="row"><?php if (!empty($usuario['reu_principal'])) {
                                                                    echo $usuario['reu_principal'];
                                                                }
                                                                ?></th>
                                                <td><?php echo date("d/m/Y - H:i", strtotime($usuario['data_inicial'])); ?></td>
                                                <td><?php echo "Em análise"; ?>
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
    <?php }
} else {
    ?>
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Ações em análise</h5>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Réu</th>
                                        <th>Data</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <?php if ($num_usuarios == 0) { ?>
                                    <tr>
                                        <td colspan="5">Nenhuma ação em análise</td>
                                    </tr>
                                    <?php } else {

                                    while ($usuario = $sql_query->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <th scope="row"><?php if (!empty($usuario['reu_principal'])) {
                                                                echo $usuario['reu_principal'];
                                                            }
                                                            ?></th>
                                            <td><?php echo date("d/m/Y - H:i", strtotime($usuario['data_inicial'])); ?></td>
                                            <td><?php echo "Em análise"; ?>
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
<?php
} ?>
<?php

?>
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Pedidos de certidões</h5>
                </div>
                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Endereco</th>
                                    <th>Cidade</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <?php if ($num_usuarios2 == 0) { ?>
                                <tr>
                                    <td colspan="5">Nenhum pedido de certidão encontrado</td>
                                </tr>
                                <?php } else {

                                while ($usuario2 = $sql_query2->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <th scope="row"><?php if (!empty($usuario2['endereco_certidao'])) {
                                                            echo $usuario2['endereco_certidao'];
                                                        }
                                                        ?></th>
                                        <td><?php echo $usuario2['cidade_certidao']; ?></td>
                                        <td><?php echo $usuario2['estado_certidao']; ?>
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