<?php

session_start();
require_once __DIR__ . '/../model/dao/usuarioCarreraDAO.php';
require_once __DIR__ . '/../model/dao/planEstudioDAO.php';
require_once __DIR__ . '/../model/dao/gridDAO.php';

$objUsuarioCarreraDAO = new UsuarioCarreraDAO();
$objPlanEstudioDAO = new PlanEstudioDAO();
$objGridDAO = new GridDAO();

$action = $_GET["action"];

if ($action == "save") {
    $error = TRUE;
    $idUsuarioCarrera = $_GET['idUsuarioCarrera'];
    $idCarrera = $_GET['idCarrera'];
    $idUsuario = $_GET['idUsuario'];
    //$idTipoBeneficio = $_GET['idTipoBeneficio'];
    $fecha = date('Y-m-d');
    $hora = date('H:i:s');
    $indicador = '1';

    $objUsuarioCarreraDAO->objUsuarioCarrera->setIdUsuarioCarrera($idUsuarioCarrera);
    $objUsuarioCarreraDAO->objUsuarioCarrera->setIdCarrera($idCarrera);
    $objUsuarioCarreraDAO->objUsuarioCarrera->setIdUsuario($idUsuario);
    //$objUsuarioCarreraDAO->objUsuarioCarrera->setIdTipoBeneficio($idTipoBeneficio);
    $objUsuarioCarreraDAO->objUsuarioCarrera->setFecha($fecha);
    $objUsuarioCarreraDAO->objUsuarioCarrera->setHora($hora);
    $objUsuarioCarreraDAO->objUsuarioCarrera->setIndicador($indicador);

    if ($idUsuarioCarrera != '') {
        $usuarioCarrera = $objUsuarioCarreraDAO->ExecuteUpdate($objUsuarioCarreraDAO->objUsuarioCarrera);
    } else {
        $usuarioCarrera = $objUsuarioCarreraDAO->ExecuteSave($objUsuarioCarreraDAO->objUsuarioCarrera);
    }

    if ($usuarioCarrera[0] !== TRUE) {
        $error = TRUE;
    } else {
        $error = FALSE;
//        $objUsuarioCarreraDAO2 = new UsuarioCarreraDAO();
//        $objUsuarioCarreraDAO2->objUsuarioCarrera->setIdUsuarioCarrera($usuarioCarrera[1]);
//        $objUsuarioCarreraDAO2->objUsuarioCarrera->setIdUsuario($idUsuario);
//        $objUsuarioCarreraDAO2->objUsuarioCarrera->setIdCarrera($idCarrera);
//        $UsuarioCarreraReport = $objUsuarioCarreraDAO2->GeneratePlanEstudioUsuario($objUsuarioCarreraDAO2->objUsuarioCarrera);
//
//        $jsonUsuarioCarrera = new stdClass();
//        $jsonUsuarioCarrera->result = 'success';
//        $jsonUsuarioCarrera->idUsuarioCarrera = $UsuarioCarreraReport[0]->idUsuarioCarrera;
//        $jsonUsuarioCarrera->idCarrera = $UsuarioCarreraReport[0]->idCarrera;
//        $jsonUsuarioCarrera->carDescripcion = $UsuarioCarreraReport[0]->carDescripcion;
//        $jsonUsuarioCarrera->carPeriodos = $UsuarioCarreraReport[0]->carPeriodos;
//        $jsonUsuarioCarrera->idUsuario = $UsuarioCarreraReport[0]->idUsuario;
//        $jsonUsuarioCarrera->usrNombre = $UsuarioCarreraReport[0]->usrNombre;
//        $jsonUsuarioCarrera->usrClave = $UsuarioCarreraReport[0]->usrClave;
//        $jsonUsuarioCarrera->idPersonal = $UsuarioCarreraReport[0]->idPersonal;
//        $jsonUsuarioCarrera->prsNombre = $UsuarioCarreraReport[0]->prsNombre;
//        $jsonUsuarioCarrera->prsApellidoPaterno = $UsuarioCarreraReport[0]->prsApellidoPaterno;
//        $jsonUsuarioCarrera->prsApellidoMaterno = $UsuarioCarreraReport[0]->prsApellidoMaterno;
//        $jsonUsuarioCarrera->prsDNI = $UsuarioCarreraReport[0]->prsDNI;
//        $jsonUsuarioCarrera->prsCorreo = $UsuarioCarreraReport[0]->prsCorreo;
//        $jsonUsuarioCarrera->idTipoBeneficio = $UsuarioCarreraReport[0]->idTipoBeneficio;
//        $jsonUsuarioCarrera->tboDescripcion = $UsuarioCarreraReport[0]->tboDescripcion;
//        $jsonUsuarioCarrera->tboPagoMatricula = $UsuarioCarreraReport[0]->tboPagoMatricula;
//        $jsonUsuarioCarrera->tboPagoMensual = $UsuarioCarreraReport[0]->tboPagoMensual;
//        $jsonUsuarioCarrera->tboDescuentoPorcentaje = $UsuarioCarreraReport[0]->tboDescuentoPorcentaje;
//        $jsonUsuarioCarrera->tboPaMatriculaDesc = $UsuarioCarreraReport[0]->tboPaMatriculaDesc;
//        $jsonUsuarioCarrera->tboPaMensualDesc = $UsuarioCarreraReport[0]->tboPaMensualDesc;
//        $jsonUsuarioCarrera->uocFecha = $UsuarioCarreraReport[0]->uocFecha;
//        $jsonUsuarioCarrera->uocHora = $UsuarioCarreraReport[0]->uocHora;
//        $jsonUsuarioCarrera->cursos = array();
//        foreach ($UsuarioCarreraReport as $key => $val) {
//            $jsonUsuarioCarrera->cursos[] = array("idPlanEstudio" => $val->idPlanEstudio, "idCurso" => $val->idCurso, "crsNombre" => $val->crsNombre, "idCiclo" => $val->idCiclo, "cloDescripcion" => $val->cloDescripcion);
//        }
//        echo json_encode($jsonUsuarioCarrera);
    }
    //echo ($error) ? 'fail' : null;
    echo ($error) ? 'fail' : 'success';
}

