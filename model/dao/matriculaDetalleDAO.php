<?php

require_once __DIR__ . '/../config/mysqli.data.php';
require_once __DIR__ . '/../entity/matriculaDetalle.php';

class MatriculaDetalleDAO {

    public $objMatriculaDetalle;
    private $task;

    const TABLE = 'matriculadetalle';

    public function __construct() {
        $this->objMatriculaDetalle = new MatriculaDetalle();
        $this->task = new Task();
    }

    public function ExecuteSave($objMatriculaDetalle) {
        $idMatriculaDetalle = $this->task->getId(self::TABLE, 'idMatriculaDetalle');
        $idMatricula = $objMatriculaDetalle->getIdMatricula();
        $idPlanEstudio = $objMatriculaDetalle->getIdPlanEstudio();
        $indicador = $objMatriculaDetalle->getIndicador();

        $this->task->setTables(self::TABLE);
        $this->task->setFields('idMatriculaDetalle;idMatricula;idPlanEstudio;mtdIndicador');
        $this->task->setValues($idMatricula . ';' . $idPlanEstudio . ';' . $indicador);
        $result[0] = $this->task->executeInsert('idMatriculaDetalle');
        $result[1] = $idMatriculaDetalle;
        return $result;
    }

    public function SearchDetalleMatricula($objMatriculaDetalle) {
        $idMatricula = $objMatriculaDetalle->getIdMatricula();
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idMatriculaDetalle;idMatricula;idPlanEstudio');
        $this->task->setWhereFields('idMatricula;mtdIndicador');
        $this->task->setWhereLogical('=;=');
        $this->task->setWhereValues($idMatricula . ';1');
        $this->task->setOrder('idPlanEstudio');
        $this->task->setValuesOrder('asc');
        return $this->task->executeSelect();
    }

    public function UpdateDeleteMatriculaDetalle($objMatriculaDetalle) {
        $idMatricula = $objMatriculaDetalle->getIdMatricula();
        $this->task->setTables(self::TABLE);
        $this->task->setFields('mtdIndicador');
        $this->task->setValues('0');
        $this->task->setWhereFields('idMatricula;mtdIndicador');
        $this->task->setWhereLogical('=;=');
        $this->task->setWhereValues($idMatricula . ';1');
        return $this->task->executeUpdate();
    }

}
