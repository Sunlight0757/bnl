<?php

include('lib/conexao.php');
include('lib/protect.php');
protect(1);



$sql_usuarios = "SELECT * FROM dados_acoes";
$sql_query = $mysqli->query($sql_usuarios) or die($mysqli->error);
$sql_query2 = $mysqli->query($sql_usuarios) or die($mysqli->error);
$num_usuarios = $sql_query->num_rows;
$num_usuarios2 = $sql_query2->num_rows;

?>
<!-- Page-header start -->
<!--<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <form action="" method="POST"><button type="submit" name="criar_acao" class="btn btn-success btn-lg btn-round mr-4">Criar nova ação</button></form>
                    <div class="page-body">
                        <div class="row">
                            <div class="col-sm-12">

                                <?php if (isset($erro)) {
                                ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php
                                        echo "$erro<br>";
                                        ?>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>


                    <span>Após completar os formulários, os dados serão analisados por um advogado da BNL. </span>
                </div>
            </div>
        </div> 
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="index.php">
                            <i class="icofont icofont-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">Painel para gerenciar ações
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>-->
<!-- Page-header end -->

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Gerenciamento de processos</h5>
                </div>
                <!-- <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Réu</th>
                                    <th>Data</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <?php /*if ($num_usuarios == 0) { ?>
                                <tr>
                                    <td colspan="5">Nenhuma ação iniciada</td>
                                </tr>
                                <?php } else {

                                while ($usuario = $sql_query->fetch_assoc()) {
                                    $status = $usuario['passo_1'] + $usuario['passo_2'] + $usuario['passo_3'] + $usuario['passo_4'] + $usuario['passo_5'];
                                    if ($status == 5) {
                                ?>
                                        <tr>
                                            <th scope="row"><?php if (empty($usuario['reu_principal'])) {
                                                                echo "Não cadastrado";
                                                            } else {
                                                                echo $usuario['reu_principal'];
                                                            }
                                                            ?></th>
                                            <td><?php echo date("d/m/Y - H:i", strtotime($usuario['data_inicial'])); ?></td>
                                            <td><?php if ($status < 5) {
                                                    echo "Ação incompleta";
                                                }
                                                if ($status == 5) {
                                                    echo "Em análise";
                                                }
                                                ?>
                                            <td><a href="painel.php?p=montar_acao_analise&id_usuario=<?php echo $usuario['id'];?>&id=<?php echo $usuario['iduniq'];?>">Analisar</a> | <a href="painel.php?p=deletar_acoes&id=<?php echo $usuario['iduniq']; ?>">Excluir</a></td>
                                        </tr>
                            <?php
                                    }
                                }
                            } */?>
                        </table>
                    </div>

                </div>-->
                <br>
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
                            <?php if ($num_usuarios2 == 0) { ?>
                                <tr>
                                    <td colspan="5">Nenhuma ação iniciada</td>
                                </tr>
                                <?php } else {

                                while ($usuario2 = $sql_query2->fetch_assoc()) {
                                    $status = $usuario2['passo_1'] + $usuario2['passo_2'] + $usuario2['passo_3'] + $usuario2['passo_4'] + $usuario2['passo_5'];
                                    if ($status < 5) {
                                ?>
                                        <tr>
                                            <th scope="row"><?php if (empty($usuario2['reu_principal'])) {
                                                                echo "Não cadastrado";
                                                            } else {
                                                                echo $usuario2['reu_principal'];
                                                            }
                                                            ?></th>
                                            <td><?php echo date("d/m/Y - H:i", strtotime($usuario2['data_inicial'])); ?></td>
                                            <td><?php if ($status < 5) {
                                                    echo "Ação incompleta";
                                                }
                                                if ($status == 5) {
                                                    echo "Em análise";
                                                }
                                                ?>
                                            <td><a href="painel.php?p=montar_acao_analise&id_usuario=<?php echo $usuario2['id'];?>&id=<?php echo $usuario2['iduniq'];?>">Analisar</a> | <a href="painel.php?p=deletar_acoes&id=<?php echo $usuario2['iduniq']; ?>">Excluir</a></td>
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

</div>