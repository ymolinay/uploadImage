<?php

//genera los archivos de errores
class Log {

    //ubicación de logs
    const fileSystem = 'logs/LOG_ERROR_SYSTEM.log';
    const fileUser = 'logs/LOG_ERROR_USER.log';

    //
    private $message;
    private $file;
    private $directory;
    private $type;

    //
    public function setMessage($_message) {
        $this->message = $_message;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setFile($_file) {
        $this->file = $_file;
    }

    public function getFile() {
        return $this->file;
    }

    public function setDirectory($_directory) {
        $this->directory = $_directory;
    }

    public function getDirectory() {
        return $this->directory;
    }

    public function setType($_type) {
        $this->type = $_type;
    }

    public function getType() {
        return $this->type;
    }

    //almacenar un error en un log
    public function setError($log) {
        $date = date('d.m.Y h:i:s');
        if ($log->getType() == 'server') {
            $bug = 'Archivo: ' . $log->getFile() . chr(9) . 'Error ' . $log->getMessage() . chr(9) . "Tiempo: " . $date . chr(13) . chr(10);
            error_log($bug, 3, $log->getDirectory() . self::fileSystem);
        } elseif ($log->getType() == 'user') {
            $ip = $_SERVER['REMOTE_ADDR'];
            $bug = "Archivo: " . $log->getFile() . chr(9) . "Error " . $log->getMessage() . chr(9) . "IP: " . $ip . chr(9) . "Tiempo: " . $date . chr(13) . chr(10);
            error_log($bug, 3, $log->getDirectory() . self::fileUser);
        }
    }

}
