<?php
 
	if($erno) die();
	if(!isset($appl_tokn)) define("_TOKN",getToken());
	
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
	}
	
	switch($proses){
		case "prosesDRD":
			echo "penerbitan DRD";
			
	
?>
<link href="css/style.css" rel="stylesheet" type="text/css">

<fieldset> halaman proses drd </fieldset>
<?php	
break;
		default:
	/* pilih kota pelayanan */
	try{
		$que0 	= "SELECT kp_kode,CONCAT('[',kp_kode,'] ',kp_ket) AS kp_ket FROM tr_kota_pelayanan ORDER BY kp_kode";
		if(!$res2 = mysql_query($que0,$link)){
			throw new Exception("Terjadi kesalahan pada sistem database<br/>Nomor Tiket : ".substr(_TOKN,-4));
		}
		else{
			while($row2 = mysql_fetch_array($res2)){
				$data2[] = array("kp_kode"=>$row2['kp_kode'],"kp_ket"=>$row2['kp_ket']);
			}
			$param2 = array("class"=>"prosesDRD","name"=>"kp_kode","selected"=>$kp_kode); 
		}
	}
	catch (Exception $e){
		errorLog::errorDB(array($que0));
		$error_mess	= $e->getMessage();
		$show_form 	= false;
	}
	
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
<input type="hidden" class="prosesDRD" name="dump" 		value="0"/>
<div class="prepend-4 border"></div>

<div class="span-5 center">Kota Pelayanan :  </div>
<div class="span-5 center">
  <p><?php echo pilihan($data2,$param2);  ?></p>
  <p><span class="span-12 center">
    <input type="hidden" class="prosesDRD" name="cekUrl" 	value="<?php echo _PROC; ?>"/>
    <input type="hidden" class="prosesDRD" name="cekId" 	value="peringatan"/>
    <input type="hidden" class="prosesDRD" name="cekMess" 	value="<?php echo getToken(); ?>"/>
    <input name="Button" type="Button" onclick="periksa('prosesDRD')" value="Proses"/>
  </span> </p>
</div>

<div class="span-10"><table width="200" border="1">
  <tr>
    <td colspan="3">Resume Proses DRD </td>
    </tr>
  <tr class="table_head">
    <td class="center">Golongan</td>
    <td class="center">Lembar</td>
    <td class="center">Rupiah</td>
  </tr>
  <tr class="table_cell1">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="table_cell2">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="table_validator">
    <td colspan="3" class="table_validator center">Total</td>
    </tr>
</table>
</div><br /><br/>
<div class="span-12 center"></div>
<div class="prepend-4 border"></div>
<?php
	}
?>