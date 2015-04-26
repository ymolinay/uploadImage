<?php

require_once __DIR__.'/../config/mysqli.data.php';
require_once __DIR__.'/../entity/tipoBeneficio.php';

class TipoBeneficioDAO {

    public $objTipoBeneficio;
    private $task;

    const TABLE = "tipobeneficio";

    public function __construct() {
        $this->objTipoBeneficio = new TipoBeneficio();
        $this->task = new Task();
    }

    public function SearchAllData() {
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idTipoBeneficio;tboDescripcion;tboPagoMatricula;tboPagoMensual;tboDescuentoPorcentaje;tboPaMatriculaDesc;tboPaMensualDesc');
        $this->task->setWhereFields('tboIndicador');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues('1');
        $this->task->setOrder('idTipoBeneficio');
        $this->task->setValuesOrder('asc');
        return $this->task->executeSelect();
    }

    public function SearchTipoBeneficio($objTipoBeneficio) {
        $idTipoBeneficio = $objTipoBeneficio->getIdTipoBeneficio();
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idTipoBeneficio;tboDescripcion;tboPagoMatricula;tboPagoMensual;tboDescuentoPorcentaje;tboPaMatriculaDesc;tboPaMensualDesc');
        $this->task->setWhereFields('idTipoBeneficio;tboIndicador');
        $this->task->setWhereLogical('=;=');
        $this->task->setWhereValues($idTipoBeneficio, '1');
        $this->task->setOrder('idTipoBeneficio');
        $this->task->setValuesOrder('asc');
        $this->task->setBeginLimit('0');
        $this->task->setEndLimit('1');
        return $this->task->executeSelect();
    }
    
}
