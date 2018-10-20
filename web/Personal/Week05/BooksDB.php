<?php

namespace SQLData;
/**
 * BooksDB short summary.
 *
 * BooksDB description.
 *
 * @version 1.0
 * @author rickj
 */
class BooksDB
{
    public function get_books($pdo) {
        $stmt =$pdo->query('SELECT b.book_id, '
                               .'  b.title, '
                               .'  a.first_name || COALESCE(\' \' || a.middle_name,\'\') || \' \' || a.last_name AS "author", '
                               .'  f.format, '
                               .'  g.genre, '
                               .' CASE WHEN b.is_series '
                               .'      THEN \'YES\' '
                               .'      ELSE \'NO\' '
                               .'  END AS "in_series", '
                               .'  s.series '
                               .' FROM book b '
                               .' INNER JOIN author a '
                               .'    ON b.author_id = a.author_id '
                               .' INNER JOIN genre g '
                               .'    ON b.genre_id = g.genre_id '
                               .' INNER JOIN format f '
                               .'    ON b.format_id = f.format_id '
                               .'  LEFT JOIN series s '
                               .'    ON b.series_id = s.series_id '
                               .' ORDER BY '
                               .'       s.series, '
                               .'       b.number_in_series');
        $books = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $books[] = [
                'Book_Id' => $row['book_id'],
                  'Title' => $row['title'],
                 'Author' => $row['author'],
                 'Format' => $row['format'],
                  'Genre' => $row['genre'],
              'In_Series' => $row['in_series'],
                 'Series' => $row['series']
                      ];
        }
        return $books;
    }

    public function get_book($pdo, $book_id) {
        $stmt =$pdo->prepare('SELECT b.book_id, '
                               .'  b.title, '
                               .'  b.author_id, '
                               .'  a.first_name || COALESCE(\' \' || a.middle_name,\'\') || \' \' || a.last_name AS "author", '
                               .'  b.format_id, '
                               .'  f.format, '
                               .'  b.genre_id, '
                               .'  g.genre, '
                               .' CASE WHEN b.is_series '
                               .'      THEN \'YES\' '
                               .'      ELSE \'NO\' '
                               .'  END AS "in_series", '
                               .'  b.series_id, '
                               .'  s.series, '
                               .'  b.number_in_series, '
                               .'  b.isbn, '
                               .'  b.pages, '
                               .'  b.copywrite, '
                               .'  b.description '
                               .' FROM book b '
                               .' INNER JOIN author a '
                               .'    ON b.author_id = a.author_id '
                               .' INNER JOIN genre g '
                               .'    ON b.genre_id = g.genre_id '
                               .' INNER JOIN format f '
                               .'    ON b.format_id = f.format_id '
                               .'  LEFT JOIN series s '
                               .'    ON b.series_id = s.series_id '
                               .' WHERE book_id=:book_id '
                               .' ORDER BY '
                               .'       s.series, '
                               .'       b.number_in_series');
        $stmt->execute(array(':book_id' => $book_id));
        $books = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $books[] = [
                'Book_Id' => $row['book_id'],
                  'Title' => $row['title'],
			  'Author_Id' => $row['author_id'],
                 'Author' => $row['author'],
			  'Format_Id' => $row['format_id'],
                 'Format' => $row['format'],
			   'Genre_Id' => $row['genre_id'],
                  'Genre' => $row['genre'],
              'In_Series' => $row['in_series'],
			  'Series_Id' => $row['series_id'],
                 'Series' => $row['series'],
	   'Number_In_Series' => $row['number_in_series'],
	               'ISBN' => $row['isbn'],
				  'Pages' => $row['pages'],
			  'Copywrite' => $row['copywrite'],
			'Description' => $row['description']
                       ];
        }
        return $books;
    }

    public function get_authors($pdo) {
        $stmt =$pdo->query('SELECT DISTINCT '
                                .' a.author_id, '
                                .' a.first_name || COALESCE(\' \' || a.middle_name,\'\') || \' \' || a.last_name AS "author" '
                          .'  FROM author a '
                          .' ORDER BY '
                          .'       "author"');
        $authors = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $authors[] = [
              'id' => $row['author_id'],
            'text' => $row['author']
                         ];
        }
        return $authors;
    }

    public function get_genres($pdo) {
        $stmt =$pdo->query('SELECT DISTINCT '
                                .' g.genre_id, '
                                .' g.genre '
                          .'  FROM genre g '
                          .' ORDER BY '
                          .'       g.genre');
        $genres = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $genres[] = [
              'id' => $row['genre_id'],
             'text' => $row['genre']
                         ];
        }
        return $genres;
    }

    public function get_formats($pdo) {
        $stmt =$pdo->query('SELECT DISTINCT '
                                .' f.format_id, '
                                .' f.format '
                          .'  FROM format f '
                          .' ORDER BY '
                          .'       f.format');
        $formats = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $formats[] = [
              'id' => $row['format_id'],
            'text' => $row['format']
                         ];
        }
        return $formats;
    }

    public function get_series($pdo, $author_id) {
        $stmt =$pdo->prepare('SELECT DISTINCT '
                                .' s.series_id, '
                                .' s.series '
                          .'  FROM series s '
                          .' WHERE s.author_id=:author_id '
                          .' ORDER BY '
                          .'       s.series');
        $stmt->execute(array(':author_id' => $author_id));
        $series = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $series[] = [
              'id' => $row['series_id'],
            'text' => $row['series']
                         ];
        }
        return $series;
    }

    public function get_series_all($pdo) {
        $stmt =$pdo->query('SELECT DISTINCT '
                                .' s.series_id, '
                                .' s.series '
                          .'  FROM series s '
                          .' ORDER BY '
                          .'       s.series');
        $series = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $series[] = [
              'id' => $row['series_id'],
            'text' => $row['series']
                         ];
        }
        return $series;
    }
}