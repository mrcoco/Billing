<?php
	if($erno) die();
	$formId 	= getToken();
	$targetId 	= getToken();
	
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
	
	/* retrieve data DPD */
	/* defaul kode dpp perpamsi : 100 */
	if(!isset($dpd_kode)) $dpd_kode = '100';
	try{
		$que0 = "SELECT dpd_kode,SUBSTR(dpd_nama,1,20) AS dpd_nama FROM tm_dpd ORDER BY dpd_kode";
		if(!$res0 = mysql_query($que0,$link)){
			throw new Exception("Terjadi kesalahan pada sistem database<br/>Nomor Tiket : ".substr(_TOKN,-4));
		}
		else{
			$data0[] = array("dpd_kode"=>"100","dpd_nama"=>"DPP PERPAMSI");
			while($row0 = mysql_fetch_array($res0)){
				$data0[] = array("dpd_kode"=>$row0['dpd_kode'],"dpd_nama"=>$row0['dpd_nama']);
			}
			$mess = false;
		}
	}
	catch (Exception $e){
		errorLog::errorDB(array($que0));
		$mess = $e->getMessage();
		$erno = false;
	}
	$parm0 = array("class"=>"pilih","name"=>"dpd_kode","selected"=>$dpd_kode,"onchange"=>"buka('pilih')");

	/* retrieve data pdam */
	try{
		$que1 = "SELECT pdam_kode,SUBSTR(pdam_nama,1,20) AS pdam_nama FROM tm_pdam WHERE dpd_kode='$dpd_kode' ORDER BY dpd_kode";
		if(!$res1 = mysql_query($que1,$link)){
			throw new Exception("Terjadi kesalahan pada sistem database<br/>Nomor Tiket : ".substr(_TOKN,-4));
		}
		else{
			$data1[] = array("pdam_kode"=>$dpd_kode."0000","pdam_nama"=>"-");
			while($row1 = mysql_fetch_array($res1)){
				$data1[] = array("pdam_kode"=>$row1['pdam_kode'],"pdam_nama"=>$row1['pdam_nama']);
			}
			$mess = false;
		}
	}
	catch (Exception $e){
		errorLog::errorDB(array($que1));
		$mess = $e->getMessage();
		$erno = false;
	}
	$parm1 = array("class"=>"pilih simpan","name"=>"pdam_kode");

	/* retrieve data grup */
	try{
		$que2 = "SELECT *FROM tr_grup";
		if(!$res2 = mysql_query($que2,$link)){
			throw new Exception("Terjadi kesalahan pada sistem database<br/>Nomor Tiket : ".substr(_TOKN,-4));
		}
		else{
			while($row2 = mysql_fetch_array($res2)){
				$data2[] = array("grup_id"=>$row2['grup_id'],"grup_nama"=>$row2['grup_nama']);
			}
			$mess = false;
		}
	}
	catch (Exception $e){
		errorLog::errorDB(array($que2));
		$mess = $e->getMessage();
		$erno = false;
	}
	$parm2 = array("class"=>"pilih simpan","name"=>"grup_id","selected"=>$grup_id);
	
	if(!$erno) mysql_close($link);
?>
<div id="<?php echo $formId; ?>" class="peringatan">
<input type="hidden" class="simpan"	name="proses" 		value="tambah"/>
<input type="hidden" class="simpan"	name="targetUrl"	value="<?php echo _PROC;		?>"/>
<input type="hidden" class="simpan"	name="targetId" 	value="<?php echo $targetId;	?>"/>
<input type="hidden" class="pilih" 	name="targetUrl"	value="<?php echo __FILE__;		?>"/>
<input type="hidden" class="pilih" 	name="targetId"		value="<?php echo $formId; 		?>"/>
<div class="pesan">
<div class="span-14 right large">[<a title="Tutup jendela ini" onclick="tutup('<?php echo $formId; ?>')">Tutup</a>]</div>
<h3>Form Tambah Pengguna</h3>
<hr/>
<div class="span-8">
	<div>
		<div class="span-1 left">KODE</div>
		<div class="span-6 left">: <input type="text" size="10" class="simpan pilih" name="usr_id" value="<?php echo $usr_id; ?>"/></div>
	</div>
	<div>
		<div class="span-1 left prepend-top">NAMA</div>
		<div class="span-6 left prepend-top">: <input type="text" size="10" class="simpan pilih" name="usr_nama" value="<?php echo $usr_nama; ?>"/></div>
	</div>
	<div>
		<div class="span-1 left prepend-top">GRUP</div>
		<div class="span-6 left prepend-top">: <?php echo pilihan($data2,$parm2); ?></div>
	</div>
	<div>
		<div class="span-1 left prepend-top">DPD</div>
		<div class="span-6 left prepend-top">: <?php echo pilihan($data0,$parm0); ?></div>
	</div>
	<div>
		<div class="span-1 left prepend-top">BPAM</div>
		<div class="span-6 left prepend-top">: <?php echo pilihan($data1,$parm1); ?></div>
	</div>
	<div>
		<div class="span-1 left prepend-top">&nbsp;</div>
		<div class="span-6 left prepend-top">&nbsp;
			<input type="button" value="Simpan" onclick="buka('simpan')"/>
		</div>
	</div>
</div>
<div id="<?php echo $targetId; ?>" class="span-6"></div>
</div>
</div>