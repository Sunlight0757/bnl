<?php
if (isset($_POST['enviar_reus'])) {

    $nome_reu = $mysqli->escape_string($_POST['nome_reu']);
    $cpf_reu = $mysqli->escape_string($_POST['cpf_reu']);
    $endereco_reu = $mysqli->escape_string($_POST['endereco_reu']);
    $cep_reu = $mysqli->escape_string($_POST['cep_reu']);
    $profissao_reu = $mysqli->escape_string($_POST['profissao_reu']);
    $estadocivil_reu = $mysqli->escape_string($_POST['estadocivil_reu']);
    $estado_reu = $mysqli->escape_string($_POST['estado_reu']);
    $cidade_reu = $mysqli->escape_string($_POST['cidade_reu']);
    $genero_pfisica = $mysqli->escape_string($_POST['genero_pfisica']);

    $iduniq = $_SESSION['iduniq'];


    $erro = array();
    if (empty($nome_reu)) {
        $erro[] = "Preencha o nome do réu";
    }
    if (empty($cpf_reu)) {
        $erro[] = "Preencha o CPF do réu";
    }
    if (empty($endereco_reu)) {
        $erro[] = "Preencha o endereco do réu";
    }
    if (empty($cep_reu)) {
        $erro[] = "Preencha o CEP do réu";
    }
    if (empty($profissao_reu)) {
        $erro[] = "Preencha o profissão do réu";
    }
    if (empty($estadocivil_reu)) {
        $erro[] = "Preencha o estado civil do réu";
    }
    if (empty($estado_reu)) {
        $erro[] = "Preencha o estado do réu";
    }
    if (empty($cidade_reu)) {
        $erro[] = "Preencha o cidade do réu";
    }



    if (count($erro) == 0) {


        $sql_code = "INSERT INTO reus (id_usuario, nome_reu, cpf_reu, endereco_reu, iduniq, cep_reu, profissao_reu, estadocivil_reu, estado_reu, cidade_reu, genero_pfisica) VALUES(

                '$id',
                '$nome_reu',
                '$cpf_reu',
                '$endereco_reu',
                '$iduniq',
                '$cep_reu',
                '$profissao_reu',
                '$estadocivil_reu',
                '$estado_reu',
                '$cidade_reu',
                '$genero_pfisica'
                )";

        $sql_reus = "SELECT * FROM reus WHERE id_usuario='$id' AND iduniq='$iduniq'";
        $sql_query2 = $mysqli->query($sql_reus) or die($mysqli->error);
        $num_reus = $sql_query2->num_rows;

        if ($num_reus == 0) {
            $_SESSION['reu_primario'] = 0;
        }

        if (!isset($_SESSION['reu_primario']) || $_SESSION['reu_primario'] == 0) {

            $sql_code2 = "UPDATE dados_acoes SET reu_principal = '$nome_reu' WHERE iduniq = '$iduniq'";
            $inserido2 = $mysqli->query($sql_code2);
        }

        $inserido = $mysqli->query($sql_code);
        if (!$inserido) {
            $erro[] = "Falha ao inserir no banco de dados: " . $mysqli->error;
        } else {
            $_SESSION['reu_primario'] = 1;
            $_SESSION['msg'] = 'Réu '.$nome_reu.' inserido com sucesso';
            $_SESSION['msg_control'] = 'success';
            die("<script>location.href=\"painel.php?p=montar_acaowizard\";</script>");
        }
    } else { 
        $_SESSION['msg'] = "Existe campos obrigatórios que precisam ser preenchidos";
        $_SESSION['msg_control'] = 'error';
        die("<script>location.href=\"painel.php?p=montar_acaowizard\";</script>");
    }
}
