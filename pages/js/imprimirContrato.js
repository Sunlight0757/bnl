window.onload = () => {

    //pdf contrato
    function generatePdfContrato() {
        const docDefinition = {
            content: [
                {
                    text: 'CONTRATO DE PRESTAÇÃO DE SERVIÇOS ADVOCATÍCIOS',
                    style: 'header'
                },
                {
                    text: textContent,
                    style: 'mainText'
                },
                {
                    text: textData,
                    style: 'date'
                },
                {
                    text: '_________________________________\n'+textNomeJur,
                    style: 'signature'
                },
                {
                    text: '_________________________________\nNilo Alves Bezerra',
                    style: 'signature'
                },
                {
                    text: '_________________________________\n' + textTestemunha1,
                    style: 'signature'
                },
                {
                    text: '_________________________________\n' + textTestemunha2,
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
                    bold: true,
                    margin: [0, 30, 0, 0]
                }
            }
        };
        pdfMake.createPdf(docDefinition).download('contrato');
    }

    //Botoes
    const downloadContratoBtn = document.getElementById('download-pdf-contrato');
    downloadContratoBtn.addEventListener('click', () => {
        generatePdfContrato();
    });
}