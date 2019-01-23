<?php
	class database_functions {

		public function __construct() {
			date_default_timezone_set("UTC");
		}

		private $config = array(
			'host'				=> '', //Host ip
			'username'			=> '', //database username
			'password'			=> '', //database user password
			'default_database'	=> ''	       //database name
		);

		function database_connect($database = "") {
			if($database == "") {
				$database = $this->config["default_database"];
			}
			$conn = new mysqli($this->config['host'], $this->config['username'], $this->config['password'], $database);
	
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 

			return $conn;
		}

		/*
			mysqli object $conn = connection object to database
			string $table_name = name of table in which to insert
			string $item_types = mysqli_stmt::bind_param parameter types
				i - integer
				d - double
				s - string
				b - blob
			array(string list) $array_of_rows = rows in table to insert INTO
			array(string list) $array_of_values = VALUES to be inserted in rows

			bool insert_to_database($conn, $table_name, $item_types, $array_of_rows, $array_of_values)
		*/
		function insert_to_database($conn, $table_name, $item_types, $array_of_rows, $array_of_values) {
			//create the query
			$insrt_query = "INSERT INTO ".$table_name." (";
			$number_of_items = strlen($item_types);
			for($i = 0; $i < $number_of_items; $i++) {
				$insrt_query .= $array_of_rows[$i];
				if($i < $number_of_items-1) {
					$insrt_query .= ",";
				}
			}
			$insrt_query .= ") VALUES(";
			for($i = 0; $i < $number_of_items; $i++) {
				$insrt_query .= "?";
				if($i < $number_of_items-1) {
					$insrt_query .= ",";
				}
			}
			$insrt_query .= ")";
			
			//prepare to insert
			$insrt_stmt = $conn->prepare($insrt_query);

			$reference_array = array();
			$reference_array[0] = &$item_types;

			for($i=1; $i<=strlen($item_types); $i++){
				$reference_array[$i]=&$array_of_values[$i-1];
			}

			//var_dump($reference_array);
			//insert via reference array
			$ref = new ReflectionClass('mysqli_stmt'); 

			$method = $ref->getMethod("bind_param"); 

			$method->invokeArgs($insrt_stmt, $reference_array); 

			return $insrt_stmt->execute();  
		}

		/*
			mysqli object $conn = connection object to database
			string $table_name = name of table from which to select
			array(string list) $array_of_selected_rows = rows that you wish to select
			OPTIONAL:
			string $item_types = mysqli_stmt::bind_param parameter types
				i - integer
				d - double
				s - string
				b - blob
			array(string list) $array_of_rows = *row name* + *operator*		example: (WHERE) username= (WHERE) id>
			array(string list) $array_of_values = values that you compare using the operator in $array_of_rows to the string in $array_of_rows element

			WARNING: Last 3 parameters optional. If left empty, funtion will select all rows from table

			mysqli_stmt object select_from_database($conn, $table_name, $item_types, $array_of_rows, $array_of_values)

			IMPORTANT select_from_database returns bool(FALSE) if fails
			USAGE:
			$stmt = $object_name->select_from_database($conn, $table_name, $array_of_selected_rows, $item_types, $array_of_rows, $array_of_values);
			$stmt->bind_result($value1, $value2, $value3);
			while($stmt->fetch())
				work with $value1, $value2 etc. here
			$stmt->close();	
		*/
		function select_from_database($conn, $table_name, $array_of_selected_rows, $item_types = "", $array_of_rows = NULL, $array_of_values = NULL, $additional_param = "") {
			//create the query
			$select_query = "SELECT ";
			for($i = 0; $i < sizeof($array_of_selected_rows); $i++) {
				$select_query .= $array_of_selected_rows[$i];
				if($i < sizeof($array_of_selected_rows)-1) {
					$select_query .= ",";
				}
			}
			$select_query .= " FROM ".$table_name;

			if($array_of_values) {
				$select_query .= " WHERE ";
				for($i = 0; $i < strlen($item_types); $i++) {
					$select_query .= $array_of_rows[$i]."?";
					if($i < strlen($item_types)-1) {
						$select_query .= " AND ";
					}
				}
			}

			$select_query .= $additional_param;

			//var_dump($select_query);
			//prepare the statement
			$select_stmt = $conn -> stmt_init();

			$select_stmt = $conn->prepare($select_query);
			if(!$select_stmt) return FALSE;
			$reference_array = array();
			$reference_array[0] = &$item_types;

			for($i=1; $i<=strlen($item_types); $i++){
				$reference_array[$i]=&$array_of_values[$i-1];
			}
			//var_dump($reference_array);
			//execute the statement via reference array
			$ref = new ReflectionClass('mysqli_stmt'); 

			$method = $ref->getMethod("bind_param"); 

			$method->invokeArgs($select_stmt, $reference_array); 

			$select_stmt->execute();
			return $select_stmt;
		}

		/*
			mysqli object $conn = connection object to database
			OPTIONAL:
			string $item_types = mysqli_stmt::bind_param parameter types
				i - integer
				d - double
				s - string
				b - blob
			array(string list) $array_of_rows = *row name* + *operator*		example: (WHERE) username= (WHERE) id>
			array(string list) $array_of_values = values that you compare using the operator in $array_of_rows to the string in $array_of_rows element

			WARNING: Last 3 parameters optional. If left empty, funtion will select all rows from table

			mysqli_stmt object select_from_database($conn, $item_types, $array_of_rows, $array_of_values)

			IMPORTANT select_from_database returns bool(FALSE) if fails
			USAGE:
			$stmt = $object_name->select_from_database_query_given($conn, $item_types, $array_of_where_values);
			$stmt->bind_result($value1, $value2, $value3);
			while($stmt->fetch())
				work with $value1, $value2 etc. here
			$stmt->close();	
		*/
		function select_from_database_query_given($conn, $select_query, $item_types = "", $array_of_where_values = NULL) {
			$select_stmt = $conn -> stmt_init();

			$select_stmt = $conn->prepare($select_query); 
			if(!$select_stmt) return FALSE;
			$reference_array = array();
			$reference_array[0] = &$item_types;

			for($i=1; $i<=strlen($item_types); $i++){
				$reference_array[$i]=&$array_of_where_values[$i-1];
			}
			//var_dump($reference_array);
			//execute the statement via reference array
			$ref = new ReflectionClass('mysqli_stmt'); 

			$method = $ref->getMethod("bind_param"); 

			$method->invokeArgs($select_stmt, $reference_array); 

			$select_stmt->execute();
			return $select_stmt;
		}

		/*
			mysqli object $conn = connection object to database
			string $table_name = name of table to update
			string $item_types = mysqli_stmt::bind_param parameter types, used for both $array_of_values AND for $array_of_where_values
				i - integer
				d - double
				s - string
				b - blob
			array(string list) $array_of_rows = rows that you wish to update
			array(string list) $array_of_values = values for the update

			array(string list) $array_of_where_rows = *row name* + *operator*		example: (WHERE) username= (WHERE) id>
			array(string list) $array_of_where_values = values that you compare using the operator in $array_of_rows to the string in $array_of_rows element

			IMPORTANT update_in_database() returns bool(TRUE) if succeeds, bool(FALSE) if fails
		*/
		function update_in_database($conn, $table_name, $item_types, $array_of_rows, $array_of_values, $array_of_where_rows, $array_of_where_values) {
			$update_stmt = $conn -> stmt_init();

			$update_query = "UPDATE $table_name SET ";
			for($i = 0; $i < sizeof($array_of_rows); $i++) {
				$update_query .= $array_of_rows[$i]."=?";
				if($i < sizeof($array_of_rows)-1) {
					$update_query .= ",";
				}
			}

			$update_query .= " WHERE ";
			for($i = 0; $i < sizeof($array_of_where_rows); $i++) {
				$update_query .= $array_of_where_rows[$i]."?";
				if($i < sizeof($array_of_where_rows)-1) {
					$update_query .= " AND ";
				}
			}

			$update_stmt = $conn->prepare($update_query);
			if(!$update_stmt) return FALSE;
			$reference_array = array();
			$reference_array[0] = &$item_types;

			$j = 1;
			for($i=1; $i<=sizeof($array_of_values); $i++){
				$reference_array[$j]=&$array_of_values[$i-1];
				$j++;
			}
			for($i=1; $i<=sizeof($array_of_where_values); $i++){
				$reference_array[$j]=&$array_of_where_values[$i-1];
				$j++;
			}

			$ref = new ReflectionClass('mysqli_stmt'); 

			$method = $ref->getMethod("bind_param"); 

			$method->invokeArgs($update_stmt, $reference_array); 

			return $update_stmt->execute();
		}

		function delete_from_database($conn, $table_name, $item_types, $array_of_rows, $array_of_values) {
			$delete_query = "DELETE FROM ".$table_name;

			if($array_of_values) {
				$delete_query .= " WHERE ";
				for($i = 0; $i < strlen($item_types); $i++) {
					$delete_query .= $array_of_rows[$i]."?";
					if($i < strlen($item_types)-1) {
						$delete_query .= " AND ";
					}
				}
			}

			$delete_stmt = $conn->prepare($delete_query);
			if(!$delete_stmt) return FALSE;
			$reference_array = array();
			$reference_array[0] = &$item_types;

			$j = 1;
			for($i=1; $i<=sizeof($array_of_values); $i++){
				$reference_array[$j]=&$array_of_values[$i-1];
				$j++;
			}

			$ref = new ReflectionClass('mysqli_stmt'); 

			$method = $ref->getMethod("bind_param"); 

			$method->invokeArgs($delete_stmt, $reference_array); 

			return $delete_stmt->execute();
		}
	}