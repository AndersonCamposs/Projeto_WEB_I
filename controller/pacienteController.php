<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/vo/PacienteVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/PacienteDAO.php';

if(isset($_POST['nome'])) {
    
    $paciente = new UsuarioVO();
    $paciente->setNome($_POST["nome"]);
    $paciente->setEmail($_POST["email"]);
    $paciente->setCpf($_POST["cpf"]);
    $paciente->setSenha($_POST["senha"]);
    $paciente->setFoto($_POST["foto"]);
    
    if(isset($_POST['id'])) {
        $paciente->setId($_POST['id']);
        
        UsuarioDAO::getInstance()->update($paciente);
    } else {
        UsuarioDAO::getInstance()->insert($paciente);
    }   
} else {
    UsuarioDAO::getInstance()->delete($_GET["id"]);
}

//echo "<script> window.location.href='../pacienteList.php'; </script>";
