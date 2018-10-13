<!DOCTYPE html>
<html lang="en">
<head>
  <title>Week 04 Personal Assignment</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<form>
<div class="container-fluid">
  <h1>Week 04 Personal Assignment</h1>
  <div class="row-fluid">
 <?php
echo "--DROP TABLE IF EXISTS book Cascade;"."<br/>";
echo "--DROP TABLE IF EXISTS author Cascade;"."<br/>";
echo "--DROP TABLE IF EXISTS series Cascade;"."<br/>";
echo "--DROP TABLE IF EXISTS genre Cascade;"."<br/>";
echo "--DROP TABLE IF EXISTS format Cascade;"."<br/>";


echo "CREATE TABLE author"."<br/>";
echo "("."<br/>";
echo "	author_id SERIAL NOT NULL PRIMARY KEY,"."<br/>";
echo "	first_name VARCHAR(50) NOT NULL,"."<br/>";
echo "	middle_name VARCHAR(50) NULL,"."<br/>";
echo "	last_name VARCHAR(50) NOT NULL"."<br/>";
echo ");"."<br/>";

echo "CREATE TABLE series"."<br/>";
echo "("."<br/>";
echo "	series_id SERIAL NOT NULL PRIMARY KEY,"."<br/>";
echo "	author_id INT NOT NULL REFERENCES author(author_id),"."<br/>";
echo "	series VARCHAR(100) NULL,"."<br/>";
echo "	description VARCHAR(1000) NULL"."<br/>";
echo ");"."<br/>";

echo "CREATE TABLE genre"."<br/>";
echo "("."<br/>";
echo "	genre_id SERIAL NOT NULL PRIMARY KEY,"."<br/>";
echo "	genre VARCHAR(100) NULL,"."<br/>";
echo "	description VARCHAR(1000) NULL"."<br/>";
echo ");"."<br/>";

echo "CREATE TABLE format"."<br/>";
echo "("."<br/>";
echo "	format_id SERIAL NOT NULL PRIMARY KEY,"."<br/>";
echo "	format VARCHAR(50) NOT NULL"."<br/>";
echo ");"."<br/>";

echo "insert into format (format) values ('Audio Book');"."<br/>";
echo "insert into format (format) values ('eBook');"."<br/>";
echo "insert into format (format) values ('Paperback');"."<br/>";
echo "insert into format (format) values ('Hard Cover');"."<br/>";

echo "insert into genre (genre) values ('Children''s Books');"."<br/>";
echo "insert into genre (genre) values ('Comics & Graphic Novels');"."<br/>";
echo "insert into genre (genre) values ('Computers & Technology');"."<br/>";
echo "insert into genre (genre) values ('Humor & Entertainment');"."<br/>";
echo "insert into genre (genre) values ('Mystery, Thriller & Suspense');"."<br/>";
echo "insert into genre (genre) values ('Religion & Spirituality');"."<br/>";
echo "insert into genre (genre) values ('Science Fiction & Fantasy');"."<br/>";

echo "CREATE TABLE book"."<br/>";
echo "("."<br/>";
echo "	book_id SERIAL NOT NULL PRIMARY KEY,"."<br/>";
echo "	author_id INT NOT NULL REFERENCES author(author_id),"."<br/>";
echo "	genre_id INT NOT NULL REFERENCES genre(genre_id),"."<br/>";
echo "	format_id INT NOT NULL REFERENCES format(format_id),"."<br/>";
echo "	is_series BOOLEAN NOT NULL,"."<br/>";
echo "	series_id INT NOT NULL REFERENCES series(series_id),"."<br/>";
echo "	number_in_series INT NULL,"."<br/>";
echo "	title VARCHAR(50) NOT NULL,"."<br/>";
echo "	isbn VARCHAR(50) NULL,"."<br/>";
echo "	pages SMALLINT NULL,"."<br/>";
echo "	copywrite SMALLINT NULL,"."<br/>";
echo "	description VARCHAR(1000) NULL"."<br/>";
echo ");"."<br/>";

echo "insert into author (first_name, last_name) values ('Lee','Child');"."<br/>";
echo "insert into series (author_id, series) values(1, 'Jack Reacher');"."<br/>";

echo "insert into author (first_name, last_name) values ('Warren','Murphy');"."<br/>";
echo "insert into series (author_id, series) values(2, 'The Destroyer');"."<br/>";

echo "insert into author (first_name, last_name) values ('David','Eddings');"."<br/>";
echo "insert into series (author_id, series) values(3, 'The Belgariad');"."<br/>";
echo "insert into series (author_id, series) values(3, 'The Mallorean');"."<br/>";
echo "insert into series (author_id, series) values(3, 'The Tamuli');"."<br/>";
echo "insert into series (author_id, series) values(3, 'The Elenium');"."<br/>";

echo "insert into author (first_name, last_name) values ('Jim','Butcher');"."<br/>";
echo "insert into series (author_id, series) values(4, 'Dresden Files');"."<br/>";
echo "insert into series (author_id, series) values(4, 'Codex Alera');"."<br/>";

echo "insert into author (first_name, last_name) values ('Clive','Cussler');"."<br/>";
echo "insert into series (author_id, series) values(5, 'Dirk Pit');"."<br/>";

echo "insert into author (first_name, last_name) values ('Tom','Wood');"."<br/>";
echo "insert into series (author_id, series) values(6, 'Victor the Assassin');"."<br/>";

echo "insert into author (first_name, last_name) values ('Mark','Greaney');"."<br/>";
echo "insert into series (author_id, series) values(7, 'The Grey Man');"."<br/>";

echo "insert into author (first_name, last_name) values ('W.E.B','Griffin');"."<br/>";
echo "insert into series (author_id, series) values(8, 'Presidential Agent Novel');"."<br/>";

echo "insert into author (first_name, last_name) values ('Robert','Ludlum');"."<br/>";
echo "insert into series (author_id, series) values(9, 'Jason Bourne');"."<br/>";

echo "insert into author (first_name, last_name) values ('Brad','Thor');"."<br/>";
echo "insert into series (author_id, series) values(10, 'Scot Hartvath');"."<br/>";

echo "insert into author (first_name, last_name) values ('Benedict','Jacka');"."<br/>";
echo "insert into series (author_id, series) values(11, 'Alex Verus');"."<br/>";

echo "insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (10,5,3,true,14,'The Lions of Lucerne',1);"."<br/>";
echo "insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (10,5,3,true,14,'Path of the Assassin',2);"."<br/>";
echo "insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (10,5,3,true,14,'Path of the Assassin',3);"."<br/>";
echo "insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (10,5,3,true,14,'Path of the Assassin',3);"."<br/>";
echo "insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (10,5,3,true,14,'Blow Back',4);"."<br/>";
echo "insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (10,5,3,true,14,'Takedown',5);"."<br/>";
echo "insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (10,5,3,true,14,'The First Commandment',6);"."<br/>";

echo "insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (11,7,3,true,15,'Fated',1);"."<br/>";
echo "insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (11,7,3,true,15,'Cursed',2);"."<br/>";
echo "insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (11,7,3,true,15,'Taken',3);"."<br/>";
echo "insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (11,7,3,true,15,'Chosen',4);"."<br/>";
echo "insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (11,7,3,true,15,'Hidden',5);"."<br/>";
echo "insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (11,7,3,true,15,'Veiled',6);"."<br/>";
echo "insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (11,7,3,true,15,'Burned',7);"."<br/>";
echo "insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (11,7,3,true,15,'Bouned',8);"."<br/>";
?>
  </div>
</form>
</body>
</html> 