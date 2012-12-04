<?php

/*************************************************************************************************************************************************************************************
 *
 * This class has been adapted from HOE - PHP WITH MySQL and provides an easy interface for issuing select queries over a database
 *
 * When instanciating this class, three methods will be available:
 * 	+ dbConnect connects to the database
 *	+ dbDisconnect disconnects from the database
 *	+ getData returns an associative array based on an SQL query as an argument/parameter
 *
 * To instanciate an object, four arguments/parameters must be passed:
 *	+ $hostIn is the server address/name
 *	+ $usernameIn is the db username
 *	+ $passwordIn is the db username's password
 *	+ $schemaIn is the default db name
 *
 ************************************************************************************************************************************************************************************/

class dbHander
{
	// declare the class level variables
	private $host;
	private $username;
	private $password;
	private $schema;
	private $link;
	
	// the construct
	function __construct($hostIn, $usernameIn, $passwordIn, $schemaIn)
	{
		$this->host = $hostIn;
		$this->username = $usernameIn;
		$this->password = $passwordIn;
		$this->schema = $schemaIn;
	}
	
	// connect to db and check connection
	function dbConnect()
	{
		$this->link = new mysqli($this->host, $this->username, $this->password, $this->schema);
		
		// check connection 
		if($this->link->connect_errno)
		{
			exit($lang['dbError']);
		}
	}
	
	// disconnect from db
	function dbDisconnect()
	{
		// free result set 
		$this->link->close();
	}
	
	// get db data, accepts sql query and returns data in associative array format, this function does not htmlentities results but escapes the sql string
	function getData($sql)
	{
		// escape the query
		$this->link->real_escape_string($sql);
		
		// declare response array 
		$response = array();
		
		// get results 
		$result = $this->link->query($sql);
		
		// check query results
		if($result === false)
		{
			exit($this->link->error);
		}
		
		// fetch associative array 
		while($row = $result->fetch_assoc())
		{
			$response[] = $row;
		}
		
		// free result set 
		$result->close();
		
		// return response array 
		return $response;
	}
	
}

?>