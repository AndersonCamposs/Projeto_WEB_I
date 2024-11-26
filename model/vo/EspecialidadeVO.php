<?php

class EspecialidadeVO {
    private $id;
    private $nome;
    private $idConselho;
    private $descricao;
    
    public function getId() {
        return $this->id;
    }
    
     
    public function getNome() {
        return $this->nome;
    }
    
    
    public function getIdConselho() {
        return $this->idConselho;
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
    
    public function setIdConselho($idConselho): void {
        $this->idConselho = $idConselho;
    }

    public function setDescricao($descricao): void {
        $this->descricao = $descricao;
    }
}
