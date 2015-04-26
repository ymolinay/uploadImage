<?php

require_once __DIR__.'/../config/mysqli.data.php';
require_once __DIR__.'/../entity/recuperarClave.php';

class RecuperarClaveDAO {

    public $objRecuperarClave;
    private $task;

    const TABLE = 'recuperarclave';

    public function __construct() {
        $this->objRecuperarClave = new RecuperarClave();
        $this->task = new Task();
    }

    public function verifyRequest($objRecuperarClave) {
        $code1 = $objRecuperarClave->getCode1();
        $code2 = $objRecuperarClave->getCode2();
        $idPersonal = $objRecuperarClave->getIdPersonal();

        $this->task->setTables(self::TABLE);
        $this->task->setFields('idRecuperarClave');
        $this->task->setWhereFields('code1;code2;idPersonal');
        $this->task->setWhereLogical('=;=;=');
        $this->task->setWhereValues($code1 . ';' . $code2 . ';' . $idPersonal);

        $result = array();
        $result = $this->task->executeSelect();
        
        return count($result);
    }

}
