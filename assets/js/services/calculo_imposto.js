$(document).ready(function () {


    //Variaveis globais

    var numCalculos = 1;
    var contador = 0;
    var indiceInput = 1;
    var subtotalValorCorrigido = 0;
    var subtotalJurosMoratorios = 0;
    var subtotalMulta = 0;
    var subtotalHonorarios = 0;
    var subtotalFinal = 0;
    var subtotalHonorariosSucumbenciais = 0;
    var valorFinal = 0;

    var honorariosSucumbenciais = 15;


    //rows manipuladas
    var _unidadeDevedora = document.getElementById("unidadeDevedora");
    var _selectCalculo = document.getElementById("selectCalculo");
    var _dataOrigin = document.getElementById("dataOrigin" + (contador + 1));
    var _dataFinal = document.getElementById("dataFinal");
    var _valorCalcular = document.getElementById("valorCalcular" + (contador + 1));
    var _multa = document.getElementById("multa" + (contador + 1));
    var _honorarios = document.getElementById("honorarios" + (contador + 1));
    //hidden inputs
    var _valorCorrigido = document.getElementById("valorCorrigidoInput" + (contador + 1));
    var _jurosMoratorios = document.getElementById("jurosMoratoriosInput" + (contador + 1));
    var _total = document.getElementById("totalInput" + (contador + 1));
    //Subtotais
    var _subtotalValorCorrigido = document.getElementById("subtotalValorCorrigido");
    var _subtotalJurosMoratorios = document.getElementById("subtotalJurosMoratorios");
    var _subtotalMulta = document.getElementById("subtotalMulta");
    var _subtotalHonorarios = document.getElementById("subtotalHonorarios");
    var _subtotalFinal = document.getElementById("subtotalFinal");
    var _valorFinal = document.getElementById("valorFinal");
    var _subtotalHonorariosSucumbenciais = document.getElementById("subtotalHonorariosSucumbenciais");

    //data
    var date = new Date();
    var currentDate = date.toISOString().slice(0, 10);
    _dataOrigin.value = currentDate;
    _dataFinal.value = currentDate;


    //Funcoes da pagina

    function modifyDate(dateNumber) {
        return dateNumber <= 9 ? "0" + dateNumber : dateNumber
    }

    function executeCalculo(value) {
        let inputValue = $(_valorCalcular).val();
        let numberValue = Number(parseFloat(inputValue.replace(/[^0-9.,]/g, '').replaceAll('.', '').replace(',', '.')).toFixed(2)); //Passa o valor do input para numerico
        // let currentValue = Number(_valorCalcular.value);
        let currentValue = numberValue;
        let percentage = 0;

        //teste para ver se o ultimo mes está completo
        let mesIncompleto = differenceInDays((new Date(_dataFinal.value)), (new Date(_dataOrigin.value)))
        if (mesIncompleto < 0) {
            value.pop(); //caso mes estiver incompleto remove o ultimo array com a correção
        }

        //calcular o valor corrigido
        value.forEach((element) => {
            percentage = Number(element.V);
            currentValue += (currentValue * percentage) / 100;
        });

        //calculos
        // console.log(_dataFinal.value,_dataOrigin.value);
        let cont_juros = differenceInMonths((new Date(_dataFinal.value)), (new Date(_dataOrigin.value)))
        let totalJurosMoratorios = (currentValue * (cont_juros / 100));
        let totalMulta = ((Number(_multa.value) * currentValue) / 100);
        let totalHonorarios = (currentValue + totalJurosMoratorios + totalMulta) * ((Number(_honorarios.value)) / 100);
        let totalAtual = currentValue + totalJurosMoratorios + totalMulta + totalHonorarios;

        subtotalValorCorrigido += currentValue;
        subtotalJurosMoratorios += totalJurosMoratorios
        subtotalMulta += totalMulta
        subtotalHonorarios += totalHonorarios
        subtotalFinal += totalAtual;
        subtotalHonorariosSucumbenciais = subtotalFinal * (honorariosSucumbenciais / 100 + 1) - subtotalFinal;
        valorFinal = subtotalFinal + subtotalHonorariosSucumbenciais;


        //Insercao nas rows
        let val_corrigido = document.getElementById("valor_corrigido" + contador);
        val_corrigido.innerHTML = currentValue.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })
        let juros_moratorios = document.getElementById("juros_moratorios" + contador);
        juros_moratorios.innerHTML = cont_juros.toFixed(2).replace('.', ',') + "%"
        let total = document.getElementById("total" + contador);
        total.innerHTML = totalAtual.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })

        //Insercao nos hidden inputs
        _valorCorrigido.value = currentValue.toFixed(2)
        _jurosMoratorios.value = cont_juros.toFixed(2)
        _total.value = totalAtual.toFixed(2);

    }

    function somarParcelas() {
        //Insercao dos resultados totais
        _subtotalValorCorrigido.innerHTML = subtotalValorCorrigido.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })
        _subtotalJurosMoratorios.innerHTML = subtotalJurosMoratorios.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })
        _subtotalMulta.innerHTML = subtotalMulta.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })
        _subtotalHonorarios.innerHTML = subtotalHonorarios.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })
        _subtotalFinal.innerHTML = subtotalFinal.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })
        _valorFinal.innerHTML = valorFinal.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })
        _subtotalHonorariosSucumbenciais.innerHTML = subtotalHonorariosSucumbenciais.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })

    }

    function getDataImposto() {
        return new Promise((resolve) => {

            var dateOriginString = `${new Date(_dataOrigin.value).getUTCFullYear()}${modifyDate(new Date(_dataOrigin.value).getUTCMonth() + 1)}`
            var dateFinalString = `${new Date(_dataFinal.value).getUTCFullYear()}${modifyDate(new Date(_dataFinal.value).getUTCMonth() + 1)}`
            var url = `https://apisidra.ibge.gov.br/values/t/${_selectCalculo.value}/n1/all/v/all/p/${dateOriginString}-${dateFinalString}?formato=json`;

            // var xhr = new XMLHttpRequest();
            // xhr.responseType = 'json';
            // xhr.open("GET", url);

            // xhr.setRequestHeader("Accept", "application/json");

            // xhr.send();

            // xhr.onload = function () {
            //     var desestructure = xhr.response.filter((item) => item.D2C == 44 || item.D2C == 306)
            //     console.log(desestructure);
            //     executeCalculo(desestructure)
            //     resolve();
            // };

            fetch(url)
            .then(response => response.json())
            .then(data => {
                const desestructure = data.filter(item => item.D2C == 44 || item.D2C == 306);
                executeCalculo(desestructure)
                resolve();
            })
            .catch(error => console.error(error));
        });
    };

    //checagem se ultimo campo adicionado foi preenchido
    function preenchido(id = indiceInput) {
        let checkDataOrigin = '#dataOrigin' + id
        let checkValorCalcularr = '#valorCalcular' + id
        let checkMulta = '#multa' + id
        let checkHonorarios = '#honorarios' + id

        if ($(checkDataOrigin).val() !== "" && $(checkValorCalcularr).val() !== "" && $(checkMulta).val() !== "" && $(checkHonorarios).val() !== "") {
            return true;
        } else {
            return false;
        }
    }

    //Funcao de criacao de novas linhas de calculo
    async function inserirNovoCalculo() {

        if (preenchido()) {

            indiceInput++;
            contador++;
            numCalculos++;

            await calcularUltimo()

            //insercao dos novos inputs
            $('#tabela_dinamica').append('<tr id="row' + indiceInput + '">')
            $('#row' + indiceInput).append('<th scope="row"><button name="remove" type="button" id="exclude' + indiceInput + '" class="btn btn-danger btn-sm btn_remove">X</button></th>')
            $('#row' + indiceInput).append('<td><input id="dataOrigin' + indiceInput + '" type="date" name="unidade' + indiceInput + '" class="date form-control"></td>')
            $('#row' + indiceInput).append('<td><input id="valorCalcular' + indiceInput + '" type="text" name="unidade" class="currency form-control"></td>')
            $('#row' + indiceInput).append('<td id="valor_corrigido' + indiceInput + '">-</td>')
            $('#row' + indiceInput).append('<td id="juros_moratorios' + indiceInput + '">-</td>')
            $('#row' + indiceInput).append('<td><input id="multa' + indiceInput + '" type="number" name="multa' + indiceInput + '" class="form-control multa" min="0"></td>')
            $('#row' + indiceInput).append('<td><input id="honorarios' + indiceInput + '" type="number" name="honorarios' + indiceInput + '" class="form-control honorario" min="0"></td>')
            $('#row' + indiceInput).append('<td id="total' + indiceInput + '" name="total' + indiceInput + '">-</td>')
            $('#row' + indiceInput).append('<input type="hidden" id="valorCorrigidoInput' + indiceInput + '" name="valorCorrigidoInput' + indiceInput + '">')
            $('#row' + indiceInput).append('<input type="hidden" id="jurosMoratoriosInput' + indiceInput + '" name="jurosMoratoriosInput' + indiceInput + '">')
            $('#row' + indiceInput).append('<input type="hidden" id="totalInput' + indiceInput + '" name="totalInput' + indiceInput + '">')
            currency(); setMaxDateNewRow(); alteracaoRow();

        } else {
            alert("Faltam dados!")
        }
    }

    //Funcao de calcular linha atual on change
    function calcularEste(id) {
        if (preenchido(id)) { 
            contador = id;
            _dataOrigin = document.getElementById("dataOrigin" + (contador));
            _valorCalcular = document.getElementById("valorCalcular" + (contador));
            _dataFinal = document.getElementById("dataFinal");
            _selectCalculo = document.getElementById("selectCalculo");
            _multa = document.getElementById("multa" + (contador));
            _honorarios = document.getElementById("honorarios" + (contador));
            getDataImposto();
        }
    }

    //Funcao de calculo da ultima row
    async function calcularUltimo() {
        document.getElementById("loader").style.display = "block"; //Mostra o spinner de loading enquanto a função é executada
        if (preenchido()) {
            //passa por todos as rows para ver qual a ultima existente
            let ultimo = 0;
            for (let i = 1; i <= numCalculos; i++) {
                if ($('#row' + i).length) {
                    ultimo = i;
                }
            }
            // alteracaoRow(ultimo);
            //testa se a ultima row ja foi calculada ou não
            if ($('#total' + ultimo).text() == "-") {
                contador = ultimo;
                _dataOrigin = document.getElementById("dataOrigin" + (contador));
                _valorCalcular = document.getElementById("valorCalcular" + (contador));
                _dataFinal = document.getElementById("dataFinal");
                _selectCalculo = document.getElementById("selectCalculo");
                _multa = document.getElementById("multa" + (contador));
                _honorarios = document.getElementById("honorarios" + (contador));

                //calcula apenas se houver alguma row
                if (ultimo != 0) {
                    await getDataImposto();
                    document.getElementById("loader").style.display = "none";
                }
            }
        }
        document.getElementById("loader").style.display = "none";
    }

    //Funcao de calculo da tabela por completo
    async function calcularTodos() {
        document.getElementById("loader").style.display = "block"; //Mostra o spinner de loading enquanto a função é executada
        if (preenchido()) {
            //Reseta todos as variaveis para calcular por completo
            contador = 0;
            valorFinal = 0;
            subtotalJurosMoratorios = 0;
            subtotalMulta = 0;
            subtotalHonorarios = 0;
            subtotalFinal = 0;
            subtotalValorCorrigido = 0;

            //Passa por todos os rows criados para calcular
            for (let index = 1; index <= numCalculos; index++) {
                contador++;
                //testa se a row correspondente ao contador existe na tabela, caso contrario pula a row
                if (!$('#row' + contador).length) {
                    continue;
                } else {

                    _dataOrigin = document.getElementById("dataOrigin" + (contador));
                    _valorCalcular = document.getElementById("valorCalcular" + (contador));
                    _dataFinal = document.getElementById("dataFinal");
                    _selectCalculo = document.getElementById("selectCalculo");
                    _multa = document.getElementById("multa" + (contador));
                    _honorarios = document.getElementById("honorarios" + (contador));

                    await getDataImposto();
                }
            }
            somarParcelas();
            contador--; //volta o contador em 1 devido ao for ir 1 a mais
            document.getElementById("loader").style.display = "none";
            document.getElementById("divTotais").style.display = "block";
        } else {
            alert("Faltam dados!")
            document.getElementById("loader").style.display = "none";
            return false;
        }
        document.getElementById("loader").style.display = "none"; //Sinaliza que acabou de carregar e o spinner some
        return true;
    }


    //Seleção dos dados a serem introduzidos no pdf
    async function criarPDF() {
        if (await calcularTodos()) {
            let table = document.getElementById('tabela_dinamica');
            let rows = [];
            for (var i = 0; i < table.rows.length; i++) {
                let row = [];
                for (var j = 1; j < table.rows[i].cells.length; j++) {
                    let cellValue = table.rows[i].cells[j].textContent;
                    if (cellValue === '') {
                        let inputElement = table.rows[i].cells[j].querySelector('input');
                        if (inputElement) {
                            if (inputElement.type === 'date') { // check if input is a date
                                let date = new Date(inputElement.value);
                                date.setDate(date.getDate() + 1);
                                let formattedDate = ('0' + date.getDate()).slice(-2) + '/' + ('0' + (date.getMonth() + 1)).slice(-2) + '/' + date.getFullYear();
                                cellValue = formattedDate;
                            } else {
                                cellValue = inputElement.value;
                                if (j == 5 || j == 6) {
                                    cellValue = parseFloat(cellValue).toFixed(2).replace('.', ',') + "%"
                                }
                            }
                        }
                    }
                    row.push(cellValue);
                }
                rows.push(row);
            }
            let cabecalho = []; //Tabela de cabeçalho

            //pegar data de atualização
            let dateAtt = new Date(_dataFinal.value)
            dateAtt.setDate(dateAtt.getDate() + 1)
            //pegar unidade devedora
            let uniDevedoraPdf = ""
            if (_unidadeDevedora.value !== "") {
                uniDevedoraPdf = 'Débito da unidade ' + _unidadeDevedora.value
            }

            //Definicao das linhas do cabecalho

            cabecalho.push([{ text: 'Cálculo do Crédito', style: 'tableHeader', colSpan: 7, alignment: 'center' }, '', '', '', '', '', ''])
            cabecalho.push([' ', '', '', '', '', '', ''])
            cabecalho.push([{ text: uniDevedoraPdf, colSpan: 7, alignment: 'left' }, '', '', '', '', '', ''])
            cabecalho.push([{ text: 'Valores atualizados até 01' + dateAtt.toLocaleString('pt-BR', { year: 'numeric', month: '2-digit', day: '2-digit' }).substring(2), colSpan: 7, alignment: 'left' },
                '', '', '', '', '', ''])
            cabecalho.push([{ text: 'Indexador utilizado: ' + _selectCalculo.options[_selectCalculo.selectedIndex].text + ' (IBGE)', colSpan: 7, alignment: 'left' }, '', '', '', '', '', ''])

            //linha do subtotal
            rows.push([
                'TOTAL',
                '',
                subtotalValorCorrigido.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }),
                subtotalJurosMoratorios.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }),
                subtotalMulta.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }),
                subtotalHonorarios.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }),
                subtotalFinal.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })
            ]);

            //linha dos Honorarios Sucumbenciais
           // rows.push([{ text: 'Honorários Sucumbenciais (5,00%)', colSpan: 6, alignment: 'right' }, '', '', '', '', '', subtotalHonorariosSucumbenciais.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })]);

            //linha do Total
           // rows.push([{ text: 'Total', colSpan: 6, alignment: 'right' }, '', '', '', '', '', { text: "R$ " + valorFinal.toFixed(2), noWrap: true }]);


            //pdfMake
            var docDefinition = {
                content: [
                    {
                        style: 'table',
                        table: {
                            headerRows: 1,
                            widths: ['*', '*', '*', '*', '*', '*', '*'],
                            body: [...cabecalho]
                        },
                        layout: 'headerLineOnly'
                    },
                    { text: '\n' },
                    {
                        style: 'table',
                        table: {
                            widths: ['*', '*', '*', 'auto', 'auto', 'auto', '*'],
                            body: [...rows]
                        }
                    }
                ],
                styles: {
                    tableHeader: {
                        bold: true,
                        fontSize: 13,
                        color: 'black'
                    },
                    table: {
                        alignment: 'right',
                        margin: [0, 5, 0, 15]
                    }
                }
            };
            pdfMake.createPdf(docDefinition).download((new Date()).toLocaleDateString('pt-br') + '_Calculos.pdf');
        }
    }

    //Calculo diferença de meses completos para juros moratorios
    function differenceInMonths(date1, date2) {
        const monthDiff = date1.getUTCMonth() - date2.getUTCMonth();
        const yearDiff = date1.getUTCFullYear() - date2.getUTCFullYear();
        let resultDiff = monthDiff + yearDiff * 12;
        if (differenceInDays(date1, date2) < 0) {
            resultDiff = resultDiff - 1;
        }
        return resultDiff
    }
    function differenceInDays(date1, date2) {
        const dayDiff = date1.getUTCDate() - date2.getUTCDate();
        return dayDiff;
    }

    //Detectar mudança em alguma row
    function alteracaoRow() {
        $('table tbody tr').on('focusout', 'input', function () {
            esconderTotais();
            // var rowId = $(this).closest('tr').attr('id');
            // var rowNumber = rowId.split('row')[1]
            // calcularEste(rowNumber)
        });
    } alteracaoRow();

    //Botar mascara no valor original
    function currency() {
        $('.currency').on('input', function () {
            // Get the input value
            var inputValue = $(this).val();

            // Remove any non-numeric characters except the decimal separator
            inputValue = inputValue.replace(/[^0-9]/g, '');

            // Get the length of the input value
            var inputLength = inputValue.length;

            // Format the value with the currency symbol and separators
            if (inputLength >= 3) {
                var cents = inputValue.substring(inputLength - 2, inputLength);
                var dollars = parseInt(inputValue.substring(0, inputLength - 2), 10).toString();
                dollars = dollars.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                inputValue = 'R$ ' + dollars + ',' + cents;
            } else if (inputLength == 2) {
                inputValue = 'R$ 0,' + inputValue;
            } else if (inputLength == 1) {
                inputValue = 'R$ 0,0' + inputValue;
            } else {
                inputValue = '';
            }

            // Set the formatted value back to the input field
            $(this).val(inputValue);
        });
    }
    currency()

    //Define data maxima para dia atual
    function maxDate() {
        $('#dataFinal').prop('max', function () {
            return new Date().toJSON().split('T')[0];
        });
        $('#dataFinal').prop('min', function () {
            let dateMin = new Date();
            dateMin.setFullYear(dateMin.getFullYear() - 6);
            return dateMin.toJSON().split('T')[0];
        });
    }; maxDate();
    //Define data maxima da data inicial para ser menor que a final
    function setMaxDateInicial() {
        //modificação ao tirar foco
        $('#dataFinal').on('focusout', function () {
            const today = new Date().toISOString().split('T')[0];
            const dateVal = $(this).val();
            let dateMin = new Date;
            dateMin.setFullYear(dateMin.getFullYear() - 6) //Ajusta o minimo para 6 anos atras
            dateMin = dateMin.toISOString().split('T')[0];
            //Modifica para o maximo ou minimo se passar dos limites
            if (dateVal > today) {
                $(this).val(today);
            }
            if (dateVal < dateMin) {
                $(this).val(dateMin);
            }
            //Modifica todos as datas das rows para ter o maximo da data de atualização
            const firstDate = new Date($(this).val());
            const maxDate = firstDate.toISOString().substring(0, 10); // Format date as YYYY-MM-DD
            // $('.date').attr('max', maxDate);
            setMaxDateNewRow();
            $('.date').each(function () {
                if ($(this).val() > maxDate) {
                    $(this).val(maxDate);
                }
            });
            $('.date').each(function () {
                if ($(this).val() < dateMin) {
                    $(this).val(dateMin);
                }
            });
            esconderTotais();
        });

    } setMaxDateInicial();
    //define a data maxima da nova parcela
    function setMaxDateNewRow() {
        //define da data maxima das linhas
        $('.date').prop('max', function () {
            return new Date($(_dataFinal).val()).toJSON().split('T')[0];
        });
        //define a data minima das linhas
        $('.date').prop('min', function() {
            let newMin = new Date($(_dataFinal).val());
            newMin.setFullYear(newMin.getFullYear() - 6)
            newMin = newMin.toISOString().split('T')[0];
            return newMin;
        });
        //modificação ao tirar foco
        $('.date').on('focusout', function () {
            const dataAtt = $('#dataFinal').val();
            const dateVal = $(this).val();
            //Define dateMin para 6 anos antes da data de atualização
            let dateMin = $('#dataFinal').val();
            dateMin = new Date(dateMin)
            dateMin.setFullYear(dateMin.getFullYear() - 6)
            dateMin = dateMin.toISOString().split('T')[0];

            //Modifica para o maximo ou minimo se passar dos limites
            if (dateVal > dataAtt) {
                $(this).val(dataAtt);
            }
            if (dateVal < dateMin) {
                $(this).val(dateMin);
            }
        })
    }; setMaxDateNewRow();

    //esconde os resultados totais
    function esconderTotais(){
        document.getElementById("divTotais").style.display = "none";
    }

    //Botoes

    $('#btn-formulario').click(async function () {
        await calcularTodos();
    })
    $('#addbtn').click(function () {
        inserirNovoCalculo();
        esconderTotais()
    });
    //Botao de remover linha
    $(document).on('click', '.btn_remove', function () {
        let button_id = $(this).attr("id").split('exclude')[1];
        $('#row' + button_id).remove();
        esconderTotais()
    });
    //Botao pdf
    $('#btn-pdf').click(criarPDF);
});