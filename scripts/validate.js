$(document).ready(function(){
 	$('#messageSent').hide();
 	
 	$("#contact_form").validate();
	
	$("#submitMessage").click(function() {
		
	  if ($("#contact_form").valid() == true)
	  {
	  		
		    var fname = $("#fname").val();
			var lname = $("#lname").val();
			var email = $("#email").val();
			var phone1 = $("#phone1").val();
			var phone2 = $("#phone2").val();
			var phone3 = $("#phone3").val();
			var how = $("#how").val();
			var comments = $("#comments").val();  
			
			
			var dataString = 'fname=' + fname + '&lname=' + lname + '&email='+ email + '&phone1=' + phone1 + '&phone2=' + phone2 + '&phone3=' + phone3 + '&how='+ how + '&comments=' + comments;
	 		
	   		$.ajax({
	    		type: "POST",
	    		url: "mail.php",
	    		data: dataString,
	    		success: function(){
	    			closeForm();
	    			}
				});
			return false;
	  }
	  return false;
	});
});

 
 function closeForm()
{
	$("#messageSent").show("slow");
	setTimeout('$("#messageSent").hide(); $("#fname").val(""); $("#lname").val(""); $("#email").val(""); $("#phone1").val("");$("#phone2").val("");$("#phone3").val(""); $("#how").val(""); $("#comments").val("");', 2000);
};

