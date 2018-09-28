<!DOCTYPE html>
<html lang="en-us"> 
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Week 02 Assignment</title>
<link type="text/css" rel="stylesheet" href="stylesheet.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<script src="galleria/galleria-1.3.5.min.js"></script>
<link href='https://fonts.googleapis.com/css?family=Audiowide|Noto+Sans' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Noto+Sans' rel='stylesheet' type='text/css'>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container-fluid">
<div id="wrapper">
<div id="header">
   <h1>Week 02 Assignment</h1>
   With a full time job, a church calling and going to school I don't have much time to pursue vary many hobbies. 
   I bought this car about 16 years ago and it took me about 10 years to restomod it.
   I do try to make time however to take this beauty out once in a while.
</div>

<div id="widecolumn">
	<!--left column content-->
   <h2>Before &amp; After Pictures</h2>
	<p></p>
	<p class="note">Click on the small "i" icon in the top left of the image to view image description.</p>
	<div class="galleria">
		<img src="images/IMG01.jpg" data-title="Image 1" data-description="I really should not have bought this car, what was I thinking."/>
		<img src="images/IMG02.jpg" data-title="Image 2" data-description="As you can see the car was a complete rusted mess."/>
		<img src="images/IMG03.jpg" data-title="Image 3" data-description="If you look closely you can see the holes through the floor pan"/>
		<img src="images/IMG04.jpg" data-title="Image 4" data-description="This was suppossedly a recently rebuild engine."/>
		<img src="images/IMG05.jpg" data-title="Image 5" data-description="An old Holley 650 cfm 4 barrel carb"/>
		<img src="images/IMG06.jpg" data-title="Image 6" data-description="But at least the oil filter looked new :)"/>
		<img src="images/IMG07.jpg" data-title="Image 7" data-description="I was in way over my head, but look at what happens if you stick with it"/>	
		<img src="images/IMG08.jpg" data-title="Image 8" data-description="Starting to look different in the interior of the car"/>	
		<img src="images/IMG09.jpg" data-title="Image 9" data-description="Front Seats"/>
		<img src="images/IMG10.jpg" data-title="Image 10" data-description="Rear Seats"/>
		<img src="images/IMG11.jpg" data-title="Image 11" data-description="New 302 Crate Engine 372 HP"/>
		<img src="images/IMG12.jpg" data-title="Image 12" data-description="Sitting pretty in my driveway"/>
		<img src="images/IMG13.jpg" data-title="Image 13" data-description="I love the rims"/>
		<img src="images/IMG14.jpg" data-title="Image 14" data-description="Not so sure about the hood scoop"/>
		<img src="images/IMG15.jpg" data-title="Image 15" data-description="Awesome"/>	
		<script>
				Galleria.loadTheme('galleria/themes/classic/galleria.classic.min.js');
				Galleria.run('.galleria');
				Galleria.configure({
					imageCrop: true,
					imagePan: true,
					transition: 'fade'
				});
		 </script>
	</div>
</div>
</div>

<?php
$today = date("F j, Y, g:i a");
echo "<h2>" .$today ."</h2>";
?>





</body>
</html>
