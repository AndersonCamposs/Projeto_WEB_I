<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/BDPDO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/vo/UsuarioPermissaoVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/UsuarioPermissaoDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/UsuarioPermissaoDAO.php';

class UsuarioPermissaoDAO {
    public static $instance;

    private function __construct() {
        
    }

    public static function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new UsuarioPermissaoDAO();

        return self::$instance;
    }

    public function insert(UsuarioPermissaoVO $usuarioPermissao) {
        try {
            $sql = "INSERT INTO usuario_permissao (idUsuario, idPermissao)"
                    . "VALUES "
                    . "(:idUsuario, :idPermissao)";
            //perceba que na linha abaixo vai precisar de um import
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":idUsuario", $usuarioPermissao->getMedico());
            $p_sql->bindValue(":idPermissao", $usuarioPermissao->getPaciente());
            
        
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Erro ao executar a função de salvar" . $e->getMessage();
        }
    }

    public function update(UsuarioPermissaoVO $usuarioPermissao) {
        try {
            $sql = "UPDATE usuario_permissao SET idUsuario=:idUsuario, idPermissao=:idPermissao WHERE id=:id";
            //perceba que na linha abaixo vai precisar de um import
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":idUsuario", $usuarioPermissao->getMedico());
            $p_sql->bindValue(":idPermissao", $usuarioPermissao->getPaciente());
            $p_sql->bindValue(":id", $usuarioPermissao->getId());
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Erro ao executar a função de atualizar" . $e->getMessage();
        }
    }

    public function delete($id) {
        try {
            $sql = "delete from usuario_permissao where id = :id";
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
            $sql = "SELECT * FROM usuarioPermissao WHERE id = :id";
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
        
        $obj = new UsuarioPermissaoVO();
        $obj->setId($row['id']);
        $obj->setUsuario(UsuarioDAO::getInstance()->getById($row["idUsuario"]));
        $obj->setPermissao(PermissaoDAO::getInstance()->getById($row["idPermissao"]));
        
        return $obj;
    }

    public function listAll() {
        try {
            $sql = "SELECT * FROM usuarioPermissao ";
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
            $sql = "SELECT * FROM usuarioPermissao " . $restanteDoSQL;
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
