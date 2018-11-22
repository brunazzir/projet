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
include_once '../objects/dish.php';

$db = connectDB();

// prepare product object
$dish = new Dishes($db);

// set ID property of product to be edited
$dish->title = isset($_POST['dishName']) ? $_POST['dishName'] : die();

// read the details of product to be edited
$dish_item = array();

if ($dish->addDish()) {
    // create array
    $dish_item = array(
        "dishName" => $dish->title
    );

    // make it json format
    http_response_code(200);
    echo json_encode($dish_item);
} else {

    // Not found
    http_response_code(404);
    echo json_encode($dish_item);
}



