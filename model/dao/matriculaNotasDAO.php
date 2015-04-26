<?php

require_once __DIR__ . '/../config/mysqli.data.php';
require_once __DIR__ . '/../entity/matriculaNotas.php';

class MatriculaNotasDAO {

    public $objMatriculaNotas;
    private $task;

    const TABLE = 'matriculanotas';

    public function __construct() {
        $this->objMatriculaNotas = new MatriculaNotas();
        $this->task = new Task();
    }

    public function ExecuteSave($objMatriculaNotas) {
        //$idMatriculaNotas = $objMatriculaNotas->getIdMatriculaNotas();
        $u1Ev1 = $objMatriculaNotas->getU1Ev1();
        $u1Ev2 = $objMatriculaNotas->getU1Ev2();
        $u1Ev3 = $objMatriculaNotas->getU1Ev3();
        $u1Ev4 = $objMatriculaNotas->getU1Ev4();
        $u1PromPract = $objMatriculaNotas->getU1PromPract();
        $u1ExParcial = $objMatriculaNotas->getU1ExParcial();
        $u1Promedio = $objMatriculaNotas->getU1Promedio();
        $u2Ev1 = $objMatriculaNotas->getU2Ev1();
        $u2Ev2 = $objMatriculaNotas->getU2Ev2();
        $u2Ev3 = $objMatriculaNotas->getU2Ev3();
        $u2Ev4 = $objMatriculaNotas->getU2Ev4();
        $u2PromPract = $objMatriculaNotas->getU2PromPract();
        $u2Trabajo = $objMatriculaNotas->getU2Trabajo();
        $u2ExFinal = $objMatriculaNotas->getU2ExFinal();
        $u2Promedio = $objMatriculaNotas->getU2Promedio();
        $susti = $objMatriculaNotas->getSusti();
        $promedioFinal = $objMatriculaNotas->getPromedioFinal();
        $idMatriculaDetalle = $objMatriculaNotas->getIdMatriculaDetalle();
        $indicador = $objMatriculaNotas->getIndicador();

        $this->task->setTables(self::TABLE);
        $this->task->setFields('idMatriculaNotas;mntU1Ev1;mntU1Ev2;mntU1Ev3;mntU1Ev4;mntU1PromPract;mntU1ExParcial;mntU1Promedio;mntU2Ev1;mntU2Ev2;mntU2Ev3;mntU2Ev4;mntU2PromPract;mntU2Trabajo;mntU2ExFinal;mntU2Promedio;mntSusti;mntPromedioFinal;idMatriculaDetalle;mntIndicador');
        $this->task->setValues($u1Ev1 . ';' . $u1Ev2 . ';' . $u1Ev3 . ';' . $u1Ev4 . ';' . $u1PromPract . ';' . $u1ExParcial . ';' . $u1Promedio . ';' . $u2Ev1 . ';' . $u2Ev2 . ';' . $u2Ev3 . ';' . $u2Ev4 . ';' . $u2PromPract . ';' . $u2Trabajo . ';' . $u2ExFinal . ';' . $u2Promedio . ';' . $susti . ';' . $promedioFinal . ';' . $idMatriculaDetalle . ';' . $indicador);
        return $this->task->executeInsert('idMatriculaNotas');
    }

    public function ExecuteUpdate($objMatriculaNotas) {
        $idMatriculaNotas = $objMatriculaNotas->getIdMatriculaNotas();
        $u1Ev1 = $objMatriculaNotas->getU1Ev1();
        $u1Ev2 = $objMatriculaNotas->getU1Ev2();
        $u1Ev3 = $objMatriculaNotas->getU1Ev3();
        $u1Ev4 = $objMatriculaNotas->getU1Ev4();
        $u1PromPract = $objMatriculaNotas->getU1PromPract();
        $u1ExParcial = $objMatriculaNotas->getU1ExParcial();
        $u1Promedio = $objMatriculaNotas->getU1Promedio();
        $u2Ev1 = $objMatriculaNotas->getU2Ev1();
        $u2Ev2 = $objMatriculaNotas->getU2Ev2();
        $u2Ev3 = $objMatriculaNotas->getU2Ev3();
        $u2Ev4 = $objMatriculaNotas->getU2Ev4();
        $u2PromPract = $objMatriculaNotas->getU2PromPract();
        $u2Trabajo = $objMatriculaNotas->getU2Trabajo();
        $u2ExFinal = $objMatriculaNotas->getU2ExFinal();
        $u2Promedio = $objMatriculaNotas->getU2Promedio();
        $susti = $objMatriculaNotas->getSusti();
        $promedioFinal = $objMatriculaNotas->getPromedioFinal();
        $idMatriculaDetalle = $objMatriculaNotas->getIdMatriculaDetalle();
        $indicador = $objMatriculaNotas->getIndicador();

        $this->task->setTables(self::TABLE);
        $this->task->setFields('mntU1Ev1;mntU1Ev2;mntU1Ev3;mntU1Ev4;mntU1PromPract;mntU1ExParcial;mntU1Promedio;mntU2Ev1;mntU2Ev2;mntU2Ev3;mntU2Ev4;mntU2PromPract;mntU2Trabajo;mntU2ExFinal;mntU2Promedio;mntSusti;mntPromedioFinal');
        $this->task->setValues($u1Ev1 . ';' . $u1Ev2 . ';' . $u1Ev3 . ';' . $u1Ev4 . ';' . $u1PromPract . ';' . $u1ExParcial . ';' . $u1Promedio . ';' . $u2Ev1 . ';' . $u2Ev2 . ';' . $u2Ev3 . ';' . $u2Ev4 . ';' . $u2PromPract . ';' . $u2Trabajo . ';' . $u2ExFinal . ';' . $u2Promedio . ';' . $susti . ';' . $promedioFinal);
        $this->task->setWhereFields('idMatriculaNotas;idMatriculaDetalle;mntIndicador');
        $this->task->setWhereLogical('=;=;=');
        $this->task->setWhereValues($idMatriculaNotas . ';' . $idMatriculaDetalle . ';' . $indicador);
        return $this->task->executeUpdate();
    }

