<?php
if (isset($_POST['enviar_reus_jur'])) {

    $nome_reu_jur = $mysqli->escape_string($_POST['nome_reu_jur']);
    $cnpj_reu_jur = $mysqli->escape_string($_POST['cnpj_reu_jur']);
    $genero_pjuridica = $mysqli->escape_string($_POST['genero_pjuridica']);
    $endereco_reu_jur = $mysqli->escape_string($_POST['endereco_reu_jur']);
    $cep_reu_jur = $mysqli->escape_string($_POST['cep_reu_jur']);
    $estado_reu_jur = $mysqli->escape_string($_POST['estado_reu_jur']);
    $cidade_reu_jur = $mysqli->escape_string($_POST['cidade_reu_jur']);
    $nome_representante = $mysqli->escape_string($_POST['nome_representante']);
    $cpf_representante = $mysqli->escape_string($_POST['cpf_representante']);
    $nacionalidade_representante = $mysqli->escape_string($_POST['nacionalidade_representante']);

    $iduniq = $_SESSION['iduniq'];

    $erro = array();
    if (empty($nome_reu_jur)) {
        $erro[] = "Preencha o nome do réu";
    }
    if (empty($cnpj_reu_jur)) {
        $erro[] = "Preencha o CNPJ do réu";
    }
    if (empty($endereco_reu_jur)) {
        $erro[] = "Preencha o endereco do réu";
    }
    if (empty($cep_reu_jur)) {
        $erro[] = "Preencha o CEP do réu";
    }
    if (empty($estado_reu_jur)) {
        $erro[] = "Preencha o estado do réu";
    }
    if (empty($cidade_reu_jur)) {
        $erro[] = "Preencha o cidade do réu";
    }
    if (empty($nome_representante)) {
        $erro[] = "Preencha o nome do representante";
    }
    if (empty($cpf_representante)) {
        $erro[] = "Preencha o CPF do representante";
    }
    if (empty($nacionalidade_representante)) {
        $erro[] = "Preencha a nacionalidade do representante";
    }
    if (count($erro) == 0) {


        $sql_code = "INSERT INTO reus_jur (id_uniq, id_usuario, nome_reu, cnpj, genero, endereco_reu, cep_reu, estado_reu, cidade_reu, nome_representante, cpf_representante, nacionalidade_representante) VALUES(

            '$iduniq',
            '$id',
            '$nome_reu_jur',
            '$cnpj_reu_jur',
            '$genero_pjuridica',
            '$endereco_reu_jur',
            '$cep_reu_jur',
            '$estado_reu_jur',
            '$cidade_reu_jur',
            '$nome_representante',
            '$cpf_representante',
            '$nacionalidade_representante'
            )";

        $inserido = $mysqli->query($sql_code);
        if (!$inserido) {
            $erro[] = "Falha ao inserir no banco de dados: " . $mysqli->error;
        } else {
            $_SESSION['msg'] = 'Réu ' . $nome_reu_jur . ' inserido com sucesso';
            $_SESSION['msg_control'] = 'success';
?>
        <?php
            die("<script>location.href=\"painel.php?p=montar_acaowizard\";</script>");
        }
    } else {
        $_SESSION['msg'] = "Existe campos obrigatórios que precisam ser preenchidos";
        $_SESSION['msg_control'] = 'error';
        die("<script>location.href=\"painel.php?p=montar_acaowizard\";</script>");
    }
}

        ?>