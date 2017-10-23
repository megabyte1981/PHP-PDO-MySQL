<?php

	include "include/autoLoader/autoload.php";

	$conn = new DBConnectionMySQL();

	//***********************************
	//Parameters
	//***********************************
	$p = array();
	$p["last_name"] = 'Benson';

	$query = "SELECT * FROM mytable AS my WHERE my.last_name = :last_name";

	// Function queryDebug: Will return the render query after all parameter bindings have been set
	$results = $conn->queryDebug($query, $p);
	$conn->output($results);

	// Function fetchAll:  Will return all records from a data set
	$results = $conn->query($query, $p)->fetchAll();
	$conn->output($results);

	// Function fetch: Fetch a single record from a data set.
	// Default is the first element of the data set. If you need to fetch
	// a different element from the data set just pass the index ie. ->fetch(1);
	$results = $conn->query($query, $p)->fetch();
	$conn->output($results);

    // IN STATEMENT
	//***********************************
	//Parameters
	//***********************************
	$p = array();
	$p["id"] = array(1, 3, 5);

	$query = "SELECT * FROM mytable AS my WHERE my.id = :id";
	$results = $conn->queryDebug($query, $p);
	$conn->output($results);

	// Function fetchAll:  Will return all records from a data set
	$results = $conn->query($query, $p)->fetchAll();
	$conn->output($results);


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
