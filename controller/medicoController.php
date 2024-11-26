<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/vo/MedicoVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/MedicoDAO.php';

if(isset($_POST['nome'])) {
    
    $medico = new MedicoVO();
    $medico->setNome($_POST["nome"]);
    $medico->setDataNascimento($_POST["dataNascimento"]);
    $medico->setCpf($_POST["cpf"]);
    $medico->setEmail($_POST["email"]);
    $medico->setIdEspecialidade($_POST["especialidade"]);
    $medico->setIdEstadoFormacao($_POST["estado"]);
    $medico->setDocumentoLicenca($_POST["documentoLicenca"]);
    
    if(isset($_POST['id'])) {
        $medico->setId($_POST['id']);
        
        MedicoDAO::getInstance()->update($medico);
    } else {
        MedicoDAO::getInstance()->insert($medico);
    }   
} else {
    MedicoDAO::getInstance()->delete($_GET["id"]);
}
echo "<script> window.location.href='../medicoList.php'; </script>";
