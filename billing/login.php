<?php
	require "lib.php";
	if(isset($_POST['username'])){
		require "model/setDB.php";
		require "model/logging.php";
		require "fungsi.php";
		/** getParam 
			memindahkan semua nilai dalam array POST ke dalam
			variabel yang bersesuaian dengan masih kunci array
		*/
		$nilai	= $_POST;
		$kunci	= array_keys($nilai);
		for($i=0;$i<count($kunci);$i++){
			$$kunci[$i]	= $nilai[$kunci[$i]];
		}
		/* getParam **/
		define("_KODE",'000000');
		define("_TOKN",getToken());
		define("_USER",$username);
		define("_HOST",$ipClient);
		/* koneksi database */
		/* link : link baca */
		$mess 	= "user : ".$DUSER." tidak bisa terhubung ke server : ".$DHOST;
		$link 	= mysql_connect($DHOST,$DUSER,$DPASS) or die(errorLog::errorDie(array($mess)));
		try{
			if(!mysql_select_db($DNAME,$link)){
				throw new Exception("user : ".$DUSER." tidak bisa terhubung ke database : ".$DNAME);
			}
		}
		catch (Exception $e){
			errorLog::errorDB(array($e->getMessage()));
			$mess = "Terjadi kesalahan pada sistem<br/>Nomor Tiket : ".substr(_TOKN,-4);
			$klas = "error";
		}
		
		try{
			$que0 = "SELECT *FROM tm_karyawan WHERE kar_id='$username' AND kar_pass='$input_pass'";
			if(!$res0 = mysql_query($que0,$link)){
				throw new Exception("Terjadi kesalahan pada sistem database<br/>Nomor Tiket : ".substr(_TOKN,-4));
			}
			else{
				if(mysql_num_rows($res0) == 1){
					$row0 = mysql_fetch_array($res0);
					session_start();
					$_SESSION["User_c"]	= $row0['kar_id'];
					$_SESSION["Name_c"]	= $row0['kar_nama'];
					$_SESSION["Grup_c"]	= $row0['grup_id'];
					$_SESSION["Kota_c"]	= $row0['kp_kode'];
					header("Location: ./");
					$mess = false;
				}
				else{
					$mess = "Informasi user tidak ditemukan";
				}
			}
		}
		catch (Exception $e){
			errorLog::errorDB(array($que0));
			$mess = $e->getMessage();
			$erno = false;
		}
		if(!$erno) mysql_close($link);
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title><?php echo $application_name; ?></title>
	<link rel="shortcut icon" href="favicon.ico" type="image/ico"/>
	<link href="css/calendar.css" rel="Stylesheet" type="text/css">
	<link rel="Stylesheet" type="text/css" href="css/login.css"/>
	<script type="text/javascript" src="js/prototype.js"></script>
	<script type="text/javascript" src="js/md5-0.9.js"></script>
	<!--[if lt IE 7]>
	<script src="js/chrome.js" type="text/JavaScript"></script>
	<![endif]-->
	<!--[if lte IE 7]>
    <script type="text/javascript" src="js/unitpngfix.js"></script>
	<![endif]--> 
	<!--[if lt IE 8]>
    <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen, projection">
	<![endif]-->
	<script src="js/calendar.js" type="text/javascript"></script>
	<script src="js/calendar-en.js" type="text/javascript"></script>
	<script src="js/calendar-setup.js" type="text/javascript"></script>
</head>
<body>
<div class="container">
	<div class="span-24 header">
		<h1 class="app_title"><?php echo $appl_name; ?></h1>
				<div class="info">Tanggal: <?php echo date('d-m-Y');?>. Login sebagai <strong></strong> (<?php echo $_SERVER['REMOTE_ADDR']; ?>)</div>
			</div>
<div class="span-24 content" style="padding:5px;text-align:justify;margin-top:5px;margin-bottom:5px;height:75%">
<h2 class="title_form">Selamat Datang</h2>
	<div class="span-7 userinfo">
		<form name='form_login' method='POST' style="padding:0px 15px;">
			<p>Silakan masukkan nama pengguna &amp; kata sandi yang valid untuk mengakses aplikasi ini. [<?php echo $_SERVER['REMOTE_ADDR']; ?>]<br />&nbsp;<br />
			<img src="./images/lcd.png" alt="" style="float:left; padding:20px 25px 0px 10px;" />
			<label>Nama Pengguna:</label><br />
			<input type="text" name="username" size="15" class="form_cell"><br />
			<label>Kata Sandi:</label><br />
			<input type="password" size="15" class="form_cell" onchange="$('input_pass').value=this.value.md5()"><br /><br />
			<input type="hidden" id="input_pass" name="input_pass"/>
			<input type="submit" class="form_button" name="Submit" value="Login">
			</p>
		</form>
	</div>
	<div class="span-17 userinforight last">
	<h3>Billing SOPP</h3>
<?php if($mess){ ?>
		<p>
		<div class="notice">
			<span class="note">Info : </span><?php echo $mess; ?>
		</div>
		</p>
<?php } ?>
	</div>
</div>
 
	<div style="margin-top:5px;margin-bottom:5px;">
	</div>
	<div class="span-24 footer">
		<div id="contentbawah">
		Copyright &copy; 2011 - PDAM Tirta Raharja &amp; PT. Jerbee Indonesia | <em>Best viewed with Mozilla Firefox 3.x.x with 1024x768 resolution.</em>
		</div>
	</div>
</div>
</body>
</html>