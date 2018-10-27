<?php
session_start();

require 'Includes/dbcon.php';
include 'Includes/BooksDB.php';
include 'Includes/Common.php';

use SQLData\Common as Common;

$book_id = 0;


if(!empty($_SESSION["Book_Id"])) {
	$book_id = $_SESSION["Book_Id"];
}
else
{
	$book_id = $_SESSION["Book_Id"];
}

$books = Common::get_data_by_id('get_book', $book_id);

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
</head>
<body>
<div class="container masthead">
	<div class="logo">
		<img src="images/logo.png" alt="Books by Rick" width="207" height="75" />

	</div>
	<div class="searchbar">
	</div>
</div>
<div class="container">
<br/>
	<?php if (count($books)): ?>
		<?php foreach ($books as $key => $book): ?>		
			<fieldset>
				<div class="form-group">
					<label class="control-label col-sm-10" for="title">
						Title: <?php echo htmlspecialchars($book['Title']); ?>
					</label>
					<br/>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-10" for="author">
						Author: <?php echo htmlspecialchars($book['Author']); ?>
					</label>
					<br/>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-10" for="format">
						Format: <?php echo htmlspecialchars($book['Format']); ?>
					</label>
					<br/>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-10" for="genre">
						Genre: <?php echo htmlspecialchars($book['Genre']); ?>
					</label>
					<br/>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-10" for="in_series">
						In Series: <?php echo htmlspecialchars($book['In_Series']); ?>
					</label>
					<br/>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-10" for="series">
						Series: <?php echo htmlspecialchars($book['Series']); ?>
					</label>
					<br/>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-10" for="number_in_series">
						Number in Series: <?php echo htmlspecialchars($book['Number_In_Series']); ?>
					</label>
					<br/>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-10" for="isbn">
						ISBN: <?php echo htmlspecialchars($book['ISBN']); ?>
					</label>
					<br/>
				</div>				
				<div class="form-group">
					<label class="control-label col-sm-10" for="pages">
						Pages: <?php echo htmlspecialchars($book['Pages']); ?>
					</label>
					<br/>
				</div>
				<div class="form-group">
                    <label class="control-label col-sm-10" for="copyright">
                        Copywrite: <?php echo htmlspecialchars($book['Copyright']); ?>
                    </label>
					<br/>
				</div>	
				<div class="form-group">
					<label class="control-label col-sm-10" for="description">
						Description: <?php echo htmlspecialchars($book['Description']); ?>
					</label>
					<br/>
				</div>				

			</fieldset>
		<?php endforeach; ?>
	<?php endif; ?>
	<div class="button-bar">
		<a href="List.php" class="btn btn-small btn-info button" role="button">Back to List</a>
		<a href="Edit.php" class="btn btn-small btn-primary button" role="button">Edit</a>
	</div>
</div>
</body>
</html>