<?php
session_start();

require 'Includes/dbcon.php';
require 'Includes/BooksDB.php';
require 'Includes/Common.php';

use SQLData\Common as Common;

$series = Common::get_data('get_series_all');
$authorsData = Common::get_data('get_authors');
$series_id = 0;

?>
<html>
<head>
    <title>
        Series List
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
    <script src="js/Series.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
    $(document).ready(function() {
        var authors = <?php echo json_encode($authorsData); ?>;
        var authorid = $('#authorid').val();

        $('#Authors').select2({
            data: authors,
            selectOnClose: true,
            tags: true,
            width: "20%",
            placeholder: "Select Author",
            allowClear: true
        });

        $('#Authors_add').select2({
            data: authors,
            selectOnClose: true,
            tags: true,
            width: "20%",
            placeholder: "Select Author",
            allowClear: true
        });

        $('#Authors').val(authorid).trigger("change");
        $('#Authors_add').val(authorid).trigger("change");
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
                    <a class="active"  href="Series.php">Series</a>
                </li>
                <li>
                    <a href="Genres.php">Genres</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <button type="button" class="btn btn-small btn-danger btn-rick" value="0" data-toggle="modal" data-target="#modelAdd" data-backdrop="static" data-keyboard="false">Add Series</button>
                </li>
            </ul>
        </div>
    </div>
    <div class="container">
        <br />
        <table id="series" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="hide">Series Id</th>
                    <th>Series</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="hide">Series Id</th>
                    <th>Series</th>
                    <th>Edit</th>
                </tr>
            </tfoot>
            <tbody>
                <?php if (count($series)): ?>
                <?php foreach ($series as $key => $series):
                          $series_id = $series['id'] ?>
                <tr>
                    <td class="hide">
                        <?php echo htmlspecialchars($series['id']) ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($series['text']); ?>
                    </td>
                    <td>
                        <button type="button" name="btnView" id="btnView" class="btn btn-small btn-primary button btn-rick btnOpenModal" value="<?=$series_id?>" data-toggle="modal" data-target="#modelEdit" data-backdrop="static" data-keyboard="false">Edit</button>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <form action="ProcessSeries.php?action=update" class="form-inline" method="post">
        <div class="modal fade" id="modelEdit" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Series</h4>
                    </div>
                    <div class="modal-body">
                        Author:
                        <input id="authorid" type="hidden" />
                        <select name="author_id" id="Authors"></select>
                        <br />
                        <input type="hidden" name="series_id" id="series_id" readonly/>
                        <br />
                        Series:
                        <input type="text" name="series" id="series_edit" class="letter-only" required maxlength="100" />
                        <br />
                        Description:
                        <textarea name="description" id="description" rows="5" maxlength="1000"></textarea>
                        <br />
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default" value="Submit">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form action="ProcessSeries.php?action=add" class="form-inline" method="post">
        <div class="modal fade" id="modelAdd" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Author</h4>
                    </div>
                    <div class="modal-body">
                        Author:
                        <input id="authorid" type="hidden" />
                        <select name="author_id" id="Authors_add"></select>
                        <br/>
                        Series:
                        <input type="text" name="series" required maxlength="100"/>
                        <br />
                        Description:
                        <textarea name="description" rows="5" maxlength="1000"></textarea>
                        <br />
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
