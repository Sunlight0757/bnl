<?php
if (isset($_POST['enviar_imovel'])) {

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
            die("<script>location.href=\"painel.php?p=montar_acaowizard\";</script>");
        }
    } else {
        $_SESSION['msg'] ="Existe campos obrigatórios que precisam ser preenchidos";
        $_SESSION['msg_control'] = 'error';
        $_SESSION['controle_click2'] = 1;
        die("<script>location.href=\"painel.php?p=montar_acaowizard\";</script>");
    }
}
