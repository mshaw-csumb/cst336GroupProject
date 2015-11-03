<?php

include 'includes/database.inc.php';

$conn = getDatabaseConnection(); //gets database connection



function displayCategories(){
    $sql = "SELECT categoryId, categoryName
        FROM oe_category WHERE 1";
    $records = getDataBySQL($sql);
    foreach ($records as $record){
        echo "<option value = '" . $record['categoryId'] . 
        "'>" . $record['categoryName'] . "</option>";
    }
} 

function displayAllProducts() {
    $sql = "SELECT productName, price, productId FROM oe_product";
    $records = getDataBySQL($sql);
    return $records;
    
    /*
    foreach($records as $record) {
        echo $record['productName'] . "-" . $record['price'] . "<br>";
    }
     */
    
}

function filterProducts(){
global $conn;
    if (isset($_GET['searchForm'])) {  //user submitted the filter form
        
        $categoryId = $_GET['categoryId'];

             $sql = "SELECT productName, price, productId 
                FROM oe_product
                WHERE categoryId = :categoryId"; //using Named Parameters (prevents SQL injection)
            
            $namedParameters = array();
            $namedParameters[":categoryId"] = $categoryId;
            
            $maxPrice = $_GET['maxPrice'];
            
            if (!empty($maxPrice)) { //the user entered a max price value in the form
                
               //$sql = $sql . " ";
               $sql .= " AND price <= :price"; //using named parameters
               $namedParameters[":price"] = $maxPrice;
             
            }
            
            if (isset($_GET['healthyChoice'])) {
                
                $sql .= " AND healthyChoice = 1";
            }
            
            $orderByFields = array("ASC", "DESC");
            $orderByIndex = array_search($_GET['order'],$orderByFields);
            
            //$sql .= " ORDER BY " . $_GET['orderBy'];
            $sql .= " ORDER BY PRICE " . $orderByFields[$orderByIndex]; //prevents SQL injection
            
            
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
        Select Category: 
        
        <select name = "categoryId">
            <!-- this data should be coming from the database -->
            <?=displayCategories() ?>
            <!-- 
            <option    value = "1">Soft Drinks</option>
            <option value = "2">Snacks</option>
            <option value = "3">Sandwiches</option>
            -->
        </select>
            
        Max Price: 
        <input type="number" name = "maxPrice" value="<?=$_GET['maxPrice']?>">
        
        <input type="checkbox" name="healthyChoice" id="healthyChoice"  <?=isset($_GET['healthyChoice'])?"checked":""?> />
        <label for="healthyChoice">Healthy Choice</label>
         
         <strong>Order by:</strong>
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
        } else {
            $records = filterProducts();
        }
        
        
        foreach($records as $record) {
				if(isset($record['productId']))
				{
              	 echo "<a target='getProductIframe' href='getProductInfo.php?productId=" . $record['productId'] . "'>";
				}
				
                  echo $record['productName'];
                  echo "</a>";
                  echo "- $" . $record['price'] . "<br>";
               
        }
        
        
        ?>
        
        </div>
        <div style="float:left">
            
            <iframe src="getProductInfo.php" name="getProductIframe" width="250" height="300" frameborder="0"/>
            </iframe>
            
        </div>
      
    </div>

    <footer style="clear:left">
     <p>&copy; Copyright  by Kevin Brock, Markus Shaw, Vincent Durante, Mateo</p>
    </footer>
  </div>
</body>
</html>