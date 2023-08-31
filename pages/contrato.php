<!DOCTYPE html>

<html>
<meta charset="UTF-8" />
<?php

$id_usuario = $_SESSION['id_externo'];
$sql_dados_usuario = "SELECT * FROM usuarios WHERE id = '$id_usuario'";
$sql_query_dados_usuario = $mysqli->query($sql_dados_usuario) or die($mysqli->error);

$sql_dados_adicionais = "SELECT * FROM dados_adicionais WHERE id_usuario = '$id_usuario'";
$sql_query_dados_adicionais = $mysqli->query($sql_dados_adicionais) or die($mysqli->error);

$outorgante_0 = $sql_query_dados_usuario->fetch_assoc();
$outorgante_1 = $sql_query_dados_adicionais->fetch_assoc();



$cont = 1;
$contdec = 1;
if (isset($_POST['tsexo'])) {
	$sexo = $_POST["tsexo"];
}
if ($sexo == "o") {
	$o = "o";
	$om = "O";
	$oea = "e";
} elseif ($sexo == "a") {
	$o = "a";
	$om = "A";
}

?>
<link href="css/contrato.css" rel="stylesheet" type="text/css">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Contrato BNL</title>
</head>

<body>
	<a href="javascript: history.back()" class="print" style="background-color: lightgray" id="botaovoltar">Voltar</a>
	<button id="download-pdf-contrato">Imprimir</button>
	<!-- <input type="button" class="print" value="Imprimir" onClick="window.print()" /> -->
	<div>
		<h3> <b> CONTRATO DE PRESTAÇÃO DE SERVIÇOS ADVOCATÍCIOS </b> </h3>
		<br><br><br>
		<p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pelo presente instrumento de contrato de serviços advocatícios, de um lado, denominad<?php echo $o ?>
			<strong>CONTRATANTE</strong>,
			<b> <?php
				$nome = $outorgante_0["nome_jur"];
				echo mb_strtoupper($nome, 'UTF-8')
				?></b>, pessoa jurídica, CNPJ n.
			<?php
			echo $outorgante_0["cnpj"]
			?>, com sede à
			<?php
			echo $outorgante_1["endereco_condominio"]
			?>,
			<?php
			echo $outorgante_1["cidade_condominio"]
			?>,
			<?php
			echo $outorgante_1["estado_condominio"]
			?>, CEP
			<?php
			echo $outorgante_1["cep_condominio"]
			?>, neste ato representad<?php
										echo $o;
										?>
			por<strong>
				<?php
				echo $outorgante_1["nome_representante"]
				?></strong>, CPF n.
			<?php
			echo $outorgante_1["cpf_representante"]
			?>,
			<?php
			echo $outorgante_1["nacionalidade_representante"]
			?>,
			<?php
			echo $outorgante_1["profissao_representante"]
			?>, residente a
			<?php
			echo $outorgante_1["endereco_representante"]
			?>,
			<?php
			echo $outorgante_1["cidade_representante"]
			?>,
			<?php
			echo $outorgante_1["estado_representante"]
			?> e, de outro, como <strong>CONTRATADO</strong>, o advogado<B> NILO ALVES BEZERRA</B>, CPF n. 207.792.161-72, inscrito na OAB/MT sob o número 2830, com escritório em Cuiabá, MT, à Rua General Vale, 321,
			sala 806, CEP 78010-000, fica contratado, mediante as cláusulas abaixo, o seguinte:<br><br>
			<!-- --------------------------------------------- 1 DO SERVICO CONTRATADO -------------------------------- -->
			<?php
			echo ($cont++);
			echo (".   "); ?>
			O advogado CONTRATADO se obriga, em nome d<?php
														echo $o;
														?> CONTRATANTE, a fim de receber créditos provinientes de inadimplência
			de obrigações condominiais.

			<!-- --------------------------------------------- 1 Parágrafo Extra -------------------------------- -->

			<?php
			if (isset($_POST['paragrafoservico'])) {

				echo "<br><br>" . $_POST["textareaserv"];

			?>.
		<?php
			}
		?>

		<!-- --------------------------------------- 2 VALOR E PAGAMENTO - PARTE FIXA --------------------------------------------- -->
		<br><br>
		<?php
		if (!isset($_POST["sempartefixa"]))
			echo ($cont); { ?>
			. Em remuneração aos serviços advocatícios aqui contratados, <?php
																			echo $o;
																			?> CONTRATANTE se obriga a pagar ao advogado ora contratado, como parte fixa, a importância de R$
			<?php
			echo $_POST["valortotal"]
			?>
			(<?php
				echo $_POST["totalporextenso"]
				?>),
			<?php
			if (isset($_POST['pagamento'])) {
				$pgto = $_POST["pagamento"];

				if ($pgto == "1") {
					$dtapga = $_POST["dtapga"];
					if ($dtapga == "spga") {
						echo " no ato da assinatura deste contrato.";
					}
					if ($dtapga == "npga") {
						$rdta = " até a data de ";
						echo ("$rdta");
						echo $_POST["datavista"];
						echo (".");
					}
				}
				if ($pgto == "2") {
					echo (" da seguinte forma: ");
					echo $_POST["valorentrada"];
					echo (", (");
					echo $_POST["porextensoentrada"];
					echo ("), de entrada, a ser paga em ");
					echo $_POST["datadaentrada"];
					echo (";");
					echo (" e mais ");
					echo $_POST["qtdeparcelas"];
					echo (" parcelas, mensais e consecutivas, no valor, cada uma, de ");
					echo $_POST["valparcela"];
					echo (" (");
					echo $_POST["porextensoparcela"];
					echo ("), pagas todo dia  ");
					echo $_POST["diadaparcela"];
					echo (" de cada mês, a partir de ");
					echo $_POST["parcelainicial"];
					echo (" até ");
					echo $_POST["parcelafinal"];
					echo (".");
				}
				if ($pgto == "3") {
					echo (" da seguinte forma: "); ?>
					<br>
					<?php

					if (isset($_POST['FasesProcessuaus_6'])) {
						$proc = $_POST["FasesProcessuaus_6"];
						$faseseis = $_POST["valorfase6"];
						if ($proc == "6") {
							echo ("- Na assinatura da procuração, ");
							echo ("$faseseis"); ?><br>
						<?php
						}
					}
					if (isset($_POST['FasesProcessuaus_0'])) {
						$prot = $_POST["FasesProcessuaus_0"];
						$fasezero = $_POST["valorfase0"];
						if ($prot == "0") {
							echo ("- No protocolo da petição inicial, ");
							echo ("$fasezero");
						?><br>
						<?php
						}
					}
					if (isset($_POST["FasesProcessuaus_1"])) {
						$inst = $_POST["FasesProcessuaus_1"];
						$faseum = $_POST["valorfase1"];
						if ($inst == "1") {
							echo ("- Na audiência de instrução, ");
							echo ("$faseum");
						?><br>
						<?php
						}
					}
					if (isset($_POST["FasesProcessuaus_2"])) {
						$prcia = $_POST["FasesProcessuaus_2"];
						$fasedois = $_POST["valorfase2"];
						if ($prcia == "2") {
							echo ("- Na data do início da Perícia, ");
							echo ("$fasedois");
						?><br>
						<?php
						}
					}
					if (isset($_POST["FasesProcessuaus_3"])) {
						$tj = $_POST["FasesProcessuaus_3"];
						$fasetres = $_POST["valorfase3"];
						if ($tj == "3") {
							echo ("- Na data do protocolo da apelação, ");
							echo ("$fasetres");
						?><BR>
						<?php
						}
					}
					if (isset($_POST["FasesProcessuaus_4"])) {
						$stj = $_POST["FasesProcessuaus_4"];
						$fasequatro = $_POST["valorfase4"];
						if ($stj == "4") {
							echo ("- Na data do protocolo do recurso ao STJ, ");
							echo ("$fasequatro");
						?><BR>
		<?php
						}
					}
					if (isset($_POST["FasesProcessuaus_5"])) {
						$stf = $_POST["FasesProcessuaus_5"];
						$fasecinco = $_POST["valorfase5"];
						if ($stf == "5") {
							echo ("- Na data do protocolo do recurso ao STF, ");
							echo ("$fasecinco");
						}
					}
				}
			}
		}
		?>
		<?php
		if (!isset($_POST["sempartevariavel"])) {
		?>
			<!-- --------------------------------------- 2.1 VALOR E PAGAMENTO - PARTE VARIÁVEL  --------------------------------------------- -->

			<br><br>
			<?php echo $cont;
			echo (".");
			echo $contdec++;
			echo (". ");
			echo $om;
			?> CONTRATANTE se compromete a pagar ao advogado, como parte variável,
			<?php
			$percentual = $_POST["prcthono"];
			echo $percentual;
			?> % (<?php $percentualextenso = $_POST["porextenso"];
					echo ("$percentualextenso"); ?> por cento) sobre o valor por el<?php echo $oea ?> recebido, nos autos ou extra-autos, relativamente ao crédito objeto da ação judical proposta,
		<?php
			$dtaprctual = $_POST["dtaporcento"];
			if ($dtaprctual == "s") {
				echo (" na data do recebimento.");
			}
			if ($dtaprctual == "n") {
				$prazoprctual = $_POST["prazopagar"];
				echo (" em até ");
				echo "$prazoprctual";
				echo (" dias após o recebimento.");
			}
		}
		?>
		<!-- --------------------------------------- 2.2 LOCAL DE PAGAMENTO  --------------------------------------------- -->

		<br><br>
		<?php
		echo $cont;
		echo "." . $contdec
		?>. Os pagamentos ao CONTRATADO serão efetuados através de depósito bancário, em conta posteriormente por ele informada.

		<!-- --------------------------------------- 2.3 PAGAMENTO DE DIÁRIAS  --------------------------------------------- -->
		<?php
		if (isset($_POST['diaria'])) {
			if ($_POST["diaria"] == "1") {
		?>
				<br><br>
				<?php echo $cont;
				echo (".");
				echo ++$contdec;
				echo (".") ?> As viagens do CONTRATADO, para outros municípios ou estados, com deslocamento superior a 12 (doze) horas,
				serão pagas através de diárias no valor de
				<?php
				$diaria = $_POST["valordiaria"];
				echo $diaria;
				?>, para cada intervalo de 24 (vinte e quatro) horas.
		<?php
			}
		}
		?>


		<!-- --------------------------------------- 2 Parágrafo extra  Pagamento --------------------------------------------- -->

		<?php
		if (isset($_POST['paragrafopagamento'])) {
			if ($_POST["paragrafopagamento"] == "1") {

				echo "<br><br>" . $_POST["paragrafopag2"];

		?>.
<?php
			}
		}
