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
		
		<br /><center class="notice">
		  Proses Reduksi Berhasil
		</center>
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
		
		
		
?>
	  <table>
	<tr class="table_head"> 
		<td colspan="2" width="25%">Sebelumnya</td>
		<td colspan="2" width="30%">Sekarang (Koreksi)</td>
		<td colspan="2" width="25%">Selisih</td>
		<td width="15%">Alasan klaim </td>
	</tr>
	<tr class="table_cell1">
		<td class="height-1" style="padding-top:6px">Stan Lalu</td>
		<td>: <?php echo number_format($row3['rek_stanlalu']); ?></td>
		<td colspan="4" rowspan="6" id="<?php echo $formId; ?>">
			<table>
				<tr class="table_cell1">
					<td class="height-1">Stan Lalu</td>
					<td>: <?php echo number_format($row3['rek_stanlalu']); ?></td>
					<td>Stan Lalu</td>
					<td>: 0</td>
				</tr>
				<tr class="table_cell2">
					<td class="height-1">Stan Kini</td>
					<td>
						: <input type="text" class="reduksi hitung" name="rek_stanklaim" size="4" value="<?php echo $row3['rek_stankini']; ?>"/>
						<input type="button" class="form_button" value="Hitung" onclick="buka('hitung')"/>
						<input type="hidden" class="kembali" name="appl_kode" value="<?php echo _KODE; 		    ?>"/>
						<input type="hidden" class="hitung" name="appl_name" 	value="<?php echo _NAME; 		?>"/>
						<input type="hidden" class="hitung" name="appl_file" 	value="<?php echo _FILE; 		?>"/>
						<input type="hidden" class="hitung" name="appl_proc" 	value="<?php echo _PROC; 		?>"/>
						<input type="hidden" class="hitung" name="appl_tokn" 	value="<?php echo _TOKN; 		?>"/>
						<input type="hidden" class="hitung" name="targetUrl"  value="<?php echo _FILE; ?>"/>
						<input type="hidden" class="hitung" name="targetId"   value="targetReduksi"/>
						<input type="hidden" class="hitung" name="proses" value="hitung"/>
					</td>
					<td>Stan Kini</td>
					<td>: 0</td>
				</tr>
				<tr class="table_cell1">
					<td class="height-1">Pemakaian</td>
					<td>: <?php echo number_format($pakai_kini); 			?></td>
					<td>Pemakaian</td>
					<td>: 0</td>
				</tr>
				<tr class="table_cell2">
					<td class="height-1">Uang Air</td>
					<td>: <?php echo number_format($row3['rek_uangair']);	?></td>
					<td>Uang Air</td>
					<td>: 0</td>
				</tr>
				<tr class="table_cell1">
					<td class="height-1">Nilai Total</td>
					<td>: <?php echo number_format($row3['rek_total']);		?></td>
					<td>Nilai Total</td>
					<td>: 0</td>
				</tr>
			</table>
		</td>
		<td rowspan="6"><?php echo pilihan($data2,$parm2); ?></td>
	</tr>
	<tr class="table_cell2">
		<td class="height-1">Stan Kini</td><td>: <?php echo number_format($row3['rek_stankini']);	?></td>
	</tr>
	<tr class="table_cell1">
		<td class="height-1">Pemakaian</td><td>: <?php echo number_format($pakai_kini); 			?></td>
	</tr>
	<tr class="table_cell2">
		<td class="height-1">Uang Air</td><td>: <?php echo number_format($row3['rek_uangair']); 	?></td>
	</tr>
	<tr class="table_cell1">
		<td class="height-1">Nilai Total</td><td>: <?php echo number_format($row3['rek_total']); 	?></td>
	</tr>
	<tr class="table_cell2">
		<td colspan="7"></td>
	</tr>
	<tr class="table_cont_btm">
		<td colspan="7" class="right">
			<input type="button" class="form_button" value="Koreksi" onclick="buka('proses')"/> 
			<input name="batal" class="kembali" type="button" value="Batal" onclick="buka('kembali')" />	
		</td>					
	</tr>
