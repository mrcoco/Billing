<?php
	if($erno) die();
	$formId = getToken();
?>
<div id="<?php echo $formId; ?>" class="peringatan">
<div class="pesan">
<div class="span-14 right large">[<a title="Tutup jendela ini" onclick="tutup('<?php echo $formId; ?>')">Tutup</a>]</div>
<h3>Form Edit Pengguna</h3>
<hr/>
<?php
/*					case "edit":
			$que4 	= "SELECT *FROM v_daftar_pengguna WHERE usr_id='$usr_id'";
			$res4 	= mysql_query($que4) or die(errorHD::salahDB(array(mysql_errno(),mysql_error(),$que4)));
			$row4	= mysql_fetch_object($res4);
			$que2 	= "SELECT kp_kode,kp_ket FROM tr_kota_pelayanan ORDER BY kp_kode";
			$res2 	= mysql_query($que2) or die(errorHD::salahDB(array(mysql_errno(),mysql_error(),$que2)));
			while($row2 = mysql_fetch_row($res2)){
				$kode2[] 	= $row2[0];
				$nilai2[] 	= $row2[1];
			}
			$param2 = array("kelas"=>"simpan","nama"=>"kp_kode","pilihan"=>$row4->kp_kode,"status"=>"style=\"font-size: 9pt\""); 
			$que3 	= "SELECT grup_id,grup_NAME FROM tm_group ORDER BY grup_id";
			$res3 	= mysql_query($que3) or die(errorHD::salahDB(array(mysql_errno(),mysql_error(),$que3)));
			while($row3 = mysql_fetch_row($res3)){
				$kode3[] 	= $row3[0];
				$nilai3[] 	= $row3[1];
			}
			$param3 = array("kelas"=>"simpan","nama"=>"grup_id","pilihan"=>$row4->grup_id,"status"=>"style=\"font-size: 9pt\""); 
?>
<input type="hidden" class="simpan" name="aksi" value="edit"/>
<input type="hidden" class="simpan" name="targetUrl" value="<?=_PROC?>"/>
<input type="hidden" class="kembali" name="pg" value="<?=$back1?>"/>
<center>
<table style="width:450px">
	<tr>
		<td width="150px">ID</td>
		<td width="300px">:
			<input type="hidden" class="simpan" name="old_id" value="<?=$row4->usr_id?>"/>
			<input type="text" class="simpan" name="usr_id" value="<?=$row4->usr_id?>" size="30" maxlength="8"/>
		</td>
	</tr>
	<tr>
		<td>Nama</td>
		<td>:
			<input type="text" class="simpan" name="usr_NAME" value="<?=$row4->usr_NAME?>" size="30"/>
		</td>
	</tr>
	<tr>
		<td>Jabatan</td>
		<td>: <input type="text" class="simpan" name="usr_jabatan" value="<?=$row4->usr_jabatan?>" size="30"/></td>
	</tr>
	<tr>
		<td>Kota Pelayanan</td>
		<td>: <?=sub_select($kode2,$nilai2,$param2)?></td>
	</tr>
	<tr>
		<td>Grup</td>
		<td>: <?=sub_select($kode3,$nilai3,$param3)?></td>
	</tr>
	<tr class="table_cont_btm">
		<td id="errId" colspan="2" class="right">
			<input type="button" value="Simpan" onclick="simpan('simpan')"/>
			<input type="button" value="Kembali" onclick="buka('kembali')"/>
		</td>
	</tr>
</table>
<?php
			break;
*/
?>
</div>
</div>