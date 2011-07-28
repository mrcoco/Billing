<?php
	if($erno) die();
	$kp_kode = _KOTA;
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

	/** Pagination */
	$kembali		= "<input type=\"button\" value=\"Kembali\" onclick=\"buka('kembali')\"/>";
	if(isset($pg) and $pg>1){
		$next_page 	= $pg + 1;
		$pref_page 	= $pg - 1;
		$pref_mess	= "<input type=\"button\" value=\"<<\" class=\"form_button\" onClick=\"buka('pref_page')\"/>";
	}
	else{
		$pg 		= 1;
		$next_page 	= 2;
		$pref_page 	= 1;
	}
	$jml_perpage 	= 7;
	$limit_awal	 	= ($pg - 1) * $jml_perpage;
	
	/** retrieve view rayon */
?>
<h2><?php echo _NAME; ?></h2>
<input type="hidden" class="refresh next_page pref_page" 	name="proses" 	value="<?php echo $proses; ?>"/>
<?
	switch($proses){
		case "rinci":
			$que0 = "SELECT *,SUM(rek_lembar) AS jml_rek,SUM(rek_total) AS total FROM v_info_pelanggan WHERE dkd_kd='$dkd_kd' GROUP BY pel_no LIMIT $limit_awal,$jml_perpage";
			break;
		case "cari":
			$que0 = "SELECT *FROM v_rayon WHERE dkd_kd LIKE '%$kode%' OR dkd_jalan LIKE '%$kode%' OR dkd_pembaca LIKE '%$kode%' LIMIT $limit_awal,$jml_perpage";
			unset($proses);
			break;
		case "cariSL":
			$kunci	= strtoupper($kunci);
			$que0 	= "SELECT *FROM v_data_pelanggan WHERE UPPER(pel_no) LIKE '%$kunci%' OR UPPER(pel_nama) LIKE '%$kunci%' OR UPPER(pel_alamat) LIKE '%$kunci%' LIMIT $limit_awal,$jml_perpage";
			$proses	= "rinci";
			break;
		default :
			$que0 = "SELECT *FROM v_rayon WHERE kp_kode='$kp_kode' LIMIT $limit_awal,$jml_perpage";
	}
	
	/** inquiry data */
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
			/*	pagination : menentukan keberadaan operasi next page	*/
			if($i==$jml_perpage){
				$next_mess	= "<input type=\"button\" value=\">>\" class=\"form_button\" onClick=\"buka('next_page')\"/>";
			}
			$mess = false;
		}
	}
	catch (Exception $e){
		errorLog::errorDB(array($que0));
		$mess = $e->getMessage();
	}
	
	if(!$erno) mysql_close($link);
