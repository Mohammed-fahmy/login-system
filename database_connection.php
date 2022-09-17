<?php 

$dsn = "mysql:host=localhost;dbname=login_db";
$username = "root";
$password = "";

try{

$db_connection = new PDO($dsn,$username,$password);

}catch(PDOException $e){
    die("error in db connection" . $e->getMessage());
}

?>