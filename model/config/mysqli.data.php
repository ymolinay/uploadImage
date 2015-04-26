<?php

include_once('config.php');
include_once('log.php');

//genera conexión y ejecución query a BD
class Data {

    private $connection;
    private $objConfig;
    private $objLog;

    function __construct() {
        mysqli_report(MYSQLI_REPORT_STRICT);
        $this->objConfig = new Config;
        $this->objLog = new Log();
        $this->objLog->setFile('mysqli.data.php');
        //las conexiones se ejecutan desde el control
        $this->objLog->setDirectory('../model/config/');
        $this->objLog->setType('server');
        try {
            $this->connection = new mysqli($this->objConfig->host, $this->objConfig->user, $this->objConfig->password, $this->objConfig->dataBase);
            $this->connection->set_charset('utf8');
            $this->connection->connect_errno;
        } catch (exception $e) {
            $this->objLog->setMessage('00002: ' . $e->getMessage());
            $this->objLog->setError($this->objLog);
            return false;
        }
    }

    //genera una clave primaria numérica
    public function getId($_table, $_field) {
        try {
            $sql = 'call spTransaction("SELECT","' . $_table . '","MAX(' . $_field . ')","","","","","","");';
            $result = array();
            $result = $this->connection->query($sql);
            if ($result) {
                while ($row = mysqli_fetch_row($result)) {
                    $value = $row[0];
                }
                $this->connection->next_result();
                $id = abs($value) + 1;
                return $id;
            } else {
                $this->objLog->setMessage('00003: Error al ejecutar la consulta {' . $sql . '}');
                $this->objLog->setError($this->objLog);
                return false;
            }
        } catch (exception $e) {
            $this->objLog->setMessage('00004: ' . $e->getMessage() . ' {' . $sql . '}');
            $this->objLog->setError($this->objLog);
            return false;
        }
    }

    //ejecuta consulta remota, retorna datos de una tabla
    public function mysqlSimpleQuery($sql) {
        try {
            $array = array();
            $result = $this->connection->query($sql) or die("Error");
            while ($obj = mysqli_fetch_object($result)) {
                $array[] = $obj;
            }
            return $array;
        } catch (exception $e) {
            $this->objLog->setMessage('00003: {' . $sql . '} ' . $e->getMessage());
            $this->objLog->setError($this->objLog);
            return false;
        }
    }

    //ejecuta comando, retorna true o false
    public function mysqlSimpleExecute($sql) {
        try {
            $result = $this->connection->query($sql);
            //$result->free();
            //mysqli_free_result($result);
            //$this->connection->next_result();
            //echo $this->connection->error; error que les digo que me bota

            if (!$result) {
                return false;
            } else {
                return true;
            }
        } catch (exception $e) {
            $this->objLog->setMessage('00003: {' . $sql . '} ' . $e->getMessage());
            $this->objLog->setError($this->objLog);
            return false;
        }
    }

}

//procesa tareas para generar consultas
class Task extends Data {

    private $tables;
    private $index;
    private $alias;
    //
    private $fields;
    private $values;
    //
    private $tableJoin;
    private $typeJoin;
    private $onJoin;
    //
    private $whereFields;
    private $whereLogical;
    private $whereValues;
    //
    private $group;
    private $order;
    private $limit;
    private $valuesGroup;
    private $valuesOrder;
    private $beginLimit;
    private $endLimit;
    private $subSQL;

    public function __construct() {
        parent::__construct();
        $this->resetTask();
    }

    //
    public function resetTask() {
        $this->tables = array();
        $this->index = array();
        $this->alias = array();
        $this->fields = array();
        $this->values = array();
        //
        $this->tableJoin = array();
        $this->typeJoin = array();
        $this->onJoin = array();
        //
        $this->whereFields = array();
        $this->whereLogical = array();
        $this->whereValues = array();
        //
        $this->valuesGroup = array();
        $this->valuesOrder = array();
        $this->order = array();
        $this->limit = '';
        $this->group = array();
        $this->beginLimit = '';
        $this->endLimit = '';
        $this->subSQL = array();
    }

