<?php  

include 'includes/database.inc.php'; 

$conn = getDatabaseConnection(); //gets database connection 

//Need to prevent SQL injection 
//Need to check whether 'productId' is set 
if(isset($_GET['productId']))
{
$sql = "SELECT productName, productDescription, productId 
    FROM oe_product WHERE productId = " . $_GET['productId']; 
$records = getDataBySQL($sql);     
foreach ($records as $record) { 
    echo "ProductName: " . $record['productName'] . "<br />"; 
    echo "ProductDescription: " . $record['productDescription'] . "<br />"; 
} 
}
?>