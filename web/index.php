<!DOCTYPE html>
<html lang="en">
<head>
  <title>Week 02 Assignment</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Alegreya Sans SC' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Alfa Slab One' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Allerta Stencil' rel='stylesheet'>
  <link href="./css/Week02.css" rel="stylesheet" />
  <script src="./js/Week02.js"></script>
</head>
<body>
<form>
<div class="container">
<div class="row-fluid">
<div class="contentHeaderDiv col-sm-12">       
Week 02 Assignment	  
</div>	
</div>

<?php
function current_url($strType)
{
	$url      = "http://" . $_SERVER['HTTP_HOST'] ."/" .$strType ."/Week";
	$validURL = str_replace("&", "&amp", $url);
	return $validURL;
}

//echo "page URL is : ".current_url()."<br>";
?>

  
<?php
$d = "Personal";
$a = current_url($d);
//$a = "http://localhost/PHPTest/web/Personal/Week";
$b = "/index.php";
$x = 2;
$y = 0;
echo '<div><div class="divSubhead col-sm-12"><h2>Personal Assignments</h2>'.'</div><br></div>';
do {    
	  if ($x > 9) 
	  {
		$y = "";
      }
	  
 	  echo '<div class="contentDiv col-sm-4">'; 	  
	  echo '<div class="form-group">';
	  echo '<div class="col-sm-10">';        
	  echo '<a href="'.$a.$y.$x.$b.'">Week '.$y.$x. ' Personal Assignment</a>'."<br>";		
	  echo '</div>';	  
	  echo '</div>';	
	  echo '</div>';		  
	  
    $x++;
} while ($x <= 14);
?> 

<br>

<?php
$d = "Group";
$a = current_url($d);
$b = "/index.php";
$x = 2;
$y = 0;
echo '<div><div class="divSubhead col-sm-12"><h2>Group Assignments</h2>'.'</div><br></div>';
do {    
	  if ($x > 9) 
	  {
		$y = "";
      }
	  
 	  echo '<div class="contentDiv col-sm-4">'; 	  
	  echo '<div class="form-group">';
	  echo '<div class="col-sm-10">';        
	  echo '<a href="'.$a.$y.$x.$b.'">Week '.$y.$x. ' Group Assignment</a>'."<br>";	
	  echo '</div>';	  
	  echo '</div>';
	  echo '</div>';		  
	  
    $x++;
} while ($x <= 14);
?>

</div>
<?php
	include 'includes/footer.php';
?>
</form>
</body>
</html> 