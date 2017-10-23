<?php

class DBRecordMySQL {

	protected $data;
	
	public function __construct($array){
	
        $this->data = $array;
		
    }

    public final function getArray(){
	
        return $this->toArray();
		
    }
	
	public function toArray(){
	
        $values = array();

        foreach($this->data as $key => $value){
            $values[$key] = $value;
        }

        return $values;
		
    }

}
