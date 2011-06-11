<?php
	if(!$form) die();
	
	$title = "Form Edit Data Pelanggan";
	if(!isset($nomor)) $nomor = 0;
	
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
	
	/* pilih golongan */
	$show_form = true;
	try{
		$que0 	= "SELECT gol_kode,CONCAT('[',gol_kode,'] ',gol_ket) AS gol_ket FROM tr_gol WHERE gol_sts=1 ORDER BY gol_kode";
		if(!$res0 = mysql_query($que0,$link)){
			throw new Exception("Terjadi kesalahan pada sistem database<br/>Nomor Tiket : ".substr(_TOKN,-4));
		}
		else{
			while($row0 = mysql_fetch_array($res0)){
				$data0[] = array("gol_kode"=>$row0['gol_kode'],"gol_ket"=>$row0['gol_ket']);
			}
			$param0 = array("class"=>"simpan_$nomor title","name"=>"gol_kode","selected"=>$gol_kode); 
		}
	}
	catch (Exception $e){
		errorLog::errorDB(array($que0));
		$error_mess	= $e->getMessage();
		$show_form 	= false;
	}
	
	/* pilih kps */
	try{
		$que1 	= "SELECT kps_kode,kps_ket FROM tr_kondisi_ps ORDER BY kps_kode";
		if(!$res1 = mysql_query($que1,$link)){
			throw new Exception("Terjadi kesalahan pada sistem database<br/>Nomor Tiket : ".substr(_TOKN,-4));
		}
		else{
			while($row1 = mysql_fetch_array($res1)){
				$data1[] = array("kps_kode"=>$row1['kps_kode'],"kps_ket"=>$row1['kps_ket']);
			}
			$param1 = array("class"=>"simpan_$nomor title","name"=>"kps_kode","selected"=>$kps_kode); 
		}
	}
	catch (Exception $e){
		errorLog::errorDB(array($que1));
		$error_mess	= $e->getMessage();
		$show_form 	= false;
	}

	if($proses == "add_pelanggan"){
		$title = "Form Tambah Data Pelanggan";
	/* ambil nomor SL terakhir */
		try{
			$que2 	= "SELECT getLastSL() AS pel_no";
			if(!$res2 = mysql_query($que2,$link)){
				throw new Exception("Terjadi kesalahan pada sistem database<br/>Nomor Tiket : ".substr(_TOKN,-4));
			}
			else{
				$row2 	= mysql_fetch_array($res2);
				$pel_no	= $row2['pel_no'];
			}
		}
		catch (Exception $e){
			errorLog::errorDB(array($que2));
			$error_mess	= $e->getMessage();
			$show_form 	= false;
		}
	/* pilih rayon */
		try{
			$que3 	= "SELECT dkd_kd,CONCAT('[',dkd_kd,'] ',dkd_jalan) AS dkd_jalan FROM tr_dkd ORDER BY dkd_kd";
			if(!$res3 = mysql_query($que3,$link)){
				throw new Exception("Terjadi kesalahan pada sistem database<br/>Nomor Tiket : ".substr(_TOKN,-4));
			}
			else{
				while($row3 = mysql_fetch_array($res3)){
					$data3[] = array("dkd_kd"=>$row3['dkd_kd'],"dkd_jalan"=>$row3['dkd_jalan']);
				}
				$param3 = array("class"=>"simpan_$nomor title","name"=>"dkd_kd","selected"=>$dkd_kd); 
			}
		}
		catch (Exception $e){
			errorLog::errorDB(array($que3));
			$error_mess	= $e->getMessage();
			$show_form 	= false;
		}
	/* pilih ukuran meter */
		try{
			$que4 	= "SELECT um_kode,um_ukuran FROM tr_ukuranmeter ORDER BY um_kode";
			if(!$res4 = mysql_query($que4,$link)){
				throw new Exception("Terjadi kesalahan pada sistem database<br/>Nomor Tiket : ".substr(_TOKN,-4));
			}
			else{
				while($row4 = mysql_fetch_array($res4)){
					$data4[] = array("um_kode"=>$row4['um_kode'],"um_ukuran"=>$row4['um_ukuran']);
				}
				$param4 = array("class"=>"simpan_$nomor title","name"=>"um_kode","selected"=>$um_kode); 
			}
		}
		catch (Exception $e){
			errorLog::errorDB(array($que4));
			$error_mess	= $e->getMessage();
			$show_form 	= false;
		}
	}

	mysql_close($link);
