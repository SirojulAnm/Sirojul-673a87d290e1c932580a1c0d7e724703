<?php 
    $servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "soaltest";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	
	$response = array();
	
	if(isset($_GET['apicall'])){
		
		switch($_GET['apicall']){
			
			case 'signup':
				if(!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
					$username = $_POST['username']; 
					$email = $_POST['email']; 
					$password = $_POST['password'];
					
					$sql = "INSERT INTO users (username, email, password)
					VALUES ('".$username."', '".$email."', '".$password."')";

					if ($conn->query($sql) === TRUE) {
						$response['error'] = false; 
						$response['message'] = 'Suscces Registered'; 
					} else {
						$response['error'] = true; 
						$response['message'] = "Error: " . $sql . " " . $conn->error; 
					}
					
				}else{
					$response['error'] = true; 
					$response['message'] = 'required parameters are not available'; 
				}
				
			break;  
			
			case 'login':
				
				if(!empty($_POST["username"]) && !empty($_POST["password"])){

					$sql = "SELECT * FROM users WHERE username= '".$_POST["username"]."' AND password= '".$_POST["password"]."' ";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {

						$sql = "UPDATE users SET time_login= '".date("Y-m-d H:i:s")."' WHERE username= '". $_POST["username"]."' ";
						$conn->query($sql);

						$response['error'] = false; 
						$response['message'] = 'Login successfull'; 
					} 

					}else{
						$response['error'] = false; 
						$response['message'] = 'Invalid username or password';
					}
			
			break; 
			
			default: 
				$response['error'] = true; 
				$response['message'] = 'Invalid Operation Called';
		}
		
	}else{
		$response['error'] = true; 
		$response['message'] = 'Invalid API Call';
	}
	
	echo json_encode($response);