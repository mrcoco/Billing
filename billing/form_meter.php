<?php
	if(!$form) die();
	
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
	
	/* pilih ukuran meter */
	$show_ukuranmeter = true;
	try{
		$que0 	= "SELECT um_kode,CONCAT(um_ukuran,' inchi') AS um_ukuran FROM tr_ukuranmeter ORDER BY um_kode";
		if(!$res0 = mysql_query($que0,$link)){
			throw new Exception("Terjadi kesalahan pada sistem database<br/>Nomor Tiket : ".substr(_TOKN,-4));
		}
		else{
			while($row0 = mysql_fetch_array($res0)){
				$data0[] = array("um_kode"=>$row0['um_kode'],"um_ukuran"=>$row0['um_ukuran']);
			}
			$param0 = array("class"=>"simpan_<?php echo $nomor; ?> title","name"=>"um_kode","selected"=>$um_kode); 
		}
	}
	catch (Exception $e){
		errorLog::errorDB(array($que0));
		$mess = "value = \"".$e->getMessage()."\"";
		$show_ukuranmeter = false;
	}
	
	mysql_close($link);
	$formId = getToken();
?>
<div id="<?php echo $formId; ?>" class="peringatan">
<div id="pesan" class="pesan">
<h3>Form Ganti Meter</h3>
<hr/>
<table class="table_info">
	<tr>
		<td class="large">No SL</td>
		<td class="large">: <?php echo $pel_no; ?></td>
	</tr>
	<tr>
		<td class="large">Nama</td>
		<td class="large">: <?php echo $pel_nama; ?></td>
	</tr>
	<tr>
		<td class="large">Alamat</td>
		<td class="large">: <?php echo $pel_alamat; ?></td>
	</tr>
	<tr>
		<td class="large">Ukuran Meter</td>
		<td>: <?php if($show_ukuranmeter) echo pilihan($data0,$param0); ?></td>
	</tr>
	<tr>
		<td class="large">Stand Angkat</td>
		<td>
			: <input type="text" class="simpan_<?php echo $nomor; ?> title">
		</td>
	</tr>
	<tr>
		<td class="large">Stand Pasang</td>
		<td>
			: <input type="text" class="simpan_<?php echo $nomor; ?> title">
			<input type="hidden" id="error_<?php echo $nomor; ?>" <?php echo $mess; ?>/>
			<input type="hidden" class="simpan_<?php echo $nomor; ?>" name="appl_kode"	value="<?php echo _KODE;		?>"/>
			<input type="hidden" class="simpan_<?php echo $nomor; ?>" name="appl_name"	value="<?php echo _NAME; 		?>"/>
			<input type="hidden" class="simpan_<?php echo $nomor; ?>" name="appl_file"	value="<?php echo _FILE; 		?>"/>
			<input type="hidden" class="simpan_<?php echo $nomor; ?>" name="appl_proc"	value="<?php echo _PROC; 		?>"/>
			<input type="hidden" class="simpan_<?php echo $nomor; ?>" name="appl_tokn" 	value="<?php echo _TOKN; 		?>"/>
			<input type="hidden" class="simpan_<?php echo $nomor; ?>" name="nomor" 		value="<?php echo $nomor; 		?>"/>
			<input type="hidden" class="simpan_<?php echo $nomor; ?>" name="targetId" 	value="<?php echo $pel_no; 		?>"/>
			<input type="hidden" class="simpan_<?php echo $nomor; ?>" name="errorId" 	value="error_<?php echo $nomor;	?>"/>
			<input type="hidden" class="simpan_<?php echo $nomor; ?>" name="targetUrl"	value="<?php echo _PROC; 		?>"/>
			<input type="hidden" class="simpan_<?php echo $nomor; ?>" name="pel_no"	 	value="<?php echo $pel_no; 		?>"/>
			<input type="hidden" class="simpan_<?php echo $nomor; ?>" name="proses" 	value="edit_meter"/>
		</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<input type="button" value="Simpan" onclick="buka('simpan_<?php echo $nomor; ?>')"/>
			<input type="button" value="Batal" onclick="tutup('<?php echo $formId; ?>')"/>
		</td>
	</tr>
</table>
</div>
</div>