<?php
session_start();

require 'Includes/dbcon.php';
include 'BooksDB.php';

use SQLData\BooksDB as BooksDB;
use PostgreSQL\Connection as Connection;

try {
    // connect to the PostgreSQL database
    $pdo = Connection::get()->get_db();
    // 
    $bookDB = new BooksDB($pdo);
    // get all books data
    $books = $bookDB->get_books($pdo);
}
catch (\PDOException $e) {
    echo $e->getMessage();
}

$book_id = 0;

if (isset($_POST['btnView']) && !empty($_SESSION["Book_Id"])) {
    unset($_SESSION["Book_Id"]);
    $_SESSION["Book_Id"] = $_POST['btnView'];
    header("Location: View.php");
    die();
} elseif(isset($_POST['btnView']))
{
    $_SESSION["Book_Id"] = $_POST['btnView'];
    header("Location: View.php");
    die();
}

?>
<html>
<head>
    <title>
        Books List
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
    <link href="css/project1.css" type="text/css" rel="stylesheet" />
	<!-- DataTables CSS -->
	<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
    <script src="js/project1.js"></script>
				<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/> 
			<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#books').dataTable();
                });
            </script>	
</head>
<body>
<div class="container masthead">
	<div class="logo">
		<img src="images/logo.png" alt="Books by Rick" width="207" height="75" />
	</div>
    <div class="navbar  navbar-static-top">
        <div class="container-fluid">
            <ul>
              <li><a class="active" href="List.php">Books</a></li>
              <li><a href="Authors.php">Authors</a></li>
              <li><a href="Series.php">Series</a></li>
              <li><a href="Genres.php">Genres</a></li>
            </ul>    
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="Add.php" type="button" class="btn btn-small btn-danger btn-rick" name="btnAdd" value="0" role="button">Add Book</a>
                </li>
            </ul>        
        </div>
    </div>
</div>
<div class="container">
<br/>
<form method="post" id="List" action="List.php">
<table id="books" class="display" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th class="hide">Book Id</th>
			<th>Title</th>
			<th>Author</th>
			<th>Format</th>
			<th>Genre</th>
			<th>In Series</th>
			<th>Series</th>  
			<th>View</th>				
		</tr>
	</thead>
			<tfoot>
				<tr>
					<th class="hide">Book Id</th>
					<th>Title</th>
					<th>Author</th>
					<th>Format</th>
					<th>Genre</th>
					<th>In Series</th>
					<th>Series</th>
					<th>View</th>
				</tr>
			</tfoot>
			<tbody>
				<?php if (count($books)): ?>
					<?php foreach ($books as $key => $book): $book_id = $book['Book_Id'] ?>
						<tr>
							<td class="hide"><?php echo htmlspecialchars($book['Book_Id']) ?></td>
							<td><?php echo htmlspecialchars($book['Title']); ?></td>
							<td><?php echo htmlspecialchars($book['Author']); ?></td>
							<td><?php echo htmlspecialchars($book['Format']); ?></td>
							<td><?php echo htmlspecialchars($book['Genre']); ?></td>
							<td><?php echo htmlspecialchars($book['In_Series']); ?></td>
							<td><?php echo htmlspecialchars($book['Series']); ?></td>
							<td><button class="btn btn-small btn-primary btn-rick" type="submit" id="btnView" name="btnView" value="<?=$book_id?>">View</button></td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
	</table>
</form>
</div>

</body>
</html>