<?php

require_once __DIR__ . '/../config/mysqli.data.php';
require_once __DIR__ . '/../entity/modoPago.php';

class ModoPagoDAO {

    public $objModoPago;
    private $task;

    const TABLE = 'modopago';

    public function __construct() {
        $this->objModoPago = new ModoPago();
        $this->task = new Task();
    }

    public function ExecuteSave($objModoPago) {
        $idModoPago = $this->task->getId(self::TABLE, 'idModoPago');
        $Descripcion = $objModoPago->getDescripcion();
        $Indicador = $objModoPago->getIndicador();
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idModoPago;mdpDescripcion;mdpIndicador');
        $this->task->setValues($Descripcion . ';' . $Indicador);
        $result[0] = $this->task->executeInsert('idModoPago');
        $result[1] = $idModoPago;
        return $result;
    }

    public function ExecuteUpdate($objModoPago) {
        $idModoPago = $objModoPago->getIdModoPago();
        $idSede = $objModoPago->getIdSede();
        $idModoBeneficio = $objModoPago->getIdModoBeneficio();
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idSede;idModoBeneficio');
        $this->task->setValues($idSede . ';' . $idModoBeneficio);
        $this->task->setWhereFields('idModoPago');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($idModoPago);
        $result[0] = $this->task->executeUpdate();
        $result[1] = $idModoPago;
        return $result;
    }

    public function ExecuteDelete($objModoPago) {
        $idModoPago = $objModoPago->getIdModoPago();
        $this->task->setTables(self::TABLE);
        $this->task->setFields('tppIndicador');
        $this->task->setValues('0');
        $this->task->setWhereFields('idModoPago');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($idModoPago);
        $result = $this->task->executeUpdate();
        return $result;
    }

    public function DuplicateModoPago($objModoPago) {
        $idCiclo = $objModoPago->getIdCiclo();
        $idUsuarioCarrera = $objModoPago->getIdUsuarioCarrera();
        $estadoModoPago = $objModoPago->getIdEstadoMatricula();
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idModoPago;idUsuarioCarrera;idCiclo;idSeccion;idSede');
        $this->task->setWhereFields('idUsuarioCarrera;idCiclo;idEstadoMatricula;tppIndicador');
        $this->task->setWhereLogical('=;=;=;=');
        $this->task->setWhereValues($idUsuarioCarrera . ';' . $idCiclo . ';' . $estadoMatricula . ';1');
        return $this->task->executeSelect();
    }

    public function CountPago($objModoPago) {
        $idMatricula = $objModoPago->getIdMatricula();
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

    public function SearchModoPagoID($objModoPago) {
        $idModoPago = $objModoPago->getIdModoPago();
        $this->task->setTables(self::TABLE . ';usuariocarrera;seccion');
        $this->task->setFields('idModoPago;tppFecha;tppHora;idUsuarioCarrera;idCarrera;idUsuario;idCiclo;idSeccion;idTurno;idSede;idModoBeneficio;idEstadoMatricula;tppIndicador');
        $this->task->setIndex('0;0;0;0;1;1;0;0;2;0;0;0;0');
        $this->task->setTypeJoin('inner;inner');
        $this->task->setOnJoin('m0.idUsuarioCarrera=u1.idUsuarioCarrera;m0.idSeccion=s2.idSeccion');
        $this->task->setWhereFields('m0.idModoPago');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($idModoPago);
        $this->task->setBeginLimit('0');
        $this->task->setEndLimit('1');
        return $this->task->executeMultiSelect();
    }

    public function ExecuteCompleteCombobox($objModoPago) {
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idModoPago;mdpDescripcion');
        $this->task->setIndex('0;0');
        $this->task->setOrder('idModoPago');
        $this->task->setValuesOrder('asc');
        return $this->task->executeMultiSelect();
    }

}
