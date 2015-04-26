<?php

require_once __DIR__ . '/../config/mysqli.data.php';
require_once __DIR__ . '/../entity/pagos.php';

class PagosDAO {

    public $objPagos;
    private $task;

    const TABLE = 'pagos';

    public function __construct() {
        $this->objPagos = new Pagos();
        $this->task = new Task();
    }

    public function ExecuteSave($objPagos) {
        $idPagos = $this->task->getId(self::TABLE, 'idPagos');
        $Fecha = $objPagos->getFecha();
        $Hora = $objPagos->getHora();
        $idTipoPago = $objPagos->getIdTipoPago();
        $idModoPago = $objPagos->getIdModoPago();
        $TipoComprobante = $objPagos->getTipoComprobante();
        $NumComprobante = $objPagos->getNumComprobante();
        $Pago = $objPagos->getPago();
        $PagoDesc = $objPagos->getPagoDesc();
        $Beneficio = $objPagos->getBeneficio();
        $idMatricula = $objPagos->getIdMatricula();
        $Indicador = $objPagos->getIndicador();
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idPagos;pgsFecha;pgsHora;idTipoPago;idModoPago;pgsTipoComprobante;pgsNumComprobante;pgsPago;pgsPagoDesc;pgsBeneficio;idMatricula;pgsIndicador');
        $this->task->setValues($Fecha . ';' . $Hora . ';' . $idTipoPago . ';' . $idModoPago . ';' . $TipoComprobante . ';' . $NumComprobante . ';' . $Pago . ';' . $PagoDesc . ';' . $Beneficio . ';' . $idMatricula . ';' . $Indicador);
        $result[0] = $this->task->executeInsert('idPagos');
        $result[1] = $idPagos;
        return $result;
    }

    public function ExecuteUpdate($objPagos) {
        $idPagos = $objPagos->getIdPagos();
        $idSede = $objPagos->getIdSede();
        $idTipoBeneficio = $objPagos->getIdTipoBeneficio();
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idSede;idTipoBeneficio');
        $this->task->setValues($idSede . ';' . $idTipoBeneficio);
        $this->task->setWhereFields('idPagos');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($idPagos);
        $result[0] = $this->task->executeUpdate();
        $result[1] = $idPagos;
        return $result;
    }

    public function ExecuteDelete($objPagos) {
        $idPagos = $objPagos->getIdPagos();
        $this->task->setTables(self::TABLE);
        $this->task->setFields('pgsIndicador');
        $this->task->setValues('0');
        $this->task->setWhereFields('idPagos');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($idPagos);
        $result = $this->task->executeUpdate();
        return $result;
    }

    public function DuplicatePagos($objPagos) {
        $idCiclo = $objPagos->getIdCiclo();
        $idUsuarioCarrera = $objPagos->getIdUsuarioCarrera();
        $estadoPagos = $objPagos->getIdEstadoMatricula();
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idPagos;idUsuarioCarrera;idCiclo;idSeccion;idSede');
        $this->task->setWhereFields('idUsuarioCarrera;idCiclo;idEstadoMatricula;pgsIndicador');
        $this->task->setWhereLogical('=;=;=;=');
        $this->task->setWhereValues($idUsuarioCarrera . ';' . $idCiclo . ';' . $estadoMatricula . ';1');
        return $this->task->executeSelect();
    }

    public function CountPago($objPagos) {
        $idMatricula = $objPagos->getIdMatricula();
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

    public function SearchPagosID($objPagos) {
        $idPagos = $objPagos->getIdPagos();
        $this->task->setTables(self::TABLE . ';usuariocarrera;seccion');
        $this->task->setFields('idPagos;pgsFecha;pgsHora;idUsuarioCarrera;idCarrera;idUsuario;idCiclo;idSeccion;idTurno;idSede;idTipoBeneficio;idEstadoMatricula;pgsIndicador');
        $this->task->setIndex('0;0;0;0;1;1;0;0;2;0;0;0;0');
        $this->task->setTypeJoin('inner;inner');
        $this->task->setOnJoin('m0.idUsuarioCarrera=u1.idUsuarioCarrera;m0.idSeccion=s2.idSeccion');
        $this->task->setWhereFields('m0.idPagos');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($idPagos);
        $this->task->setBeginLimit('0');
        $this->task->setEndLimit('1');
        return $this->task->executeMultiSelect();
    }

    public function ExecuteCompleteCombobox($objPagos) {
        $idUsuarioCarrera = $objPagos->getIdUsuarioCarrera();
        $this->task->setTables(self::TABLE . ';usuariocarrera;tipobeneficio;seccion;sede;estadomatricula;ciclo;turno');
        $this->task->setFields('idPagos;pgsFecha;pgsHora;idUsuarioCarrera;idTipoBeneficio;tboDescripcion;idSeccion;scnDescripcion;idSede;sdeNombre;idEstadoMatricula;etmDescripcion;idCiclo;cloDescripcion;idTurno;troDescripcion');
        $this->task->setIndex('0;0;0;1;0;2;0;3;0;4;0;5;0;6;3;7');
        $this->task->setTypeJoin('inner;inner;inner;inner;inner;inner;inner');
        $this->task->setOnJoin('m0.idUsuarioCarrera=u1.idUsuarioCarrera;m0.idTipoBeneficio=t2.idTipoBeneficio;m0.idSeccion=s3.idSeccion;m0.idSede=s4.idSede;m0.idEstadoMatricula=e5.idEstadoMatricula;m0.idCiclo=c6.idCiclo;s3.idTurno=t7.idTurno');
        $this->task->setWhereFields('m0.idUsuarioCarrera;m0.pgsIndicador;u1.uocIndicador');
        $this->task->setWhereLogical('=;=;=');
        $this->task->setWhereValues($idUsuarioCarrera . ';1;1');
        $this->task->setOrder('m0.idPagos');
        $this->task->setValuesOrder('asc');
        return $this->task->executeMultiSelect();
    }

}
