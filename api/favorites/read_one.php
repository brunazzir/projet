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
include_once '../objects/favorites.php';

$db = connectDB();

// prepare product object
$favorite = new Favorite($db);

// set ID property of product to be edited
$favorite->idUser = isset($_POST['idUser']) ? $_POST['idUser'] : die();

// read the details of product to be edited
$favorite_item = array();


if ($favorite->readOne()) {
    // create array
    $favorite_item = array(
        "idUser" => $favorite->idUser,
        "pseudo" => $favorite->pseudo,
        "idMovie" => $favorite->idMovie,
        "title" => $favorite->title,
        "imagePath" => $favorite->imagePath,
        "synopsis" => $favorite->synopsis,
        "releaseDate" => $favorite->releaseDate,
        "voteAverage" => floatval($favorite->voteAverage)
    );

    // make it json format
    http_response_code(200);
    echo json_encode($favorite_item);
} else {

    // Not found
    http_response_code(404);
    echo json_encode($favorite_item);
}



