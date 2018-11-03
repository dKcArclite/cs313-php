<?php

require 'Includes/dbcon.php';
require 'Includes/BooksDB.php';
require 'Includes/Common.php';

use SQLData\Common as Common;


if(isset($_POST['function2call']) && !empty($_POST['function2call'])) {
    $function2call = $_POST['function2call'];
    switch($function2call) {
        case 'get_author' :
            $edit_author_id = $_POST['author_id'];
            $author_edit = Common::get_data_by_id('get_author', $edit_author_id);

            echo json_encode($author_edit);
            break;
        case 'get_series' :
            $edit_series_id = $_POST['series_id'];
            $series_edit = Common::get_data_by_id('get_series', $edit_series_id);

            echo json_encode($series_edit);
            break;
        case 'get_genre' :
            $edit_genre_id = $_POST['genre_id'];
            $genre_edit = Common::get_data_by_id('get_genre', $edit_genre_id);

            echo json_encode($genre_edit);
            break;
        case 'get_series_ajax' :
            $author_id = $_POST['author_id'];
            if($author_id != null && $author_id > 0)
            {
                $seriesData = Common::get_data_by_id('get_series', $author_id);
            }
            else
            {
                return '';
            }

            echo json_encode($seriesData);
            break;
        case 'get_series_by_id' :
            $edit_series_id = $_POST['series_id'];
            $series_edit = Common::get_data_by_id('get_series_by_id', $edit_series_id);

            echo json_encode($series_edit);
            break;
    }
}


?>