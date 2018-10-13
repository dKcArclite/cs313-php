<!DOCTYPE html>
<html lang="en">
<head>
  <title>Week 04 Group 4</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<form>
<div class="container-fluid">
  <h1>Week 04 Group 04 Assignment</h1>
  <div class="row-fluid">
      <?php
echo "Only run this sectionaginst your localhost db, do not try to run it against heroku"."<br/>";
echo "--CREATE DATABASE Week04Group04"."<br/>";
echo "--WITH OWNER = postgres"."<br/>";
echo "--ENCODING = 'UTF8'"."<br/>";
echo "--TABLESPACE = pg_default"."<br/>";
echo "--LC_COLLATE = 'English_United States.1252'"."<br/>";
echo "--LC_CTYPE = 'English_United States.1252'"."<br/>";
echo "--CONNECTION LIMIT = -1;"."<br/>"."<br/>";


echo "DROP TABLE IF EXISTS note"."<br/>";
echo "DROP TABLE IF EXISTS speaker"."<br/>";
echo "DROP TABLE IF EXISTS user_account"."<br/>";
echo "DROP TABLE IF EXISTS conference"."<br/>";
echo "<br/>";
echo "CREATE TABLE user_account"."<br/>";
echo "("."<br/>";
echo "	user_account_id SERIAL NOT NULL PRIMARY KEY,"."<br/>";
echo "	username VARCHAR(100) NOT NULL UNIQUE,"."<br/>";
echo "	password VARCHAR(100) NOT NULL,"."<br/>";
echo "	display_name VARCHAR(100) NOT NULL,"."<br/>";
echo "	first_name VARCHAR(50) NOT NULL,"."<br/>";
echo "	last_name VARCHAR(50) NOT NULL"."<br/>";
echo ")"."<br/>";
echo "<br/>";
echo "INSERT INTO user_account (username,password,display_name,first_name,last_name) VALUES ('joh12155@byui.edu','password','Rick Johnson','Rick','Johnson')"."<br/>";
echo "<br/>";

echo "CREATE TABLE conference"."<br/>";
echo "("."<br/>";
echo "	conference_id SERIAL NOT NULL PRIMARY KEY,"."<br/>";
echo "	year SMALLINT NOT NULL,"."<br/>";
echo "	is_spring BOOLEAN NOT NULL,"."<br/>";
echo "	is_saturday BOOLEAN NOT NULL, "."<br/>";
echo "	is_morning BOOLEAN NOT NULL"."<br/>";
echo ")"."<br/>";
echo "<br/>";
echo "NSERT INTO conference(year, is_spring, is_saturday, is_morning) VALUES ( 2018, FALSE, TRUE, TRUE)"."<br/>";
echo "INSERT INTO conference(year, is_spring, is_saturday, is_morning) VALUES ( 2018, FALSE, TRUE, FALSE)"."<br/>";
echo "INSERT INTO conference(year, is_spring, is_saturday, is_morning) VALUES ( 2018, FALSE, FALSE, TRUE)"."<br/>";
echo "INSERT INTO conference(year, is_spring, is_saturday, is_morning) VALUES ( 2018, FALSE, FALSE, FALSE)"."<br/>";
echo "<br/>";
echo "CREATE TABLE speaker"."<br/>";
echo "("."<br/>";
echo "	speaker_id SERIAL NOT NULL PRIMARY KEY,"."<br/>";
echo "	name VARCHAR(100) NOT NULL"."<br/>";
echo ")"."<br/>";
echo "<br/>";
echo "INSERT INTO speaker (name) VALUES ('President Russell M. Nelson')"."<br/>";
echo "INSERT INTO speaker (name) VALUES ('Dallin H. Oaks')"."<br/>";
echo "INSERT INTO speaker (name) VALUES ('Henry B. Eyring')"."<br/>";
echo "<br/>";
echo "CREATE TABLE note"."<br/>";
echo "("."<br/>";
echo "	note_id SERIAL NOT NULL PRIMARY KEY,"."<br/>";
echo "	user_account_id INT NOT NULL REFERENCES user_account(user_account_id),"."<br/>";
echo "	speaker_id INT NOT NULL REFERENCES speaker(speaker_id),"."<br/>";
echo "	conference_id INT NOT NULL REFERENCES conference(conference_id),"."<br/>";
echo "	talk_title VARCHAR(100),"."<br/>";
echo "	note_text TEXT NOT NULL"."<br/>";
echo ")"."<br/>";
echo "<br/>";
echo "INSERT INTO note (user_account_id, speaker_id, conference_id, talk_title, note_text)"."<br/>";
echo "VALUES (1 ,1, 3, NULL, 'Strongly stressed the importance of the name the Lord decreed for His Church, even The Church of Jesus Christ of Latter-day Saints."."<br/>";
echo "To remove the Savior''s name from the name of His Church, President Nelson explained, is a way of subtly disregarding all that Jesus Christ did for us and unintentionally"."<br/>";
echo "removing Him as the focus of our lives. Embracing such nicknames in the past may have been the result of not wanting to offend others, but President Nelson warned that in doing so"."<br/>";
echo "we have failed to defend the Savior Himself, to stand up for Him.)"."<br/>";
echo "<br/>";
echo "INSERT INTO note (user_account_id, speaker_id, conference_id, talk_title, note_text)"."<br/>";
echo "VALUES (1 ,1, 3, NULL, 'President Nelson acknowledged that it would not be easy to correct widespread errors in the way people refer to the Church, but he said this effort is not"."<br/>";
echo "inconsequential. It is the command of the Lord. I promise you that if we will do our best to restore the correct name of the Lord''s Church, He whose Church this is will pour down"."<br/>";
echo "His power and blessings upon the heads of the Latter-day Saints, the likes of which we have never seen, President Nelson said. We will have the knowledge and power of God to"."<br/>";
echo "help us take the blessings of the restored gospel of Jesus Christ to every nation, kindred, tongue, and people and to prepare the world for the Second Coming of the Lord.)"."<br/>";

