<?php
protect(0);
$id = $mysqli->escape_string($_GET['id']);

$mysql_query = $mysqli->query("DELETE FROM dados_acoes WHERE iduniq = '$id'") or die($mysqli->error);

die("<script>location.href=\"painel.php?p=gerenciar_acoes\";</script>");