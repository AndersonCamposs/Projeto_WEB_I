<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/BDPDO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/vo/MedicoVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/EspecialidadeDAO.php';

class MedicoDAO {
    public static $instance;
    
    public function __construct() {
        
    }

    public static function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new MedicoDAO();

        return self::$instance;
    }
    
    public function insert(MedicoVO $medico) {
        try {
            $sql = "INSERT INTO Medico(nome, dataNascimento, cpf, email, documentoLicenca,"
                    . "idEspecialidade, idEstado) "
                    . "VALUES (:nome, :dataNascimento, :cpf, :email, :documentoLicenca,"
                    . ":idEspecialidade, :idEstado)";
                    
            
            $p_sql = BDPDO::getInstance()->prepare($sql);
            
            $p_sql->bindValue(":nome", $medico->getNome());
            $p_sql->bindValue(":dataNascimento", $medico->getDataNascimento());
            $p_sql->bindValue(":cpf", $medico->getCpf());
            $p_sql->bindValue(":email", $medico->getEmail());
            $p_sql->bindValue(":documentoLicenca", $medico->getDocumentoLicenca());
            $p_sql->bindValue(":idEspecialidade", $medico->getIdEspecialidade());
            $p_sql->bindValue(":idEstado", $medico->getIdEstadoFormacao());
            
            return $p_sql->execute();
                    
        } catch (Exception $e) {
            echo "Erro ao salvar na base de dados ".$e->getMessage();
        }
        
    }
    
    public function update(MedicoVO $medico) {
        try {
            $sql = "UPDATE Medico SET nome=:nome, SET dataNascimento=:dataNascimento,"
                    ." SET cpf=:cpf, SET email=:email, SET idEspecialidade=:idEspeciaidade,"
                    ." SET idEstado=:idEstado WHERE id=:id";
            
            $p_sql = BDPDO::getInstance()->prepare($sql);
            
            $p_sql->bindValue(":nome", $medico->getNome());
            $p_sql->bindValue(":dataNascimento", $medico->getDataNascimento());
            $p_sql->bindValue(":cpf", $medico->getCpf());
            $p_sql->bindValue(":email", $medico->getEmail());
            $p_sql->bindValue(":documentoLicenca", $medico->getDocumentoLicenca());
            $p_sql->bindValue(":idEspecialidade", $medico->getIdEspecialidade());
            $p_sql->bindValue(":idEstado", $medico->getIdEstadoFormacao());
            
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Erro ao executar a função de atualizar" . $e->getMessage();
        }
    }
    
    public function delete($id) {
        try {
            $sql = "DELETE FROM Medico WHERE id=:id";
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
            $sql = "SELECT * FROM Medico WHERE id = :id";
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
        $obj = new MedicoVO();
        $obj->setId($row['id']);
        $obj->setNome($row['nome']);
        $obj->setDataNascimento($row['dataNascimento']);
        $obj->setCpf($row['cpf']);
        $obj->setEmail($row['email']);
        $obj->setDocumentoLicenca($row['documentoLicenca']);
        $obj->setIdEspecialidade(EspecialidadeDAO::getInstance()->getById($row['idEspecialidade']));
        $obj->setIdEstadoFormacao($row['idEstado']);
        
        return $obj;
    }

    public function listAll() {
        try {
            $sql = "SELECT * FROM Medico";
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
}
