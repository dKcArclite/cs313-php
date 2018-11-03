<?php
namespace SQLData;

use PostgreSQL\Connection as Connection;

class Common
{
    function add_data($data, $obj)
    {
        $success = false;
        try {
            // connect to the PostgreSQL database
            $pdo = Connection::get()->get_db();
            //
            $bookDB = new BooksDB($pdo);
            // get all books data
            $success = $bookDB->$data($pdo, $obj);
        }
        catch (\PDOException $e) {
            echo $e->getMessage();
        }

        return $success;
    }

    function get_data($data)
    {
        $arr = [];
        try {
            // connect to the PostgreSQL database
            $pdo = Connection::get()->get_db();
            //
            $bookDB = new BooksDB($pdo);
            // get all books data
            $arr = $bookDB->$data($pdo);
        }
        catch (\PDOException $e) {
            echo $e->getMessage();
        }

        return $arr;
    }

    function get_data_by_id($data, $id)
    {
        $arr = [];
        try {
            // connect to the PostgreSQL database
            $pdo = Connection::get()->get_db();
            //
            $bookDB = new BooksDB($pdo);
            // get all books data
            $arr = $bookDB->$data($pdo, $id);
        }
        catch (\PDOException $e) {
            echo $e->getMessage();
        }

        return $arr;
    }

  function check_author_id($author_id)
 {

     if(!is_numeric($author_id))
     {
         $string = (string)$author_id;
         $splitter = " ";
         $pieces = explode($splitter, $string);

         $count = count($pieces);

         if($count > 2)
         {
             $first_name = $pieces[0];
             $middle_name = $pieces[1];
             $last_name = $pieces[2];
         }
         else
         {
             $first_name = $pieces[0];
             $middle_name = "";
             $last_name = $pieces[1];
         }

         $author = array (
                           'first_name' => trim($first_name),
                          'middle_name' => trim($middle_name),
                            'last_name' => trim($last_name)
                         );

         $author = (object)$author;
         $author_id = Common::add_data('insert_author_alt', $author);
     }
     else
     {
         $author_id = (integer)$author_id;
     }

     return $author_id;
 }

}
?>