if ($action == 'combobox') {
    $cbx = array();
    $combo = array();
    $idCarrera = $_GET['idCarrera'];
    $idCarrera = (!empty($idCarrera)) ? $idCarrera : 'undefined';
    if($idCarrera){
        $objUsuarioCarreraDAO->objUsuarioCarrera->setIdCarrera($idCarrera);
        $combo = $objUsuarioCarreraDAO->ExecuteCompleteCombobox($objUsuarioCarreraDAO->objUsuarioCarrera);
    }
    foreach ($combo as $key => $val) {
        $cbx[$key] = array("idUsuarioCarrera" => $val->idUsuarioCarrera,
            "idUsuario" => $val->idUsuario,
            "prsNombre" => $val->prsNombre,
            "prsApellidoPaterno" => $val->prsApellidoPaterno,
            "prsApellidoMaterno" => $val->prsApellidoMaterno,
            "prsDNI" => $val->prsDNI,
            "idCarrera" => $val->idCarrera,
            "carDescripcion" => $val->carDescripcion);
    }
    echo json_encode($cbx);
}

if ($action == 'VerPlanEstudio') {
    $idUsuarioCarrera = $_GET['idUsuarioCarrera'];
    $idCiclo = $_GET['idCiclo'];

    $objUsuarioCarreraDAO->objUsuarioCarrera->setIdUsuarioCarrera($idUsuarioCarrera);
    $UsuarioCarreraReport = $objUsuarioCarreraDAO->GeneratePlanEstudioUsuarioMatriculaCiclo($objUsuarioCarreraDAO->objUsuarioCarrera, $idCiclo);

    $jsonUsuarioCarrera = new stdClass();
    $jsonUsuarioCarrera->result = 'success';
    $jsonUsuarioCarrera->idUsuarioCarrera = $UsuarioCarreraReport[0]->idUsuarioCarrera;
    $jsonUsuarioCarrera->idCarrera = $UsuarioCarreraReport[0]->idCarrera;
    $jsonUsuarioCarrera->carDescripcion = $UsuarioCarreraReport[0]->carDescripcion;
    $jsonUsuarioCarrera->carPeriodos = $UsuarioCarreraReport[0]->carPeriodos;
    $jsonUsuarioCarrera->idUsuario = $UsuarioCarreraReport[0]->idUsuario;
    $jsonUsuarioCarrera->usrNombre = $UsuarioCarreraReport[0]->usrNombre;
    $jsonUsuarioCarrera->usrClave = $UsuarioCarreraReport[0]->usrClave;
    $jsonUsuarioCarrera->idPersonal = $UsuarioCarreraReport[0]->idPersonal;
    $jsonUsuarioCarrera->prsNombre = $UsuarioCarreraReport[0]->prsNombre;
    $jsonUsuarioCarrera->prsApellidoPaterno = $UsuarioCarreraReport[0]->prsApellidoPaterno;
    $jsonUsuarioCarrera->prsApellidoMaterno = $UsuarioCarreraReport[0]->prsApellidoMaterno;
    $jsonUsuarioCarrera->prsDNI = $UsuarioCarreraReport[0]->prsDNI;
    $jsonUsuarioCarrera->prsCorreo = $UsuarioCarreraReport[0]->prsCorreo;
    $jsonUsuarioCarrera->idTipoBeneficio = $UsuarioCarreraReport[0]->idTipoBeneficio;
    $jsonUsuarioCarrera->tboDescripcion = $UsuarioCarreraReport[0]->tboDescripcion;
    $jsonUsuarioCarrera->tboPagoMatricula = $UsuarioCarreraReport[0]->tboPagoMatricula;
    $jsonUsuarioCarrera->tboPagoMensual = $UsuarioCarreraReport[0]->tboPagoMensual;
    $jsonUsuarioCarrera->tboDescuentoPorcentaje = $UsuarioCarreraReport[0]->tboDescuentoPorcentaje;
    $jsonUsuarioCarrera->tboPaMatriculaDesc = $UsuarioCarreraReport[0]->tboPaMatriculaDesc;
    $jsonUsuarioCarrera->tboPaMensualDesc = $UsuarioCarreraReport[0]->tboPaMensualDesc;
    $jsonUsuarioCarrera->uocFecha = $UsuarioCarreraReport[0]->uocFecha;
    $jsonUsuarioCarrera->uocHora = $UsuarioCarreraReport[0]->uocHora;
    $jsonUsuarioCarrera->cursos = array();
    foreach ($UsuarioCarreraReport as $key => $val) {
        $jsonUsuarioCarrera->cursos[] = array("idPlanEstudio" => $val->idPlanEstudio, "idCurso" => $val->idCurso, "crsNombre" => $val->crsNombre, "idCiclo" => $val->idCiclo, "cloDescripcion" => $val->cloDescripcion);
    }
    echo json_encode($jsonUsuarioCarrera);
}

if($action == 'attachFileSerach'){
    $idUsuarioCarrera = base64_decode($_GET['idUsuarioCarrera']);
    $objUsuarioCarreraDAO->objUsuarioCarrera->setIdUsuarioCarrera($idUsuarioCarrera);
    $personalFile = $objUsuarioCarreraDAO->ExecuteFind($objUsuarioCarreraDAO->objUsuarioCarrera);
    $personalFile = $personalFile[0];
    echo json_encode($personalFile);
}