?>
<div id="form_tambah_pelanggan" class="peringatan">
<div id="pesan" class="pesan">
<?php
	if($show_form){
?>
<h3><?php echo $title; ?></h3>
<hr/>
<table class="table_info">
	<tr>
		<td class="large">No SL</td>
		<td class="large">: <?php echo $pel_no; ?></td>
	</tr>
	<tr>
		<td class="large">Nama</td>
		<td>: <input type="text" class="simpan_<?php echo $nomor; ?> title" name="pel_nama" value="<?php echo $pel_nama; ?>"/></td>
	</tr>
	<tr>
		<td class="large">Alamat</td>
		<td>: <input type="text" class="simpan_<?php echo $nomor; ?> title" name="pel_alamat" value="<?php echo $pel_alamat; ?>"/></td>
	</tr>
	<tr>
		<td class="large">Golongan</td>
		<td colspan="2">
			: <?php echo pilihan($data0,$param0); ?>
		</td>
	</tr>
	<?php if($proses == "add_pelanggan"){ ?>
	<tr>
		<td class="large">Rayon</td>
		<td>
			: <?php echo pilihan($data3,$param3); ?>
		</td>
	</tr>
	<tr>
		<td class="large">Ukuran Meter (inci)</td>
		<td>
			: <?php echo pilihan($data4,$param4); ?>
		</td>
	</tr>
	<?php } ?>
	<tr>
		<td>
			<input type="hidden" class="simpan_<?php echo $nomor; ?>" name="targetId" 	value="add_pelanggan"/>
			<input type="hidden" class="simpan_<?php echo $nomor; ?>" name="appl_kode"	value="<?php echo _KODE;		?>"/>
			<input type="hidden" class="simpan_<?php echo $nomor; ?>" name="appl_name"	value="<?php echo _NAME; 		?>"/>
			<input type="hidden" class="simpan_<?php echo $nomor; ?>" name="appl_file"	value="<?php echo _FILE; 		?>"/>
			<input type="hidden" class="simpan_<?php echo $nomor; ?>" name="appl_proc"	value="<?php echo _PROC; 		?>"/>
			<input type="hidden" class="simpan_<?php echo $nomor; ?>" name="appl_tokn" 	value="<?php echo _TOKN; 		?>"/>
			<input type="hidden" class="simpan_<?php echo $nomor; ?>" name="nomor" 		value="<?php echo $nomor; 		?>"/>
			<input type="hidden" class="simpan_<?php echo $nomor; ?>" name="errorId" 	value="error_<?php echo $nomor;	?>"/>
			<input type="hidden" class="simpan_<?php echo $nomor; ?>" name="targetUrl"	value="<?php echo _PROC; 		?>"/>
			<input type="hidden" class="simpan_<?php echo $nomor; ?>" name="pel_no"	 	value="<?php echo $pel_no; 		?>"/>
			<input type="hidden" class="simpan_<?php echo $nomor; ?>" name="proses" 	value="<?php echo $proses; 		?>"/>
		</td>
		<td>
			<input type="button" value="Simpan" onclick="buka('simpan_<?php echo $nomor; ?>')"/>
			<input type="button" value="Batal" onclick="tutup('form_tambah_pelanggan')"/>
		</td>
	</tr>
</table>
<?php
	}
	else{
		echo "<span class=\"large\">$error_mess</span><br/>";
		echo "<input type=\"button\" value=\"Tutup\" onclick=\"tutup('form_tambah_pelanggan')\"/>";
	}
?>
</div>
</div>