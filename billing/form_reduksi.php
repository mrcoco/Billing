<?php
	if($erno) die();
	if(!isset($appl_tokn)) define("_TOKN",getToken());
	switch($proses){
		case "periksaDSR":
			echo "Haaman Periksa DSR";
			echo"<fieldset class=''>";
			echo"<p><strong>REDUKSI REKENING </strong></p>";
			echo"<table width='82%' >";
				    		echo"<tr class='table_cell1'>
				    		  <td width='18%' class='table_cell1' > No. Pelanggan</td> 
				    		  <td width='21%' class='text'>:</td>
				    		  <td width='25%' class='text'>&nbsp;</td>
				    		  <td width='36%' class='text'>&nbsp;</td>";                           			
  echo"<tr class='table_cell1'>
    <td class='text' >Nama</td>	    
    <td class='text'>:</td>
    <td class='text'>Golongan</td>
    <td class='text'> : 	</td>";        	                
  echo"<tr class='table_cell1'>
				    		  <td class='text' >Alamat</td>   
    <td class='text'>:</td>
    <td class='text'>Rayon Pembacaan </td>
    <td class='text'> : </td>";				
echo"</table>";	
echo"<p><strong>REDUKSI SEBELUMNYA</strong></p>";
echo"<table width='100%' >";
				echo"<tr class='table_validator' > 
				    <td rowspan='1'><div align='center'><strong>Tanggal</strong></div></td>				
				   
				    <td colspan='2'><div align='center'><strong>Sebelumnya</strong></div></td>
				    <td colspan='3' ><div align='center'><strong>Hasil Koreksi</strong></div></td>
				    <td colspan='2' ><div align='center'><strong>Selisih</strong></div></td>
 					 </tr>";
				  echo"<tr class='table_validator'> 			
				    <td><div align='center'> </div></td>	  				    
				    <td><div align='center'><strong>Uang Air	</strong></div></td>
				    <td><div align='center'><strong>Nilai Total 	</strong></div></td>
				    <td><div align='center'><strong>Reduksi (%)    </strong></div></td>
				    <td><div align='center'><strong>Uang Air	</strong></div></td>
				    <td><div align='center'><strong>Nilai Total 	</strong></div></td>
				    <td><div align='center'><strong>Uang Air	</strong></div></td>
				    <td><div align='center'><strong>Nilai Total 	</strong></div></td>
  					</tr>";

						echo"<tr valign='top' class='table_cell1' >  
					 	    <td >&nbsp;</td>
					 	    											 	    					
					 	    <td >&nbsp;</td>
				   		    <td align='right' >&nbsp;</td>
				   		    <td align='right' >&nbsp;</td>
				   		    <td align='right' >&nbsp;</td>   		    
				     		<td align='right' >&nbsp;</td>
				  		    <td align='right' >&nbsp;</td>
				   		    <td align='right' >&nbsp;</td>
                       </tr>";

			echo"<tr class='table_validator'>
				<td>&nbsp;</td>
				<td colspan='8'></td>
  </tr>";
echo"</table>";
echo"<p class='style1'>REDUKSI </p>";
echo"<table width='95%' border='1' >";
  echo"<tr bgcolor='#02153F' class='table_validator'>
    <td width='14%'><div align='center' class='style3'>No</div></td>
    <td width='13%'><div align='center' class='style6 style3'>Bulan / Tahun </div></td>
    <td colspan='2'><div align='center' class='style3'><span class='style6'>Sebelumnya</span></div></td>
    <td colspan='2'><div align='center' class='style3'><span class='style6'>Sekarang (Reduksi) </span></div></td>
    <td colspan='2'><div align='center' class='style3'><span class='style6'>Selisih</span></div></td>
  </tr>";
  echo"<tr>
    <td rowspan='5' class='table_cell1 center'>123456789011212</td>
    <td rowspan='5' class='table_cell1 center'>Juni 2011 </td>
    <td width='13%' class='table_cell1'>Stan Lalu </td>
    <td width='9%' class='table_cell1'>:</td>
    <td colspan='2' rowspan='3' class='table_cell1'><form id='form1' name='form1' method='post' action=''>";
      echo"<p>Reduksi
        <input name='persen' type='text' id='persen' size='10' />
        Persen </p>";
        echo"<p align='center'>
          <input type='button' name='Button' value='Hitung' class='hitung_button'/>   
        </p>";
    echo"</form></td>
    <td width='13%' rowspan='3' class='table_cell1'>&nbsp;</td>
    <td width='10%' rowspan='3' class='table_cell1'>&nbsp;</td>
  </tr>";
  echo"<tr>
    <td height='27' class='table_cell1'>Stan Kini</td>
    <td class='table_cell1'>:</td>
  </tr>";
  echo"<tr>
    <td height='27' class='table_cell1'>Pemakaian</td>
    <td class='table_cell1'>:</td>
  </tr>";
  echo"<tr>
    <td height='34' class='table_cell1'>Uang Air</td>
    <td class='table_cell1'>:</td>
    <td width='16%' class='table_cell1'>Uang Air &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;:</td>
    <td width='12%' class='table_cell1 right'>&nbsp;</td>
    <td class='table_cell1'>Uang Air &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;:</td>
    <td class='table_cell1 right'>&nbsp;</td>
  </tr>";
  echo"<tr>
    <td height='27' class='table_cell1'>NILAI TOTAL </td>
    <td class='table_cell1'>:</td>
    <td class='table_cell1'>NILAI TOTAL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td class='table_cell1 right'>&nbsp;</td>
    <td class='table_cell1'>NILAI TOTAL &nbsp;&nbsp;&nbsp;&nbsp;:</td>
    <td class='table_cell1 right'>&nbsp;</td>
  </tr>";
  echo"<tr bgcolor='#02153F' class='table_validator'>
    <td height='30' colspan='8'><div align='right'><input name='Submit' type='submit' value='Reduksi' />
       <input name='Submit2' type='submit' value='Batal' />
    </div></td>
  </tr>";
echo"</table>";
echo"</fieldset>";
			
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
			$parm1	 = array("class"=>"cekDSR","name"=>"rek_bln","selected"=>6);
?>

<link href="css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>



<h2><?php echo _NAME; ?></h2><hr/>
<input type="hidden" class="cekDSR" name="appl_kode" 	value="<?php echo _KODE; ?>"/>
<input type="hidden" class="cekDSR" name="appl_name" 	value="<?php echo _NAME; ?>"/>
<input type="hidden" class="cekDSR" name="appl_file" 	value="<?php echo _FILE; ?>"/>
<input type="hidden" class="cekDSR" name="appl_proc" 	value="<?php echo _PROC; ?>"/>
<input type="hidden" class="cekDSR" name="appl_tokn" 	value="<?php echo _TOKN; ?>"/>
<input type="hidden" class="cekDSR" name="targetUrl" 	value="<?php echo _FILE; ?>"/>
<input type="hidden" class="cekDSR" name="targetId" 	value="content"/>
<input type="hidden" class="cekDSR" name="proses"	 	value="periksaDSR"/>
<input type="hidden" class="cekDSR" name="dump" 		value="0"/>
<div class="span-4 border">&nbsp;</div>
<div class="span-4">Nomor Pelanggan</div>
<div class="span-4">: <input type="text" class="cekDSR" name="pel_no" size="6" maxlength="6"/></div>
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
	<input type="hidden" class="cekDSR" name="cekUrl" 	value="<?php echo _PROC; ?>"/>
	<input type="hidden" class="cekDSR" name="cekId" 	value="peringatan"/>
	<input type="hidden" class="cekDSR" name="cekMess" 	value="<?php echo getToken(); ?>"/>
	<input type="Button" value="Cek Rekening" onclick="periksa('cekDSR')"/>
</div>
<?php
	}
?>