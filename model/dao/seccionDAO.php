<?php

require_once __DIR__ . '/../config/mysqli.data.php';
require_once __DIR__ . '/../entity/seccion.php';

class SeccionDAO {

    public $objSeccion;
    private $task;

    const TABLE = 'seccion';

    public function __construct() {
        $this->objSeccion = new Seccion();
        $this->task = new Task();
    }

    public function ExecuteCompleteCombobox($objSeccion) {
        $idCarrera = $objSeccion->getIdCarrera();
        $idTurno = $objSeccion->getIdTurno();
        $idCiclo = $objSeccion->getIdCiclo();
        $this->task->setTables(self::TABLE . ';turno;carrera');
        $this->task->setFields('idSeccion;scnDescripcion;scnCantMaxima;scnInicio;scnFin;idTurno;troDescripcion;idCarrera;carDescripcion');
        $this->task->setIndex('0;0;0;0;0;0;1;0;2');
        $this->task->setTypeJoin('inner;inner');
        $this->task->setOnJoin('s0.idTurno=t1.idTurno;s0.idCarrera= c2.idCarrera');
        $this->task->setWhereFields('s0.idCarrera;s0.idTurno;s0.idCiclo;s0.scnIndicador');
        $this->task->setWhereLogical('=;=;=;=');
        $this->task->setWhereValues($idCarrera . ';' . $idTurno . ';' . $idCiclo . ';1');
        $this->task->setOrder('s0.scnDescripcion');
        $this->task->setValuesOrder('asc');
        return $this->task->executeMultiSelect();
    }

    public function ExecuteSave($objSeccion) {
        $descripcon = $objSeccion->getDescripcion();
        $cantMaxima = $objSeccion->getCantMaxima();
        $idTurno = $objSeccion->getIdTurno();
        $inicio = $objSeccion->getInicio();
        $fin = $objSeccion->getFin();
        $anioCreacion = $objSeccion->getAnioCreacion();
        $idCarrera = $objSeccion->getIdCarrera();
        $idCiclo = $objSeccion->getIdCiclo();
        $indicador = $objSeccion->getIndicador();

        $this->task->setTables(self::TABLE);
        $this->task->setFields('idSeccion;scnDescripcion;scnCantMaxima;scnInicio;scnFin;scnAnioCreacion;idTurno;idCarrera;idCiclo;scnIndicador');
        $this->task->setValues($descripcon . ';' . $cantMaxima . ';' . $inicio . ';' . $fin . ';' . $anioCreacion . ';' . $idTurno . ';' . $idCarrera . ';' . $idCiclo . ';' . $indicador);
        return $this->task->executeInsert('idSeccion');
    }

    public function ExecuteUpdate($objSeccion) {
        $idSeccion = $objSeccion->getIdSeccion();
        $descripcon = $objSeccion->getDescripcion();
        $cantMaxima = $objSeccion->getCantMaxima();
        $idTurno = $objSeccion->getIdTurno();
        $inicio = $objSeccion->getInicio();
        $fin = $objSeccion->getFin();
        //$anioCreacion = $objSeccion->getAnioCreacion();
        $idCarrera = $objSeccion->getIdCarrera();
        $idCiclo = $objSeccion->getIdCiclo();
        $indicador = $objSeccion->getIndicador();

        $this->task->setTables(self::TABLE);
        $this->task->setFields('scnDescripcion;scnCantMaxima;scnInicio;scnFin;idTurno;idCarrera;idCiclo');
        $this->task->setValues($descripcon . ';' . $cantMaxima . ';' . $inicio . ';' . $fin . ';' . $idTurno . ';' . $idCarrera . ';' . $idCiclo);
        $this->task->setWhereFields('idSeccion;scnIndicador');
        $this->task->setWhereLogical('=;=');
        $this->task->setWhereValues($idSeccion . ';' . $indicador);
        return $this->task->executeUpdate();
    }

    public function SearchSeccion($objSeccion) {
        $idSeccion = $objSeccion->getIdSeccion();
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idSeccion;scnDescripcion;scnCantMaxima;scnInicio;scnFin;scnAnioCreacion;idTurno;idCarrera;idCiclo;scnIndicador');
        $this->task->setWhereFields('idSeccion;scnIndicador');
        $this->task->setWhereLogical('=;=');
        $this->task->setWhereValues($idSeccion . ';1');
        return $this->task->executeSelect();
    }

}
