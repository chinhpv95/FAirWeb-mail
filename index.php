<!DOCTYPE html>
<html>
<head>
	<title>FAirApp</title>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<?php
		include "sendmail.php";

		$st = htmlspecialchars($_COOKIE["name"]);
	?>

	<center>
		<form action="sendmail.php" method="post">
		<div class="noti">
			<table>
				<tr>
					<td>
						Station:
					</td>
					<td>
    					<?php
   	 						echo $st; 
    					?>
					</td>
				</tr>
				<tr>
					<td>
						PM2.5 level:
					</td>
					<td>
						<select name="level" required>
        					<option selected value="0">Selecte one</option> 
        					<option value="1">Level 1 (0-35 μg/m3)</option>
        					<option value="2">Level 2 (36-75 μg/m3)</option>
        					<option value="3">Level 3 (76-115 μg/m3)</option>
        					<option value="4">Level 4 (116-150 μg/m3)</option>
        					<option value="5">Level 5 (151-250 μg/m3)</option>
        					<option value="6">Level 6 (251-350 μg/m3)</option>
        					<option value="7">Level 7 (>351 μg/m3)</option>
        				</select>
					</td>
				</tr>
				<tr>
					<td>
						Email:
					</td>
					<td>
						<input type="text" name="mail" size="25" required/>
					</td>
				</tr>
				<tr>
					<td>
						Duration
					</td>
					<td>
						<select name="duration" required>
        					<option selected value="0">Selecte one</option> 
        					<option value="24">A day</option>
        					<option value="48">2 days</option>
        					<option value="72">3 days</option>
        					<option value="168">A week</option>
        					<option value="336">2 weeks</option>
        					<option value="720">A month</option>
        				</select>
					</td>
				</tr>
			</table> 
        	<center><br>
        		<input class="btn-primary" type="submit" name="ok" value="Submit" />
        	</center>
		</div>	 
    </form>
	</center>
	

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>