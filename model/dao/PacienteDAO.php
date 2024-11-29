<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/BDPDO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/vo/PacienteVO.php';

class PacienteDAO {

    public static $instance;

    private function __construct() {
        
    }

    public static function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new PacienteDAO();

        return self::$instance;
    }

    public function insert(PacienteVO $paciente) {
        try {
            $sql = "INSERT INTO paciente (nome,dataNascimento,cpf,rg,celular, email)"
                    . "VALUES "
                    . "(:nome,:dataNascimento,:cpf,:rg,:celular,:email)";
            //perceba que na linha abaixo vai precisar de um import
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":nome", $paciente->getNome());
            $p_sql->bindValue(":dataNascimento", $paciente->getDataNascimento());
            $p_sql->bindValue(":cpf", $paciente->getCpf());
            $p_sql->bindValue(":rg", $paciente->getRg());
            $p_sql->bindValue(":celular", ($paciente->getCelular()));
            $p_sql->bindValue(":email", ($paciente->getEmail()));
            
        
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Erro ao executar a função de salvar" . $e->getMessage();
        }
    }

    public function update(PacienteVO $paciente) {
        try {
            $sql = "UPDATE paciente SET nome=:nome, dataNascimento=:dataNascimento, cpf=:cpf, rg=:rg,
                celular=:celular, email=:email WHERE id=:id";
            //perceba que na linha abaixo vai precisar de um import
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":nome", $paciente->getNome());
            $p_sql->bindValue(":dataNascimento", $paciente->getDataNascimento());
            $p_sql->bindValue(":cpf", $paciente->getCpf());
            $p_sql->bindValue(":rg", $paciente->getRg());
            $p_sql->bindValue(":celular", ($paciente->getCelular()));
            $p_sql->bindValue(":email", ($paciente->getEmail()));
            $p_sql->bindValue(":id", $paciente->getId());
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Erro ao executar a função de atualizar" . $e->getMessage();
        }
    }

    public function delete($id) {
        try {
            $sql = "delete from paciente where id = :id";
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
            $sql = "SELECT * FROM paciente WHERE id = :id";
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":id", $id);
            $p_sql->execute();
            return $this->converterLinhaDaBaseDeDadosParaObjeto($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado
 um LOG do mesmo, tente novamente mais tarde.";
        }
    }
    public function getByCpf($cpf) {
        try {
            $sql = "SELECT * FROM paciente WHERE cpf = :cpf";
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":cpf", $cpf);
            $p_sql->execute();
            return $this->converterLinhaDaBaseDeDadosParaObjeto($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado
 um LOG do mesmo, tente novamente mais tarde.";
        }
    }

    private function converterLinhaDaBaseDeDadosParaObjeto($row) {
        
        $obj = new PacienteVO();
        $obj->setId($row['id']);
        $obj->setNome($row['nome']);
        $obj->setDataNascimento($row['dataNascimento']);
        $obj->setCpf($row['cpf']);
        $obj->setRg($row['rg']);
        $obj->setCelular($row['celular']);
        $obj->setEmail($row['email']);
        
        return $obj;
    }

    public function listAll() {
        try {
            $sql = "SELECT * FROM paciente ";
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
            $sql = "SELECT * FROM paciente " . $restanteDoSQL;
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

}
?>
