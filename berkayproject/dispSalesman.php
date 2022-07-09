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


$sql = "SELECT COUNT(Sales.sale_id) AS AMOUNT, Salesmans.salesman_name as NAME, Salesmans.salesman_surname AS SURNAME, Markets.market_name AS MARKET_NAME
FROM Sales INNER JOIN Salesmans  ON Salesmans.salesman_id = Sales.salesman_id INNER JOIN Products ON Products.product_id = Sales.product_id INNER JOIN Markets ON Salesmans.market_id = Markets.market_id WHERE  Markets.market_name IN (SELECT Markets.market_name FROM Markets";
$sql = $sql . " WHERE Markets.market_name = '" . $_POST['showmarketName'] . "')";
$sql = $sql . "GROUP BY Sales.salesman_id;";

$result = mysqli_query($conn,$sql);

if (mysqli_num_rows($result) > 0) 
{
    // output data of each row
	echo "<table border='1'>";
	echo "<tr><td>NAME</td><td>SURNAME</td><td>MARKET_NAME</td></tr>";
    while($row = mysqli_fetch_array($result)) {
		echo "<tr>";
        echo "<td>"  . $row["NAME"] . "</td><td>" . $row["SURNAME"] . "</td><td>" . $row["MARKET_NAME"]. "</td>";
		echo "</tr>";
    }
	echo "</table>";
} else {
    echo "0 results";
}
mysqli_close($conn);


?>

<form method="get" action="dispSalesManInfo.php">
    <input type="hidden" name="showmarketName" value="<?php echo  $_POST['showmarketName']; ?>">
</form>

</html>
