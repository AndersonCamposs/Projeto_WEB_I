<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/vo/ConsultaVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/ConsultaDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/MedicoDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/PacienteDAO.php';

$error = false;
if(isset($_POST['cpfMedico'])) {
    $medicoConsulta = MedicoDAO::getInstance()->getByCpf($_POST["cpfMedico"]);
    $pacienteConsulta = PacienteDAO::getInstance()->getByCpf($_POST["cpfPaciente"]);
    var_dump($medicoConsulta);
    var_dump($pacienteConsulta);
    
    $consulta = new ConsultaVO();
    $consulta->setDataConsulta($_POST["dataConsulta"]);
    $consulta->setMedico($medicoConsulta->getId());
    $consulta->setPaciente($pacienteConsulta->getId());
    $consulta->setValor($_POST["valor"]);
    $consulta->setMetodoPagamento($_POST["metodoPagamento"]);
    
    if(isset($_POST['id'])) {
        $consulta->setId($_POST['id']);
        
        //ConsultaDAO::getInstance()->update($consulta);
    } else {
        //ConsultaDAO::getInstance()->insert($consulta);
    }   
} else {
    //ConsultaDAO::getInstance()->delete($_GET["id"]);
}
//echo "<script> window.location.href='../consultaList.php'; </script>";
