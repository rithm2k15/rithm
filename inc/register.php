<?php
$conn=mysqli_connect("localhost", "rithm2k15", "regency","rithm2k15"); // localhost , ritfest, rithm2k15
//mysqli_select_db('rithm2k15',$conn); //reg
$myemail ="rithm2k15@regencyengg.com";

$name=$_POST['regName'];
$college=$_POST['regCollege'];
$phone=$_POST['regMobile'];
$email=$_POST['regEmail'];
$event=$_POST['regEvent'];
$topic_pp=$_POST['regEventTopic_pp'];
$topic_po=$_POST['regEventTopic_po'];
$branch=$_POST['regBranch'];



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

if ($event == "Paper Presentation" && $topic_pp == "null") {
  $error['eventTopic'] = "Please select a topic for Paper Presentation";
}

if ($event == "Poster Presentation" && $topic_po == "") {
  $error['eventTopic'] = "Please mention a topic for Poster Presentation";
}

if(!$error){
  
  if($topic_pp!="null") $topic = $topic_pp;
  else if($topic_po!="") $topic = $topic_po;
  else $topic = "NA";

  $sql = "INSERT INTO reg (`name`, `college`, `number`, `email`, `branch`,`topic`,`event`) values('".$name."','".$college."','".$phone."','".$email."','".$branch."','".$topic."','".$event."')";

  if(mysqli_query($conn,$sql) === TRUE){
    echo "OK";
    $to = $email;

    $subject = "Thank you for registring with RITHM 2K14";

    $message = "Greetings from RITHM Team! \r\r Dear $name, \r\r Welcome to RITHM 2K15!\r\r You are successfully registred with RITHM 2K14 in $event event with the email address: $email . \r\r\rThanks & Regards,\r\r RITHM 2K14 Team";

    $headers = 'From: RITHM2K15@gmail.com' . "\r\n" .

    'Reply-To: RITHM2K14@gmail.com' . "\r\n" .

    'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);

    $to = $myemail; 
    $email_subject = "Registration form submission: $name";
    $email_body = "You have received a new Registration. "." Here are the details:\n Name: $name \n College: $college \n  Email: $email \n Phone: $phone \n Events: $event \n Branch: $branch \n Topic : $topic"; 
    $headers = "From: $myemail\n"; 
    $headers .= "Reply-To: $email_address";

    mail($to,$email_subject,$email_body,$headers);
  }
  else{
    echo "Server Problem. Please try again.";
  }
}
else {

  $response = (isset($error['name'])) ? $error['name'] . "<br /> \n" : null;
  $response .= (isset($error['college'])) ? $error['college'] . "<br /> \n" : null;
  $response .= (isset($error['email'])) ? $error['email'] . "<br /> \n" : null;
  $response .= (isset($error['mobile'])) ? $error['mobile'] . "<br />" : null;
  $response .= (isset($error['event'])) ? $error['event'] . "<br />" : null;
  $response .= (isset($error['eventTopic'])) ? $error['eventTopic'] . "<br />" : null;


  echo $response;

}

?>
