<?php

require_once __DIR__ . '/../config/mysqli.data.php';
require_once __DIR__ . '/../entity/archivo.php';

class ArchivoDAO {

    public $objArchivo;
    private $task;

    const TABLE = 'archivo';

    public function __construct() {
        $this->objArchivo = new Archivo();
        $this->task = new Task();
    }

    public function ExecuteSave($objArchivo) {
        $idArchivo = $objArchivo->getIdArchivo();
        $tipo = $objArchivo->getTipo();
        $tipoDesc = $objArchivo->getTipoDesc();
        $fileName = $objArchivo->getFileName();
        $fileUrl = $objArchivo->getFileUrl();
        $fileSize = $objArchivo->getFileSize();
        $fileType = $objArchivo->getFileType();
        $fileDelete = $objArchivo->getFileDelete();
        $idUsuarioCarrera = $objArchivo->getIdUsuarioCarrera();
        $indicador = $objArchivo->getIndicador();
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idArchivo;rchTipo;rchTipoDesc;rchFileName;rchFileUrl;rchFileSize;rchFileType;rchFileDelete;idUsuarioCarrera;rchIndicador');
        $this->task->setValues($tipo . ';' . $tipoDesc . ';' . $fileName . ';' . $fileUrl . ';' . $fileSize . ';' . $fileType . ';' . $fileDelete . ';' . $idUsuarioCarrera . ';' . $indicador);
        return $this->task->executeInsert('idArchivo');
    }

}
