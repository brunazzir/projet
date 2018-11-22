<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 11.09.2018
 * Time: 11:03
 */

//Example using: ge-soif/api/fountain/read_one.php?id=60

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/dbConnect.php';
include_once '../objects/movie.php';

$db = connectDB();

// prepare product object
$movie = new Movie($db);

// set ID property of product to be edited
$movie->idMovie = isset($_GET['idMovie']) ? $_GET['idMovie'] : die();

// read the details of product to be edited
$movie_item = array();


if ($movie->readOne()) {
    // create array
    $movie_item = array(
        
        "idMovie" => $movie->idMovie,
        "title" => $movie->title,
        "imagePath" => $movie->imagePath,
        "synopsis" => $movie->synopsis,
        "releaseDate" => $movie->releaseDate,
        "voteAverage" => floatval($movie->voteAverage)        
    );

    // make it json format
    http_response_code(200);
    echo json_encode($movie_item);
} else {

    // Not found
    http_response_code(404);
    echo json_encode($movie_item);
}



