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
	
	/** Pagination */
	if(isset($pg) and $pg>1){
		$next_page 	= $pg + 1;
		$pref_page 	= $pg - 1;
		$pref_mess	= "<input type=\"button\" name=\"Submit\" value=\"<<\" class=\"form_button\" onClick=\"buka('pref_page')\"/>";
	}
	else{
		$pg 		= 1;
		$next_page 	= 2;
		$pref_page 	= 1;
	}
	$jml_perpage 	= 25;
	$limit_awal	 	= ($pg - 1) * $jml_perpage;
	/* */
	
	define("_KODE",$appl_kode);
	define("_NAME",$appl_name);
	define("_FILE",$appl_file);
	define("_PROC",$appl_proc);
	define("_TOKN",$appl_tokn);	
?>
<h2><?php echo _NAME; ?></h2>
<input type="hidden" id="errMess"/>
<table class="table_info">
	<tr class="table_cont_btm">
		<td class="left" colspan="7">Rayon : <?php echo $dkd_kd; ?></td>
		<td class="right">Hal : <?php echo $pg; ?></td>
	</tr>
	<tr class="table_head"> 
		<td>No</td>
		<td>No SL</td>
		<td>Nama</td>    
		<td>Alamat</td>        
		<td>Golongan</td>
		<td>Meter</td>
		<td>Status</td>
		<td>Manage</td>
	</tr>
<?php
	/* parameter detail rayon */
	$mess = "tidak bisa terhubung ke server : ".$DHOST;
	$link = mysql_connect($DHOST,$DUSER,$DPASS) or die(errorLog::errorDB(array($mess)));
	mysql_select_db($DNAME,$link);
	
	try{
		$que0 = "SELECT *FROM v_data_pelanggan WHERE dkd_kd='$dkd_kd' LIMIT $limit_awal,$jml_perpage";
		if(!$res0 = mysql_query($que0,$link)){
			throw new Exception($que0);
		}
		else{
			$i = 1;
			while($row0 = mysql_fetch_array($res0)){
				$class_nya = "table_cell1";
				if (($i%2) == 0){
					$class_nya = "table_cell2";
				}
				$nomor = $i+(($pg-1)*$jml_perpage);
				$kelas = "meter_$i pelanggan_$i rayon_$i";
?>
	<tr valign="top" class="<?php echo $class_nya; ?>" id="<?php echo $row0['pel_no']; ?>">
		<td><?php echo $nomor;				?></td>
		<td><?php echo $row0['pel_no'];		?></td>
		<td><?php echo $row0['pel_nama'];	?></td>
		<td><?php echo $row0['pel_alamat']; ?></td>
		<td><?php echo $row0['gol_kode'];	?></td>
		<td><?php echo $row0['um_ukuran'];	?></td>
		<td><?php echo $row0['kps_ket'];	?></td>
		<td>
			<input type="hidden" class="pelanggan_<?php echo $i; ?>" 	name="targetUrl" 	value="form_pelanggan.php"/>
			<input type="hidden" class="pelanggan_<?php echo $i; ?>" 	name="errorUrl" 	value="form_pelanggan.php"/>
			<input type="hidden" class="meter_<?php echo $i; ?>" 		name="targetUrl" 	value="form_meter.php"/>
			<input type="hidden" class="meter_<?php echo $i; ?>" 		name="errorUrl" 	value="form_meter.php"/>
			<input type="hidden" class="rayon_<?php echo $i; ?>" 		name="targetUrl" 	value="form_rayon.php"/>
			<input type="hidden" class="rayon_<?php echo $i; ?>" 		name="errorUrl" 	value="form_rayon.php"/>
			<input type="hidden" class="<?php echo $kelas; ?>" name="appl_kode"		value="<?php echo _KODE; 	?>"/>
			<input type="hidden" class="<?php echo $kelas; ?>" name="appl_name"		value="<?php echo _NAME; 	?>"/>
			<input type="hidden" class="<?php echo $kelas; ?>" name="appl_file"		value="<?php echo _FILE; 	?>"/>
			<input type="hidden" class="<?php echo $kelas; ?>" name="appl_proc"		value="<?php echo _PROC; 	?>"/>
			<input type="hidden" class="<?php echo $kelas; ?>" name="appl_tokn" 	value="<?php echo _TOKN; 	?>"/>
			<input type="hidden" class="<?php echo $kelas; ?>" name="targetId" 		value="<?php echo $row0['pel_no']; 		?>"/>
			<input type="hidden" class="<?php echo $kelas; ?>" name="errorId" 		value="error_<?php echo $nomor;			?>"/>
			<input type="hidden" class="<?php echo $kelas; ?>" name="nomor" 		value="<?php echo $nomor;				?>"/>
			<input type="hidden" class="<?php echo $kelas; ?>" name="pel_no" 		value="<?php echo $row0['pel_no']; 		?>"/>
			<input type="hidden" class="<?php echo $kelas; ?>" name="pel_nama" 		value="<?php echo $row0['pel_nama']; 	?>"/>
			<input type="hidden" class="<?php echo $kelas; ?>" name="pel_alamat" 	value="<?php echo $row0['pel_alamat']; 	?>"/>
			<input type="hidden" class="<?php echo $kelas; ?>" name="gol_kode" 		value="<?php echo $row0['gol_kode']; 	?>"/>
			<input type="hidden" class="<?php echo $kelas; ?>" name="kps_kode" 		value="<?php echo $row0['kps_kode']; 	?>"/>
			<input type="hidden" class="<?php echo $kelas; ?>" name="dkd_kd" 		value="<?php echo $row0['dkd_kd']; 		?>"/>
			<img src="./images/edit.gif" 	title="Edit data pelanggan" onclick="peringatan('pelanggan_<?php echo $i; ?>')"/>
			<img src="./images/proses.gif" 	title="Ganti water meter" 	onclick="peringatan('meter_<?php echo $i; ?>')"/>
			<img src="./images/home.png" 	title="Pindah rayon" 		onclick="peringatan('rayon_<?php echo $i; ?>')"/>
		</td>
	</tr>

<?php
				$i++;
			}
			/* Pagination */
			if($i>($jml_perpage)){
				$next_mess	= "<input type=\"button\" name=\"Submit\" value=\">>\" class=\"form_button\" onClick=\"buka('next_page')\"/>";
			}
			/* **/
		}
	}
	catch (Exception $e){
		errorLog::errorDB(array($e->getMessage()));
	}
