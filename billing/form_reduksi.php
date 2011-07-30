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
		 case "rinci":
			$formId		= getToken();
			$cekMess	= getToken();
			/** retrieve data pelanggan */
			try{
				$que0 = "SELECT *FROM v_ba_reduksi WHERE pel_no='$pel_no'";
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
			
		
		case "periksaDSR":
		try {
			$que0 = "SELECT * FROM v_lap_reduksi WHERE pel_no='$pel_no'";
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
<fieldset class="">
<h3>REDUKSI REKENING </h3>

<?php	
	for($i=0;$i<1;$i++){
		$row0 	= $data[$i];
		$pemakaian = $row0['rd_stankini'] - $row0['rd_stanlalu'];
?>
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

<h3>REDUKSI SEBELUMNYA</h3>
<table width="100%" >
				<tr class="table_head center"> 
				    <td rowspan="1" class="center">Tanggal</td>				
				   
				    <td colspan="2" class="center">Sebelumnya</td>
				    <td colspan="3" class="center">Hasil Koreksi</td>
				    <td colspan="2" class="center">Selisih</td>
 					 </tr>
				  <tr class="table_head"> 			
				    <td></td>	  				    
				    <td class="center">Uang Air</td>
				    <td class="center">Nilai Total</td>
				    <td class="center">Reduksi (%)</td>
				    <td class="center">Uang Air</td>
				    <td class="center">Nilai Total</td>
				    <td class="center">Uang Air</td>
				    <td class="center">Nilai Total</td>
  					</tr>

						<tr valign="top" class="table_cell1" >  
					 	    <td >&nbsp;</td>
					 	    											 	    					
					 	    <td >&nbsp;</td>
				   		    <td align="right" >&nbsp;</td>
				   		    <td align="right" >&nbsp;</td>
				   		    <td align="right" >&nbsp;</td>   		    
				     		<td align="right" >&nbsp;</td>
				  		    <td align="right" >&nbsp;</td>
				   		    <td align="right" >&nbsp;</td>
                       </tr>

			<tr class="table_cont_btm">
				<td>&nbsp;</td>
				<td colspan="8"></td>
  			</tr>
</table>
<h3>REDUKSI</h3>
<table width="95%" border="1" >
  <tr bgcolor="#02153F" class="table_head">
    <td class="center">No</td>
    <td class="center">Bulan / Tahun</td>
    <td colspan="2" class="center">Sebelumnya</td>
    <td colspan="2" class="center">Sekarang (Reduksi)</td>
    <td colspan="2" class="center">Selisih</td>
  </tr>
  <tr class="table_cell1">
    <td rowspan="5" class="center"><?php echo $row0['rek_nomor']; ?></td>
    <td rowspan="5"><?php echo $bulan[$row0['rek_bln']]." ".$row0['rek_thn'];  ?></td>
    <td>Stan Lalu </td>
    <td>:<?php echo number_format($row0['rd_stanlalu']); ?></td>
    <td colspan="2" rowspan="3"><form id="form1" name="form1" method="post" action="">
      <p>Reduksi
        <input name="persen" type="text" id="persen" size="10" />
        Persen </p>
        <p align="center">
          <input type="button" name="Button" value="Hitung" class="hitung" onclick="periksa('hitung')"/>   
        </p>
    </form></td>
    <td width="13%" rowspan="3">&nbsp;</td>
    <td width="10%" rowspan="3">&nbsp;</td>
  </tr>
  <tr class="table_cell1">
    <td>Stan Kini</td>
    <td>:<?php echo number_format($row0['rd_stankini']); ?></td>
  </tr>
  <tr class="table_cell1">
    <td>Pemakaian</td>
    <td>:<?php echo number_format($pemakaian); ?></td>
  </tr>
  <tr class="table_cell1">
    <td>Uang Air</td>
    <td>:</td>
    <td>Uang Air </td>
    <td>:</td>
    <td>Uang Air :</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="table_cell1">
    <td>NILAI TOTAL </td>
    <td>:</td>
    <td>NILAI TOTAL</td>
    <td>:</td>
    <td>NILAI TOTAL :</td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#02153F" class="table_validator">
    <td colspan="8" class="table_cont_btm right"><input name="Submit" type="submit" value="Reduksi" />
       <input name="Submit2" type="submit" value="Batal" />
    </td>
  </tr>
</table>
<?php
}
?>

</fieldset>
<?			
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
<div class="span-4">: <input type="text" class="cekDSR" name="pel_no" size="6" maxlength="6" value="015470"/></div>
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