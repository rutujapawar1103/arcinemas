<html>
	<head>
		<style>
            
            #div1
            {
            	width: 420px;
                margin-top: 30px;
                margin-left: auto;
                margin-right: auto;
            }
            
            #div2
            {
                margin-top: 0px;
                margin-left: 10px;
                width: 420px;
                text-align: center;
            	margin-left: auto;
                margin-right: auto;
            }
            
			.seat
			{
                color: green;
                float: left;
                width: 40px;
                height: 40px;
                text-align: center;
                line-height: 40px;
                border: 1px solid green;
				border-radius: 12px;
				margin: 5px;
			}
            
            .available
            {
                background-color: white;
                color: green;
            }
            
            .available:hover
            {
                cursor: pointer;
            }
            
            .booked
            {
                background-color: darkgray;
                color: white;
                border-color: darkgray; 
            }
            
            .booked:hover
            {
                cursor: default;
                background-color: darkgray;
                border-color: darkgray;
            }
            
            .clicked
            {
                background-color: green;
                color: white;
                cursor: pointer;
            }
            
            #bookbutton
            {
                margin: 20px 10px;
                width: 184px;
                height: 35px;
                background-color: #0060CC;
                color: white;
                font-family: monospace;
                font-size: 20px;
            }
            
            #bookbutton:hover
            {
                cursor: pointer;
            }
            
            .clear
            {
                clear: both;
            }
            
		</style>
	</head>
	
	<body>
            <?php
				$show = $_GET["showtime"];
                $conn = mysqli_connect("localhost","root","lab304","arcinemas");
                
                echo "<div id='div1'>";

                if(mysqli_connect_errno($conn))
                {
                    echo "Error".mysqli_connect_error();
                }
				
                $sql = "UPDATE screen SET status='booked' WHERE seatnum IN (SELECT seatnum FROM tickets WHERE showtime='$show')";
				$result = $conn->query($sql);

                $sql = "SELECT * FROM screen";
                $result = $conn->query($sql);

                $prev = 1;
                while($row = mysqli_fetch_assoc($result))
                {
                    $seat_no = $row['seatnum'];
                    $row_no = $row['rownum'];
                    $column_no = $row['colnum'];
                    $status = $row['status'];

                    if($row_no - $prev != 0)
                    {
                        echo "<br><br><br>";
                        $prev = $row_no;
                    }

                    echo "<div class='seat ".$status."' id='".$seat_no."' onclick='clicked(this.id)'><span>".$seat_no."</span></div>";
                }
                $sql = "UPDATE screen SET status='available'";
                $result = $conn->query($sql);

                mysqli_close($conn);
                
                echo "<div class='clear'></div><h3 style='background-color:grey;color:white;text-align:center;'>Screen this way !</h3></div><br>";
                echo "<div id='div2'>";
                echo "<form onsubmit='return book()' method='get' action='http://localhost/bookseats.php'>
                <label for='show'>Show: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><input type='text' id='show' name='show' value='$show' readonly><br>
                <input type='text' id='seats' name='seats' value='' style='display:none'>
                <label for='email'>Email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><input type='text' id='email' name='email' value=''><br>
                <label for='password'>Password: </label><input type='password' id='password' name='password' value=''>";
            ?>
                <input type="submit" id="bookbutton" value="BOOK TICKETS">
            </form>
        </div>
        
		<script>
            function clicked(str)
            {
                obj = document.getElementById(str);
             
                if(obj.className == 'seat available')
                    obj.className = 'seat clicked';
                
                else if(obj.className == 'seat clicked')
                    obj.className = 'seat available';
            }
            
            function book()
            {    
                arr = document.getElementsByClassName('seat clicked');
                len = arr.length;
                
                str = "";
               
                for(i=0; i<len; i++)
                    str += arr[i].id + ",";
                
                if(str == "")
          		{
                	alert("Please select seats !");
                	return false;
                }
                else
                {
                
		            document.getElementById('seats').value = str;
		            return true;
		        }
            }
		</script>
	</body>
</html>
