<?php
session_start();

require 'Includes/dbcon.php';
require 'Includes/BooksDB.php';
require 'Includes/Common.php';

use SQLData\Common as Common;

$book_id = 0;
$author_id = 0;

$authorsData = Common::get_data('get_authors');
$formatsData = Common::get_data('get_formats');
$genresData = Common::get_data('get_genres');

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
    <link href="css/addBook.css" type="text/css" rel="stylesheet" />
    <script src="js/project1.js"></script>
    <script src="js/Validate.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src='//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.12.0/jquery.validate.js'></script>
    <script>
		$(document).ready(function() {

            var authors = <?php echo json_encode($authorsData); ?>;
			var formats = <?php echo json_encode($formatsData); ?>;
            var genres = <?php echo json_encode($genresData); ?>;
			var series;

		    var authorid = $('#authorid').val();
		    var formatid = $('#formatid').val();
		    var genreid = $('#genreid').val();
		    var seriesid = $('#seriesid').val();


		    $('#Authors').select2({
		        data: authors,
		        selectOnClose: true,
		        tags: true,
		        width: "8%",
		        placeholder: "Select Author",
		        allowClear: true

		    });

		    $('#Formats').select2({
		        data: formats,
		        selectOnClose: true,
		        tags: true,
		        width: "7%",
		        placeholder: "Select Format",
		        allowClear: true
		    });

		    $('#Genres').select2({
		        data: genres,
		        selectOnClose: true,
		        tags: true,
		        width: "12%",
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

		    $('#Authors').change(function() {
		        var author_id = $(this).val();
		        $.ajax({
		            type: "post",
		            url: "ProcessAjax.php",
		            data: {function2call: 'get_series_ajax', author_id:author_id},
		            cache: false,
		            success: function (data) {
		                if(data != null && data != '')
		                {
		                    var series = JSON.parse(data);
		                    setSeries(series);
		                }

		            },
		            error: function (err) {

		            }
		        });
		    });

		    function setSeries(series)
		    {
		        $("#Series").empty().select2({
		        });

		        $('#Series').select2({
		            data: series,
		            selectOnClose: true,
		            tags: true,
		            width: "10%",
		            placeholder: "Select Series",
		            allowClear: true
		        });
		    }

		    if($("#in_series").is(':checked'))
		        $("#SeriesGroup").show();  // checked
		    else
		        $("#SeriesGroup").hide();

		    $("#in_series").change(function() {
		        if($(this).prop('checked')) {
		            $("#SeriesGroup").show();
		        } else {
		            $("#Series").empty().select2({});
		            $("#SeriesGroup").hide();
		        }
		    });
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
    <form class="form-horizontal" id="addBook" action="ProcessBooks.php?action=addBook" method="post">
        <div class="container">
            <br />
            <fieldset>
                <div class="form-group">
                    <label class="control-label" for="title">
                        Title:
                    </label>
                    <input id="title" name="title" type="text" required maxlength="50" />
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="author">
                        Author:
                    </label>
                    <input id="authorid" type="hidden" />
                    <select name="author_id" id="Authors" class="required" required></select>
                    <br />
                </div>
                <div class="
                        form-group">
                        <label class="control-label" for="format">
                            Format:
                        </label>
                        <input id="formatid" type="hidden" />
                        <select name="format_id" id="Formats" required></select>
                        <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="genre">
                        Genre:
                    </label>
                    <input id="genreid" type="hidden" />
                    <select name="genre_id" id="Genres" required></select>
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="in_series">
                        In Series:
                    </label>
                    <input id="in_series" name="in_series" type="checkbox" />
                    <br />
                </div>
                <div class="form-group" id="SeriesGroup">
                    <label class="control-label" for="series">
                        Series:
                    </label>
                    <input id="seriesid" type="hidden" />
                    <select name="series_id" id="Series" required></select>
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="number_in_series">
                        Number in Series:
                    </label>
                    <input id="number" name="number_in_series" type="text" class="number-only" />
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="isbn">
                        ISBN:
                    </label>
                    <input id="isbn" name="isbn" type="text" maxlength="13" class="number-only" />
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="pages">
                        Pages:
                    </label>
                    <input id="pages" name="pages" type="text" class="number-only" />
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="copyright">
                        Copyright:
                    </label>
                    <input id="copyright" name="copyright" type="text" class="number-only" />
                    <br />
                </div>
                <div class="form-group">
                    <label class="control-label" for="description">
                        Description:
                    </label>
                    <textarea id="description" name="description" type="text" rows="5"></textarea>
                    <br />
                </div>
            </fieldset>
            <div class="button-bar">
                <a href="List.php" class="btn btn-small btn-info button" role="button">Back to List</a>
                <input type="submit" class="btn btn-small btn-primary button" role="button" value="Save" name="Save" />
            </div>
        </div>
    </form>
</body>
</html>