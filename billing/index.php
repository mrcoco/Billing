<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
	include "lib.php";
	include "fungsi.php";
	cek_pass();
?>
<html>
<head>
	<title><?php echo $application_name; ?></title>
	<link rel="shortcut icon" type="image/ico" href="<?php echo $appl_logo; ?>"/>
	<link rel="Stylesheet" type="text/css" href="css/style.css"/>
	<script type="text/javascript" src="js/prototype.js"></script>
	<script type="text/javascript" src="js/kontrol.js"></script>
	<script>
		function resize(){
			var dim = Element.getHeight('load');
			var tin = dim - 117;
			Element.setStyle('content',({height: ''+tin+''}));
		}
	</script>
</head>
<body>
<div id="load" class="load"></div>
<div id="peringatan" class="load"></div>
<div id="container" class="container">
	<div id="header" class="header"></div>
	<div id="menu" class="menu">
		<ul id="navmenu-h">
			<li><a href="./">Home</a></li>
			<?php include "menu.inc.php";?>
			<li><a href="./logout.php">Logout</a></li>
		</ul>
	</div>
	<div id="content"></div>
	<div id="footer"></div>
</div>
<script>
	$('load').hide();
	$('peringatan').hide();
</script>
</body>
</html>