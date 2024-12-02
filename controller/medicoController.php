<?php
include '../authenticator.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/vo/MedicoVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/MedicoDAO.php';

if(isset($_POST['nome'])) {
    
    $medico = new MedicoVO();
    $medico->setNome($_POST["nome"]);
    $medico->setDataNascimento($_POST["dataNascimento"]);
    $medico->setCpf($_POST["cpf"]);
    $medico->setEmail($_POST["email"]);
    $medico->setEspecialidade($_POST["especialidade"]);
    $medico->setEstadoFormacao($_POST["estado"]);
    $medico->setDocumentoLicenca($_POST["documentoLicenca"]);
    
    if(isset($_POST['id'])) {
        $medico->setId($_POST['id']);
        
        MedicoDAO::getInstance()->update($medico);
    } else {
        MedicoDAO::getInstance()->insert($medico);
    }   
} else {
    if(checarAutorizacao(array(PermissaoDAO::getInstance()->getById(1)))) {
        UsuarioDAO::getInstance()->delete($_GET["id"]);  
    }
}
echo "<script> window.location.href='../medicoList.php'; </script>";
