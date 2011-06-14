<?php
	if($erno) die();
	if(!isset($appl_tokn)) define("_TOKN",getToken());
	switch($proses){
		case "periksaDSR":
			echo "Harusnya halaman proses Reduksi";
			break;
		default:
			$data1[]	= array("rek_bln"=>"1","bln_nama"=>"Januari");
			$data1[]	= array("rek_bln"=>"2","bln_nama"=>"Februari");
			$parm1		= array("class"=>"cekDSR","name"=>"rek_bln","selected"=>5);
?>
<h2><?php echo _NAME; ?></h2><hr/>
<input type="hidden" class="cekDSR" name="appl_kode" 	value="<?php echo _KODE; ?>"/>
<input type="hidden" class="cekDSR" name="appl_name" 	value="<?php echo _NAME; ?>"/>
<input type="hidden" class="cekDSR" name="appl_file" 	value="<?php echo _FILE; ?>"/>
<input type="hidden" class="cekDSR" name="appl_proc" 	value="<?php echo _PROC; ?>"/>
<input type="hidden" class="cekDSR" name="appl_tokn" 	value="<?php echo _TOKN; ?>"/>
<input type="hidden" class="cekDSR" name="targetUrl" 	value="<?php echo _FILE; ?>"/>
<input type="hidden" class="cekDSR" name="targetId" 	value="content"/>
<input type="hidden" class="cekDSR" name="proses"	 	value="periksaDSR"/>
<input type="hidden" class="cekDSR" name="dump" 		value="0"/>
<div class="span-4 border">&nbsp;</div>
<div class="span-4">Nomor Pelanggan</div>
<div class="span-4">: <input type="text" class="cekDSR" name="pel_no" size="6" maxlength="6"/></div>
<br/><br/>
<div class="span-4 border">&nbsp;</div>
<div class="span-4">Bulan - Tahun</div>
<div class="span-4">
	: 
	<?php echo pilihan($data1,$parm1); ?>
	<input type="text" class="cekDSR" name="rek_thn" size="4" maxlength="4" value="2011"/>
</div>
<br/><br/>
<div class="span-12 center">
	<input type="hidden" class="cekDSR" name="cekUrl" 	value="<?php echo _PROC; ?>"/>
	<input type="hidden" class="cekDSR" name="cekId" 	value="peringatan"/>
	<input type="hidden" class="cekDSR" name="cekMess" 	value="<?php echo getToken(); ?>"/>
	<input type="Button" value="Cek Rekening" onclick="periksa('cekDSR')"/>
</div>
<?php
	}
?>