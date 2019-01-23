<?php
	$servername = "localhost";
	$username = "pruebas";
	$password = "pruebas";
	$dbname = "formularios";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password);

	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	} 

	//Check if the user is already register
	$sql = "SELECT 1 FROM MyUsers WHERE email = " . htmlspecialchars($_POST['email']);
	$result = mysqli_query($conn, $sql);

	//If the user is already register
	if (mysqli_num_rows($result) > 0) {
		$errores[] = "El usuario ya está registrado";
		header('Location: index.html');
	}

	//Insert new user
	$sql = "INSERT INTO MyUsers (email, name, surname, tlf, password)
	VALUES (" . htmlspecialchars($_POST['email']) . ", " . 
	htmlspecialchars($_POST['name']) . ", " .
	htmlspecialchars($_POST['surname']) . ", " .
	(int) $_POST['tlf'] . ", " .
	htmlspecialchars($_POST['password']) . ", " .
	")";

	//Check if the new user was created
	if (mysqli_query($conn, $sql)) {
		die("Error: " . $sql . "<br>" . mysqli_error($conn));
	}

	//Close connection
	mysqli_close($conn); 

	//Redirect if all ok
	header('Location: exito.php');
?>
