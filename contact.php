<?php include 'templates/head_top.php'; ?>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Contact Moto-Stop with Questions</title>
		<link href="styles.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="scripts/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="scripts/jquery.validate.js"></script>
		<script type="text/javascript" src="scripts/validate.js"></script>

		<meta name="description" content="Feel free to contact Moto-Stop with any questions that you might have about our products or company."/>
		<meta name="keywords" content="contact, Moto-Stop, question, about"/>
	<?php include 'templates/analytics.php'; ?>
</head>
	
	<body id="page4">
	
		<div id="container">
		
			<?php include 'templates/header.php'; ?>			
			<?php include 'templates/navigation.php'; ?>
			
			<div id="outerMain">
			
				<div id="main">
				
					<div id="ltCol-int">
					
						<h1>Contact Moto-Stop with Question or Comments</h1>
						<h2>We are available to take your calls during standard business hours Monday thru Friday or answer questions via the contact form</h2>
						
						
						
						<div id="form"> 
						
							<h3>Contact Form <span class="message">* Required Field</span></h3>
							
							<form id="contact_form" action="sent.php" method="post">
							
								<div id="formSection1">
							
									<label for="fname">First Name<span class="red">*</span></label>
									<input name="fname" id="fname" class="required" type="text" size="15" maxlength="50"/><br>
									
									<label for="lname">Last Name<span class="red">*</span></label>
									<input name="lname" id="lname" class="required" type="text" size="15" maxlength="50"/>
								
								</div>
								
								<div id="formSection2">
								
									<label for="email">E-mail<span class="red">*</span></label>
									<input name="email" id="email" class="required email" type="text" size="20" maxlength="95"/><br>
									
									<label for="phone1 phone2 phone3" id="phoneLabel">Phone</label>
									(<input name="phone1" id="phone1" class="optional digits" type="text" size="3" maxlength="3"/>)
									<input name="phone2" id="phone2" class="optional digits" type="text" size="3" maxlength="3"/>&nbsp;-
									<input name="phone3" id="phone3" class="optional digits" type="text" size="4" maxlength="4"/>
								
								</div>
								
								<div id="formSection3">
								
									<label for="how">How did you hear about us?<span class="red">*</span></label>
									<select name="how" id="how" class="required">
										<option value="--select--">-- select --</option>
										<option value="internet">Internet</option>
										<option value="Bass West USA">Bass West USA</option>
										<option value="E-bay">E-bay</option>
										<option value="Other">Other</option>
									</select><br>
									
									<label for="comments">Message<span class="red">*</span></label><br>
									<textarea name="comments" id="comments" class="required" cols="40" rows="6"></textarea><br>
								
									<input id="submitMessage" type="submit" value="Send Message"/>
									
									<div id="messageSent">Your message has been successfully sent.</div>
								
								</div>
								
							</form>
						
						</div><!-- form -->
																			
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
