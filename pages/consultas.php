<?php 
$iduniq = $_SESSION['iduniq'];
$sql_query = $mysqli->query("SELECT * FROM usuarios WHERE id = '$id'") or die($mysqli->error);
$usuario = $sql_query->fetch_assoc();

$sql_reus = "SELECT * FROM reus WHERE id_usuario='$id' AND iduniq='$iduniq'";
$sql_query2 = $mysqli->query($sql_reus) or die($mysqli->error);
$num_reus = $sql_query2->num_rows;

$sql_query_conferencia = $mysqli->query($sql_reus) or die($mysqli->error);
$num_reus_conferencia = $sql_query_conferencia->num_rows;

$sql_reus_jur = "SELECT * FROM reus_jur WHERE id_usuario='$id' AND id_uniq='$iduniq'";
$sql_query_jur = $mysqli->query($sql_reus_jur) or die($mysqli->error);
$num_reus_jur = $sql_query_jur->num_rows;


$sql_arquivo = "SELECT * FROM arquivos WHERE id_usuario='$id' AND tipo_documento='0'";
$sql_query3 = $mysqli->query($sql_arquivo) or die($mysqli->error);
$num_arquivo = $sql_query3->num_rows;

$sql_arquivo_especifico = "SELECT * FROM arquivos WHERE id_usuario='$id' AND idprocesso='$iduniq' AND tipo_documento='1'";
$sql_query_especifico = $mysqli->query($sql_arquivo_especifico) or die($mysqli->error);
$num_arquivo_especifico = $sql_query_especifico->num_rows;

$sql_arquivo_conferencia = "SELECT * FROM arquivos WHERE id_usuario='$id' AND tipo_documento='0'";
$sql_query_conferencia2 = $mysqli->query($sql_arquivo_conferencia) or die($mysqli->error);
$num_arquivo_conferencia = $sql_query_conferencia2->num_rows;

$sql_arquivo_especifico_conferencia = "SELECT * FROM arquivos WHERE id_usuario='$id' AND idprocesso='$iduniq' AND tipo_documento='1'";
$sql_query_especifico_conferencia = $mysqli->query($sql_arquivo_especifico_conferencia) or die($mysqli->error);
$num_arquivo_especifico_conferencia = $sql_query_especifico_conferencia->num_rows;


$sql_query_imovel_conferencia = "SELECT * FROM dados_acoes WHERE id = '$id' AND iduniq = '$iduniq'";
$dados_imovel_conferencia_query = $mysqli->query($sql_query_imovel_conferencia) or die($mysqli->error);
$num_dados_imovel_query = $dados_imovel_conferencia_query->num_rows;
