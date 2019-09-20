<html>
	<head>
		<title>Login</title>
		<link href="main.css" rel="stylesheet" type="text/css">
	</head>
	
	<body>
		<div id="header">
			<a href="index.html"><img src="logof.png"></a>
            <input type="text" name="search" placeholder="Search for movies">
			<ul>
				<li><a class="active" href="login.html">Log in</a></li>
				<li><a href="signup.html">Sign up</a></li>
			</ul>
		</div>
		<div class="main">
			<?php
				$name = $_POST['name'];
				$email = $_POST['email'];
				$phone = $_POST['phone'];
				$dob = $_POST['dob'];
				$password = $_POST['password'];
				
				$conn = mysqli_connect("localhost","root","lab304","arcinemas");
		
				if(mysqli_connect_errno($conn))
				{
					echo "Error".mysqli_connect_error();
				}
				
				$sql = "INSERT INTO users VALUES(NULL,'$name','$email','$phone','$dob','$password')";
				$conn -> query($sql);
				
				echo "You have successfully signed up !";	
			?>
		</div>
	</body>
</html>
