<?php

class EspecialidadeVO {
    private $id;
    private $nome;
    private $conselho;
    private $descricao;
    
    public function getId() {
        return $this->id;
    }
    
     
    public function getNome() {
        return $this->nome;
    }
    
    
    public function getConselho() {
        return $this->conselho;
    }
    
    public function getDescricao() {
        return $this->descricao;
    }

    public function setId($id) {
        $this->id = $id;
    }
   
    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function setConselho($conselho): void {
        $this->conselho = $conselho;
    }

    public function setDescricao($descricao): void {
        $this->descricao = $descricao;
    }
}
