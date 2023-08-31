<?php

include('lib/conexao.php');
include('lib/protect.php');
protect(0);

$sql_arquivo = "SELECT * FROM arquivos WHERE id_usuario='$id'";
$sql_query3 = $mysqli->query($sql_arquivo) or die($mysqli->error);
$num_arquivo = $sql_query3->num_rows;


?>
<!-- Page-header start -->

<!-- Page-header end -->

<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-6">
            <div class="page-header-title">
                <form method="POST" enctype="multipart/form-data" action="">

                    <label for="file">
                        <p>Selecione os arquivos referentes a esta ação.</p><br>
                        <p>A certidão do imóvel e o cálculo do crédito são documentos essenciais para o êxito da ação.</p>
                        <!-- <input class="input-file" name="arquivos" type="file" id="my-file"> -->
                    </label>

                    <div class="input-file-container">
                        <input class="input-file " name="arquivos" type="file" id="my-file">
                        <label tabindex="0" for="my-file" class="input-file-trigger ">Selecionar</label>
                    </div>
                    <p class="file-return"></p>

                    <div class="col-lg-4 text-left">
                        <div class="form-group">
                            <label for="">Tipo de arquivo</label>
                            <select name="nome">
                                <option value="" selected disabled>Selecione o tipo</option>
                                <option class="cnpj" value="Cartão CNPJ - RFB">Cartão CNPJ - RFB</option>
                                <option class="convencao" value="Convenção do condomínio">Convenção do condomínio</option>
                                <option class="regimento" value="Regimento Interno do Condomínio">Regimento Interno do Condomínio</option>

                                <option class="sindico" value="Ata de nomeação do síndico">Ata de nomeação do síndico</option>
                                <option class="condominial" value="Contrato de administração condominial">Contrato de administração condominial</option>

                                <option value="Atas de 2017">Atas de 2017 (somente as dos creditos)</option>
                                <option value="Atas de 2018">Atas de 2018 (somente as dos creditos)</option>
                                <option value="Atas de 2019">Atas de 2019 (somente as dos creditos)</option>
                                <option value="Atas de 2020">Atas de 2020 (somente as dos creditos)</option>
                                <option value="Atas de 2021">Atas de 2021 (somente as dos creditos)</option>
                                <option value="Atas de 2022">Atas de 2022 (somente as dos creditos)</option>

                                <option value="Outros arquivos relatívos a créditos">Outros arquivos relatívos a créditos</option>

                                <!--  <input type="select" name="nome" class="form-control" size="100" placeholder="Ex: Certidão do imóvel"> -->

                            </select>


                        </div>
                    </div>
                    <button name="upload" class="btn btn-success btn-round float-left" type="submit">Enviar arquivo</button>
                    </p>
                </form>
            </div>
        </div>
        <div class="col-lg-6">
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
</div>




<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Lista de arquivos enviados</h5>
                </div>
                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr><?php if (isset($error)) {
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

                                while ($arquivos = $sql_query3->fetch_assoc()) {
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
                                    <?php }
                                    ?>
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
                            } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>