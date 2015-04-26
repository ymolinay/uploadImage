<?php

session_start();
require_once __DIR__ . '/../model/dao/matriculaNotasDAO.php';
require_once __DIR__ . '/../model/dao/seccionDAO.php';
require_once __DIR__ . '/../model/dao/gridDAO.php';

$objMatriculaNotasDAO = new MatriculaNotasDAO();
$objSeccionDAO = new SeccionDAO();
$objGridDAO = new GridDAO();

$action = $_GET["action"];

if ($action == 'SearchRatingsStudentsOfSeccionPlanEstudio') {
    $json = false;
    $jsonResult = false;
    $idCarrera = $_GET['_idCar'];
    $idCiclo = $_GET['_idCic'];
    $idPlanEstudio = $_GET['_idPla'];
    $idTurno = $_GET['_idTur'];
    $idSeccion = $_GET['_idSec'];
    if ($idCarrera != '' && $idCiclo != '' && $idPlanEstudio != '' & $idTurno != '' && $idSeccion != '') {

        if (true) {
            $objMatriculaNotasDAO->objMatriculaNotas->setIndicador('1');
            $json = $objMatriculaNotasDAO->SearchRatingsStudentsOfSeccionPlanEstudio($objMatriculaNotasDAO->objMatriculaNotas, $idCarrera, $idCiclo, $idPlanEstudio, $idTurno, $idSeccion);
        }
        if ($json !== false) {
            $jsonResult = new stdClass();
            foreach ($json as $key => $val) {
                $jsonResult->idCarrera = $val->idCarrera;
                $jsonResult->Carrera = $val->carDescripcion;
                $jsonResult->idCiclo = $val->idCiclo;
                $jsonResult->Ciclo = $val->cloDescripcion;
                $jsonResult->idPlanEstudio = $val->idPlanEstudio;
                $jsonResult->Curso = $val->crsNombre;
                $jsonResult->idTurno = $val->idTurno;
                $jsonResult->Turno = $val->troDescripcion;
                $jsonResult->idSeccion = $val->idSeccion;
                $jsonResult->Seccion = $val->scnDescripcion;
                $jsonResult->scnInicio = $val->scnInicio;
                $jsonResult->scnFin = $val->scnFin;
                $jsonResult->idDocenteSeccionCurso = $val->idDocenteSeccionCurso;
                $jsonResult->idPDocente = $val->idDocPersonal;
                $jsonResult->DocenteNombre = $val->prsDocNombre;
                $jsonResult->DocenteApellidoPaterno = $val->prsDocApellidoPaterno;
                $jsonResult->DocenteApellidoMaterno = $val->prsDocApellidoMaterno;
                $jsonResult->rows[$key]['idMatriculaNotas'] = $val->idMatriculaNotas;
                $jsonResult->rows[$key]['mntU1Ev1'] = $val->mntU1Ev1;
                $jsonResult->rows[$key]['mntU1Ev2'] = $val->mntU1Ev2;
                $jsonResult->rows[$key]['mntU1Ev3'] = $val->mntU1Ev3;
                $jsonResult->rows[$key]['mntU1Ev4'] = $val->mntU1Ev4;
                $jsonResult->rows[$key]['mntU1PromPract'] = $val->mntU1PromPract;
                $jsonResult->rows[$key]['mntU1ExParcial'] = $val->mntU1ExParcial;
                $jsonResult->rows[$key]['mntU1Promedio'] = $val->mntU1Promedio;
                $jsonResult->rows[$key]['mntU2Ev1'] = $val->mntU2Ev1;
                $jsonResult->rows[$key]['mntU2Ev2'] = $val->mntU2Ev2;
                $jsonResult->rows[$key]['mntU2Ev3'] = $val->mntU2Ev3;
                $jsonResult->rows[$key]['mntU2Ev4'] = $val->mntU2Ev4;
                $jsonResult->rows[$key]['mntU2PromPract'] = $val->mntU2PromPract;
                $jsonResult->rows[$key]['mntU2Trabajo'] = $val->mntU2Trabajo;
                $jsonResult->rows[$key]['mntU2ExFinal'] = $val->mntU2ExFinal;
                $jsonResult->rows[$key]['mntU2Promedio'] = $val->mntU2Promedio;
                $jsonResult->rows[$key]['mntSusti'] = $val->mntSusti;
                $jsonResult->rows[$key]['mntPromedioFinal'] = $val->mntPromedioFinal;
                $jsonResult->rows[$key]['idMatriculaDetalle'] = $val->idMatriculaDetalle;
                $jsonResult->rows[$key]['idMatricula'] = $val->idMatricula;
                $jsonResult->rows[$key]['idUsuarioCarrera'] = $val->idUsuarioCarrera;
                $jsonResult->rows[$key]['idUsuario'] = $val->idUsuario;
                $jsonResult->rows[$key]['idPersonal'] = $val->idPersonal;
                $jsonResult->rows[$key]['prsNombre'] = $val->prsNombre;
                $jsonResult->rows[$key]['prsApellidoPaterno'] = $val->prsApellidoPaterno;
                $jsonResult->rows[$key]['prsApellidoMaterno'] = $val->prsApellidoMaterno;
                $jsonResult->rows[$key]['prsDNI'] = $val->prsDNI;
            }
        }
    }
    echo json_encode($jsonResult);
}

