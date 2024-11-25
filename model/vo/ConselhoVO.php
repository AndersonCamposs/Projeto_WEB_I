<?php

class ConselhoVO {
    private $id;
    private $sigla;
    private $nome;
    
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
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
}
