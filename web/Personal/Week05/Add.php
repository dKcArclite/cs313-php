<?php
session_start();

require 'Includes/dbcon.php';
include 'BooksDB.php';

use SQLData\BooksDB as BooksDB;
use PostgreSQL\Connection as Connection;

//if (!empty($_POST['btnView'])) {
//    $book_id = htmlspecialchars($_POST['btnView']);


if(!empty($_SESSION["Book_Id"]))
{
    unset($_SESSION["Book_Id"]);
    $_SESSION["Book_Id"];
    header("Location: View.php");
    die();
}
//}

$book_id = 0;
//if(!empty($_SESSION["book_id"])) {
//    $book_id = $_SESSION["book_id"];
//}
//else
//{
//    //header("Location: Error.php");
//    //die();
//    $book_id = 5;
//}

try {
    // connect to the PostgreSQL database
    $pdo = Connection::get()->get_db();
    //
    $bookDB = new BooksDB($pdo);
    // get all books data
    $books = $bookDB->get_book($pdo, $book_id);

    $author_id = $books[0]['Author_Id'];

}
catch (\PDOException $e) {
    echo $e->getMessage();
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

//function get_authors()
//{
//    $authors = [];
//    try {
//        // connect to the PostgreSQL database
//        $pdo = Connection::get()->get_db();
//        //
//        $bookDB = new BooksDB($pdo);
//        // get all books data
//        $authors = $bookDB->get_authors($pdo);
//    }
//    catch (\PDOException $e) {
//        echo $e->getMessage();
//    }

//    return $authors;
//}

//$authorsData = get_authors();

$authorsData = get_data('get_authors');
$formatsData = get_data('get_formats');
$genresData = get_data('get_genres');
// TODO: only load if in series (make dynamic for edit)
$seriesData = get_data_by_id('get_series', $author_id);
?>
<html>
<head>
    <title>
        View
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet' />
    <link href="css/project1.css" type="text/css" rel="stylesheet" />
    <script src="js/project1.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
		$(document).ready(function() {

            var authors = <?php echo json_encode($authorsData); ?>;
			var formats = <?php echo json_encode($formatsData); ?>;
            var genres = <?php echo json_encode($genresData); ?>;
			var series = <?php echo json_encode($seriesData); ?>;

			var authorid = $('#authorid').val();
			var formatid = $('#formatid').val();
			var genreid = $('#genreid').val();
			var seriesid = $('#seriesid').val();


		    $('#Authors').select2({
		          data: authors,
			      selectOnClose: true,
			      tags: true,
			      width: "15%",
			      placeholder: "Select",
			      allowClear: true
		    });

		    $('#Formats').select2({
		          data: formats,
			      selectOnClose: true,
			      tags: true,
			      width: "15%",
			      placeholder: "Select",
			      allowClear: true
		    });

		    $('#Genres').select2({
		        data: genres,
		        selectOnClose: true,
		        tags: true,
		        width: "15%",
		        placeholder: "Select",
		        allowClear: true
		    });

		    $('#Series').select2({
		        data: series,
		        selectOnClose: true,
		        tags: true,
		        width: "15%",
		        placeholder: "Select",
		        allowClear: true
		    });

		    $('#Authors').val(authorid).trigger("change")
		    $('#Formats').val(formatid).trigger("change")
		    $('#Genres').val(genreid).trigger("change")
		    $('#Series').val(seriesid).trigger("change")
		});

    </script>
</head>
<body>
    <div class="container masthead">
        <div class="logo">
            <img src="images/logo.png" alt="Books by Rick" width="207" height="75" />

        </div>
        <div class="searchbar"></div>
    </div>
    <form class="form-horizontal">
        <div class="container">
            <br />
            <?php if (count($books)): ?>
            <?php foreach ($books as $key => $book): ?>
            <fieldset>
                <div class="form-group">
                    <label class="control-label" for="title">
                        Title: <?php echo htmlspecialchars($book['Title']); ?>
                    </label>
                    <input id="title" type="text" value="<?php echo htmlspecialchars($book['Title']); ?>" />
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="author">
                        Author:
                    </label>
                    <div class="controls">
                        <input id="authorid" type="hidden" value="<?php echo htmlspecialchars($book['Author_Id']); ?>" />
                        <select name="Authors" id="Authors"></select>
                    </div>
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="format">
                        Format: <?php echo htmlspecialchars($book['Format']); ?>
                    </label>
                    <input id="formatid" type="hidden" value="<?php echo htmlspecialchars($book['Format_Id']); ?>" />
                    <select name="Formats" id="Formats"></select>
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="genre">
                        Genre: <?php echo htmlspecialchars($book['Genre']); ?>
                    </label>
                    <input id="genreid" type="hidden" value="<?php echo htmlspecialchars($book['Genre_Id']); ?>" />
                    <select name="Genres" id="Genres"></select>
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="in_series">
                        In Series: <?php echo htmlspecialchars($book['In_Series']); ?>
                    </label>
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="series">
                        Series: <?php echo htmlspecialchars($book['Series']); ?>
                    </label>
                    <input id="seriesid" type="hidden" value="<?php echo htmlspecialchars($book['Series_Id']); ?>" />
                    <select name="Series" id="Series"></select>
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="number_in_series">
                        Number in Series: <?php echo htmlspecialchars($book['Number_In_Series']); ?>
                    </label>
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="isbn">
                        ISBN: <?php echo htmlspecialchars($book['ISBN']); ?>
                    </label>
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="pages">
                        Pages: <?php echo htmlspecialchars($book['Pages']); ?>
                    </label>
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="copywrite">
                        Copyright: <?php echo htmlspecialchars($book['Copywrite']); ?>
                    </label>
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="description">
                        Description: <?php echo htmlspecialchars($book['Description']); ?>
                    </label>
                    <br />
                </div>

            </fieldset>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </form>



</body>
</html>