?>
<input type="hidden" id="<?php echo $errorId; ?>" value="<?php echo $mess; ?>"/>
<input type="hidden" class="kembali refresh cari next_page pref_page" name="appl_kode" 	value="<?php echo _KODE; 		?>"/>
<input type="hidden" class="kembali refresh cari next_page pref_page" name="appl_name" 	value="<?php echo _NAME; 		?>"/>
<input type="hidden" class="kembali refresh cari next_page pref_page" name="appl_file" 	value="<?php echo _FILE; 		?>"/>
<input type="hidden" class="kembali refresh cari next_page pref_page" name="appl_proc" 	value="<?php echo _PROC; 		?>"/>
<input type="hidden" class="kembali refresh cari next_page pref_page" name="appl_tokn" 	value="<?php echo _TOKN; 		?>"/>
<input type="hidden" class="kembali refresh cari next_page pref_page" name="targetUrl" 	value="<?php echo _FILE; 		?>"/>
<input type="hidden" class="kembali refresh cari next_page pref_page" name="errorId"   	value="<?php echo getToken();	?>"/>
<input type="hidden" class="kembali refresh cari next_page pref_page" name="dkd_kd" 	value="<?php echo $dkd_kd; 		?>"/>
<input type="hidden" class="kembali refresh cari next_page pref_page" name="targetId"  	value="content"/>
<input type="hidden" class="next_page" name="pg" value="<?php echo $next_page; ?>"/>
<input type="hidden" class="pref_page" name="pg" value="<?php echo $pref_page; ?>"/>
<input type="hidden" class="refresh" name="pg" value="<?php echo $pg;	?>"/>
<input type="hidden" class="kembali" name="pg" value="<?php echo $back; ?>"/>
<?php
	switch($proses){
		case "rinci":
		if(count($data)>0){
?>
<input type="hidden" class="cari" name="proses" 	value="cariSL"/>
<input type="hidden" class="refresh next_page pref_page" name="back" value="<?php echo $back; ?>"/>
<table class="table_info">
  <tr class="table_cont_btm">
		<td colspan="8">
			Pencarian :
			<input type="text" class="cari next_page pref_page" name="kunci" value="<?php echo $kunci; ?>" onchange="buka('cari')" size=	"10" title="Pencarian berdasarkan nomor SL, nama atau alamat pelanggan"/>
		</td>
		<td width="57" class="right">Halaman : <?php echo $pg; ?></td>
  </tr>
  <tr class="table_head">
    <td>No</td>
    <td>No. SL </td>
    <td>Nama</td>
    <td>Gol</td>
    <td>Alamat</td>
    <td>Jml Rek </td>
    <td>Total</td>
    <td>Kota Pelayanan</td>
    <td>Manage</td>
  </tr>
  
<?php
	for($i=0;$i<count($data);$i++){
		$row0 	= $data[$i];
		$nomor	= ($i+1)+(($pg-1)*$jml_perpage);
		$jml_lembar= $row0['jml_rek'];
		$jml_total = $row0['total'];
		$klas 	= "table_cell1";
		if(($i%2) == 0){
			$klas = "table_cell2";
		}
			
?>

  <tr class="<?php echo $klas; ?>" >
    <td><?php echo $nomor; ?></td>
    <td><?php echo $row0['pel_no']; ?></td>
    <td><?php echo $row0['pel_nama']; ?></td>
    <td><?php echo $row0['gol_kode']; ?></td>
    <td><?php echo $row0['pel_alamat']; ?></td>
    <td class="right"><?php echo number_format($jml_lembar); ?></td>
    <td class="right"><?php echo number_format($jml_total); ?></td>
    <td><?php echo $row0['kp_ket'] ?></td>
    <td> 
			<input type="hidden" class="rinci_<?php echo $i; ?>" name="dkd_kd"		value="<?php echo $dkd_kd; ?>"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" name="appl_kode"	value="<?php echo _KODE; ?>"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" name="appl_name"	value="<?php echo _NAME; ?>"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" name="appl_file"	value="<?php echo _FILE; ?>"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" name="appl_proc"	value="<?php echo _PROC; ?>"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" name="appl_tokn" 	value="<?php echo _TOKN; ?>"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" name="errorId"   	value="<?php echo getToken(); ?>"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" name="pel_no"   	value="<?php echo $row0['pel_no'];		?>"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" name="pel_nama"   	value="<?php echo $row0['pel_nama'];	?>"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" name="gol_kode"   	value="<?php echo $row0['gol_kode'];	?>"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" name="pel_alamat"  value="<?php echo $row0['pel_alamat'];	?>"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" name="rek_lembar"  value="<?php echo $jml_lembar;	?>"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" name="rek_total"   value="<?php echo $jml_total;	?>"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" name="kp_ket"   	value="<?php echo $row0['kp_ket'];	?> "/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" name="kps_ket"   	value="<?php echo $row0['kps_ket'];	?> "/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" name="errorUrl" value="cetak_info_pelanggan.php"/>
			<img src="./images/edit.gif" title="Lihat Rincian" onclick="nonghol('rinci_<?php echo $i; ?>')"/></td>
  </tr>

<?php

	}
?>
	<tr class="table_cont_btm">
		<td colspan="9" class="right">&nbsp;<?php echo $pref_mess." ".$kembali." ".$next_mess; ?></td>
	</tr>
</table>

<?php
			}
			else{
				//echo "<center class=\"notice\">Data pencarian ".$kunci." tidak ditemukan</center>";
				echo "<center class=\"notice\">Data Pelanggan Rayon ".$dkd_kd." Tidak ditemukan</center>";
				echo $kembali;
			}
			break;
		default:
?>
<input type="hidden" class="cari" name="proses" value="cariSL"/>
<input type="hidden" class="cari" name="back" 	value="<?php echo $pg; ?>"/>
<table class="table_info">
	<tr class="table_cont_btm">
		<td colspan="5">
			Pencarian :
			<input type="text" class="cari next_page pref_page" name="kode" value="<?php echo $kode; ?>" onchange="buka('cari')" size="10" title="Pencarian berdasarkan kode rayon, petugas, atau jalan"/>
		</td>
		<td class="right">Halaman : <?php echo $pg; ?></td>
	</tr>
	<tr class="table_head"> 
		<td>No</td>
		<td>Kode</td>   
		<td>Tgl Catat</td>        
		<td>Nama Petugas</td>
		<td>Jalan</td>
		<td>Manage</td>
	</tr>
<?php
	for($i=0;$i<count($data);$i++){
		$row0 = $data[$i];
		$nomor	= ($i+1)+(($pg-1)*$jml_perpage);
		$klas 	= "table_cell1";
		if(($i%2) == 0){
			$klas = "table_cell2";
		}
		$dkd_kd = $row0['dkd_kd'];
?>
	<tr valign="top" class="<?php echo $klas; ?>">
		<td><?php echo $nomor;				?></td>
		<td><?php echo $row0['dkd_kd'];		?></td>
		<td><?php echo $row0['dkd_tcatat']; ?></td>
		<td><?php echo $row0['dkd_pembaca'];?></td>
		<td><?php echo $row0['dkd_jalan'];	?></td>
		<td>
			<input type="hidden" class="rinci_<?php echo $i; ?>" name="dkd_kd"		value="<?php echo $dkd_kd; 		?>"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" name="appl_kode"	value="<?php echo _KODE;		?>"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" name="appl_name"	value="<?php echo _NAME; 		?>"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" name="appl_file"	value="<?php echo _FILE; 		?>"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" name="appl_proc"	value="<?php echo _PROC; 		?>"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" name="appl_tokn" 	value="<?php echo _TOKN; 		?>"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" name="back"	 	value="<?php echo $pg; 			?>"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" name="targetUrl" 	value="<?php echo _FILE; 		?>"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" name="errorId"   	value="<?php echo getToken();	?>"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" name="targetId" 	value="content"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" name="proses"	 	value="rinci"/>
			<input type="hidden" class="rinci_<?php echo $i; ?>" name="dump"	   	value="0"/>
			<img src="./images/edit.gif" title="Lihat Rincian" onclick="buka('rinci_<?php echo $i; ?>')"/>
		</td>
	</tr>
<?php

	}
?>
	<tr class="table_cont_btm">
		<td colspan="5" class="left"></td>
		<td class="right">
			&nbsp;<?php echo $pref_mess." ".$next_mess; ?>
		</td>
	</tr>
</table>
<?php
	}
?>