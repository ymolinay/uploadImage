<?php

require_once __DIR__ . '/../config/mysqli.data.php';
require_once __DIR__ . '/../entity/curso.php';

class CursoDAO {

    public $objCurso;
    private $task;

    const TABLE = "curso";

    public function __construct() {
        $this->objCurso = new Curso();
        $this->task = new Task();
    }

    public function ExecuteSearch($objCurso) {
        $idCurso = $objCurso->getIdCurso();
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idCurso;crsNombre;crsIndicador');
        $this->task->setWhereFields('idCurso');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($idCurso);
        $this->task->setOrder('crsNombre');
        $this->task->setValuesOrder('asc');
        return $this->task->executeSelect();
    }

    public function ExecuteSave($objCurso) {
        $nombre = $objCurso->getNombre();
        $indicador = $objCurso->getIndicador();

        $this->task->setTables(self::TABLE);
        $this->task->setFields('idCurso;crsNombre;crsIndicador');
        $this->task->setValues($nombre . ';' . $indicador);
        return $this->task->executeInsert('idCurso');
    }

    public function ExecuteUpdate($objCurso) {
        $idCurso = $objCurso->getIdCurso();
        $nombre = $objCurso->getNombre();
        $indicador = $objCurso->getIndicador();

        $this->task->setTables(self::TABLE);
        $this->task->setFields('crsNombre');
        $this->task->setValues($nombre);
        $this->task->setWhereFields('idCurso');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($idCurso);
        return $this->task->executeUpdate();
    }

    public function ExecuteCompleteCombobox() {
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idCurso;crsNombre');
        $this->task->setWhereFields('crsIndicador');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues('1');
        $this->task->setOrder('crsNombre');
        $this->task->setValuesOrder('asc');
        return $this->task->executeSelect();
    }

}