    //construir estructura tablas
    public function setTables($_tables) {
        $mTables = explode(';', $_tables);
        $this->tables = $mTables;
        foreach ($mTables as $key => $val) {
            $alias = strtolower(substr($val, 0, 1)) . $key;
            array_push($this->alias, $alias);
        }
    }

    //obtiene un registro de una estructura
    public function getTables($_key = 0) {
        if ($_key === 0) {
            $strTables = $this->tables[0] . " " . $this->alias[0];
        } else if ($_key === 'all') {
            //corregir para select con where anidados
            $strTables = $this->tables;
        } else {
            $strTables = $this->tables[$_key] . " " . $this->alias[$_key];
        }
        return $strTables;
    }

    public function setIndex($_index) {
        $mIndex = explode(';', $_index);
        $this->index = $mIndex;
    }

    public function getIndex() {
        return $this->index;
    }

    public function setAlias($_alias) {
        
    }

    public function getAlias($_key = 0) {
        if ($_key === 'all') {
            return $this->alias;
        } else {
            return $this->alias[$_key];
        }
    }

    //
    public function setFields($_fields) {
        $mFields = explode(';', $_fields);
        $this->fields = $mFields;
    }

    //modificación para incluir update, Se borraron  las funciones que antes 
    //hacian este trabajo. Es decir, se unieron
    public function getFields($_type) {
        switch ($_type) {
            case 'insert': {
                    $strInsert = implode(",", $this->fields);
                    $this->fields = $strInsert;
                    break;
                }
            case 'update': {
                    $mFields = $this->fields;
                    $mValues = $this->values;
                    foreach ($mFields as $key => $val) {
                        if (!empty($mFields[$key])) {
                            $this->fields[$key] = $this->getAlias(0) . "." . $val . " = '" . $mValues[$key] . "'";
                        }
                    }
                    $strUpdate = implode(",", $this->fields);
                    $this->fields = $strUpdate;
                    break;
                }
            case 'select': {
                    $strSelect = $this->getAlias(0) . "." . implode("," . $this->getAlias(0) . ".", $this->fields);
                    $this->fields = $strSelect;
                    break;
                }
            case 'multiSelect': {
                    $mAlias = $this->alias;
                    $mFields = $this->fields;
                    $mIndex = $this->index;
                    foreach ($mFields as $key => $val) {
                        if (!empty($mFields[$key])) {
                            $this->fields[$key] = $this->alias[$this->index[$key]] . "." . $val;
                        }
                    }
                    $strMultiSelect = implode(",", $this->fields);
                    $this->fields = $strMultiSelect;
                    break;
                }
        }
        return $this->fields;
    }

    //
    public function setValues($_values) {
        $mValues = explode(';', $_values);
        $this->values = $mValues;
    }

    //
    public function getValues($_type) {
        switch ($_type) {
            case "insert": {
                    $strInsert = implode("','", $this->values);
                    $this->values = $strInsert;
                    return $this->values;
                }
        }
    }

    public function setTableJoin($_tableJoin) {
        $this->tableJoin = explode(";", $_tableJoin);
    }

    public function setTypeJoin($_typeJoin) {
        $this->typeJoin = explode(";", $_typeJoin);
    }

    public function setOnJoin($_onJoin) {
        $this->onJoin = explode(";", $_onJoin);
    }

    public function getTableJoin() {
        return $this->tableJoin;
    }

    public function getTypeJoin() {
        return $this->typeJoin;
    }

    public function getOnJoin() {
        //$mTableJoin = $this->getTableJoin();
        $mTableJoin = $this->getTables('all');
        $mAliasJoin = $this->getAlias('all');
        $mTypeJoin = $this->getTypeJoin();
        $mOnJoin = $this->onJoin;
        foreach ($mOnJoin as $key => $val) {
            if (!empty($mOnJoin[$key])) {
                $this->onJoin[$key] = $mTypeJoin[$key] . ' join ' . $mTableJoin[$key + 1] . ' ' . $mAliasJoin[$key + 1] . ' on ' . $val;
            }
        }
        $strJoin = implode(" ", $this->onJoin);
        $this->onJoin = $strJoin;
        return $this->onJoin;
    }

