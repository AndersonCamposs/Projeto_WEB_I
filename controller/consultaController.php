<?php
include '../authenticator.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/vo/ConsultaVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/ConsultaDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/MedicoDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/PacienteDAO.php';



if(isset($_POST['cpfMedico'])) {
    $pacienteConsulta = PacienteDAO::getInstance()->getByCpf($_POST["cpfPaciente"]);
    $medicoConsulta = MedicoDAO::getInstance()->getByCpf($_POST["cpfMedico"]);
    
    if(!isset($pacienteConsulta)) {
        $pacienteErrorMessage = "Paciente não encontrado, verifique o CPF e tente novamente.";
        $erro = true;
    }

    if(!isset($medicoConsulta)) {
        $medicoErrorMessage = "Médico não encontrado, verifique o CPF e tente novamente.";
        $erro = true;
    }
    
    if($erro) {
        $consultaArrayErros = [];
        if(isset($pacienteErrorMessage)) {
            $consultaArrayErros[] = $pacienteErrorMessage;
        }
        if(isset($medicoErrorMessage)) {
            $consultaArrayErros[] = $medicoErrorMessage;
        }
       
        $_SESSION["consultaArrayErros"] = $consultaArrayErros;
        header("Location: ../consultaAddEdit.php");
        exit;
    }
    
    $consulta = new ConsultaVO();
    $consulta->setDataConsulta($_POST["dataConsulta"]);
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
echo "<script> window.location.href='../consultaList.php'; </script>";
