<?php

define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','^#XKL9f?Hn8NkyAH');
define('DB_NAME','sims');


class Model{

    private $db;


    public function __construct()
    {
    	//Catch the connection
	    try
	    {
	    	$this->db = new PDO("mysql:host=".DB_HOST.":dbname=".DB_NAME,DB_USER,DB_PASS,
			    array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
	    }
	    catch (PDOException $exceptionMessage)
	    {
	    	echo "Error: ".$exceptionMessage->getMessage();
	    }
    }


    public function getDb(){
    	return $this->db;
    }


    public function closeDb(){
    	$this->db = null;
    }
}

class ModelChild extends Model {

	public function getUser(){
		/*
		Query for selecting users in db
		*/
	}
}