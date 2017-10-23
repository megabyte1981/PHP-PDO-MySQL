<?php

class DBResultMySQL {

    protected $query;
    protected $statement;

    public function __construct(DBQueryMySQL $query, PDOStatement $prepared){

        $this->query = $query;
        $this->statement = $prepared;

    }

	public function fetchAll() {

        $returnArray = array();
        while($record = $this->fetchRecord()){
            $returnArray[] = $record->getArray();
        }

        return $returnArray;

    }

    public function fetch($index = 0) {

        $result = $this->fetchAll();
        return (isset($result[$index])) ? $result[$index] : false;

    }

	public function fetchRecord() {

        $result = $this->statement->fetch(PDO::FETCH_ASSOC);

        if(is_array($result)){
            return new DBRecordMySQL($result);
        } else {
            return false;
        }

    }


}