if ($action == 'saveRatingsStudents') {
    $error = TRUE;
    $idINCarrera = $_POST['idINCarrera'];
    $idINCiclo = $_POST['idINCiclo'];
    $idINPlanEstudio = $_POST['idINPlanEstudio'];
    $idINDocente = $_POST['idINDocente'];
    $idINSeccion = $_POST['idINSeccion'];
    $idINTurno = $_POST['idINTurno'];

    if ($idINCarrera != '' && $idINCiclo != '' && $idINPlanEstudio != '' & $idINTurno != '' && $idINSeccion != '') {
        $currentDate = date('Y-m-d');
        $objSeccionDAO->objSeccion->setIdSeccion($idINSeccion);
        $seccion = $objSeccionDAO->SearchSeccion($objSeccionDAO->objSeccion);
        $seccion = $seccion[0];
        $seccionStart = date($seccion->scnInicio);
        $seccionEnd = $seccion->scnFin;
        $currentDate = date($currentDate);
        $seccionStart = date($seccionStart);
        $seccionEnd = date($seccionEnd);

        if ($currentDate >= $seccionStart && $currentDate <= $seccionEnd) {
            $idMatriculaNotas = $_POST['_idMatriculaNotas'];
            $mntU1Ev1 = $_POST['_mntU1Ev1'];
            $mntU1Ev2 = $_POST['_mntU1Ev2'];
            $mntU1Ev3 = $_POST['_mntU1Ev3'];
            $mntU1Ev4 = $_POST['_mntU1Ev4'];
            $mntU1PromPract = $_POST['_mntU1PromPract'];
            $mntU1ExParcial = $_POST['_mntU1ExParcial'];
            $mntU1Promedio = $_POST['_mntU1Promedio'];
            $mntU2Ev1 = $_POST['_mntU2Ev1'];
            $mntU2Ev2 = $_POST['_mntU2Ev2'];
            $mntU2Ev3 = $_POST['_mntU2Ev3'];
            $mntU2Ev4 = $_POST['_mntU2Ev4'];
            $mntU2PromPract = $_POST['_mntU2PromPract'];
            $mntU2Trabajo = $_POST['_mntU2Trabajo'];
            $mntU2ExFinal = $_POST['_mntU2ExFinal'];
            $mntU2Promedio = $_POST['_mntU2Promedio'];
            $mntSusti = $_POST['_mntSusti'];
            $mntPromedioFinal = $_POST['_mntPromedioFinal'];
            $idMatriculaDetalle = $_POST['_idMatriculaDetalle'];
            $indicadorNotas = '1';

            foreach ($idMatriculaNotas as $key => $val) {
                $objMatriculaNotasDAO->objMatriculaNotas->setIdMatriculaNotas($val);
                $objMatriculaNotasDAO->objMatriculaNotas->setU1Ev1($mntU1Ev1[$key]);
                $objMatriculaNotasDAO->objMatriculaNotas->setU1Ev2($mntU1Ev2[$key]);
                $objMatriculaNotasDAO->objMatriculaNotas->setU1Ev3($mntU1Ev3[$key]);
                $objMatriculaNotasDAO->objMatriculaNotas->setU1Ev4($mntU1Ev4[$key]);
                $objMatriculaNotasDAO->objMatriculaNotas->setU1PromPract($mntU1PromPract[$key]);
                $objMatriculaNotasDAO->objMatriculaNotas->setU1ExParcial($mntU1ExParcial[$key]);
                $objMatriculaNotasDAO->objMatriculaNotas->setU1Promedio($mntU1Promedio[$key]);
                $objMatriculaNotasDAO->objMatriculaNotas->setU2Ev1($mntU2Ev1[$key]);
                $objMatriculaNotasDAO->objMatriculaNotas->setU2Ev2($mntU2Ev2[$key]);
                $objMatriculaNotasDAO->objMatriculaNotas->setU2Ev3($mntU2Ev3[$key]);
                $objMatriculaNotasDAO->objMatriculaNotas->setU2Ev4($mntU2Ev4[$key]);
                $objMatriculaNotasDAO->objMatriculaNotas->setU2PromPract($mntU2PromPract[$key]);
                $objMatriculaNotasDAO->objMatriculaNotas->setU2Trabajo($mntU2Trabajo[$key]);
                $objMatriculaNotasDAO->objMatriculaNotas->setU2ExFinal($mntU2ExFinal[$key]);
                $objMatriculaNotasDAO->objMatriculaNotas->setU2Promedio($mntU2Promedio[$key]);
                $objMatriculaNotasDAO->objMatriculaNotas->setSusti($mntSusti[$key]);
                $objMatriculaNotasDAO->objMatriculaNotas->setPromedioFinal($mntPromedioFinal[$key]);
                $objMatriculaNotasDAO->objMatriculaNotas->setIdMatriculaDetalle($idMatriculaDetalle[$key]);
                $objMatriculaNotasDAO->objMatriculaNotas->setIndicador($indicadorNotas[$key]);
                $resultUpdateRatings = $objMatriculaNotasDAO->ExecuteUpdate($objMatriculaNotasDAO->objMatriculaNotas);
            }
            $error = ($resultUpdateRatings === TRUE) ? FALSE : TRUE;
        } else {
            $error = 'outOfRange';
        }
    } else {
        $error = TRUE;
    }

    echo ($error === TRUE) ? 'fail' : (($error === 'outOfRange') ? 'outOfRange' : 'success');
}

if($action=='viewMyRatings'){
    $idCarrera=$_POST['idCarrera'];
    $idEstudiante=$_POST['idUsuarioCarrera'];
    $idMatricula=$_POST['idMatricula'];
}