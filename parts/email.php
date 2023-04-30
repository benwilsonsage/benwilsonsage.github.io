<?php
session_start();


$date = new DateTime();
$timenow = $date->getTimestamp();

$starttime = $_SESSION["starttime"];


$reasonable = $starttime + 5;


if ($timenow < $reasonable)
{
header("Location: email-error.php");
}




if ($timenow > $reasonable)
{


$name = $_POST["name"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$enquiry = $_POST["message"];


if ($enquiry == '' OR $enquiry == "From, to, and when...")
{
header("Location: email-error.php");
die;
}


if ((strpos($enquiry, 'http') == true) OR (strpos($enquiry, 'HTTP') == true)) {
	$subject = "[POSSIBLE SPAM] Website enquiry from " . $name . " ";
}
else
{
	$subject = "Website enquiry from " . $name . " ";
}

$msg = "Here is an enquiry submitted through ledatransport.co.uk

Customer name: " . $name . "
Customer email: " . $email . "
Customer phone: " . $phone . "

Enquiry: [".$enquiry."]";

$msg = wordwrap($msg,70);

$headers = 'From: Leda Website <no-reply@ledatransport.co.uk>' . PHP_EOL .
    'Reply-To: ' . $name . ' <'.$email.'>' . PHP_EOL .
    'X-Mailer: PHP/' . phpversion();


if ((strpos($enquiry, 'http') == true) OR (strpos($enquiry, 'HTTP') == true)) {
mail("ben.wilson.newcastle@gmail.com",$subject,$msg,$headers);
}
else
{
mail("ben.wilson.newcastle@gmail.com, info@ledatransport.co.uk",$subject,$msg,$headers);
}





header("Location: email-sent.php");

}








?>
