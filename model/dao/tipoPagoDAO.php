<?php

require_once __DIR__ . '/../config/mysqli.data.php';
require_once __DIR__ . '/../entity/tipoPago.php';

class TipoPagoDAO {

    public $objTipoPago;
    private $task;

    const TABLE = 'tipopago';

    public function __construct() {
        $this->objTipoPago = new TipoPago();
        $this->task = new Task();
    }

    public function ExecuteSave($objTipoPago) {
        $idTipoPago = $this->task->getId(self::TABLE, 'idTipoPago');
        $Descripcion = $objTipoPago->getDescripcion();
        $Monto = $objTipoPago->getMonto();
        $Indicador = $objTipoPago->getIndicador();
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idTipoPago;tppDescripcion;tppMonto;tppIndicador');
        $this->task->setValues($Descripcion . ';' . $Monto . ';' . $Indicador);
        $result[0] = $this->task->executeInsert('idTipoPago');
        $result[1] = $idTipoPago;
        return $result;
    }

    public function ExecuteUpdate($objTipoPago) {
        $idTipoPago = $objTipoPago->getIdTipoPago();
        $idSede = $objTipoPago->getIdSede();
        $idTipoBeneficio = $objTipoPago->getIdTipoBeneficio();
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idSede;idTipoBeneficio');
        $this->task->setValues($idSede . ';' . $idTipoBeneficio);
        $this->task->setWhereFields('idTipoPago');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($idTipoPago);
        $result[0] = $this->task->executeUpdate();
        $result[1] = $idTipoPago;
        return $result;
    }

    public function ExecuteDelete($objTipoPago) {
        $idTipoPago = $objTipoPago->getIdTipoPago();
        $this->task->setTables(self::TABLE);
        $this->task->setFields('tppIndicador');
        $this->task->setValues('0');
        $this->task->setWhereFields('idTipoPago');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($idTipoPago);
        $result = $this->task->executeUpdate();
        return $result;
    }

    public function DuplicateTipoPago($objTipoPago) {
        $idCiclo = $objTipoPago->getIdCiclo();
        $idUsuarioCarrera = $objTipoPago->getIdUsuarioCarrera();
        $estadoTipoPago = $objTipoPago->getIdEstadoMatricula();
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idTipoPago;idUsuarioCarrera;idCiclo;idSeccion;idSede');
        $this->task->setWhereFields('idUsuarioCarrera;idCiclo;idEstadoMatricula;tppIndicador');
        $this->task->setWhereLogical('=;=;=;=');
        $this->task->setWhereValues($idUsuarioCarrera . ';' . $idCiclo . ';' . $estadoMatricula . ';1');
        return $this->task->executeSelect();
    }

    public function CountPago($objTipoPago) {
        $idMatricula = $objTipoPago->getIdMatricula();
        $this->task->setTables(self::TABLE . ';matricula;usuariocarrera;carrera');
        $this->task->setFields('carMeses,COUNT(*) as pagos');
        $this->task->setIndex('3;0');
        $this->task->setTypeJoin('inner;inner;inner');
        $this->task->setOnJoin('p0.idMatricula=m1.idMatricula;m1.idUsuarioCarrera=u2.idUsuarioCarrera;u2.idCarrera=c3.idCarrera');
        $this->task->setWhereFields('p0.idMatricula');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($idMatricula);
        return $this->task->executeMultiSelect();
    }

    public function SearchTipoPagoID($objTipoPago) {
        $idTipoPago = $objTipoPago->getIdTipoPago();
        $this->task->setTables(self::TABLE . ';usuariocarrera;seccion');
        $this->task->setFields('idTipoPago;tppFecha;tppHora;idUsuarioCarrera;idCarrera;idUsuario;idCiclo;idSeccion;idTurno;idSede;idTipoBeneficio;idEstadoMatricula;tppIndicador');
        $this->task->setIndex('0;0;0;0;1;1;0;0;2;0;0;0;0');
        $this->task->setTypeJoin('inner;inner');
        $this->task->setOnJoin('m0.idUsuarioCarrera=u1.idUsuarioCarrera;m0.idSeccion=s2.idSeccion');
        $this->task->setWhereFields('m0.idTipoPago');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($idTipoPago);
        $this->task->setBeginLimit('0');
        $this->task->setEndLimit('1');
        return $this->task->executeMultiSelect();
    }

    public function ExecuteCompleteCombobox($objTipoPago) {
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idTipoPago;tppDescripcion;tppMonto');
        $this->task->setIndex('0;0;0');
        $this->task->setOrder('idTipoPago');
        $this->task->setValuesOrder('asc');
        return $this->task->executeMultiSelect();
    }

}
