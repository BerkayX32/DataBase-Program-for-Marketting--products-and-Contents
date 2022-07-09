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




$sql = "SELECT COUNT(Sales.sale_id) AS AMOUNT, Sales.sale_id AS SALE_ID, Salesmans.salesman_name as NAME, Salesmans.salesman_surname AS SURNAME, Markets.market_name AS MARKET_NAME FROM Sales INNER JOIN Salesmans ON Salesmans.salesman_id = Sales.salesman_id INNER JOIN Products ON Products.product_id = Sales.product_id INNER JOIN Markets ON Salesmans.market_id = Markets.market_id ";
$sql = $sql . "WHERE (CONCAT(Salesmans.salesman_name, CONCAT(' ',Salesmans.salesman_surname)) = '" . $_POST['showSalesManInfo'] . "') AND (Markets.market_name = '" . $_POST['showmarketName' ] . "') ";
$sql = $sql . "GROUP BY Sales.sale_id;"; 

$result = mysqli_query($conn,$sql) or die("Error");

if (mysqli_num_rows($result) > 0) 
{
    // output data of each row
	echo "<table border='1'>";
	echo "<tr><td>SALE_ID</td><td>NAME</td><td>SURNAME</td><td>MARKET_NAME</td></tr>";
    while($row = mysqli_fetch_array($result)) {
		echo "<tr>";
        echo "<td>"  . $row["SALE_ID"] . "</td><td>" . $row["NAME"] . "</td><td>" . $row["SURNAME"] . "</td><td>" . $row["MARKET_NAME"]. "</td>";
		echo "</tr>";
    }
	echo "</table>";
} else {
    echo "0 results";
}
mysqli_close($conn);




?>
</html>
