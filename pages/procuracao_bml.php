<?php
session_start();
require "conexao.php";

$sql_pjuridica = "SELECT * FROM pessoa_juridica WHERE ";
$sql_query_pjuridica = $mysqli->query($sql_pjuridica) or die($mysqli->error);
?>

<!DOCTYPE html>

<html>

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
	<link href="css/procuracao.css" rel="stylesheet" type="text/css">

</head>

<body>
	<a href="javascript: history.back()" class="print" style="background-color: lightgray" id="botaovoltar" onclick="<?php unset($_SESSION['id_processo']);
																														?>">Voltar</a>
	<input type="button" class="print" value="Imprimir" onClick="window.print()" />

	<div>
		<h2> <b> PROCURAÇÃO </b> </h2>
		<br><br><br>
		<p> Pelo presente instrumento de procuração,
			<b>
				<?php
				$outorgante = $sql_query_pjuridica->fetch_assoc();
				echo mb_strtoupper($outorgante["nome_pjuridica"], 'UTF-8')
				?></b>, pessoa jurídica de direito privado, CNPJ n.
			<?php
			echo $outorgante["cnpj_pjuridica"]
			?>, com sede à
			<?php
			echo $outorgante["endereco_pjuridica"]
			?>,
			<?php
			echo $outorgante["cidade_pjuridica"]
			?>,
			<?php
			echo $outorgante["estado_pjuridica"]
			?>,
			<?php
			echo $outorgante["cep_pjuridica"]
			?>, neste ato representada por
			<b><?php
				echo mb_strtoupper($outorgante["nome_representante"], 'UTF-8')
				?></b>,
			<?php
			echo $outorgante["cpf_representante"]
			?>,
			<?php
			echo $outorgante["nacionalidade_representante"]
			?>,
			<?php
			echo $outorgante["profissao_representante"]
			?>, com endereço à
			<?php
			echo $outorgante["endereco_representante"]
			?>,
			<?php
			echo $outorgante["cidade_representante"]
			?>,
			<?php
			echo $outorgante["estado_representante"]
			?>, nomeia e constitui seu bastante advogado <B> NILO ALVES BEZERRA</B>, brasileiro, inscrito na Ordem dos
			Advogados do Brasil, seção MT, sob o número 2830, com escritório em Cuiabá, MT, à Rua General Vale, 321,
			sala 806, CEP 78010-000, a quem confere amplos poderes para o foro em geral, com a cláusula <i>“ad
				judicia”</i>, para qualquer juízo, Instância ou Tribunal, podendo propor contra quem de direito as
			competentes ações ou promover sua defesa nas adversas, seguindo umas e outras até final decisão, usando dos
			recursos legais, acompanhando-as, conferindo-lhe, também, poderes especiais para confessar, transigir,
			desistir, firmar compromissos, receber e dar quitações, podendo substabelecer, com ou sem reserva de
			poderes, especialmente para promover ação judicial a fim de receber créditos provinientes de inadimplência
			de obrigações condominiais.
			<br>
		<p id="localDatat">
			<?php
			echo $outorgante["cidade_pjuridica"]
			?>,
			<script>
				var data = new Date();
				var dia = data.getDate();
				var mes = data.getMonth();
				var mesExtenso;
				var dataExtenso;

				switch (mes) {
					default:
						mesExtenso = "janeiro";
						break;
					case 1:
						mesExtenso = "fevereiro";
						break;
					case 2:
						mesExtenso = "março";
						break;
					case 3:
						mesExtenso = "abril";
						break;
					case 4:
						mesExtenso = "maio";
						break;
					case 5:
						mesExtenso = "junho";
						break;
					case 6:
						mesExtenso = "julho";
						break;
					case 7:
						mesExtenso = "agosto";
						break;
					case 8:
						mesExtenso = "setembro";
						break;
					case 9:
						mesExtenso = "outubro";
						break;
					case 10:
						mesExtenso = "novembro";
					case 11:
						mesExtenso = "dezembro";
						break;
				}
				dataExtenso = data.getDate() + " de " + mesExtenso + " de " + data.getFullYear()
				document.write(data.getDate() + " de " + mesExtenso + " de " + data.getFullYear())
			</script>
			<br><br><br><br><br>
		<div id="assinatura">

			<?php
			echo $outorgante["nome_pjuridica"]
			?>

		</div>
		</p>
		<button id="download-pdf">Download</button>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.2/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.2/vfs_fonts.js"></script>
	<script src="js/imprimirProcuracao.js"></script>
	<script>
		var nome_pjuridica = "<?php echo $outorgante["nome_pjuridica"]; ?>"
		var cnpj_pjuridica = "<?php echo $outorgante["cnpj_pjuridica"]; ?>"
		var endereco_pjuridica = "<?php echo $outorgante["endereco_pjuridica"]; ?>"
		var cidade_pjuridica = "<?php echo $outorgante["cidade_pjuridica"]; ?>"
		var estado_pjuridica = "<?php echo $outorgante["estado_pjuridica"]; ?>"
		var cep_pjuridica = "<?php echo $outorgante["cep_pjuridica"]; ?>"
		var nome_representante = "<?php echo $outorgante["nome_representante"]; ?>"
		var cpf_representante = "<?php echo $outorgante["cpf_representante"]; ?>"
		var nacionalidade_representante = "<?php echo $outorgante["nacionalidade_representante"]; ?>"
		var profissao_representante = "<?php echo $outorgante["profissao_representante"]; ?>"
		var endereco_representante = "<?php echo $outorgante["endereco_representante"]; ?>"
		var cidade_representante = "<?php echo $outorgante["cidade_representante"]; ?>"
		var estado_representante = "<?php echo $outorgante["estado_representante"]; ?>"
		var cidade_pjuridica = "<?php echo $outorgante["cidade_pjuridica"]; ?>"
		var nome_pjuridica = "<?php echo $outorgante["nome_pjuridica"]; ?>"
	</script>
</body>

</html>