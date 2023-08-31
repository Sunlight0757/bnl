<?php
if (isset($_FILES['arquivos'])) {
    $arquivo = $_FILES['arquivos'];
    $error = false;
    $nome = $_POST['nome'];
    if ($arquivo['error'])
        $error = "Falha ao enviar arquivo";

    if ($arquivo['size'] > 8388608)
        $error = "Arquivo muito grande!! Max: 4MB";

    $id_random = rand(62, 62);
    $iduniq = substr(str_shuffle("AaBbCcDdEeFfGgHhIiJjKkLlMmNnPpQqRrSsTtUuVvYyXxWwZz0123456789"), 0, $id_random);
    $size = $arquivo['size'];
    $pasta = "../arquivos";
    $idprocesso = $_SESSION['iduniq'];
    $nomeDoArquivo = $arquivo['name'];
    $novoNomeDoArquivo = uniqid();
    $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

    if (empty($nome))
        $error = "Selecione o tipo de arquivo.";
    if ($extensao != "jpg" && $extensao != 'png' && $extensao != 'pdf' && $extensao != 'gif')
        $error = "Tipo de arquivo não aceito";
    if ($error) {
        $deu_certo = false;
    } else {
        $path = $pasta . $novoNomeDoArquivo . "." . $extensao;
        $deu_certo = move_uploaded_file($arquivo['tmp_name'], $pasta . $novoNomeDoArquivo . "." . $extensao);
    }
    if ($deu_certo) {
        $mysqli->query("INSERT INTO arquivos (path, data_envio, id_usuario, idprocesso, iduniq, nome_arquivo, tipo, size, nome, tipo_documento) 
        VALUES('$path', NOW(), '$id','$idprocesso', '$iduniq', '$nomeDoArquivo', '$extensao','$size', '$nome', 1)") or die($mysqli->error);
        $_SESSION['controle_click4'] = 1;
        $_SESSION['msg'] = 'Arquivo referente ao ' . $nome . ' enviado com sucesso';
        $_SESSION['msg_control'] = 'success';
?>
    <?php
        die("<script>location.href=\"painel.php?p=montar_acaowizard\";</script>");
    } else {
        $_SESSION['msg'] = "Falha ao enviar arquivo.";
        $_SESSION['msg_control'] = 'error';
        $_SESSION['controle_click4'] = 1;
        die("<script>location.href=\"painel.php?p=montar_acaowizard\";</script>");
    }
}
?>