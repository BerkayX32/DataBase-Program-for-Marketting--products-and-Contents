<?php


ini_set('max_execution_time', 0);
set_time_limit(1800);
ini_set('memory_limit', '-1');


$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "gizemsudekocarslan";

// Creating a connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if (!$conn) 
{	
    die("Connection failed: " . mysqli_connect_error());
} 
else
{
	//echo "Connection Successfull\n";
}

// Creating a database named gizemsudekocarslan
$sql_db_create = "create database if not exists gizemsudekocarslan;";
$sql_db_create_locations = "CREATE TABLE Locations (location_id INT NOT NULL AUTO_INCREMENT, district VARCHAR(50) NOT NULL, city VARCHAR(50) NOT NULL, PRIMARY KEY(location_id)) ENGINE=INNODB;";
$sql_db_create_markets = "CREATE TABLE Markets (market_id INT NOT NULL AUTO_INCREMENT, market_name VARCHAR(50) NOT NULL, location_id INT NOT NULL, FOREIGN KEY (location_id) REFERENCES Locations(location_id), PRIMARY KEY(market_id)) ENGINE=INNODB;";
$sql_db_create_salesmans = "CREATE TABLE Salesmans (salesman_id INT NOT NULL AUTO_INCREMENT,  salesman_name VARCHAR(50) NOT NULL, salesman_surname VARCHAR(50) NOT NULL, salary DOUBLE DEFAULT 0, market_id INT NOT NULL, FOREIGN KEY (market_id) REFERENCES Markets(market_id), PRIMARY KEY(salesman_id)) ENGINE=INNODB;";
$sql_db_create_customers = "CREATE TABLE Customers (customer_id INT NOT NULL AUTO_INCREMENT,customer_name VARCHAR(50) NOT NULL,customer_surname VARCHAR(50) NOT NULL, PRIMARY KEY (customer_id)) ENGINE=INNODB;";
$sql_db_create_products = "CREATE TABLE Products (product_id INT NOT NULL AUTO_INCREMENT, product_name VARCHAR(50) NOT NULL, product_price DOUBLE DEFAULT 0, PRIMARY KEY (product_id)) ENGINE=INNODB;";
$sql_db_create_sales = "CREATE TABLE Sales (sale_id INT NOT NULL AUTO_INCREMENT, product_id INT NOT NULL, sale_date date NOT NULL, customer_id INT NOT NULL, salesman_id INT NOT NULL, FOREIGN KEY (product_id) REFERENCES Products(product_id), FOREIGN KEY (customer_id) REFERENCES Customers(customer_id), FOREIGN KEY (salesman_id) REFERENCES Salesmans(salesman_id), PRIMARY KEY(sale_id)) ENGINE=INNODB;";


if ($conn->query($sql_db_create) === TRUE) 
{
    echo "Database created successfully \n";
} 
else 
{
    echo "Error creating database: " . mysqli_connect_error() . "\n";
}

// closing connection
mysqli_close($conn);

// Creating a connection
$conn2 = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn2) 
{
    die("Connection failed: " . mysqli_connect_error());
} 
else
{
	//echo "Connection Successfull\n";
}

if ($conn2->query($sql_db_create_locations) === TRUE) 
{
    //echo "Locations Table created successfully!\n";
} 
else 
{
    //echo "Error creating Locations Table: " . mysqli_connect_error();
}

if ($conn2->query($sql_db_create_markets) === TRUE) 
{
    //echo "Markets Table created successfully!\n";
} 
else 
{
    //echo "Error creating Markets Table: " . mysqli_connect_error();
}

if ($conn2->query($sql_db_create_salesmans) === TRUE) 
{
    //echo "Salesmans Table created successfully!\n";
} 
else 
{
    //echo "Error creating Salesmans Table: " . mysqli_connect_error();
}

if ($conn2->query($sql_db_create_customers) === TRUE) 
{
    //echo "Customers Table created successfully!\n";
} 
else 
{
    //echo "Error creating Customers Table: " . mysqli_connect_error();
}

if ($conn2->query($sql_db_create_products) === TRUE) 
{
    //echo "Products Table created successfully!\n";
} 
else 
{
    //echo "Error creating Products Table: " . mysqli_connect_error();
}

if ($conn2->query($sql_db_create_sales) === TRUE) 
{
    //echo "Sales Table created successfully!\n";
} 
else 
{
    //echo "Error creating Sales Table: " . mysqli_connect_error();
}

// closing connection
mysqli_close($conn2);


// Creating a connection
$conn3 = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn3) 
{
    die("Connection failed: " . mysqli_connect_error());
} 
else
{
	//echo "Connection Successfull\n";
}


// INSERT LOCATIONS ---------------------------------------------------
$sql_db_create_fill_locations = "INSERT INTO locations (district, city) VALUES ('";

$row = 0;
$filename_locations = "csv/district_cities.csv";


