<html>
<?php
include("lib/conexao.php");

if (isset($_POST['submit2'])) {
    $end_cert = $_POST["end_cert"];
    $cart_cert = $_POST["cart_cert"];
    $mat_cert = $_POST["mat_cert"];
    $liv_cert = $_POST["liv_cert"];
    $cidade_cert = $_POST["cidade_cert"];
    $estado_cert = $_POST["estado_cert"];
    $obs_cert = $_POST["obs_cert"];
    $id = $_SESSION['usuario'];
    $result = mysqli_query($mysqli, "INSERT INTO dados_certidao(endereco_certidao, cartorio_certidao, matricula_certidao, livro_fls_certidao, cidade_certidao, estado_certidao, obs_certidao, id_user)
VALUES ('$end_cert','$cart_cert','$mat_cert','$liv_cert','$cidade_cert','$estado_cert','$obs_cert','$id')");
die("<script>location.href=\"painel.php?p=requer_certidao\";</script>");
}


$ac = "58,80";
$al = "20,50";
$ap = "30,50";
$am = "40,50";
$ba = "103,60";
$ce = "38,77";
$df = "70,50";
$es = "80,37";
$go = "100,74";
$ma = "106,69";
$mt = "42,60";
$ms = "120,50";
$mg = "79,38";
$pa = "52,20";
$pb = "109,38";
$pr = "160,50";
$pe = "42,59";
$pi = "57,32";
$rj = "95,46";
$rn = "200,50";
$rs = "23,90";
$ro = "36,29";
$rr = "230,50";
$sc = "24,18";
$sp = "67,42";
$se = "260,00";
$to = "49,01";


$e = isset($_POST["estados_certidao"]) ? $_POST["estados_certidao"] : 0;
switch ($e) {
    case 1:
        $r = $ac;
        $estado = "Acre";
        break;
    case 2:
        $r = $al;
        $estado = "Alagoas";
        break;
    case 3:
        $r = $ap;
        $estado = "Amapá";
        break;
    case 4:
        $r = $am;
        $estado = "Amazonas";
        break;
    case 5:
        $r = $ba;
        $estado = "Bahia";
        break;
    case 6:
        $r = $ce;
        $estado = "Ceará";
        break;
    case 7:
        $r = $df;
        $estado = "Distrito Federal";
        break;
    case 8:
        $r = $es;
        $estado = "Espírito Santo";
        break;
    case 9:
        $r = $go;
        $estado = "Goiás";
        break;
    case 10:
        $r = $ma;
        $estado = "Maranhão";
        break;
    case 11:
        $r = $mt;
        $estado = "Mato Grosso";
        break;
    case 12:
        $r = $ms;
        $estado = "Mato Grosso do Sul";
        break;
    case 13:
        $r = $mg;
        $estado = "Minas Gerais";
        break;
    case 14:
        $r = $pa;
        $estado = "Pará";
        break;
    case 15:
        $r = $pb;
        $estado = "Paraíba";
        break;
    case 16:
        $r = $pr;
        $estado = "Paraná";
        break;
    case 17:
        $r = $pe;
        $estado = "Pernambuco";
        break;
    case 18:
        $r = $pi;
        $estado = "Piauí";
        break;
    case 19:
        $r = $rj;
        $estado = "Rio de Janeiro";
        break;
    case 20:
        $r = $rn;
        $estado = "Rio Grande do Norte";
        break;
    case 21:
        $r = $rs;
        $estado = "Rio Grande do Sul";
        break;
    case 22:
        $r = $ro;
        $estado = "Rondonia";
        break;
    case 23:
        $r = $rr;
        $estado = "Roraima";
        break;
    case 24:
        $r = $sc;
        $estado = "Santa Catarina";
        break;
    case 25:
        $r = $sp;
        $estado = "São Paulo";
        break;
    case 26:
        $r = $se;
        $estado = "Sergipe";
        break;
    case 27:
        $r = $to;
        $estado = "Tocantins";
        break;
}

?>

<head>


</head>

<body>

    <div class="imovel card">

        <div class="imovel card-block">
            <div class="imovel form_group">
                <form action="" method="POST">
                    <input type="hidden" name="end_cert" value="<?php echo $_POST['endereco_certidao']; ?>" class="form-control">
                    <input type="hidden" name="cart_cert" value="<?php echo $_POST['cartorio_certidao']; ?>" class="form-control">
                    <input type="hidden" name="mat_cert" value="<?php echo $_POST['matricula_certidao'];; ?>" class="form-control">

                    <input type="hidden" name="liv_cert" value="<?php echo $_POST['livro_fls_certidao']; ?>" class="form-control">
                    <input type="hidden" name="cidade_cert" value="<?php echo $_POST['cidade_certidao']; ?>" class="form-control">
                    <input type="hidden" name="estado" value="<?php echo $_POST['estados_certidao']; ?>" class="form-control">

                    <input type="hidden" name="obs_cert" value="<?php echo $_POST['obs_certidao']; ?>" class="form-control">
                    <p>Confira os dados para a certidão</p>

                    <hr>
                    <b>Endereço: </b>
                    <?php
                    echo $_POST['endereco_certidao']; ?>

                    <hr>
                    <b>Cartório:</b>
                    <?php
                    echo $_POST['cartorio_certidao']; ?>

                    <hr>
                    <b>Matrícula:</b>
                    <?php
                    echo $_POST['matricula_certidao']; ?>

                    <hr>
                    <b>Livro e folhas:</b>
                    <?php
                    echo $_POST['livro_fls_certidao']; ?>

                    <hr>
                    <b>Cidade:</b>
                    <?php
                    echo $_POST['cidade_certidao']; ?>

                    <hr>
                    <b>Estado:</b>
                    <?php
                    echo $estado; ?>

                    <hr>
                    <b> Observação:</b>
                    <?php
                    echo $_POST['obs_certidao']; ?>

                    <hr>




                    <?php
                    echo "Emolumentos do Cartório R$ $r <br>";
                    echo "A taxa da BNL é R$ 30,00";

                    ?>





                    <input type="submit" value="confirmar" name="submit2" class="imovel btn btn-success btn-round float-right" />

                </form>
            </div>

        </div>
    </div>


</body>

</html>