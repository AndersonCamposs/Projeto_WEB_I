export default function resizePhoto(arquivo, largura, altura) {
    const pica = window.pica();
    return new Promise((resolve, reject) => {
            const leitor = new FileReader();
            leitor.onload = (e) => {
                const img = new Image();
                img.onload = async () => {
                    const canvas = document.createElement("canvas");
                    
                    // SETA AS DIMENSÕES DO CANVAS
                    canvas.width = largura;
                    canvas.height = altura;
                    try {
                        await pica.resize(img, canvas);
                        const blob = await pica.toBlob(canvas, arquivo.type, 0.9);
                        resolve(blob);
                    } catch (err) {
                        reject(err);
                    }
                };
                img.onerror = () => reject(new Error("Erro ao carregar a imagem."));
                img.src = e.target.result; // DEFINE O SRC DA IMAGEM
            };
            leitor.onerror = () => reject(new Error("Erro ao carregar o arquivo."))
            leitor.readAsDataURL(arquivo);
        });
}


