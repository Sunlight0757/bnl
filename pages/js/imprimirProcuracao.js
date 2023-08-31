window.onload = () => {
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

    function generatePdfProcuracao() {
        const docDefinition = {
            content: [
                {
                    text: 'PROCURAÇÃO',
                    style: 'header'
                },
                {
                    text: [
                        '       Pelo presente instrumento de procuração, ', { text: nome_jur.toUpperCase() + ", ", bold: true }, 'pessoa jurídica de direito privado, CNPJ n.', cnpj + ", ", "com sede à ", endereco_condominio + ", ", cidade_condominio + ", ", estado_condominio + ", ", cep_condominio + ", ", 'neste ato representada por ', nome_representante.toUpperCase() + ", ", cpf_representante + ", ", nacionalidade_representante + ", ", profissao_representante + ", ", 'com endereço à ', endereco_representante + ", ", cidade_representante + ", ", estado_representante, ' nomeia e constitui seu bastante advogado ', { text: 'NILO ALVES BEZERRA, ', bold: true }, 'brasileiro, inscrito na Ordem dos Advogados do Brasil, seção MT, sob o número 2830, com escritório em Cuiabá, MT, à Rua General Vale, 321, sala 806, CEP 78010-000, a quem confere amplos poderes para o foro em geral, com a cláusula ', { text: "\“ad judicia\”, ", italics: true }, 'para qualquer juízo, Instância ou Tribunal, podendo propor contra quem de direito as competentes ações ou promover sua defesa nas adversas, seguindo umas e outras até final decisão, usando dos recursos legais, acompanhando-as, conferindo-lhe, também, poderes especiais para confessar, transigir, desistir, firmar compromissos, receber e dar quitações, podendo substabelecer, com ou sem reserva de poderes, especialmente para promover ação judicial a fim de receber créditos provenientes de inadimplência de obrigações condominiais.'
                    ],
                    style: 'mainText'
                },
                {
                    text: cidade_condominio + ', ' + dataExtenso,
                    style: 'date'
                },
                {
                    text: '________________________________\n' + nome_jur.toUpperCase(),
                    style: 'signature'
                }
            ],
            styles: {
                header: {
                    alignment: 'center',
                    decoration: 'underline',
                    fontSize: 18,
                    bold: true,
                    margin: [50, 50, 30, 60]
                },
                mainText: {
                    alignment: 'justify',
                    margin: [50, 0, 30, 30]
                },
                date: {
                    alignment: 'center',
                    margin: [0, 0, 0, 60]
                },
                signature: {
                    alignment: 'center',
                    bold: true
                }
            }
        };
        pdfMake.createPdf(docDefinition).download('procuração');
    }

    //Botoes

    const downloadProcuracaoBtn = document.getElementById('download-pdf-procuracao');
    downloadProcuracaoBtn.addEventListener('click', () => {
        generatePdfProcuracao();
    });
}