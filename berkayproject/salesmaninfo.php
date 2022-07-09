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

$sql2 = "SELECT CONCAT(Salesmans.salesman_name, CONCAT(' ', Salesmans.salesman_surname)) AS NAME_SURNAME FROM Salesmans INNER JOIN Markets ON Markets.market_id = Salesmans.market_id ";
$sql2 = $sql2 . "WHERE Markets.market_name = '" . $_POST['showmarketName'] . "';";
$result2 = mysqli_query($conn,$sql2) or die("Error");

if (mysqli_num_rows($result2) > 0) 
{
	echo "<form action='dispSalesManInfo.php' method='post'>";
	echo '<select name="showSalesManInfo">';
    while($row2 = mysqli_fetch_array($result2)) {
		echo "<option value='" . $row2["NAME_SURNAME"] . "'>";
        echo $row2["NAME_SURNAME"];
		echo "</option>";
    }
	echo '</select>';
	echo '<input type="hidden" name="showmarketName" value="' . $_POST['showmarketName'] . '">';
	echo '<input type="submit" value="Submit">';
	echo "</form>";
		
	
} else {
    echo "0 results";
}

?>

</html>