?>

<!-- --------------------------------------- 3 DESPESAS DO PROCESSO  --------------------------------------------- -->
<br><br>
<?php echo ++$cont ?>. As despesas e custas processuais e de outros profissionais necessários para o êxito da causa (assistente técnico), correrão por conta d<?php echo $o ?> CONTRATANTE, devendo o advogado ser reembolsado pelos pagamentos por ele efetuados, mediante apresentação dos respectivos comprovantes.

<!-- --------------------------------------- 4 DESPESAS DO PROCESSO  --------------------------------------------- -->
<br><br>
<?php echo ++$cont ?>. Todos os pagamentos mencionados nas cláusulas anteriores, no caso de atraso acima de 5 dias, serão acrescidos de correção monetária, pelo INPC e juros de mora de 1% (hum por cento) ao mês.


<BR><BR>
<!-- --------------------------------------- 5 - Cláusula extra  --------------------------------------------- -->

<?php
if (isset($_POST['novaclausula'])) {

	echo ++$cont;
	echo ".   " . $_POST["clasulaextra"];

?>.<br><br>
<?php
}
?>

<!--  ------------------------------- Cláusulas finais -------------- -->

<?php echo ++$cont ?>. Os honorários advocatícios decorrentes da sucumbência judicial pertencerão ao advogado contratado.
<br><br>
<?php echo ++$cont ?>. Fica eleito o foro de Cuiabá para o fim de dirimir quaisquer questões decorrentes do presente contrato.
<br><br>
&nbsp;&nbsp;&nbsp; E por estarem justos e contratados, firmam o presente instrumento, em duas vias de igual teor, com as testemunhas abaixo assinadas.


