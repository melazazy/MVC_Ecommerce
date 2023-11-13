<?php
class Database
{
	private $db;
	public function __construct()
	{
		try {
			$string = DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";";
			$this->db = new PDO($string, DB_USER, DB_PASS);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			// Log the error message to a file or use a proper error handling mechanism.
			error_log("Database connection failed: " . $e->getMessage());
			// Optionally, you can rethrow the exception for higher-level error handling.
			throw $e;
		}
	}
	// public function db_connect()
	// {
	// 	try {
	// 		$string = DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";";
	// 		return new PDO($string, DB_USER, DB_PASS);
	// 	} catch (PDOException $e) {
	// 		// Log the error message to a file or use a proper error handling mechanism.
	// 		error_log("Database connection failed: " . $e->getMessage());
	// 		// Optionally, you can rethrow the exception for higher-level error handling.
	// 		throw $e;
	// 	}
	// }

	// public function read($query, $data = [])
	// {
	// 	$check = 0;
	// 	$DB = $this->db;
	// 	$stm = $DB->prepare($query);

	// 	if (count($data) == 0) {
	// 		$stm = $DB->query($query);
	// 		// $check = 0;
	// 		if ($stm) {
	// 			$check = 1;
	// 		}
	// 	} else {

	// 		$check = $stm->execute($data);
	// 	}

	// 	if ($check) {
	// 		$data = $stm->fetchAll(PDO::FETCH_OBJ);
	// 		if (is_array($data) && count($data) > 0) {
	// 			return $data;
	// 		}
	// 		return false;
	// 		// return $false[] = [];
	// 	} else {
	// 		return false;
	// 	}
	// }
	public function read($query, $data = [])
	{
		try {
			$stm = $this->db->prepare($query);

			if (count($data) == 0) {
				$stm->execute();
			} else {
				$stm->execute($data);
			}

			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			// Handle PDO exceptions (e.g., log or throw custom exceptions)
			error_log($e->getMessage());
			return false;
		}
	}
	// Old function 
	public function write_old($query, $data = [])
	{
		// $DB = $this->db_connect();
		$DB = $this->db;
		$stm = $DB->prepare($query);

		if (count($data) == 0) {
			$stm = $DB->query($query);
			$check = 0;
			if ($stm) {
				$check = 1;
			}
		} else {
			$check = $stm->execute($data);
		}

		if ($check) {
			return true;
		} else {
			return false;
		}
	}
	public function write_new($query, $data = [])
	{
		// $DB = $this->db_connect();
		$DB = $this->db;

		try {
			$stm = $DB->prepare($query);

			if (empty($data)) {
				$check = $stm->execute();
			} else {
				$check = $stm->execute($data);
			}

			if ($check) {
				error_log(print_r($stm->$_REQUEST, true));
				return true;
			} else {
				// Handle error or log it
				error_log(print_r($stm->errorInfo(), true));
				return false;
			}
		} catch (PDOException $e) {
			// Handle PDO exceptions (e.g., log or throw custom exceptions)
			return false;
		}
	}
	public function write($query, $data = [])
	{
		// $DB = $this->db_connect();
		$DB = $this->db;

		try {
			$stm = $DB->prepare($query);

			if (!empty($data)) {
				$check = $stm->execute($data);
			} else {
				$check = $stm->execute();
			}

			if ($check) {

				return true;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			// Handle PDO exceptions (e.g., log or throw custom exceptions)
			error_log($e->getMessage());
			return false;
		}
	}

	function debugQueryold($query, $data = [])
	{
		// Create a copy of the query string
		$debugQuery = $query;

		// Replace placeholders with actual values from the data array
		foreach ($data as $param => $value) {
			// Check if the value is a string
			if (is_string($value)) {
				// Quote and escape the value
				$value = "'" . addslashes($value) . "'";
			} else {
				// Convert non-string values to strings
				$value = strval($value);
			}

			// Replace the placeholder in the query with the value
			$debugQuery = str_replace(':' . $param, $value, $debugQuery);
		}

		// Output the debug query
		echo "Debug Query: " . $debugQuery . " The End  ";
	}
	function debugQuery($query, $data)
	{
		// Create a copy of the query string
		$debugQuery = $query;

		// Replace placeholders with actual values from the data array
		foreach ($data as $param => $value) {
			// Check if the value is null
			if (is_null($value)) {
				$value = 'NULL';
			} else {
				// Convert the value to a string representation
				$value = strval($value);
				// Quote and escape the value
				$value = "'" . addslashes($value) . "'";
			}

			// Replace the placeholder in the query with the value
			$debugQuery = str_replace(':' . $param, $value, $debugQuery);
		}

		// Return the resulting debug query string
		return $debugQuery;
	}
}
