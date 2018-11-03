<?php

require 'Includes/dbcon.php';
require 'Includes/BooksDB.php';
require 'Includes/Common.php';

use SQLData\Common as Common;

$series_id = (integer)htmlspecialchars($_POST['series_id']);
$author_id = htmlspecialchars($_POST['author_id']);
$series = htmlspecialchars($_POST['series']);
$description = htmlspecialchars($_POST['description']);

//if new author then add it and return id
$author_id = Common::check_author_id($author_id);

$array = array (
                  'series_id' => trim($series_id),
                  'author_id' => trim($author_id),
                     'series' => trim($series),
                'description' => trim($description),
               );

$obj = (object)$array;

if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
        case "add":
            $success = Common::add_data('insert_series', $obj);
            break;
        case "update":
            $success = Common::add_data('update_series', $obj);
            break;
    }
}

if($success)
{
    header('Location: Series.php');
}
else
{
    header('Location: Error.php');
}

die();

?>