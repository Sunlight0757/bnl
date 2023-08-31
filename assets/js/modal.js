const button = document.getElementById("button_modal")
const modal = document.querySelector("dialog")
const buttonClose = document.getElementById("button_modal_OK")

button.onclick = function () {
    modal.showModal()
}

buttonClose.onclick = function () {
    modal.close()
}