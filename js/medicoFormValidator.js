const medicoAddEditForm = document.getElementById("medicoAddEditForm");
// OBTÉM A DIV EM QUE SERÁ EXIBIDA O AVISO DE ERRO DE VALIDAÇÃO CRIA A DIV QUE EXIBIRÁ ESSAS INFORMAÇÕES
const addEditValidationErrors = document.getElementById("addEditValidationErrors");
const  warningDiv = document.createElement("div");
warningDiv.classList.add("alert");
warningDiv.classList.add("alert-danger");
warningDiv.classList.add("text-center");
warningDiv.classList.add("w-25");
warningDiv.classList.add("mx-3");
addEditValidationErrors.appendChild(warningDiv);

medicoAddEditForm.addEventListener("submit", (e) => {
    // LIMPANDO OS AVISOS DE ERROS CASO JÁ TENHAM SIDO EXIBIDOS ANTERIORMENTE
    addEditValidationErrors.classList.add("d-none");
    addEditValidationErrors.classList.remove("d-flex");
    warningDiv.innerHTML = "";
    
    let inputNome = document.getElementById("inputNome") ;
    let inputDataNasc = document.getElementById("inputDataNasc");
    let inputCpf = document.getElementById("inputCpf");
    let inputEmail = document.getElementById("inputEmail");
    let inputDocumentoLicenca = document.getElementById("inputDocumentoLicenca");
    
    let errors = [];
    
    if (inputNome.value === "") {
        errors.push("O nome é obrigatório.");
    }
    
    let dataNasc = inputDataNasc.value.split("-");
    dataNasc = new Date(dataNasc[0], dataNasc[1]-1, dataNasc[2]);
    if (dataNasc > new Date()) {
        errors.push("Data de nascimento inválida");
    }
    
    let onlyNumbersPattern = new RegExp("[^0-9]", "g");
    if (onlyNumbersPattern.test(inputCpf.value)) {
        errors.push("O CPF precisa ter somente números.");
    }
    
    let cpf = inputCpf.value.replace(/\D/g, "");
    if (cpf.length !== 11) {
        errors.push("O CPF precisa ter 11 dígitos.");
    }
    
    let patternEmail = new RegExp('([A-Za-z0-9_\.]*)@([a-z]+)(\.[a-z]+)', 'g');
    if (!patternEmail.test(inputEmail.value)) {
        errors.push("E-mail inválido.");
    }
    
    if(inputDocumentoLicenca.value.length === 0) {
        errors.push("O documento de licença é obrigatório.");
    }
    
    if(onlyNumbersPattern.test(inputDocumentoLicenca.value)) {
        errors.push("O documento de licença deve ter apenas números.");
    }
    
    if (errors.length !== 0) {
        e.preventDefault();

        warningDiv.innerHTML = errors.shift();
        
        addEditValidationErrors.classList.remove("d-none");
        addEditValidationErrors.classList.add("d-flex");
    }
    
});


