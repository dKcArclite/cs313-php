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
    <link href="css/validate.css" type="text/css" rel="stylesheet" />
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
		    var series;// = <?php echo json_encode($seriesData); ?>;

		    var authorid = $('#authorid').val();
		    var formatid = $('#formatid').val();
		    var genreid = $('#genreid').val();
		    var seriesid = $('#seriesid').val();


		    $('#Authors').select2({
		        data: authors,
		        selectOnClose: true,
		        tags: true,
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
		            width: "300px",
		            placeholder: "Select Series",
		            allowClear: true,
		            theme:"classic"
		        });
		    }

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
        <input type="hidden" id="page" value="addBook" />
        <div class="container">
            <br />
            <fieldset>
                <div class="col-md-4">
                <div class="form-group">
                    <label for="title">
                        Title:
                    </label>
                    <input id="title" class="form-control input-edit" name="title" type="text" required maxlength="50" />
                </div>
                <div class="form-group">
                    <div>
                        <label for="author">
                            Author:
                        </label>
                    </div>
                    <input id="authorid" type="hidden" />
                    <select name="author_id" id="Authors" class="required"></select>
                </div>
                <div class="form-group">
                    <div>
                        <label for="format">
                            Format:
                        </label>
                    </div>
                        <input id="formatid" type="hidden" />
                        <select name="format_id" id="Formats" required></select>
                </div>
                <div class="form-group">
                    <div>
                        <label for="genre">
                            Genre:
                        </label>
                    </div>
                    <input id="genreid" type="hidden" />
                    <select name="Genres" id="Genres" required></select>
                </div>
                <div class="form-group">
                    <div>
                        <label for="in_series">
                            In Series:
                        </label>
                    </div>
                    <input id="in_series_hid" name="in_series_hid" type="hidden" value="false" />
                    <input id="in_series" name="in_series" type="checkbox" />
                </div>
                    <div class="form-group SeriesGroup" id="SeriesGroup">
                        <div>
                            <label for="series">
                                Series:
                            </label>
                        </div>
                        <input id="seriesid" type="hidden" />
                        <select name="series_id" id="Series" required></select>
                    </div>
                    <div class="form-group SeriesGroup">
                        <label for="number_in_series">
                            Number in Series:
                        </label>
                        <input id="number" class="form-control input-edit number-only" name="number_in_series" type="text" />
                    </div> 
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="isbn">
                        ISBN:
                    </label>
                      <input id="isbn" name="isbn" type="text" maxlength="13" class="form-control input-edit number-only" />
                </div>
                <div class="form-group">
                    <label class="control-label" for="pages">
                        Pages:
                    </label>
                    <input id="pages" name="pages" type="text" class="form-control input-edit number-only" />
                </div>
                <div class="form-group">
                    <label class="control-label" for="copyright">
                        Copyright:
                    </label>
                    <input id="copyright" name="copyright" type="text" class="form-control input-edit number-only" />
                </div>
                <div class="form-group">
                    <label class="control-label" for="description">
                        Description:
                    </label>
                    <textarea id="description" class="textarea-edit form-control" name="description" type="text" rows="5"></textarea>
                </div>
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