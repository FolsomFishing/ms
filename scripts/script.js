$(document).ready(function(){

$("#zoom01").gzoom({sW: 300,
                    sH: 225,
                    lW: 1000,
                    lH: 750, 
                    lighbox : false
});

$("#zoom02").gzoom({sW: 300,
                    sH: 225,
                    lW: 1000,
                    lH: 750, 
                    lighbox : false
});

$("#zoom03").gzoom({sW: 300,
                    sH: 225,
                    lW: 1000,
                    lH: 750, 
                    lighbox : false
});

$("#zoom04").gzoom({sW: 300,
                    sH: 225,
                    lW: 1000,
                    lH: 750, 
                    lighbox : false
});


$('#product-2').hide();
$('#product-3').hide();
$('#product-4').hide();
                    
$('#thumb1').click(function() {
		$('#product-2').hide();
		$('#product-3').hide();
		$('#product-4').hide();
		$('#product-1').show();
		return false;
	});	
	
$('#thumb2').click(function() {
		$('#product-1').hide();
		$('#product-3').hide();
		$('#product-4').hide();
		$('#product-2').show();
		return false;
	});	
	
$('#thumb3').click(function() {
		$('#product-1').hide();
		$('#product-2').hide();
		$('#product-4').hide();
		$('#product-3').show();
		return false;
	});	

$('#thumb4').click(function() {
		$('#product-1').hide();
		$('#product-2').hide();
		$('#product-3').hide();
		$('#product-4').show();
		return false;
	});	
	

                    
});