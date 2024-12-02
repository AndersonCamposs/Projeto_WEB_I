const usuarioAddEditForm = document.getElementById("usuarioAddEditForm");
// OBTÉM A DIV EM QUE SERÁ EXIBIDA O AVISO DE ERRO DE VALIDAÇÃO CRIA A DIV QUE EXIBIRÁ ESSAS INFORMAÇÕES
const addEditValidationErrors = document.getElementById("addEditValidationErrors");
const  warningDiv = document.createElement("div");
warningDiv.classList.add("alert");
warningDiv.classList.add("alert-danger");
warningDiv.classList.add("text-center");
warningDiv.classList.add("w-25");
warningDiv.classList.add("mx-3");
addEditValidationErrors.appendChild(warningDiv);

usuarioAddEditForm.addEventListener("submit", (e) => {
   
    let inputNome = document.getElementById("inputNome");
    let inputEmail = document.getElementById("inputEmail");
    let inputCpf = document.getElementById("inputCpf");
    let inputSenha = document.getElementById("inputSenha");
    let inputRepetirSenha = document.getElementById("inputRepetirSenha");
    let inputFoto = document.getElementById("inputFoto");
    console.log(inputFoto.files);
    
    let errors = [];
    
    if (inputNome.value === "") {
        errors.push("O nome é obrigatório.");
    }
    
    let patternEmail = new RegExp('([A-Za-z0-9_\.]*)@([a-z]+)(\.[a-z]+)', 'g');
    if (!patternEmail.test(inputEmail.value)) {
        errors.push("E-mail inválido.");
    }
    
    let patternCpf = new RegExp("[^0-9]", "g");
    if (patternCpf.test(inputCpf.value)) {
        errors.push("O CPF precisa ter somente números.");
    }
    
    let cpf = inputCpf.value.replace("/\D/g", "");
    if (inputCpf.value.length !== 11) {
        errors.push("O CPF precisa ter 11 dígitos.");
    }
    
    if (inputSenha.value.length < 6) {
        errors.push("A senha precisa ter no mínimo 6 dígitos.");
    }
    
    if (inputSenha.value != inputRepetirSenha.value) {
        errors.push("As senhas precisam ser iguais.");
    }
    
    if (errors.length !== 0) {
        e.preventDefault();

        warningDiv.innerHTML = errors.shift();
        
        addEditValidationErrors.classList.remove("d-none");
        addEditValidationErrors.classList.add("d-flex");
    }
    
    e.preventDefault();
});