</table>
<?php
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
		/** 2.  retrieve kode klaim */
			try{
				$que1 = "SELECT *FROM tr_klaim";
				if(!$res1 = mysql_query($que1,$link)){
					throw new Exception($que1);
				}
				else{
					while($row1 = mysql_fetch_array($res1)){
						$data2[] = array("kl_kode" => $row1['kl_kd'], "kl_ket" => $row1['kl_ket']);
					}
					$parm2	= array("class" => "proses", "name" => "kl_kode", "selected" => "1");
					$mess 	= false;
				}
			}
			catch (Exception $e){
				errorLog::errorDB(array($que1));
				$mess = $e->getMessage();
			}
			
			/** 3. retrieve catatan klaim */
			try{
				$que4 = "SELECT *FROM v_lap_klaim WHERE pel_no='$pel_no' AND rek_bln=$rek_bln AND rek_thn=$rek_thn ORDER BY cl_tgl";
				if(!$res4 = mysql_query($que4,$link)){
					throw new Exception($que4);
				}
				else{
					while($row4 = mysql_fetch_array($res4)){
						$data4[] = $row4;
					}
					$mess 	= false;
				}
			}
			catch (Exception $e){
				errorLog::errorDB(array($que4));
				$mess = $e->getMessage();
			}
			
		/* 4. retrive dsr awal */
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
		/* from catatan klaim */
		if($form2){
			// catatan klaim
			for($i=0;$i<count($data4);$i++){
			$row4 	= $data4[$i];
			$klas 	= "table_cell1";
					if(($i%2) == 0){
						$klas = "table_cell2";
					}
						$cl_uangair_selisih = $row4['cl_uangair_akhir'] - $row4['cl_uangair_awal'];
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
					 	    <td class="center"><?php echo $row4['tgl_klaim']; ?></td>											 	    					
					 	    <td class="right"><?php echo number_format($row4['cl_stanlalu_awal']); 	?></td>
				   		    <td class="right"><?php echo number_format($row4['cl_stankini_awal']);	?></td>
				   		    <td class="right"><?php echo number_format($row4['cl_stankini_akhir']);	?></td>
				   		    <td class="right"><?php echo number_format($row4['cl_uangair_awal']);	?></td>   		    
				     		<td class="right"><?php echo number_format($row4['cl_uangair_akhir']);	?></td>
				  		    <td class="right"><?php echo number_format($cl_uangair_selisih);		?></td>
				   		    
                       </tr>

			<tr class="table_cont_btm">
				<td>&nbsp;</td>
				<td colspan="8"></td>
  			</tr>
</table>
<?php
			//echo "Catatan Reduksi ditemukan<br/>";
		}
		
		/* form klaim */
		if($form3){
			// proses klaim
			for($i=0;$i<count($data2);$i++){
				$row2 	= $data2[$i];
					}
					
				
?>
	<h3>KOREKSI</h3>
<div id="targetReduksi">
  <table>
	<tr class="table_head"> 
		<td colspan="2" width="25%">Sebelumnya</td>
		<td colspan="2" width="30%">Sekarang (Koreksi)</td>
		<td colspan="2" width="25%">Selisih</td>
		<td width="15%">Alasan klaim </td>
	</tr>
	<tr class="table_cell1">
		<td class="height-1" style="padding-top:6px">Stan Lalu</td>
		<td>: <?php echo number_format($row3['rek_stanlalu']); ?></td>
		<td colspan="4" rowspan="6" id="<?php echo $formId; ?>">
			<table>
				<tr class="table_cell1">
					<td class="height-1">Stan Lalu</td>
					<td>: <?php echo number_format($row3['rek_stanlalu']); ?></td>
					<td>Stan Lalu</td>
					<td>: 0</td>
				</tr>
				<tr class="table_cell2">
					<td class="height-1">Stan Kini</td>
					<td>
						: <input type="text" class="reduksi hitung" name="rek_stanklaim" size="4" value="<?php echo $row3['rek_stankini']; ?>"/>
						<input type="button" class="form_button" value="Hitung" onclick="buka('hitung')"/>
						<input type="hidden" class="kembali" name="appl_kode" value="<?php echo _KODE; 		    ?>"/>
						<input type="hidden" class="hitung" name="appl_name" 	value="<?php echo _NAME; 		?>"/>
						<input type="hidden" class="hitung" name="appl_file" 	value="<?php echo _FILE; 		?>"/>
						<input type="hidden" class="hitung" name="appl_proc" 	value="<?php echo _PROC; 		?>"/>
						<input type="hidden" class="hitung" name="appl_tokn" 	value="<?php echo _TOKN; 		?>"/>
						<input type="hidden" class="hitung" name="targetUrl"  value="<?php echo _FILE; ?>"/>
						<input type="hidden" class="hitung" name="targetId"   value="targetReduksi"/>
						<input type="hidden" class="hitung" name="proses" value="hitung"/>
					</td>
					<td>Stan Kini</td>
					<td>: 0</td>
				</tr>
				<tr class="table_cell1">
					<td class="height-1">Pemakaian</td>
					<td>: <?php echo number_format($pakai_kini); 			?></td>
					<td>Pemakaian</td>
					<td>: 0</td>
				</tr>
				<tr class="table_cell2">
					<td class="height-1">Uang Air</td>
					<td>: <?php echo number_format($row3['rek_uangair']);	?></td>
					<td>Uang Air</td>
					<td>: 0</td>
				</tr>
				<tr class="table_cell1">
					<td class="height-1">Nilai Total</td>
					<td>: <?php echo number_format($row3['rek_total']);		?></td>
					<td>Nilai Total</td>
					<td>: 0</td>
				</tr>
			</table>
		</td>
		<td rowspan="6"><?php echo pilihan($data2,$parm2); ?></td>
	</tr>
	<tr class="table_cell2">
		<td class="height-1">Stan Kini</td><td>: <?php echo number_format($row3['rek_stankini']);	?></td>
	</tr>
	<tr class="table_cell1">
		<td class="height-1">Pemakaian</td><td>: <?php echo number_format($pakai_kini); 			?></td>
	</tr>
	<tr class="table_cell2">
		<td class="height-1">Uang Air</td><td>: <?php echo number_format($row3['rek_uangair']); 	?></td>
	</tr>
	<tr class="table_cell1">
		<td class="height-1">Nilai Total</td><td>: <?php echo number_format($row3['rek_total']); 	?></td>
	</tr>
	<tr class="table_cell2">
		<td colspan="7"></td>
	</tr>
	<tr class="table_cont_btm">
		<td colspan="7" class="right"><input name="batal" class="kembali" type="button" value="Batal" onclick="buka('kembali')" />	
		</td>					
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