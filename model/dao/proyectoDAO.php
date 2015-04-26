<?php

require_once __DIR__.'/../config/mysqli.data.php';
require_once __DIR__.'/../entity/proyecto.php';

class ProyectoDAO {

    public $objProyecto;
    private $task;

    const TABLE = 'proyecto';

    public function __construct() {
        $this->objProyecto = new Proyecto();
        $this->task = new Task();
    }

    public function GenerateProjectCode() {
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idProyecto');
        $this->task->setOrder('idProyecto');
        $this->task->setValuesOrder('asc');

        $result = array();
        $result = $this->task->executeSelect();

        return count($result);
    }

    public function ExecuteSave($objProyecto) {
        $idProyecto = $objProyecto->getIdProyecto();
        $codigo = $objProyecto->getCodigo();
        $nombre = $objProyecto->getNombre();
        $fechaIni = $objProyecto->getFechaIni();
        $fechaFin = $objProyecto->getFechaFin();
        $idJefeProyecto = $objProyecto->getJefeProyecto();
        $idSupervisor = $objProyecto->getSupervisorProyecto();
        $idAsistenteProyecto = $objProyecto->getAsistenteProyecto();
        $idCategoriaProyecto = $objProyecto->getIdCategoriaProyecto();
        $idCuenta = $objProyecto->getIdCuenta();
        $idEstadoProyecto = $objProyecto->getIdEstadoProyecto();
        $observacion = $objProyecto->getObservacion();
        $indicador = $objProyecto->getIndicador();

        $this->task->setTables(self::TABLE);
        $this->task->setFields('idProyecto;codigo;nombre;fechaIni;fechaFin;jefeProyecto;supervisorProyecto;asistenteProyecto;idCategoriaProyecto;idCuenta;idEstadoProyecto;observacion;indicador');
        $this->task->setValues($codigo . ';' . $nombre . ';' . $fechaIni . ';' . $fechaFin . ';' . $idJefeProyecto . ';' . $idSupervisor . ';' . $idAsistenteProyecto . ';' . $idCategoriaProyecto . ';' . $idCuenta . ';' . $idEstadoProyecto . ';' . $observacion . ';' . $indicador);
        return $this->task->executeInsert('idProyecto');
    }

    public function ExecuteUpdate($objProyecto) {
        $idProyecto = $objProyecto->getIdProyecto();
        $nombre = $objProyecto->getNombre();
        $fechaIni = $objProyecto->getFechaIni();
        $fechaFin = $objProyecto->getFechaFin();
        $idJefeProyecto = $objProyecto->getJefeProyecto();
        $idSupervisor = $objProyecto->getSupervisorProyecto();
        $idAsistenteProyecto = $objProyecto->getAsistenteProyecto();
        $idCategoriaProyecto = $objProyecto->getIdCategoriaProyecto();
        $idCuenta = $objProyecto->getIdCuenta();
        //$idEstadoProyecto = $objProyecto->getIdEstadoProyecto();
        $observacion = $objProyecto->getObservacion();
        $indicador = $objProyecto->getIndicador();

        $this->task->setTables(self::TABLE);
        $this->task->setFields('nombre;fechaIni;fechaFin;jefeProyecto;supervisorProyecto;asistenteProyecto;idCategoriaProyecto;idCuenta;observacion;indicador');
        $this->task->setValues($nombre . ';' . $fechaIni . ';' . $fechaFin . ';' . $idJefeProyecto . ';' . $idSupervisor . ';' . $idAsistenteProyecto . ';' . $idCategoriaProyecto . ';' . $idCuenta . ';' . $observacion . ';' . $indicador);
        $this->task->setWhereFields('idProyecto');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($idProyecto);
        return $this->task->executeUpdate();
    }

    public function ExecuteCompleteCombobox() {
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idProyecto;nombre;codigo');
        $this->task->setWhereFields('indicador');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues('1');
        $this->task->setOrder('nombre');
        $this->task->setValuesOrder('asc');
        return $this->task->executeSelect();
    }

    public function ExecuteFind($objProyecto) {
        $id = $objProyecto->getIdProyecto();

        $this->task->setTables(self::TABLE . ';usuario;personal;usuario;personal;usuario;personal;categoriaproyecto;cuenta;estadoproyecto');
        $this->task->setFields('idProyecto;codigo;nombre;fechaIni;fechaFin;jefeProyecto;nombre as nombreJefe;idPerfil as perfilJefe;idPersonal as idPersonalJefe;nombres as nombresJefe;apellidos as apellidosJefe;supervisorProyecto;nombre as nombreSupervisor;idPerfil as perfilSupervisor;idPersonal as idPersonalSupervisor;nombres as nombresSupervisor;apellidos as apellidosSupervisor;asistenteProyecto;nombre as nombreAsistente;idPerfil as perfilAsistente;idPersonal as idPersonalAsistente;nombres as nombresAsistente;apellidos as apellidosAsistente;idCategoriaProyecto;descripcionCategoria;idCuenta;nombreComercial;idEstadoProyecto;descripcion;observacion;indicador');
        $this->task->setIndex('0;0;0;0;0;0;1;1;2;2;2;0;3;3;4;4;4;0;5;5;6;6;6;0;7;0;8;0;9;0;0');
        $this->task->setTypeJoin('inner;inner;inner;inner;inner;inner;inner;inner;inner');
        $this->task->setOnJoin('p0.jefeProyecto=u1.idUsuario;u1.idPersonal=p2.idPersonal;p0.supervisorProyecto=u3.idUsuario;u3.idPersonal=p4.idPersonal;p0.asistenteProyecto=u5.idUsuario;u5.idPersonal=p6.idPersonal;p0.idCategoriaProyecto=c7.idCategoriaProyecto;p0.idCuenta=c8.idCuenta;p0.idEstadoProyecto=e9.idEstadoProyecto');
        $this->task->setWhereFields('p0.idProyecto');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($id);

        return $this->task->executeMultiSelect();
    }

}
