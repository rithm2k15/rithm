<?php

// Replace this with your own email address
$siteOwnersEmail_1 = 'mrmrg.93.com';
$siteOwnersEmail_2 = 'rithm2k15@regencyengg.com';


if($_POST) {
	$name = trim(stripslashes($_POST['regName']));
	$college = trim(stripslashes($_POST['regCollege']));
	$email = trim(stripslashes($_POST['regEmail']));
	$branch = trim(stripslashes($_POST['regBranch']));
	$mobile = trim(stripslashes($_POST['regMobile']));
	$event = trim(stripslashes($_POST['regEvent']));
	$regEventTopic = trim(stripslashes($_POST['regEventTopic']));
   // Check First Name
	if (strlen($name) < 2) {
		$error['name'] = "Please enter your first name.";
	}
	// Check Last Name
	if (strlen($college) < 2) {
		$error['college'] = "Please enter your college name.";
	}
	// Check Email
	if (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $email)) {
		$error['email'] = "Please enter a valid email address.";
	}

	//Check Event Submission
	if ($event == "null") {
		$error['event'] = "Please select an event";
	}

	if (($event == "Paper Presentation" || $event == "Poster Presentation" ) && $regEventTopic == "null") {
		$error['eventTopic'] = "Please select a topic for Poster Preparation or Paper Presentation";
	}
   // Set Message
	$message .= "Email from: " . $name . "<br />";
	$message .= "Email address: " . $email . "<br />";
	$message .= "Mobile Number [ Optional ] : " . $mobile . "<br/>";
	$message .= "Branch [ Optional ] : " . $branch . "<br/>";
	$message .= "College Name : " . $college . "<br/>";
	$message .= "Event : " . $event . "<br/>";
	$message .= "Event Topic [for PP-P and PO-P Only]: " . $regEventTopic . "<br/>";
	$message .= "<br /> ----- <br /> This email was sent from your site's Registration form. <br />";

   // Set From: header
	$from =  $name . " <" . $email . ">";

   // Email Headers
	$headers = "From: " . $from . "\r\n";
	$headers .= "Reply-To: ". $email . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


	if (!$error) {
	  $subject = "RITHM2K15 Registration Mail";
      ini_set("sendmail_from", $siteOwnersEmail_1); // for windows server
      $mail = mail($siteOwnersEmail_1, $subject, $message, $headers);

      if ($mail) { echo "OK"; }
      else { echo "Something went wrong. Please try again."; }

	} # end if - no validation error

	else {

		$response = (isset($error['name'])) ? $error['name'] . "<br /> \n" : null;
		$response .= (isset($error['college'])) ? $error['college'] . "<br /> \n" : null;
		$response .= (isset($error['email'])) ? $error['email'] . "<br /> \n" : null;
		$response .= (isset($error['mobile'])) ? $error['mobile'] . "<br />" : null;
		$response .= (isset($error['event'])) ? $error['event'] . "<br />" : null;
		$response .= (isset($error['eventTopic'])) ? $error['eventTopic'] . "<br />" : null;

		
		echo $response;

	} # end if - there was a validation error

}

?>