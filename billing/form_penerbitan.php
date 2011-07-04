<?php
	if($erno) die();
	if(!isset($appl_tokn)) define("_TOKN",getToken());
	switch($proses){
		case "prosesDRD":
			echo "penerbitan DRD";
?>
<link href="css/style.css" rel="stylesheet" type="text/css">

<fieldset> halaman proses drd </fieldset>
<?php	
break;
		default:
			$data1[]	= array("rek_bln"=>"1","bln_nama"=>"Januari");
			$data1[]	= array("rek_bln"=>"2","bln_nama"=>"Februari");
			$data1[] = array("rek_bln"=>"3","bln_nama"=>"Maret");
   			$data1[] = array("rek_bln"=>"4","bln_nama"=>"April");
   			$data1[] = array("rek_bln"=>"5","bln_nama"=>"Mei");
   			$data1[] = array("rek_bln"=>"6","bln_nama"=>"Juni");
   			$data1[] = array("rek_bln"=>"7","bln_nama"=>"Juli");
			$data1[] = array("rek_bln"=>"8","bln_nama"=>"Agustus");
			$data1[] = array("rek_bln"=>"2","bln_nama"=>"September");
			$data1[] = array("rek_bln"=>"2","bln_nama"=>"Oktober");
			$data1[] = array("rek_bln"=>"2","bln_nama"=>"November");
			$data1[] = array("rek_bln"=>"2","bln_nama"=>"Desember");
			$parm1	 = array("class"=>"prosesDRD","name"=>"rek_bln","selected"=>6);

?>
<link href="css/style.css" rel="stylesheet" type="text/css">
<h2>Proses DRD</h2><hr/>
<input type="hidden" class="prosesDRD" name="appl_kode" 	value="<?php echo _KODE; ?>"/>
<input type="hidden" class="prosesDRD" name="appl_name" 	value="<?php echo _NAME; ?>"/>
<input type="hidden" class="prosesDRD" name="appl_file" 	value="<?php echo _FILE; ?>"/>
<input type="hidden" class="prosesDRD" name="appl_proc" 	value="<?php echo _PROC; ?>"/>
<input type="hidden" class="prosesDRD" name="appl_tokn" 	value="<?php echo _TOKN; ?>"/>
<input type="hidden" class="prosesDRD" name="targetUrl" 	value="<?php echo _FILE; ?>"/>
<input type="hidden" class="prosesDRD" name="targetId" 	value="content"/>
<input type="hidden" class="prosesDRD" name="proses"	 	value="prosesDRD"/>
<input type="hidden" class="prosesDRD" name="dump" 		value="0"/>
<div class="span-4 center">Kota Pelayanan  </div>
<div class="span-4 center">: 
  <input type="text" class="prosesDRD" name="kp_kode" size="18" maxlength="18"></div>
<br/><br />
<div class="span-4 center">Bulan-Tahun</div>
<div class="span-4 center">
                         : <?php echo pilihan($data1,$parm1); ?>
						<input type="text" class="prosesDRD" name="rek_thn" size="4" maxlength="4" value="2011"> </div>
<br /><br/>
<div class="span-12 center">
	<input type="hidden" class="prosesDRD" name="cekUrl" 	value="<?php echo _PROC; ?>"/>
	<input type="hidden" class="prosesDRD" name="cekId" 	value="peringatan"/>
	<input type="hidden" class="prosesDRD" name="cekMess" 	value="<?php echo getToken(); ?>"/>
	<input type="Button" value="Proses" onClick="periksa('prosesDRD')"/>
</div>
<div class="prepend-4 border"></div>
<?php
	}
?>