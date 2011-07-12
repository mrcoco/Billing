<?php
	if($erno) die();
	$formId 	= getToken();
	$errorId 	= getToken();
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
	switch($proses){
		case "hide":
			$que0 	= "SELECT *,getMenu('$grup_id',appl_kode) AS appl_sts FROM v_menu_billing WHERE appl_kode='$kode'";
			break;
		case "rinci":
			$que0 = "SELECT *,getMenu('$grup_id',appl_kode) AS appl_sts FROM v_menu_billing WHERE parent_id='$kode'";
			break;
		default:
			$que0 = "SELECT *,getMenu('$grup_id',appl_kode) AS appl_sts FROM v_menu_billing WHERE parent_id='000000'";
	}
	try{		
		if(!$res0 = mysql_query($que0,$link)){
			throw new Exception("Terjadi kesalahan pada sistem database<br/>Nomor Tiket : ".substr(_TOKN,-4));
		}
		else{
			while($row0 = mysql_fetch_object($res0)){
				$data[] = $row0;
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
	switch($proses){
		case "hide":
?>		<input type="hidden" class="<?php echo $kode; ?>" name="appl_kode" 	value="<?php echo _KODE; 		?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="appl_nama" 	value="<?php echo _NAME; 		?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="appl_file" 	value="<?php echo _FILE; 		?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="appl_proc" 	value="<?php echo _PROC; 		?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="appl_tokn" 	value="<?php echo _TOKN; 		?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="errorId" 	value="<?php echo $errorId; 	?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="grup_id"	value="<?php echo $grup_id;		?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="grup_nama"	value="<?php echo $grup_nama;	?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="targetId"	value="<?php echo $kode; 		?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="targetUrl" 	value="<?php echo __FILE__; 	?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="kode"		value="<?php echo $kode; 		?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="nama"		value="<?php echo $nama; 		?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="proses" 	value="rinci"/>
		<img src="./images/plus.gif" title="Rinci" onclick="buka('<?php echo $kode; ?>')"/>
		<?=$nama?>
<?php
			break;
		case "rinci":
			$errorId = getToken();
?>
		<input type="hidden" class="<?php echo $kode; ?>" name="appl_kode" 	value="<?php echo _KODE; 		?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="appl_nama" 	value="<?php echo _NAME; 		?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="appl_file" 	value="<?php echo _FILE; 		?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="appl_proc" 	value="<?php echo _PROC; 		?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="appl_tokn" 	value="<?php echo _TOKN; 		?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="errorId" 	value="<?php echo $errorId; 	?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="grup_id"	value="<?php echo $grup_id;		?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="grup_nama"	value="<?php echo $grup_nama;	?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="targetId"	value="<?php echo $kode; 		?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="targetUrl" 	value="<?php echo __FILE__; 	?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="kode"		value="<?php echo $kode; 		?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="nama"		value="<?php echo $nama; 		?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="proses" 	value="hide"/>
		<img src="./images/minus.gif" title="Rinci" onclick="buka('<?php echo $kode; ?>')"/>
		<?=$nama?>
<?php
			for($i=0;$i<count($data);$i++){
				$row0	= $data[$i];
				$kode 	= $row0->appl_kode;
				$nama 	= $row0->appl_name;
				$comm	= $kode." pilihan_".$kode;
?>
		<input type="hidden" class="<?=$comm?>" name="appl_kode" 	value="<?php echo _KODE; 		?>"/>
		<input type="hidden" class="<?=$comm?>" name="appl_nama" 	value="<?php echo _NAME; 		?>"/>
		<input type="hidden" class="<?=$comm?>" name="appl_file" 	value="<?php echo _FILE; 		?>"/>
		<input type="hidden" class="<?=$comm?>" name="appl_proc" 	value="<?php echo _PROC; 		?>"/>
		<input type="hidden" class="<?=$comm?>" name="appl_tokn" 	value="<?php echo _TOKN; 		?>"/>
		<input type="hidden" class="<?=$comm?>" name="errorId" 		value="<?php echo $errorId; 	?>"/>
		<input type="hidden" class="<?=$comm?>" name="grup_id"		value="<?php echo $grup_id;		?>"/>
		<input type="hidden" class="<?=$comm?>" name="grup_nama"	value="<?php echo $grup_nama;	?>"/>
		<input type="hidden" class="<?=$comm?>" name="kode"			value="<?php echo $kode; 		?>"/>
		<input type="hidden" class="<?=$comm?>" name="nama"			value="<?php echo $nama; 		?>"/>
<?php
				if($row0->appl_sts > 0){
					$checked = "checked";
				}
				else{
					unset($checked);
				}
				if(strlen($row0->appl_file)<4){
?>
	<div id="<?php echo $kode; ?>" class="span-5 prepend-1">
		<input type="hidden" class="<?php echo $kode; ?>" name="targetId"	value="<?php echo $kode;	?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="targetUrl" 	value="<?php echo __FILE__; ?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="proses" 	value="rinci"/>
		<img src="./images/plus.gif" title="Rinci" onclick="buka('<?php echo $kode; ?>')"/>
		<?=$nama?>
	</div>
<?php
				}
				else{
?>
	<div class="span-5 prepend-1">
		<input type="hidden" class="pilihan_<?=$kode?>" name="proses" 		value="simpanAppl"/>
		<input type="hidden" class="pilihan_<?=$kode?>" name="targetId"		value="hasil"/>
		<input type="hidden" class="pilihan_<?=$kode?>" name="targetUrl" 	value="<?php echo _PROC; ?>"/>
		<input id="pilihan_<?=$kode?>" type="checkbox" <?=$checked?> onclick="pilihan('pilihan_<?=$kode?>')"/>
		<?=$nama?>
	</div>
<?
				}
			}
			break;
		default :
?>
<div id="<?php echo $formId; ?>" class="peringatan">
<div class="pesan">
<div class="span-14 right large">[<a title="Tutup jendela ini" onclick="tutup('<?php echo $formId; ?>')">Tutup</a>]</div>
<h3>Form Edit Hak Akses Grup : <?php echo $grup_nama; ?></h3>
<hr/>
<div class="span-8 left">
<?php
			for($i=0;$i<count($data);$i++){
				$row0		= $data[$i];
				$kode 		= $row0->appl_kode;
				$nama 		= $row0->appl_name;
?>
	<div id="<?php echo $kode; ?>" class="span-6">
		<input type="hidden" class="<?php echo $kode; ?>" name="appl_kode" 	value="<?php echo _KODE;		?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="appl_nama" 	value="<?php echo _NAME;		?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="appl_file" 	value="<?php echo _FILE;		?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="appl_proc" 	value="<?php echo _PROC;		?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="appl_tokn" 	value="<?php echo _TOKN;		?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="errorId" 	value="<?php echo $errorId; 	?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="grup_id"	value="<?php echo $grup_id;		?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="grup_nama"	value="<?php echo $grup_nama;	?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="targetId"	value="<?php echo $kode; 		?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="targetUrl"	value="<?php echo __FILE__;		?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="kode"		value="<?php echo $kode; 		?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="nama"		value="<?php echo $nama; 		?>"/>
		<input type="hidden" class="<?php echo $kode; ?>" name="proses" 	value="rinci"/>
		<img src="./images/plus.gif" title="Rinci" onclick="buka('<?php echo $kode; ?>')"/>
		<?=$nama?>
	</div>
<?php
			}
?>
</div>
<div class="span-6" id="hasil"></div>
</div>
</div>
<?php
	}
?>