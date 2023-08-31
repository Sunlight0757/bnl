const ulrUF = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados'

const cidade = document.getElementById("cidade")
const uf = document.getElementById("uf")

const cidaderep = document.getElementById("cidaderep")
const ufrep = document.getElementById("ufrep")

const cidaderep2 = document.getElementById("cidaderep2")
const ufrep2 = document.getElementById("ufrep2")

function createOptionsCidade(response, label){
    let options = `<optgroup label='${label}'>`
    response.forEach((cidades)=>{
        options +=('<option>'+cidades.nome+'</option>')
    })
    options += '</optgroup>'
    return options
}
function createOptionsUFs(response, label){
    let options = `<optgroup label='${label}'>`
    response.forEach((uf)=>{
        options += '<option>'+uf.sigla+'</option>'
    })
    options += '</optgroup>'
    return options
}
async function fetchAPIIBGE(url){
    const request = await fetch(url)
    const response = await request.json()
    return response
}

uf.addEventListener('change', async function(){
    const response = await fetchAPIIBGE(`${ulrUF}/${uf.value}/municipios`)
    cidade.innerHTML = createOptionsCidade(response, "Cidades")
})
ufrep.addEventListener('change', async function(){
    const response = await fetchAPIIBGE(`${ulrUF}/${ufrep.value}/municipios` )
    cidaderep.innerHTML = createOptionsCidade(response, "UFs")
})
ufrep2.addEventListener('change', async function(){
    const response = await fetchAPIIBGE(`${ulrUF}/${ufrep2.value}/municipios` )
    cidaderep2.innerHTML = createOptionsCidade(response, "UFs")
})

window.addEventListener('load', async ()=>{
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