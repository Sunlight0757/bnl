<?php
$host = "dadosbnl.mysql.dbaas.com.br";
$user = "dadosbnl";
$pass = "Bmlxyz3@nabnab";
$bd = "dadosbnl";

$mysqli = new mysqli($host, $user, $pass, $bd);

/* check connection */
if ($mysqli->connect_errno) {
    echo "Connect failed: " . $mysqli->connect_error;
    exit();
}