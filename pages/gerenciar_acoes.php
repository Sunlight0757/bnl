<?php

include('lib/conexao.php');
include('lib/protect.php');
protect(0);


if (isset($_POST['criar_acao'])) {
    $_SESSION['passo_reus'] = 0;
    $_SESSION['passo_imovel'] = 0;
    $_SESSION['passo_credito'] = 0;
    $_SESSION['passo_upload'] = 0;
    $_SESSION['passo_conferencia'] = 0;
    $_SESSION['reu_error'] = 0;
    $_SESSION['arquivo_error'] = 0;
    $id_random = rand(62, 62);
    $_SESSION['iduniq'] = substr(str_shuffle("AaBbCcDdEeFfGgHhIiJjKkLlMmNnPpQqRrSsTtUuVvYyXxWwZz0123456789"), 0, $id_random);
    $iduniq = $_SESSION['iduniq'];

    $sql_code = "INSERT INTO dados_acoes (id, data_inicial, iduniq) VALUES(

        '$id',
        NOW(),
        '$iduniq')";

    $inserido = $mysqli->query($sql_code);
    if (!$inserido) {
        $erro = "Falha ao inserir no banco de dados: " . $mysqli->error;
    } else {
        die("<script>location.href=\"painel.php?p=montar_acaowizard\";</script>");
        $_SESSION['criar_do_zero'] = 1;
    }
}

$sql_usuarios = "SELECT * FROM dados_acoes WHERE id='$id' AND passo_5 != 1";
$sql_query = $mysqli->query($sql_usuarios) or die($mysqli->error);
$num_usuarios = $sql_query->num_rows;

?>
<!-- Page-header start -->
<div class="page-header card">
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


                    <h6 class="mt-3">Após completar os formulários, os dados serão analisados por um advogado da BNL.<br>
                    As informações ficam sob absoluto sigilo, conforme a Lei 13.709 (Lei Geral de Proteção de Dados).

                    </h6>
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
</div>
<!-- Page-header end -->

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Painel para gerenciar ações</h5>
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
                                    <td colspan="5">Nenhuma ação iniciada</td>
                                </tr>
                                <?php } else {

                                while ($usuario = $sql_query->fetch_assoc()) {
                                    $status = $usuario['passo_1'] + $usuario['passo_2'] + $usuario['passo_3'] + $usuario['passo_4'] + $usuario['passo_5'];
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
                                        <td><a href="painel.php?p=montar_acaowizard&id=<?php echo $usuario['iduniq']; ?>">Continuar</a> | <a href="painel.php?p=deletar_acoes&id=<?php echo $usuario['iduniq']; ?>">Excluir</a></td>
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