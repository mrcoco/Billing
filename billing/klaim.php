<?php
	if($erno) die();
	/* proc : link tulis */
	$mess 	= "user : ".$PUSER." tidak bisa terhubung ke server : ".$PHOST;
	$proc 	= mysql_connect($PHOST,$PUSER,$PPASS) or die(errorLog::errorDie(array($mess)));
	try{
		if(!mysql_select_db($PNAME,$proc)){
			throw new Exception("user : ".$PUSER." tidak bisa terhubung ke database : ".$PNAME);
		}
	}
	catch (Exception $e){
		errorLog::errorDB(array($e->getMessage()));
		$mess = "Terjadi kesalahan pada sistem<br/>Nomor Tiket : ".substr(_TOKN,-4);
		$klas = "error";
	}
	switch($proses){
		/* rinci : melakukan pemeriksaan terhadap DSR */
		case "rinci":
			$note	= false;
			$que0 	= "CALL p_cek_dsr('$pel_no',$rek_bln,$rek_thn,@mess)";
			$que1 	= "SELECT @mess AS mess";
			break;
	}
	/* eksekusi prosedure*/
	try{
		if(!$res0 = mysql_query($que0,$proc)){
			throw new Exception($que0);
		}
		if(!$res1 = mysql_query($que1,$proc)){
			throw new Exception($que1);
		}
		else{
			$row1 = mysql_fetch_array($res1);
			if(!$mess = $row1['mess'])
				$mess = false;
			$klas = "notice";
		}
	}
	catch (Exception $e){
		errorLog::errorDB(array($e->getMessage()));
		$mess = "Terjadi kesalahan pada sistem<br/>Nomor Tiket : ".substr(_TOKN,-4);
		$klas = "error";
	}
	echo "<input type=\"hidden\" id=\"$cekMess\" value=\"$mess\"/>";
	if($note)
		echo "<fieldset class=\"$klas\">$mess</fieldset>";
	mysql_close($proc);
?>