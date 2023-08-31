<?php
if (isset($_POST['enviar_complemento'])) {

    $endereco_condominio = $mysqli->escape_string($_POST['endereco_condominio']);
    $cidade_condominio = $mysqli->escape_string($_POST['cidade_condominio']);
    $estado_condominio = $mysqli->escape_string($_POST['estado_condominio']);
    $cep_condominio = $mysqli->escape_string($_POST['cep_condominio']);
    $nome_representante = $mysqli->escape_string($_POST['nome_representante']);
    $cpf_representante = $mysqli->escape_string($_POST['cpf_representante']);
    $nacionalidade_representante = $mysqli->escape_string($_POST['nacionalidade_representante']);
    $profissao_representante = $mysqli->escape_string($_POST['profissao_representante']);
    $endereco_representante = $mysqli->escape_string($_POST['endereco_representante']);
    $cidade_representante = $mysqli->escape_string($_POST['cidade_representante']);
    $estado_representante = $mysqli->escape_string($_POST['estado_representante']);


    $erro = array();
    if (empty($endereco_condominio)) {
        $erro[] = "Preencha o endereço do condomínio";
    }
    if (empty($cidade_condominio)) {
        $erro[] = "Preencha o cidade do condomínio";
    }
    if (empty($estado_condominio)) {
        $erro[] = "Preencha o estado do condomínio";
    }
    if (empty($cep_condominio)) {
        $erro[] = "Preencha o CEP do condomínio";
    }
    if (empty($nome_representante)) {
        $erro[] = "Preencha o nome do representante";
    }
    if (empty($cpf_representante)) {
        $erro[] = "Preencha o cpf do representante";
    }
    if (empty($nacionalidade_representante)) {
        $erro[] = "Preencha o nacionalidade do representante";
    }
    if (empty($profissao_representante)) {
        $erro[] = "Preencha o profissão do representante";
    }
    if (empty($endereco_representante)) {
        $erro[] = "Preencha o endereço do representante";
    }
    if (empty($cidade_representante)) {
        $erro[] = "Preencha o cidade do representante";
    }
    if (empty($estado_representante)) {
        $erro[] = "Preencha o estado do representante";
    }



    if (count($erro) == 0) {


        $sql_code = "INSERT INTO dados_adicionais (id_usuario, endereco_condominio, cidade_condominio, estado_condominio, cep_condominio, nome_representante, cpf_representante, nacionalidade_representante, profissao_representante, endereco_representante, cidade_representante, estado_representante) VALUES(

            '$id',
            '$endereco_condominio',
            '$cidade_condominio',
            '$estado_condominio',
            '$cep_condominio',
            '$nome_representante',
            '$cpf_representante',
            '$nacionalidade_representante',
            '$profissao_representante',
            '$endereco_representante',
            '$cidade_representante',
            '$estado_representante'
            )";


        $inserido = $mysqli->query($sql_code);
        if (!$inserido) {
            $erro[] = "Falha ao inserir no banco de dados: " . $mysqli->error;
?>

            <script>
                var nome_js = "<?php var_dump($erro); ?>";

                alert(nome_js);
            </script>

        <?php
        } else {
        ?>
            <script>
                alert('Inserido com sucesso');
            </script>
<?php
            die("<script>location.href=\"painel.php\";</script>");
        }
    }
}
?>