export default function alterarSenhaFormValidator(e, alterSenhaValidationErrors, warningDiv) {
    alterSenhaValidationErrors.classList.add("d-none");
    alterSenhaValidationErrors.classList.remove("d-flex");
    warningDiv.innerHTML = "";
        
    let inputSenhaAtual = document.getElementById("inputSenhaAtual");
    let inputNovaSenha = document.getElementById("inputNovaSenha");
    let inputRepetirNovaSenha = document.getElementById("inputRepetirNovaSenha");
    
    let errors = [];
    
    if(!inputSenhaAtual.value) {
        errors.push("Informe a senha atual.");
    }
    
    if(!inputNovaSenha.value) {
        errors.push("Informe a nova senha.");
    }
    
    if(inputNovaSenha.value !== inputRepetirNovaSenha.value) {
        errors.push("As senhas são diferentes.")
    }
    
    if (errors.length !== 0) {
        e.preventDefault();

        warningDiv.innerHTML = errors.shift();
        
        alterSenhaValidationErrors.classList.remove("d-none");
        alterSenhaValidationErrors.classList.add("d-flex");
    }
}

