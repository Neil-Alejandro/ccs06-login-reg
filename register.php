<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration</title>
</head>
<body>
<h1>Register a User</h1>

<form action="save-registration.php" method="POST">
	<div>
		<label>First Name</label>
		<input type="text" name="first_name" placeholder="First Name" />	
	</div>
	<div>
		<label>Middle Name</label>
		<input type="text" name="middle_name" placeholder="Middle Name" />	
	</div>
	<div>
		<label>Last Name</label>
		<input type="text" name="last_name" placeholder="Last Name" />	
	</div>
	<div>
		<label>Email Address</label>
		<input type="email" name="email" placeholder="email@address.com" />	
	</div>
	<div>
		<label>Password</label>
		<input type="password" name="password" />	
	</div>
	<div>
		<label>Confirm Password</label>
		<input type="password" name="confirm_password" />	
	</div>
	<div>
		<label>Birthdate</label>
		<input type="date" name="birthdate"  />	
	</div>
	<div>
		<label>Gender</label>
		<input type="text" name="gender" />	
	</div>
	<div>
		<label>Address</label>
		<input type="text" name="address" />	
	</div>
	<div>
		<label>Contact Number</label>
		<input type="text" name="contact_number" />	
	</div>
	<div>
		<button>
			Register User
		</button>	
	</div>
</form>
<button onclick="window.location.href='login.php'">Login</a>
</body>
</html>