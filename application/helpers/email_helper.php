<?php 
	if (!function_exists('handle_common_author_data')) {
		function send_mail($usermail,$passwordmail,$from,$to,$name,$subject,$contentmail,$addCC = array()){
			$mail = new PHPMailer();
	        $mail->IsSMTP(); // set mailer to use SMTP
	        $mail->Host = "smtp.gmail.com"; // specify main and backup server
	        $mail->Port = 465; // set the port to use
	        $mail->SMTPAuth = true; // turn on SMTP authentication
	        $mail->SMTPSecure = 'ssl';
	        $mail->Username = $usermail; // your SMTP username or your gmail username
	        $mail->Password = $passwordmail; // your SMTP password or your gmail password
	        $mail->From = $from;
	        $mail->FromName = $name; // Name to indicate where the email came from when the recepient received
	        $mail->AddAddress($to, $name);
	        if(!empty($addCC)){
	        	foreach ($addCC as $key => $value) {
	        		$mail->AddCC($value, $value);
	        	}
	        }
	        $mail->CharSet = 'UTF-8';
	        $mail->WordWrap = 50; // set word wrap
	        $mail->IsHTML(true); // send as HTML
	        $mail->Subject = $subject;// description
	        $mail->Body = $contentmail;
	        if(!$mail->Send()){
	            return $mail->ErrorInfo;
	        }else{
	        	return "Success";
	        }
		}
	}
 ?>

