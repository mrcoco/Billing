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
			$data1[] = array("rek_bln"=>"9","bln_nama"=>"September");
			$data1[] = array("rek_bln"=>"10","bln_nama"=>"Oktober");
			$data1[] = array("rek_bln"=>"11","bln_nama"=>"November");
			$data1[] = array("rek_bln"=>"12","bln_nama"=>"Desember");
			$parm1	 = array("class"=>"prosesDRD","name"=>"rek_bln","selected"=>6);
			
		$data2[] = array("kp_kode"=>"00","kota_nama"=>"00-Kantor Pusat");
		$data2[] = array("kp_kode"=>"10","kota_nama"=>"10-K.P.Cimahi");
		$data2[] = array("kp_kode"=>"20","kota_nama"=>"20-K.P.Rancaekek");
		$data2[] = array("kp_kode"=>"21","kota_nama"=>"21-K.P.Cicalengka");
		$data2[] = array("kp_kode"=>"22","kota_nama"=>"22-K.P.Cileunyi");
		$data2[] = array("kp_kode"=>"30","kota_nama"=>"30-K.P.Soreang");
		$data2[] = array("kp_kode"=>"31","kota_nama"=>"31-K.P.Banjaran");
		$data2[] = array("kp_kode"=>"32","kota_nama"=>"32-K.P.Ciwidey");
		$data2[] = array("kp_kode"=>"40","kota_nama"=>"40-K.P.Majalaya");
		$data2[] = array("kp_kode"=>"41","kota_nama"=>"41-K.P.Paseh");
		$data2[] = array("kp_kode"=>"50","kota_nama"=>"50-K.P.Padalarang");
		$data2[] = array("kp_kode"=>"51","kota_nama"=>"51-K.P.Batujajar");
		$data2[] = array("kp_kode"=>"52","kota_nama"=>"52-K.P.Cililin");
		$data2[] = array("kp_kode"=>"53","kota_nama"=>"53-K.P.Cikalong Wetan");
		$data2[] = array("kp_kode"=>"60","kota_nama"=>"60-K.P.Lembang");
		$data2[] = array("kp_kode"=>"61","kota_nama"=>"61-K.P.Cisarua");
		$data2[] = array("kp_kode"=>"70","kota_nama"=>"70-K.P.Ciparay");
		$data2[] = array("kp_kode"=>"71","kota_nama"=>"71-K.P.Baleendah");
		$data2[] = array("kp_kode"=>"72","kota_nama"=>"72-K.P.Pacet");
		$data2[] = array("kp_kode"=>"73","kota_nama"=>"73-K.P.Bojongsoang");
		$data2[] = array("kp_kode"=>"80","kota_nama"=>"80-K.P.pangalengan");
		$data2[] = array("kp_kode"=>"901","kota_nama"=>"901-Payment point Bank Jabar Cimahi");
		$parm2	 = array("class"=>"prosesDRD","name"=>"kp_kode","selected"=>10);

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
<div class="span-5 center">Kota Pelayanan  </div>
<div class="span-7 center">:
  <?php echo pilihan($data2,$parm2); ?></div>
<br/><br />
<div class="span-5 center">Bulan-Tahun</div>
<div class="span-5 center">
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