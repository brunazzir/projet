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
include_once '../objects/dishes.php';

$db = connectDB();

// prepare product object
$dish = new Dishes($db);

// set ID property of product to be edited
$dish->idDish = isset($_GET['idDish']) ? $_GET['idDish'] : die();

// read the details of product to be edited
$dish_item = array();


if ($dish->readOne()) {
    // create array
    $dish_item = array(
        
        "idDish" => $dish->idDish,
        "dishName" => $dish->dishName
    );

    // make it json format
    http_response_code(200);
    echo json_encode($dish_item);
} else {

    // Not found
    http_response_code(404);
    echo json_encode($dish_item);
}



