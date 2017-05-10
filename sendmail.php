<head>
    <link rel="icon" href="img/ico.png">
</head>
	<?php
	
		//lib PHPMailer
		include('phpmailer/class.smtp.php');
		include "phpmailer/class.phpmailer.php"; 
		include "phpmail.php";

        function vadilateMail($mail) {
            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                return 0;
            }
            return 1;
        }

        $url = "http://localhost:8000/";

		$conn = mysqli_connect('localhost', 'root', '', 'user');


		$json = file_get_contents('http://118.70.72.15:8080/sos-bundle/api/v1/timeseries');
		$data = json_decode($json, true);
		$array = array();
		$id = array(); //id PM2.5 procedure, not station
		$label = array();
		$uom = array();
		$station = array();
		$station_id = array(); //id PM2.5 procedure, not station
		$k = 0;

		$st = htmlspecialchars($_COOKIE["name"]);

		$count_array = count($data);
		$i = 0;
		foreach ($data as $value)
		{
   			$array[$i] = $value;
   			$i++;
		}

		$count = $count_array;
		//print_r($array);
		for ($j = 0; $j < $count; $j++)
		{
    		$id[$j] = $array[$j]['id']; //id PM2.5 procedure, not station
    		$label[$j] = $array[$j]['station']['properties']['label'];
    		$uom[$j] = $array[$j]['uom'];
    		$name_label[$j] = substr($array[$j]['label'], 0, 5);

    		//echo substr($uom[$j], 4, 1); echo "<br>";
    		if (substr($uom[$j], 4, 1) == "m" && ($label[$j] == $st) && ($name_label[$j] == "PM2.5") ) {
    			$id_choose = $id[$j];
    			$station_id[$k] = $id[$j]+1; //id PM2.5 procedure, not station
    			$station[$k] = $label[$j];
    			$k++;
    			/*print($id[$j]);
 				echo "  ";
    			print($label[$j]);
    			echo "<br>";
    			print($uom[$j]);
    			echo "<br>";*/
    		}
    		
    		
		}

		array_pop($label);


    	$temp_station = ' ';
        if(isset($_POST['cancel'])){
            header("Location: ". $url); /* Redirect browser */
            exit();
        }
    	if(isset($_POST['ok'])){
        	$mail=$_POST['mail'];
        	$lv=$_POST['level'];
        	$duration=$_POST['duration'];
        	if (($lv != 0) && ($duration != 0) && (vadilateMail($mail) == 1)) {
        		//echo " hello $mail, you've selected station $station, PM2.5 level $lv<br>";


        		/*function getData($id)
				{
    				$json1 = file_get_contents("http://118.70.72.15:8080/sos-bundle/api/v1/timeseries/$id");
    				$data = json_decode($json1, true);
    				return $data;
				}*/

        		

        		//compare pm2.5 level
        		

        		$sql_insert = "INSERT INTO user(mail, id_station, level, duration)
        						VALUES ('$mail', '$id_choose', '$lv', '$duration')";

        		$conn->query($sql_insert);

				$title = 'Đăng ký thành công';
				$content = 'Bạn đã đăng ký trạm '.$st.' với mức PM2.5 là '.$lv.'. Thông báo sẽ được gửi tới mail của bạn khi khớp với yêu cầu.';
				$nTo = 'Chinh';
				$mTo = $mail;




				//send mail
				$mail = sendMail($title, $content, $nTo, $mTo,$diachicc='');
				
                include "respond/success.php";


				/*for ($i=0; $i < $k; $i++) {
        			//echo $station_id[$i];
        			//echo "<br>"; 
        			if ($station == $station[$i]){
        				$temp_id = $station_id[$i];
        				echo $temp_id;
        			}
        		}*/

        	}
        	else {
                include "respond/fail.php";
            }
        }    	
    ?>


    <?php

	?>
