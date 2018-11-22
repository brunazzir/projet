<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 15.10.2018
 * Time: 11:09
 * 
 */

//Example using: ge-soif/api/fountain/add_fountain.php?latitude=43&longitude=32&active=1

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
$movie->title = isset($_POST['title']) ? $_POST['title'] : die();
$movie->imagePath = isset($_POST['imagePath']) ? $_POST['imagePath'] : die();
$movie->synopsis = isset($_POST['synopsis']) ? $_POST['synopsis'] : die();
$movie->releaseDate = isset($_POST['releaseDate']) ? $_POST['releaseDate'] : die();
$movie->voteAverage = isset($_POST['voteAverage']) ? $_POST['voteAverage'] : die();

// read the details of product to be edited
$movie_item = array();

if ($movie->addMovie()) {
    // create array
    $movie_item = array(
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



