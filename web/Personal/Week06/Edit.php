<?php
session_start();

require 'Includes/dbcon.php';
include 'Includes/BooksDB.php';
include 'Includes/Common.php';

use SQLData\BooksDB as BooksDB;
use PostgreSQL\Connection as Connection;
use SQLData\Common as Common;

$book_id = 0;

if(!empty($_SESSION["Book_Id"])) {
	$book_id = $_SESSION["Book_Id"];
}
else
{
	$book_id = $_SESSION["Book_Id"];
}

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

$authorsData = Common::get_data('get_authors');
$formatsData = Common::get_data('get_formats');
$genresData = Common::get_data('get_genres');
$seriesData = Common::get_data_by_id('get_series', $author_id);
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
	<link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
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
			      width: "12%",
			      placeholder: "Select Author",
			      allowClear: true

		    });

		    $('#Formats').select2({
		          data: formats,
			      selectOnClose: true,
			      tags: true,
			      width: "8%",
			      placeholder: "Select Format",
			      allowClear: true
		    });

		    $('#Genres').select2({
		        data: genres,
		        selectOnClose: true,
		        tags: true,
		        width: "16%",
		        placeholder: "Select Genre",
		        allowClear: true
		    });

		    $('#Series').select2({
		        data: series,
		        selectOnClose: true,
		        tags: true,
		        width: "10%",
		        placeholder: "Select Series",
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
	<div class="searchbar">
	</div>
</div>
    <form class="form-horizontal" id="editBook" action="ProcessBooks.php?action=editBook" method="post">
        <div class="container">
            <br />
            <?php if (count($books)): ?>
            <?php foreach ($books as $key => $book): ?>

            <fieldset>
                <div class="form-group">
                    <label class="control-label" for="title">
                        Title:
                    </label>
                    <input id="title" type="text" name="title" value="<?php echo htmlspecialchars($book['Title']); ?>" />
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="author">
                        Author:
                    </label>
                    <input id="authorid" name="author_id" type="hidden" value="<?php echo htmlspecialchars($book['Author_Id']); ?>" />
                    <select name="Authors" id="Authors"></select>
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="format">
                        Format:
                    </label>
                    <input id="formatid" name="format_id" type="hidden" value="<?php echo htmlspecialchars($book['Format_Id']); ?>" />
                    <select name="Formats" id="Formats"></select>
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="genre">
                        Genre:
                    </label>
                    <input id="genreid" name="genre_id" type="hidden" value="<?php echo htmlspecialchars($book['Genre_Id']); ?>" />
                    <select name="Genres" id="Genres"></select>
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="in_series">
                        In Series:
                    </label>
                    <?php
                        if(htmlspecialchars($book['In_Series'])=="YES")
                        {
                    ?>
                    <input id="in_series" name="in_series" type="checkbox" checked />
                    <?php
                        }
                        else
                        {
                    ?>
                    <input id="in_series" name="in_series" type="checkbox" />
                    <?php
                        }
                    ?>
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="series">
                        Series: <?php echo htmlspecialchars($book['Series']); ?>
                    </label>
                    <input id="seriesid" name="series_id" type="hidden" value="<?php echo htmlspecialchars($book['Series_Id']); ?>" />
                    <select name="Series" id="Series"></select>
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" name="number_in_series" for="number_in_series">
                        Number in Series:
                    </label>
                    <input id="number" name="number_in_series" type="text" value="<?php echo htmlspecialchars($book['Number_In_Series']); ?>" />
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="isbn">
                        ISBN:
                    </label>
                    <input id="isbn" name="isbn" type="text" value="<?php echo htmlspecialchars($book['ISBN']); ?>" />
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="pages">
                        Pages:
                    </label>
                    <input id="pages" name="pages" type="text" value="<?php echo htmlspecialchars($book['Pages']); ?>" />
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="copyright">
                        Copyright:
                    </label>
                    <input id="copyright" name="copyright" type="text" value="<?php echo htmlspecialchars($book['Copyright']); ?>" />
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="description">
                        Description: <?php echo htmlspecialchars($book['Description']); ?>
                    </label>
                    <input id="description" name="description" type="text" value="<?php echo htmlspecialchars($book['Description']); ?>" />
                    <br />
                </div>

            </fieldset>
            <?php endforeach; ?>
            <?php endif; ?>
            <div class="button-bar">
                <a href="List.php" class="btn btn-small btn-info button" role="button">Back to List</a>
                <input type="submit" class="btn btn-small btn-primary button" role="button" value="Save" name="Save" />
            </div>
        </div>
    </form>      
</body>
</html>