<html>
	<head>
		<title>Login</title>
		<link href="main.css" rel="stylesheet" type="text/css">
		<style>
			table
			{
				margin-left: auto;
				margin-right: auto;
			}
			td
			{
				width: 100px;
				padding: 10px;
				text-align: center;
			}
		</style>
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
				$email = $_POST['email'];
				$password = $_POST['password'];
				
				$conn = mysqli_connect("localhost","root","lab304","arcinemas");
		
				if(mysqli_connect_errno($conn))
				{
					echo "Error".mysqli_connect_error();
				}
		
				$sql = "SELECT password FROM users WHERE email='$email'";
				$result = $conn -> query($sql);
				$tuple = mysqli_fetch_assoc($result);
				if($tuple["password"] != $password)
				{
					echo "Incorrect user details";
				}	
				
				else
				{	
					$sql = "SELECT * FROM tickets WHERE email='$email'";
					$result = $conn -> query($sql);
					
					echo "<table border=1><tr><th colspan=3><h3>Your tickets:</h3></th></tr>";
	       			echo "<tr><th>Id</th><th>Show</th><th>Seat</th></tr>";
	        
					while($row = mysqli_fetch_assoc($result))
					{
						echo "<tr><td>".$row['id']."</td><td>".$row['showtime']."</td><td>".$row['seatnum']."</td></tr>";
					}
					echo "</table>";
				}
				mysqli_close($conn);
			?>
		</div>
	</body>
</html>
