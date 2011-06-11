<?php
	require "../fungsi.php";
	/** kode1 yang akan memindahkan semua nilai dalam array POST ke dalam */
	/*	variabel yang bersesuaian dengan masih kunci array */
	$nilai	= $_POST;
	$kunci	= array_keys($nilai);
	for($i=0;$i<count($kunci);$i++){
		$$kunci[$i]	= $nilai[$kunci[$i]];
	}
	/* kode1 **/
	
	define("_KODE",$appl_kode);
	define("_NAME",$appl_name);
	define("_FILE",$appl_file);
	define("_PROC",$appl_proc);
	define("_VIEW",$appl_view);
	define("_TOKN",getToken());

	if(isset($proses)){
?>
		<h3 class="title_form"><?=_NAME?></h3>
		<h3 align="center">
			Proses Penyerahan DSML telah dilakukan<br/>
			<input type="button" value="Cetak Daftar Penyerahan DSML"/>
		</h3>
<?php
	}
	else{
		if(isset($pilihan)){
			if(isset($dkd_kd)){
				$errMess = "Rayon $dkd_kd telah dicatat pada daftar pilihan";
			}
			else if(isset($pel_no)){
				$errMess = "SL $pel_no telah dicatat pada daftar pilihan";
			}
			else{
				$errMess = "Telah terjadi kesalahan pada sistem";
			}
		}
		else{
			if(isset($dkd_kd)){
				$errMess = "Rayon $dkd_kd telah dihapus dari daftar pilihan";
			}
			else if(isset($pel_no)){
				$errMess = "SL $pel_no telah dihapus dari daftar pilihan";
			}
			else{
				$errMess = "Telah terjadi kesalahan pada sistem";
			}
		}
?>
<input type="button" class="proses" value="Proses" onclick="peringatan('proses')"/>
<input type="hidden" id="errMess" value="<?=$errMess?>"/>
<?php
	}
?>