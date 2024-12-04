<?php
include '../authenticator.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/vo/ConsultaVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/ConsultaDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/MedicoDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/PacienteDAO.php';


$erro = false;
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
        $consultaArrayDados = [];
        if(isset($pacienteErrorMessage)) {
            $consultaArrayErros[] = $pacienteErrorMessage;
        }
        if(isset($medicoErrorMessage)) {
            $consultaArrayErros[] = $medicoErrorMessage;
        }
        $consultaArrayDados["cpfPaciente"] = $_POST["cpfPaciente"];
        $consultaArrayDados["cpfMedico"] = $_POST["cpfMedico"];
        $consultaArrayDados["valor"] = $_POST["valor"];
        $consultaArrayDados["dataConsulta"] = $_POST["dataConsulta"];
        $consultaArrayDados["metodoPagamento"] = $_POST["metodoPagamento"];
        
        $_SESSION["consultaArrayErros"] = $consultaArrayErros;
        $_SESSION["consultaArrayDados"] = $consultaArrayDados;
        
        /* CASO A QUERY STRING "id" ESTEJA SETADA, REDIRECIONA PARA A RESPECTIVA 
        PÁGINA DE ADD EDIT DA CONSULTA REFERENTE AO ID*/
        isset($_POST["id"]) ? header("Location: ../consultaAddEdit.php?id=".$_POST["id"]): header("Location: ../consultaAddEdit.php");
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
