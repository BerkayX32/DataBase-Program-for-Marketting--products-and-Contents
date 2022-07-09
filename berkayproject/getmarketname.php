<!DOCTYPE html>
<html>
<body>
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

$sql = "SELECT market_name FROM Markets GROUP BY market_name ORDER BY market_name";
$result = mysqli_query($conn,$sql) or die("Error");

if (mysqli_num_rows($result) > 0) 
{
    // output data of each row
	echo "<form action='showmarkets.php' method='post'>";
	echo '<select name="showmarketName">';
    while($row = mysqli_fetch_array($result)) {
		echo "<option value='" . $row["market_name"] . "'>";
        echo $row["market_name"];
		echo "</option>";
    }
	echo '</select>';
	echo '<input type="submit" value="Submit">';
	echo "</form>";
} else {
    echo "0 results";
}
mysqli_close($conn);
?>

</body>
</html>
