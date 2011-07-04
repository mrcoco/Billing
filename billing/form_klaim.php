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
?>
<input type="hidden" class="rinci" name="appl_kode" 	value="<?php echo _KODE; 	?>"/>
<input type="hidden" class="rinci" name="appl_name" 	value="<?php echo _NAME; 	?>"/>
<input type="hidden" class="rinci" name="appl_file" 	value="<?php echo _FILE; 	?>"/>
<input type="hidden" class="rinci" name="appl_proc" 	value="<?php echo _PROC; 	?>"/>
<input type="hidden" class="rinci" name="appl_tokn" 	value="<?php echo _TOKN; 	?>"/>
<?php
	switch($proses){
		case "rinci":
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
					$parm1	= array("class" => "reduksi", "selected" => "1");
					$mess 	= false;
				}
			}
			catch (Exception $e){
				errorLog::errorDB(array($que1));
				$mess = $e->getMessage();
			}
			
			if(!$erno) mysql_close($link);
?>
<h2>Claim/Perubahan Rekening Air : <?php echo $bulan[$rek_bln]." ".$rek_thn; ?></h2>
<table class="table_info">
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
<h3>KOREKSI :</h3>
<table class="table_info">
	<tr class="table_head"> 
		<td colspan="2" width="25%">Sebelumnya</td>
		<td colspan="2" width="30%">Sekarang (Koreksi)</td>
		<td colspan="2" width="25%">Selisih</td>
		<td width="15%">Alasan Claim </td>
	</tr>
	<tr class="table_cell1">
		<td>Stan Lalu</td><td>: 119</td>
		<td>Stan Lalu</td><td>: 119</td>
		<td>Stan Lalu</td><td>: 119</td>
		<td rowspan="5"><?php echo pilihan($data1,$parm1); ?></td>
	</tr>
	<tr class="table_cell2">
		<td>Stan Kini</td><td>: 119</td>
		<td>Stan Kini</td><td>: <input type="hidden" class="reduksi" name="rek_stankini"/></td>
		<td>Stan Kini</td><td>: 119</td>
	</tr>
	<tr class="table_cell1">
		<td>Pemakaian</td><td>: 119</td>
		<td>Pemakaian</td><td>: 119</td>
		<td>Pemakaian</td><td>: 119</td>
	</tr>
	<tr class="table_cell2">
		<td>Uang Air</td><td>: 119</td>
		<td>Uang Air</td><td>: 119</td>
		<td>Uang Air</td><td>: 119</td>
	</tr>
	<tr class="table_cell1">
		<td>Nilai Total</td><td>: 119</td>
		<td>Nilai Total</td><td>: 119</td>
		<td>Nilai Total</td><td>: 119</td>
	</tr>
	<tr class="table_cont_btm">
		<td colspan="7">
			<input type="button" class="form_button" value="Koreksi"/> 
			<input type="button" class="form_button" value="Kembali"/> 
		</td>					
	</tr>
</table>
<?php
			break;
		default:
			for($i=1;$i<13;$i++){
				$data1[]	= array("rek_bln"=>$i,"bln_nama"=>$bulan[$i]);
			}
			$parm1		= array("class"=>"rinci","name"=>"rek_bln","selected"=>date('n'));
			$cekMess	= getToken();
?>
<h2><?php echo _NAME; ?></h2>
<input type="hidden" class="rinci" name="targetUrl" 	value="<?php echo _FILE; 	?>"/>
<input type="hidden" class="rinci" name="targetId" 		value="content"/>
<input type="hidden" class="rinci" name="proses"	 	value="rinci"/>
<input type="hidden" class="rinci" name="cekId" 		value="peringatan"/>
<input type="hidden" class="rinci" name="cekUrl" 		value="<?php echo _PROC; 	?>"/>
<input type="hidden" class="rinci" name="cekMess" 		value="<?php echo $cekMess;	?>"/>
<div class="prepend-4 span-9">
	<div class="span-4">Nomor Pelanggan</div>
	<div class="span-4">
		: <input type="text" class="rinci" name="pel_no" size="6" maxlength="6" value="001796"/>
	</div>
	<div class="span-4 prepend-top">Bulan - Tahun</div>
	<div class="span-4 prepend-top">
		: <?php echo pilihan($data1,$parm1); ?>
		<input type="text" class="rinci" name="rek_thn" size="4" maxlength="4" value="1998"/>
	</div>
	<div class="prepend-4 span-4 prepend-top">
		&nbsp;<input type="Button" value="Cek Rekening" onclick="periksa('rinci')"/>
	</div>
</div>
<?php
	}
?>