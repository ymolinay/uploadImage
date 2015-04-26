<?php

require_once __DIR__ . '/../config/mysqli.data.php';
require_once __DIR__ . '/../entity/docenteSeccionCurso.php';

class DocenteSeccionCursoDAO {

    public $objDocenteSeccionCurso;
    private $task;

    const TABLE = "docenteseccioncurso";

    public function __construct() {
        $this->objDocenteSeccionCurso = new DocenteSeccionCurso();
        $this->task = new Task();
    }

    public function ExecuteSave($objDocenteSeccionCurso) {
        //$idDocenteSeccionCurso = $objDocenteSeccionCurso->getIdDocenteSeccionCurso();
        $idSeccion = $objDocenteSeccionCurso->getIdSeccion();
        $idUsuario = $objDocenteSeccionCurso->getIdUsuario();
        $idPlanEstudio = $objDocenteSeccionCurso->getIdPlanEstudio();
        $indicador = $objDocenteSeccionCurso->getIndicador();

        $this->task->setTables(self::TABLE);
        $this->task->setFields('idDocenteSeccionCurso;idSeccion;idUsuario;idPlanEstudio;dscIndicador');
        $this->task->setValues($idSeccion . ';' . $idUsuario . ';' . $idPlanEstudio . ';' . $indicador);
        return $this->task->executeInsert('idDocenteSeccionCurso');
    }

    public function CompleteComboboxDocente($objDocenteSeccionCurso) {
        $idUsuario = $objDocenteSeccionCurso->getIdUsuario();
        $this->task->setTables(self::TABLE . ';usuario;personal');
        $this->task->setFields('idDocenteSeccionCurso;idUsuario;prsNombre;prsApellidoPaterno;prsApellidoMaterno;prsDNI');
        $this->task->setIndex('0;1;2;2;2;2');
        $this->task->setTypeJoin('inner;inner');
        $this->task->setOnJoin('d0.idUsuario=u1.idUsuario;u1.idPersonal=p2.idPersonal');
        $this->task->setWhereFields('d0.idUsuario;d0.dscIndicador');
        $this->task->setWhereLogical('like;=');
        $this->task->setWhereValues($idUsuario . ';1');
        $this->task->setGroup('u1.idUsuario');
        $this->task->setOrder('p2.prsApellidoPaterno');
        $this->task->setValuesOrder('asc');
        return $this->task->executeMultiSelect();
    }

    public function CompleteComboboxCarrera($objDocenteSeccionCurso) {
        //$idDocenteSeccionCurso = $objDocenteSeccionCurso->getIdDocenteSeccionCurso();
        $idUsuario = $objDocenteSeccionCurso->getIdUsuario();
        $this->task->setTables(self::TABLE . ';seccion;carrera');
        $this->task->setFields('idDocenteSeccionCurso;idSeccion;idCarrera;carDescripcion;carPeriodos');
        $this->task->setIndex('0;1;2;2;2');
        $this->task->setTypeJoin('inner;inner');
        $this->task->setOnJoin('d0.idSeccion=s1.idSeccion;s1.idCarrera=c2.idCarrera');
        $this->task->setWhereFields('d0.idUsuario;d0.dscIndicador');
        $this->task->setWhereLogical('=;=');
        $this->task->setWhereValues($idUsuario . ';1');
        $this->task->setGroup('c2.idCarrera');
        $this->task->setOrder('c2.carDescripcion');
        $this->task->setValuesOrder('asc');
        return $this->task->executeMultiSelect();
    }

    public function CompleteComboboxCarreraCiclo($objDocenteSeccionCurso, $idCarrera) {
        //$idDocenteSeccionCurso = $objDocenteSeccionCurso->getIdDocenteSeccionCurso();
        $idUsuario = $objDocenteSeccionCurso->getIdUsuario();
        $this->task->setTables(self::TABLE . ';seccion;carrera;ciclo');
        $this->task->setFields('idDocenteSeccionCurso;idSeccion;idCiclo;cloDescripcion');
        $this->task->setIndex('0;1;3;3');
        $this->task->setTypeJoin('inner;inner;inner');
        $this->task->setOnJoin('d0.idSeccion=s1.idSeccion;s1.idCarrera=c2.idCarrera;s1.idCiclo=c3.idCiclo');
        $this->task->setWhereFields('d0.idUsuario;s1.idCarrera;d0.dscIndicador');
        $this->task->setWhereLogical('=;=;=');
        $this->task->setWhereValues($idUsuario . ';' . $idCarrera . ';1');
        $this->task->setGroup('s1.idCiclo');
        $this->task->setOrder('c3.cloDescripcion');
        $this->task->setValuesOrder('asc');
        return $this->task->executeMultiSelect();
    }

    public function CompleteComboboxCarreraCicloCurso($objDocenteSeccionCurso, $idCarrera, $idCiclo) {
        //$idDocenteSeccionCurso = $objDocenteSeccionCurso->getIdDocenteSeccionCurso();
        $idUsuario = $objDocenteSeccionCurso->getIdUsuario();
        $this->task->setTables(self::TABLE . ';seccion;carrera;ciclo;planestudio;curso');
        $this->task->setFields('idDocenteSeccionCurso;idPlanEstudio;idCurso;crsNombre');
        $this->task->setIndex('0;4;4;5');
        $this->task->setTypeJoin('inner;inner;inner;inner;inner');
        $this->task->setOnJoin('d0.idSeccion=s1.idSeccion;s1.idCarrera=c2.idCarrera;s1.idCiclo=c3.idCiclo;d0.idPlanEstudio=p4.idPlanEstudio;p4.idCurso=c5.idCurso');
        $this->task->setWhereFields('d0.idUsuario;s1.idCarrera;c3.idCiclo;d0.dscIndicador');
        $this->task->setWhereLogical('=;=;=;=');
        $this->task->setWhereValues($idUsuario . ';' . $idCarrera . ';' . $idCiclo . ';1');
        $this->task->setGroup('p4.idPlanEstudio');
        $this->task->setOrder('c5.crsNombre');
        $this->task->setValuesOrder('asc');
        return $this->task->executeMultiSelect();
    }

    public function CompleteComboboxCarreraCicloCursoSeccion($objDocenteSeccionCurso, $idCarrera, $idCiclo, $idTurno) {
        //$idDocenteSeccionCurso = $objDocenteSeccionCurso->getIdDocenteSeccionCurso();
        $idUsuario = $objDocenteSeccionCurso->getIdUsuario();
        $idPlanEstudio = $objDocenteSeccionCurso->getIdPlanEstudio();
        $this->task->setTables(self::TABLE . ';seccion');
        $this->task->setFields('idDocenteSeccionCurso;idSeccion;scnDescripcion;scnCantMaxima;scnInicio;scnFin');
        $this->task->setIndex('0;0;1;1;1;1');
        $this->task->setTypeJoin('inner');
        $this->task->setOnJoin('d0.idSeccion=s1.idSeccion');
        $this->task->setWhereFields('d0.idUsuario;d0.idPlanEstudio;s1.idCarrera;s1.idCiclo;s1.idTurno;d0.dscIndicador');
        $this->task->setWhereLogical('=;=;=;=;=;=');
        $this->task->setWhereValues($idUsuario . ';' . $idPlanEstudio . ';' . $idCarrera . ';' . $idCiclo . ';' . $idTurno . ';1');
        $this->task->setGroup('d0.idSeccion');
        $this->task->setOrder('s1.scnDescripcion');
        $this->task->setValuesOrder('asc');
        return $this->task->executeMultiSelect();
    }

}
