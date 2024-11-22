<?php

class ConselhoVO {
    private $conselho;
    private $estado;
    
    public function getConselho() {
        return $this->conselho;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setConselho($conselho): void {
        $this->conselho = $conselho;
    }

    public function setEstado($estado): void {
        $this->estado = $estado;
    }
}
