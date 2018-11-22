<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 11.09.2018
 * Time: 09:22
 */

class User
{
    // database connection and table name
    private $conn;
    private $table_name = "users";

    // object properties
    public $idUser;
    public $pseudo;
    public $password;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        // select
        $query = "SELECT * FROM " . $this->table_name;

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
    
    public function readOne(){
    // query to read single record
    $query = "SELECT `idUser`, `pseudo`, `password` FROM $this->table_name f
    WHERE
    f.pseudo = :pseudo
    LIMIT
    0,1";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // bind id of product to be updated
    $stmt->bindParam(":pseudo", $this->pseudo);

    // execute query
    $stmt->execute();

    if ($stmt->rowCount() === 1) {
      // get retrieved row
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set values to object properties
      $this->idUser = $row['idUser'];
      $this->pseudo = $row['pseudo'];
      $this->password = $row['password'];

      return true;
    } else {
      return false;
    }
  }    
    
    public function addUser()
    {
        // query to insert record
        $query = "INSERT INTO $this->table_name
        (pseudo, password)
        VALUES
        (:pseudo, :password)";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->pseudo = $this->pseudo;
        $this->password = sha1($this->password);


        // bind values
        $stmt->bindParam(":pseudo", $this->pseudo);
        $stmt->bindParam(":password", $this->password);

        // execute query
        return ($stmt->execute()) ? true : false;
    }
}