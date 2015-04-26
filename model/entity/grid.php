<?php

class Grid {

    private $page;
    private $limit;
    private $sidx;
    private $sord;
    
    private $dbTable;
    private $fields;
    
    private $joinType;
    private $joinOn;
    private $joinIndex;
    
    private $whereFields;
    private $whereLogical;
    private $whereValues;
    
    //private $limit;
    private $orderName;
    private $orderMode;

    public function getPage() {
        return $this->page;
    }

    public function getLimit() {
        return $this->limit;
    }

    public function getSidx() {
        return $this->sidx;
    }

    public function getSord() {
        return $this->sord;
    }

    public function getDbTable() {
        return $this->dbTable;
    }

    public function getFields() {
        return $this->fields;
    }

    public function getJoinType() {
        return $this->joinType;
    }

    public function getJoinOn() {
        return $this->joinOn;
    }

    public function getJoinIndex() {
        return $this->joinIndex;
    }

    public function getWhereFields() {
        return $this->whereFields;
    }

    public function getWhereLogical() {
        return $this->whereLogical;
    }

    public function getWhereValues() {
        return $this->whereValues;
    }

    public function getOrderName() {
        return $this->orderName;
    }

    public function getOrderMode() {
        return $this->orderMode;
    }

    public function setPage($page) {
        $this->page = $page;
    }

    public function setLimit($limit) {
        $this->limit = $limit;
    }

    public function setSidx($sidx) {
        $this->sidx = $sidx;
    }

    public function setSord($sord) {
        $this->sord = $sord;
    }

    public function setDbTable($dbTable) {
        $this->dbTable = $dbTable;
    }

    public function setFields($fields) {
        $this->fields = $fields;
    }

    public function setJoinType($joinType) {
        $this->joinType = $joinType;
    }

    public function setJoinOn($joinOn) {
        $this->joinOn = $joinOn;
    }

    public function setJoinIndex($joinIndex) {
        $this->joinIndex = $joinIndex;
    }

    public function setWhereFields($whereFields) {
        $this->whereFields = $whereFields;
    }

    public function setWhereLogical($whereLogical) {
        $this->whereLogical = $whereLogical;
    }

    public function setWhereValues($whereValues) {
        $this->whereValues = $whereValues;
    }

    public function setOrderName($orderName) {
        $this->orderName = $orderName;
    }

    public function setOrderMode($orderMode) {
        $this->orderMode = $orderMode;
    }


}