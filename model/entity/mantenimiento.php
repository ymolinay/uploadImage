<?php

class Mantenimiento {

    private $field;
    private $table;
    private $search;
    private $fieldId;
    private $id;

    public function getField() {
        return $this->field;
    }

    public function getTable() {
        return $this->table;
    }

    public function getSearch() {
        return $this->search;
    }

    public function getFieldId() {
        return $this->fieldId;
    }

    public function getId() {
        return $this->id;
    }

    public function setField($field) {
        $this->field = $field;
    }

    public function setTable($table) {
        $this->table = $table;
    }

    public function setSearch($search) {
        $this->search = $search;
    }

    public function setFieldId($fieldId) {
        $this->fieldId = $fieldId;
    }

    public function setId($id) {
        $this->id = $id;
    }


}
