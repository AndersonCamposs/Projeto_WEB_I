<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/BDPDO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/vo/ConsultaVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/MedicoDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/PacienteDAO.php';

class ConsultaDAO {
    public static $instance;

    private function __construct() {
        
    }

    public static function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new ConsultaDAO();

        return self::$instance;
    }

    public function insert(ConsultaVO $consulta) {
        try {
            $sql = "INSERT INTO Consulta (idMedico, idPaciente, dataConsulta, valor, metodoPagamento)"
                    . "VALUES "
                    . "(:idMedico, :idPaciente, :dataConsulta, :valor, :metodoPagamento)";
            //perceba que na linha abaixo vai precisar de um import
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":idMedico", $consulta->getMedico());
            $p_sql->bindValue(":idPaciente", $consulta->getPaciente());
            $p_sql->bindValue(":dataConsulta", $consulta->getDataConsulta());
            $p_sql->bindValue(":valor", $consulta->getValor());
            $p_sql->bindValue(":metodoPagamento", ($consulta->getMetodoPagamento()));
            
        
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Erro ao executar a função de salvar" . $e->getMessage();
        }
    }

    public function update(ConsultaVO $consulta) {
        try {
            $sql = "UPDATE consulta SET idMedico=:idMedico, idPaciente=:idPaciente, dataConsulta=:dataConsulta, valor=:valor, metodoPagamento=:metodoPagamento WHERE id=:id";
            //perceba que na linha abaixo vai precisar de um import
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":idMedico", $consulta->getMedico());
            $p_sql->bindValue(":idPaciente", $consulta->getPaciente());
            $p_sql->bindValue(":dataConsulta", $consulta->getDataConsulta());
            $p_sql->bindValue(":valor", $consulta->getValor());
            $p_sql->bindValue(":metodoPagamento", ($consulta->getMetodoPagamento()));
            $p_sql->bindValue(":id", $consulta->getId());
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Erro ao executar a função de atualizar" . $e->getMessage();
        }
    }

    public function delete($id) {
        try {
            $sql = "delete from consulta where id = :id";
            //perceba que na linha abaixo vai precisar de um import
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":id", $id);
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Erro ao executar a função de deletar --" . $e->getMessage();
        }
    }

    public function getById($id) {
        try {
            $sql = "SELECT * FROM consulta WHERE id = :id";
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":id", $id);
            $p_sql->execute();
            return $this->converterLinhaDaBaseDeDadosParaObjeto($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado
 um LOG do mesmo, tente novamente mais tarde.";
        }
    }

    private function converterLinhaDaBaseDeDadosParaObjeto($row) {
        
        $obj = new ConsultaVO();
        $obj->setId($row['id']);
        $obj->setDataConsulta($row['dataConsulta']);
        $obj->setValor($row['valor']);
        $obj->setMetodoPagamento($row['metodoPagamento']);
        $obj->setMedico(MedicoDAO::getInstance()->getById($row['idMedico']));
        $obj->setPaciente(PacienteDAO::getInstance()->getById($row['idPaciente']));
        
        return $obj;
    }

    public function listAll() {
        try {
            $sql = "SELECT * FROM consulta ";
            $p_sql = BDPDO::getInstance()->prepare($sql);

            $p_sql->execute();

            $lista = array();
            $row = $p_sql->fetch(PDO::FETCH_ASSOC);
            while ($row) {
                $lista[] = $this->converterLinhaDaBaseDeDadosParaObjeto($row);
                $row = $p_sql->fetch(PDO::FETCH_ASSOC);
            }
            return $lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado
 um LOG do mesmo, tente novamente mais tarde.";
        }
    }

    public function listWhere($restanteDoSQL, $arrayDeParametros, $arrayDeValores) {
        try {
            $sql = "SELECT * FROM consulta " . $restanteDoSQL;
            $p_sql = BDPDO::getInstance()->prepare($sql);
            for ($i = 0; $i < sizeof($arrayDeParametros); $i++) {
                $p_sql->bindValue($arrayDeParametros[$i], $arrayDeValores [$i]);
            }
            $p_sql->execute();
            $lista = array();
            $row = $p_sql->fetch(PDO::FETCH_ASSOC);
            while ($row) {
                $lista[] = $this->converterLinhaDaBaseDeDadosParaObjeto($row);
                $row = $p_sql->fetch(PDO::FETCH_ASSOC);
            }
            return $lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado
 um LOG do mesmo, tente novamente mais tarde.".$e->getMessage();
        }
    }
    
    public function listFaturamentoMensal($anoAtual) {
        try {
            $sql = "SELECT MONTH(dataConsulta) AS mes, SUM(valor) AS soma
            FROM consulta
            WHERE YEAR(dataConsulta) = :anoAtual
            GROUP BY mes
            ORDER BY MONTH(dataConsulta) ASC;";
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":anoAtual", $anoAtual);
            $obj = new stdClass();
            $obj -> months = array();
            $obj -> values = array();
            $p_sql->execute();
            $row = $p_sql->fetch(PDO::FETCH_ASSOC);
            while ($row) {
                $obj->months[] = $row["mes"];
                $obj->values[] = $row["soma"];
                $row = $p_sql->fetch(PDO::FETCH_ASSOC);
            }
            
            return $obj;
            
            
            
            
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado
 um LOG do mesmo, tente novamente mais tarde.".$e->getMessage();
        }
    }
}