    //funciones para generar la consulta where
    public function setWhereFields($_whereFields) {
        $mWhereFields = explode(';', $_whereFields);
        $this->whereFields = $mWhereFields;
    }

    public function setWhereLogical($_whereLogical) {
        $mWhereLogical = explode(';', $_whereLogical);
        $this->whereLogical = $mWhereLogical;
    }

    public function setWhereValues($_whereValues) {
        $mWhereValues = explode(';', $_whereValues);
        $this->whereValues = $mWhereValues;
    }

    public function getWhereLogical() {
        return $this->whereLogical;
    }

    public function getWhereValues() {
        return $this->whereValues;
    }

    //función que devuelve la consulta where
    public function getWhereFields($_type = 'oneTable') {
        $mWhereFields = $this->whereFields;
        $this->whereFields = array();
        $mWhereLogical = $this->getWhereLogical();
        $mWhereValues = $this->getWhereValues();

        switch ($_type) {
            case "oneTable": {
                    foreach ($mWhereFields as $key => $val) {
                        //if (!empty($mWhereValues[$key])) {
                        if (trim($mWhereValues[$key]) !== '') {
                            $this->whereFields[$key] = $this->getAlias(0) . "." . $val . " " . $mWhereLogical[$key] . " '" . $mWhereValues[$key] . "'";
                        }
                    }
                    $strWhere = implode(" and ", $this->whereFields);
                    break;
                }
            case "delete": {
                    foreach ($mWhereFields as $key => $val) {
                        if (!empty($mWhereValues[$key])) {
                            $this->whereFields[$key] = $val . " " . $mWhereLogical[$key] . " '" . $mWhereValues[$key] . "'";
                        }
                    }
                    $strWhere = implode(" and ", $this->whereFields);
                    break;
                }
            case "multiSelect": {
                    foreach ($mWhereFields as $key => $val) {
                        //if (!empty($mWhereValues[$key])) {
                        if (trim($mWhereValues[$key]) !== '') {
                            $this->whereFields[$key] = $val . " " . $mWhereLogical[$key] . " '" . $mWhereValues[$key] . "'";
                        }
                    }
                    $strWhere = implode(" and ", $this->whereFields);
                    break;
                }
        }


        if (!empty($strWhere)) {
            $this->whereFields = " and " . $strWhere;
        } else {
            $this->whereFields = "";
        }
        return $this->whereFields;
    }

    public function setGroup($_group) {
        $mGroup = explode(';', $_group);
        $this->group = $mGroup;
    }

    public function getGroup($_type = 'oneTable') {
        $mGroup = $this->group;
        if (!empty($mGroup)) {
            switch ($_type) {
                case 'oneTable': {
                        $strGroup = $this->getAlias(0) . "." . implode("," . $this->getAlias(0) . ".", $mGroup);
                        break;
                    }
                case 'multiSelect': {
                        $strGroup = implode(",", $mGroup);
                        break;
                    }
            }
        } else {
            $strGroup = '';
        }
        return $strGroup;
    }

    public function setOrder($_order) {
        $mOrder = explode(';', $_order);
        $this->order = $mOrder;
    }

    public function getOrder($_type = 'oneTable') {
        $mOrder = $this->order;
        if (!empty($mOrder)) {
            switch ($_type) {
                case 'oneTable': {
                        $strOrder = $this->getAlias(0) . "." . implode("," . $this->getAlias(0) . ".", $mOrder);
                        break;
                    }
                case 'multiSelect': {
                        $strOrder = implode(",", $mOrder);
                        break;
                    }
            }
            $strOrder = $strOrder . ' ' . $this->getValuesOrder();
        } else {
            $strOrder = '';
        }
        return $strOrder;
    }

    public function getLimit() {
        $mBegin = $this->getBeginLimit();
        $mEnd = $this->getEndLimit();
        if (strlen($mBegin) && strlen($mEnd)) {
            $strLimit = $this->beginLimit . ',' . $this->endLimit;
            $this->limit = $strLimit;
        } else {
            $this->limit = '';
        }
        return $this->limit;
    }

