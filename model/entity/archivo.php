<?php

class Archivo {

    private $idArchivo;
    private $tipo;
    private $tipoDesc;
    private $fileName;
    private $fileUrl;
    private $fileSize;
    private $fileType;
    private $fileDelete;
    private $idUsuarioCarrera;
    private $indicador;

    function getIdArchivo() {
        return $this->idArchivo;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getTipoDesc() {
        return $this->tipoDesc;
    }

    function getFileName() {
        return $this->fileName;
    }

    function getFileUrl() {
        return $this->fileUrl;
    }

    function getFileSize() {
        return $this->fileSize;
    }

    function getFileType() {
        return $this->fileType;
    }

    function getFileDelete() {
        return $this->fileDelete;
    }

    function getIdUsuarioCarrera() {
        return $this->idUsuarioCarrera;
    }

    function getIndicador() {
        return $this->indicador;
    }

    function setIdArchivo($idArchivo) {
        $this->idArchivo = $idArchivo;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setTipoDesc($tipoDesc) {
        $this->tipoDesc = $tipoDesc;
    }

    function setFileName($fileName) {
        $this->fileName = $fileName;
    }

    function setFileUrl($fileUrl) {
        $this->fileUrl = $fileUrl;
    }

    function setFileSize($fileSize) {
        $this->fileSize = $fileSize;
    }

    function setFileType($fileType) {
        $this->fileType = $fileType;
    }

    function setFileDelete($fileDelete) {
        $this->fileDelete = $fileDelete;
    }

    function setIdUsuarioCarrera($idUsuarioCarrera) {
        $this->idUsuarioCarrera = $idUsuarioCarrera;
    }

    function setIndicador($indicador) {
        $this->indicador = $indicador;
    }

}
