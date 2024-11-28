<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/vo/UsuarioVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/UsuarioDAO.php';

if(isset($_POST['nome'])) {
    
    $usuario = new UsuarioVO();
    $repetirSenha = $_POST["repetirSenha"];
    //PROCESSANDO A FOTO ENVIADA PELO USUÁRIO
    if ($_FILES["foto"]["name"] != '') {
        var_dump($_FILES);
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
    $usuario->setSenha($_POST["senha"]);
    
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