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

$sql = "SELECT city FROM Locations ORDER BY city";
$result = mysqli_query($conn,$sql) or die("Error");

if (mysqli_num_rows($result) > 0) 
{
    // output data of each row
	echo "<form action='shownumsalesbycity.php' method='post'>";
	echo '<select name="salescityname">';
    while($row = mysqli_fetch_array($result)) {
		echo "<option value='" . $row["city"] . "'>";
        echo $row["city"];
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
