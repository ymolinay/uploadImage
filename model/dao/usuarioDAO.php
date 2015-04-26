<?php

require_once __DIR__.'/../config/mysqli.data.php';
require_once __DIR__.'/../entity/usuario.php';

class UsuarioDAO {

    public $objUsuario;
    private $task;

    const TABLE = "usuario";

    public function __construct() {
        $this->objUsuario = new Usuario();
        $this->task = new Task();
    }

    //funcion para validar login
    public function ExecuteLogin($objUsuario) {
        $username = $objUsuario->getNombre();
        $password = $objUsuario->getClave();
        $indicador = $objUsuario->getIndicador();

        $this->task->setTables(self::TABLE . ';perfil;personal');
        $this->task->setFields('idUsuario;usrNombre;idPerfil;prfDescripcion;idPersonal;prsNombre;prsApellidoPaterno;prsApellidoMaterno;prsCorreo');
        $this->task->setIndex('0;0;0;1;0;2;2;2;2');
        $this->task->setTypeJoin('inner;inner');
        $this->task->setOnJoin('u0.idPerfil=p1.idPerfil;u0.idPersonal=p2.idPersonal');
        $this->task->setWhereFields('u0.usrNombre;u0.usrClave;u0.usrIndicador');
        $this->task->setWhereLogical('=;=;=');
        $this->task->setWhereValues($username . ';' . $password . ';' . $indicador);
        return $this->task->executeMultiSelect();
    }

    public function ExecuteSave($objUsuario) {
        $nombre = $objUsuario->getNombre();
        $clave = $objUsuario->getClave();
        $idPerfil = $objUsuario->getIdPerfil();
        $idPersonal = $objUsuario->getIdPersonal();
        $indicador = $objUsuario->getIndicador();

        $this->task->setTables(self::TABLE);
        $this->task->setFields('idUsuario;usrNombre;usrClave;idPersonal;idPerfil;usrIndicador');
        $this->task->setValues($nombre . ';' . $clave . ';' . $idPersonal . ';' . $idPerfil . ';' . $indicador);
        return $this->task->executeInsert('idUsuario');
    }
    
    public function ExecuteUpdate($objUsuario){
        $idUsuario = $objUsuario->getIdUsuario();
        $nombre = $objUsuario->getNombre();
        $clave = $objUsuario->getClave();
        $idPerfil = $objUsuario->getIdPerfil();
        $idPersonal = $objUsuario->getIdPersonal();
        $indicador = $objUsuario->getIndicador();
        
        $this->task->setTables(self::TABLE);
        if($clave == md5('C0ntrasen4') || $clave == ''){
            $this->task->setFields('usrNombre;idPersonal;idPerfil;usrIndicador');
            $this->task->setValues($nombre . ';' . $idPersonal . ';' . $idPerfil . ';' . $indicador);
        } else {
            $this->task->setFields('usrNombre;usrClave;idPersonal;idPerfil;usrIndicador');
            $this->task->setValues($nombre . ';' . $clave . ';' . $idPersonal . ';' . $idPerfil . ';' . $indicador);
        }
        
        $this->task->setWhereFields('idUsuario');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($idUsuario);
        return $this->task->executeUpdate();        
    }
    
    public function ExecuteDelete($objUsuario){
        $idUsuario = $objUsuario->getIdUsuario();
        $this->task->setTables(self::TABLE);
        $this->task->setWhereFields('idUsuario');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($idUsuario);
        
        return $this->task->executeDelete();
    }

    public function ChangePassword($objUsuario) {
        $idUser = $objUsuario->getIdUsuario();
        $username = $objUsuario->getNombre();
        $password = $objUsuario->getClave();

        $this->task->setTables(self::TABLE);
        $this->task->setFields('usrClave');
        $this->task->setValues($password);
        $this->task->setWhereFields('idUsuario;usrNombre');
        $this->task->setWhereLogical('=;=');
        $this->task->setWhereValues($idUser . ';' . $username);
        return $this->task->executeUpdate();
    }

}