<br>
		<p id="localDatat">
			<?php
			echo $outorgante_1["cidade_condominio"]
			?>,
			<script>
				var data = new Date();
				var dia = data.getDate();
				var mes = data.getMonth();
				var mesExtenso;

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
						break;
					case 11:
						mesExtenso = "dezembro";
						break;
				}

				document.write(data.getDate() + " de " + mesExtenso + " de " + data.getFullYear())
			</script>
			<br><br><br>
		<div id="assinatura">

			<?php
			echo $outorgante_0["nome_jur"] ?>
			<br><br><br><br><br>
			Nilo Alves Bezerra
			<br><br><br>

		</div>
		<div id="padrao"> Testemunhas: </div><br><br>

		<a id="testemunhas">
			<p class="testemunhas">
				<?php
				echo $_POST["test1"] . "  -  CPF ";
				echo $_POST["cpftest1"] ?>
			</p>
			<p class="testemunhas">
				<?php
				echo $_POST["test2"] . "  -  CPF ";
				echo $_POST["cpftest2"]
				?>
			</p>
		</a>
		</p>
	</div>
</body>
<script>
	const divNomeJur = document.getElementById('assinatura')
	const textNomeJur = divNomeJur.innerText.trim().split('\n')[0];
	const divMainText = document.querySelector('p');
	const textContent = divMainText.innerText.trim();
	const divTestemunha = document.getElementsByClassName('testemunhas');
	const textTestemunha1 = divTestemunha[0].innerText.trim();
	const textTestemunha2 = divTestemunha[1].innerText.trim();
	const divData = document.querySelector('#localDatat');
	const textData = divData.innerText.trim();

</script>
<script src="pages/js/imprimirContrato.js"></script>

</html>