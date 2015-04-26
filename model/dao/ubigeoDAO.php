<?php

require_once __DIR__.'/../config/mysqli.data.php';
require_once __DIR__.'/../entity/ubigeo.php';

class UbigeoDAO {
    
    public $objUbigeo;
    private $task;
   
    const TABLA = "ubigeo";

    public function __construct() {
        $this->objUbigeo = new Ubigeo();
        $this->task = new Task();
    }
    
    public function ExecuteCompleteCombobox() {
        
        $this->task->setTables(self::TABLA);
        $this->task->setFields('idUbigeo;departamento;provincia;distrito');
        //$this->task->setFields('idUbigeo;CONCAT(departamento,", ",provincia,", ",distrito) AS descripcion');
        $this->task->setOrder('idUbigeo');
        $this->task->setValuesOrder('asc');
        return $this->task->executeSelect();
        
    }
    
    
}