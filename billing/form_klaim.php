<?php
	if($erno) die();
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
	
	$kembali= "<input type=\"button\" value=\"Kembali\" onclick=\"buka('kembali')\"/>";
	
	switch($proses){
		case "proses_reduksi":
		
		?>
		
		<br /><center class="notice">Poses Reduksi Berhasil</center>
		<center>
		<input type="hidden" class="cetak_ba" name="appl_kode" 	value="<?php echo _KODE; 	    ?>"/>
		<input type="hidden" class="cetak_ba" name="appl_name"	value="<?php echo _NAME; 		?>"/>
		<input type="hidden" class="cetak_ba" name="appl_file" 	value="<?php echo _FILE; 		?>"/>
		<input type="hidden" class="cetak_ba" name="appl_proc" 	value="<?php echo _PROC; 		?>"/>
		<input type="hidden" class="cetak_ba" name="appl_tokn" 	value="<?php echo _TOKN; 		?>"/>
		<input type="hidden" class="cetak_ba" name="targetUrl" value="<?php echo _FILE;     	?>"/>
		<input type="hidden" class="cetak_ba" name="targetId" value="content"/>
		<input type="hidden" class="cetak_ba" name="proses" value="cetak_ba"/>
		<input type="hidden" class="cetak_ba" name="errorUrl" value="form_ba_reduksi.php"/>
		<input type="button" name="button" value="Cetak Berita Acara" class="cetak_ba" onclick="nonghol('cetak_ba')"/>
		<input type="hidden" class="kembali" name="appl_kode" 	value="<?php echo _KODE; 		?>"/>
		<input type="hidden" class="kembali" name="appl_name" 	value="<?php echo _NAME; 		?>"/>
		<input type="hidden" class="kembali" name="appl_file" 	value="<?php echo _FILE; 		?>"/>
		<input type="hidden" class="kembali" name="appl_proc" 	value="<?php echo _PROC; 		?>"/>
		<input type="hidden" class="kembali" name="appl_tokn" 	value="<?php echo _TOKN; 		?>"/>
		<input type="hidden" class="kembali" name="targetUrl" 	value="<?php echo _FILE; 		?>"/>
		<input type="hidden" class="kembali" name="errorId"   	value="<?php echo getToken();	?>"/>
		<input type="hidden" class="kembali" name="targetId"  	value="content"/>
		<input name="batal" class="kembali" type="button" value="Kembali" onclick="buka('kembali')" />
		</center>
	
		<?php
		break;
		
		case "hitung":
		$pemakaian = $rek_stankini - $rek_stanlalu;
		$rek_total = $rek_uangair + $rek_beban;
		$rek_reduksiuangair  = $rek_uangair-($rek_uangair*($reduksi/100));
		$rek_selisihuangair = $rek_uangair - $rek_reduksiuangair;
		$rek_reduksitotal = $rek_reduksiuangair + $rek_beban *($beban_tetap);
		$rek_selisihtotal = $rek_total - $rek_reduksitotal;
		
		
		
	
?>
	<table width="95%" border="1" >
	  <tr bgcolor="#02153F" class="table_head">
		<td class="center">No</td>
		<td class="center">Bulan / Tahun</td>
		<td colspan="2" class="center">Sebelumnya</td>
		<td colspan="2" class="center">Sekarang (Reduksi)</td>
		<td colspan="2" class="center">Selisih</td>
		
	  </tr>
	  <tr class="table_cell1">
		<td rowspan="5" class="center"><?php echo $rek_nomor ?></td>
		<td rowspan="5" class="center"><?php echo $rek_bln." ".$rek_thn;  ?></td>
		<td>Stan Lalu </td>
		<td class="right"><?php echo ": ".number_format($rek_stanlalu); ?></td>
		<td colspan="2" rowspan="3">
			<p>Reduksi
			<input class="hitung" name="reduksi" size="5" value="<?php echo $reduksi; ?>" />
			Persen </p>
			<p align="center">
			  <input type="button" name="Button" value="Hitung" class="hitung" onclick="buka('hitung')"/>
			  <input type="hidden" class="kembali" name="appl_kode" value="<?php echo _KODE; 		?>"/>
			  <input type="hidden" class="hitung" name="appl_name" 	value="<?php echo _NAME; 		?>"/>
			  <input type="hidden" class="hitung" name="appl_file" 	value="<?php echo _FILE; 		?>"/>
			  <input type="hidden" class="hitung" name="appl_proc" 	value="<?php echo _PROC; 		?>"/>
			  <input type="hidden" class="hitung" name="appl_tokn" 	value="<?php echo _TOKN; 		?>"/>
			  <input type="hidden" class="hitung" name="targetUrl" value="<?php echo _FILE; ?>"/>
			  <input type="hidden" class="hitung" name="targetId" value="targetReduksi"/>
			  <input type="hidden" class="hitung" name="rek_nomor" value="<?php echo $rek_nomor; ?>"/>
			  <input type="hidden" class="hitung" name="rek_bln" value="<?php echo $rek_bln; ?>"/>
			  <input type="hidden" class="hitung" name="rek_thn" value="<?php echo $rek_thn; ?>"/>
			  <input type="hidden" class="hitung" name="rek_stanlalu" value="<?php echo $rek_stanlalu; ?>"/>
			  <input type="hidden" class="hitung" name="rek_stankini" value="<?php echo $rek_stankini; ?>"/>
			  <input type="hidden" class="hitung" name="rek_uangair" value="<?php echo $rek_uangair; ?>"/>
			  <input type="hidden" class="hitung" name="rek_beban" value="<?php echo $rek_beban; ?>"/>
			  <input type="hidden" class="hitung" name="proses" value="hitung"/>
			</p>
		</td>
		<td rowspan="3">&nbsp;</td>
		<td rowspan="3">&nbsp;</td>
	  </tr>
	  <tr class="table_cell1">
		<td>Stan Kini</td>
		<td class="right"><?php echo ": ".number_format($rek_stankini); ?></td>
	  </tr>
	  <tr class="table_cell1">
		<td>Pemakaian </td>
		<td class="right"><?php echo ":&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".number_format($pemakaian); ?></td>
	  </tr>
	  <tr class="table_cell1">
		<td>Uang Air</td>
		<td class="right"><?php echo ": ".number_format($rek_uangair); ?></td>
		<td>Uang Air </td>
		<td><?php echo ": ".number_format($rek_reduksiuangair); ?></td>
		<td>Uang Air</td>
		<td><?php echo ": ".number_format($rek_selisihuangair); ?></td>
	  </tr>
	  <tr class="table_cell1">
		<td>NILAI TOTAL </td>
		<td class="right"><?php echo ": ".number_format($rek_total); ?></td>
		<td>NILAI TOTAL</td>
		<td><?php echo ": ".number_format($rek_reduksitotal); ?></td>
		<td>NILAI TOTAL</td>
		<td><?php echo": ".number_format($rek_selisihtotal); ?></td>
	  </tr>
	  <tr bgcolor="#02153F" class="table_validator">
	  <?php 
	  if($reduksi<=50) {
	  ?>
		<td colspan="8" class="table_cont_btm right">
			<input name="Submit" type="submit" value="Reduksi" onclick="buka('proses_reduksi')" />
			<input type="hidden" class="kembali" name="appl_kode" value="<?php echo _KODE; 		?>"/>
			<input type="hidden" class="proses_reduksi" name="appl_kode" 	value="<?php echo _KODE; ?>"/>
			<input type="hidden" class="proses_reduksi" name="appl_name" 	value="<?php echo _NAME; ?>"/>
			<input type="hidden" class="proses_reduksi" name="appl_file" 	value="<?php echo _FILE; ?>"/>
			<input type="hidden" class="proses_reduksi" name="appl_proc" 	value="<?php echo _PROC; ?>"/>
			<input type="hidden" class="proses_reduksi" name="appl_tokn" 	value="<?php echo _TOKN; ?>"/>
			<input type="hidden" class="proses_reduksi" name="targetUrl" 	value="<?php echo _FILE; ?>"/>
			<input type="hidden" class="proses_reduksi" name="targetId" 	value="content"/>
			<input type="hidden" class="proses_reduksi" name="proses"	 	value="proses_reduksi"/>
		    <input name="batal" class="kembali" type="button" value="Batal" onclick="buka('kembali')" />
		</td>
	  </tr>
	  <?php } else { ?>
	   <td colspan="8" class="table_cont_btm right">
		    <input name="batal" class="kembali" type="button" value="Batal" onclick="buka('kembali')" />
		</td>
		    <br /><center class="notice"> Maksimal reduksi yang diperbolehkan ialah 50%</center>
	</table>
<?php
 }
			break;
		case "periksaDSR":
?>
<input type="hidden" id="<?php echo $errorId; ?>" value="<?php echo $mess; ?>"/>
<input type="hidden" class="kembali" name="appl_kode" 	value="<?php echo _KODE; 		?>"/>
<input type="hidden" class="kembali" name="appl_name" 	value="<?php echo _NAME; 		?>"/>
<input type="hidden" class="kembali" name="appl_file" 	value="<?php echo _FILE; 		?>"/>
<input type="hidden" class="kembali" name="appl_proc" 	value="<?php echo _PROC; 		?>"/>
<input type="hidden" class="kembali" name="appl_tokn" 	value="<?php echo _TOKN; 		?>"/>
<input type="hidden" class="kembali" name="targetUrl" 	value="<?php echo _FILE; 		?>"/>
<input type="hidden" class="kembali" name="errorId"   	value="<?php echo getToken();	?>"/>
<input type="hidden" class="kembali" name="targetId"  	value="content"/>
<?php
			$formId		= getToken();
			$cekMess	= getToken();
			$form1		= true;
			$form2		= true;
			$form3		= true;
			/** 1. retrieve data pelanggan */
			try{
				$que0 = "SELECT *FROM v_data_pelanggan WHERE pel_no='$pel_no'";
				if(!$res0 = mysql_query($que0,$link)){
					throw new Exception($que0);
				}
				else{
					$i = 0;
					while($row0 = mysql_fetch_array($res0)){
					$data0[] = $row0;
					$i++;
					}
					if($i==0) {
						$mess1	= "<br /><center class=\"notice\">Data Pelanggan dengan SL ".$pel_no." Tidak ditemukan</center>";
						$form1	= false;
					}
					$mess = false;
				}
			}
			
			catch (Exception $e){
				errorLog::errorDB(array($que0));
				$mess = $e->getMessage();
			}
		/* 2. retrieve catatan reduksi */
		try {
			$que1 = "SELECT * FROM v_lap_reduksi WHERE pel_no='$pel_no' AND rek_bln=$rek_bln AND rek_thn=$rek_thn ORDER BY rd_tgl";
			if(!$res1 = mysql_query($que1,$link)){
				throw new Exception($que1);
			}
			else{
				$i = 0;
				while($row1 = mysql_fetch_array($res1)){
					$data1[] = $row1;
					$i++;	
			}
					if($i==0) {
						$form2	= false;
					}
				$mess = false;
			}
		}
			catch (Exception $e){
			errorLog::errorDB(array($que1));
			$mess = $e->getMessage();
		}
		/* 3. retrive dsr awal */
		try {
			//$que2 = "SELECT * FROM v_dsr WHERE pel_no='$pel_no' AND rek_bln=$rek_bln AND rek_thn=$rek_thn";
			$que2 = "SELECT * FROM tm_rekening WHERE pel_no='$pel_no' AND rek_bln=$rek_bln AND rek_thn=$rek_thn LIMIT 1";
			if(!$res2 = mysql_query($que2,$link)){
				throw new Exception($que2);
			}
			else{
				$i = 0;
				while($row2 = mysql_fetch_array($res2)){
					$data2[] = $row2;
					$beban_tetap = $row2['rek_adm'] + $row2['rek_meter'];
					$angsuran = $row2['rek_angsuran'];
					$i++;	
			}
					if($i==0){
					$mess3	= "<br /><center class=\"notice\">Pelanggan tidak memiliki tunggakan</center>";
					$form3 	= false;
				}
				$mess = false;
			}
		}
			catch (Exception $e){
			errorLog::errorDB(array($que2));
			$mess = $e->getMessage();
		}
	/* end of iquiry */
	
	/* form data pelanggan */
	if($form1){
		for($i=0;$i<count($data0);$i++){
			$row0	= $data0[$i];
		}	
?>
<br/>
<h2>Klaim / Perubahan Rekening Air </h2>
<table><br/>
	<tr>
		<td>No. Pelanggan</td>
		<td><?php echo ": ".$row0['pel_no']; 	?></td>
		<td>Golongan</td>
		<td><?php echo ": ".$row0['gol_kode']; 	?></td>
	</tr>
	<tr>
		<td>Nama</td>
		<td><?php echo ": ".$row0['pel_nama']; 	?></td>
		<td>Rayon Pembacaan</td>
		<td><?php echo ": ".$row0['dkd_kd']; 	?></td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td><?php echo ": ".$row0['pel_alamat'];?></td>
		<td>Status</td>
		<td><?php echo ": ".$row0['kps_ket']; 	?></td>
	</tr>
</table>
<?php	
		//echo "Data Pelanggan ditemukan<br/>";
		/* from catatan reduksi */
		if($form2){
			// catatan reduksi
			for($i=0;$i<count($data1);$i++){
			$row1 	= $data1[$i];
			$klas 	= "table_cell1";
					if(($i%2) == 0){
						$klas = "table_cell2";
					}
					$rd_uangair_selisih = $row1['rd_uangair_akhir'] - $row1['rd_uangair_awal'];
					$rd_total_awal      = $row1['rd_uangair_awal'] + $beban_tetap + $angsuran ;
					$rd_total_akhir     = $row1['rd_uangair_akhir'] + $beban_tetap + $angsuran ;
					$rd_total           = $rd_total_akhir - $rd_total_awal;
				}
?>
	<h3>CATATAN</h3>
	<table>
	<tr class="table_head">
		<td>Tanggal Klaim</td>
		<td>Stan Lalu Awal</td>
		<td>Stan Kini Awal</td>
		<td>Stan Kini Akhir</td>
		<td>Uang Air Awal</td>
		<td>Uang Air Akhir</td>
		<td>Selisih Uang Air</td>
	</tr>

						<tr valign="top" class="<?php echo $klas; ?>" >  
					 	    <td class="center"><?php echo $row1['rd_tgl']; ?></td>											 	    					
					 	    <td class="right"><?php echo number_format($row1['rd_uangair_awal']); ?></td>
				   		    <td class="right"><?php echo number_format($rd_total_awal); ?></td>
				   		    <td class="right"><?php echo number_format($row1['rd_nilai']); ?></td>
				   		    <td class="right"><?php echo number_format($row1['rd_uangair_akhir']); ?></td>   		    
				     		<td class="right"><?php echo number_format($rd_total_akhir); ?></td>
				  		    <td class="right"><?php echo number_format($rd_uangair_selisih); ?></td>
				   		    
                       </tr>

			<tr class="table_cont_btm">
				<td>&nbsp;</td>
				<td colspan="8"></td>
  			</tr>
</table>
<?php
			//echo "Catatan Reduksi ditemukan<br/>";
		}
		
		/* form reduksi */
		if($form3){
			// proses reduksi
			for($i=0;$i<count($data2);$i++){
				$row2 	= $data2[$i];
					}
					$pemakaian = $row2['rek_stankini'] - $row2['rek_stanlalu'];
					$rek_beban = $row2['rek_adm'] + $row2['rek_meter'];
				
?>
	<h3>KOREKSI</h3>
<div id="targetReduksi">
  <table width="95%" border="1" >
    <tr bgcolor="#02153F" class="table_head">
      <td colspan="2" class="center">Sebelumnya</td>
      <td colspan="3" class="center">Sekarang (koreksi)</td>
      <td colspan="2" class="center">Selisih</td>
      <td width="5%" colspan="2" class="center">Alasan Klaim</td>
    </tr>
    <tr class="table_cell1">
      <td width="23%">Stan Lalu </td>
      <td width="6%" class="right"><?php echo ": ".number_format($row2['rek_stanlalu']); ?></td>
      <td width="23%">Stan Lalu </td>
      <td colspan="2"><p>&nbsp;</p>      </td>
      <td width="24%">Stan Lalu </td>
      <td width="9%">&nbsp;</td>
      <td colspan="2" rowspan="5">&nbsp;</td>
    </tr>
    <tr class="table_cell1">
      <td>Stan Kini</td>
      <td class="right"><?php echo ": ".number_format($row2['rek_stankini']); ?></td>
      <td>Stan Kini</td>
      <td colspan="2"><input type="text" name="stankini" value="0" size="5"  />
      <input type="button" value="Hitung" name="hitung" /></td>
      <td>Stan Kini</td>
      <td>&nbsp;</td>
    </tr>
    <tr class="table_cell1">
      <td>Pemakaian </td>
      <td class="right"><?php echo " : ".number_format($pemakaian); ?></td>
      <td>Pemakaian </td>
      <td colspan="2">&nbsp;</td>
      <td>Pemakaian </td>
      <td>&nbsp;</td>
    </tr>
    <tr class="table_cell1">
      <td>Uang Air</td>
      <td class="right"><?php echo ": ".number_format($row2['rek_uangair']); ?></td>
      <td>Uang Air</td>
      <td colspan="2">&nbsp;</td>
      <td>Uang Air</td>
      <td>&nbsp;</td>
    </tr>
    <tr class="table_cell1">
      <td>NILAI TOTAL </td>
      <td class="right"><?php echo ": ".number_format($row2['rek_total']); ?></td>
      <td>NILAI TOTAL </td>
      <td colspan="2">&nbsp;</td>
      <td>NILAI TOTAL </td>
      <td>&nbsp;</td>
    </tr>
    <tr bgcolor="#02153F" class="table_validator">
      <td colspan="11" class="table_cont_btm right"><!--<input name="Submit" type="submit" value="Reduksi" />-->
          <input name="batal2" class="kembali" type="button" value="Batal" onclick="buka('kembali')" />      </td>
    </tr>
  </table>
</div>
<?php
			//echo "Reduksi Rekening<br/>";
		}
		else{
			echo $mess3;
			echo $kembali;
		}		
	}
	else{
		echo $mess1;
		echo $kembali;
	}
	

			
			break;
		default:
			$data1[] = array("rek_bln"=>"1","bln_nama"=>"Januari");
			$data1[] = array("rek_bln"=>"2","bln_nama"=>"Februari");
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
			$parm1	 = array("class"=>"cekDSR","name"=>"rek_bln","selected"=>5);
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
<div class="span-4 border">&nbsp;</div>
<div class="span-4">Nomor Pelanggan</div>
<div class="span-4">: <input type="text" class="cekDSR" name="pel_no" size="6" maxlength="6" value="000618"/></div>
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
	<input type="Button" value="Cek Rekening" onclick="buka('cekDSR')"/>
</div>
<?php
	}
	
?>