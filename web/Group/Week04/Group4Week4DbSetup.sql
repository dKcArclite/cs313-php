CREATE DATABASE Week04Group04
  WITH OWNER = postgres
       ENCODING = 'UTF8'
       TABLESPACE = pg_default
       LC_COLLATE = 'English_United States.1252'
       LC_CTYPE = 'English_United States.1252'
       CONNECTION LIMIT = -1;


DROP TABLE IF EXISTS note;
DROP TABLE IF EXISTS speaker;
DROP TABLE IF EXISTS user_account;
DROP TABLE IF EXISTS conference;

CREATE TABLE user_account
(
	user_account_id SERIAL NOT NULL PRIMARY KEY,
	username VARCHAR(100) NOT NULL UNIQUE,
	password VARCHAR(100) NOT NULL,
	display_name VARCHAR(100) NOT NULL,
	first_name VARCHAR(50) NOT NULL,
	last_name VARCHAR(50) NOT NULL
);

INSERT INTO user_account (username,password,display_name,first_name,last_name) VALUES ('joh12155@byui.edu','password','Rick Johnson','Rick','Johnson');


CREATE TABLE conference
(
	conference_id SERIAL NOT NULL PRIMARY KEY,
	year SMALLINT NOT NULL,
	is_spring BOOLEAN NOT NULL,
	is_saturday BOOLEAN NOT NULL, 
	is_morning BOOLEAN NOT NULL
);

INSERT INTO conference(year, is_spring, is_saturday, is_morning) VALUES ( 2018, FALSE, TRUE, TRUE);
INSERT INTO conference(year, is_spring, is_saturday, is_morning) VALUES ( 2018, FALSE, TRUE, FALSE);
INSERT INTO conference(year, is_spring, is_saturday, is_morning) VALUES ( 2018, FALSE, FALSE, TRUE);
INSERT INTO conference(year, is_spring, is_saturday, is_morning) VALUES ( 2018, FALSE, FALSE, FALSE);


CREATE TABLE speaker
(
	speaker_id SERIAL NOT NULL PRIMARY KEY,
	name VARCHAR(100) NOT NULL
);

INSERT INTO speaker (name) VALUES ('President Russell M. Nelson');
INSERT INTO speaker (name) VALUES ('Dallin H. Oaks');
INSERT INTO speaker (name) VALUES ('Henry B. Eyring');


CREATE TABLE note
(
	note_id SERIAL NOT NULL PRIMARY KEY,
	user_account_id INT NOT NULL REFERENCES user_account(user_account_id),
	speaker_id INT NOT NULL REFERENCES speaker(speaker_id),
	conference_id INT NOT NULL REFERENCES conference(conference_id),
	talk_title VARCHAR(100),
	note_text TEXT NOT NULL
);

INSERT INTO note (user_account_id, speaker_id, conference_id, talk_title, note_text)
VALUES (1 ,1, 3, NULL, 'Strongly stressed the importance of the name the Lord decreed for His Church, even The Church of Jesus Christ of Latter-day Saints. 
To remove the Savior''s name from the name of His Church, President Nelson explained, is a way of "subtly disregarding all that Jesus Christ did for us" and unintentionally 
removing Him as the focus of our lives. Embracing such nicknames in the past may have been the result of not wanting to offend others, but President Nelson warned that in doing so 
"we have failed to defend the Savior Himself, to stand up for Him."');

INSERT INTO note (user_account_id, speaker_id, conference_id, talk_title, note_text)
VALUES (1 ,1, 3, NULL, 'President Nelson acknowledged that it would not be easy to correct widespread errors in the way people refer to the Church, but he said this effort is not 
inconsequential. It is the command of the Lord. "I promise you that if we will do our best to restore the correct name of the Lord''s Church, He whose Church this is will pour down 
His power and blessings upon the heads of the Latter-day Saints, the likes of which we have never seen," President Nelson said. "We will have the knowledge and power of God to 
help us take the blessings of the restored gospel of Jesus Christ to every nation, kindred, tongue, and people and to prepare the world for the Second Coming of the Lord."');

INSERT INTO note (user_account_id, speaker_id, conference_id, talk_title, note_text)
VALUES (1,1,2,NULL, '"We need to be cautious as we seek truth and choose sources for that search. We should not consider secular prominence or authority as qualified sources of truth."');

INSERT INTO note (user_account_id, speaker_id, conference_id, talk_title, note_text)
VALUES (1,1,2,NULL, 'When we seek the truth about religion, we should use spiritual methods appropriate for that search: Prayer, Witness of the Holy Ghost, and study of the 
scriptures and words of the modern prophets.');

INSERT INTO note (user_account_id, speaker_id, conference_id, talk_title, note_text)
VALUES (1,3,4,NULL, 'The loving God who designed these tests for you also designed a SURE way for you to overcome them.');

INSERT INTO note (user_account_id, speaker_id, conference_id, talk_title, note_text)
VALUES (1,3,4,NULL, 'The Savior is the rock upon which we can stand safely and without fear in EVERY storm we face.');

INSERT INTO note (user_account_id, speaker_id, conference_id, talk_title, note_text)
VALUES (1,3,4,NULL, '"Willing to take upon us His name" shows that taking His name at baptism is not finished -- there is more we must do; we must continue to take His name 
throughout our lives.  What must I be doing to take His name upon me? And how will I know when I am making progress?');

SELECT table_name
  FROM information_schema.tables
 WHERE table_schema='public'
   AND table_type='BASE TABLE';
   
   
 SELECT  n.note_id,
	 ua.display_name,
	 s.name AS "Speaker",
	 COALESCE(n.talk_title, '') AS "Talk Title",
	 n.note_text AS "Note"       
 FROM public.note n
INNER JOIN public.user_account ua 
   ON ua.user_account_Id = n.user_account_Id
INNER JOIN public.conference c
   ON c.conference_id = n.conference_id
INNER JOIN public.speaker s
   ON s.speaker_id = n.speaker_id;
   
   
SELECT s.name as "Speaker", 
       n.note_text as "Note", 
       CASE WHEN (c.is_spring) THEN 'April'
            ELSE 'October'
        END AS "Month",
       c.year AS "Conference Year",
       CASE WHEN (c.is_saturday) 
            THEN 'Saturday'
            ELSE 'Sunday'
        END AS "Session",
       CASE WHEN (c.is_morning) 
            THEN 'Morning'
            ELSE 'Afternoon'
       END AS "Session Time",
       u.username,
       u.display_name
 FROM note n 
INNER JOIN speaker s 
   ON (n.speaker_id = s.speaker_id)
INNER JOIN conference c 
   ON (n.conference_id = c.conference_id)
INNER JOIN user_account u 
   ON (n.user_account_id = u.user_account_id);
