<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/vo/UsuarioVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/UsuarioDAO.php';

session_start();

if (isset($_POST["novaSenha"])) { // VERIFICA SE O FORM ENVIADO É DE ALTERAR A SENHA
    $hash = password_hash($_POST["novaSenha"], PASSWORD_DEFAULT);
    
    $_SESSION["usuarioLogado"]->setSenha($hash);
    
    UsuarioDAO::getInstance()->update($_SESSION["usuarioLogado"]);
    
    header("Location: ./logoutController.php");
    exit;
    
} else { // SE NAO FOR PARA ALTERAR A SENHA
    if(isset($_POST['nome'])) {

        $usuario = new UsuarioVO();
        $repetirSenha = $_POST["repetirSenha"];
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

            UsuarioDAO::getInstance()->update($usuario);
        } else {
            UsuarioDAO::getInstance()->insert($usuario);
        }   
    } else {
        UsuarioDAO::getInstance()->delete($_GET["id"]);
    }
    echo "<script> window.location.href='../usuarioList.php'; </script>";
}
