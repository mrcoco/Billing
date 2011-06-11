<div id="peringatan">
<div id="pesan">
<?php
	$kelas = $_POST['kelas'];
	echo $_POST['pesan']."<br/>";
?>
	<input type="button" value="Proses" onclick="buka('<?=$kelas?>')"/>
	<input type="button" value="Tutup"  onclick="tutupPesan()"/>
</div>
</div>