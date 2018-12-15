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
                <div class="row">
                    <label class="control-label col-sm-2 text-right">
                        Title:
                    </label>
                    <div class="col-sm-2">
                        <?php echo htmlspecialchars($book['Title']); ?>
                    </div>
                </div>
                <div class="row">
                    <label class="control-label col-sm-2 text-right">
                        Author:
                    </label>
                    <div class="col-sm-2">
                        <?php echo htmlspecialchars($book['Author']); ?>
                    </div>
                </div>
                <div class="row">
                    <label class="control-label col-sm-2 text-right">
                        Format:
                    </label>
                    <div class="col-sm-2">
                        <?php echo htmlspecialchars($book['Format']); ?>
                    </div>
                </div>
                <div class="row">
                    <label class="control-label col-sm-2 text-right">
                        Genre:
                    </label>
                    <div class="col-sm-2">
                        <?php echo htmlspecialchars($book['Genre']); ?>
                    </div>
                </div>
                <div class="row">
                    <label class="control-label col-sm-2 text-right">
                        In Series:
                    </label>
                    <div class="col-sm-2">
                        <?php echo htmlspecialchars($book['In_Series']); ?>
                    </div>
                </div>
                <div class="row">
                    <label class="control-label col-sm-2 text-right">
                        Series:
                    </label>
                    <div class="col-sm-2">
                        <?php echo htmlspecialchars($book['Series']); ?>
                    </div>
                </div>
                <div class="row">
                    <label class="control-label col-sm-2 text-right">
                        Number in Series:
                    </label>
                    <div class="col-sm-2">
                        <?php echo htmlspecialchars($book['Number_In_Series']); ?>
                    </div>
                </div>
                <div class="row">
                    <label class="control-label col-sm-2 text-right">
                        ISBN:
                    </label>
                    <div class="col-sm-2">
                        <?php echo htmlspecialchars($book['ISBN']); ?>
                    </div>
                </div>
                <div class="row">
                    <label class="control-label col-sm-2 text-right">
                        Pages:
                    </label>
                    <div class="col-sm-2">
                        <?php echo htmlspecialchars($book['Pages']); ?>
                    </div>
                </div>
                <div class="row">
                    <label class="control-label col-sm-2 text-right">
                        Copyright:
                    </label>
                    <div class="col-sm-2">
                        <?php echo htmlspecialchars($book['Copyright']); ?>
                    </div>
                </div>
                <div class="row">
                    <label class="control-label col-sm-2 text-right">
                        Description:
                    </label>
                    <div class="col-sm-5">
                        <?php echo htmlspecialchars($book['Description']); ?>
                    </div>
                </div>
                <br/>
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