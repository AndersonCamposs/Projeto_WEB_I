

export default function consultaFormValidator (e, addEditValidationErrors, warningDiv) {
    // LIMPANDO OS AVISOS DE ERROS CASO JÁ TENHAM SIDO EXIBIDOS ANTERIORMENTE
    addEditValidationErrors.classList.add("d-none");
    addEditValidationErrors.classList.remove("d-flex");
    warningDiv.innerHTML = "";
    
    let inputCpfPaciente = document.getElementById("inputCpfPaciente") ;
    let inputCpfMedico = document.getElementById("inputCpfMedico");
    let inputValor = document.getElementById("inputValor");
    let inputDataConsulta = document.getElementById("inputDataConsulta");
    let checkBoxDataConsulta = document.getElementById("checkBoxDataConsulta");
    if (checkBoxDataConsulta.checked) {
        let dataAtual = new Date();
        /*DIMINUINDO A HORA ATUAL PORQUE NO MOMENTO DE CONVERTER PARA
        isoString para o deslocamento 0 UTC (O BRASIL É UTC -3)*/
        dataAtual.setHours(dataAtual.getHours() - 3);
        let isoString = dataAtual.toISOString();
        inputDataConsulta.value = isoString.split("T")[0];
    }

    let errors = [];
    
    if(!inputCpfPaciente.value) {
        errors.push("O CPF do paciente é obrigatório.")
    }
    
    let onlyNumbersPattern = new RegExp("[^0-9]", "g");
    if (onlyNumbersPattern.test(inputCpfPaciente.value)) {
        errors.push("O CPF do paciente precisa ter somente números.");
    }
    
    if(!inputCpfMedico.value) {
        errors.push("O CPF do médico é obrigatório.")
    }
    
    if (onlyNumbersPattern.test(inputCpfMedico.value)) {
        errors.push("O CPF do médico precisa ter somente números.");
    }
    
    let cpfPaciente = inputCpfPaciente.value.replace(/\D/g, "");
    let cpfMedico = inputCpfMedico.value.replace(/\D/g, "");
    
    if (cpfPaciente.length !== 11) {
        errors.push("O CPF do paciente precisa ter 11 dígitos.");
    }
    
    if (cpfMedico.length !== 11) {
        errors.push("O CPF do médico precisa ter 11 dígitos.");
    }
    
    if(!inputValor.value) {
        errors.push("O valor da consulta é obrigatório.");
    }
    
    let valuePattern = new RegExp("[^0-9\.]", "g");
    if(valuePattern.test(inputValor.value)) {
        errors.push("O valor informado é inválido.");
    }
    
    if(!inputDataConsulta.value) {
        errors.push("A data da consulta é obrigatória.")
    }
    
    let dataPattern = new RegExp("^\\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$");
    if (!dataPattern.test(inputDataConsulta.value)) {
        errors.push("Data inválida.");
    }
    
    if (errors.length !== 0) {
        e.preventDefault();

        warningDiv.innerHTML = errors.shift();
        
        addEditValidationErrors.classList.remove("d-none");
        addEditValidationErrors.classList.add("d-flex");
    }
}
