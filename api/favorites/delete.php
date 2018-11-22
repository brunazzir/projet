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


$favorite->idMovie = isset($_GET['idMovie']) ? $_GET['idMovie'] : die();


// delete the product
if($favorite->delete()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "Favorite was deleted."));
}
 
// if unable to delete the product
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to delete favorite."));
}


