<?php
	if($erno) die();
	define("_TOKN",getToken());
	
	switch($proses){
		case "rinci":
?>
<link href="css/style.css" rel="stylesheet" type="text/css" />

<?php
		break;
		default:
			if($trek) errorLog::logging(array("membuka form reduksi"));
			$periksaId 	= getToken();
			$messId 	= getToken();
?>
<input type="hidden" class="periksa" name="appl_kode"	value="<?php echo _KODE; 		?>"/>
<input type="hidden" class="periksa" name="appl_name"	value="<?php echo _NAME; 		?>"/>
<input type="hidden" class="periksa" name="appl_file"	value="<?php echo _FILE; 		?>"/>
<input type="hidden" class="periksa" name="appl_proc"	value="<?php echo _PROC; 		?>"/>
<input type="hidden" class="periksa" name="appl_tokn"	value="<?php echo _TOKN; 		?>"/>
<input type="hidden" class="periksa" name="targetId" 	value="content"/>
<input type="hidden" class="periksa" name="targetUrl"	value="proses_reduksi.php"/>
<input type="hidden" class="periksa" name="cekUrl"		value="<?php echo _PROC; 		?>"/>
<input type="hidden" class="periksa" name="cekId"		value="<?php echo $periksaId; 	?>"/>
<input type="hidden" class="periksa" name="cekMess"		value="<?php echo $messId; 		?>"/>
<input type="hidden" class="periksa" name="proses" 		value="rinci"/>
<input type="hidden" class="periksa" name="dump" 		value="0"/>
<div class="prepend-6 append-6">
<h2><?=_NAME?></h2><hr/>
<span id="<?php echo $periksaId; ?>"></span>
 <table width="500" align="center">
    <tr valign="top" > 
    <td class="box"> 
        <table width="450" >
          <tr> 
            <td width="29%" class="form_title">No. Pelanggan</td>
            <td width="71%">: 
            <input type="text" size="6" class="periksa" name="pel_no" maxlength="6" value="0000333"/></td>
          </tr>         
          <tr> 
           <td width="29%" class="form_title">Bulan - Tahun</td>
            <td width="71%">:
              <select name="bulan" id="bulan">
                <option selected="selected" value="Januari">Januari</option>
                <option value="Februari">Februari</option>
                <option value="Maret">Maret</option>
                <option value="April">April</option>
                <option value="Mei">Mei</option>
                <option value="Juni">Juni</option>
                <option value="Juli">Juli</option>
                <option value="Agustus">Agustus</option>
                <option value="September">September</option>
                <option value="Oktober">Oktober</option>
                <option value="November">November</option>
                <option value="Desember">Desember</option>
              </select> -
            <input type="text" size="4" class="periksa" name="rek_thn" maxlength="4" value="2011"/>
            </span></td>
          </tr>
	</table>
      </td>
    </tr>
	<tr> 
    <tr> 
      <td align=center  class="box" ><span class="prepend-top prepend-3">
      <input name="button" type="button" class="form_button" onclick="periksa('periksa')" value="Cek Rekening"/></span></td>
   </tr>

    </tr>
</table>

<?php
	}
?>