
<?php
// multiple recipients
$to  = 'moto-stops@comcast.net';

// subject
$subject = 'Contact Request From Website';

// message
$message = "
<html>
<head>
  <title>Contact Request</title>
<?php include 'templates/analytics.php'; ?>
</head>
<body>
  <h1 style='font-size: 1.5em; color: #ccd;'>Contact Request</h1>
  	<ul>
		<li style='line-height: 2em;'>First Name: ".$_POST['fname']."</li>
		<li style='line-height: 2em;'>Last Name: ".$_POST['lname']."</li>
		<li style='line-height: 2em;'>Email: ".$_POST['email']."</li>
		<li style='line-height: 2em;'>Phone: (".$_POST['phone1'].")".$_POST['phone2']."-".$_POST['phone3']."</li>
		<li style='line-height: 2em;'>How they heard of Moto-Stops: ".$_POST['how']."</li>
		<li style='line-height: 2em;'>Comments: ".$_POST['comments']."</li>
		
	</ul>
</body>
</html>
";

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'From: Website Contact Form' . "\r\n";
//$headers .= 'Cc: joe@example.com, mary@example.com' . "\r\n";


// Mail it
mail($to, $subject, $message, $headers);
?>

