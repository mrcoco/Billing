<?php
	if(!$form) die();
	
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
	$jml_perpage 	= 6;
	$limit_awal	 	= ($pg - 1) * $jml_perpage;
	/* */

	/** predefine parameter */
	$kp_kode = 10;
?>
<h2><?php echo _NAME?></h2>
<table class="table_info" >
	<tr class="table_cont_btm">
		<td colspan="7" class="right">Hal : <?php echo $pg; ?></td>
	</tr>
	<tr class="table_head"> 
		<td width="5%">No</td>
		<td width="10%">Kode</td>   
		<td width="9%">Tgl Catat</td>        
		<td width="18%">Nama Petugas</td>
		<td width="38%">Jalan</td>
		<td width="20%">Manage</td>
	</tr>
<?php
	/** koneksi database */
	$mess = "tidak bisa terhubung ke server : ".$DHOST;
	$link = mysql_connect($DHOST,$DUSER,$DPASS) or die(errorLog::errorDB(array($mess)));
	mysql_select_db($DNAME,$link);
	
	/* inquiry informasi rayon */
	try{
		$que0 = "SELECT *FROM tr_dkd WHERE kp_kode='$kp_kode' LIMIT $limit_awal,$jml_perpage";
		if(!$res0 = mysql_query($que0,$link)){
			throw new Exception("Terjadi kesalahan pada sistem database<br/>Nomor Tiket : ".substr(_TOKN,-4));
		}
		else{
			$i = 1;
			while($row0 = mysql_fetch_array($res0)){
				$class_nya = "table_cell1";
				if (($i%2) == 0){
					$class_nya = "table_cell2";
				}
				$nomor = $i+(($pg-1)*$jml_perpage);
				$kelas = "rinci_$i import_$i";
?>
	<tr valign="top" class="<?php echo $class_nya; ?>">
		<td><?php echo $nomor;				?></td>
		<td><?php echo $row0['dkd_kd'];		?></td>
		<td><?php echo $row0['dkd_tcatat']; ?></td>
		<td><?php echo $row0['dkd_pembaca'];?></td>
		<td><?php echo $row0['dkd_jalan'];	?></td>
		<td>
			<span id="errId_<?php echo $i; ?>"></span>
			<input type="hidden" class="<?php echo $kelas; ?>" 	name="dkd_kd"		value="<?php echo $row0['dkd_kd']; ?>"/>
			<input type="hidden" class="<?php echo $kelas; ?>" 	name="appl_kode"	value="<?php echo _KODE; ?>"/>
			<input type="hidden" class="<?php echo $kelas; ?>" 	name="appl_name"	value="<?php echo _NAME; ?>"/>
			<input type="hidden" class="<?php echo $kelas; ?>" 	name="appl_file"	value="<?php echo _FILE; ?>"/>
			<input type="hidden" class="<?php echo $kelas; ?>" 	name="appl_proc"	value="<?php echo _PROC; ?>"/>
			<input type="hidden" class="<?php echo $kelas; ?>" 	name="appl_tokn" 	value="<?php echo _TOKN; ?>"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" 	name="kembali" 		value="<?php echo $pg; ?>"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" 	name="targetUrl" 	value="rinci_rayon.php"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" 	name="targetId" 	value="content"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" 	name="errorId"   	value="errMess"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" 	name="nomor"   		value="<?php echo $i; ?>"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" 	name="cekUrl"   	value="cek_rinci_rayon.php"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" 	name="cekId"   		value="errId_<?php echo $i; ?>"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" 	name="cekMess"		value="cekMess_<?php echo $i; ?>"/>
			<input type="hidden" class="import_<?php echo $i; ?>" 	name="errorUrl"		value="import_pelanggan.php"/>
			<img src="./images/edit.gif" title="Lihat Rincian" onclick="periksa('rinci_<?php echo $i; ?>')"/>
			<img src="./images/proses.gif" title="Import Data" onclick="peringatan('import_<?php echo $i; ?>')"/>
		</td>
	</tr>

<?php
				$i++;
			}
			/* Pagination */
			if($i>($jml_perpage)){
				$next_mess	= "<input type=\"button\" name=\"Submit\" value=\">>\" class=\"form_button\" onClick=\"buka('next_page')\"/>";
			}
			/* Pagination **/
		}
	}
	catch (Exception $e){
		errorLog::errorDB(array($que0));
		$mess = "value = \"".$e->getMessage()."\"";
	}
	
	mysql_close($link);
	/* koneksi database **/
?>
	<tr class="table_cont_btm">
		<td colspan="5" class="left">
			<span id="add_pelanggan">
				<input type="hidden" class="tambah" name="errorUrl" value="form_pelanggan.php"/>
				<input type="hidden" class="tambah" name="proses" 	value="add_pelanggan"/>
				<input type="button" class="form_button" value="Tambah Pelanggan" onclick="peringatan('tambah')"/>
			</span>
		</td>
		<td class="right">
			<input type="hidden" id="errMess" <?php echo $mess; ?>/>
			<input type="hidden" class="tambah next_page pref_page" name="appl_kode" value="<?php echo _KODE; ?>"/>
			<input type="hidden" class="tambah next_page pref_page" name="appl_name" value="<?php echo _NAME; ?>"/>
			<input type="hidden" class="tambah next_page pref_page" name="appl_file" value="<?php echo _FILE; ?>"/>
			<input type="hidden" class="tambah next_page pref_page" name="appl_proc" value="<?php echo _PROC; ?>"/>
			<input type="hidden" class="tambah next_page pref_page" name="appl_tokn" value="<?php echo _TOKN; ?>"/>
			<input type="hidden" class="next_page pref_page" name="targetUrl" value="<?php echo _FILE; ?>"/>
			<input type="hidden" class="next_page pref_page" name="targetId"  value="content"/>
			<input type="hidden" class="next_page pref_page" name="errorId"   value="errMess"/>
			<input type="hidden" class="next_page" name="pg" value="<?php echo $next_page; ?>"/>
			<input type="hidden" class="pref_page" name="pg" value="<?php echo $pref_page; ?>"/>
			<?php echo $pref_mess; ?>
			<?php echo $next_mess; ?>
		</td>
	</tr>
</table>