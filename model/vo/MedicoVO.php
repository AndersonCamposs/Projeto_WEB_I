<?php

class MedicoVO {
    private $id;
    private $nome;
    private $dataNascimento;
    private $cpf;
    private $celular;
    private $documentoLicenca;
    private $especialidade;
    private $conselho;
    
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getDataNascimento() {
        return $this->dataNascimento;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getCelular() {
        return $this->celular;
    }

    public function getDocumentoLicenca() {
        return $this->documentoLicenca;
    }
    
    public function getEspecialidade() {
        return $this->especialidade;
    }
    
    public function getConselho() {
        return $this->conselho;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNome($nome): void {
        $this->nome = $nome;
    }

    public function setDataNascimento($dataNascimento): void {
        $this->dataNascimento = $dataNascimento;
    }

    public function setCpf($cpf): void {
        $this->cpf = $cpf;
    }

    public function setCelular($celular): void {
        $this->celular = $celular;
    }

    public function setDocumentoLicenca($documentoLicenca): void {
        $this->documentoLicenca = $documentoLicenca;
    }
    
    public function setEspecialidade($especialidade) {
        $this->especialidade = $especialidade;
    }
    
    public function setConselho($conselho) {
        $this->conselho = $this->conselho;
    }
}
