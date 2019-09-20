<html>
	<head>
		<link href="main.css" rel="stylesheet" type="text/css">
	</head>

	<body>
        <div id="header">
            <a href="index.html"><img src="logof.png"></a>
            <input type="text" name="search" placeholder="Search for movies">
            <ul>
				<li><a href="login.html">Log in</a></li>
				<li><a href="signup.html">Sign up</a></li>
			</ul>
		</div>
		<div class="main">	
	
			<?php
				
				$show = $_GET['show'];
				$seats = $_GET['seats'];
				$email = $_GET['email'];
				$password = $_GET['password'];
				
				$conn = mysqli_connect("localhost","root","lab304","arcinemas");
		
				if(mysqli_connect_errno($conn))
				{
					echo "Error".mysqli_connect_error();
				}
		
				$sql = "SELECT password from users WHERE email='$email'";
				$result = $conn -> query($sql);
				
				$tuple = mysqli_fetch_assoc($result);
				if($tuple["password"] != $password)
				{
					echo "Incorrect user details";
				}	
				
				else
				{
					$len = strlen($seats);
					$count = $len/4;
					$index = 0;
					for($i=0; $i<$count; $i++)
					{
						$seat  = substr($seats,$index,3);
						$sql = "INSERT INTO tickets VALUES(NULL,'$show','$seat','$email')";
						$conn -> query($sql);
						$index += 4;
					}

					echo "Seats booked successfully !";
				}
				mysqli_close($conn);
			?>
			
		</div>
		<div id="footer"></div>
	</body>

</html>
