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




$sql = "SELECT  Customers.customer_name AS NAME, Customers.customer_surname AS SURNAME, Products.product_name AS PRD_NAME, Sales.sale_date AS DATE, Products.product_price AS PRICE FROM Sales ";
$sql .= "INNER JOIN Customers ON Customers.customer_id = Sales.customer_id INNER JOIN Products ON Products.product_id = Sales.product_id INNER JOIN Salesmans  ON Salesmans.salesman_id = Sales.salesman_id ";
$sql .= "WHERE Sales.salesman_id IN (SELECT Salesmans.salesman_id FROM Salesmans INNER JOIN Markets ON Salesmans.market_id = Markets.market_id) GROUP BY Sales.sale_id ";
$sql .= "HAVING CONCAT(Customers.customer_name, CONCAT(' ',Customers.customer_surname)) = '". $_POST['showCustomerInfo'] . "'";


$result = mysqli_query($conn,$sql) or die("Error");

if (mysqli_num_rows($result) > 0) 
{
    // output data of each row
	echo "<table border='1'>";
	echo "<tr><td>NAME</td><td>SURNAME</td><td>PRD_NAME</td><td>DATE</td><td>PRICE</td></tr>";
    while($row = mysqli_fetch_array($result)) {
		echo "<tr>";
        echo "<td>" . $row["NAME"] . "</td><td>" . $row["SURNAME"] . "</td><td>" . $row["PRD_NAME"] . "</td><td>" . $row["DATE"] . "</td><td>" . $row["PRICE"]. ".00 ". "</td>";
		echo "</tr>";
    }
	echo "</table>";
} else {
    echo "No results";
}
mysqli_close($conn);



?>
</html>
