<?php
	if($erno) die();
	$errorId = getToken();
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
		$pref_mess	= "<input type=\"button\" value=\"<<\" class=\"form_button\" onClick=\"buka('pref_page')\"/>";
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
			$que0 	= "SELECT *FROM v_pengguna WHERE usr_id!='admin' ORDER BY pdam_kode LIMIT $limit_awal,$jml_perpage";
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
				$next_mess	= "<input type=\"button\" value=\">>\" class=\"form_button\" onClick=\"buka('next_page')\"/>";
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
<input type="hidden" class="next_page pref_page refresh pilih tambah kembali" name="appl_tokn" 	value="<?php echo _TOKN; ?>"/>
<input type="hidden" class="next_page pref_page refresh pilih tambah kembali" name="appl_kode"	value="<?php echo _KODE; ?>"/>
<input type="hidden" class="next_page pref_page refresh pilih tambah kembali" name="appl_name"	value="<?php echo _NAME; ?>"/>
<input type="hidden" class="next_page pref_page refresh pilih tambah kembali" name="appl_file"	value="<?php echo _FILE; ?>"/>
<input type="hidden" class="next_page pref_page refresh pilih tambah kembali" name="appl_proc"	value="<?php echo _PROC; ?>"/>
<input type="hidden" class="next_page pref_page refresh tambah kembali" name="targetId"		value="content"/>
<input type="hidden" class="next_page pref_page refresh tambah kembali" name="targetUrl" 	value="<?php echo _FILE; ?>"/>
<input type="hidden" class="next_page" 	name="pg" value="<?php echo $next_page;	?>"/>
<input type="hidden" class="pref_page" 	name="pg" value="<?php echo $pref_page;	?>"/>
<input type="hidden" class="refresh" 	name="pg" value="<?php echo $pg;		?>"/>
<h2><?=_NAME?></h2>
<?php
	switch($aksi){
		default:
?>
<center>
<table class="table_info">
<tr class="table_head">
	<td class="center">ID</td>
	<td class="center">Nama</td>
	<td class="center">BPAM</td>
	<td class="center">Grup</td>
	<td class="center">Atur</td>
</tr>
<?php
			$j = 0;
			for($i=1;$i<=$jml_perpage;$i++){
				$row0 	= $data[$j];
				if ($i%2==0){
					$kelas	= "table_cell2";
				}
				else{
					$kelas 	= "table_cell1";
				}
				$usr_id 	= $row0->usr_id;
				$usr_nama	= $row0->usr_nama;
				$dlet		= "del_".$usr_id;
				$edit		= "edt_".$usr_id;
				$rset		= "del_".$usr_id;
				$comm 		= $dlet." ".$edit." ".$rset;
				$pesan		= "Yakin akan menghapus user ".$usr_nama;
				$edit		= "<img src=\"images/edit.gif\"  border=\"0\" title=\"Detail\" onClick=\"\"/>";
				$hapus		= "<img src=\"images/delete.gif\"  border=\"0\" title=\"Hapus User\" onClick=\"peringatan('".$dlet."')\"/>";
				$reset		= "<img src=\"images/icon-refresh.png\"  border=\"0\" title=\"Reset Password\" onClick=\"\"/>";
?>
	<tr class="<?=$kelas?>">
		<td class="right"><?=$usr_id?></td>
		<td><?=$usr_nama?></td>
		<td><?=$row0->pdam_nama?></td>
		<td><?=$row0->grup_nama?></td>
		<td>
<?php
				if($j<count($data)){
?>
			<input type="hidden" class="<?php echo $comm; ?>" name="appl_tokn" 	value="<?php echo _TOKN; 	?>"/>
			<input type="hidden" class="<?php echo $comm; ?>" name="appl_kode"	value="<?php echo _KODE; 	?>"/>
			<input type="hidden" class="<?php echo $comm; ?>" name="appl_name"	value="<?php echo _NAME; 	?>"/>
			<input type="hidden" class="<?php echo $comm; ?>" name="appl_file"	value="<?php echo _FILE; 	?>"/>
			<input type="hidden" class="<?php echo $comm; ?>" name="appl_proc"	value="<?php echo _PROC; 	?>"/>
			<input type="hidden" class="<?php echo $comm; ?>" name="errorId" 	value="<?php echo $errorId;	?>"/>
			<input type="hidden" class="<?php echo $comm; ?>" name="usr_id" 	value="<?php echo $usr_id;	?>"/>
			<input type="hidden" class="<?php echo $comm; ?>" name="usr_nama" 	value="<?php echo $usr_nama;?>"/>
			<input type="hidden" class="<?php echo $dlet; ?>" name="targetUrl"	value="<?php echo _FILE; 	?>"/>
			<input type="hidden" class="<?php echo $dlet; ?>" name="pesan"		value="<?php echo $pesan;	?>"/>
			<input type="hidden" class="<?php echo $dlet; ?>" name="targetId"	value="content"/>
			<input type="hidden" class="<?php echo $dlet; ?>" name="proses"		value="hapus"/>
<?php
					echo $edit." ".$reset." ".$hapus;
				}
				else{
					echo "<img src=\"images/blank.png\"/>";
				}
?>
		</td>
	</tr>
<?php
				$j++;
			}
			if($j==$jml_perpage){
				$next_mess	= "<input type=\"button\" name=\"Submit\" value=\">>\" class=\"form_button\" onClick=\"buka('next_page')\"/>";
			}
?>
	<tr class="table_cont_btm">
		<td colspan="4">
			<input type="hidden" class="tambah" name="errorUrl"	value="form_tambah_pengguna.php"/>
			<input type="button" class="from_button" value="Tambah" onclick="nonghol('tambah')"/>
		</td>
		<td colspan="2" class="right"><?=$pref_mess." ".$next_mess?></td>
	</tr>	
</table>
</center>
<?php
	}
?>
