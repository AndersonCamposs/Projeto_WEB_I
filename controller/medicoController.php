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
    } else { 
    /* CASO O CHECKBOX NÃO ESTIVER MARCADO, É PRECISO COGITAR A POSSIBILIDADE DELE TER SIDO DESMARCADO
    NO FORMULÁRIO DE ATUALIZAÇÃO DE DADOS */
        if(isset($_POST["id"])) { // CASO ESTEJA SETADO O $_POST['id'], REALMENTE É UM FORMULÁRIO DE EDIÇÃO
            // VERIFICA SE HÁ REGISTROS NA TABELA ASSOCIATIVA DAQUELE MÉDICO COM O DIA QUE SE REFERE ESTE CHECKBOX
            if(null != MedicoDiaAtendimentoDAO::getInstance()->listWhere("WHERE idMedico = :idMedico AND idDiaAtendimento = :idDiaAtendimento", array(0 => ":idMedico", 1 => ":idDiaAtendimento"), array(0 => $_POST["id"], 1 => 1))) {
                // CASO HAJA, SIGNIFICA REALMENTE QUE O USUÁRIO DESEJOU REMOVER AQUELE DIA DE ATENDIMENTO PARA AQUELE MÉDICO
                MedicoDiaAtendimentoDAO::getInstance()->deleteWhere("WHERE idMedico = :idMedico AND idDiaAtendimento = :idDiaAtendimento", array(0 => ":idMedico", 1 => ":idDiaAtendimento"), array(0 => $_POST["id"], 1 => 1));
            }
        }
    }
    
    if(isset($_POST["Monday"])) {
        $arrayDiaAtendimento[] = DiaAtendimentoDAO::getInstance()->getById($_POST["Monday"]);
    } else {
        if(isset($_POST["id"])) {
            if(null != MedicoDiaAtendimentoDAO::getInstance()->listWhere("WHERE idMedico = :idMedico AND idDiaAtendimento = :idDiaAtendimento", array(0 => ":idMedico", 1 => ":idDiaAtendimento"), array(0 => $_POST["id"], 1 => 2))) {
                MedicoDiaAtendimentoDAO::getInstance()->deleteWhere("WHERE idMedico = :idMedico AND idDiaAtendimento = :idDiaAtendimento", array(0 => ":idMedico", 1 => ":idDiaAtendimento"), array(0 => $_POST["id"], 1 => 2));
            }
        }
    }
    
    if(isset($_POST["Tuesday"])) {
        $arrayDiaAtendimento[] = DiaAtendimentoDAO::getInstance()->getById($_POST["Tuesday"]);
    } else {
        if(isset($_POST["id"])) {
            if(null != MedicoDiaAtendimentoDAO::getInstance()->listWhere("WHERE idMedico = :idMedico AND idDiaAtendimento = :idDiaAtendimento", array(0 => ":idMedico", 1 => ":idDiaAtendimento"), array(0 => $_POST["id"], 1 => 3))) {
                MedicoDiaAtendimentoDAO::getInstance()->deleteWhere("WHERE idMedico = :idMedico AND idDiaAtendimento = :idDiaAtendimento", array(0 => ":idMedico", 1 => ":idDiaAtendimento"), array(0 => $_POST["id"], 1 => 3));
            }
        }
    }
    
    if(isset($_POST["Wednesday"])) {
        $arrayDiaAtendimento[] = DiaAtendimentoDAO::getInstance()->getById($_POST["Wednesday"]);
    } else {
        if(isset($_POST["id"])) {
            if(null != MedicoDiaAtendimentoDAO::getInstance()->listWhere("WHERE idMedico = :idMedico AND idDiaAtendimento = :idDiaAtendimento", array(0 => ":idMedico", 1 => ":idDiaAtendimento"), array(0 => $_POST["id"], 1 => 4))) {
                MedicoDiaAtendimentoDAO::getInstance()->deleteWhere("WHERE idMedico = :idMedico AND idDiaAtendimento = :idDiaAtendimento", array(0 => ":idMedico", 1 => ":idDiaAtendimento"), array(0 => $_POST["id"], 1 => 4));
            }
        }
    }
    
    if(isset($_POST["Thursday"])) {
        $arrayDiaAtendimento[] = DiaAtendimentoDAO::getInstance()->getById($_POST["Thursday"]);
    } else {
        if(isset($_POST["id"])) {
            if(null != MedicoDiaAtendimentoDAO::getInstance()->listWhere("WHERE idMedico = :idMedico AND idDiaAtendimento = :idDiaAtendimento", array(0 => ":idMedico", 1 => ":idDiaAtendimento"), array(0 => $_POST["id"], 1 => 5))) {
                MedicoDiaAtendimentoDAO::getInstance()->deleteWhere("WHERE idMedico = :idMedico AND idDiaAtendimento = :idDiaAtendimento", array(0 => ":idMedico", 1 => ":idDiaAtendimento"), array(0 => $_POST["id"], 1 => 5));
            }
        }
    }
    
    if(isset($_POST["Friday"])) {
        $arrayDiaAtendimento[] = DiaAtendimentoDAO::getInstance()->getById($_POST["Friday"]);
    } else {
        if(isset($_POST["id"])) {
            if(null != MedicoDiaAtendimentoDAO::getInstance()->listWhere("WHERE idMedico = :idMedico AND idDiaAtendimento = :idDiaAtendimento", array(0 => ":idMedico", 1 => ":idDiaAtendimento"), array(0 => $_POST["id"], 1 => 6))) {
                MedicoDiaAtendimentoDAO::getInstance()->deleteWhere("WHERE idMedico = :idMedico AND idDiaAtendimento = :idDiaAtendimento", array(0 => ":idMedico", 1 => ":idDiaAtendimento"), array(0 => $_POST["id"], 1 => 6));
            }
        }
    }
    
    if(isset($_POST["Sunday"])) {
        $arrayDiaAtendimento[] = DiaAtendimentoDAO::getInstance()->getById($_POST["Saturday"]);
    } else {
        if(isset($_POST["id"])) {
            if(null != MedicoDiaAtendimentoDAO::getInstance()->listWhere("WHERE idMedico = :idMedico AND idDiaAtendimento = :idDiaAtendimento", array(0 => ":idMedico", 1 => ":idDiaAtendimento"), array(0 => $_POST["id"], 1 => 7))) {
                MedicoDiaAtendimentoDAO::getInstance()->deleteWhere("WHERE idMedico = :idMedico AND idDiaAtendimento = :idDiaAtendimento", array(0 => ":idMedico", 1 => ":idDiaAtendimento"), array(0 => $_POST["id"], 1 => 7));
            }
        }
    }
    
    
    if(isset($_POST['id'])) {
        $medico->setId($_POST['id']);
        
        $medicoDiasAtendimento = MedicoDiaAtendimentoDAO::getInstance()->listWhere("WHERE idMedico = :idMedico", array(0 => ":idMedico"), array( 0 => $_POST["id"]));
        $arrayDias = [];
        foreach($medicoDiasAtendimento as $medicoDiaAtendimento) {
            $arrayDias[] = $medicoDiaAtendimento->getDiaAtendimento();
        }
        
        MedicoDAO::getInstance()->update($medico);
        
        // EM CASO DE ATUALIZAÇÃO E ADIÇÃO DE UM NOVO DIA DE ATENDIMENTO PARA AQUELE MÉDICO, INSERE NA TABELA ASSOCIATIVA
        foreach($arrayDiaAtendimento as $diaAtendimento) {
            // CASO NO ARRAY QUE TENHA OS DIAS EM QUE O MÉDICO ATENDE NÃO CONTENHA
            // ALGUM DIA QUE TENHA SIDO MARCADO NO CHECKBOX, REGISTRA NA TABELA ASSOCIATIVA
            if(!in_array($diaAtendimento, $arrayDias)) {
                MedicoDiaAtendimentoDAO::getInstance()->insert(MedicoDAO::getInstance()->getById($_POST["id"]), $diaAtendimento);  
            }
            
        }
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
