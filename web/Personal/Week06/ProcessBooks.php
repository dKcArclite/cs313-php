<?php
session_start();

require 'Includes/dbcon.php';
require 'Includes/BooksDB.php';
require 'Includes/Common.php';

use SQLData\Common as Common;

if(!empty($_SESSION["Book_Id"])) {
	$book_id = $_SESSION["Book_Id"];
}
else
{
	$book_id = $_SESSION["Book_Id"];
}

$title = htmlspecialchars($_POST['title']);
$author_id = htmlspecialchars($_POST["author_id"]);
$format_id = (integer)htmlspecialchars($_POST["format_id"]);
$genre_id = (integer)htmlspecialchars($_POST["genre_id"]);
$in_series = htmlspecialchars($_POST["in_series"]);
$series_id = htmlspecialchars($_POST["series_id"]);
$number_in_series = (integer)htmlspecialchars($_POST["number_in_series"]);
$isbn = htmlspecialchars($_POST["isbn"]);
$pages = (integer)htmlspecialchars($_POST["pages"]);
$copyright = (integer)htmlspecialchars($_POST["copyright"]);
$description = htmlspecialchars($_POST["description"]);

if($in_series = "on")
{
    $is_series = true;
}
else
{
    $is_series = false;
}

$author_id = Common::check_author_id($author_id);

if(!is_numeric($series_id))
{
    $string = (string)$series_id;

    $series = array (
                      'author_id' => trim($author_id),
                         'series' => trim($string)
                    );

    $series = (object)$series;
    $series_id = Common::add_data('insert_series_alt', $series);
}
else
{
    $series_id = (integer)$series_id;
}

$array = array (
                'book_id' => trim($book_id),
	            'author_id' => trim($author_id),
	            'genre_id' => trim($genre_id),
	            'format_id' => trim($format_id),
	            'is_series' => trim($is_series),
	            'series_id' => trim($series_id),
	            'number_in_series' => trim($number_in_series),
	            'title' => trim($title),
	            'isbn' => trim($isbn),
	            'pages' => trim($pages),
	            'copyright' => trim($copyright),
	            'description' => trim($description)
);

$obj = (object)$array;

if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
        case "addBook":
            if(!empty($_POST["title"])) {
                $book_id = Common::add_data('insert_book', $obj);
                if ($book_id > 0){$success = true;}
            }
            break;
        case "editBook":
            if(!empty($_POST["title"])) {
                $success = Common::add_data('update_book', $obj);
            }
            break;
    }
}

if(!empty($_SESSION["Book_Id"]))
{
    unset($_SESSION["Book_Id"]);
    $_SESSION["Book_Id"] = $book_id;
}
else
{
    $_SESSION["Book_Id"] = $book_id;
}

if($success)
{
    header('Location: View.php');
}
else
{
    header('Location: Error.php');
}

die();

?>