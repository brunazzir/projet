<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 11.09.2018
 * Time: 09:22
 */

class Favorite
{
    // database connection and table name
    private $conn;
    private $table_name = "favorites";

    // object properties
    public $idFavorite;
    public $idDish;
    public $idUser;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        // select
        $query = "SELECT 'idFavorite','idDish','dishName','idUser' FROM " . $this->table_name . " NATURAL JOIN dishes NATURAL JOIN users";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
    
    public function readOne(){
    // query to read single record
    $query = "SELECT 'idFavorite','idDish','dishName','idUser' FROM " . $this->table_name . " AS f NATURAL JOIN dishes NATURAL JOIN users WHERE
    f.idUser = :idUser
    LIMIT
    0,1";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // bind id of product to be updated
    $stmt->bindParam(":idUser", $this->idUser);

    // execute query
    $stmt->execute();

    if ($stmt->rowCount() === 1) {
      // get retrieved row
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set values to object properties
      $this->idUser = $row['idUser'];
      $this->idDish = $row['idDish'];
      $this->idFavorite = $row['idFavorite'];

      return true;
    } else {
      return false;
    }
  }    
    
    public function addFavorite()
    {
        // query to insert record
        $query = "INSERT INTO $this->table_name
        (idDish, idUser)
        VALUES
        (:idDish, :idUser)";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->idDish = $this->idDish;
        $this->idUser = $this->idUser;


        // bind values
        $stmt->bindParam(":idDish", $this->idDish);
        $stmt->bindParam(":idUser", $this->idUser);

        // execute query
        return ($stmt->execute()) ? true : false;
    }
    
    // delete the product
    public function delete(){

        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE idDish = :idDish";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->idMovie=htmlspecialchars(strip_tags($this->idMovie));

        // bind id of record to delete
        $stmt->bindParam(':idDish', $this->idDish);

        // execute query
        return $stmt->execute() ? true : false;
    }
}