    public function SearchRatingsStudentsOfSeccionPlanEstudio($objMatriculaNotas, $idCarrera, $idCiclo, $idPlanEstudio, $idTurno, $idSeccion) {
        $indicador = $objMatriculaNotas->getIndicador();
        $this->task->setTables(self::TABLE . ';matriculadetalle;matricula;usuariocarrera;usuario;personal;planestudio;curso;carrera;ciclo;seccion;turno;docenteseccioncurso;usuario;personal');
        $this->task->setFields('idMatriculaNotas;mntU1Ev1;mntU1Ev2;mntU1Ev3;mntU1Ev4;mntU1PromPract;mntU1ExParcial;mntU1Promedio;mntU2Ev1;mntU2Ev2;mntU2Ev3;mntU2Ev4;mntU2PromPract;mntU2Trabajo;mntU2ExFinal;mntU2Promedio;mntSusti;mntPromedioFinal;idMatriculaDetalle;idMatricula;idUsuarioCarrera;idUsuario;idPersonal;prsNombre;prsApellidoPaterno;prsApellidoMaterno;prsDNI;idCarrera;carDescripcion;idCiclo;cloDescripcion;idSeccion;scnDescripcion;idPlanEstudio;crsNombre;idTurno;troDescripcion;idDocenteSeccionCurso;idUsuario as idDocUsuario;idPersonal as idDocPersonal;prsNombre as prsDocNombre;prsApellidoPaterno as prsDocApellidoPaterno;prsApellidoMaterno as prsDocApellidoMaterno;scnInicio;scnFin');
        $this->task->setIndex('0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;1;1;2;3;4;5;5;5;5;6;8;2;9;2;10;1;7;10;11;12;13;13;14;14;14;10;10');
        $this->task->setTypeJoin('inner;inner;inner;inner;inner;inner;inner;inner;inner;inner;inner;inner;inner;inner');
        $this->task->setOnJoin('m0.idMatriculaDetalle=m1.idMatriculaDetalle;m1.idMatricula=m2.idMatricula;m2.idUsuarioCarrera=u3.idUsuarioCarrera;u3.idUsuario=u4.idUsuario;u4.idPersonal=p5.idPersonal;m1.idPlanEstudio=p6.idPlanEstudio;p6.idCurso=c7.idCurso;p6.idCarrera=c8.idCarrera;m2.idCiclo=c9.idCiclo;m2.idSeccion=s10.idSeccion;s10.idTurno=t11.idTurno;s10.idSeccion=d12.idSeccion;d12.idUsuario=u13.idUsuario;u13.idPersonal=p14.idPersonal');
        $this->task->setWhereFields('u3.idCarrera;m2.idCiclo;m1.idPlanEstudio;s10.idTurno;m2.idSeccion;m2.mtcIndicador;m1.mtdIndicador;m0.mntIndicador');
        $this->task->setWhereLogical('=;=;=;=;=;=;=;=');
        $this->task->setWhereValues($idCarrera . ';' . $idCiclo . ';' . $idPlanEstudio . ';' . $idTurno . ';' . $idSeccion . ';1;1;1');
        $this->task->setGroup('m0.idMatriculaNotas');
        $this->task->setOrder('CONCAT(p5.prsApellidoPaterno,p5.prsApellidoMaterno,p5.prsNombre)');
        $this->task->setValuesOrder('asc');
        return $this->task->executeMultiSelect();
    }

}
