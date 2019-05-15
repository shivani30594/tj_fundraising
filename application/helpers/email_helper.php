<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('send_mail'))
{    
    function send_mail($to, $subject, $body) {
		$CI = & get_instance();
		$CI->load->library('My_PHPMailer');
		$mail = new PHPMailer();
		$mail->debug = 2;
		$mail->IsSMTP(); // we are going to use SMTP
		$mail->SMTPAuth = true; // enabled SMTP authentication
		$mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
		$mail->Host = "smtp.gmail.com";      // setting GMail as our SMTP server
		$mail->Port = 465;     // SMTP port to connect to GMail
		$mail->Username = EMAILID;  // user email address
		$mail->Password = PASSWORD;	    // password in GMail
		$mail->Transport = 'Smtp';
		$mail->SetFrom(EMAILID, 'TJs Fundraising Company');  //Who is sending the email
		$mail->AddReplyTo(EMAILID, 'TJs Fundraising Company');  //email address that receives the response
		$mail->IsHTML(true);
		$mail->Subject = $subject;
		$mail->Body = $body;
		// $array = array('shp@narola.email','rip@narola.email');
		// for($i=0;$i<count($array);$i++) {
		// 	$mail->AddAddress($array[$i]);
		// }
		
		// $mail->AddAddress('shp@narola.email');
		$mail->AddAddress($to);
		// echo "<pre>";
		// print_r($mail);
		if (!$mail->send()) {
			 //$mail->print_debugger();
			// print_r($mail->ErrorInfo);
		    return 0;
		} else {
		    return 1;
		}
    }
}

if ( ! function_exists('send_mail_to_customers'))
{    
    function send_mail_to_customers($array, $subject, $body) {
		
		$CI = & get_instance();
		$CI->load->library('My_PHPMailer');
		$mail = new PHPMailer();
		$mail->debug = 2;
		$mail->IsSMTP(); // we are going to use SMTP
		$mail->SMTPAuth = true; // enabled SMTP authentication
		$mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
		$mail->Host = "smtp.gmail.com";      // setting GMail as our SMTP server
		$mail->Port = 465;     // SMTP port to connect to GMail
		$mail->Username = EMAILID;  // user email address
		$mail->Password = PASSWORD;	    // password in GMail
		$mail->Transport = 'Smtp';
		$mail->SetFrom(EMAILID, 'TJs Fundraising Company');  //Who is sending the email
		$mail->AddReplyTo(EMAILID, 'TJs Fundraising Company');  //email address that receives the response
		$mail->IsHTML(true);
		$mail->Subject = $subject;
		$mail->Body = $body;
		for($i=0;$i<count($array);$i++) {
			$mail->AddAddress($array[$i]);
		}
		if (!$mail->send()) {
			 $mail->print_debugger();
		    return 0;
		} else {
		    return 1;
		}
    }
}

if ( ! function_exists('send_mail_to_admin'))
{    
    function send_mail_to_admin($email, $subject, $body) {
		
		$CI = & get_instance();
		$CI->load->library('My_PHPMailer');
		$mail = new PHPMailer();
		$mail->debug = 2;
		$mail->IsSMTP(); // we are going to use SMTP
		$mail->SMTPAuth = true; // enabled SMTP authentication
		$mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
		$mail->Host = "smtp.gmail.com";      // setting GMail as our SMTP server
		$mail->Port = 465;     // SMTP port to connect to GMail
		$mail->Username = EMAILID;  // user email address
		$mail->Password = PASSWORD;	    // password in GMail
		$mail->Transport = 'Smtp';
		$mail->SetFrom(EMAILID, 'TJs Fundraising Company');  //Who is sending the email
		$mail->AddReplyTo(EMAILID, 'TJs Fundraising Company');  //email address that receives the response
		$mail->IsHTML(true);
		$mail->Subject = $subject;
		$mail->Body = $body;
		$mail->AddAddress($email);
		if (!$mail->send()) {
			 $mail->print_debugger();
		    return 0;
		} else {
		    return 1;
		}
    }
}



