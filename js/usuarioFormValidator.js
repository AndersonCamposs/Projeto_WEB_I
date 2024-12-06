import resizePhoto from "./photoResizer.js";

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
    let inputFoto = document.getElementById("inputFoto");
    if(inputFoto.files[0]) {
        (async function() {
            const arquivo = inputFoto.files[0];
            console.log(arquivo);
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
        })()
    }
    
    
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
    if (cpf.length !== 11) {
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
}

