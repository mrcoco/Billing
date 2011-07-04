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
			
		$data2[] = array("kp_kode"=>"00","kp_ket"=>"00-Kantor Pusat");
		$data2[] = array("kp_kode"=>"10","kp_ket"=>"10-K.P.Cimahi");
		$data2[] = array("kp_kode"=>"20","kp_ket"=>"20-K.P.Rancaekek");
		$data2[] = array("kp_kode"=>"21","kp_ket"=>"21-K.P.Cicalengka");
		$data2[] = array("kp_kode"=>"22","kp_ket"=>"22-K.P.Cileunyi");
		$data2[] = array("kp_kode"=>"30","kp_ket"=>"30-K.P.Soreang");
		$data2[] = array("kp_kode"=>"31","kp_ket"=>"31-K.P.Banjaran");
		$data2[] = array("kp_kode"=>"32","kp_ket"=>"32-K.P.Ciwidey");
		$data2[] = array("kp_kode"=>"40","kp_ket"=>"40-K.P.Majalaya");
		$data2[] = array("kp_kode"=>"41","kp_ket"=>"41-K.P.Paseh");
		$data2[] = array("kp_kode"=>"50","kp_ket"=>"50-K.P.Padalarang");
		$data2[] = array("kp_kode"=>"51","kp_ket"=>"51-K.P.Batujajar");
		$data2[] = array("kp_kode"=>"52","kp_ket"=>"52-K.P.Cililin");
		$data2[] = array("kp_kode"=>"53","kp_ket"=>"53-K.P.Cikalong Wetan");
		$data2[] = array("kp_kode"=>"60","kp_ket"=>"60-K.P.Lembang");
		$data2[] = array("kp_kode"=>"61","kp_ket"=>"61-K.P.Cisarua");
		$data2[] = array("kp_kode"=>"70","kp_ket"=>"70-K.P.Ciparay");
		$data2[] = array("kp_kode"=>"71","kp_ket"=>"71-K.P.Baleendah");
		$data2[] = array("kp_kode"=>"72","kp_ket"=>"72-K.P.Pacet");
		$data2[] = array("kp_kode"=>"73","kp_ket"=>"73-K.P.Bojongsoang");
		$data2[] = array("kp_kode"=>"80","kp_ket"=>"80-K.P.pangalengan");
		$data2[] = array("kp_kode"=>"901","kp_ket"=>"901-Payment point Bank Jabar Cimahi");
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
<input type="hidden" class="prosesDRD" name="dump" 		value="1"/>
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