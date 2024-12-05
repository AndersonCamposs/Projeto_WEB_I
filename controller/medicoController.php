<?php
include '../authenticator.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/vo/MedicoVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/MedicoDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/DiaAtendimentoDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/MedicoDiaAtendimentoDAO.php';

if(isset($_POST['nome'])) {
    
    $medico = new MedicoVO();
    $medico->setNome($_POST["nome"]);
    $medico->setDataNascimento($_POST["dataNascimento"]);
    $medico->setCpf($_POST["cpf"]);
    $medico->setEmail($_POST["email"]);
    $medico->setEspecialidade($_POST["especialidade"]);
    $medico->setEstadoFormacao($_POST["estado"]);
    $medico->setDocumentoLicenca($_POST["documentoLicenca"]);
    
    $arrayDiaAtendimento = []; // array para armazenar os dias de atendimento do médico informados no cadastro
    if(isset($_POST["Sunday"])) {
        $arrayDiaAtendimento[] = DiaAtendimentoDAO::getInstance()->getById($_POST["Sunday"]);
    }
    if(isset($_POST["Monday"])) {
        $arrayDiaAtendimento[] = DiaAtendimentoDAO::getInstance()->getById($_POST["Monday"]);
    }
    if(isset($_POST["Tuesday"])) {
        $arrayDiaAtendimento[] = DiaAtendimentoDAO::getInstance()->getById($_POST["Tuesday"]);
    }
    if(isset($_POST["Wednesday"])) {
        $arrayDiaAtendimento[] = DiaAtendimentoDAO::getInstance()->getById($_POST["Wednesday"]);
    }
    if(isset($_POST["Thursday"])) {
        $arrayDiaAtendimento[] = DiaAtendimentoDAO::getInstance()->getById($_POST["Thursday"]);
    }
    if(isset($_POST["Friday"])) {
        $arrayDiaAtendimento[] = DiaAtendimentoDAO::getInstance()->getById($_POST["Friday"]);
    }
    if(isset($_POST["Sunday"])) {
        $arrayDiaAtendimento[] = DiaAtendimentoDAO::getInstance()->getById($_POST["Saturday"]);
    }
    
    
    if(isset($_POST['id'])) {
        $medico->setId($_POST['id']);
        
        //MedicoDAO::getInstance()->update($medico);
    } else {
        $novoMedico = MedicoDAO::getInstance()->insert($medico);
        // INSERE AS NA TABELA ASSOCIATIVA OS RESPECTIVOS DIAS DE ATENDIMENTO DO MÉDICO
        foreach($arrayDiaAtendimento as $diaAtendimento) {
            MedicoDiaAtendimentoDAO::getInstance()->insert($novoMedico, $diaAtendimento);
        }
    }   
} else {
    if(checarAutorizacao(array(PermissaoDAO::getInstance()->getById(1)))) {
        MedicoDAO::getInstance()->delete($_GET["id"]);  
    }
}
echo "<script> window.location.href='../medicoList.php'; </script>";
