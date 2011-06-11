<?php
	require "./fungsi.php";
	require "./model/setDB.php";
	require "./model/logging.php";
	
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

	/** predefine parameter */
	$kp_kode = 10;
	define("_KODE",$appl_kode);
	define("_NAME",$appl_name);
	define("_FILE",$appl_file);
	define("_PROC",$appl_proc);
	define("_TOKN",$appl_proc);
	/* predefine parameter **/
	
	/** koneksi database */
	$mess = "tidak bisa terhubung ke server : ".$DHOST;
	$link = mysql_connect($DHOST,$DUSER,$DPASS) or die(errorLog::errorDB(array($mess)));
	mysql_select_db($DNAME,$link);
	
	/* cek rinci rayon */
	try{
		$que0 = "SELECT *FROM tm_meter WHERE dkd_kd='$dkd_kd' LIMIT 1";
		if(!$res0 = mysql_query($que0,$link)){
			throw new Exception("Terjadi kesalahan pada sistem database<br/>Nomor Tiket : ".substr(_TOKN,-4));
		}
		else{
			if(mysql_num_rows($res0)>0){
				$mess = null;
			}
			else{
				$mess = "value = \"Data rinci rayon $dkd_kd tidak ditemukan\"";
			}
		}
	}
	catch (Exception $e){
		errorLog::errorDB(array($que0));
		$mess = "value = \"".$e->getMessage()."\"";
	}
	
	mysql_close($link);
?>
<input id="cekMess_<?php echo $nomor; ?>" type="hidden" <?php echo $mess; ?>/>