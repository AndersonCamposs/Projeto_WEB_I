<?php
include '../authenticator.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/vo/UsuarioVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/UsuarioDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/PermissaoDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/UsuarioPermissaoDAO.php';


if (isset($_POST["novaSenha"])) { // VERIFICA SE O FORM ENVIADO É DE ALTERAR A SENHA
    $hash = password_hash($_POST["novaSenha"], PASSWORD_DEFAULT);
    
    $_SESSION["usuarioLogado"]->setSenha($hash);
    
    UsuarioDAO::getInstance()->update($_SESSION["usuarioLogado"]);
    
    header("Location: ./logoutController.php");
    exit;
    
} else { // SE NAO FOR PARA ALTERAR A SENHA
    if(isset($_POST['nome'])) {
        
        $usuario = new UsuarioVO();
        $repetirSenha = isset($_POST["repetirSenha"]) ? $_POST["novaSenha"] : '';
        //PROCESSANDO A FOTO ENVIADA PELO USUÁRIO
        if ($_FILES["foto"]["name"] != '') {
            $foto = $_FILES["foto"];

            $extensoesPermitidas = ["jpg", "jpeg", "png"];
            $extensaoFoto = strtolower(pathinfo($foto["name"], PATHINFO_EXTENSION));

            if (!in_array($extensaoFoto, $extensoesPermitidas)) {
                die("Erro: extensão de foto não permitida");
            } else {
                $uploadDir = __DIR__ . "/../uploads/users/";
                if (!is_dir($uploadDir)) {
                    // Verifica se o diretório de uploads existe, senão cria
                    mkdir($uploadDir, 0755, true);
                }

                $fileName = uniqid("img_") . "." . $extensaoFoto;
                $fullUploadName = $uploadDir . $fileName;

                // Dimensões fixas para a nova imagem
                $novaLargura = 736;
                $novaAltura = 736;

                // Criar a imagem de destino com dimensões fixas
                $imagemRedimensionada = imagecreatetruecolor($novaLargura, $novaAltura);

                // Criar a imagem a partir do arquivo original
                switch ($extensaoFoto) {
                    case 'jpg':
                    case 'jpeg':
                        $imagemOriginal = imagecreatefromjpeg($foto["tmp_name"]);
                        break;
                    case 'png':
                        $imagemOriginal = imagecreatefrompng($foto["tmp_name"]);
                        break;
                    default:
                        die("Erro: formato de imagem não suportado.");
                }

                // Redimensionar diretamente para o tamanho desejado
                imagecopyresampled(
                    $imagemRedimensionada, // Imagem de destino
                    $imagemOriginal,       // Imagem original
                    0, 0,                  // Coordenadas de destino
                    0, 0,                  // Coordenadas de origem
                    $novaLargura,          // Largura de destino
                    $novaAltura,           // Altura de destino
                    imagesx($imagemOriginal), // Largura original
                    imagesy($imagemOriginal)  // Altura original
                );

                // Salvar a imagem redimensionada
                switch ($extensaoFoto) {
                    case 'jpg':
                    case 'jpeg':
                        imagejpeg($imagemRedimensionada, $fullUploadName, 90); // Qualidade 90
                        break;
                    case 'png':
                        imagepng($imagemRedimensionada, $fullUploadName, 8); // Compressão nível 8
                        break;
                }

                // Liberar memória
                imagedestroy($imagemRedimensionada);
                imagedestroy($imagemOriginal);

                // Atualizar o caminho da foto no objeto do usuário
                $usuario->setFoto("./uploads/users/" . $fileName);
            }
        }



        $usuario->setNome($_POST["nome"]);
        $usuario->setEmail($_POST["email"]);
        $usuario->setCpf($_POST["cpf"]);
        // CRIANDO E SETANDO A SENHA HASHEADA DO USUÁRIO CASO O USUÁRIO A ENVIE (ELA NÃO SERÁ ENVIADA CASO O FORMULÁRIO SEJA DE EDITAR OS DADOS)
        if(isset($_POST["senha"])) {
            // CRIANDO O HASH DA SENHA
            $hash = password_hash($_POST["senha"], PASSWORD_DEFAULT);
            $usuario->setSenha($hash);
        } else { // CASO A SENHA NÃO ESTEJA SETADA, SIGNIFICA QUE O USUÁRIO ESTÁ ATUALIZANDO O PERFIL, LOGO, A SENHA NÃO SE ALTERA
            $usuario->setSenha($_SESSION["usuarioLogado"]->getSenha()); // A SENHA CONTINUA A MESMA
        }
        
        if(isset($_POST['id'])) {
            $usuario->setId($_POST['id']);
            
            // OBTÉM A FOTO SO USUÁRIO, CASO ELE TENHA UMA FOTO, ELA É SETADA 
            // NO OBJETO UsuarioVO QUE SERÁ ENVIADO PARA O MÉTODO update
            $fotoUsuario = UsuarioDAO::getInstance()->getById($usuario->getId())->getFoto();
            if(isset($fotoUsuario)) { $usuario->setFoto($fotoUsuario); }
            // EM CASO DE ATUALIZAÇÃO, VERIFICA SE AQUELA PERMISSÃO ESPECÍFICA JÁ NÃO FOI CONCEDIDA ÀQUELE USUÁRIO
            $usuarioPermissoes = UsuarioPermissaoDAO::getInstance()->listWhere("WHERE idPermissao = :idPermissao AND idUsuario = :idUsuario", 
            array(0 => ":idPermissao", 1 => ":idUsuario"), array(0 => $_POST["permissao"], 1 => $usuario->getId()));
            if(empty($usuarioPermissoes)){ 
                // SE O ARRAY FOR VAZIO, SIGNIFICA QUE O USUÁRIO NÃO TEM AQUELA PERMISSÃO EM ESPECÍFICO
                $permissao = PermissaoDAO::getInstance()->getById($_POST["permissao"]);
                //REGISTRA AS PERMISSÕES DO USUÁRIO NA TABELA RELACIONAL
                UsuarioPermissaoDAO::getInstance()->insert($usuario, $permissao);
            }
            UsuarioDAO::getInstance()->update($usuario);
        } else {
            // EM CASO DE INSERÇÃO, REGISTRA NA TABELA RELACIONAL (O USUÁRIO AINDA NÃO TEM NENHUMA PERMISSÃO)
            $novoUsuario = UsuarioDAO::getInstance()->insert($usuario); // O USUÁRIO RECÉM INSERIDO NO BANCO
            $permissao = PermissaoDAO::getInstance()->getById($_POST["permissao"]); // A PERMISSÃO INSERIDA JUNTO COM ESTE USUÁRIO
            UsuarioPermissaoDAO::getInstance()->insert($novoUsuario, $permissao); // REGISTRA NA TABELA RELACIONAL
        }   
    } else {
        if($_GET["removerFoto"]) {
            if ($_SESSION["usuarioLogado"]->getId() == $_GET["id"] || checarAutorizacao(array(PermissaoDAO::getInstance()->getById(1)))) {
                // CASO O USUÁRIO QUE ESTIVER 
                // TENTANDO REMOVER A PRÓPRIA FOTO OU FOR ADMNISTRADOR
                $usuarioExistente = UsuarioDAO::getInstance()->getById($_GET["id"]);
                
                if(isset($usuarioExistente) && file_exists("../".$usuarioExistente ->getFoto())) {
                    if(unlink("../".$usuarioExistente ->getFoto())) {
                      $usuarioExistente->setFoto(null); 
                      var_dump($usuarioExistente);
                      UsuarioDAO::getInstance()->update($usuarioExistente);
                      if ($_SESSION["usuarioLogado"]->getId() == $_GET["id"]) {
                          // CASO O USUÁRIO LOGADO REMOVA A PRÓPRIA FOTO
                          // ATUALIZA OS DADOS NA SESSÃO IMEDIATAMENTE
                          $_SESSION["usuarioLogado"]->setFoto(null);
                      }
                    }
                }
            }
        } else if (checarAutorizacao(array(PermissaoDAO::getInstance()->getById(1)))) {
          UsuarioDAO::getInstance()->delete($_GET["id"]);  
        }
    }
    header("Location: ../usuarioList.php");
}