<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/vo/UsuarioVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/UsuarioDAO.php';

if(isset($_POST['nome'])) {
    
    $repetirSenha = $_POST["repetirSenha"];

    $usuario = new UsuarioVO();
    $usuario->setNome($_POST["nome"]);
    $usuario->setEmail($_POST["email"]);
    $usuario->setCpf($_POST["cpf"]);
    $usuario->setSenha($_POST["senha"]);
    $usuario->setFoto($_POST["foto"]);
    
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