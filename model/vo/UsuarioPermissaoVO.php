<?php


class UsuarioPermissaoVO {
    private $id;
    private $usuario;
    private $permissao;
    
    public function __construct() {
        
    }
    public function getId() {
        return $this->id;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getPermissao() {
        return $this->permissao;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setUsuario($usuario): void {
        $this->usuario = $usuario;
    }

    public function setPermissao($permissao): void {
        $this->permissao = $permissao;
    }
}