echo "INSERT INTO note (user_account_id, speaker_id, conference_id, talk_title, note_text)"."<br/>";
echo "VALUES (1,1,2,NULL, 'We need to be cautious as we seek truth and choose sources for that search. We should not consider secular prominence or authority as qualified sources of truth.')"."<br/>";
echo "<br/>";
echo "INSERT INTO note (user_account_id, speaker_id, conference_id, talk_title, note_text)"."<br/>";
echo "VALUES (1,1,2,NULL, 'When we seek the truth about religion, we should use spiritual methods appropriate for that search: Prayer, Witness of the Holy Ghost, and study of the "."<br/>";
echo "scriptures and words of the modern prophets.')"."<br/>";
echo "<br/>";
echo "INSERT INTO note (user_account_id, speaker_id, conference_id, talk_title, note_text)"."<br/>";
echo "VALUES (1,3,4,NULL, 'The loving God who designed these tests for you also designed a SURE way for you to overcome them.')"."<br/>";
echo "<br/>";
echo "INSERT INTO note (user_account_id, speaker_id, conference_id, talk_title, note_text)"."<br/>";
echo "VALUES (1,3,4,NULL, 'The Savior is the rock upon which we can stand safely and without fear in EVERY storm we face.')"."<br/>";
echo "<br/>";
echo "INSERT INTO note (user_account_id, speaker_id, conference_id, talk_title, note_text)"."<br/>";
echo "VALUES (1,3,4,NULL, 'Willing to take upon us His name' shows that taking His name at baptism is not finished -- there is more we must do; we must continue to take His name "."<br/>";
echo "throughout our lives.  What must I be doing to take His name upon me? And how will I know when I am making progress?')"."<br/>";
echo "<br/>";
echo "SELECT table_name"."<br/>";
echo "  FROM information_schema.tables"."<br/>";
echo " WHERE table_schema='public'"."<br/>";
echo "   AND table_type='BASE TABLE'"."<br/>";
echo "<br/>";

echo " SELECT  n.note_id,"."<br/>";
echo "	 ua.display_name,"."<br/>";
echo "	 s.name AS 'Speaker',"."<br/>";
echo "	 COALESCE(n.talk_title, '') AS 'Talk Title',"."<br/>";
echo "	 n.note_text AS 'Note'"."<br/>";
echo " FROM public.note n"."<br/>";
echo "INNER JOIN public.user_account ua"."<br/>";
echo "   ON ua.user_account_Id = n.user_account_Id"."<br/>";
echo "INNER JOIN public.conference c"."<br/>";
echo "   ON c.conference_id = n.conference_id"."<br/>";
echo "INNER JOIN public.speaker s"."<br/>";
echo "   ON s.speaker_id = n.speaker_id;"."<br/>";
echo "<br/>";

echo "SELECT s.name as 'Speaker';,"."<br/>";
echo "       n.note_text as 'Note',"."<br/>";
echo "       CASE WHEN (c.is_spring) THEN 'April'"."<br/>";
echo "            ELSE 'October'"."<br/>";
echo "        END AS 'Month',"."<br/>";
echo "       c.year AS 'Conference Year',"."<br/>";
echo "       CASE WHEN (c.is_saturday) "."<br/>";
echo "            THEN 'Saturday'"."<br/>";
echo "            ELSE 'Sunday'"."<br/>";
echo "        END AS 'Session',"."<br/>";
echo "       CASE WHEN (c.is_morning) "."<br/>";
echo "            THEN 'Morning'"."<br/>";
echo "            ELSE 'Afternoon'"."<br/>";
echo "       END AS 'Session Time',"."<br/>";
echo "       u.username,"."<br/>";
echo "       u.display_name"."<br/>";
echo " FROM note n "."<br/>";
echo "INNER JOIN speaker s "."<br/>";
echo "   ON (n.speaker_id = s.speaker_id)"."<br/>";
echo "INNER JOIN conference c "."<br/>";
echo "   ON (n.conference_id = c.conference_id)"."<br/>";
echo "INNER JOIN user_account u "."<br/>";
echo "   ON (n.user_account_id = u.user_account_id);"."<br/>";
      ?>
  </div>
</form>
</body>
</html> 