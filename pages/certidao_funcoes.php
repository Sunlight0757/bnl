<?php
//session_start();
require("lib/conexao.php");

function buscar_certidoes($mysqli)
{
    $sqlBusca = 'SELECT * FROM dados_certidao';
    $resultado = mysqli_query($mysqli, $sqlBusca);

    $certidoes = [];

    while ($certidao = mysqli_fetch_assoc($resultado)) {
        $certidoes = $certidao;
    }

    return $certidoes;

}