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

$sql2 = "SELECT CONCAT(Customers.customer_name, CONCAT(' ', Customers.customer_surname)) AS NAME_SURNAME FROM Customers INNER JOIN Sales ON Sales.customer_id = Customers.customer_id WHERE Sales.salesman_id IN (SELECT Salesmans.salesman_id FROM Salesmans INNER JOIN Markets ON Markets.market_id = Salesmans.market_id ";
$sql2 = $sql2 . "WHERE Markets.market_name = '" . $_POST['showmarketName'] . "')";
$sql2 = $sql2 . "GROUP BY NAME_SURNAME;";
$result2 = mysqli_query($conn,$sql2) or die("Error");

if (mysqli_num_rows($result2) > 0) 
{
	echo "<form action='dispCustomerInfo.php' method='post'>";
	echo '<select name="showCustomerInfo">';
    while($row2 = mysqli_fetch_array($result2)) {
		echo "<option value='" . $row2["NAME_SURNAME"] . "'>";
        echo $row2["NAME_SURNAME"];
		echo "</option>";
    }
	echo '</select>';
	echo '<input type="submit" value="Submit">';
	echo "</form>";
		
	
} else {
    echo "No results";
}

?>

</html>
