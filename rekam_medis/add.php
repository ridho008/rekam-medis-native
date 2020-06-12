<?php 
include_once "../dashboard/header.php"; ?>

<div class="box">
	<h1>Data Rekam Medis</h1>
	<h4>
		<small>Data Rekam Medis</small>
		<div class="pull-right">
			<a href="data.php" class="btn btn-success"><i class="glyphicon glyphicon-chevron-left"></i>Kembali</a>
		</div>
	</h4>
</div>

<div class="row">
	<div class="col-lg-6 col-lg-offset-3">
		<form action="proses.php" method="post">
			<div class="form-group">
				<label for="pasien">Pasien</label>
				<select name="pasien" id="pasien" class="form-control" required>
					<option value="">-- Pilih --</option>
					<?php 
					$sql_pasien = mysqli_query($conn, "SELECT * FROM tb_pasien") or die(mysqli_error($conn));
					while($data_pasien = mysqli_fetch_assoc($sql_pasien)) {
						echo '<option value="'. $data_pasien['id_pasien'] .'">'. $data_pasien['nama_pasien'] .'</option>';
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="keluhan">Keluhan</label><br>
				<textarea name="keluhan" id="keluhan" cols="86" rows="5" required></textarea>
			</div>
			<div class="form-group">
				<label for="dokter">Dokter</label>
				<select name="dokter" id="dokter" class="form-control" required>
					<option value="">-- Pilih --</option>
					<?php 
					$sql_dokter = mysqli_query($conn, "SELECT * FROM tb_dokter") or die(mysqli_error($conn));
					while($data_dokter = mysqli_fetch_assoc($sql_dokter)) {
						echo '<option value="'. $data_dokter['id_dokter'] .'">'. $data_dokter['nama_dokter'] .'</option>';
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="diagnosa">Diagnosa</label><br>
				<textarea name="diagnosa" id="diagnosa" cols="86" rows="5" required></textarea>
			</div>
			<div class="form-group">
				<label for="poli">Poliklinik</label>
				<select name="poli" id="poli" class="form-control" required>
					<option value="">-- Pilih --</option>
					<?php 
					$sql_poli = mysqli_query($conn, "SELECT * FROM tb_poliklinik ORDER BY nama_poli DESC") or die(mysqli_error($conn));
					while($data_poli = mysqli_fetch_assoc($sql_poli)) {
						echo '<option value="'. $data_poli['id_poli'] .'">'. $data_poli['nama_poli'] .'</option>';
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="obat">Obat</label>
				<select multiple size="6" name="obat[]" id="obat" class="form-control" required>
					<?php 
					$sql_obat = mysqli_query($conn, "SELECT * FROM tb_obat") or die(mysqli_error($conn));
					while($data_obat = mysqli_fetch_assoc($sql_obat)) {
						echo '<option value="'. $data_obat['id_obat'] .'">'. $data_obat['nama_obat'] .'</option>';
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="tgl">Tanggal Periksa</label>
				<input type="date" name="tgl" id="tgl" class="form-control" required value="<?= date('Y-m-d'); ?>">
			</div>
			<div class="form-group pull-right">
				<button type="submit" name="add" class="btn btn-primary">Tambah Dokter</button>
				<button type="reset" name="reset" class="btn btn-secondary">Reset</button>
			</div>
		</form>
		<script>
			CKEDITOR.replace( 'keluhan' );
		</script>
	</div>
</div>

<?php include_once "../dashboard/footer.php"; ?>