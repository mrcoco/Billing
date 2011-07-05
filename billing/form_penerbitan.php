<?php
 
	if($erno) die();
	if(!isset($appl_tokn)) define("_TOKN",getToken());
	switch($proses){
		case "prosesDRD":
			echo "penerbitan DRD";
			
	
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
?>
<link href="css/style.css" rel="stylesheet" type="text/css">

<fieldset> halaman proses drd </fieldset>
<?php	
break;
		default:
	/* pilih kota pelayanan */
	try{
		$que 	= "SELECT kp_kode,CONCAT('[',kp_kode,'] ',kp_ket) AS kp_ket FROM tr_kota_pelayanan ORDER BY kp_kode";
		if(!$res2 = mysql_query($que,$link)){
			throw new Exception("Terjadi kesalahan pada sistem database<br/>Nomor Tiket : ".substr(_TOKN,-4));
		}
		else{
			while($row2 = mysql_fetch_array($res2)){
				$data2[] = array("kp_kode"=>$row2['kp_kode'],"kp_ket"=>$row2['kp_ket']);
			}
			$param2 = array("class"=>"prosesDRD","name"=>"kp_kode","selected"=>$kp_kode); 
		}
	}
	catch (Exception $e){
		errorLog::errorDB(array($que));
		$error_mess	= $e->getMessage();
		$show_form 	= false;
	}
	
?>
<link href="css/style.css" rel="stylesheet" type="text/css">
<h2>Proses DRD</h2><hr/>
<input type="hidden" id="<?php echo $errorId; ?>" value="<?php echo $mess; ?>"/>
<input type="hidden" class="prosesDRD" name="appl_kode" 	value="<?php echo _KODE; ?>"/>
<input type="hidden" class="prosesDRD" name="appl_name" 	value="<?php echo _NAME; ?>"/>
<input type="hidden" class="prosesDRD" name="appl_file" 	value="<?php echo _FILE; ?>"/>
<input type="hidden" class="prosesDRD" name="appl_proc" 	value="<?php echo _PROC; ?>"/>
<input type="hidden" class="prosesDRD" name="appl_tokn" 	value="<?php echo _TOKN; ?>"/>
<input type="hidden" class="prosesDRD" name="targetUrl" 	value="<?php echo _FILE; ?>"/>
<input type="hidden" class="prosesDRD" name="targetId" 	value="content"/>
<input type="hidden" class="prosesDRD" name="proses"	 	value="prosesDRD"/>
<<<<<<< HEAD
<input type="hidden" class="prosesDRD" name="dump" 		value="1"/>
=======
<input type="hidden" class="prosesDRD" name="dump" 		value="0"/>
<div class="prepend-4 border"></div>
>>>>>>> 811b0f7... asd
<div class="span-5 center">Kota Pelayanan  </div>
<div class="span-7 center">:
  <?php echo pilihan($data2,$param2);  ?>
  </div>
<br /><br/>
<div class="span-12 center">
	<input type="hidden" class="prosesDRD" name="cekUrl" 	value="<?php echo _PROC; ?>"/>
	<input type="hidden" class="prosesDRD" name="cekId" 	value="peringatan"/>
	<input type="hidden" class="prosesDRD" name="cekMess" 	value="<?php echo getToken(); ?>"/>
	<input type="Button" value="Proses" onClick="periksa('prosesDRD')"/>
</div>
<div class="prepend-4 border"></div>
<?php
	}
?>