<?php

require_once __DIR__.'/../config/mysqli.data.php';
require_once __DIR__.'/../entity/inscripcion.php';

class InscripcionDAO {

    public $objInscripcion;
    private $task;

    const TABLE = "inscripcion";

    public function __construct() {
        $this->objInscripcion = new Inscripcion();
        $this->task = new Task();
    }
 public function ExecuteSearch($objInscripcion) {
        
        $idInscripcion = $objInscripcion->getIdInscripcion();
        
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idInscripcion;insFecha;insHora;insNombres;insApellidoPaterno;insApellidoMaterno;insDNI;insCorreo;insTelefono;insDireccion;insSexo;insEstadoCivil;insFNacimiento;insNacionalidad;insCondicion;insIndicador;idUbigeo;idCarrera');
        $this->task->setWhereFields('idInscripcion');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($idInscripcion);
        return $this->task->executeSelect();
    }
	
    public function ExecuteSave($objInscripcion) {
        $idInscripcion = $this->task->getId(self::TABLE, 'idInscripcion');
        $insFecha = $objInscripcion->getInsFecha() ;
        $insNombres = $objInscripcion->getInsNombres();
        $insApellidoPaterno = $objInscripcion->getInsApellidoPaterno();
        $insApellidoMaterno = $objInscripcion->getInsApellidoMaterno();
        $insDNI = $objInscripcion->getInsDNI();
        $insCorreo = $objInscripcion->getInsCorreo();
        $insTelefono = $objInscripcion->getInsTelefono();
        $insDireccion = $objInscripcion->getInsDireccion();
        $insSexo = $objInscripcion->getInsSexo();
        $insEstadoCivil = $objInscripcion->getInsEstadoCivil();
		$insFNacimiento = $objInscripcion->getInsFNacimiento();
        $insNacionalidad = $objInscripcion->getInsNacionalidad();
        $insCondicion = $objInscripcion->getInsCondicion();
        $idUbigeo = $objInscripcion->getIdUbigeo();
        $idCarrera = $objInscripcion->getIdCarrera();
        $insIndicador = $objInscripcion->getInsIndicador();

        $this->task->setTables(self::TABLE);
        $this->task->setFields('idInscripcion;insFecha;insNombres;insApellidoPaterno;'
                . 'insApellidoMaterno;insDNI;insCorreo;insTelefono;'
                . 'insDireccion;insSexo;insEstadoCivil;insFNacimiento;'
                . 'insNacionalidad;insCondicion;idUbigeo;idCarrera;insIndicador');
        $this->task->setValues($insFecha . ';' . $insNombres . ';' . $insApellidoPaterno . ';' . $insApellidoMaterno . ';' . $insDNI
                .';'.$insCorreo.';'.$insTelefono.';'.$insDireccion.';'.$insSexo.';'.$insEstadoCivil.';'.$insFNacimiento.';'.$insNacionalidad.';'.$insCondicion
                .';'.$idUbigeo.';'.$idCarrera.';'.$insIndicador);
        $result[0] = $this->task->executeInsert('idInscripcion');
        $result[1] = $idInscripcion;
		return $result;
    }
    
    /*public function ExecuteUpdate($objUsuario){
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
    }*/
}