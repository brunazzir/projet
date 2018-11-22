<?php

class Movie
{
  // database connection and table name
  private $conn;
  private $table_name = "movies";

  // object properties
  public $idMovie;
  public $title;
  public $imagePath;
  public $synopsis;
  public $releaseDate;
  public $voteAverage;


  // constructor with $db as database connection
  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function read(){
    $stmt = $this->conn->prepare("SELECT `idMovie`, `title`, `imagePath`, `synopsis`, `releaseDate`, `voteAverage` FROM $this->table_name");
    $stmt->execute();
    return $stmt;
  }

  public function readOne(){
    // query to read single record
    $query = "SELECT `idMovie`, `title`, `imagePath`, `synopsis`, `releaseDate`, `voteAverage` FROM $this->table_name f
    WHERE
    f.idMovie = :idMovie
    LIMIT
    0,1";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // bind id of product to be updated
    $stmt->bindParam(":idMovie", $this->idMovie);

    // execute query
    $stmt->execute();

    if ($stmt->rowCount() === 1) {
      // get retrieved row
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set values to object properties
      $this->title = $row['title'];
      $this->imagePath = $row['imagePath'];
      $this->synopsis = $row['synopsis'];
      $this->releaseDate = $row['releaseDate'];
      $this->voteAverage = $row['voteAverage'];

      return true;
    } else {
      return false;
    }
  }    

  public function addMovie()
  {
    // query to insert record
    $query = "INSERT INTO $this->table_name
    (title, imagePath, synopsis, releaseDate, voteAverage)
    VALUES
    (:title, :imagePath, :synopsis, :releaseDate, :voteAverage)";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->title = htmlspecialchars(strip_tags($this->title));
    $this->imagePath = htmlspecialchars(strip_tags($this->imagePath));
    $this->synopsis = htmlspecialchars(strip_tags($this->synopsis));
    $this->releaseDate = htmlspecialchars(strip_tags($this->releaseDate));
    $this->voteAverage = htmlspecialchars(strip_tags($this->voteAverage));
    

    // bind values
    $stmt->bindParam(":title", $this->title);
    $stmt->bindParam(":imagePath", $this->imagePath);
    $stmt->bindParam(":synopsis", $this->synopsis);
    $stmt->bindParam(":releaseDate", $this->releaseDate);
    $stmt->bindParam(":voteAverage", $this->voteAverage);

    // execute query
    return ($stmt->execute()) ? true : false;
  }


  // delete the product
  public function delete(){

    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE idMovie = :idMovie";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->idMovie=htmlspecialchars(strip_tags($this->idMovie));

    // bind id of record to delete
    $stmt->bindParam(':idMovie', $this->idMovie);

    // execute query
    return $stmt->execute() ? true : false;
  }
}
