<?php

class ConselhoVO {
    private $id;
    private $sigla;
    private $nome;
    private $idEstado;
    
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getIdEstado() {
        return $this->estado;
    }
    
    public function getSigla() {
        return $this->sigla;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNome($nome): void {
        $this->nome = $nome;
    }

    public function setSigla($sigla): void {
        $this->sigla = $sigla;
    }

    public function setIdEstado($idEstado): void {
        $this->idEstado = $idEstado;
    }
}
