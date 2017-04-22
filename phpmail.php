<?php
	function sendMail($title, $content, $nTo, $mTo,$diachicc=''){
		$nFrom = 'FAirBox';
		$mFrom = 'tt7825948@gmail.com';	
		$mPass = 'phamvanchinh';		
		$mail             = new PHPMailer();
		$body             = $content;
		$mail->IsSMTP(); 
		$mail->CharSet 	= "utf-8";
		$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
		$mail->SMTPAuth   = true;                  	// enable SMTP authentication
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";      	
		$mail->Port       = 465;
		$mail->Username   = $mFrom;  				// GMAIL username
		$mail->Password   = $mPass;           	 	// GMAIL password
		$mail->SetFrom($mFrom, $nFrom);
		
		//chuyen chuoi thanh mang
		$ccmail = explode(',', $diachicc);
		$ccmail = array_filter($ccmail);
		if(!empty($ccmail)){
			foreach ($ccmail as $k => $v) {
				$mail->AddCC($v);
			}
		}
		$mail->Subject    = $title;
		$mail->MsgHTML($body);
		$address = $mTo;
		$mail->AddAddress($address, $nTo);
		if(!$mail->Send()) {
			return 0;
		} else {
			return 1;
		}
	}
?>