export default function resizePhoto(arquivo, largura, altura) {
        
    return new Promise((resolve, reject) => {
            const leitor = new FileReader();
            leitor.onload = (e) => {
                const foto = new Image();
                foto.onload = () => {
                    const canvas = document.createElement("canvas");
                    const contexto = canvas.getContext("2d");
                    
                    // SETA AS DIMENSÕES DO CANVAS
                    canvas.width = largura;
                    canvas.height = altura;
                    
                    contexto.drawImage(foto, 0, 0, largura, altura);
                    
                    // CONVERTE O CANVAS PARA BLOB (DADO BINÁRIO)
                    canvas.toBlob(
                        (blob) => {
                            if(blob) {
                                resolve(blob);
                            } else {
                                reject(new Error("Erro ao criar o blob da imagem"));
                            }
                        },
                        arquivo.type,
                        0.9
                    );
                };
                foto.onerror = reject;
                foto.src = e.target.result;
            };
            leitor.onerror = reject;
            leitor.readAsDataURL(arquivo);
        });
}


