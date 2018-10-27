<?php

require 'Includes/dbcon.php';
require 'Includes/BooksDB.php';
require 'Includes/Common.php';

use SQLData\Common as Common;

    $author_id = htmlspecialchars($_POST['author_id']);
    $first_name = htmlspecialchars($_POST['first_name']);
    $middle_name = htmlspecialchars($_POST['middle_name']);
    $last_name = htmlspecialchars($_POST['last_name']);

    $array = array (
                       'author_id' => trim($author_id),
                      'first_name' => trim($first_name),
                     'middle_name' => trim($middle_name),
                       'last_name' => trim($last_name)
                    );

    $obj = (object)$array;

    if(!empty($_GET["action"])) {
        switch($_GET["action"]) {
            case "add":
                $success = Common::add_data('insert_author', $obj);
                break;
            case "update":
                $success = Common::add_data('update_author', $obj);
                break;
        }
    }
    
    if($success)
    {
        header('Location: Authors.php');
    }
    else
    {
        header('Location: Error.php');
    }

    die();

?>