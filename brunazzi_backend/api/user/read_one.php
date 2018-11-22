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
include_once '../objects/user.php';

$db = connectDB();

// prepare product object
$user = new User($db);

// set ID property of product to be edited
$user->userName = isset($_POST['userName']) ? $_POST['userName'] : die();

// read the details of product to be edited
$user_item = array();


if ($user->readOne()) {
    // create array
    $user_item = array(
        
        "idUser" => $user->idUser,
        "userName" => $user->userName,
        "userPassword" => $user->userPassword  
    );

    // make it json format
    http_response_code(200);
    echo json_encode($user_item);
} else {

    // Not found
    http_response_code(404);
    echo json_encode($user_item);
}



