<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/BDPDO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/vo/MedicoVO.php';

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
            $sql = "INSERT INTO Medico(nome, dataNascimento, cpf, celular, documentoLicenca,"
                    . "idEspecialidade, idEstado) "
                    . "VALUES (:nome, :dataNascimento, :cpf, :celular, :documentoLicenca,"
                    . ":idEspecialidade, :idEstado)";
                    
            
            $p_sql = BDPDO::getInstance()->prepare($sql);
            
            $p_sql->bindValue(":nome", $medico->getNome());
            $p_sql->bindValue(":dataNascimento", $medico->getDataNascimento());
            $p_sql->bindValue(":cpf", $medico->getCpf());
            $p_sql->bindValue(":celular", $medico->getCelular());
            $p_sql->bindValue(":documentoLicenca", $medico->getDocumentoLicenca());
            $p_sql->bindValue(":idEspecialidade", $medico->getIdEspecialidade());
            $p_sql->bindValue(":idEstado", $medico->getIdEstadoFormacao());
            
            return $p_sql->execute();
                    
        } catch (Exception $e) {
            echo "Erro ao salvar na base de dados ".$e->getMessage();
        }
    }
}
