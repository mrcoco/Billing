<?php
	if($erno) die();
	/* koneksi database */
	/* link : link baca */
	$mess 	= "user : ".$DUSER." tidak bisa terhubung ke server : ".$DHOST;
	$link 	= mysql_connect($DHOST,$DUSER,$DPASS) or die(errorLog::errorDie(array($mess)));
	try{
		if(!mysql_select_db($DNAME,$link)){
			throw new Exception("user : ".$DUSER." tidak bisa terhubung ke database :".$DNAME);
		}
	}
	catch (Exception $e){
		errorLog::errorDB(array($e->getMessage()));
		$mess = "Terjadi kesalahan pada sistem<br/>Nomor Tiket : ".substr(_TOKN,-4);
		$klas = "error";
	}
	
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

	
	/* determine proses */
	switch($proses){
		case "hitung":
			$que0 = "CALL p_hitung_rekening($sm_pakai,'$gol_kode',$bln_rek,$thn_rek,1,1,@biaya_air,@biaya_adm,@biaya_denda,@total,@biaya_wm)";
			$que1 = "SELECT @biaya_air AS uangair,@biaya_adm AS adm,@biaya_denda AS denda,@total AS total,@biaya_wm AS meter,getMaterai(@biaya_air) AS materai";
			/* eksekusi prosedure*/
			try{
				if(!$res0 = mysql_query($que0,$link)){
					throw new Exception($que0);
				}
				if(!$res1 = mysql_query($que1,$link)){
					throw new Exception($que1);
				}
				else{
					$row1 = mysql_fetch_array($res1);
					$mess = "Biaya air : ".number_format($row1['uangair'])."<br/>Total + Materai : ".number_format($row1['total'] + $row1['materai']);
					$klas = "notice";
				}
			}
			catch (Exception $e){
				errorLog::errorDB(array($e->getMessage()));
				$mess = "Terjadi kesalahan pada sistem<br/>Nomor Tiket : ".substr(_TOKN,-4);
				$klas = "error";
			}
			break;
		case "simpan_tarif_industri01":
			$que0 = "CALL p_entry_tarif_industri01('$gol_kode',$tar_bln_mulai,$tar_bln_akhir,$batas_normal,@mess)";
			$que1 = "SELECT @mess AS mess";
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
					$mess = $row1['mess'];
					$klas = "notice";
				}
			}
			catch (Exception $e){
				errorLog::errorDB(array($e->getMessage()));
				$mess = "Terjadi kesalahan pada sistem<br/>Nomor Tiket : ".substr(_TOKN,-4);
				$klas = "error";
			}
			break;
	}
	
	/* tutup koneksi database */
	mysql_close($proc);
	mysql_close($link);
?>
<div class="<?php echo $klas; ?>"><?php echo $mess; ?></div>