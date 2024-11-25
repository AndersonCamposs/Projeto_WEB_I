<?php

class EspecialidadeVO {
    private $id;
    private $nome;
    private $idConselho;
    
    public function getId() {
        return $this->id;
    }
    
     
    public function getNome() {
        return $this->nome;
    }
    
    
    public function getIdConselho() {
        return $this->idConselho;
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


}
