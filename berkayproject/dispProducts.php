<!DOCTYPE html>
<html>
</body>
 <?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "gizemsudekocarslan";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) 
{
    die("Connection failed: " . mysqli_connect_error());
} 



$sql = "SELECT COUNT(Sales.sale_id) AS AMOUNT, Products.product_name AS PRD_NAME, Markets.market_name AS MARKET_NAME FROM Sales INNER JOIN Salesmans ON Salesmans.salesman_id = Sales.salesman_id  INNER JOIN Products ON Products.product_id = Sales.product_id INNER JOIN Markets ON Salesmans.market_id = Markets.market_id WHERE  Markets.market_id IN (SELECT Markets.market_id FROM Markets ";
$sql = $sql . "WHERE Markets.market_name = '" . $_POST['showmarketName'] . "')";
$sql = $sql . "GROUP BY Sales.product_id ORDER BY AMOUNT DESC;";

$result = mysqli_query($conn,$sql) or die("Error") ;

//if ($result->num_rows > 0)
if (mysqli_num_rows($result) > 0) 
{
    // output data of each row
	echo "<table border='1'>";
	echo "<tr><td>AMOUNT</td><td>PRD_NAME</td><td>MARKET_NAME</td></tr>";
    while($row = mysqli_fetch_array($result)) {
		echo "<tr>";
        echo "<td>" . $row["AMOUNT"]. "</td><td>" . $row["PRD_NAME"]. "</td><td>" . $row["MARKET_NAME"]. "</td>";
		echo "</tr>";
    }
	echo "</table>";
} else {
    echo "No results";
	echo $_POST['showmarketName'];
}
mysqli_close($conn);


?>

  <form action="dispSalesManInfo.php" method="post">
  <input type="hidden" name="showmarketName" value="<?php echo  $_POST['showmarketName']; ?>">
  </form>
</html>
