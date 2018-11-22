<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 11.09.2018
 * Time: 09:22
 */

class Dishes
{
    // database connection and table name
    private $conn;
    private $table_name = "dishes";

    // object properties
    public $idDish;
    public $dishName;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        // select
        $query = "SELECT `idDish`, `dishName` FROM " . $this->table_name;

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
    
    public function readOne(){
    // query to read single record
    $query = "SELECT `idDish`, `dishName` FROM " . $this->table_name . "WHERE idDish = :idDish";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // bind id of product to be updated
    $stmt->bindParam(":idDish", $this->idDish);

    // execute query
    $stmt->execute();

    if ($stmt->rowCount() === 1) {
      // get retrieved row
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set values to object properties
      $this->idDish = $row['idDish'];
      $this->dishName = $row['dishName'];

      return true;
    } else {
      return false;
    }
  } 
}