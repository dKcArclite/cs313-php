<!DOCTYPE html>
<html>
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
	<head>
		<title>PHP Form Submission Activity</title>
	</head>

	<body>
		<form method="POST" action="results.php">
            <p></p>
            
            <label for="name">Name:</label>
            <input type="text" placeholder="Name" id="name" name="name">
            <br/>            
            <label for="email">Email:</label>
            <input type="text" placeholder="Email Address" id="email" name="email">
            <br/>
			<div class="form-group">
		    <label for="major">Majors:</label><br/>
		    <?php
		    $majors = array("Computer Science", "Web Design and Development", "Computer information Technology", "Computer Engineering");		  
		    for ($i = 0; $i < count($majors); $i++) {
			echo "<label class='radio-inline'><input type='radio' name='major' value='".$majors[$i]."'>".$majors[$i]."</label><br>";
			}
		    ?> 
			</div>
            <h3>What continents have you visited?</h3>
            <input type="checkbox" name="places[]" id="place-na" value="na"><label for="place-na">North America</label>
            <br/>
            <input type="checkbox" name="places[]" id="place-sa" value="sa"><label for="place-sa">South America</label>
            <br/>
            <input type="checkbox" name="places[]" id="place-as" value="as"><label for="place-asia">Asia</label>
            <br/>
            <input type="checkbox" name="places[]" id="place-eu" value="eu"><label for="place-eu">Europe</label>
            <br/>
            <input type="checkbox" name="places[]" id="place-aus" value="au"><label for="place-aus">Australia</label>
            <br/>
            <input type="checkbox" name="places[]" id="place-ant" value="an"><label for="place-ant">Antarctica</label>
            <br/>
            <input type="checkbox" name="places[]" id="place-af" value="af"><label for="place-af">Africa</label>
            <br/>
            
            <div class="form-group">
            <label for="comments">Comments:</label>
            <br/>
		    <textarea id="comments" name="comments"></textarea>
            <br/>
			</div>
            <input type="submit" value="Submit Answers">
        </form>

	</body>

</html>