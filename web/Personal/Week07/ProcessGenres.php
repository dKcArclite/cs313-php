<?php

require 'Includes/dbcon.php';
require 'Includes/BooksDB.php';
require 'Includes/Common.php';

use SQLData\Common as Common;

$genre_id = htmlspecialchars($_POST['genre_id']);
$genre = htmlspecialchars($_POST['genre']);
$description = htmlspecialchars($_POST['description']);

$array = array (
                  'genre_id' => trim($genre_id),
                     'genre' => trim($genre),
               'description' => trim($description)
               );

$obj = (object)$array;

if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
        case "add":
            $success = Common::add_data('insert_genre', $obj);
            break;
        case "update":
            $success = Common::add_data('update_genre', $obj);
            break;
    }
}



if($success)
{
    header('Location: Genres.php');
}
else
{
    header('Location: Error.php');
}

die();



?>