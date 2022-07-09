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



$sql = "SELECT Salesmans.market_id AS MARKET_ID, UCASE(Markets.market_name) AS MARKET_NAME, COUNT(Sales.product_id) AS AMOUNT FROM Salesmans INNER JOIN Sales ON Salesmans.salesman_id = Sales.salesman_id INNER JOIN Markets ON Salesmans.market_id = Markets.market_id INNER JOIN Locations ON Locations.location_id = Markets.location_id ";
$sql = $sql . " WHERE Locations.city = '" . $_POST['salescityname'] . "'";
$sql = $sql . "GROUP BY Markets.market_id ORDER BY AMOUNT DESC;";

$result = mysqli_query($conn,$sql) or die("Error");

if (mysqli_num_rows($result) > 0) 
{
    // output data of each row
	echo "<table border='1'>";
	echo "<tr><td>MARKET_ID</td><td>MARKET_NAME</td><td>AMOUNT</td></tr>";
    while($row = mysqli_fetch_array($result)) {
		echo "<tr>";
        echo "<td>" . $row["MARKET_ID"]. "</td><td>" . $row["MARKET_NAME"]. "</td><td>" . $row["AMOUNT"]. "</td>";
		echo "</tr>";
    }
	echo "</table>";
} else {
    echo "0 results";
}
mysqli_close($conn);
?>
