<?php
 if (isset($_GET['id'])) {

    $_SESSION['iduniq'] = $_GET['id'];
    $iduniq =  $_SESSION['iduniq'];

    $sql_query = $mysqli->query("SELECT * FROM dados_acoes WHERE id = '$id' AND iduniq = '$iduniq'") or die($mysqli->error);
    $passos = $sql_query->fetch_assoc();

    $_SESSION['passo_reus'] = $passos['passo_1'];
    $_SESSION['passo_imovel'] = $passos['passo_2'];
    $_SESSION['passo_credito'] = $passos['passo_3'];
    $_SESSION['passo_upload'] = $passos['passo_4'];
    $_SESSION['passo_conferencia'] = $passos['passo_5'];
}
?>