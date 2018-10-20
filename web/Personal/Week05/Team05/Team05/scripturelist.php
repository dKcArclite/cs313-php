<!DOCTYPE html>
<html>
<head>
 <title>Scripture Resources</title>
 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="script.js"></script> 
</head>

<body>

<?php

require_once "./includes/connect_db.php";

$searchVal = "";
if(empty($_POST["txtSearch"])){
	$searchVal = "";
}
else {
	$searchVal = htmlspecialchars($_POST["txtSearch"]);
}
?>


<form id="frmSearch" action="scripturelist.php" method="post">
<div class="container">

<h1>Scripture Resources</h1>
<div class="form-group">
  <label for="description">Search Book:</label>
  <input name="txtSearch" class="form-control" id="search" value="<?=$searchVal?>"/><input type="submit" class="btn btn-primary" value="Search"/>
</div>
</form>
<form id="frmScriptureList" action="scripture_detail.php" method="post">
<input type="hidden" name="selectedId" id="selected_id" value="">
<?php
$searchVal = '%' . $searchVal . '%';
$statement = $con->prepare("SELECT id, book, chapter, verse,content FROM scriptures WHERE lower(book) LIKE lower(:searchValue)");
$statement->execute(array(':searchValue' => $searchVal));

// Go through each result
while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{
	$id = $row['id'] ;
	echo '<p>';
	echo '<a href="javascript:submitForm(' . $id . ');"><strong>' . $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'] . '</strong></a>';
	echo '</p>';
}
?>
</form>




</div>

</body>

</html> 