<!DOCTYPE html>
<html>
<head>
 <title>Scripture Details</title>
 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>

<?php
require_once "./includes/connect_db.php";

$id = -1;
if(!empty($_POST["selectedId"])){
	$id = htmlspecialchars($_POST["selectedId"]);
}
?>
<form id="frmScriptureList" action="scripture_detail.php" method="post">
<div class="container">

<h1>Scripture Details</h1>
<?php
$statement = $con->prepare("SELECT id, book, chapter, verse,content FROM scriptures WHERE id =:id");
$statement->execute(array(':id' => $id));

// Go through each result
while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{
	$id = $row['id'] ;
	echo '<p>';
	echo '<strong>' . $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'] . '</strong>' . ' - ' . $row['content']  ;
	echo '</p>';
}
?>
</tbody>
</table>





</div>
</form>
</body>

</html> 