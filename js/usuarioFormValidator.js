import resizePhoto from "./photoResizer.js";

let inputFoto = document.getElementById("inputFoto");

inputFoto.addEventListener("change", async (e) => {
        
    const arquivo = inputFoto.files[0];
    if(arquivo) {
        try {
            const blobRedimencionado = await resizePhoto(arquivo, 736, 736);
            const imagemRedimencionada = new File([blobRedimencionado], arquivo.name, { type:blobRedimencionado.type });
            // CRIA O DataTransfer PARA SUBSTITUIR O ARQUIVO DO INPUT
            const transferidor = new DataTransfer();
            transferidor.items.add(imagemRedimencionada);
            inputFoto.files = transferidor.files;

        } catch (e) {
            console.log("Erro ao redimencionar a imagem: " + e);
        }

    }
})

export default function usuarioFormValidator (e, addEditValidationErrors, warningDiv) {
    // LIMPANDO OS AVISOS DE ERROS CASO JÁ TENHAM SIDO EXIBIDOS ANTERIORMENTE
    addEditValidationErrors.classList.add("d-none");
    addEditValidationErrors.classList.remove("d-flex");
    warningDiv.innerHTML = "";
    
    let inputNome = document.getElementById("inputNome");
    let inputEmail = document.getElementById("inputEmail");
    let inputCpf = document.getElementById("inputCpf");
    let inputSenha = document.getElementById("inputSenha");
    let inputRepetirSenha = document.getElementById("inputRepetirSenha");
    
    
    
    let errors = [];
    
    if (inputNome.value === "") {
        errors.push("O nome é obrigatório.");
    }
    
    let patternEmail = new RegExp('([A-Za-z0-9_\.]*)@([a-z]+)(\.[a-z]+)', 'g');
    if (!patternEmail.test(inputEmail.value)) {
        errors.push("E-mail inválido.");
    }
    
    let onlyNumbersPattern = new RegExp("[^0-9]", "g");
    if (onlyNumbersPattern.test(inputCpf.value)) {
        errors.push("O CPF precisa ter somente números.");
    }
    
    let cpf = inputCpf.value.replace(/\D/g, "");
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
}