if(!file_exists($filename_locations) || !is_readable($filename_locations))
	return FALSE;

if (($handle = fopen($filename_locations, 'r')) !== FALSE)
{
	while (($row = fgetcsv($handle, 10000, ';')) !== FALSE)
	{
		//echo '<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><tr/>';
		
		$write = $sql_db_create_fill_locations . $row[0] . "','" .$row[1]. "');";
		
		if ($conn3->query($write) === TRUE) 
		{
			//echo "Locating added to Locations Table successfully!\n";
		} 
		else 
		{
			//echo "Error adding location to Locatins Sales Table: " . mysqli_connect_error();
		}
	}
	fclose($handle);
}

// closing connection
mysqli_close($conn3);

// Creating a connection
$conn4 = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn4) 
{
    die("Connection failed: " . mysqli_connect_error());
} 
else
{
	//echo "Connection Successfull\n";
}


// INSERT CUSTOMERS ---------------------------------------------------
$sql_db_create_fill_customers = "INSERT INTO customers (customer_name, customer_surname) VALUES ('";

$row = 0;
$filename_customers = "csv/name_surname.csv";
$min = 1;
$max = 10;
$not_take; 
$ctr = 0;


if(!file_exists($filename_customers) || !is_readable($filename_customers))
    return FALSE;

while($ctr <= 1620)
{
    if (($handle = fopen($filename_customers, 'r')) !== FALSE)
    {
        while (($row = fgetcsv($handle, 100000, ';')) !== FALSE)
        { 
 			$rnd = mt_rand($min, $max);
            while ($rnd > 0 )
            {
                $not_take = $row;
                $rnd = $rnd - 1;
            }
        	$write = $sql_db_create_fill_customers . $row[0];
           
            $rnd = mt_rand($min, $max);
            while ($rnd > 0 )
            {
                $not_take = $row;
                $rnd = $rnd - 1;
            }


            $write = $write . "','" . $row[1];
            

            
            $write = $write . "');";
            $ctr = $ctr + 1;
           	if ($ctr <= 1620)
            {
                mysqli_query($conn4,$write);
            }
        }
        fclose($handle);
    }
}
// closing connection
mysqli_close($conn4);

// Creating a connection
$conn5 = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn5) 
{
    die("Connection failed: " . mysqli_connect_error());
} 
else
{
	//echo "Connection Successfull\n";
}

// Creating a connection
$conn6 = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn6) 
{
    die("Connection failed: " . mysqli_connect_error());
} 
else
{
	//echo "Connection Successfull\n";
}


// INSERT Markets ---------------------------------------------------
$sql_db_create_fill_markets = "INSERT INTO Markets (market_name, location_id) VALUES ('";

$migros = "migros";
$a101 = "a101";
$bim = "bim";
$macro = "macro center";
$carefour = "carefour";
$kim = "kim";
$mopas = "mopas";
$kipa = "kipa";
$tansas = "tansas";
$ucz = "ucz";

$row = 0;
$min = 1;
$max = 10;
$ctr = 1;
$i = 5;

while($ctr <= 81)
{
	$i = 5;
	while ($i > 0)
	{
		$write = $sql_db_create_fill_markets;
		$rnd = mt_rand($min, $max);
		if  ($rnd == 1)
		{
			$write = $write . $migros;
		}
		if ($rnd == 2)
		{
			$write = $write . $a101;
		}
		if ($rnd == 3)
		{
			$write = $write . $bim;
		}	
		if ($rnd == 4)
		{
			$write = $write . $macro;
		}
		if ($rnd == 5)
		{
			$write = $write . $carefour;
		}
		if ($rnd == 6)
		{
			$write = $write . $kim;
		}
		if ($rnd == 7)
		{
			$write = $write . $mopas;
		}
		if ($rnd == 8)
		{
			$write = $write . $kipa;
		}
		if ($rnd == 9)
		{
			$write = $write . $tansas;
		}
		if ($rnd == 10)
		{
			$write = $write . $ucz;
		}
		
		$write = $write . "'," . $ctr . ");";

		if ($conn6->query($write) === TRUE) 
		{
			//echo "Market added to Markets Table successfully!\n";
		} 
		else 
		{
			//echo "Error adding market to Markets Table: " . mysqli_connect_error();
		}
		$i = $i - 1; 
	}
	$ctr = $ctr + 1;
}

// closing connection
mysqli_close($conn6);


// INSERT SALESMANS ---------------------------------------------------
$sql_db_create_fill_salesmans = "INSERT INTO salesmans (salesman_name, salesman_surname, salary, market_id) VALUES ('";

$row = 0;
$filename_salesmans = "csv/name_surname.csv";
$min = 1;
$max = 10;
$not_take; 
$ctr = 0;
$market_number =1;

if(!file_exists($filename_salesmans) || !is_readable($filename_salesmans))
	return FALSE;

