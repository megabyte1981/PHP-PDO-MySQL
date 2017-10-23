<?php

class DBQueryMySQL {

    protected $query;
    protected $parameters;

    public function __construct($query, $p = array()){
	
        $this->query = $query;
        $this->parameters = $p;
		
    }
	
	public function getQuery(){
		
		$p = $this->parameters;
		$query = $this->query;
		
		// Sort Parameters based on length 
		$keys = array_map('strlen', array_keys($p));
		array_multisort($keys, SORT_DESC, $p);
		
		if(isset($p) && !empty($p)){
			foreach($p as $key=>$val) {
				// Check data values for an array.
				if(is_array($val)) {
				
					unset($this->parameters[$key]);
				
					$params = array();
					$ids = array();
					foreach($val as $k=>$v) {
						$index = uniqid($v);
						$params[$index] = $v;
						$ids[$index] = "";
						
						$this->parameters[$index] = $v;
					}
					
					$query = str_replace(array(" = :" . $key, " =:" . $key, "= :" . $key, "=:" . $key), " IN_" . $key, $query);
					$query = str_replace(" IN_" . $key, " IN (:" . implode(", :", array_keys($ids)) . ")", $query);
					$this->query = $query;
				}
			}
		}

		$data['query'] = $this->query;
		$data['parameters'] = $this->parameters;
		
		return $data;
		
    }
	
}
