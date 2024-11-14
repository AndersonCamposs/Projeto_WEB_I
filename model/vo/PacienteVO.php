<?php
class PacienteVO {
    private $id;
    private $nome;
    private $dataNascimento;
    private $cpf;
    private $estadoCivil;
    private $celular;
    private $logradouro;
    private $bairro;
    private $cep;
    private $complemento;
    private $numeroEndereco;
    
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

    public function getEstadoCivil() {
        return $this->estadoCivil;
    }

    public function getCelular() {
        return $this->celular;
    }

    public function getLogradouro() {
        return $this->logradouro;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function getCep() {
        return $this->cep;
    }

    public function getComplemento() {
        return $this->complemento;
    }

    public function getNumeroEndereco() {
        return $this->numero;
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

    public function setEstadoCivil($estadoCivil): void {
        $this->estadoCivil = $estadoCivil;
    }

    public function setCelular($celular): void {
        $this->celular = $celular;
    }

    public function setLogradouro($logradouro): void {
        $this->logradouro = $logradouro;
    }

    public function setBairro($bairro): void {
        $this->bairro = $bairro;
    }

    public function setCep($cep): void {
        $this->cep = $cep;
    }

    public function setComplemento($complemento): void {
        $this->complemento = $complemento;
    }

    public function setNumeroEndereco($numero): void {
        $this->numero = $numero;
    }
}
?>