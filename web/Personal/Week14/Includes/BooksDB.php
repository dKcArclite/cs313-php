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
                               .'       b.title ');
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
                               .'  b.copyright, '
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
			  'Copyright' => $row['copyright'],
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

    public function get_series_ajax($pdo, $author_id) {
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
        // return $series;
        return json_encode($series);
    }

    public function get_series_by_id($pdo, $series_id) {
        try{
            // prepare SELECT statement
            $stmt =$pdo->prepare("SELECT series_id, "
                                     . " author_id, "
                                     . " series, "
                                     ."  description "
                                 ." FROM series "
                                 ." WHERE series_id = :series_id");
            // bind value to the :id parameter
            $stmt->bindValue(':series_id', $series_id);

            // execute the statement
            $stmt->execute();

            // return the result set as an object
            return $stmt->fetchObject();
        }
        catch (\PDOException $e) {
            header('Location: Error.php?errormessage='.urlencode($e->getMessage()));
            die();

        }
    }

    public function insert_author($pdo, $author) {
        $success = false;

        try{
            $stmt =$pdo->prepare('INSERT INTO author '
                                   . '(first_name, '
                                   . ' middle_name, '
                                   . ' last_name) '
                                   . ' VALUES '
                                   . ' (:first_name, '
                                   . '  :middle_name,'
                                   . '  :last_name)'
                                );
            $stmt->bindValue(':first_name', $author->first_name);
            $stmt->bindValue(':middle_name', $author->middle_name);
            $stmt->bindValue(':last_name', $author->last_name);
            $stmt->execute();

            }
                catch (\PDOException $e) {
                    header('Location: Error.php?errormessage='.urlencode($e->getMessage()));
                    die();

            }
        $success = true;

        return $success;
    }

    public function update_author($pdo, $author) {
        try{
            $stmt =$pdo->prepare('UPDATE author '
                                   . ' SET first_name = :first_name, '
                                   . ' middle_name = :middle_name, '
                                   . ' last_name = :last_name '
                                   . ' WHERE author_id = :author_id'
                                );
            $stmt->bindValue(':author_id', $author->author_id);
            $stmt->bindValue(':first_name', $author->first_name);
            $stmt->bindValue(':middle_name', $author->middle_name);
            $stmt->bindValue(':last_name', $author->last_name);
            $stmt->execute();

        }
        catch (\PDOException $e) {
            header('Location: Error.php?errormessage='.urlencode($e->getMessage()));
            die();

        }

        return $stmt->rowCount();
    }

    public function get_author($pdo, $author_id) {
        try{
            // prepare SELECT statement
            $stmt =$pdo->prepare("SELECT author_id, "
                                 ."first_name, "
                                 ."COALESCE(middle_name,'') as middle_name, "
                                 ." last_name "
                                 ." FROM author "
                                 ." WHERE author_id = :author_id");
            // bind value to the :id parameter
            $stmt->bindValue(':author_id', $author_id);

            // execute the statement
            $stmt->execute();

            // return the result set as an object
            return $stmt->fetchObject();
        }
        catch (\PDOException $e) {
            header('Location: Error.php?errormessage='.urlencode($e->getMessage()));
            die();

        }
    }

    public function insert_series($pdo, $series) {
        $success = false;

        try{
            $stmt =$pdo->prepare('INSERT INTO series '
                                   . '(author_id, '
                                   . ' series, '
                                   . ' description) '
                                   . ' VALUES '
                                   . ' (:author_id, '
                                   . '  :series,'
                                   . '  :description)'
                                );
            $stmt->bindValue(':author_id', $series->author_id);
            $stmt->bindValue(':series', $series->series);
            $stmt->bindValue(':description', $series->description);
            $stmt->execute();

        }
        catch (\PDOException $e) {
            header('Location: Error.php?errormessage='.urlencode($e->getMessage()));
            die();

        }
        $success = true;

        return $success;
    }

    public function insert_author_alt($pdo, $author) {

        try{
            $stmt =$pdo->prepare('INSERT INTO author '
                                   . '(first_name, '
                                   . ' middle_name, '
                                   . ' last_name) '
                                   . ' VALUES '
                                   . ' (:first_name, '
                                   . '  :middle_name, '
                                   . '  :last_name) RETURNING author_id'
                                );
            $stmt->bindValue(':first_name', $author->first_name);
            $stmt->bindValue(':middle_name', $author->middle_name);
            $stmt->bindValue(':last_name', $author->last_name);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        }
        catch (\PDOException $e) {
            header('Location: Error.php?errormessage='.urlencode($e->getMessage()));
            die();

        }

        return $result['author_id'];
    }

    public function insert_series_alt($pdo, $series) {
        try{
            $stmt =$pdo->prepare('INSERT INTO series '
                                   . '(author_id, '
                                   . ' series) '
                                   . ' VALUES '
                                   . ' (:author_id, '
                                   . '  :series) RETURNING series_id'
                                );
            $stmt->bindValue(':author_id', $series->author_id);
            $stmt->bindValue(':series', $series->series);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        }
        catch (\PDOException $e) {
            header('Location: Error.php?errormessage='.urlencode($e->getMessage()));
            die();

        }

        return $result['series_id'];
    }

    public function update_series($pdo, $series) {
        try{
            $stmt =$pdo->prepare('UPDATE series '
                                 . ' SET author_id = :author_id, '
                                     . ' series = :series, '
                                     . ' description = :description '
                               . ' WHERE series_id = :series_id'
                                );
            $stmt->bindValue(':series_id', $series->series_id);
            $stmt->bindValue(':author_id', $series->author_id);
            $stmt->bindValue(':series', $series->series);
            $stmt->bindValue(':description', $series->description);
            $stmt->execute();

        }
        catch (\PDOException $e) {
            header('Location: Error.php?errormessage='.urlencode($e->getMessage()));
            die();

        }

        return $stmt->rowCount();
    }

    public function insert_genre($pdo, $genre) {
        $success = false;

        try{
            $stmt =$pdo->prepare('INSERT INTO genre '
                                   . '(genre, '
                                   . ' description) '
                                   . ' VALUES '
                                   . ' (:genre, '
                                   . '  :description)'
                                );
            $stmt->bindValue(':genre', $genre->genre);
            $stmt->bindValue(':description', $genre->description);
            $stmt->execute();

        }
        catch (\PDOException $e) {
            header('Location: Error.php?errormessage='.urlencode($e->getMessage()));
            die();

        }
        $success = true;

        return $success;
    }

    public function update_genre($pdo, $genre) {
        try{
            $stmt =$pdo->prepare('UPDATE genre '
                                   . ' SET genre = :genre, '
                                   . ' description = :description '
                                   . ' WHERE genre_id = :genre_id'
                                );
            $stmt->bindValue(':genre_id', $genre->genre_id);
            $stmt->bindValue(':genre', $genre->genre);
            $stmt->bindValue(':description', $genre->description);
            $stmt->execute();

        }
        catch (\PDOException $e) {
            header('Location: Error.php?errormessage='.urlencode($e->getMessage()));
            die();

        }

        return $stmt->rowCount();
    }

    public function get_genre($pdo, $genre_id) {
        try{
            // prepare SELECT statement
            $stmt =$pdo->prepare("SELECT genre_id, "
                                 ."genre, "
                                 ." description "
                                 ." FROM genre "
                                 ." WHERE genre_id = :genre_id");
            // bind value to the :id parameter
            $stmt->bindValue(':genre_id', $genre_id);

            // execute the statement
            $stmt->execute();

            // return the result set as an object
            return $stmt->fetchObject();
        }
        catch (\PDOException $e) {
            header('Location: Error.php?errormessage='.urlencode($e->getMessage()));
            die();

        }
    }

    public function insert_book($pdo, $book) {
        try{
            $stmt =$pdo->prepare('INSERT INTO book '
                                   . '(author_id, '
                                   . ' format_id, '
                                   . ' genre_id, '
                                   . ' is_series, '
                                   . ' series_id, '
                                   . ' number_in_series, '
                                   . ' title, '
                                   . ' isbn, '
                                   . ' pages, '
                                   . ' copyright, '
                                   . ' description) '
                                   . ' VALUES '
                                   . '(:author_id, '
                                   . ' :format_id, '
                                   . ' :genre_id, '
                                   . ' :is_series, '
                                   . ' :series_id, '
                                   . ' :number_in_series, '
                                   . ' :title, '
                                   . ' :isbn, '
                                   . ' :pages, '
                                   . ' :copyright, '
                                   . ' :description) RETURNING book_id'
                                );
            $stmt->bindValue(':author_id', $book->author_id);
            $stmt->bindValue(':format_id', $book->format_id);
            $stmt->bindValue(':genre_id', $book->genre_id);
            $stmt->bindValue(':is_series', $book->is_series);
            $stmt->bindValue(':series_id', $book->series_id);
            $stmt->bindValue(':number_in_series', $book->number_in_series);
            $stmt->bindValue(':title', $book->title);
            $stmt->bindValue(':isbn', $book->isbn);
            $stmt->bindValue(':pages', $book->pages);
            $stmt->bindValue(':copyright', $book->copyright);
            $stmt->bindValue(':description', $book->description);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        }
        catch (\PDOException $e) {
            header('Location: Error.php?errormessage='.urlencode($e->getMessage()));
            die();

        }

        return $result['book_id'];
    }

    public function update_book($pdo, $book) {
        try{
            $stmt =$pdo->prepare('UPDATE book '
                                   . ' SET author_id = :author_id, '
                                   . ' format_id = :format_id, '
                                   . ' genre_id = :genre_id, '
                                   . ' is_series = :is_series, '
                                   . ' series_id = :series_id, '
                                   . ' number_in_series = :number_in_series, '
                                   . ' title = :title, '
                                   . ' isbn = :isbn, '
                                   . ' pages = :pages, '
                                   . ' copyright = :copyright, '
                                   . ' description = :description '
                                   . ' WHERE book_id = :book_id'
                                );
            $stmt->bindValue(':book_id', $book->book_id);
            $stmt->bindValue(':author_id', $book->author_id);
            $stmt->bindValue(':format_id', $book->format_id);
            $stmt->bindValue(':genre_id', $book->genre_id);
            $stmt->bindValue(':is_series', $book->is_series);
            $stmt->bindValue(':series_id', $book->series_id);
            $stmt->bindValue(':number_in_series', $book->number_in_series);
            $stmt->bindValue(':title', $book->title);
            $stmt->bindValue(':isbn', $book->isbn);
            $stmt->bindValue(':pages', $book->pages);
            $stmt->bindValue(':copyright', $book->copyright);
            $stmt->bindValue(':description', $book->description);
            $stmt->execute();

        }
        catch (\PDOException $e) {
            header('Location: Error.php?errormessage='.urlencode($e->getMessage()));
            die();

        }

        return $stmt->rowCount();
    }

}