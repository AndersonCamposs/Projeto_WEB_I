const consultaAddEditForm = document.getElementById("consultaAddEditForm");
// OBTÉM A DIV EM QUE SERÁ EXIBIDA O AVISO DE ERRO DE VALIDAÇÃO CRIA A DIV QUE EXIBIRÁ ESSAS INFORMAÇÕES
const addEditValidationErrors = document.getElementById("addEditValidationErrors");
const  warningDiv = document.createElement("div");
warningDiv.classList.add("alert");
warningDiv.classList.add("alert-danger");
warningDiv.classList.add("text-center");
warningDiv.classList.add("w-25");
warningDiv.classList.add("mx-3");
addEditValidationErrors.appendChild(warningDiv);

consultaAddEditForm.addEventListener("submit", (e) => {
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
        let isoString = dataAtual.toISOString();
        inputDataConsulta.value = isoString.split("T")[0];
    }

    let errors = [];
    
    let onlyNumbersPattern = new RegExp("[^0-9]", "g");
    if (onlyNumbersPattern.test(inputCpfPaciente.value)) {
        errors.push("O CPF do paciente precisa ter somente números.");
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
    
    let dataConsulta = inputDataConsulta.value.split("-");
    dataConsulta = new Date(dataConsulta[0], dataConsulta[1]-1, dataConsulta[2]);
    if (dataConsulta > new Date()) {
        errors.push("Data inválida inválida");
    }
    
    if (errors.length !== 0) {
        e.preventDefault();

        warningDiv.innerHTML = errors.shift();
        
        addEditValidationErrors.classList.remove("d-none");
        addEditValidationErrors.classList.add("d-flex");
    }
    
});
