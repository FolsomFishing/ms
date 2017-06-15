$(document).ready(function() {
	var all_tables = $("#slide1, #slide2, #slide3, #slide4").hide();
	var check = 1;
	
	//$('#slide1').show();
	
	if (check == 1){
		doit();
	}
	//***************** Look into doing a doWhile loop that increments
	function doit() {
		
		$('#slide1').fadeIn('slow');
		setTimeout(function() { $('#slide1').fadeOut('slow'); }, 7000);
		setTimeout(function() { $('#slide2').fadeIn('slow'); }, 7200);
		setTimeout(function() { $('#slide2').fadeOut('slow'); }, 11200);
		setTimeout(function() { $('#slide3').fadeIn('slow'); }, 11400);
		setTimeout(function() { $('#slide3').fadeOut('slow'); }, 18400);
		setTimeout(function() { $('#slide4').fadeIn('slow'); }, 18600);
		setTimeout(function() { $('#slide4').fadeOut('slow', function(){doit();} ); }, 25600);
		
	}
	
			
	$('#slide1-link a').click(function() {
		
		$(all_tables).fadeOut('slow', function() {
			setTimeout(function() { $('#slide1').fadeIn('slow'); }, 1000);
    		
  		});
  		
  		var check = 2;
  		return false;
		
	});	
	
	$('#slide2-link a').click(function() {
		
		$(all_tables).fadeOut('slow', function() {
			setTimeout(function() { $('#slide2').fadeIn('slow'); }, 1000);
    		
  		});
  		var check = 2;
		return false;
	});	
	
	$('#slide3-link a').click(function() {
		
		$(all_tables).fadeOut('slow', function() {
			setTimeout(function() { $('#slide3').fadeIn('slow'); }, 1000);
    		
  		});
  		var check = 2;
		return false;
	});	
	
	$('#slide4-link a').click(function() {
		
		$(all_tables).fadeOut('slow', function() {
			setTimeout(function() { $('#slide4').fadeIn('slow'); }, 1000);
    		
  		});
  		var check = 2;
		return false;
	});	
	
	
								   
});

