<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<?php

include("lib/conexao.php");
protect(0);

$error = false;
if (isset($_FILES['arquivos'])) {
    $arquivo = $_FILES['arquivos'];
    $error = false;
    $nome = $_POST['nome'];
    if ($arquivo['error'])
        $error = "Falha ao enviar arquivo";
        print_r($arquivo['error']);

    if ($arquivo['size'] > 8388608)
        $error = "Arquivo muito grande!! Max: 4MB";

    $id_random = rand(62, 62);
    $iduniq = substr(str_shuffle("AaBbCcDdEeFfGgHhIiJjKkLlMmNnPpQqRrSsTtUuVvYyXxWwZz0123456789"), 0, $id_random);
    $size = $arquivo['size'];
    $pasta = "arquivos/";
    $idprocesso = 0;
    $nomeDoArquivo = $arquivo['name'];
    $novoNomeDoArquivo = uniqid();
    $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

    if (empty($nome))
        $error = "Selecione o tipo de arquivo";
    if ($extensao != "jpg" && $extensao != 'png' && $extensao != 'pdf' && $extensao != 'gif')
        $error = "Tipo de arquivo não aceito";
    if ($error) {
        $deu_certo = false;
    } else {
        $path = $pasta . $novoNomeDoArquivo . "." . $extensao;
        $deu_certo = move_uploaded_file($arquivo['tmp_name'], $pasta . $novoNomeDoArquivo . "." . $extensao);
    }
    if ($deu_certo) {
        $mysqli->query("INSERT INTO arquivos (path, data_envio, id_usuario, idprocesso, iduniq, nome_arquivo, tipo, size, nome, tipo_documento) 
        VALUES('$path', NOW(), '$id','$idprocesso', '$iduniq', '$nomeDoArquivo', '$extensao','$size', '$nome', 0)") or die($mysqli->error); ?>
        <script>
            $(document).ready(function() {

                $("#4").trigger("click");

            });
        </script>
<?php
    }
}
$sql_arquivo = "SELECT * FROM arquivos WHERE id_usuario='$id' AND tipo_documento='0'";
$sql_query = $mysqli->query($sql_arquivo) or die($mysqli->error);
$num_arquivo = $sql_query->num_rows;

?>
<div class="page-header card pb-0">
    <div class="row">
        <div class="row">
            <div class="col-lg-9">
                <h2>Documentação geral</h2>
                <h6 class="mt-1">Os documentos ficarão armazenados em segurança no nosso banco de dados e poderão ser usados somente por você, em todas as suas ações.</h6>
            </div>
            <div class="col-lg-3">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="painel.php">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            Gerenciador de Arquivos
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row p-0 mt-5">
            <div class="col-xl-3">
                <form method="POST" enctype="multipart/form-data" action="">
                    <div class="card card-block">
                        <label for="file" class="col-lg-12">
                            <p>Selecione o arquivo</p><br>
                            <!-- <input class="input-file" name="arquivos" type="file" id="my-file"> -->
                        </label>
                        <div class="col-lg-12">
                            <div class="input-file-container">
                                <input class="input-file " name="arquivos" type="file" id="my-file">
                                <label tabindex="0" for="my-file" class="input-file-trigger">Selecione um arquivo</label>
                            </div>
                        </div>
                        <p class="file-return"></p>
                        <div class="col-lg-12 p-0">
                            <div class="form-group">
                                <label for="selectTipoArquivo" class="mt-3">Tipo de arquivo</label>
                                <select class="form-select" name="nome" id="selectTipoArquivo" style="width: 100%;">
                                    <option value="" selected disabled>Selecione o tipo</option>
                                    <option class="cnpj" value="Cartão CNPJ - RFB">Cartão CNPJ - RFB</option>
                                    <option class="convencao" value="Convenção do condomínio">Convenção do condomínio</option>
                                    <option class="regimento" value="Regimento Interno do Condomínio">Regimento Interno do Condomínio</option>

                                    <option class="sindico" value="Ata de nomeação do síndico">Ata de nomeação do síndico</option>
                                    <option class="condominial" value="Contrato de administração condominial">Contrato de administração condominial</option>

                                    <option value="Atas de 2018">Atas de 2018 (somente as dos creditos)</option>
                                    <option value="Atas de 2019">Atas de 2019 (somente as dos creditos)</option>
                                    <option value="Atas de 2020">Atas de 2020 (somente as dos creditos)</option>
                                    <option value="Atas de 2021">Atas de 2021 (somente as dos creditos)</option>
                                    <option value="Atas de 2022">Atas de 2022 (somente as dos creditos)</option>
                                    <option value="Atas de 2022">Atas de 2023 (somente as dos creditos)</option>

                                    <option value="Outros arquivos relatívos a créditos">Outros arquivos relatívos a créditos</option>

                                    <!--  <input type="select" name="nome" class="form-control" size="100" placeholder="Ex: Certidão do imóvel"> -->

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 d-flex justify-content-end align-items-end">
                            <button name="upload" class="btn btn-success btn-round" type="submit" style="max-width: fit-content;">Enviar arquivo</button>
                        </div>
                        </p>
                    </div>
                </form>
            </div>
            <div class="col-xl-9">
                <div class="card p-2">
                    <div class="card-header p-2">
                        <h5>Lista de arquivos enviados</h5>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr><?php if ($error) {
                                    ?>
                                        <div class="alert alert-danger" role="alert">
                                        <?php
                                        echo "$error<br>";
                                    }
                                        ?>
                                        </div>
                                        <th>Título do arquivo</th>
                                        <th>Data de envio e Horário</th>
                                        <th>Extensão</th>
                                        <th>Tamanho</th>
                                        <th>Tipo</th>
                                </tr>
                            </thead>
                            <?php if ($num_arquivo == 0) { ?>
                                <tr>
                                    <td colspan="5">Nenhuma arquivo enviado</td>
                                </tr>
                                <?php } else {

                                while ($arquivos = $sql_query->fetch_assoc()) {
                                    if (($arquivos['tipo_documento']) == 0) {
                                        if (($arquivos['nome']) == "Convenção do condomínio") { ?>
                                            <script>
                                                $(document).ready(function() {
                                                    $(".convencao").hide();
                                                });
                                            </script>
                                        <?php }
                                        if (($arquivos['nome']) == "Cartão CNPJ - RFB") { ?>
                                            <script>
                                                $(document).ready(function() {
                                                    $(".cnpj").hide();
                                                });
                                            </script>
                                        <?php }
                                        if (($arquivos['nome']) == "Regimento Interno do Condomínio") { ?>
                                            <script>
                                                $(document).ready(function() {
                                                    $(".regimento").hide();
                                                });
                                            </script>
                                        <?php }
                                        if (($arquivos['nome']) == "Ata de nomeação do síndico") { ?>
                                            <script>
                                                $(document).ready(function() {
                                                    $(".sindico").hide();
                                                });
                                            </script>
                                        <?php }

                                        if (($arquivos['nome']) == "Contrato de administração condominial") { ?>
                                            <script>
                                                $(document).ready(function() {
                                                    $(".condominial").hide();
                                                });
                                            </script>
                                        <?php } ?>
                                        <tr>
                                            <th scope="row"><a target="_blank" href="<?php echo $arquivos['path']; ?>"><?php echo substr($arquivos['nome_arquivo'], 0, 30); ?></a></th>
                                            <td><?php echo date("d/m/Y - H:i", strtotime($arquivos['data_envio'])); ?></td>
                                            <td><?php echo $arquivos['tipo']; ?>
                                            <td><?php echo substr($arquivos['size'], 0, 3); ?>KB
                                            <td><?php echo $arquivos['nome']; ?>
                                            <td> <a href="painel.php?p=deletar_arquivo&iduniq=<?php echo $arquivos['iduniq']; ?>">Deletar</a></td>
                                        </tr>
                            <?php
                                    }
                                }
                            } ?>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="pages/js/nomearquivo.js"></script>