<?php

class DiaAtendimentoVO {
    private $id;
    private $nome;
    private $nomeEnglish;
    
    public function __construct() {
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }
    
    public function getNomeEnglish() {
        return $this->nomeEnglish;
    }

        public function setId($id): void {
        $this->id = $id;
    }

    public function setNome($nome): void {
        $this->nome = $nome;
    }
    
    public function setNomeEnglish($nomeEnglish): void {
        $this->nomeEnglish = $nomeEnglish;
    }


}
