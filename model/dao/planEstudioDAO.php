<?php

require_once __DIR__ . '/../config/mysqli.data.php';
require_once __DIR__ . '/../entity/planEstudio.php';

class PlanEstudioDAO {

    public $objPlanEstudio;
    private $task;

    const TABLE = "planestudio";

    public function __construct() {
        $this->objPlanEstudio = new PlanEstudio();
        $this->task = new Task();
    }

    public function GeneratePlanEstudio($objPlanEstudio) {
        $idCarrera = $objPlanEstudio->getIdCarrera();
        $this->task->setTables(self::TABLE . ';carrera;curso;ciclo');
        $this->task->setFields('idPlanEstudio;idCarrera;carDescripcion;carPeriodos;idCurso;crsNombre;idCiclo;cloDescripcion');
        $this->task->setIndex('0;0;1;1;0;2;0;3');
        $this->task->setTypeJoin('inner;inner;inner');
        $this->task->setOnJoin('p0.idCarrera=c1.idCarrera;p0.idCurso=c2.idCurso;p0.idCiclo=c3.idCiclo');
        $this->task->setWhereFields('p0.idCarrera;p0.pldIndicador');
        $this->task->setWhereLogical('=;=');
        $this->task->setWhereValues($idCarrera . ';1');
        $this->task->setOrder('p0.idCiclo');
        $this->task->setValuesOrder('asc');
        return $this->task->executeMultiSelect();
    }

    public function ExecuteCompleteComboboxAsignarCursos($objPlanEstudio) {
        $idCarrera = $objPlanEstudio->getIdCarrera();
        $idCiclo = $objPlanEstudio->getIdCiclo();
        $indicador = $objPlanEstudio->getPldIndicador();
        $this->task->setTables(self::TABLE . ';curso');
        $this->task->setFields('idPlanEstudio;idCarrera;idCiclo;idCurso;crsNombre');
        $this->task->setIndex('0;0;0;0;1');
        $this->task->setTypeJoin('inner');
        $this->task->setOnJoin('p0.idCurso=c1.idCurso');
        $this->task->setWhereFields('p0.idCarrera;p0.idCiclo;p0.pldIndicador');
        $this->task->setWhereLogical('=;=;=');
        $this->task->setWhereValues($idCarrera . ';' . $idCiclo . ';' . $indicador);
        $this->task->setOrder('c1.crsNombre');
        $this->task->setValuesOrder('asc');
        return $this->task->executeMultiSelect();
    }

    public function ExecuteSave($objPlanEstudio) {
        $notaMinima = $objPlanEstudio->getNotaMinima();
        $idCarrera = $objPlanEstudio->getIdCarrera();
        $idCurso = $objPlanEstudio->getIdCurso();
        $idCiclo = $objPlanEstudio->getIdCiclo();
        $indicador = $objPlanEstudio->getPldIndicador();
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idPlanEstudio;pldNotaMinima;idCarrera;idCurso;idCiclo;pldIndicador');
        $this->task->setValues($notaMinima . ';' . $idCarrera . ';' . $idCurso . ';' . $idCiclo . ';' . $indicador);
        return $this->task->executeInsert('idPlanEstudio');
    }
    
    public function ExecuteUpdate($objPlanEstudio) {
        $idPlanEstudio = $objPlanEstudio->getIdPlanEstudio();
        $notaMinima = $objPlanEstudio->getNotaMinima();
        $idCarrera = $objPlanEstudio->getIdCarrera();
        $idCurso = $objPlanEstudio->getIdCurso();
        $idCiclo = $objPlanEstudio->getIdCiclo();
        $indicador = $objPlanEstudio->getPldIndicador();
        $this->task->setTables(self::TABLE);
        $this->task->setFields('pldNotaMinima;idCarrera;idCurso;idCiclo;pldIndicador');
        $this->task->setValues($notaMinima . ';' . $idCarrera . ';' . $idCurso . ';' . $idCiclo . ';' . $indicador);
        $this->task->setWhereFields('idPlanEstudio');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($idPlanEstudio);
        return $this->task->executeUpdate();
    }
    
    public function ExecuteSearch($objPlanEstudio) {
        $idPlanEstudio = $objPlanEstudio->getIdPlanEstudio();
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idPlanEstudio;pldNotaMinima;idCarrera;idCurso;idCiclo;pldIndicador');
        $this->task->setWhereFields('idPlanEstudio');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($idPlanEstudio);
        $this->task->setOrder('idPlanEstudio');
        $this->task->setValuesOrder('asc');
        return $this->task->executeSelect();
    }

}
