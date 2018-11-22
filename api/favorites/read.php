<?php
/**
* Created by PhpStorm.
* User: Administrateur
* Date: 11.09.2018
* Time: 10:18
*/

//Example using: ge-soif/api/fountain/read.php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/dbConnect.php';
include_once '../objects/favorites.php';



$db = connectDB();

// initialize object
$favorite = new Favorite($db);

// query users
$stmt = $favorite->read();
$num = $stmt->rowCount();
//Test
//$test = $fountain->getFountainsAdmin($fountain_item['active']);

$favorite_arr = array();

// check if more than 0 record found
if ($num > 0) {

  // retrieve our table contents
  // fetch() is faster than fetchAll()
  // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // extract row
    // this will make $row['name'] to
    // just $name only
    extract($row);
    
    $favorite_item = array(
        "idUser" => $idUser,
        "pseudo" => $pseudo,
        "idMovie" => $idMovie,
        "title" => $title,
        "imagePath" => $imagePath,
        "synopsis" => $synopsis,
        "releaseDate" => $releaseDate,
        "voteAverage" => floatval($voteAverage)
    );
    
    array_push($favorite_arr, $favorite_item);
  }
  //echo $fountain_arr;
  //var_dump($fountain_arr);
  echo json_encode($favorite_arr);
}
else{
  echo json_encode(
    array("error" => "Favorites not found.")
  );
}
