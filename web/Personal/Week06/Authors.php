<?php
session_start();

require 'Includes/dbcon.php';
require 'Includes/BooksDB.php';
require 'Includes/Common.php';

use SQLData\Common as Common;

$authors = Common::get_data('get_authors');
$author_id = 0;

?>
<html>
<head>
    <title>
        Authors List
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
    <script src="js/Authors.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/> 
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
                        <a class="active" href="Authors.php">Authors</a>
                    </li>
                    <li>
                        <a href="Series.php">Series</a>
                    </li>
                    <li>
                        <a href="Genres.php">Genres</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <button type="button" class="btn btn-small btn-danger btn-rick" value="0" data-toggle="modal" data-target="#modelAdd" data-backdrop="static" data-keyboard="false">Add Author</button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container">
            <br />
            <table id="authors" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="hide">Author Id</th>
                        <th>Author</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="hide">Author Id</th>
                        <th>Author</th>
                        <th>Edit</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php if (count($authors)): ?>
                    <?php foreach ($authors as $key => $author):
                          $author_id = $author['id'] ?>
                    <tr>
                        <td class="hide">
                            <?php echo htmlspecialchars($author['id']) ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($author['text']); ?>
                        </td>
                        <td>
                            <button type="button" name="btnView" id="btnView" class="btn btn-small btn-primary button btn-rick btnOpenModal" value="<?=$author_id?>" data-toggle="modal" data-target="#modelEdit" data-backdrop="static" data-keyboard="false">Edit</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <form action="ProcessAuthors.php?action=update" class="form-inline" method="post">
            <div class="modal fade" id="modelEdit" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit Author</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="author_id" id="author_id" readonly/>
                            <br />
                            First Name: 
                            <input type="text" name="first_name" id="first_name" class="letter-only" required maxlength="50" />
                            <br />
                            Middle Name:
                            <input type="text" name="middle_name" id="middle_name" class="letter-only" maxlength="50" />
                            <br />
                            Last Name:
                            <input type="text" name="last_name" id="last_name" class="letter-only" required maxlength="50" />
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-default" value="Submit">Submit</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <form action="ProcessAuthors.php?action=add" class="form-inline" method="post">
            <div class="modal fade" id="modelAdd" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add Author</h4>
                        </div>
                        <div class="modal-body">
                            First Name:
                            <input type="text" name="first_name" required/>
                            <br />
                            Middle Name:
                            <input type="text" name="middle_name" />
                            <br />
                            Last Name:
                            <input type="text" name="last_name" required/>
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
