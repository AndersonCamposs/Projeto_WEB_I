<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/vo/PacienteVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/PacienteDAO.php';

if(isset($_POST['nome'])) {
    
    $paciente = new PacienteVO();
    $paciente->setNome($_POST["nome"]);
    $paciente->setDataNascimento($_POST["dataNascimento"]);
    $paciente->setCpf($_POST["cpf"]);
    $paciente->setRg($_POST["rg"]);
    $paciente->setCelular($_POST["celular"]);
    $paciente->setEmail($_POST["email"]);
    
    if(isset($_POST['id'])) {
        $paciente->setId($_POST['id']);
        
        PacienteDAO::getInstance()->update($paciente);
    } else {
        PacienteDAO::getInstance()->insert($paciente);
    }   
} else {
    UsuarioDAO::getInstance()->delete($_GET["id"]);
}

//echo "<script> window.location.href='../pacienteList.php'; </script>";
