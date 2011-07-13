<?php
	if($erno) die();
	$formId = getToken();
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
	}

	/* inquiry rayon */
	try{
		$que2 = "SELECT dkd_kd,CONCAT('[',dkd_kd,']',' ',dkd_jalan) AS dkd_jalan FROM tr_dkd WHERE kp_kode='$kp_kode' ORDER BY dkd_kd";
		if(!$res2 = mysql_query($que2,$link)){
			throw new Exception("Terjadi kesalahan pada sistem database<br/>Nomor Tiket : ".substr(_TOKN,-4));
		}
		else{
			while($row2 = mysql_fetch_array($res2)){
				$data2[] = array("dkd_kd"=>$row2['dkd_kd'],"dkd_jalan"=>$row2['dkd_jalan']);
			}
			$mess = false;
		}
	}
	catch (Exception $e){
		errorLog::errorDB(array($que2));
		$mess = $e->getMessage();
		$erno = false;
	}
	$parm2 = array("class"=>"simpan refresh","name"=>"dkd_kd","selected"=>$dkd_kd);
	
	switch($proses){
		case "pilihRayon":
			echo ": ".pilihan($data2,$parm2);
			break;
		default:
			/* inquiry kopel */
			try{
				$que0 = "SELECT kp_kode,kp_ket FROM tr_kota_pelayanan ORDER BY kp_kode";
				if(!$res0 = mysql_query($que0,$link)){
					throw new Exception("Terjadi kesalahan pada sistem database<br/>Nomor Tiket : ".substr(_TOKN,-4));
				}
				else{
					while($row0 = mysql_fetch_array($res0)){
						$data0[] = array("kp_kode"=>$row0['kp_kode'],"kp_ket"=>$row0['kp_ket']);
					}
					$mess = false;
				}
			}
			catch (Exception $e){
				errorLog::errorDB(array($que0));
				$mess = $e->getMessage();
				$erno = false;
			}
			$parm0 = array("class"=>"simpan pilih","name"=>"kp_kode","selected"=>$kp_kode,"onchange"=>"buka('pilih')");
			
			/* inquiry golongan */
			try{
				$que1 = "SELECT gol_kode,CONCAT('[',gol_kode,']',' ',gol_ket) AS gol_ket FROM tr_gol WHERE gol_sts=1 ORDER BY gol_kode";
				if(!$res1 = mysql_query($que1,$link)){
					throw new Exception("Terjadi kesalahan pada sistem database<br/>Nomor Tiket : ".substr(_TOKN,-4));
				}
				else{
					while($row1 = mysql_fetch_array($res1)){
						$data1[] = array("gol_kode"=>$row1['gol_kode'],"gol_ket"=>$row1['gol_ket']);
					}
					$mess = false;
				}
			}
			catch (Exception $e){
				errorLog::errorDB(array($que1));
				$mess = $e->getMessage();
				$erno = false;
			}
			$parm1 = array("class"=>"simpan","name"=>"gol_kode","selected"=>$gol_kode);
?>
<div id="<?php echo $formId; ?>" class="peringatan">
<div class="pesan form-5">
<div class="span-22 right">[<a title="Tutup jendela ini" onclick="tutup('<?php echo $formId; ?>')">Tutup</a>]</div>
<h3>Form Data Pelanggan</h3>
<div id="targetUpdate"></div>
<hr/>
<input type="hidden" class="pilih" 	name="targetUrl" 	value="<?php echo __FILE__;	?>"/>
<input type="hidden" class="pilih" 	name="proses" 		value="pilihRayon"/>
<input type="hidden" class="pilih"	name="targetId" 	value="targetRayon"/>
<input type="hidden" class="simpan"	name="appl_tokn" 	value="<?php echo _TOKN; 	?>"/>
<input type="hidden" class="simpan"	name="appl_kode" 	value="<?php echo _KODE; 	?>"/>
<input type="hidden" class="simpan"	name="targetUrl" 	value="<?php echo _PROC; 	?>"/>
<input type="hidden" class="simpan"	name="targetId" 	value="targetUpdate"/>
<input type="hidden" class="simpan"	name="proses" 		value="update"/>
<input type="hidden" class="simpan" name="pel_no" 		value="<?php echo $pel_no; 	?>"/>
<div>
	<div class="span-9 left border">
		<div class="append-bottom span-3">No Pelanggan</div>
		<div class="append-bottom span-5">: <?php echo $pel_no;			?></div>
		<div class="append-bottom span-3">No Water Meter</div>
		<div class="append-bottom span-5">: <?php echo $pel_nowm;		?></div>
		<div class="append-bottom span-3">Kota Pelayanan</div>
		<div class="append-bottom span-5">: <?php echo $kp_ket;			?></div>
		<div class="append-bottom span-3">Nama</div>
		<div class="append-bottom span-5">: <?php echo $pel_nama;		?></div>
		<div class="append-bottom span-3">Alamat</div>
		<div class="append-bottom span-5">: <?php echo $pel_alamat;		?></div>
		<div class="append-bottom span-3">Tanggal Pasang</div>
		<div class="append-bottom span-5">: <?php echo $pel_tglpsg;		?></div>
		<div class="append-bottom span-3">Tanggal Pasang</div>
		<div class="append-bottom span-5">: <?php echo $pel_tglaktif;	?></div>
		<div class="append-bottom span-3">Golongan</div>
		<div class="append-bottom span-5">: <?php echo $gol_kode;		?></div>
		<div class="span-3">Rayon</div>
		<div class="span-5">: <?php echo $dkd_kd;			?></div>
	</div>
	<div class="span-12 left">
		<div class="append-bottom span-3">No Pelanggan</div>
		<div class="append-bottom span-8">
			: <?php echo $pel_no; ?>
		</div>
		<div class="append-bottom span-3">Nama</div>
		<div class="append-bottom span-8">
			: <?php echo $pel_nama; ?>
		</div>
		<div class="append-bottom span-3">Kota Pelayanan</div>
		<div class="append-bottom span-8">
			: <?php echo pilihan($data0,$parm0); ?>
		</div>
		<div class="append-bottom span-3">Alamat</div>
		<div class="append-bottom span-8">
			: <textarea class="simpan height-2 span-7" name="pel_alamat"><?php echo $pel_alamat; ?></textarea>
		</div>
		<div class="append-bottom span-3">Golongan</div>
		<div class="append-bottom span-8">
			: <?php echo pilihan($data1,$parm1); ?>
		</div>
		<div class="append-bottom span-3">Rayon</div>
		<div class="append-bottom span-8" id="targetRayon">
			: <?php echo pilihan($data2,$parm2); ?>
		</div>
		<div class="span-3">&nbsp;</div>
		<div class="span-8">&nbsp;
			<input type="button" value="Simpan" onclick="buka('simpan')"/>
		</div>
	</div>
</div>
</div>
</div>
<?php
	}
?>