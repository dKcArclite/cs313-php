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
    // get all authors
    $genres = $bookDB->get_genres($pdo);
}
catch (\PDOException $e) {
    echo $e->getMessage();
}

$genre_id = 0;

//if (isset($_POST['btnView']) && !empty($_SESSION["Book_Id"])) {
//    unset($_SESSION["Book_Id"]);
//    $_SESSION["Book_Id"] = $_POST['btnView'];
//    header("Location: View.php");
//    die();
//} elseif(isset($_POST['btnView']))
//{
//    $_SESSION["Book_Id"] = $_POST['btnView'];
//    header("Location: View.php");
//    die();
//}

?>
<html>
<head>
    <title>
        Genres List
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet' />
    <link href="css/project1.css" type="text/css" rel="stylesheet" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" />
    <script src="js/project1.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
    <script>
                $(document).ready(function() {
                    $('#genres').dataTable();
                });
    </script>

</head>
<body>
    <div class="container masthead">
        <div class="logo">
            <img src="images/logo.png" alt="Books by Rick" width="207" height="75" />
        </div>
        <div class="navbar  navbar-static-top">
            <ul>
                <li>
                    <a href="List.php">Books</a>
                </li>
                <li>
                    <a href="Authors.php">Authors</a>
                </li>
                <li>
                    <a href="Series.php">Series</a>
                </li>
                <li>
                    <a class="active" href="Genres.php">Genres</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <button type="button" class="btn btn-small btn-danger btn-rick" value="0" data-toggle="modal" data-target="#modelAdd" data-backdrop="static" data-keyboard="false">Add Genre</button>
                </li>
            </ul>
        </div>
    </div>
    <div class="container">
        <br />
        <table id="genres" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="hide">Genre Id</th>
                    <th>Genre</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="hide">Genre Id</th>
                    <th>Genre</th>
                    <th>Edit</th>
                </tr>
            </tfoot>
            <tbody>
                <?php if (count($genres)): ?>
                <?php foreach ($genres as $key => $genre):
                          $genre_id = $genre['id'] ?>
                <tr>
                    <td class="hide">
                        <?php echo htmlspecialchars($genre['id']) ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($genre['text']); ?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-small btn-primary button btn-rick" value="<?=$genre_id?>" data-toggle="modal" data-target="#modelEdit" data-backdrop="static" data-keyboard="false">Edit</button>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="modelEdit" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Genre</h4>
                </div>
                <div class="modal-body">
                    <p>Coming next week</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modelAdd" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Genre</h4>
                </div>
                <div class="modal-body">
                    <p>Coming next week</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
