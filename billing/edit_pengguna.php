<?php
	if($erno) die();
	switch($proses){
		case "hapus":
			$note	= false;
			$que0 	= "CALL p_hapus_pengguna('$usr_id','$usr_nama',@mess)";
			$que1 	= "SELECT @mess AS mess";
			unset($proses);
			break;
		case "tambah":
			$note	= true;
			$que0 	= "CALL p_tambah_pengguna('$usr_id','$usr_nama','$grup_id','$pdam_kode',@mess)";
			$que1 	= "SELECT @mess AS mess";
			unset($proses);
			break;
		default :
			$noQue	= true;
	}
	/* eksekusi prosedure*/
	if(!$noQue){
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
		echo "<input type=\"hidden\" id=\"$errorId\" value=\"$mess\"/>";
		if($note)
			echo "<fieldset class=\"$klas\">$mess</fieldset>";
		mysql_close($proc);
	}
?>