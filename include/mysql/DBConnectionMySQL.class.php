<?php

class DBConnectionMySQL {

    public $pdo;

    public function __construct($p = array()){

        try{
            $configuration = new Config($p = array());
            $this->pdo = new PDO($configuration->getDNS(), $configuration->getUserName(), $configuration->getPassword(), array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"));
        }
        catch(PDOException $ex){
            echo "Not Connected"; die();
        }

    }

    public function __destruct(){

        $this->pdo = null;

    }

    public function testConnection(){

        try{
            $this->pdo;
            echo "Connected";
        }
        catch(PDOException $ex){
            echo "Not Connected"; die();
        }

    }

    public function query($query, $p = array()){

        $query = new DBQueryMySQL($query, $p);

        $result = $query->getQuery();
        $prepared = $this->pdo->prepare($result['query']);
        $result = $prepared->execute($result['parameters']);

        if(!$result){
            $errors = $prepared->errorInfo();
            echo $errors[2];
            print_r($query);
            return false;
        } else {
            return new DBResultMySQL($query, $prepared);
        }

    }

	public function queryDebug($query, $p = array()){

		if(!empty($p)) {
			foreach($p as $key => $val) {
				if(is_array($val)) {

					foreach($val as $k => $v) {
						$params[] = $v;
					}

					$query = str_replace(array(" = :" . $key, " =:" . $key, "= :" . $key, "=:" . $key), " IN_" . $key, $query);
					$query = str_replace(" IN_" . $key, " IN ('" . implode("','", $params) . "')", $query);

				} else {
					$query = str_replace(":" . $key, "'" . $val . "'", $query);
				}
			}
		}
		return $query;

    }

    public function getInsertID() {

        return $this->pdo->lastInsertId();

    }

	public function output($result){

		echo "<PRE>";
		print_r($result);
		echo "</PRE>";

    }

}
