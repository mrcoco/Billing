<?php
	if($erno) die();
	include _PROC;
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
	/** Pagination */
	if(isset($pg) and $pg>1){
		$next_page 	= $pg + 1;
		$pref_page 	= $pg - 1;
		$pref_mess	= "<input type=\"button\" value=\"<<\" class=\"form_button\" onclick=\"buka('pref_page')\"/>";
	}
	else{
		$pg 		= 1;
		$next_page 	= 2;
		$pref_page 	= 1;
	}
	$jml_perpage 	= 8;
	$limit_awal	 	= ($pg - 1) * $jml_perpage;
	/* retrive info */
	switch($proses){
		default:
			$que0 	= "SELECT grup_id,grup_nama FROM tr_grup WHERE grup_id!='000' ORDER BY grup_id LIMIT $limit_awal,$jml_perpage";
	}
	try{		
		if(!$res0 = mysql_query($que0,$link)){
			throw new Exception("Terjadi kesalahan pada sistem database<br/>Nomor Tiket : ".substr(_TOKN,-4));
		}
		else{
			$i = 0;
			while($row0 = mysql_fetch_object($res0)){
				$data[] = $row0;
				$i++;
			}
			/*	menentukan keberadaan operasi next page	*/
			if($i==$jml_perpage){
				$next_mess	= "<input type=\"button\" value=\">>\" class=\"form_button\" onclick=\"buka('next_page')\"/>";
			}
			$mess 		= false;
		}
	}
	catch (Exception $e){
		errorLog::errorDB(array($que0));
		$mess = $e->getMessage();
		$erno = false;
	}
	if(!$erno) mysql_close($link);
?>
<input type="hidden" class="next_page pref_page refresh tambah kembali" name="targetId" 	value="content"/>
<input type="hidden" class="next_page pref_page refresh tambah kembali" name="targetUrl" 	value="<?=_FILE?>"/>
<input type="hidden" class="next_page pref_page refresh tambah kembali" name="appl_kode"	value="<?=_KODE?>"/>
<input type="hidden" class="next_page pref_page refresh tambah kembali" name="appl_name"	value="<?=_NAME?>"/>
<input type="hidden" class="next_page pref_page refresh tambah kembali" name="appl_file"	value="<?=_FILE?>"/>
<input type="hidden" class="next_page pref_page refresh tambah kembali" name="appl_proc"	value="<?=_PROC?>"/>
<input type="hidden" class="next_page pref_page refresh tambah kembali" name="appl_tokn" 	value="<?=_TOKN?>"/>
<input type="hidden" class="next_page" 	name="pg" value="<?=$next_page?>"/>
<input type="hidden" class="pref_page" 	name="pg" value="<?=$pref_page?>"/>
<input type="hidden" class="refresh" 	name="pg" value="<?=$pg?>"/>
<h2><?=_NAME?></h2>
<?php
	switch($proses){
		default:
?>
<center>
<input type="hidden" class="tambah" name="errorUrl"	value="form_tambah_grup.php"/>
<table class="table_info">
	<tr class="table_head">
		<td>Kode</td>
		<td>Nama</td>
		<td>Atur</td>
	</tr>
<?php
			$j = 0;
			for($i=1;$i<=$jml_perpage;$i++){
				$row0 = $data[$j];
				if ($i%2==0){
					$kelas	= "table_cell2";
				}
				else{
					$kelas 	= "table_cell1";
				}
				if($row0->grup_id){
					$grup_id 	= $row0->grup_id;
					$grup_nama	= $row0->grup_nama;
					$edit		= "<img src=\"images/edit.gif\" title=\"Edit Grup\" onclick=\"nonghol('edit_$i')\"/>";
					$appl		= "<img src=\"images/edit.gif\" title=\"Detail Hak Akses\" onclick=\"nonghol('appl_$i')\"/>";
					$hapus		= "<img src=\"images/delete.gif\" title=\"Hapus Grup\" onclick=\"peringatan('hapus_$i')\"/>";
					$j++;
				}
				else{
					$edit		= "<img src=\"images/blank.png\"/>";
					$grup_id 	= null;
					$grup_nama	= null;
					$hapus		= null;
					$detail		= null;
					$appl		= null;
				}
				$pesan 		= "Hapus grup ".$grup_nama;
				$comm		= "appl_".$i." edit_".$i." hapus_".$i;
				$errorId	= getToken();
?>
	<tr class="<?=$kelas?>" style="height:27">
		<td style="vertical-align:top"><?=$grup_id?></td>
		<td style="vertical-align:top"><?=$grup_nama?></td>
		<td>
			<input type="hidden" class="<?php echo $comm; ?>" name="appl_kode" 	value="<?php echo _KODE;		?>"/>
			<input type="hidden" class="<?php echo $comm; ?>" name="appl_nama" 	value="<?php echo _NAME;		?>"/>
			<input type="hidden" class="<?php echo $comm; ?>" name="appl_file" 	value="<?php echo _FILE;		?>"/>
			<input type="hidden" class="<?php echo $comm; ?>" name="appl_proc" 	value="<?php echo _PROC;		?>"/>
			<input type="hidden" class="<?php echo $comm; ?>" name="appl_tokn" 	value="<?php echo _TOKN;		?>"/>
			<input type="hidden" class="<?php echo $comm; ?>" name="grup_id" 	value="<?php echo $grup_id;		?>"/>
			<input type="hidden" class="<?php echo $comm; ?>" name="grup_nama" 	value="<?php echo $grup_nama;	?>"/>
			<input type="hidden" class="<?php echo $comm; ?>" name="errorId" 	value="<?php echo $errorId;		?>"/>
			<input type="hidden" class="edit_<?=$i?>" 	name="errorUrl" 	value="form_edit_grup.php"/>
			<input type="hidden" class="appl_<?=$i?>" 	name="errorUrl" 	value="form_edit_appl.php"/>
			<input type="hidden" class="hapus_<?=$i?>" 	name="targetUrl" 	value="<?=_FILE?>"/>
			<input type="hidden" class="hapus_<?=$i?>" 	name="targetId" 	value="content"/>
			<input type="hidden" class="hapus_<?=$i?>" 	name="pesan" 		value="<?=$pesan?>"/>
			<input type="hidden" class="hapus_<?=$i?>" 	name="proses" 		value="hapusGrup"/>
			<input type="hidden" class="hapus_<?=$i?>" 	name="pg" 			value="<?=$pg?>"/>
			<?=$appl." ".$edit." ".$hapus?>
		</td>
	</tr>
<?php
			}
			if($j==$jml_perpage){
				$next_mess	= "<input type=\"button\" name=\"Submit\" value=\">>\" class=\"form_button\" onclick=\"buka('next_page')\"/>";
			}
?>
	<tr class="table_cont_btm">
		<td>
			<input type="button" class="from_button" value="Tambah" onclick="nonghol('tambah')"/>
		</td>
		<td colspan="2" class="right"><?=$pref_mess." ".$next_mess?></td>
	</tr>	
</table>
</center>
<?php
	}
?>