while($ctr <= 1215)
{
	if (($handle = fopen($filename_salesmans, 'r')) !== FALSE)
	{
		while (($row = fgetcsv($handle, 100000, ';')) !== FALSE)
		{
			$write = $sql_db_create_fill_salesmans;
			$rnd = mt_rand($min, $max);
			while ($rnd > 0 )
			{
				$not_take = $row;
				$rnd = $rnd - 1;
			}
			
			$write = $write .  $row[0];
			
			$rnd = mt_rand($min, $max);
			while ($rnd > 0 )
			{
				$not_take = $row;
				$rnd = $rnd - 1;
			}
			
			$write = $write . "','" . $row[1];
			
			$rnd_salary_mult1 = mt_rand($min, 5);
			$rnd_salary_mult2 = mt_rand(1000, 1150);
			
			$salary = $rnd_salary_mult1 * $rnd_salary_mult2;
			
			$write = $write . "'," . $salary . ".00";
			
			$market_no = $ctr % 3 + 1;
			if ($market_no == 3)
			{ 
				if ($ctr == 2)
				{
					$market_number = $market_number;
				}
				else
				{
					$market_number = $market_number + 1;
				}
				
			}
			
			$write = $write . "," . $market_number . ");";
			$ctr = $ctr + 1;
			if ($ctr <= 1215)
			{
				
				mysqli_query($conn5,$write);
			}
		}
		fclose($handle);
	}
}

// closing connection
mysqli_close($conn5);



// Creating a connection
$conn7 = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn7) 
{
    die("Connection failed: " . mysqli_connect_error());
} 
else
{
	//echo "Connection Successfull\n";
}


// INSERT PRODUCTS ---------------------------------------------------
$sql_db_create_fill_products = "INSERT INTO Products (product_name, product_price) VALUES ('";

$row = 1;
$filename_products = "csv/product.csv";
$min = 0;
$max = 2;
$pricemin = 1;
$pricemax = 200;
$not_take; 
$ctr = 0;

if(!file_exists($filename_products) || !is_readable($filename_products))
	return FALSE;

while($ctr <= 200)
{
	if (($handle = fopen($filename_products, 'r')) !== FALSE)
	{
		while (($row = fgetcsv($handle, 100000, ',')) !== FALSE)
		{
			$rnd = mt_rand($min, $max);
			while ($rnd > 0 )
			{
				$not_take = $row;
				$rnd = $rnd - 1;
			}
			
			$rndprice = mt_rand($pricemin, $pricemax);
			
			$ctr = $ctr + 1;
			if ($ctr  <= 200)
			{
				$write = $sql_db_create_fill_products . $row[0] . "'," . $rndprice  . ".00" . ");";
				mysqli_query($conn7,$write);
				}
			}
		}
		fclose($handle);
	}


// closing connection
mysqli_close($conn7);


// Creating a connection
$conn8 = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn8) 
{
    die("Connection failed: " . mysqli_connect_error());
} 
else
{
	//echo "Connection Successfull\n";
}

// INSERT SALES ---------------------------------------------------
$sql_db_create_fill_sales = "INSERT INTO Sales (product_id, sale_date, customer_id, salesman_id) VALUES (";

$min_product = 1;
$max_product = 200;
$min_salesman = 1;
$max_salesman = 1215;
$ctr = 1;
$min = 0;
$max = 5;
$minday = 1;
$maxday = 28;
$minmonth = 1;
$maxmonth = 12;
$minyear = 2016;
$maxyear = 2019;


while($ctr <= 1620)
{
	$rnd2 = mt_rand($min, $max);
	
	while ($rnd2 > 0 )
	{
		$rnd = mt_rand($min_product, $max_product);
		$rnd3 = mt_rand($min_salesman, $max_salesman);
		$rndday = mt_rand($minday, $maxday);
		$rndmonth = mt_rand($minmonth, $maxmonth);
		$rndyear = mt_rand($minyear, $maxyear); 
		
		$write = $sql_db_create_fill_sales . $rnd . ",'" . (int)$rndyear . "-" . (int)$rndmonth . "-" . (int)$rndday . "'," . $ctr . "," . $rnd3 . ");";
		
		if ($conn8->query($write) === TRUE) 
		{
			//echo "Salesman added to Salesmans Table successfully!\n";
		} 
		else 
		{
			//echo "Error adding salesman to Salesman Table: " . mysqli_connect_error();
		}
		$rnd2 = $rnd2 - 1;
	}
	$ctr = $ctr + 1;
}

// closing connection
mysqli_close($conn8);


	echo "<form action='getmarketname.php' method='post'>";
    echo "<button name='Show Markets' onclick='location.href='getmarketname.php''>Show Markets</a></button>";
	echo "</form>";


	
	echo "<form action='getcitybyname.php' method='post'>";
    echo "<button name='Show Cities' onclick='location.href='getcitybyname.php''>Show Cities</a></button>";
	echo "</form>";

?>
