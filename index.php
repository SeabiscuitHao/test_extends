<?php
	$c = $_GET['c'];
	$a = $_GET['a'];

	function __autoload($a) {
        if (strpos($a, "Controller") !== false) {

            include_once "./controller/{$a}.class.php";

        } elseif(strpos($a, "Model") !== false) { 

            include_once "./model/{$a}.class.php";

        } else {
        	
        	die();
        }
        
    }
	include "./common/function.php";
	session_start();
	header("Content-type:text/html;charset=utf-8");
	$className = "{$c}Controller";
	$obj = new $className();
	$obj -> $a();
	// DocBlockr