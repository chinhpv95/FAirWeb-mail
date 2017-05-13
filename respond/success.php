<head>
	<title>Subcribe Successful</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="img/ico.png">

	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<form action="sendmail.php" method="post">
	<center>
		<div class="respond">
			<p>You've subcribed successful. A confirmation email will be sent.</p>
			<p>Back to homepage in 3 seconds</p>
			<script type="text/javascript">
	            function Redirect() {
	               window.location="http://localhost:8000/";
	            }
            	setTimeout('Redirect()', 3000);
      		</script>
		</div>	 
	</center>
</form>