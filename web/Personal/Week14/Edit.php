<?php
session_start();
if (isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}
else
{
	header("Location: index.php");
    die();
}

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
			      tags: false,
			      width: "300px",
			      placeholder: "Select Author",
			      allowClear: true,     
                  theme:"classic"
		    });

		    $('#Formats').select2({
		          data: formats,
			      selectOnClose: true,
			      tags: true,
			      width: "300px",
			      placeholder: "Select Format",
			      allowClear: true,
			      theme:"classic"
		    });

		    $('#Genres').select2({
		        data: genres,
		        selectOnClose: true,
		        tags: true,
		        width: "300px",
		        placeholder: "Select Genre",
		        allowClear: true,
		        theme:"classic"
		    });

		    $('#Series').select2({
		        data: series,
		        selectOnClose: true,
		        tags: true,
		        width: "300px",
		        placeholder: "Select Series",
		        allowClear: true,
		        theme:"classic"
		    });

		    $('#Authors').val(authorid).trigger("change")
		    $('#Formats').val(formatid).trigger("change")
		    $('#Genres').val(genreid).trigger("change")
		    $('#Series').val(seriesid).trigger("change")

		    if($("#in_series").is(':checked'))
		        $(".SeriesGroup").show();  // checked
		    else
		        $(".SeriesGroup").hide();

		    $("#in_series").change(function() {
		        if($(this).prop('checked')) {
		            $(".SeriesGroup").show();
                    $("#in_series_hid").val('true');
		        } else {
                    $(".SeriesGroup").hide();
                    $("#in_series_hid").val('false');
 		        }
		    });
		});

        $(window).on('load', function () {
            updateCount();
        });

        function updateCount()
        {
            var length = $('#description').val().length;
            var length = 1000 - length;
            $('#chars').text(length);
        }
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
    <form  id="editBook" action="ProcessBooks.php?action=editBook" method="post">        
        <div class="container">
            <br />
            <?php if (count($books)): ?>
            <?php foreach ($books as $key => $book): ?>
            <fieldset>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="title">
                            Title:
                        </label>
                        <input id="title" class="form-control input-edit" type="text" name="title" value="<?php echo htmlspecialchars($book['Title']); ?>" required />
                    </div>
                    <div class="form-group">
                        <div>
                            <label for="author">
                                Author:
                            </label>
                        </div>
                        <input id="authorid" name="author_id" type="hidden" value="<?php echo htmlspecialchars($book['Author_Id']); ?>" />
                        <select name="Authors" id="Authors"></select>
                    </div>
                    <div class="form-group">
                        <div>
                            <label for="format">
                                Format:
                            </label>
                        </div>
                        <input id="formatid" name="format_id" type="hidden" value="<?php echo htmlspecialchars($book['Format_Id']); ?>" />
                        <select name="Formats" id="Formats"></select>
                    </div>
                    <div class="form-group">
                        <div>
                            <label class="control-label" for="genre">
                                Genre:
                            </label>
                        </div>
                        <input id="genreid" name="genre_id" type="hidden" value="<?php echo htmlspecialchars($book['Genre_Id']); ?>" />
                        <select class="form-control" name="Genres" id="Genres"></select>
                    </div>
                    <div class="form-group">
                        <div>
                            <label for="in_series">
                                In Series:
                            </label>
                        </div>
                        <?php
                        if(htmlspecialchars($book['In_Series'])=="YES")
                        {
                        ?>
                        <input id="in_series_hid" name="in_series_hid" type="hidden" value="true" />
                        <input id="in_series" name="in_series" type="checkbox" checked />
                        <?php
                        }
                        else
                        {
                        ?>                        
                        <input id="in_series" name="in_series" type="checkbox" />  
                        <input id="in_series_hid" name="in_series_hid" type="hidden" value="false" />
                        <?php
                        }
                        ?>
                        <br />
                    </div>
                    <div class="form-group SeriesGroup">
                        <div>
                            <label for="series">
                                Series:
                            </label>
                        </div>
                        <input id="seriesid" name="series_id" type="hidden" value="<?php echo htmlspecialchars($book['Series_Id']); ?>" />
                        <select name="Series" id="Series"></select>
                    </div>
                    <div class="form-group SeriesGroup">
                        <label name="number_in_series" for="number_in_series">
                            Number in Series:
                        </label>
                        <input class="number-only form-control input-edit" id="number" maxlength="3" name="number_in_series" type="text" value="<?php echo htmlspecialchars($book['Number_In_Series']); ?>" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="isbn">
                            ISBN:
                        </label>
                        <input class="form-control input-edit number-only" maxlength="13" id="isbn" name="isbn" type="text" value="<?php echo htmlspecialchars($book['ISBN']); ?>" />
                    </div>
                    <div class="form-group">
                        <label for="pages">
                            Pages:
                        </label>
                        <input class="form-control input-edit number-only" id="pages" name="pages" maxlength="4" type="text" value="<?php echo htmlspecialchars($book['Pages']); ?>" />
                    </div>
                    <div class="form-group">
                        <label for="copyright">
                            Copyright:
                        </label>
                        <input class="form-control input-edit number-only" id="copyright" maxlength="4" name="copyright" type="text" value="<?php echo htmlspecialchars($book['Copyright']); ?>" />
                    </div>
                    <div class="form-group">
                        <label for="description">
                            Description: 
                        </label>
                        <textarea class="textarea-edit form-control" id="description" maxlength="1000" name="description" type="text"><?php echo htmlspecialchars($book['Description']); ?></textarea>
                        <span id="chars">1000</span> characters remaining
                    </div>
                </div>
            </fieldset>
            <?php endforeach; ?>
            <?php endif; ?>
            <div class="button-bar">
                <a href="List.php" class="btn btn-small btn-info button" role="button">Back to List</a>
                <input type="submit" class="btn btn-small btn-primary button" role="button" value="Save" name="Save" />
                <!--<button type="button" class="btn btn-small btn-primary button btn-info" data-toggle="modal" data-target="#uploadModal">Upload Cover</button>-->
            </div>
        </div>
    </form>   
    <!-- Modal -->
    <div id="uploadModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">File upload form</h4>
                </div>
                <div class="modal-body">
                    <!-- Form -->
                    <form method='post' action='' enctype="multipart/form-data">
                        Select file :
                        <input type='file' name='file' id='file' class='form-control' />
                        <br />
                        <input type='button' class='btn btn-info' value='Upload' id='upload' />
                    </form>

                    <!-- Preview-->
                    <div id='preview'></div>
                </div>
            </div>
        </div>
    </div>
     
</body>
</html>