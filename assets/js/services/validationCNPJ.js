const inputCNPJ = document.getElementById("inputCNPJ");
const divError = document.getElementById("errorCNPJ");

const inputRazaoSocial = document.getElementById("inputRazaoSocial");
const inputMunicipio = document.getElementById("inputMunicipio");
const inputUF = document.getElementById("inputUF");
const inputEndereco = document.getElementById("inputEndereco");
const inputCep = document.getElementById("inputCep");

const timeout = document.getElementById("timerValidation");

let changeCNPJ = false;

function timer(){
    let seconts=30;
    const inverval = setInterval(()=>{
        seconts = seconts-1;
        timeout.innerHTML = `Tempo de espera para nova verificação: ${seconts}s`;
        
        
        if (seconts==0){
            timeout.innerHTML = `Liberado para fazer outra chamada`;
            changeCNPJ=false;
            timeout.innerHTML = ``;
            clearInterval(inverval);
        }
    }, 1000);  
}

async function validarCNPJClick(){
    const cnpj = inputCNPJ.value.replace(/[^0-9]/g, '');

    if (cnpj?.length !== 14 || !/[0-9]/.test(cnpj) || changeCNPJ == true) return
    changeCNPJ = true;

    $.ajax({
        'url':`https://receitaws.com.br/v1/cnpj/${cnpj}`,
        'type': 'GET',
        'dataType':'jsonp',
        'Authorization': 'Bearer 7675b89b0e2216e124d3c575e809c6020b9910a48d97a3e4f33935f1546fa1c3',
        'success': (response)=>{
            if(response.status !== "ERROR"){
                inputRazaoSocial.value = response?.nome;
                inputMunicipio.value = response?.municipio;
                inputUF.value = response?.uf;
                inputEndereco.value = response?.logradouro;
                inputCep.value = response?.cep.replace(/[^0-9]/g, '');
            }else {
                //divError.innerHTML = 'CNPJ inválido';
            }
        }
    })
    timer(60);
}

// async function validarCNPJ(value){
//     console.log("NUMBER", value);

//     const valueJustNumbers = value.replace(/[^0-9]/g, '');
//     console.log("NUMBER", valueJustNumbers);

//     if (valueJustNumbers.length === 0) 
//         changeCNPJ = false; 
    
//     if (valueJustNumbers?.length !== 14 || !/[0-9]/.test(valueJustNumbers) || changeCNPJ == true) return

//     changeCNPJ = true;

//     $.ajax({
//         'url':`https://receitaws.com.br/v1/cnpj/${valueJustNumbers}`,
//         'type': 'GET',
//         'dataType':'jsonp',
//         'Authorization': 'Bearer 7675b89b0e2216e124d3c575e809c6020b9910a48d97a3e4f33935f1546fa1c3',
//         'success': (response)=>{
//             console.log(response);
//             inputRazaoSocial.value = response?.nome;
//             inputMunicipio.value = response?.municipio;
//             inputUF.value = response?.uf;
//             inputEndereco.value = response?.logradouro;
//             inputCep.value = response?.cep.replace(/[^0-9]/g, '');
//         }
//     })
// }

//inputCNPJ.addEventListener("keyup", ({target:{value}})=> validarCNPJ(value));
