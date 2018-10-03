<?php
$dictionary = [
  "na" => "North America",
  "sa" => "South America",
  "eu" => "Europe",
  "as" => "Asia",
  "au" => "Australia",
  "an" => "Antarctica",
  "af" => "Africa"
];

$name = htmlspecialchars($_POST["name"]);
$email = htmlspecialchars($_POST["email"]);
$major = htmlspecialchars($_POST["major"]);
$places = $_POST["places"];
$comments = htmlspecialchars($_POST["comments"]);

echo "<html>";
?>
	<head>
		<title>PHP Form Submission Activity</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link href="css/nav.css" rel="stylesheet" />
		<script src="js/week03.js"></script>	
	</head>
<?php	
echo "<body>";
echo "<h1>Your Results:</h1>";
        
echo "<p>Name:".$name."</p>";
?>
<p><a href="mailto:<?=$email?>"><?=$email?></a></p>
<?php
//echo "<p><a href=""mailto:'".$email."'>.$email.</a></p>";  
echo "<p>Major:".$major."</p>";
echo "<p>Comments:".$comments."</p>";
echo "Continents:<br/>";
      $places = $_POST['places'];
 for ($i = 0; $i < count($places); $i++) {
	 echo $dictionary[$places[$i]] ."<br/>";
 }
		


echo "</body>";    
echo "</html>";
?>





