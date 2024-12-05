<?php

class MedicoDiaAtendimento {
    private $id;
    private $medico;
    private $diaAtendimento;
    
    public function __construct() {
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getMedico() {
        return $this->medico;
    }

    public function getDiaAtendimento() {
        return $this->diaAtendimento;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setMedico($medico): void {
        $this->medico = $medico;
    }

    public function setDiaAtendimento($diaAtendimento): void {
        $this->diaAtendimento = $diaAtendimento;
    }

}
