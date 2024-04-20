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
