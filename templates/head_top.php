<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
	<head>
	<script type="text/javascript">
		sfHover = function() {
		var sfEls = document.getElementById("nav").getElementsByTagName("LI");
		for (var i=0; i<sfEls.length; i++) {
		sfEls[i].onmouseover=function() {
		this.className+=" sfhover";
		}
		sfEls[i].onmouseout=function() {
		this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
		}
		}
		}
		if (window.attachEvent) window.attachEvent("onload", sfHover); 
	</script>