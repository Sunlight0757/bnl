<?php
include("lib/conexao.php");
include("lib/enviarArquivo.php");
include('lib/protect.php');

protect(0);

if (isset($_POST['enviar'])) {

    $periodo_inicio = $mysqli->escape_string($_POST['periodo_inicio']);
    $valor_devido = $mysqli->escape_string($_POST['valor_devido']);
    $meses_devido = $mysqli->escape_string($_POST['meses_devido']);
    $multa = $mysqli->escape_string($_POST['multa']);
    $honorarios = $mysqli->escape_string($_POST['honorarios']);


    $erro = array();
    if (empty($periodo_inicio)) {
        $erro[] = "Preencha o período";
    }
    if (empty($valor_devido)) {
        $erro[] = "Preencha o valor devido";
    }
    if (empty($meses_devido)) {
        $erro[] = "Preencha a quantidade de meses devido";
    }
    if (empty($honorarios)) {
        $erro[] = "Preencha a multa contratual";
    }
    if (empty($multa)) {
        $erro[] = "Preencha os honorários contratuais";
    }
    if (count($erro) == 0) {


        $sql_code = "UPDATE dados_acoes SET periodo_inicio = '$periodo_inicio', valor_devido = '$valor_devido', meses_devido = '$meses_devido' ,
         multa = '$multa', honorarios = '$honorarios', passo_processo = '3' WHERE id_processos = '$id_processos'";
        $inserido = $mysqli->query($sql_code);
        if (!$inserido) {
            $erro[] = "Falha ao inserir no banco de dados: " . $mysqli->error;
        }
    }
}


$sql_query = $mysqli->query("SELECT * FROM usuarios WHERE id = '$id'") or die($mysqli->error);
$usuario = $sql_query->fetch_assoc();