?>
	<tr class="table_cont_btm">
		<td colspan="6">
			<input type="hidden" class="kembali" name="pg"		  value="<?php echo $kembali; ?>"/>
			<input type="hidden" class="kembali" name="targetUrl" value="view_rayon.php"/>
			<input type="hidden" class="kembali" name="targetId"  value="content"/>
			<input type="button" value="Kembali" onclick="buka('kembali')"/>
		</td>
		<td colspan="2" class="right">
			<input type="hidden" class="kembali next_page pref_page" name="appl_kode" value="<?php echo _KODE; ?>"/>
			<input type="hidden" class="kembali next_page pref_page" name="appl_name" value="<?php echo _NAME; ?>"/>
			<input type="hidden" class="kembali next_page pref_page" name="appl_file" value="<?php echo _FILE; ?>"/>
			<input type="hidden" class="kembali next_page pref_page" name="appl_proc" value="<?php echo _PROC; ?>"/>
			<input type="hidden" class="kembali next_page pref_page" name="appl_tokn" value="<?php echo _TOKN; ?>"/>
			<input type="hidden" class="kembali next_page pref_page" name="errorId"   value="errMess"/>
			<input type="hidden" class="next_page pref_page" name="kembali"   value="<?php echo $kembali;	?>"/>
			<input type="hidden" class="next_page pref_page" name="dkd_kd" 	  value="<?php echo $dkd_kd; 	?>"/>
			<input type="hidden" class="next_page pref_page" name="targetUrl" value="rinci_rayon.php"/>
			<input type="hidden" class="next_page pref_page" name="targetId"  value="content"/>
			<input type="hidden" class="next_page" name="pg" value="<?php echo $next_page; ?>"/>
			<input type="hidden" class="pref_page" name="pg" value="<?php echo $pref_page; ?>"/>
			<?php echo $pref_mess; ?>
			<?php echo $next_mess; ?>
		</td>
	</tr>
</table>