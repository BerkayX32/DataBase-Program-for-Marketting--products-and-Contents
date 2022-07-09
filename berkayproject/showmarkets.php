 <?php

?>

<!DOCTYPE HTML>
<html>
<body>
<?php
?>
  <form action="dispProducts.php" method="post">
  <input type="submit" value="Products">
  <input type="hidden" name="showmarketName" value="<?php echo  $_POST['showmarketName']; ?>">
  </form>
<form action="dispSalesman.php" method="post">
  <input type="submit" value="Salesmans">
  <input type="hidden" name="showmarketName" value="<?php echo  $_POST['showmarketName']; ?>">
  </form> 
 <form action="salesmaninfo.php" method="post">
  <input type="submit" value="Salesman Info">
  <input type="hidden" name="showmarketName" value="<?php echo  $_POST['showmarketName']; ?>">
  </form> 
  <form action="customerinfo.php" method="post">
  <input type="submit" value="Customer Info">
  <input type="hidden" name="showmarketName" value="<?php echo  $_POST['showmarketName']; ?>">
  </form> 
  
</body>
</html>
