<?php
protect(0);
$iduniq = $mysqli->escape_string($_GET['iduniq']);
$mysql_query = $mysqli->query("DELETE FROM arquivos WHERE iduniq = '$iduniq'") or die($mysqli->error);
 die("<script>location.href=\"painel.php?p=documentacao_geral\";</script>");