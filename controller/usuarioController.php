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

            if(!in_array($extensaoFoto, $extensoesPermitidas)) {
                die("Erro: extensão de foto não permitida");
            } else {
                $uploadDir = __DIR__."/../uploads/users/";
                if (!is_dir($uploadDir)) {
                    // VERIFICA SE O DIRETÓRIO DE UPLOADS EXISTS, SENÃO CRIA
                    mkdir($uploadDir, 0755, true);
                }
                $fileName = uniqid("img_").".".$extensaoFoto;

                $fullUploadName = $uploadDir.$fileName;

                if(move_uploaded_file($foto["tmp_name"], $fullUploadName)){
                    $usuario->setFoto("./uploads/users/".$fileName);
                } else {
                    $usuario->setFoto(null);
                }
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
        if(checarAutorizacao(array(PermissaoDAO::getInstance()->getById(1)))) {
          UsuarioDAO::getInstance()->delete($_GET["id"]);  
        }
    }
    header("Location: ../usuarioList.php");
}
