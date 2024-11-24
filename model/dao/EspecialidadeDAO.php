<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/BDPDO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/vo/EspecialidadeVO.php';

class EspecialidadeDAO {
    public static $instance;

    private function __construct() {
        
    }

    public static function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new EspecialidadeDAO();

        return self::$instance;
    }

    public function insert(EspecialidadeVO $especialidade) {
        try {
            $sql = "INSERT INTO especialidade (nome)"
                    . "VALUES "
                    . "(:nome)";
            //perceba que na linha abaixo vai precisar de um import
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":nome", $especialidade->getNome());
            
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Erro ao executar a função de salvar" . $e->getMessage();
        }
    }

    public function update(EspecialidadeVO $especialidade) {
        try {
            $sql = "UPDATE especialidade SET nome=:nome where id=:id";
            //perceba que na linha abaixo vai precisar de um import
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":nome", $especialidade->getNome());
            
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Erro ao executar a função de atualizar" . $e->getMessage();
        }
    }

    public function delete($id) {
        try {
            $sql = "delete from especialidade where id = :id";
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
            $sql = "SELECT * FROM especialidade WHERE id = :id";
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
        $obj = new Especialidade();
        $obj->setId($row['id']);
        $obj->setNome($row['nome']);
        
        return $obj;
    }

    public function listAll() {
        try {
            $sql = "SELECT * FROM especialidade ";
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
            $sql = "SELECT * FROM especialidade " . $restanteDoSQL;
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
