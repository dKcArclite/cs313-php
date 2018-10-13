--DROP TABLE IF EXISTS book Cascade;
--DROP TABLE IF EXISTS author Cascade;
--DROP TABLE IF EXISTS series Cascade;
--DROP TABLE IF EXISTS genre Cascade;
--DROP TABLE IF EXISTS format Cascade;


CREATE TABLE author
(
	author_id SERIAL NOT NULL PRIMARY KEY,
	first_name VARCHAR(50) NOT NULL,
	middle_name VARCHAR(50) NULL,
	last_name VARCHAR(50) NOT NULL	
);

CREATE TABLE series
(
	series_id SERIAL NOT NULL PRIMARY KEY,
	author_id INT NOT NULL REFERENCES author(author_id),
	series VARCHAR(100) NULL,
	description VARCHAR(1000) NULL	
);

CREATE TABLE genre
(
	genre_id SERIAL NOT NULL PRIMARY KEY,
	genre VARCHAR(100) NULL,
	description VARCHAR(1000) NULL	
);

CREATE TABLE format
(
	format_id SERIAL NOT NULL PRIMARY KEY,
	format VARCHAR(50) NOT NULL
);

insert into format (format) values ('Audio Book');
insert into format (format) values ('eBook');
insert into format (format) values ('Paperback');
insert into format (format) values ('Hard Cover');

insert into genre (genre) values ('Children''s Books');
insert into genre (genre) values ('Comics & Graphic Novels');
insert into genre (genre) values ('Computers & Technology');
insert into genre (genre) values ('Humor & Entertainment');
insert into genre (genre) values ('Mystery, Thriller & Suspense');
insert into genre (genre) values ('Religion & Spirituality');
insert into genre (genre) values ('Science Fiction & Fantasy');

CREATE TABLE book
(
	book_id SERIAL NOT NULL PRIMARY KEY,
	author_id INT NOT NULL REFERENCES author(author_id),
	genre_id INT NOT NULL REFERENCES genre(genre_id),
	format_id INT NOT NULL REFERENCES format(format_id),
	is_series BOOLEAN NOT NULL,	
	series_id INT NOT NULL REFERENCES series(series_id),
	number_in_series INT NULL,
	title VARCHAR(50) NOT NULL,
	isbn VARCHAR(50) NULL,
	pages SMALLINT NULL,
	copywrite SMALLINT NULL,
	description VARCHAR(1000) NULL	
);

insert into author (first_name, last_name) values ('Lee','Child');
insert into series (author_id, series) values(1, 'Jack Reacher');

insert into author (first_name, last_name) values ('Warren','Murphy');
insert into series (author_id, series) values(2, 'The Destroyer');

insert into author (first_name, last_name) values ('David','Eddings');
insert into series (author_id, series) values(3, 'The Belgariad');
insert into series (author_id, series) values(3, 'The Mallorean');
insert into series (author_id, series) values(3, 'The Tamuli');
insert into series (author_id, series) values(3, 'The Elenium');

insert into author (first_name, last_name) values ('Jim','Butcher');
insert into series (author_id, series) values(4, 'Dresden Files');
insert into series (author_id, series) values(4, 'Codex Alera');

insert into author (first_name, last_name) values ('Clive','Cussler');
insert into series (author_id, series) values(5, 'Dirk Pit');

insert into author (first_name, last_name) values ('Tom','Wood');
insert into series (author_id, series) values(6, 'Victor the Assassin');

insert into author (first_name, last_name) values ('Mark','Greaney');
insert into series (author_id, series) values(7, 'The Grey Man');

insert into author (first_name, last_name) values ('W.E.B','Griffin');
insert into series (author_id, series) values(8, 'Presidential Agent Novel');

insert into author (first_name, last_name) values ('Robert','Ludlum');
insert into series (author_id, series) values(9, 'Jason Bourne');

insert into author (first_name, last_name) values ('Brad','Thor');
insert into series (author_id, series) values(10, 'Scot Hartvath');

insert into author (first_name, last_name) values ('Benedict','Jacka');
insert into series (author_id, series) values(11, 'Alex Verus');

insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (10,5,3,true,14,'The Lions of Lucerne',1);
insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (10,5,3,true,14,'Path of the Assassin',2);
insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (10,5,3,true,14,'Path of the Assassin',3);
insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (10,5,3,true,14,'Path of the Assassin',3);
insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (10,5,3,true,14,'Blow Back',4);
insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (10,5,3,true,14,'Takedown',5);
insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (10,5,3,true,14,'The First Commandment',6);

insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (11,7,3,true,15,'Fated',1);
insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (11,7,3,true,15,'Cursed',2);
insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (11,7,3,true,15,'Taken',3);
insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (11,7,3,true,15,'Chosen',4);
insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (11,7,3,true,15,'Hidden',5);
insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (11,7,3,true,15,'Veiled',6);
insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (11,7,3,true,15,'Burned',7);
insert into book(author_id,genre_id,format_id,is_series,series_id,title,number_in_series) values (11,7,3,true,15,'Bouned',8);
