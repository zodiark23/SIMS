<?php namespace SIMS\Classes;

use PDO;
/**
 * Base class of Models
 * 
 * It will include some helper functions to speed-up process of data manipulations
 */
abstract class Model{

    protected $db;
    public $table;


    /**
     * Find the target id
     * 
     * @param string $column - The column to be searched
     * @param int $id - The actual value to be queried
     * @param string $table Overrides the current property
     */
    public function findById($column,$id, $table = ""){

        $target_table = !empty($table) ? $table : $this->table;
        
        $stmt = $this->db->prepare("SELECT * FROM  $target_table WHERE $column = :target_id");

        $stmt->execute(["target_id" => $id]);

        $data = $stmt->fetchAll();

        if($data){
            return $data;
        }
        return false;
    }

    /**
     * Helper function returns the lists of item depending the property `table` set
     * 
     * @param string $orderBy Column for sorting
     * @param string $order - DESC or ASC
     */
    public function showAll($orderBy = "", $order = "DESC"){
        $phrase = "";
        if(!empty($orderBy)){
            $phrase = "ORDER BY ". $orderBy . " ". $order;
        }
        
        $stmt = $this->db->prepare("SELECT * FROM $this->table $phrase");

        $stmt->execute();

        $data = $stmt->fetchAll();

        if($data){
            return $data;
        }
    }




}

