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
	
	define("_KODE",$appl_kode);
	define("_NAME",$appl_name);
	define("_FILE",$appl_file);
	define("_PROC",$appl_proc);
	define("_TOKN",$appl_tokn);	

	/* koneksi database */
	/* proc : link tulis */
	$mess = "tidak bisa terhubung ke server : ".$DHOST;
	$proc = mysql_connect($DHOST,$DUSER,$DPASS) or die(errorLog::errorDB(array($mess)));
	mysql_select_db($DNAME,$proc);
	/* link : link baca */
	$mess = "tidak bisa terhubung ke server : ".$DHOST;
	$link = mysql_connect($DHOST,$DUSER,$DPASS) or die(errorLog::errorDB(array($mess)));
	mysql_select_db($DNAME,$link);

	/* determine proses */
	switch($proses){
		case "add_pelanggan":
			//var_dump($_POST);
			$mess = "value = \"Data baru telah disimpan\"";
?>
<input type="hidden" id="<?php echo $errorId; ?>" <?php echo $mess; ?>/>
<input type="hidden" class="tambah" name="errorUrl" value="form_pelanggan.php"/>
<input type="hidden" class="tambah" name="errorUrl" value="form_pelanggan.php"/>
<input type="hidden" class="tambah" name="proses" 	value="add_pelanggan"/>
<input type="button" class="form_button" value="Tambah Pelanggan" onclick="peringatan('tambah')"/>
<?php
			break;
		case "edit_pelanggan":
			$que1 = "CALL p_edit_pelanggan(@mess)";
			$que2 = "SELECT @mess AS mess";
			break;
		default :
			/* eksekusi prosedure*/
			try{
				if(!$res1 = mysql_query($que1,$proc)){
					throw new Exception("Terjadi kesalahan pada sistem database<br/>Nomor Tiket : ".substr(_TOKN,-4));
				}
			}
			catch (Exception $e){
				errorLog::errorDB(array($que1));
				$mess = "value = \"".$e->getMessage()."\"";
			}
			
			/* parameter rayon */
			try{
				$que0 = "SELECT *FROM v_data_pelanggan WHERE pel_no='$pel_no'";
				if(!$res0 = mysql_query($que0,$link)){
					throw new Exception($que0);
				}
				else{
					$row0 	= mysql_fetch_array($res0);
					$kelas 	= "meter_$nomor pelanggan_$nomor";
				}
			}
			catch (Exception $e){
				errorLog::errorDB(array($e->getMessage()));
			}
?>
<td><?php echo $nomor;				?></td>
<td><?php echo $row0['pel_no'];		?></td>
<td><?php echo $row0['pel_nama'];	?></td>
<td><?php echo $row0['pel_alamat']; ?></td>
<td><?php echo $row0['gol_kode'];	?></td>
<td><?php echo $row0['dkd_kd'];		?></td>
<td><?php echo $row0['dkd_kd'];		?></td>
<td><?php echo $row0['kps_ket'];	?></td>
<td>
	<input type="hidden" id="error_<?php echo $nomor; ?>" <?php echo $mess; ?>/>
	<input type="hidden" class="<?php echo $kelas; ?>" name="appl_kode"		value="<?php echo _KODE; 	?>"/>
	<input type="hidden" class="<?php echo $kelas; ?>" name="appl_name"		value="<?php echo _NAME; 	?>"/>
	<input type="hidden" class="<?php echo $kelas; ?>" name="appl_file"		value="<?php echo _FILE; 	?>"/>
	<input type="hidden" class="<?php echo $kelas; ?>" name="appl_proc"		value="<?php echo _PROC; 	?>"/>
	<input type="hidden" class="<?php echo $kelas; ?>" name="appl_tokn" 	value="<?php echo _TOKN; 	?>"/>
	<input type="hidden" class="<?php echo $kelas; ?>" name="targetUrl" 	value="form_pelanggan.php"/>
	<input type="hidden" class="<?php echo $kelas; ?>" name="targetId" 		value="<?php echo $row0['pel_no']; 		?>"/>
	<input type="hidden" class="<?php echo $kelas; ?>" name="errorId" 		value="error_<?php echo $nomor;			?>"/>
	<input type="hidden" class="<?php echo $kelas; ?>" name="nomor" 		value="<?php echo $nomor;				?>"/>
	<input type="hidden" class="<?php echo $kelas; ?>" name="pel_no" 		value="<?php echo $row0['pel_no']; 		?>"/>
	<input type="hidden" class="<?php echo $kelas; ?>" name="pel_nama" 		value="<?php echo $row0['pel_nama']; 	?>"/>
	<input type="hidden" class="<?php echo $kelas; ?>" name="pel_alamat" 	value="<?php echo $row0['pel_alamat']; 	?>"/>
	<input type="hidden" class="<?php echo $kelas; ?>" name="gol_kode" 		value="<?php echo $row0['gol_kode']; 	?>"/>
	<input type="hidden" class="<?php echo $kelas; ?>" name="kps_kode" 		value="<?php echo $row0['kps_kode']; 	?>"/>
	<img src="./images/edit.gif" 	title="Edit data pelanggan" onclick="buka('pelanggan_<?php echo $i;	?>')"/>
	<img src="./images/proses.gif" 	title="Ganti water meter"/>
</td>
<?php
	}
	
	/* tutup koneksi database */
	mysql_close($proc);
	mysql_close($link);
?>