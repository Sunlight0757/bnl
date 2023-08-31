    //Checagem de preenchimento dos campos
    function validateForm(inputsClass) {
        let inputs = document.getElementsByClassName(inputsClass);
        let emptyInputs = [];

        for (let i = 0; i < inputs.length; i++) {
            if (inputs[i].value === "") {
                let label = document.querySelector(`label[for=${inputs[i].id}]`);
                emptyInputs.push(label.textContent.trim());
            }
        }

        if (emptyInputs.length > 0) {
            let alertText = emptyInputs.join(", ");
            // alert("Preencha os seguintes campos: " + alertText);
            Swal.fire({
                icon: 'error',
                title: "Preencha os seguintes campos: " + alertText,
                showConfirmButton: true,
                timer: "5000"
            })
            return false;
        }
        return true;
    }