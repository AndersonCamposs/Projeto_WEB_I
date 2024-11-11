<?php

class UsuarioVO {
    private $id;
    private $nome;
    private $cpf;
    private $email;
    private $senha;
    private $foto;
    
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNome($nome): void {
        $this->nome = $nome;
    }

    public function setCpf($cpf): void {
        $this->cpf = $cpf;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }

    public function setSenha($senha): void {
        $this->senha = $senha;
    }

    public function setFoto($foto): void {
        $this->foto = $foto;
    }
}
?>

