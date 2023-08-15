<?php		
	//start a session
	session_start();
	
	//connection string
	$server = "localhost";
	$dbname = "mpg";
	$username = "root";
	$password = "";


	//create connection to the database on the server
	$connection = mysqli_connect($server,$username,$password,$dbname);
	
	// Check connection
	if (mysqli_connect_errno()){
		die ("Failed to connect to MySQL: " . mysqli_connect_error());
	}

	//retrieve the values from the login form and store them in variables
	$username = $_POST['username'];
	$password = $_POST['password'];

	//setup the sql statement
	$usersSQL = "SELECT givenName, surname FROM student WHERE username= '" . $username . "' AND Password = '" . $password . "'";
	
	//execute sql statement and store results in a variable
	$userDetails = mysqli_query($connection,$usersSQL);
		  
	//check if first row is not null
	$row = mysqli_fetch_array($userDetails);
	
	mysqli_close($connection);
	
	//*** IMPORTANT **!!if login is successful, store the user's fullname in a session
	if($row <> null){
		$fullname = $row['givenName'] . " " . $row['surname'];
		$_SESSION["fullname"] = $fullname;
		header("Location: index.php");
	}
	
	//if login not successful, redirect user to loginForm.html
	else{
		
		header("Location: loginForm.html");
		echo("<script language='javascript' type='text/javascript'> alert('Username or Password Incorrect!'); 
		window.location='loginForm.html';
		</script>");
	}
	//close connection
	mysqli_close($connection);
?>