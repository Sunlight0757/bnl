<?php
if (isset($_POST['idreus']) && isset($_POST['iduniq']) && isset($_POST['nome_reu'])) {
    $nome_reu = $_POST['nome_reu'];
    $id_nump_ntratado = $mysqli->escape_string($_POST['idreus']);
    $tratamento = explode('.', $id_nump_ntratado);
    if ($tratamento[1] == 1) {
        $sql_code = "DELETE FROM reus WHERE id_reu = '$tratamento[0]'";
        $inserido = $mysqli->query($sql_code);
    } elseif ($tratamento[1] == 2)
        $sql_code = "DELETE FROM reus_jur WHERE id_reu = '$tratamento[0]'";
    $inserido = $mysqli->query($sql_code);
    if (!$inserido) { ?>
        <script>
            alert('Falha ao inserir no banco de dados:  <?php $mysqli->error; ?>')
        </script>
<?php
        die("<script>location.href=\"painel.php?p=montar_acaowizard\";</script>");
    } else {
        $_SESSION['msg'] = 'Réu ' . $nome_reu . ' removido com sucesso';
        $_SESSION['msg_control'] = 'success';
        die("<script>location.href=\"painel.php?p=montar_acaowizard\";</script>");
    }
}
?>