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
include_once '../objects/favorites.php';

$db = connectDB();

// prepare product object
$favorite = new Favorite($db);

// set ID property of product to be edited
$favorite->idUser = isset($_POST['idUser']) ? $_POST['idUser'] : die();
$favorite->idMovie = isset($_POST['idMovie']) ? $_POST['idMovie'] : die();

// read the details of product to be edited
$favorite_item = array();

if ($favorite->addFavorite()) {
    // create array
    $favorite_item = array(
        "idUser" => $favorite->idUser,
        "idMovie" => $favorite->idMovie
    );

    // make it json format
    http_response_code(200);
    echo json_encode($favorite_item);
} else {

    // Not found
    http_response_code(404);
    echo json_encode($favorite_item);
}



