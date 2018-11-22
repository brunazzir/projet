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
include_once '../objects/user.php';

$db = connectDB();

// prepare product object
$user = new User($db);

// set ID property of product to be edited
$user->pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : die();
$user->password = isset($_POST['password']) ? $_POST['password'] : die();

// read the details of product to be edited
$user_item = array();

if ($user->addUser()) {
    // create array
    $user_item = array(
        "pseudo" => $user->pseudo,
        "password" => $user->password 
    );

    // make it json format
    http_response_code(200);
    echo json_encode($user_item);
} else {

    // Not found
    http_response_code(404);
    echo json_encode($user_item);
}



