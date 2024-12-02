<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/vo/ConsultaVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/ConsultaDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/MedicoDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/PacienteDAO.php';

if(isset($_POST['cpfMedico'])) {
    $medicoConsulta = MedicoDAO::getInstance()->getByCpf($_POST["cpfMedico"]);
    $pacienteConsulta = PacienteDAO::getInstance()->getByCpf($_POST["cpfPaciente"]);
    
    session_start();
    if($medicoConsulta == null) {
        $_SESSION["flash_message_medico"] = "Médico não encontrado, verifique os dados e tente novamente";
        //header("Location: ../consultaAddEdit.php");
    } 
    
    if ($pacienteConsulta == null) {
        $_SESSION["flash_message_paciente"] = "Paciente não encontrado, verifique e tente novamente.";
        //header("Location: ../consultaAddEdit.php");
    }
    
    var_dump($_SESSION["flash_message_medico"]);
    unset($_SESSION["flash_message_medico"]);
    var_dump($_SESSION);
    $consulta = new ConsultaVO();
    $consulta->setDataConsulta(date("Y-m-d"));
    $consulta->setMedico($medicoConsulta->getId());
    $consulta->setPaciente($pacienteConsulta->getId());
    $consulta->setValor($_POST["valor"]);
    $consulta->setMetodoPagamento($_POST["metodoPagamento"]);
    
    if(isset($_POST['id'])) {
        $consulta->setId($_POST['id']);
        
        ConsultaDAO::getInstance()->update($consulta);
    } else {
        ConsultaDAO::getInstance()->insert($consulta);
    }   
} else {
    ConsultaDAO::getInstance()->delete($_GET["id"]);
}
//echo "<script> window.location.href='../consultaList.php'; </script>";
