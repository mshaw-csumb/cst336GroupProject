<?php

include 'includes/database.inc.php';

$conn = getDatabaseConnection(); //gets database connection

function mostExpensiveProduct(){
	$sql = "SELECT title, price
			FROM tp_costumes
			WHERE price = (
				SELECT MAX(price)
				FROM tp_costumes)";
	$records = getDataBySQL($sql);
	foreach($records as $record){
		echo $record['title'] . " - $" . $record['price'] . "<br>";
	}
}

function AveragePrice(){
	$sql = "SELECT AVG( price ) as AveragePrice
			FROM  tp_costumes";
	$records = getDataBySQL($sql);
	foreach($records as $record){
		echo "$" . $record['AveragePrice'] . "<br>";
	}
}

function typeAndGender(){
	$sql = "SELECT title, type, gender, description
			FROM tp_costumes
			WHERE type = 2 AND gender = 'M'";
	$records = getDataBySQL($sql);
	foreach($records as $record){
		echo $record['title'] . " : " . $record['type'] . " - " . $record['gender'] . " - " . $record['description'] . "<br>";
	}
}

function sumOfTeenagers(){
	$sql = "SELECT SUM(price) as Sum
			FROM tp_costumes
			WHERE ageRange = 2";
	$records = getDataBySQL($sql);
	foreach($records as $record){
		echo "$" . $record['Sum'] . "<br>";
	}	
}

function chokingHazardPrice(){
	$sql = "SELECT chokingHazard, title, price, description
			FROM tp_accessories
			WHERE chokingHazard = 1 AND price < 5";
	$records = getDataBySQL($sql);
	foreach($records as $record){
		echo $record['chokingHazard'] . "  " .$record['title'] . " - $" .$record['price'] . "  " .$record['description'] . "<br>";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
	
	<style>
		@import url(css/stylesheet.css);
	</style>
  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Reports</title>
  <meta name="description" content="">
  <meta name="author" content="Vincent">

  <meta name="viewport" content="width=device-width; initial-scale=1.0">

  <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
</head>

<body>
  <div>
    <header>
      <h1>Reports</h1>
    </header>
    	<h2>The Most Expensive Item.</h2>
    	    	
    	<?php
    	mostExpensiveProduct();
    	?>
		
		<h2>The average of the prices of every item.</h2>
		<?php
		AveragePrice();
		?>
   
   		<h2>Every costume that is a character type costume and is for Males.</h2>
   		<?php
   		typeAndGender();
		?>
		
		<h2>The sum of all the costumes whos age range is for teenagers.</h2>
		<?php
		sumOfTeenagers();
		?>
		
		<h2>All accessories that are a choking hazard and are less then $5.</h2>
		<?php
		chokingHazardPrice();
		?>
		
    <footer style="clear:left">
     <p>&copy; Copyright  by Kevin Brock, Markus Shaw, Vincent Duarte, Mateo Sixtos</p>
    </footer>
  </div>
</body>
</html>
