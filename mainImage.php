<?php
	$img = $_POST['name'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$fileData = base64_decode($img);
	$fileName = 'myImage8.png'; //Please Specify your directory rename it. eg: /var/www/
	
	$downloaded = file_put_contents($fileName, $fileData); 
	if($downloaded)
	{
		echo "Successfully Saved your Image.";
	}
		
	$servername = "localhost"; //server name
	$username = "root"; // username
	$password = ""; // password
	$db = "convizit_db"; //database name

	// Create connection
	$conn = new mysqli($servername, $username, $password, $db);

	$down = base64_encode(file_get_contents($fileName)); 
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	echo "Database Connected successfully";

	$sql = "INSERT INTO tbl_img (img_name, image) VALUES ('$fileName', '$down')";

	if ($conn->query($sql) === TRUE) {
	    echo "<br><h2 style='color:green;text-align:center;'>New image path created successfully into MySql Database.</h2>";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();

?>