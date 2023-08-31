<?php
if (isset($_POST['enviar_credito'])) {
    $tipo = 0;
    $periodo_inicio = $mysqli->escape_string($_POST['periodo_inicio']);
    $periodo_final = $mysqli->escape_string($_POST['periodo_final']);
    $valor_devido = $mysqli->escape_string($_POST['valor_devido']);
    $meses_devido = $mysqli->escape_string($_POST['meses_devido']);
    $tipo = $mysqli->escape_string($_POST['tipo']);

    $periodo_inicio_descumprido = $mysqli->escape_string($_POST['periodo_inicio_descumprido']);
    $periodo_final_descumprido = $mysqli->escape_string($_POST['periodo_final_descumprido']);
    $valor_devido_descumprido = $mysqli->escape_string($_POST['valor_devido_descumprido']);
    $meses_devido_descumprido = $mysqli->escape_string($_POST['meses_devido_descumprido']);

    $iduniq = $_SESSION['iduniq'];

    $erro = array();
    if (empty($periodo_inicio)) {
        $erro[] = "Preencha da data inicial da dívida";
    }
    if (empty($periodo_final)) {
        $erro[] = "Preencha da data final da dívida";
    }
    if (empty($valor_devido)) {
        $erro[] = "Preencha o valor devido";
    }
    if (empty($meses_devido)) {
        $erro[] = "Preencha a quantidade de meses devida";
    }
    if ($tipo == "1") {
        if (empty($periodo_inicio_descumprido)) {
            $erro[] = "Preencha da data inicial da dívida do acordo descumprido";
        }
        if (empty($periodo_final_descumprido)) {
            $erro[] = "Preencha da data final da dívida do acordo descumprido";
        }
        if (empty($valor_devido_descumprido)) {
            $erro[] = "Preencha o valor devido do acordo descumprido";
        }
        if (empty($meses_devido_descumprido)) {
            $erro[] = "Preencha a quantidade de meses devida do acordo descumprido";
        }
    }
    if (count($erro) == 0) {
        $sql_code = "UPDATE dados_acoes SET periodo_inicio = '$periodo_inicio' , periodo_final = '$periodo_final', valor_devido = '$valor_devido', meses_devido = '$meses_devido',
         periodo_inicio_descumprido = '$periodo_inicio_descumprido' , periodo_final_descumprido = '$periodo_final_descumprido', valor_devido_descumprido = '$valor_devido_descumprido',
          meses_devido_descumprido = '$meses_devido_descumprido', acordo_descumprido = '$tipo', passo_3 = '1' WHERE iduniq = '$iduniq'";


        $inserido = $mysqli->query($sql_code);
        if (!$inserido) {
            $erro[] = "Falha ao inserir no banco de dados: " . $mysqli->error;
        } else {
            $_SESSION['passo_credito'] = 1;
            $_SESSION['controle_click4'] = 1;
            $_SESSION['msg'] = 'Valores de créditos inseridos com sucesso';
            $_SESSION['msg_control'] = 'success';
            die("<script>location.href=\"painel.php?p=montar_acaowizard\";</script>");
        }
    } else {
        $_SESSION['msg'] = "Existe campos obrigatórios que precisam ser preenchidos";
        $_SESSION['msg_control'] = 'error';
        $_SESSION['controle_click3'] = 1;
        die("<script>location.href=\"painel.php?p=montar_acaowizard\";</script>");
    }
}
