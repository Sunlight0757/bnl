<!DOCTYPE html>
<html lang="pt-br">
<?php
include("lib/conexao.php");

/*
if (isset($_POST['submit'])) {


    $end_cert = $mysqli->escape_string($_POST["endereco_certidao"]);
    $cart_cert = $mysqli->escape_string($_POST["cartorio_certidao"]);
    $mat_cert = $mysqli->escape_string($_POST["matricula_certidao"]);
    $liv_cert = $mysqli->escape_string($_POST["livro_fls_certidao"]);
    $cidade_cert = $mysqli->escape_string($_POST["cidade_certidao"]);
    $estado_cert = $mysqli->escape_string($_POST["estado_certidao"]);
    $obs_cert = $mysqli->escape_string($_POST["obs_certidao"]);


    $result = mysqli_query($mysqli, "INSERT INTO dados_certidao(endereco_certidao, cartorio_certidao, matricula_certidao, livro_fls_certidao, cidade_certidao, estado_certidao, obs_certidao)
VALUES ('$end_cert','$cart_cert','$mat_cert','$liv_cert','$cidade_cert','$estado_cert','$obs_cert' )");
}*/
?>

<head>

    <meta charset="utf-8">

    <title>BNL - Assessoria jurídica para condomínios</title>


</head>

<body>
    <div class="imovel card">


        <div class="imovel card-block">
            <div class="imovel form-group">
                <p class="form-control ">
                <h4> <b> Certidão Imobiliária </b></h4>
                A certidão do imóvel prova a propriedade.
                O proprietário é o condômino responsável pelas obrigações condominiais. <br>
                Portanto a certidão é documento necessário para indicar quem responde judicialmente. <br>
                <!--No caso de o condomínio precisar da certidão, a BNL pode a requerer. Basta preencher o número da
                matrícula e o cartório do registro.<br>
                Se não houver tais informações, será preciso pedir busca nos cartórios, antes de pedir a certidão.<br>
                Esse serviço depende do tempo de cada cartório para atendimento.--><br>
                </p>
            </div>
            <hr>

            <form action="painel.php?p=enviar_certidao" method="POST">
                <div class="imovel row d-flex align-items-end">

                    <div class="imovel col-lg-8">
                        <div class="imovel form-group">
                            <label for="endereco_certidao">Endereço</label>
                            <input type="text" value="" name="endereco_certidao" id="endereco_certidao"
                                class="form-control ">
                        </div>
                    </div>
                    <div class="imovel col-lg-5">
                        <div class="imovel form-group">
                            <label for="cartorio_certidao">Cartório do registro</label>
                            <input type="text" value="" name="cartorio_certidao" id="cartorio_certidao"
                                class="form-control " required>
                        </div>
                    </div>

                    <div class="imovel col-lg-2">
                        <div class="imovel form-group">
                            <label for="matricula_certidao">Número da matrícula</label>
                            <input type="text" value="" name="matricula_certidao" id="matricula_certidao"
                                class="form-control " required>
                        </div>
                    </div>
                    <div class="imovel col-lg-3">
                        <div class="imovel form-group">
                            <label for="livro_fls_certidao">Livro e fls</label>
                            <input type="text" value="" name="livro_fls_certidao" id="livro_fls_certidao"
                                class="form-control ">
                        </div>
                    </div>
                    <div class="imovel col-lg-3">
                        <div class="imovel form-group">
                            <label for="cidade_certidao">Cidade</label>
                            <input type="text" value="" name="cidade_certidao" id="cidade_certidao" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="imovel col-lg-3">
                        <div class="imovel form-group">
                            <label for="estados_certidao">Estado</label>
                            <select name="estados_certidao" id="estados_certidao">
                                <option value="1">Acre</option>
                                <option value="2">Alagoas</option>
                                <option value="3">Amapá</option>
                                <option value="4">Amazonas</option>
                                <option value="5">Bahia</option>
                                <option value="6">Ceará</option>
                                <option value="7">Distrito Federal</option>
                                <option value="8">Espírito Santo</option>
                                <option value="9">Goiás</option>
                                <option value="10">Maranhão</option>
                                <option value="11">Mato Grosso</option>
                                <option value="12">Mato Grosso do Sul</option>
                                <option value="13">Minas Gerais</option>
                                <option value="14">Pará</option>
                                <option value="15">Paraíba</option>
                                <option value="16">Paraná</option>
                                <option value="17">Pernambuco</option>
                                <option value="18">Piauí</option>
                                <option value="19">Rio de Janeiro</option>
                                <option value="20">Rio Grande do Norte</option>
                                <option value="21">Rio Grande do Sul</option>
                                <option value="22">Rondônia</option>
                                <option value="23">Roraima</option>
                                <option value="24">Santa Catarina</option>
                                <option value="25">São Paulo</option>
                                <option value="26">Sergipe</option>
                                <option value="27">Tocantins</option>

                            </select>
                        </div>
                    </div>


                    <div class="imovel col-lg-10">
                        <div class="form-group">
                            <label for="obs_certidao">Observação (Opcional)</label>
                            <textarea value="" name="obs_certidao" class="form-control"></textarea>
                        </div>
                    </div>



                    <div class="imovel col-lg-12">

                        <input type="submit" value="Requerer certidão" name="submit"
                            class="imovel btn btn-success btn-round float-right" />


                    </div>
                </div>
            </form>
        </div>



    </div>

</body>

</html>