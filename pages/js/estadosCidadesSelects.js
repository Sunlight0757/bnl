const estadosCidadesSelects = (idEstadoSelect, idCidadeSelect) => {
    const statesSelect = document.getElementById(idEstadoSelect);
    const citiesSelect = document.getElementById(idCidadeSelect);
    var resultAPIEstados;

    // Fetch the list of states from the IBGE API
    fetch("https://servicodados.ibge.gov.br/api/v1/localidades/estados")
        .then(response => response.json())
        .then(states => {
            // Sort the list of states by name
            states.sort((a, b) => a.nome.localeCompare(b.nome));
            // Populate the states select input with the list of states
            states.forEach(state => {
                const option = document.createElement("option");
                option.value = state.nome;
                option.textContent = state.nome;
                statesSelect.appendChild(option);
            });
            resultAPIEstados = states;
        });

    // When the user selects a state, fetch the list of cities for that state from the IBGE API
    statesSelect.addEventListener("change", () => {
        const selectedState = resultAPIEstados.find(state => state.nome === statesSelect.value); // Find the selected state object
        if (selectedState) {
            const stateId = selectedState.id;
            fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${stateId}/municipios`)
                .then(response => response.json())
                .then(cities => {
                    // Clear the cities select input
                    citiesSelect.innerHTML = "<option disabled selected value=''>Selecione a cidade</option>";
                    // Populate the cities select input with the list of cities for the selected state
                    cities.forEach(city => {
                        const option = document.createElement("option");
                        option.value = city.nome;
                        option.textContent = city.nome;
                        citiesSelect.appendChild(option);
                    });
                });
        } else {
            // If no state is selected, clear the cities select input
            citiesSelect.innerHTML = "<option disabled selected value=''>Selecione a cidade</option>";
        }
    });
}