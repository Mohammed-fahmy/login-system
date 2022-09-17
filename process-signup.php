<?php

// name validation
if (empty($_POST["name"])) {
    die("should enter the name ");
}

// Email validation
if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("invalid email");
}

// password

if (empty($_POST["password"])) {
    die("should enter the password ");
}

if (strlen($_POST["password"]) < 8) {
    die("the password less then 8 chars");
}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
    die("should have letters");
}

if (!preg_match("/[0-9]/", $_POST["password"])) {
    die("should have numbers ");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("password must match");
}

$password_hash =  password_hash($_POST["password"], PASSWORD_DEFAULT);

// import db connection
require_once "database_connection.php";

// insert signup form query
$q = "INSERT INTO user (name,email,password_hash) VALUES (:name , :email , :password_hash)";

// prepare sql query
$stmt =  $db_connection->Prepare($q);

// check query
try {
    $stmt->execute([
        ':name' => $_POST["name"], ':email' => $_POST["email"], ':password_hash' => $password_hash
    ]);
    echo "process page";
    header('location:signup-success.html');
    exit;
} catch (PDOException $e) {

    if($e->errorInfo[1] == 1062){
        die("duplicated email");
    }else{

        die($e->errorInfo[2] . " " . $e->errorInfo[1]);
    }
} {
}

    // echo "<pre>";
    //     print_r($_POST);
    //     var_dump( $password_hash);
    // echo "</pre>";
