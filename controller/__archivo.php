<?php

session_start();
require_once __DIR__ . '/../model/dao/archivoDAO.php';
require_once __DIR__ . '/../model/dao/gridDAO.php';

$objArchivoDAO = new ArchivoDAO();
$objGridDAO = new GridDAO();

$action = $_GET["action"];

if ($action == 'save') {
    $error = TRUE;
    $idArchivo = $_GET['_idArchivo'];
    $tipo = $_GET['_tipo'];
    $tipoDesc = '';
    if ($tipo == 'Foto') {
        $tipoDesc = 'Foto';
    } else if ($tipo == 'CopiaDNI') {
        $tipoDesc = 'Copia de DNI';
    } else if ($tipo == 'PartidaNacimiento') {
        $tipoDesc = 'Partida de Nacimiento';
    } else if ($tipo == 'CertificadoEstudios') {
        $tipoDesc = 'Certificado de Estudios';
    }

    $fileName = $_GET['_fName'];
    $fileUrl = $_GET['_fUrl'];
    $fileUrl = '<a download target=\"_blank\" href=\"' . $fileUrl . '\">Descargar <i class=\"fa fa-download\"></i></a>';
    $fileSize = $_GET['_fSize'];
    $fileType = $_GET['_fType'];
    $fileDelete = $_GET['_fDeleteUrl'];
    $idUsuarioCarrera = $_GET['_id'];
    $indicador = '1';
    $objArchivoDAO->objArchivo->setIdArchivo($idArchivo);
    $objArchivoDAO->objArchivo->setTipo($tipo);
    $objArchivoDAO->objArchivo->setTipoDesc($tipoDesc);
    $objArchivoDAO->objArchivo->setFileName($fileName);
    $objArchivoDAO->objArchivo->setFileUrl($fileUrl);
    $objArchivoDAO->objArchivo->setFileSize($fileSize);
    $objArchivoDAO->objArchivo->setFileType($fileType);
    $objArchivoDAO->objArchivo->setFileDelete($fileDelete);
    $objArchivoDAO->objArchivo->setIdUsuarioCarrera($idUsuarioCarrera);
    $objArchivoDAO->objArchivo->setIndicador($indicador);
    if ($idArchivo != '') {
        /* No se dará */
    } else {
        $uploadArchivo = $objArchivoDAO->ExecuteSave($objArchivoDAO->objArchivo);
    }
    $error = ($uploadArchivo !== TRUE) ? TRUE : FALSE;
    echo ($error) ? 'fail' : 'success';
}