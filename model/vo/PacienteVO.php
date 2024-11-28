<?php
class PacienteVO {
    private $id;
    private $nome;
    private $dataNascimento;
    private $cpf;
    private $rg;
    private $celular;
    private $email;
    
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

    public function getRg() {
        return $this->rg;
    }

    public function getCelular() {
        return $this->celular;
    }

    public function getEmail() {
        return $this->email;
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
    
    public function setRg($rg) {
        $this->rg = $rg;
    }

    public function setCelular($celular): void {
        $this->celular = $celular;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }
}
?>