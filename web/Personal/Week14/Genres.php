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

use SQLData\BooksDB as BooksDB;
use PostgreSQL\Connection as Connection;
use SQLData\Common as Common;

$genres = Common::get_data('get_genres');
$genre_id = 0;

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
    <link href="css/forms.css" type="text/css" rel="stylesheet" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" />
    <script src="js/project1.js"></script>
    <script src="js/Genres.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>

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
                <li>
                    <a href="https://dkcarclite-node.herokuapp.com/GetBooks.html">Google Book Search</a>
                </li>
            </ul>
            <div class="form-row">
                <div class="pull-right">
                    <button type="button" class="btn btn-small btn-danger btn-add" value="0" data-toggle="modal" data-target="#modelAdd" data-backdrop="static" data-keyboard="false">Add Genre</button>
                </div>
            </div>
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
                        <button type="button" name="btnView" id="btnView" class="btn btn-small btn-primary button btn-rick btnOpenModal" value="<?=$genre_id?>" data-toggle="modal" data-target="#modelEdit" data-backdrop="static" data-keyboard="false">Edit</button>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <form action="ProcessGenres.php?action=update" class="form-labels-on-top" method="post">
        <div class="modal fade" id="modelEdit" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Genre</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="genre_id" id="genre_id" readonly />
                        <div class="form-row">
                            <label>
                                <span>Genre:</span>
                                <input type="text" name="genre" id="genre" class="letter-only" required maxlength="100" />
                            </label>
                        </div>
                        <div class="form-row">
                            <label>
                                <span>Description:</span>
                                <textarea name="description" id="description" maxlength="1000"></textarea>                                
                            </label>
                            <span id="chars">1000</span> characters remaining
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default" value="Submit">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form action="ProcessGenres.php?action=add" class="form-labels-on-top" method="post">
        <div class="modal fade" id="modelAdd" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Genre</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <label>
                                <span>Genre:</span>
                                <input type="text" name="genre" required maxlength="100" />
                            </label>
                        </div>
                        <div class="form-row">
                            <label>
                                <span>Description:</span>
                                <textarea name="description" id="description_add" maxlength="1000"></textarea>                                
                            </label>
                            <span id="chars_add">1000</span> characters remaining
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default" value="Submit">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
