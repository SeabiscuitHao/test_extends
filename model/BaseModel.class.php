<?php
	class BaseModel {
	    public $mysqli;
	    public $tableName;
	    public function __construct() {
	        $this->mysqli = new mysqli('localhost', 'root', 'root', 'zt_test');
	    }

	    public function del($where=array()) {
	    	if (empty($where)) {
	    		die('error');
	    	}
	    	$sql = "delete from {$this->tableName}";
	    	$whereStr = " where 1";
	    	foreach ($where as $k => $v) {
	    		if (is_int($v)) {
	    			$whereStr .= " and ". $k . "=" . $v;
	    		} else {
	    			$whereStr .= " and " . $k . "=" . "'" . $v . "'";
	    		}
	    	}
	    	$sql .= "{$whereStr}";
	    	// var_dump($sql);die();
	    	$query = $this->mysqli->query($sql);
	    	return $query;
	    }

	    public function select($where=array(),$offset=0,$limit=0,$field=array()) {
	    	$whereStr = "where 1";
	    	// $sql = "select * from {$this->tableName}";
	    	foreach ($where as $k => $v) {
	    		$whereStr .= " and " . $k ."=" .$v;
	    	}
	    	if (!empty($limit)) {
	    		$limitStr = "limit {$offset} {$limit}"; 
	    	} else {
	    		$limitStr = "";
	    	}

	    	if (!empty($field)) {
	    		$fieldStr = implode(',', $field);
	    	} else {
	    		$field = "*";
	    	}
	    	$sql = "select {$field} from {$this->tableName} {$whereStr} {$limitStr}";
	    	$query = $this->mysqli->query($sql);
	    	$res = $query->fetch_all(MYSQLI_ASSOC);
	    	return $res;
	    }

	    public function update ($where,$data) {
	    	$sql = "update {$this->tableName} set ";
	    	$field = "";
	    	$whereStr = "where 1";
	    	foreach ($where as $k => $v) {
	    		$whereStr .= " and " . $k . "=" . "'" . $v . "'";
	    	}

	    	foreach ($data as $k => $v) {
	    		$field .= $k ."=" .  "'" . $v . "'" . ",";
	    	}
	    	$field = trim($field,",");
	    	$sql .= "{$field} {$whereStr}";
	    	$query = $this->mysqli->query($sql);
	    	return $query;
	    }

	    public function add ($data) {
	    	$sql = "insert into {$this->tableName}";
	    	$field = "";
	    	$value = "";
	    	foreach ($data as $k => $v) {
	    		$field = $k . ",";
	    		$value = $v . ",";
	    	}
	    	$field = trim($field,",");
	    	$value = trim($value,",");

	    	if (is_int($value)) {
	    		$sql .= "( " . $field . " )" . " value " . "( " . $value . " )" ;
	    	} else {
	    		$sql .= "( " . $field . " )" . " value " . "( " . "'" . $value . "'" ." )" ;
	    	}

	    	$query = $this->mysqli->query($sql);
	    	return $query;

	    	// var_dump($sql);die();
	    }
	}