    public function setBeginLimit($_beginLimit) {
        $this->beginLimit = $_beginLimit;
    }

    public function getBeginLimit() {
        return $this->beginLimit;
    }

    public function setEndLimit($_endLimit) {
        $this->endLimit = $_endLimit;
    }

    public function getEndLimit() {
        return $this->endLimit;
    }

    public function setValuesOrder($_valuesOrder) {
        $this->valuesOrder = $_valuesOrder;
    }

    public function getValuesOrder() {
        return $this->valuesOrder;
    }

    public function setSubSQL($_subSQL) {
        $mSubSQL = explode(";", $_subSQL);
        $this->subSQL = $mSubSQL;
    }

    public function getSubSQL() {
        $mSubSQL = $this->subSQL;
        $strSubSQL = '';
        if (!empty($mSubSQL)) {
            $strSubSQL = ' and ' . implode(' and ', $mSubSQL);
        }
        $this->subSQL = $strSubSQL;
        return $this->subSQL;
    }

    //
    public function executeInsert($_fieldId) {
        $mTable = explode(" ", $this->getTables());
        $table = $mTable[0];
        $fields = $this->getFields('insert');
        $values = "'" . $this->getId($table, $_fieldId) . "','" . $this->getValues("insert") . "'";
        $sqlExecute = 'call spTransaction("INSERT","' . $table . '","' . $fields . '","' . $values . '","","","","","");';
        return $this->mysqlSimpleExecute($sqlExecute);
    }

    //
    public function executeDelete() {
        $mTable = explode(" ", $this->getTables());
        $table = $mTable[0];
        $where = $this->getWhereFields('delete');
        $sqlExecute = 'call spTransaction("DELETE","' . $table . '","","","","' . $where . '","","","");';
        return $this->mysqlSimpleExecute($sqlExecute);
    }

    //
    public function executeUpdate() {
        $table = $this->getTables();
        $update = $this->getFields('update');
        $where = $this->getWhereFields();
        $subSQL = $this->getSubSQL();

        $sqlExecute = 'call spTransaction("UPDATE","' . $table . '","","' . $update . '","","' . $where . $subSQL . '","","","");';
        return $this->mysqlSimpleExecute($sqlExecute);
    }

    //
    public function executeSelect() {
        $table = $this->getTables();
        $fields = $this->getFields('select');
        $where = $this->getWhereFields();
        $subSQL = $this->getSubSQL();
        $group = $this->getGroup();
        $order = $this->getOrder();
        $limit = $this->getLimit();

        $sqlExecute = 'call spTransaction("SELECT","' . $table . '","' . $fields . '","","","' . $where . $subSQL . '","' . $order . '","' . $limit . '","' . $group . '");';
        $res = $this->mysqlSimpleQuery($sqlExecute);
        return $res;
    }

    public function executeMultiSelect() {
        $table = $this->getTables();
        $fields = $this->getFields('multiSelect');
        $join = $this->getOnJoin();
        $where = $this->getWhereFields('multiSelect');
        $subSQL = $this->getSubSQL();
        $group = $this->getGroup('multiSelect');
        $order = $this->getOrder('multiSelect');
        $limit = $this->getLimit();

//        if(!strpos($fields, 'COUNT')){
//            echo $sqlExecute = 'call spTransaction("MULTISELECT","' . $table . '","' . $fields . '","","' . $join . '","' . $where . $subSQL . '","' . $order . '","' . $limit . '","' . $group . '");';
//        }
        $sqlExecute = 'call spTransaction("MULTISELECT","' . $table . '","' . $fields . '","","' . $join . '","' . $where . $subSQL . '","' . $order . '","' . $limit . '","' . $group . '");';
        return $this->mysqlSimpleQuery($sqlExecute);
    }

}

/* * **********************************
 * ***********************************
 * ********************************** */
