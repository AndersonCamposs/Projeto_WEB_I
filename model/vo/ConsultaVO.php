<?php

class ConsultaVO {
    private $id;
    private $dataConsulta;
    private $valor;
    private $metodoPagamento;
    private $medico; // INICIALMENTE, ARMAZENA O CPF DO MÉDICO
    private $paciente; // INICIALMENTE, ARMAZENA O CPF DO PACIENTE
    
    public function getId() {
        return $this->id;
    }

    public function getDataConsulta() {
        return $this->dataConsulta;
    }

    public function getValor() {
        return $this->valor;
    }

    public function getMetodoPagamento() {
        return $this->metodoPagamento;
    }

    public function getMedico() {
        return $this->medico;
    }

    public function getPaciente() {
        return $this->paciente;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setDataConsulta($dataConsulta): void {
        $this->dataConsulta = $dataConsulta;
    }

    public function setValor($valor): void {
        $this->valor = $valor;
    }

    public function setMetodoPagamento($metodoPagamento): void {
        $this->metodoPagamento = $metodoPagamento;
    }

    public function setMedico($medico): void {
        $this->medico = $medico;
    }

    public function setPaciente($paciente): void {
        $this->paciente = $paciente;
    }

}
