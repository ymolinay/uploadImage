<?php
session_start();
require_once __DIR__.'/../model/dao/inscripcionDAO.php';
require_once __DIR__.'/../model/dao/inscripcionMarketingDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';
/*require_once '/../model/config/mail.class.php';*/
$objInscripcionDAO = new InscripcionDAO();
$objInscripcionMarketingDAO = new InscripcionMarketingDAO();
$objGridDAO = new GridDAO();
$action = $_GET['action'];
//$type = base64_decode($_GET['userType']);
if ($action == "save") {
    $error = TRUE;
	$idInscripcion = $_GET['idInscripcion'];
	$insFecha =  date('Y-m-d');
	$insNombres =  $_GET['insNombre'];
	$insApellidoPaterno =  $_GET['insApellidoPaterno'];
	$insApellidoMaterno =  $_GET['insApellidoMaterno'];
	$insDNI =  $_GET['insDNI'];
	$insCorreo =  $_GET['insEmail'];
	$insTelefono = $_GET['insTelefono'];
	$insDireccion =  $_GET['insDireccion'];
	$insSexo =  $_GET['insSexo'];
	$insEstadoCivil =  $_GET['insEstadocivil'];
	$insFNacimiento =  date("Y-m-d", strtotime($_GET['FNacimiento']));
	$insNacionalidad =  $_GET['insNacionalidad'];
	$insCondicion =  1;
	$idUbigeo =  $_GET['idUbigeo'];
	$idCarrera =  $_GET['idCarrera'];
	$insIndicador =  1;
	//
	$idInscripcionMarketing =  $_GET['idInscripcionMarketing'];
	$insObservacion =  $_GET['insObservacion'];
	$idMarketing =  $_GET['marRespuesta'];
	//	
    $objInscripcionDAO->objInscripcion->setIdInscripcion($idInscripcion);
    $objInscripcionDAO->objInscripcion->setInsFecha($insFecha);
    $objInscripcionDAO->objInscripcion->setInsNombres($insNombres);
    $objInscripcionDAO->objInscripcion->setInsApellidoPaterno($insApellidoPaterno);
    $objInscripcionDAO->objInscripcion->setInsDNI($insDNI);
    $objInscripcionDAO->objInscripcion->setInsCorreo($insCorreo);
    $objInscripcionDAO->objInscripcion->setInsTelefono($insTelefono);
    $objInscripcionDAO->objInscripcion->setInsDireccion($insDireccion);
    $objInscripcionDAO->objInscripcion->setInsSexo($insSexo);
    $objInscripcionDAO->objInscripcion->setInsEstadoCivil($insEstadoCivil);
    $objInscripcionDAO->objInscripcion->setInsFNacimiento($insFNacimiento);
    $objInscripcionDAO->objInscripcion->setInsNacionalidad($insNacionalidad);
    $objInscripcionDAO->objInscripcion->setInsCondicion($insCondicion);
    $objInscripcionDAO->objInscripcion->setIdUbigeo($idUbigeo);
    $objInscripcionDAO->objInscripcion->setIdCarrera($idCarrera);
    $objInscripcionDAO->objInscripcion->setInsIndicador($insIndicador);
	//
    $objInscripcionMarketingDAO->objInscripcionMarketing->setIdInscripcion($idInscripcion);
	$objInscripcionMarketingDAO->objInscripcionMarketing->setInsObservacion($insObservacion);
    $objInscripcionMarketingDAO->objInscripcionMarketing->setIdMarketing($idMarketing);
    /*if ($idInscripcion != '') {
        $inscripcion = $objInscripcionDAO->ExecuteUpdate($objInscripcionDAO->objInscripcion);
    }else {*/
    $inscripcion = $objInscripcionDAO->ExecuteSave($objInscripcionDAO->objInscripcion);
	//echo $inscripcion[1];
    /*}*/
    if ($inscripcion[0] !== true) {
        $error = TRUE;
		echo "error";
    } else {
        $idInscripcion = $inscripcion[1];
		$_SESSION['sessionIdInscripcion'] = $idInscripcion;
        $objInscripcionMarketingDAO->objInscripcionMarketing->setIdInscripcion($idInscripcion);
        /* if ($idInscripcionMarketing != '') {
           $usuario = $objUsuarioDAO->ExecuteUpdate($objUsuarioDAO->objUsuario);
        } else {*/
       	$inscripcionMarketing = $objInscripcionMarketingDAO->ExecuteSave($objInscripcionMarketingDAO->objInscripcionMarketing);
        //}
        //validando resultado
        if ($inscripcionMarketing !==true) {
            $error = TRUE;
        } else {
            $error = FALSE;
        }
    }
    echo ($error) ? 'fail': 'success';
}

if ($action == "print") {
	$idInscripcion = $_SESSION['sessionIdInscripcion'];
	echo $idInscripcion;
}

if ($action == "searchData") {
    $inscripcion = FALSE;
    $idInscripcion = $_GET['id'];
    $idInscripcion = (!empty($idInscripcion) && is_numeric($idInscripcion)) ? $idInscripcion : FALSE;
    if($idInscripcion){
        $objInscripcionDAO->objInscripcion->setIdInscripcion($idInscripcion);
        $inscripcion = $objInscripcionDAO->ExecuteSearch($objInscripcionDAO->objInscripcion);
        $inscripcion = $inscripcion[0];
    }    
    echo json_encode($inscripcion);
}