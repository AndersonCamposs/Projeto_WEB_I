<?php

class MedicoVO {
    private $id;
    private $nome;
    private $dataNascimento;
    private $cpf;
    private $email;
    private $documentoLicenca;
    private $especialidade; // ARMAZENA O ID DA ESPECIALIDADE
    private $estadoFormacao; //ARMAZENA O ID DO ESTADO DE FORMAÇÃO ACADÊMICA
    
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

    public function getEmail() {
        return $this->email;
    }

    public function getDocumentoLicenca() {
        return $this->documentoLicenca;
    }

    public function getEspecialidade() {
        return $this->especialidade;
    }

    public function getEstadoFormacao() {
        return $this->estadoFormacao;
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

    public function setEmail($email): void {
        $this->email = $email;
    }

    public function setDocumentoLicenca($documentoLicenca): void {
        $this->documentoLicenca = $documentoLicenca;
    }

    public function setEspecialidade($especialidade): void {
        $this->especialidade = $especialidade;
    }

    public function setEstadoFormacao($estadoFormacao): void {
        $this->estadoFormacao = $estadoFormacao;
    }

}
