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
    public $userName;
    public $userPassword;

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
    $query = "SELECT `idUser`, `userName`, `userPassword` FROM $this->table_name f
    WHERE
    f.userName = :userName
    LIMIT
    0,1";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // bind id of product to be updated
    $stmt->bindParam(":userName", $this->userName);

    // execute query
    $stmt->execute();

    if ($stmt->rowCount() === 1) {
      // get retrieved row
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set values to object properties
      $this->idUser = $row['idUser'];
      $this->userName = $row['userName'];
      $this->userPassword = $row['userPassword'];

      return true;
    } else {
      return false;
    }
  }    
    
    public function addUser()
    {
        // query to insert record
        $query = "INSERT INTO $this->table_name
        (userName, userPassword)
        VALUES
        (:userName, :userPassword)";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->userName = $this->userName;
        $this->userPassword = sha1($this->userPassword);


        // bind values
        $stmt->bindParam(":userName", $this->userName);
        $stmt->bindParam(":userPassword", $this->userPassword);

        // execute query
        return ($stmt->execute()) ? true : false;
    }
}