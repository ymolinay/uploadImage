<?php

require_once __DIR__.'/../config/mysqli.data.php';
require_once __DIR__.'/../entity/grid.php';

class GridDAO {

    public $objGrid;
    private $task;

    public function __construct() {
        $this->objGrid = new Grid();
        $this->task = new Task();
    }

//    public function SearchGrid($type, $table, $objGrid, $objEntity) {
//
//        $page = $objGrid->getPage();
//        $limit = $objGrid->getLimit();
//        $sidx = $objGrid->getSidx();
//        $sord = $objGrid->getSord();
//
//        if ($type == "personalGrid") {
//
//            $this->task->setTables($table);
//            $this->task->setFields('idPersonal,COUNT(*) as count');
//            $res = $this->task->executeSelect();
//            $res = $res[0];
//            $count = $res->count;
//
//            $total_pages = ($count > 0) ? ceil($count / $limit) : 0;
//            if ($page > $total_pages) {
//                $page = $total_pages;
//            }
//
//            $start = $limit * $page - $limit;
//
//            $this->task = new Task();
//
//            $this->task->setTables($table);
//            $this->task->setFields('idPersonal;nombres;apellidos;dni;telefono;email');
//            $this->task->setOrder($sidx);
//            $this->task->setValuesOrder($sord);
//            $this->task->setBeginLimit($start);
//            $this->task->setEndLimit($limit);
//
//            $res2 = $this->task->executeSelect();
//
//            $respuesta = new stdClass();
//            $respuesta->page = $page;
//            $respuesta->total = $total_pages;
//            $respuesta->records = $count;
//
//            foreach ($res2 as $key => $val) {
//                $respuesta->rows[$key]['id'] = $val->idPersonal;
//                $respuesta->rows[$key]['cell'] = array($val->idPersonal, $val->nombres, $val->apellidos, $val->dni, $val->telefono, $val->email);
//            }
//            return $respuesta;
//        }
//    }

    public function LoadGrid($objGrid) {

        $multiSelect = false;

        $dbTable = $objGrid->getDbTable();
        $fields = $objGrid->getFields();

        $joinIndex = $objGrid->getJoinIndex();
        $joinType = $objGrid->getJoinType();
        $joinOn = $objGrid->getJoinOn();

        $whereFields = $objGrid->getWhereFields();
        $whereLogical = $objGrid->getWhereLogical();
        $whereValues = $objGrid->getWhereValues();

        $limit = $objGrid->getLimit();
        $orderName = $objGrid->getOrderName();
        $orderMode = $objGrid->getOrderMode();
        $page = $objGrid->getPage();



        $this->task->setTables($dbTable);
        $this->task->setFields($fields . ',COUNT(*) as count');

        if (strlen($joinIndex) > 0 && strlen($joinType) > 0 && strlen($joinOn) > 0) {
            $this->task->setIndex($joinIndex);
            $this->task->setTypeJoin($joinType);
            $this->task->setOnJoin($joinOn);

            $multiSelect = true;
        }

        if (strlen($whereFields) > 0 && strlen($whereLogical) > 0 && strlen($whereValues) > 0) {
            $this->task->setWhereFields($whereFields);
            $this->task->setWhereLogical($whereLogical);
            $this->task->setWhereValues($whereValues);
        }

        $result = (!$multiSelect) ? $this->task->executeSelect() : $this->task->executeMultiSelect();


        //$result = $this->task->executeSelect();
        $result = $result[0];
        $count = $result->count;


        $totalPages = ($count > 0) ? ceil($count / $limit) : 0;
        if ($page > $totalPages) {
            $page = $totalPages;
        }


        $start = $limit * $page - $limit;
        ///////BUG///////////////////////////////
        ((int)$start < 0) ? $start = 0 : $start;
        /////////////////////////////////////////
        
        $this->task = new Task();

        $this->task->setTables($dbTable);
        $this->task->setFields($fields);

        if (strlen($joinIndex) > 0 && strlen($joinType) > 0 && strlen($joinOn) > 0) {
            $this->task->setIndex($joinIndex);
            $this->task->setTypeJoin($joinType);
            $this->task->setOnJoin($joinOn);

            $multiSelect = true;
        }

        if (strlen($whereFields) > 0 && strlen($whereLogical) > 0 && strlen($whereValues) > 0) {
            $this->task->setWhereFields($whereFields);
            $this->task->setWhereLogical($whereLogical);
            $this->task->setWhereValues($whereValues);
        }

        $this->task->setOrder($orderName);
        $this->task->setValuesOrder($orderMode);
        $this->task->setBeginLimit($start);
        $this->task->setEndLimit($limit);

        $quest = (!$multiSelect) ? $this->task->executeSelect() : $this->task->executeMultiSelect();

        $output = new stdClass();
        $output->page = $page;
        $output->total = $totalPages;
        $output->star = $start;
        $output->end = $start + count($quest);
        $output->records = $count;

        $strFields = explode(';', $fields);

        foreach ($quest as $key => $val) {
            $output->rows[$key]['id'] = $val->$strFields[0];
            $data = array();
            foreach ($strFields as $key2 => $val2) {
                $data[$key2] = $val->$val2;
            }
            $output->rows[$key]['cell'] = $data;
        }
        return $output;
    }

}
