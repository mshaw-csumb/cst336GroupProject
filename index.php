<?php

include 'includes/database.inc.php';

$conn = getDatabaseConnection(); //gets database connection



function displayTypes(){
    $sql = "SELECT typeId, type
        FROM tp_types WHERE 1";
    $records = getDataBySQL($sql);
	
	echo "<option value = 0>All</option>";
    foreach ($records as $record){
    	
		if($_GET['typeId'] == $record['typeId'])
		{
			 echo "<option value = '" . $record['typeId'] . 
        	"' selected>" . $record['type'] . "</option>";
		}
        echo "<option value = '" . $record['typeId'] . 
        "'>" . $record['type'] . "</option>";
    }
} 

function displaySizes(){
	$sql = "SELECT sizeId, size 
			FROM tp_sizes WHERE 1";
			
	$records = getDataBySQL($sql);
	echo "<option value = 0>All</option>";
	foreach($records as $record)
	{
		if($_GET['sizeId'] == $record['sizeId'])
		{
			echo "<option value = '" . $record['sizeId'] .
		"' selected>" . $record['size'] . "</option>";
		}
		echo "<option value = '" . $record['sizeId'] .
		"'>" . $record['size'] . "</option>";
	}
}

function displayAges(){
	$sql = "SELECT ageId, ageRange
			FROM tp_ageRanges WHERE 1";
			
	$records = getDataBySQL($sql);
	
	echo "<option value = 0>All</option>";
	foreach($records as $record)
	{
		if($_GET['age'] == $record['ageId'])
		{
			echo "<option value = '" . $record['ageId'] .
			" ' selected>" . $record['ageRange'] . "</option>";
		}else if ($_GET['age'] != $record['ageId'])
		{
			echo "<option value = '" . $record['ageId'] .
			"'>" . $record['ageRange'] . "</option>";
		}
			
		
		
	}
	
}

function displayAllProducts() {
    //$sql = "SELECT title, price, gender 
    		//FROM tp_costumes WHERE 1";
			//tt.type,
	$sql=  "SELECT costumeId, title, gender, ts.size,price,ta.ageRange 
			FROM tp_costumes tc 
			INNER JOIN tp_sizes ts ON tc.size= ts.sizeId
			INNER JOIN tp_ageRanges ta
            ON tc.ageRange=ta.ageId";
			//INNER JOIN tp_types tt ON tc.type=tt.typeId
			
	 $orderByFields = array("ASC", "DESC");
	 $orderByIndex = array_search($_GET['order'],$orderByFields);	
	 //$orderbyFields[$orderByIndex];
	 $sql .= " ORDER BY title " . $orderByFields[$orderByIndex]; //prevents SQL injection		
     $records = getDataBySQL($sql);
    
     return $records;
    
	/*
    foreach($records as $record) {
        echo $record['title'] . "-" . $record['price'] . "-" . $record['gender'] . "<br>";
    }*/
     
   
}

function filterProducts(){
global $conn;
    if (isset($_GET['searchForm'])) {  //user submitted the filter form
        
        $typeId = $_GET['typeId'];
		$sizeId = $_GET['sizeId'];
		$ageRange = $_GET['age'];
		//can filter by size, costume type, and age range
           $sql = "SELECT costumeId, title, price, gender, ts.size,ta.ageRange 
                FROM tp_costumes tc
                INNER JOIN tp_sizes ts 
                ON tc.size = ts.sizeId
                INNER JOIN tp_ageRanges ta
                ON tc.ageRange=ta.ageId
                WHERE type = :typeId"; //using Named Parameters (prevents SQL injection)
            
            $namedParameters = array();
            $namedParameters[":typeId"] = $typeId;
           
            /*if($typeId != "0")
			{
				$sql.= 
			}*/
            //$maxPrice = $_GET['maxPrice'];
            if($sizeId != "0")
			{
				$sql.= " AND ts.sizeId = :sizeId";
				 $namedParameters[":sizeId"] = $sizeId;
			}
			
			if($ageRange != "0")
			{
				$sql.= " AND ta.ageId = :ageRange";
				$namedParameters[":ageRange"] = $ageRange;
			}
			
            /*
            if (!empty($maxPrice)) { //the user entered a max price value in the form
                
               //$sql = $sql . " ";
               $sql .= " AND price <= :price"; //using named parameters
               $namedParameters[":price"] = $maxPrice;
             
            }*/
            /*
            if (isset($_GET['healthyChoice'])) {
                
                $sql .= " AND healthyChoice = 1";
            }*/
            
            $orderByFields = array("ASC", "DESC");
            $orderByIndex = array_search($_GET['order'],$orderByFields);
            
            //$sql .= " ORDER BY " . $_GET['orderBy'];
            $sql .= " ORDER BY title " . $orderByFields[$orderByIndex]; //prevents SQL injection
            
            
            $statement = $conn->prepare($sql);
            $statement->execute($namedParameters);
            $records = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $records;
            
            /*
            foreach($records as $record) {
                  echo $record['productName'] . "-" . $record['price'] . "<br>";
            }
             * 
             */    
    }
}


