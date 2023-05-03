<?php

namespace App;

use PDO;

class User
{
	protected $id;
	protected $first_name;
	protected $last_name;
	protected $email;
	protected $pass;
	protected $confirm_password;
	protected $birthdate;
	protected $gender;
	protected $address;
	protected $contact_number;
	protected $created_at;

	public function getId()
	{
		return $this->id;
	}

	public function getFullName()
	{
		return $this->first_name . ' ' . $this->last_name;
	}

	public function getFirstName()
	{
		return $this->first_name;
	}

	public function getMiddleName()
	{
		return $this->middle_name;
	}

	public function getLastName()
	{
		return $this->last_name;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function  getBirthdate()
	{
		return $this->birthdate;
	}

	public function  getGender()
	{
		return $this->gender;
	}

	public function  getAddress()
	{
		return $this->address;
	}

	public function getNumber()
	{
		return $this->contact_number;
	}

	public function getPassword()
	{
		return $this->pass;
	}

	public static function getById($id)
	{
		global $conn;

		try {
			$sql = "
				SELECT * FROM users
				WHERE id=:id
				LIMIT 1
			";
			$statement = $conn->prepare($sql);
			$statement->execute([
				'id' => $id
			]);
			$result = $statement->fetchObject('App\User');
			return $result;
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return null;
	}

	//public static function hashPassword($password)
	//{
	//	$hashed_password = password_hash($password, PASSWORD_ARGON2I);
	//	return $hashed_password;
	//}

	public static function attemptLogin($email, $pass)
	{
		global $conn;

		try {
			$sql = "
				SELECT * FROM users
				WHERE email=:email
				LIMIT 1
			";
			$statement = $conn->prepare($sql);

			// Perform password hash verification (if necessary)

			$statement->execute([
				'email' => $email,
			]);
			$result = $statement->fetchObject('App\User');
			if ($result && password_verify($password, $result->getPassword())) {
				return $result;
			}
		}
			catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return null;
	}

	public static function register($first_name, $middle_name, $last_name, $email, $pass, $confirm_password, $birthdate, $gender, $address, $contact_number)
	{
		
		global $conn;
		
		if ($pass !== $confirm_password || empty($first_name) || empty($last_name) || empty($email) || empty($pass) || strlen($pass) < 8) {
			return false;
		}

		try {
			// Hash the password before inserting it to DB
			$hashed_password = password_hash($pass, PASSWORD_DEFAULT);

			$sql = "
				INSERT INTO users (first_name, middle_name, last_name, email, pass, confirm_password, birthdate, gender, address, contact_number)
				VALUES ('$first_name', '$middle_name', '$last_name', '$email', '$hashed_password', '$confirm_password', '$birthdate', '$gender', '$address', '$contact_number')
			";
			$conn->exec($sql);
			echo "<li>Executed SQL query " . $sql;
			return $conn->lastInsertId();
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}

	public static function registerMany($users)
	{
		global $conn;

		try {
			foreach ($users as $user) {
				// Hash the password before inserting it to DB
				// ..

				$sql = "
					INSERT INTO users
					SET
						first_name=\"{$user['first_name']}\",
						middle_name=\"{$user['middle_name']}\",
						last_name=\"{$user['last_name']}\",
						email=\"{$user['email']}\",
						pass=\"{$user['pass']}\"
				";
				$conn->exec($sql);
				// echo "<li>Executed SQL query " . $sql;
			}
			return true;
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}
}