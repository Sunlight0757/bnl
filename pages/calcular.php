<?php

$pagina = "inicial.php";
if (isset($_GET['p'])) {
    $pagina = $_GET['p'] . ".php";
}
// $id = $_GET['id']
// $id = $_SESSION['usuario'];
// $sql_query_admin = $mysqli->query("SELECT * FROM usuarios WHERE id = '$id'") or die($mysqli->error);
// $dados_usuario = $sql_query_admin->fetch_assoc();


$url = "https://reqbin.com/echo/get/json";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
    "Accept: application/json",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
?>

<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="imovel card">
                <div class="imovel card-header">
                    <h5>Informações básicas para o calculo: </h5>
                </div>
                <div class="imovel card-block">
                    <form class="imovel" action="" method="POST" enctype="multipart/form-data">
                        <div class="imovel row">
                            <!-- <div class="imovel col-lg-5">
                                                        <div class="imovel form-group">
                                                            <label for="">Nome:</label>
                                                            <input type="text" name="unidade" class="form-control">
                                                        </div>
                                                    </div> -->

                            <div class="imovel imovel col-lg-3">
                                <div class="imovel form-group">
                                    <label for="selectCalculo">Índice de correção:</label>
                                    <select id="selectCalculo" class="form-select form-select-sm form-control" aria-label=".form-select-sm example">
                                        <option selected value="1736">INPC</option>
                                        <option value="118">IPCA</option>
                                    </select>
                                </div>
                            </div>

                            <!-- <div class="imovel col-lg-5">
                                                        <div class="imovel form-group">
                                                            <label for="dataOrigin">Data inicial:</label>
                                                            <input id="dataOrigin" type="date" name="unidade" class="date form-control">
                                                        </div>
                                                    </div> -->
                            <div class="imovel col-lg-3">
                                <div class="imovel form-group">
                                    <label for="unidadeDevedora" id="labelUnidadeDevedora">Unidade devedora:</label>
                                    <input id="unidadeDevedora" type="text" name="unidadeDevedora" class="form-control">
                                </div>
                            </div>
                            <div class="imovel col-lg-3">
                                <div class="imovel form-group">
                                    <label for="dataFinal">Data de Atualização:</label>
                                    <input id="dataFinal" type="date" name="unidade" class="form-control">
                                </div>
                            </div>
                            <!-- <div class="imovel col-lg-5">
                                                        <div class="imovel form-group">
                                                            <label for="">Valor:</label>
                                                            <input id="valorCalcular" type="number" name="unidade" class="form-control" data-format="#.00" min="0" >
                                                        </div>
                                                    </div> -->

                            <!-- <div class="imovel col-lg-12">
                                                        <button id="btn-formulario" type="button" name="enviar" class="imovel btn btn-success btn-round float-right">Salvar</button>
                                                    </div> -->
                        </div>
                    </form>
                </div>
            </div>

            <div id="loader" class="loader"></div>
            <div class="imovel card table-responsive mb-1 p-2">
                <div class="imovel card-header">
                    <h5>Insira as informações por parcela mensal, na data de seu respectivo vencimento. </h5>
                </div>
                <table class="table table-borderless table-hover text-center" id="tabela_dinamica">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Data</th>
                            <th scope="col">Valor Original</th>
                            <th scope="col">Valor Corrigido</th>
                            <th scope="col">Juros Moratorios (1 %)</th>
                            <th scope="col">Multa (%)</th>
                            <th scope="col">Honorarios da Convenção (%)</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody id="tabelaLocal">
                        <tr id="row1">
                            <th scope="row"><button type="button" id="exclude1" class="btn btn-danger btn-sm btn_remove">X</button></th>
                            <td><input id="dataOrigin1" type="date" name="unidade" class="date form-control"></td>
                            <td><input id="valorCalcular1" type="text" name="unidade" class="currency form-control"></td>
                            <td id="valor_corrigido1">-</td>
                            <td id="juros_moratorios1">-</td>
                            <td><input id="multa1" type="number" name="multa" class="form-control multa" min="0" maxlength="2"></td>
                            <td><input id="honorarios1" type="number" name="honorarios" class="form-control honorario" min="0" maxlength="2" width="4"></td>
                            <td id="total1">-</td>
                            <input type="hidden" id="valorCorrigidoInput1" name="valorCorrigidoInput1">
                            <input type="hidden" id="jurosMoratoriosInput1" name="jurosMoratoriosInput1">
                            <input type="hidden" id="totalInput1" name="totalInput1">
                        </tr>
                    </tbody>
                </table>
                <div class="imovel col-12">
                    <button id="addbtn" type="button" name="addbtn" class="imovel btn btn-success btn-round float-left">Adicionar Parcela</button>
                </div>
                <div class="imovel col-12">
                    <button id="btn-formulario" type="button" name="enviar" class="imovel btn btn-success btn-round float-right">Calcular total</button>
                </div>
            </div>
            <div class="imovel card card-block table-responsive" id="divTotais" style="display: none;">
                <table class="table table-borderless table-hover w-100 text-center table-hover">
                    <thead>
                        <th scope="col" colspan="3"></th>
                        <th scope="col">Valor Corrigido</th>
                        <th scope="col">Juros Moratorios (R$)</th>
                        <th scope="col">Multa (R$)</th>
                        <th scope="col">Honorarios (R$)</th>
                        <th scope="col">Total</th>
                    </thead>
                    <tbody id="tabelaLocal2" class="table-hover">
                        <tr class="border-bottom border-dark border-3">
                            <th class="text-left" colspan="3">Subtotal</th>
                            <td id="subtotalValorCorrigido">-</td>
                            <td id="subtotalJurosMoratorios">-</td>
                            <td id="subtotalMulta">-</td>
                            <td id="subtotalHonorarios">-</td>
                            <td id="subtotalFinal">-</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <th scope="row" colspan="7" class="text-left"> Honorários da BNL (15%), a receber pelo êxito, ao final: </th>
                            <td id="subtotalHonorariosSucumbenciais" class="text-center">-</td>
                        </tr>
                        <tr>
                            <th scope="row" colspan="7" class="text-left">TOTAL: </th>
                            <td id="valorFinal" class="text-center">-</td>
                        </tr>
                    </tbody>
                </table>
                <div class="imovel col-12">
                    <button id="btn-pdf" type="button" name="pdf" class="imovel btn btn-success btn-round float-right mb-3">Baixar PDF</button>
                </div>


            </div>

        </div>
    </div>
</div>



<script type="text/javascript" src="assets/js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="assets/js/popper.js/popper.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>
<!-- modernizr js -->
<script type="text/javascript" src="assets/js/modernizr/modernizr.js"></script>
<script type="text/javascript" src="assets/js/modernizr/css-scrollbars.js"></script>
<!-- classie js -->
<script type="text/javascript" src="assets/js/classie/classie.js"></script>
<!-- Custom js -->
<script type="text/javascript" src="assets/js/script.js"></script>
<script src="assets/js/pcoded.min.js"></script>
<script src="assets/js/demo-12.js"></script>
<script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>

<!-- Calculos -->
<!-- <script type="text/javascript" src="assets/js/jquery/jquery.maskMoney.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.2/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.2/vfs_fonts.js"></script>
<script type="text/javascript" src="assets/js/services/calculo_imposto.js"></script>

</body>

</html>