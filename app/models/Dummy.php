<?php
class Dummy extends Eloquent {
    protected $connection = 'mysql2';
    protected static $_table;

    public function setTable($table) {
        static::$_table = $table;
    }

    public function getTable() {
        return static::$_table;
    }
}