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

	switch($proses){
		case "hitung":
			/** retrieve uang air kini */
			$rek_pakai_klaim 	= $rek_stanklaim - $rek_stanlalu;
			$rek_stanselisih	= $rek_stanklaim - $rek_stankini;
			try{
				$que0 = "SELECT getUangAir($rek_pakai_klaim,'$rek_gol',$rek_bln,$rek_thn) AS rek_uangair_klaim";
				if(!$res0 = mysql_query($que0,$link)){
					throw new Exception($que0);
				}
				else{
					$row0 				= mysql_fetch_array($res0);
					$rek_total_selisih	= $row0['rek_uangair_klaim'] - $rek_uangair;
					$rek_total_klaim	= $row0['rek_uangair_klaim'] + $rek_beban;
					$mess 				= false;
				}
			}
			catch (Exception $e){
				errorLog::errorDB(array($que0));
				$mess = $e->getMessage();
			}
?>
<table border="2">
	<tr class="table_cell1">
		<td class="height-1">Stan Lalu</td><td>: <?php echo number_format($rek_stanlalu); ?></td>
		<td>Stan Lalu</td><td>: 0</td>
	</tr>
	<tr class="table_cell2">
		<td class="height-1">Stan Kini</td>
		<td>
			: <input type="text" class="reduksi hitung" name="rek_stanklaim" size="4" value="<?php echo $rek_stanklaim; ?>"/>
			<input type="button" class="form_button" value="Hitung" onclick="periksa('hitung')"/>
		</td>
		<td>Stan Kini</td>
		<td>: <?php echo number_format($rek_stanselisih);			?></td>
	</tr>
	<tr class="table_cell1">
		<td class="height-1">Pemakaian</td>
		<td>: <?php echo number_format($rek_pakai_klaim);			?></td>
		<td>Pemakaian</td>
		<td>: <?php echo number_format($rek_stanselisih);			?></td>
	</tr>
	<tr class="table_cell2">
		<td class="height-1">Uang Air</td>
		<td>: <?php echo number_format($row0['rek_uangair_klaim']);	?></td>
		<td>Uang Air</td>
		<td>: <?php echo number_format($rek_total_selisih);			?></td>
	</tr>
	<tr class="table_cell1">
		<td class="height-1">Nilai Total</td>
		<td>: <?php echo number_format($rek_total_klaim);			?></td>
		<td>Nilai Total</td>
		<td>: <?php echo number_format($rek_total_selisih);			?></td>
	</tr>
</table>
<?php
			break;
		case "rinci":
			$formId		= getToken();
			$cekMess	= getToken();
			/** retrieve data pelanggan */
			try{
				$que0 = "SELECT *FROM v_data_pelanggan WHERE pel_no='$pel_no'";
				if(!$res0 = mysql_query($que0,$link)){
					throw new Exception($que0);
				}
				else{
					$row0 = mysql_fetch_array($res0);
					$mess = false;
				}
			}
			catch (Exception $e){
				errorLog::errorDB(array($que0));
				$mess = $e->getMessage();
			}
			/** retrieve kode klaim */
			try{
				$que1 = "SELECT *FROM tr_klaim";
				if(!$res1 = mysql_query($que1,$link)){
					throw new Exception($que1);
				}
				else{
					while($row1 = mysql_fetch_array($res1)){
						$data1[] = array("kl_kode" => $row1['kl_kd'], "kl_ket" => $row1['kl_ket']);
					}
					$parm1	= array("class" => "proses", "name" => "kl_kode", "selected" => "1");
					$mess 	= false;
				}
			}
			catch (Exception $e){
				errorLog::errorDB(array($que1));
				$mess = $e->getMessage();
			}
			/** retrieve catatan klaim */
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
			/** retrieve drd awal */
			try{
				$que2 = "CALL p_get_drd_awal('$pel_no',$rek_bln,$rek_thn,@rek_gol,@rek_stankini,@rek_stanlalu,@rek_uangair,@rek_total,@status)";
				$que3 = "SELECT @rek_gol AS rek_gol,@rek_stankini AS rek_stankini,@rek_stanlalu AS rek_stanlalu,@rek_uangair AS rek_uangair,@rek_total AS rek_total,@status AS status";
				if(!$res2 = mysql_query($que2,$link)){
					throw new Exception($que2);
				}
				else{
					$res3 		= mysql_query($que3,$link);
					$row3 		= mysql_fetch_array($res3);
					$pakai_kini	= $row3['rek_stankini'] - $row3['rek_stanlalu'];
					$rek_beban	= $row3['rek_total'] - $row3['rek_uangair'];
					$mess 		= false;
				}
			}
			catch (Exception $e){
				errorLog::errorDB(array($que2));
				$mess = $e->getMessage();
			}
			$kembali 	= "<input type=\"button\" class=\"form_button\" value=\"Kembali\"/>";
			if($rek_bln == 12){
				$next_thn = $rek_thn + 1;
				$next_bln = 1;
			}
			else{
				$next_thn = $rek_thn;
				$next_bln = $rek_bln + 1;
			}
			if($row3['rek_stanlalu']){
?>
<h2>Klaim/Perubahan Rekening Air : <?php echo $bulan[$rek_bln]." ".$rek_thn; ?></h2>
<input type="hidden" class="hitung proses" name="appl_kode" value="<?php echo _KODE; 	?>"/>
<input type="hidden" class="hitung proses" name="appl_name" value="<?php echo _NAME; 	?>"/>
<input type="hidden" class="hitung proses" name="appl_file" value="<?php echo _FILE; 	?>"/>
<input type="hidden" class="hitung proses" name="appl_proc" value="<?php echo _PROC; 	?>"/>
<input type="hidden" class="hitung proses" name="appl_tokn" value="<?php echo _TOKN; 	?>"/>
<input type="hidden" class="hitung proses" name="targetUrl" value="<?php echo _FILE;	?>"/>
<input type="hidden" class="hitung proses" name="dump" 		value="0"/>
<input type="hidden" class="proses" name="proses"	 	value="rinci"/>
<input type="hidden" class="proses" name="targetId"	 	value="content"/>
<input type="hidden" class="proses" name="rek_bln"	 	value="<?php echo $next_bln;?>"/>
<input type="hidden" class="proses" name="rek_thn"	 	value="<?php echo $next_thn;?>"/>
<input type="hidden" class="proses" name="pel_no"	 	value="<?php echo $pel_no; 	?>"/>
<input type="hidden" class="hitung" name="targetId" 	value="<?php echo $formId; 	?>"/>
<input type="hidden" class="hitung" name="rek_bln"	 	value="<?php echo $rek_bln;	?>"/>
<input type="hidden" class="hitung" name="rek_thn"	 	value="<?php echo $rek_thn;	?>"/>
<input type="hidden" class="hitung" name="rek_stanlalu" value="<?php echo $row3['rek_stanlalu'];?>"/>
<input type="hidden" class="hitung" name="rek_stankini" value="<?php echo $row3['rek_stankini'];?>"/>
<input type="hidden" class="hitung" name="rek_uangair" 	value="<?php echo $row3['rek_uangair']; ?>"/>
<input type="hidden" class="hitung" name="rek_beban" 	value="<?php echo $rek_beban;		 	?>"/>
<input type="hidden" class="hitung" name="rek_gol"	 	value="<?php echo $row3['rek_gol']; 	?>"/>
<input type="hidden" class="hitung"	name="cekUrl" 		value="<?php echo _PROC; 				?>"/>
<input type="hidden" class="hitung"	name="cekMess" 		value="<?php echo $cekMess;				?>"/>
<input type="hidden" class="hitung"	name="cekId" 		value="peringatan"/>
<input type="hidden" class="hitung" name="proses" 		value="hitung"/>
<table>
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
<hr>
<h3>CATATAN :</h3>
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
<?php
			for($i=0;$i<count($data4);$i++){
				$row4 = $data4[$i];
				$klas 	= "table_cell1";
				if(($i%2) == 0){
					$klas = "table_cell2";
				}
				$cl_uangair_selisih = $row4['cl_uangair_akhir'] - $row4['cl_uangair_awal'];
?>
	<tr class="<?php echo $klas; ?>">
		<td><?php echo $row4['tgl_klaim']; ?></td>
		<td><?php echo number_format($row4['cl_stanlalu_awal']); 	?></td>
		<td><?php echo number_format($row4['cl_stankini_awal']);	?></td>
		<td><?php echo number_format($row4['cl_stankini_akhir']);	?></td>
		<td><?php echo number_format($row4['cl_uangair_awal']);		?></td>
		<td><?php echo number_format($row4['cl_uangair_akhir']);	?></td>
		<td><?php echo number_format($cl_uangair_selisih);			?></td>
	</tr>
<?php
			}
?>
</table>
<h3>KOREKSI :</h3>
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
						<input type="button" class="form_button" value="Hitung" onclick="periksa('hitung')"/>
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
		<td rowspan="6"><?php echo pilihan($data1,$parm1); ?></td>
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
		</td>					
	</tr>
</table>
<?php
			}
			else{
?>
<h2>Proses klaim/Perubahan Rekening Air Selesai</h2>
<input type="hidden" class="kembali" name="appl_kode" 	value="<?php echo _KODE; ?>"/>
<input type="hidden" class="kembali" name="appl_name" 	value="<?php echo _NAME; ?>"/>
<input type="hidden" class="kembali" name="appl_file" 	value="<?php echo _FILE; ?>"/>
<input type="hidden" class="kembali" name="appl_proc" 	value="<?php echo _PROC; ?>"/>
<input type="hidden" class="kembali" name="targetUrl" 	value="<?php echo _FILE; ?>"/>
<input type="hidden" class="kembali" name="targetId" 	value="content"/>
<input type="button" class="form_button" value="Cetak Berita Acara"/>
<input type="button" class="form_button" value="Kembali" onclick="buka('kembali')"/> 
<?php
			}
			break;
		default:
			for($i=1;$i<13;$i++){
				$data1[]	= array("rek_bln"=>$i,"bln_nama"=>$bulan[$i]);
			}
			$parm1		= array("class"=>"rinci","name"=>"rek_bln","selected"=>"4");
			$cekMess	= getToken();
?>
<h2><?php echo _NAME; ?></h2>
<input type="hidden" class="rinci" name="appl_kode" 	value="<?php echo _KODE; 	?>"/>
<input type="hidden" class="rinci" name="appl_name" 	value="<?php echo _NAME; 	?>"/>
<input type="hidden" class="rinci" name="appl_file" 	value="<?php echo _FILE; 	?>"/>
<input type="hidden" class="rinci" name="appl_proc" 	value="<?php echo _PROC; 	?>"/>
<input type="hidden" class="rinci" name="appl_tokn" 	value="<?php echo _TOKN; 	?>"/>
<input type="hidden" class="rinci" name="targetUrl" 	value="<?php echo _FILE; 	?>"/>
<input type="hidden" class="rinci" name="cekUrl" 		value="<?php echo _PROC; 	?>"/>
<input type="hidden" class="rinci" name="cekMess" 		value="<?php echo $cekMess;	?>"/>
<input type="hidden" class="rinci" name="targetId" 		value="content"/>
<input type="hidden" class="rinci" name="proses"	 	value="rinci"/>
<input type="hidden" class="rinci" name="cekId" 		value="peringatan"/>
<div class="prepend-4 span-9">
	<div class="span-4">Nomor Pelanggan</div>
	<div class="span-4">
		: <input type="text" class="rinci" name="pel_no" size="6" maxlength="6" value="016021"/>
	</div>
	<div class="span-4 prepend-top">Bulan - Tahun</div>
	<div class="span-4 prepend-top">
		: <?php echo pilihan($data1,$parm1); ?>
		<input type="text" class="rinci" name="rek_thn" size="4" maxlength="4" value="2011"/>
	</div>
	<div class="prepend-4 span-4 prepend-top">
		&nbsp;<input type="Button" value="Cek Rekening" onclick="periksa('rinci')"/>
	</div>
</div>
<?php
	}
	if(!$erno) mysql_close($link);
?>