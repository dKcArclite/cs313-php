<?php
 
require_once 'includes/db_settings.php';
 
$dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$username;password=$password";
 
try{
 // create a PostgreSQL database connection
 $con = new PDO($dsn);
 
 // display a message if connected to the PostgreSQL successfully
 if($con){
 //echo "Connected to the <strong>$db</strong> database successfully!";
 }
}catch (PDOException $e){
 // report error message
 echo $e->getMessage();
}

?>