?>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- Page-header start -->
<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-6">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>Montar ação - Passo 2</h4>
                    <span>Preencha as informações e clique em Salvar</span>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Page-header end -->

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <?php if (isset($erro) && count($erro) > 0) {
            ?>
                <div class="alert alert-danger" role="alert">
                    <?php foreach ($erro as $e) {
                        echo "$e<br>";
                    } ?>
                </div>
            <?php
            }
            ?>
            <div class="card">
                <div class="card-header">
                    <h5>Informações do representante jurídico</h5>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Nome: </label><br><?php echo $usuario['nome_jur']; ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">E-mail: </label><br><?php echo $usuario['email']; ?>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">CNPJ: </label><br><?php echo $usuario['cnpj']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="descumprido card">
                <div class="card-header">
                    <h5>Complete seu cadastro. (Obrigatório)</h5>
                </div>
                <div class="card-block">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="">Endereço do condomínio:</label>
                                    <input type="text" name="periodo_inicio" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="">Telefone:</label>
                                    <input type="text" name="multa" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="">Estado do condomínio:</label>
                                    <select name="uf" id="uf">
                                    </select>
                                    &nbsp;
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="">Cidade do condomínio:</label>
                                    <select name="cidade" id="cidade">
                                    </select>
                                    &nbsp;
                                </div>
                            </div>

                        </div>
                </div>
            </div>

            <div class="descumprido card">
                <div class="card-header">
                    <h5>Dados do Representante</h5>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="">Tipo de Pessoa:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <input name="tipo" value="pessoaFisica" type="radio">Física&nbsp;&nbsp;&nbsp;&nbsp;<input name="tipo" value="pessoaJuridica" type="radio">Jurídica
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="campoPessoaFisica col-lg-5">
                            <div class="form-group">
                                <label for="">Nome do representante legal:</label>
                                <input name="nome_rep" id="nome_rep" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="campoPessoaFisica col-lg-5">
                            <div class="form-group">
                                <label for="">CPF:</label>
                                <input name="cpf" id="cpf" placeholder="000.000.000-00" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="campoPessoaFisica col-lg-5">
                            <div class="form-group">
                                <label for="">Nacionalidade:</label>
                                <input name="nacionalidade" id="nacionalidade" placeholder="Exemplo: Brasileiro" class="form-control">
                            </div>
                        </div>

                        <div class="campoPessoaFisica col-lg-5">
                            <div class="form-group">
                                <label for="">Profissão:</label>
                                <input name="profissao" id="profissao" placeholder="Exemplo: Advogado" class="form-control">
                            </div>
                        </div>
                        <div class="campoPessoaFisica col-lg-5">
                            <div class="form-group">
                                <label for="">Endereço do representante:</label>
                                <input type="text" name="multa" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="campoPessoaFisica col-lg-5">
                            <div class="form-group">
                                <label for="">Estado do representante:</label>
                                <select name="ufrep" id="ufrep">
                                </select>
                            </div>
                        </div>
                        <div class="campoPessoaFisica col-lg-5">
                            <div class="form-group">
                                <label for="">Cidade do representante:</label>
                                <select name="cidaderep" id="cidaderep">
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="campoPessoaJuridica col-lg-5">
                            <div class="form-group">
                                <label for="">Nome da empresa:</label>
                                <input type="text" name="valor_devido" class="form-control">
                            </div>
                        </div>
                        <div class="campoPessoaJuridica col-lg-5">
                            <div class="form-group">
                                <label for="">CNPJ:</label>
                                <input type="text" name="meses_devido" class="form-control">
                            </div>
                        </div>

                        <div class="campoPessoaJuridica col-lg-5">
                            <div class="form-group">
                                <label for="">Endereço:</label>
                                <input type="text" name="multa" class="form-control">
                            </div>
                        </div>
                        <div class="campoPessoaJuridica col-lg-5">
                            <div class="form-group">
                                <label for="">Nome do preposto:</label>
                                <input type="text" name="multa" class="form-control">
                            </div>
                        </div>
                        <div class="campoPessoaJuridica col-lg-5">
                            <div class="form-group">
                                <label for="">Endereço do representante:</label>
                                <input type="text" name="multa" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="campoPessoaJuridica col-lg-5">
                            <div class="form-group">
                                <label for="">Estado do representante:</label>
                                <select name="ufrep2" id="ufrep2">
                                </select>
                            </div>
                        </div>
                        <div class="campoPessoaJuridica col-lg-5">
                            <div class="form-group">
                                <label for="">Cidade do representante:</label>
                                <select name="cidaderep2" id="cidaderep2">
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <button type="submit" name="enviar" value="1" class="btn btn-success btn-round"><i class="ti-save"></i> Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <script>
                const ulrUF = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados'

                const cidade = document.getElementById("cidade")
                const uf = document.getElementById("uf")

                const cidaderep = document.getElementById("cidaderep")
                const ufrep = document.getElementById("ufrep")

                const cidaderep2 = document.getElementById("cidaderep2")
                const ufrep2 = document.getElementById("ufrep2")

                function createOptionsCidade(response, label) {
                    let options = `<optgroup label='${label}'>`
                    response.forEach((cidades) => {
                        options += ('<option>' + cidades.nome + '</option>')
                    })
                    options += '</optgroup>'
                    return options
                }

                function createOptionsUFs(response, label) {
                    let options = `<optgroup label='${label}'>`
                    response.forEach((uf) => {
                        options += '<option>' + uf.sigla + '</option>'
                    })
                    options += '</optgroup>'
                    return options
                }
                async function fetchAPIIBGE(url) {
                    const request = await fetch(url)
                    const response = await request.json()
                    return response
                }

                uf.addEventListener('change', async function() {
                    const response = await fetchAPIIBGE(`${ulrUF}/${uf.value}/municipios`)
                    cidade.innerHTML = createOptionsCidade(response, "Cidades")
                })
                ufrep.addEventListener('change', async function() {
                    const response = await fetchAPIIBGE(`${ulrUF}/${ufrep.value}/municipios`)
                    cidaderep.innerHTML = createOptionsCidade(response, "UFs")
                })
                ufrep2.addEventListener('change', async function() {
                    const response = await fetchAPIIBGE(`${ulrUF}/${ufrep2.value}/municipios`)
                    cidaderep2.innerHTML = createOptionsCidade(response, "UFs")
                })

                window.addEventListener('load', async () => {
                    let response = await fetchAPIIBGE(ulrUF)
                    uf.innerHTML = createOptionsUFs(response, "UFs")
                    ufrep.innerHTML = createOptionsUFs(response, "UFs")
                    ufrep2.innerHTML = createOptionsUFs(response, "UFs")

                    response = await fetchAPIIBGE(`${ulrUF}/${uf.value}/municipios`)
                    cidade.innerHTML = createOptionsCidade(response, "Cidades")
                    response = await fetchAPIIBGE(`${ulrUF}/${ufrep.value}/municipios`)
                    cidaderep.innerHTML = createOptionsCidade(response, "Cidades")
                    response = await fetchAPIIBGE(`${ulrUF}/${ufrep2.value}/municipios`)
                    cidaderep2.innerHTML = createOptionsCidade(response, "Cidades")
                })
            </script>
            <script>
                $(document).ready(function() {
                    $(".campoPessoaJuridica, .campoPessoaFisica").hide();
                });

                $("input:radio[name=tipo]").on("change", function() {
                    if ($(this).val() == "pessoaFisica") {
                        $(".campoPessoaFisica").show();
                        $(".campoPessoaJuridica").hide();
                    } else if ($(this).val() == "pessoaJuridica") {
                        $(".campoPessoaFisica").hide();
                        $(".campoPessoaJuridica").show();
                    }
                });
            </script>
            <script>
                $("#cpf").mask("999.999.999-99");
                $("#cnpj").mask("99.999.999/9999-99");
                $("#cnpj_rep").mask("99.999.999/9999-99");
                $("#telefone").mask("(99)9999-9999");
                $("#telefone_rep").mask("(99)9999-9999");
            </script>
        </div>
    </div>
</div>
</div>
<script src="js/jquery-3.4.1.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/popper.min.js"></script>