function isHealthyChoiceChecked(){
            
   if (isset($_GET['healthyChoice'])){
        return "checked";
   }        
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Group Project</title>
  <meta name="description" content="">
  <meta name="author" content="Kevin Brock">
	<link rel="stylesheet" type="css" href="css/stylesheet.css">
  <meta name="viewport" content="width=device-width; initial-scale=1.0">

  <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
</head>

<body>
  <div>
    <header>
      <h1>Spooky's House of Costumes</h1>
      <h2>Please stop asking us for sexy corn costumes, we don't have any</h2>
    </header>

    <div>
        
        <form method ="get">
        Select Costume Type: 
        
        <select name = "typeId">
            <!-- this data should be coming from the database -->
            <?=displayTypes() ?>
            <!-- 
            <option    value = "1">Soft Drinks</option>
            <option value = "2">Snacks</option>
            <option value = "3">Sandwiches</option>
            -->
        </select>
            
        Size:
        <select name="sizeId">
        	<!-- display sizes -->
        	<?=displaySizes() ?>
        </select>
        
        Age Range: 
        <select name="age">
        	<?=displayAges() ?>
        </select>
        
        <!--Max Price: 
        <input type="number" name = "maxPrice" value="<?=$_GET['maxPrice']?>">-->
        
        <!--<input type="checkbox" name="healthyChoice" id="healthyChoice"  <?=isset($_GET['healthyChoice'])?"checked":""?> />
        <label for="healthyChoice">Healthy Choice</label>-->
         
         <strong>Order by Title:</strong>
        <select name="order">
            <option value="ASC">Ascending</option>
            <option value="DESC">Descending</option>
        </select>
        <br />
        <input type="submit" value="Search Products" name="searchForm" />
        </form>
        
        <hr> <br />
        
        <div style="float:left">
        <?php
        
        //Displays all products by default
        if (!isset($_GET['searchForm'])) {
            $records = displayAllProducts();
        } else if ($_GET['sizeId'] == "0" && $_GET['age'] == "0" && $_GET['typeId'] == 0){
			$records = displayAllProducts();
		}else {
            $records = filterProducts();
        }
        
        
        foreach($records as $record) {
				if(isset($record['costumeId']))
				{
              	 echo "<a target='getCostumeIframe' href='getCostumeInfo.php?costumeId=" . $record['costumeId'] . "'>";
				}
				
                  echo $record['title'];
                  echo "</a>";
                  echo "- $" . $record['price']; 
                  echo " - " . "Gender: " . $record['gender']; 
                  echo " - " . $record['size']; 
                  echo " - " . "Age Level: " . $record['ageRange']. "<br><br>";
               
        }
        
        
        ?>
        
        </div>
        <div style="float:left">
            
            <iframe src="getCostumeInfo.php" name="getCostumeIframe" width="250" height="300" frameborder="0">
            </iframe>
            
        </div>
      
    </div>

    <footer style="clear:left">
     <p>&copy; Copyright  by Kevin Brock, Markus Shaw, Vincent Duarte, Mateo Sixtos</p>
    </footer>
  </div>
</body>
</html>