//
//echo('<br>actualizar: ');
//$objPrueba = new Task();
//$objPrueba->setTables('cuenta');
//$objPrueba->setFields('direccion;nombreComercial');
//$objPrueba->setValues("Av Arequipa Cdra 4341 - Miraflores;911 IT Group");
//$objPrueba->setWhereFields('idCuenta');
//$objPrueba->setWhereLogical('=');
//$objPrueba->setWhereValues("2");
///* Campos no obligatorios */
//$objPrueba->setSubSQL("c0.indicador='1';c0.ruc='12332112332'");
//echo $objPrueba->executeUpdate();
//
///************************************
// ************************************
// ************************************/
//
//echo('<br>insertar: ');
//$objPrueba = new Task();
//$objPrueba->setTables('cuenta');
//$objPrueba->setFields('idCuenta;razonSocial;nombreComercial;direccion;ruc;telefono;indicador');
//$objPrueba->setValues("911tg;911 itg sac;av arequipa;123321123321;1234567;1");
//echo $objPrueba->executeInsert('idCuenta');
//
///************************************
// ************************************
// ************************************/
//
//echo('<br>eliminar: ');
//$objPrueba = new Task();
//$objPrueba->setTables('cuenta');
//$objPrueba->setWhereFields("idCuenta");
//$objPrueba->setWhereLogical("=");
//$objPrueba->setWhereValues("2");
//echo $objPrueba->executeDelete();
//
///************************************
// ************************************
// ************************************/
//
//echo('<br>seleccionar: <br>');
//$objPrueba = new Task();
//$objPrueba->setTables('cuenta');
//$objPrueba->setFields('idCuenta;razonSocial;nombreComercial;direccion;ruc;telefono;indicador');
///* Campos no obligatorios */
//$objPrueba->setWhereFields('idCuenta');
//$objPrueba->setWhereLogical('=');
//$objPrueba->setWhereValues('1');
//$objPrueba->setSubSQL("c0.indicador='1';c0.telefono<>''");
//$objPrueba->setGroup('idCuenta');
//$objPrueba->setOrder('idCuenta');
//$objPrueba->setValuesOrder('asc');
//$objPrueba->setBeginLimit('0');
//$objPrueba->setEndLimit('15');
//$res = $objPrueba->executeSelect();
//
//foreach ($res as $key => $val) {
//    echo $val->idCuenta . ' | ' . $val->razonSocial . ' | ' . $val->nombreComercial . ' | ' . $val->direccion . ' | ' . $val->ruc . ' | ' . $val->telefono . ' | ' . $val->indicador . '<br>';
//}
//
///************************************
// ************************************
// ************************************/
// 
//echo('<br>Seleccionar: ');
//$objPrueba = new Task();
//$objPrueba->setTables('usuario;perfil;personal');
//$objPrueba->setFields('idUsuario;nombre;idPerfil;descripcion;idPersonal;nombres;apellidos;email');
//$objPrueba->setIndex('0;0;0;1;0;2;2;2');
//$objPrueba->setTypeJoin('inner;inner');
//$objPrueba->setOnJoin('u0.idPerfil=p1.idPerfil;u0.idPersonal=p2.idPersonal');
//$objPrueba->setWhereFields('u0.nombre;p1.indicador');
//$objPrueba->setWhereLogical('=;=');
//$objPrueba->setWhereValues('ymolina;1');
//$objPrueba->setSubSQL("p1.indicador='1'");
//$objPrueba->setGroup('u0.idUsuario');
//$objPrueba->setOrder('u0.idUsuario');
//$objPrueba->setValuesOrder('asc');
//$objPrueba->setBeginLimit('0');
//$objPrueba->setEndLimit('15');
//$res = $objPrueba->executeMultiSelect();
//foreach ($res as $key => $val) {
//    echo $val->idUsuario . ' | ' . $val->nombre . ' | ' . $val->idPerfil . ' | ' . $val->descripcion . ' | ' . $val->idPersonal . ' | ' . $val->nombres . ' | ' . $val->apellidos . ' | ' . $val->email . '<br>';
//}


//echo('<br>seleccionar: <br>');
//$objPrueba = new Task();
//$objPrueba->setTables('cuenta');
//$objPrueba->setFields('idCuenta,COUNT(*) as count');
///* Campos no obligatorios */
//$res = $objPrueba->executeSelect();
//
//foreach ($res as $key => $val) {
//    echo $val->idCuenta . ' | ' . $val->count . '<br>';
//}