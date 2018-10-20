<?php
session_start();

require 'Includes/dbcon.php';
include 'BooksDB.php';

use SQLData\BooksDB as BooksDB;
use PostgreSQL\Connection as Connection;

$book_id = 0;
$author_id = 0;


//if(isset($_POST['function2call']) && !empty($_POST['function2call'])) {
//    $function2call = $_POST['function2call'];
//    switch($function2call) {
//        case 'get_series_ajax' :
//            $author_id = $_POST['author_id'];
//            $seriesData = get_data_by_id('get_series', $author_id);
//    }
//}

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

$authorsData = get_data('get_authors');
$formatsData = get_data('get_formats');
$genresData = get_data('get_genres');
//$seriesData = get_data_by_id('get_series',$author_id);

$seriesData = get_data('get_series_all');

//if($author_id > 0)
//{
//    $seriesData = get_data_by_id('get_series', $author_id);
//}
//$seriesData = get_data('get_series_all');

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

		    $('#Authors').val(authorid).trigger("change");
		    $('#Formats').val(formatid).trigger("change");
		    $('#Genres').val(genreid).trigger("change");
		    $('#Series').val(seriesid).trigger("change");

		    //$('#Authors').change(function() {
		    //    var id = $('#Authors').val();
		    //    //alert(id);
		    //    $.ajax({ url: 'Add.php',
		    //        dataType: "json",
		    //        data: {function2call: 'get_series_ajax', author_id:id},
		    //        type: 'post',
		    //        success: function() {
		    //            setSeries();
		    //        }
		    //    });
		    //});

		    //function setSeries()
		    //{
        	////	

		    //    $('#Series').select2({
		    //        data: series,
		    //        selectOnClose: true,
		    //        tags: true,
		    //        width: "10%",
		    //        placeholder: "Select Series",
		    //        allowClear: true
		    //    });
		    //}    
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
    <form class="form-horizontal" method="post">
        <div class="container">
            <br />
            <fieldset>
                <div class="form-group">
                    <label class="control-label" for="title">
                        Title:
                    </label>
                    <input id="title" type="text" value="" />
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="author">
                        Author:
                    </label>
                    <input id="authorid" type="hidden" value="" />
                    <select name="Authors" id="Authors"></select>
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="format">
                        Format:
                    </label>
                    <input id="formatid" type="hidden" value="" />
                    <select name="Formats" id="Formats"></select>
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="genre">
                        Genre:
                    </label>
                    <input id="genreid" type="hidden" value="" />
                    <select name="Genres" id="Genres"></select>
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="in_series">
                        In Series:
                    </label>
                 <input id="in_series" type="checkbox" />
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="series">
                        Series:
                    </label>
                    <input id="seriesid" type="hidden" value="" />
                    <select name="Series" id="Series"></select>
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="number_in_series">
                        Number in Series:
                    </label>
                    <input id="number" type="text" value="" />
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="isbn">
                        ISBN:
                    </label>
                    <input id="isbn" type="text" value="" />
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="pages">
                        Pages:
                    </label>
                    <input id="pages" type="text" value="" />
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="copywrite">
                        Copyright:
                    </label>
                    <input id="copyright" type="text" value="" />
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="description">
                        Description:
                    </label>
                    <input id="description" type="text" value="" />
                    <br />
                </div>

            </fieldset>
            <div class="button-bar">
                <a href="List.php" class="btn btn-small btn-info button" role="button">Back to List</a>
                <!--<a href="Edit.php" class="btn btn-small btn-primary button" role="button" type="submit" name="Save">Save</a>-->
            </div>
        </div>
    </form>
</body>
</html>