<?php
	if($erno) die();
	$formId 	= getToken();
	
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
		$erno = false;
	}	
	
	 $que0 = "SELECT * FROM v_dsr WHERE pel_no='$pel_no'"; 
	 try{
		if(!$res0 = mysql_query($que0,$link)){
			throw new Exception($que0);
		}
		else{
			$i = 0;
			while($row0 = mysql_fetch_array($res0)){
				$data[] = $row0;
				$i++;	
		}
			$mess = false;
		}
	}
	catch (Exception $e){
		errorLog::errorDB(array($que0));
		$mess = $e->getMessage();
	}
	
?>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<div id="<?php echo $formId; ?>" class="peringatan">
<div class="pesan form-5">
<div class="span-14 right large">[<a title="Tutup jendela ini" onclick="tutup('<?php echo $formId; ?>')">Tutup</a>]</div>
<h3>Cetak Data Pelanggan</h3>
<hr/>
<table width="89%">
  <tr>
    <td colspan="4" class="center"><h3>Data Pelanggan</h3></td>
    </tr>
  <tr class="append-3 prepend-3">
    <td width="22%">No. Pelanggan</td>
    <td width="24%">: <?php echo $pel_no; ?></td>
    <td width="24%">&nbsp;</td>
    <td width="30%">&nbsp;</td>
  </tr>
  <tr>
    <td>Nama</td>
    <td>: <?php echo $pel_nama; ?></td>
    <td>Golongan</td>
    <td>: <?php echo $gol_kode; ?></td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td>: <?php echo $pel_alamat; ?></td>
    <td>Rayon Pembacaan</td>
    <td>: <?php echo $dkd_kd; ?></td>
  </tr>
  <tr>
    <td>STATUS PELANGGAN</td>
    <td>:<b> <?php echo $kps_ket;	?></b></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="200" border="1">
  <tr class="table_head">
    <td>Bulan / Tahun </td>
    <td colspan="3" class="center">Stand Meter </td>
    <td colspan="2" class="center">Rincian Biaya </td>
    <td>Total</td>
  </tr>
  <tr class="table_head center">
  	<td></td>
    <td>Lalu</td>
    <td>Kini</td>
    <td>Pemakaian</td>
    <td>Uang Air</td>
    <td>Beban Tetap </td>
	<td>&nbsp;</td>
    </tr>
<?php
	for($i=0;$i<count($data);$i++){
		$row0 	     = $data[$i];
		$nomor	     = ($i+1)+(($pg-1)*$jml_perpage);
		$pemakaian   = $row0['rek_stankini'] - $row0['rek_stanlalu'];
		$beban_tetap = $row0['rek_adm'] + $row0['rek_meter'];
		$total       = $row0['rek_total'] + $row0['rek_denda'] + $row0['rek_materai'];
		$klas 	  = "table_cell1";
		if(($i%2) == 0){
			$klas = "table_cell2";
		}	
		$total_beban+=$beban_tetap;
		$grand_total+=$total;
		$total_uangair+=$row0['rek_uangair'];
?>
  <tr class="<?php echo $klas; ?>">
    <td><?php echo $bulan[$row0['rek_bln']]." ".$row0['rek_thn'];  ?></td>
    <td class="right"><?php echo number_format($row0['rek_stanlalu']); ?></td>
    <td class="right"><?php echo number_format($row0['rek_stankini']); ?></td>
    <td class="right"><?php echo number_format($pemakaian); ?></td>
    <td class="right"><?php echo number_format($row0['rek_uangair']); ?></td>
    <td class="right"><?php echo number_format($beban_tetap); ?></td>
    <td class="right"><?php echo number_format($total); ?></td>
  </tr>

 <?php
   		}
  ?>
    <tr class="table_cont_btm">
    	<td colspan="4" class="table_cont_btm">Grand Total :</td>
	 	<td class="right"><?php echo number_format($total_uangair); ?></td>
	 	<td class="right"><?php echo number_format($total_beban); ?></td>
   		<td class="right"><?php echo number_format($grand_total); ?></td>
  </tr>
</table>
</div>
</div>
