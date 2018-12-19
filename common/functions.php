<?php
	require_once dirname(__FILE__) . '/config.php';
	require_once dirname(__FILE__) . '/class.phpmailer.php';
	
	function logToFile($filename, $msg)
	{
		$fd = fopen($filename, "a");
		$str = "[" . date("Y/m/d h:i:s", time()) . "] " . $msg;
		fwrite($fd, $str . "\n");
		fclose($fd);
	}
	
	function EC_MkDir($path, $mode = 0777) {
		$dirs = explode(DIRECTORY_SEPARATOR , $path);
		$count = count($dirs);
		$path = '.';
		for ($i = 0; $i < $count; ++$i) {
			$path .= DIRECTORY_SEPARATOR . $dirs[$i];
			if (!is_dir($path) && !mkdir($path, $mode)) {
				return false;
			}
		}
		return true;
	}
	function EC_generateRandom( $len ){
		$strpattern = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";
		$result = "";
		for( $i = 0 ; $i < $len; $i ++ ){
			$rand = rand( 0, strlen($strpattern) - 1 );
			$result = $result.$strpattern[$rand];
		}
		return $result;
	}
	function EC_isLogin(){
		if( isset($_COOKIE['EC_TOKEN'])){
			return true;
		}else{
			return false;
		}
	}
	function EC_setCookie( $name, $value){
		setcookie($name, $value."", time() + ( 2 * 7 * 24 * 60 * 60));
	}
	function EC_getCookie( $name ){
		return $_COOKIE[$name];
	}
	function EC_deleteCookie( $name ){
		setcookie($name, "", time() - 3600);
	}
	
	function EC_getCurrentId( ){
		if( EC_isLogin () ){
			return EC_getUserId( $_COOKIE['EC_TOKEN'] );
		}else
			return "";
	}
	
	function EC_getUserId( $token ){
		global $db;
		if( $token == "" )
			return "";
		else{
			$sql = "select ec_user from ec_user where ec_token = '$token'";
			$result = $db->queryArray( $sql );
			if( $result == null )
				return "";
			else
				return $result[0]['ec_user'];
		}
	}
	
	function EC_getCurrentType( ){
		if( EC_isLogin () ){
			return EC_getUserType( $_COOKIE['EC_TOKEN'] );
		}else
			return "";
	}
	
	function EC_getUserType( $token ){
		global $db;
		if( $token == "" )
			return "";
		else{
			$sql = "select ec_user_type from ec_user where ec_token = '$token'";
			$result = $db->queryArray( $sql );
			if( $result == null )
				return "";
			else
				return $result[0]['ec_user_type'];
		}
	}
	function EC_sendEmail( $email, $subject, $message ){
		$mail = new PHPMailer();
		
		$mail->IsSMTP();     // telling the class to use SMTP
		$mail->SMTPDebug = 1;           // enables SMTP debug information (for testing)

		$mail->SMTPAuth   = true;                    // enable SMTP authentication
		$mail->SMTPSecure = "ssl";                   // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";        // sets GMAIL as the SMTP server
		$mail->Port       = 465;                     // set the SMTP port for the GMAIL server
		$mail->Username   = EC_MAIL_FROM;  // GMAIL username
		$mail->Password   = EC_MAIL_FROM_PWD;            // GMAIL password
		
		$mail->SetFrom($email, SITE_NAME);
		$mail->Subject = $subject;
		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!";
		$mail->MsgHTML( $message );

		$mail->AddAddress($email, SITE_NAME);
		
		if(!$mail->Send()) {
			return "Mailer Error: " . $mail->ErrorInfo;
		} else {
			return "Message sent!";
		}						
	}	
?>