<?php
$to = "trisan@comcast.net";
$subject = "Contact Request From Web Site";
$message = 
	"First Name: ".$_POST["fname"]. "\n".
	"Last Name: ".$_POST["lname"]. "\n".
	"Email: ".$_POST["email"]. "\n".
	"Phone: (".$_POST['phone1'].") ".$_POST['phone2']."-".$_POST['phone3']. "\n".
	"How They Heard of Moto-Stop: ".$_POST['how']. "\n".
	"Message: ".$_POST['comments']
;
$from = $_POST["email"];
$headers = "From: $from";
mail($to,$subject,$message,$headers);
?>


<?php include 'templates/head_top.php'; ?>
		<title>Message Sent</title>
		<link href="styles.css" rel="stylesheet" type="text/css"/>
		<meta name="description" content="message sent"/>
	<?php include 'templates/analytics.php'; ?>
</head>
	
	<body id="page2">
	
		<div id="container">
		
			<?php include 'templates/header.php'; ?>			
			<?php include 'templates/navigation.php'; ?>
			
			<div id="outerMain">
			
				<div id="main">
				
					<div id="ltCol-int">
					
						<h1>Message Successfully Sent</h1>
						<h2>Thank you for your interest, we will reply to you shortly.</h2>
						
						<hr>
						
						<p>Please continue to browse our site or return to the home <a href="index.html">page</a>.</p>
						
													
					</div><!-- ltCol-int -->
						
						
						
					<?php include 'templates/sidebar.php'; ?>
					
					<div class="spanHeight"></div>
					
				</div><!-- main -->
				
				<div id="mainFoot">
				
				</div><!-- mainFoot -->
				
			</div><!-- outerMain -->
			
			<div id="foot">
			
			</div><!-- foot -->
			
		</div><!-- container -->
		
		<div id="pageSpanBtm">
		</div><!-- pageSpanBtm -->
		
	</body><!-- End of Page 1 -->
	
</html>
