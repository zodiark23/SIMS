<?php




Class Database{

    private $db;


    public function __construct()
    {
        //Catch the connection
        try {
            $this->db = new PDO("mysql:host=" . DB_HOST . ":dbname=" . DB_NAME, DB_USER, DB_PASS,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        } catch (PDOException $exceptionMessage) {
            echo "Error: " . $exceptionMessage->getMessage();
        }
    }

}
