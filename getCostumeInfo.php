<?php
include 'includes/database.inc.php';
echo "<link rel='stylesheet' href='css/styles'>";
$conn = getDatabaseConnection();

function displayDescription(){
	global $conn;
	if(isset($_GET['costumeId']))
	{
		$costumeId = $_GET['costumeId'];
	
		$sql = "SELECT description 
		FROM tp_costumes
		WHERE costumeId = $costumeId";
	
		$statement = $conn -> prepare($sql);
		$statement -> execute();
		$record = $statement -> fetch(PDO::FETCH_ASSOC);
	
		echo "<div class='info' style='background:white;padding:5px;'>";
		echo "<span class='desc' ><strong>Costume Description:</strong></span> " . $record['description']; 
		echo "</div>";
	}	
	
	
}
displayDescription();