PHP PDO MySQL
===================
With this project I wanted to keep the PDO calls simple.  All parameter binding structures are the same, whether its a string, int or an array (IN Statement) it does not matter.

Please keep in mind that this is a work in process.

Initialize
------------
1. Update the Config.class.php located at /include/mysql/ to match your database credentials.

```php
<?php
// Default Settings
public $hostName = "localhost";
public $port = "";
public $dbName = "control_framework";
public $charset = "utf8";
public $userName = "root";
public $password = "";
public $cryptKey = "";
?>
```

2. Update the autoload.php located at /include/autoLoader/ to match the path of where MySQL classes are located:
ie. autoloader::register('C:/wamp/www/PDO/include/mysql');

3. In you header file or at the top of any page needing to preform a query, you need to include the autoloader.  This will include all the necessary MySQL files you will need. 
include "include/autoLoader/autoload.php"

Parameter binding method
------------
Example:
```php
<?php

include "include/autoLoader/autoload.php"

$conn = new DBConnectionMySQL();

//***********************************
//Parameters
//***********************************
$p = array();
$p["last_name"] = 'Benson';

// Query
$query = "SELECT * FROM myTable AS my WHERE my.last_name = :last_name";

// Function queryDebug: 
$results = $conn->queryDebug($query, $p);
$conn->output($results);

?>
```

Usage
------------

#### table "myTable"

| id | first_name | last_name | email
|:-----------:|:------------:|:------------:|:------------:|
| 1       |      Ethen  |     Benson    | eget.lacus@tempusloremfringilla.edu
| 2       |      Alexander |     Benson  | augue@nunc.com
| 3       |   Kamal |     Campos |    enim.nisl@Donecvitae.com
| 4       |        Arden |     Cherry    | ante.Maecenas@sollicitudinorci.net
| 5       |   Jennifer |     Hensley |     erat@dictumPhasellusin.com

#### Method ->fetch():
The method fetch() will return the first item in the array result.  This method has an optional value that can be passed to return any part of the array result.
ie. ->fetch(1) to return the second item from an array result.  An empty array will be returned if fetch value is larger then the array size.

```php
<?php

//***********************************
//Parameters
//***********************************
$p = array();
$p["last_name"] = 'Benson';

$query = "SELECT * FROM myTable AS my WHERE my.last_name = :last_name";
$results = $conn->query($query, $p)->fetch();
$conn->output($results);

?>
```

Result:

```php
Array
(
	Array
	(
		[id] => 143
		[first_name] => Ethen
		[last_name] => Benson
		[email] => eget.lacus@tempusloremfringilla.edu
		[phone] => 1-320-923-6521
		[date_created] => 2018-10-09 15:54:39
		[address1] => Ap #150-9938 Lorem Street
		[city] => Klagenfurt
		[zip] => 74799-468
	)
)
```

#### Method ->fetchAll():
The method fetchAll() will return the full array result. 

```php
<?php

//***********************************
//Parameters
//***********************************
$p = array();
$p["last_name"] = 'Benson';

$query = "SELECT * FROM myTable AS my WHERE my.last_name = :last_name";
$results = $conn->query($query, $p)->fetchAll();
$conn->output($results);

?>
```

Result:

```php
Array
(
	Array
	(
		[id] => 143
		[first_name] => Ethen
		[last_name] => Benson
		[email] => eget.lacus@tempusloremfringilla.edu
		[phone] => 1-320-923-6521
		[date_created] => 2018-10-09 15:54:39
		[address1] => Ap #150-9938 Lorem Street
		[city] => Klagenfurt
		[zip] => 74799-468
	),
	Array
	(
		[id] => 372
		[first_name] => Alexander
		[last_name] => Benson
		[email] => augue@nunc.com
		[phone] => 564-7725
		[date_created] => 2017-08-07 18:23:02
		[address1] => Ap #168-8121 Nulla Rd.
		[city] => Berbroek
		[zip] => 608567
	)
)
```

#### IN Statement Method ->fetchAll():

```php
<?php

//***********************************
//Parameters
//***********************************
$p = array();
$p["id"] = array(1, 3, 5);

$query = "SELECT * FROM myTable AS my WHERE my.id = :id";
$results = $conn->query($query, $p)->fetchAll();
$conn->output($results);

?>
```

Result:

```php
Array
(
	Array
	(
		[id] => 143
		[first_name] => Ethen
		[last_name] => Benson
		[email] => eget.lacus@tempusloremfringilla.edu
		[phone] => 1-320-923-6521
		[date_created] => 2018-10-09 15:54:39
		[address1] => Ap #150-9938 Lorem Street
		[city] => Klagenfurt
		[zip] => 74799-468
	),
	Array
	(
		[id] => 1
		[first_name] => Kamal
		[last_name] => Campos
		[email] => enim.nisl@Donecvitae.com
		[phone] => 1-456-870-5096
		[date_created] => 2018-04-12 12:23:31
		[address1] => Ap #662-7165 Donec Road
		[city] => FÃ¼rth
		[zip] => 57146
	),
	Array
	(
		[id] => 20
		[first_name] => Jennifer
		[last_name] => Hensley
		[email] => erat@dictumPhasellusin.com
		[phone] => 1-777-473-8360
		[date_created] => 2018-10-01 22:43:46
		[address1] => 476-7912 Urna St.
		[city] => Lloydminster
		[zip] => 10704
	)
)
```

#### Insert / Update / Delete ->query():

```php
<?php

//***********************************
//Parameters
//***********************************
$p = array();
$p['first_name'] = 'Fred';
$p['last_name'] = 'Smith';
$p['email'] = 'fred@fred.com';

$query = "INSERT INTO mytable
(first_name, last_name, email)
VALUES (:first_name, :last_name, :email)";

$results = $conn->queryDebug($query, $p);
$conn->output($results);

$conn->query($query, $p);
echo "Last Inserted ID: " . $conn->getInsertID();

?>
```

#### Get Last Insert ID

```php
<?php

$conn->getInsertID();

?>
```

#### Print out a nice clean array

```php
<?php

$conn->output($results);

?>
```

#### Test Connection

```php
<?php

$conn->testConnection();

?>
```
