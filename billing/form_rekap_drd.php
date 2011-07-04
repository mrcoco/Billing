<?php
	if($erno) die();
	if(!isset($appl_tokn)) define("_TOKN",getToken());
	switch($proses){
		case "rekapDRD":
			echo "Halaman Rekap DRD";
	?>
<link href="css/style.css" rel="stylesheet" type="text/css" />

	<fieldset>
	<table width="200" border="1">
  <tr class="table_cell1">
    <td width="13%" class="center"><img src="images/headerleft.jpg" width="104" height="65" /></td>
    <td colspan="6" class="center"><h1 class="title_form">PERUSAHAAN DAERAH AIR MINUM-CABANG K.P Cimahi </h1></td>
  </tr>
  <tr class="table_cell1">
    <td colspan="7" class="center"><h1>REKAP DRD</h1> </td>
  </tr>
  <tr class="table_cell1">
    <td colspan="7">Tanggal Cetak : </td>
  </tr>
  <tr class="table_cell1">
    <td colspan="7">TAHUN-BULAN : </td>
  </tr>
  <tr class="table_head">
    <td class="center">Gol</td>
    <td width="15%" class="center">Lembar Rekening </td>
    <td width="16%" class="center">Air(m3)</td>
    <td width="14%" class="center">Uang Air </td>
    <td width="15%" class="center">Beban Tetap </td>
    <td width="13%" class="center">Angsuran</td>
    <td width="14%"  class="center">Total</td>
  </tr>
  <tr class="table_cell1">
    <td><p>1a</p>
    <p>21</p>
    <p>2w</p>
    </td>
    <td class="right"><p>aaa</p>
    <p>bbb</p>
    <p>ccc</p>
    </td>
    <td class="right"><p>1234</p>
    <p>1234</p>
    <p>1234</p></td>
    <td class="right"><p>456</p>
    <p>456</p>
    <p>456</p></td>
    <td class="right"><p>234</p>
    <p>234</p>
    <p>234</p>
    </td>
    <td class="right"><p>789</p>
    <p>789</p>
    <p>789</p></td>
    <td class="right"><p>890</p>
    <p>890</p>
    <p>890</p></td>
  </tr>
  <tr class="top_info">
    <td>&nbsp;</td>
    <td class="right">aabbcc</td>
    <td class="right">1234</td>
    <td class="right">456</td>
    <td class="right">234</td>
    <td class="right">789</td>
    <td class="right">890</td>
  </tr>
  <tr class="table_cell1">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
	</fieldset>		
<?			
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
			$parm1	 = array("class"=>"rekapDRD","name"=>"rek_bln","selected"=>6);
?>

<link href="css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>

<h2>Daftar Rekening Ditagih / DRD </h2><hr/>
<input type="hidden" class="rekapDRD" name="appl_kode" 	value="<?php echo _KODE; ?>"/>
<input type="hidden" class="rekapDRD" name="appl_name" 	value="<?php echo _NAME; ?>"/>
<input type="hidden" class="rekapDRD" name="appl_file" 	value="<?php echo _FILE; ?>"/>
<input type="hidden" class="rekapDRD" name="appl_proc" 	value="<?php echo _PROC; ?>"/>
<input type="hidden" class="rekapDRD" name="appl_tokn" 	value="<?php echo _TOKN; ?>"/>
<input type="hidden" class="rekapDRD" name="targetUrl" 	value="<?php echo _FILE; ?>"/>
<input type="hidden" class="rekapDRD" name="targetId" 	value="content"/>
<input type="hidden" class="rekapDRD" name="proses"	 	value="rekapDRD"/>
<input type="hidden" class="rekapDRD" name="dump" 		value="0"/>
<div class="span-4 border">&nbsp;</div>
<div class="span-4">Kota Pelayanan</div>
<div class="span-4">: <input type="text" class="rekapDRD" name="" size="6" maxlength="6"/></div>
<br/><br/>
<div class="span-4 border">&nbsp;</div>
<div class="span-4">Bulan - Tahun</div>
<div class="span-4">
	: 
	<?php echo pilihan($data1,$parm1); ?>
	<input type="text" class="rekapDRD" name="rek_thn" size="4" maxlength="4" value="2011"/>
</div>
<br/><br/>
<div class="span-12 center">
	<input type="hidden" class="rekapDRD" name="cekUrl" 	value="<?php echo _PROC; ?>"/>
	<input type="hidden" class="rekapDRD" name="cekId" 	value="peringatan"/>
	<input type="hidden" class="rekapDRD" name="cekMess" 	value="<?php echo getToken(); ?>"/>
	<input type="Button" value="Cetak" onclick="periksa('rekapDRD')"/>
</div>
<?php
	}
?>