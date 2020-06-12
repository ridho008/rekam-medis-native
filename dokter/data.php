<?php include_once "../dashboard/header.php"; 
include_once "../config/koneksi.php";
?>

<div class="box">
	<h1>Dokter</h1>
	<h4>
		<small>Data Dokter</small>
		<div class="pull-right">
			<a href="" class="btn btn-default"><i class="glyphicon glyphicon-refresh"></i></a>
			<a href="add.php" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i>Tambah Dokter</a>
		</div>
	</h4>
	<form action="" method="post">
	<div class="table-responsive" style="margin-top: 50px;">
		<table class="table table-hover table-striped table-bordered" id="datatables">
			<thead>
				<tr>
					<th>
					<center>
						<input type="checkbox" id="select_all" value="">
					</center>
					</th>
					<th>No.</th>
					<th>Nama Poli</th>
					<th>Spesialis</th>
					<th>Alamat</th>
					<th>No.Telp</th>
					<th><i class="glyphicon glyphicon-cog"></i></th>
				</tr>
			</thead>
			<tbody>
			<?php  
			$no = 1;
			$sql_poli = mysqli_query($conn, "SELECT * FROM tb_dokter") or die(mysqli_error());
				while($data = mysqli_fetch_array($sql_poli)) { ?>
				<tr>
					<td align="center">
					<input type="checkbox" name="checked[]" class="check" value="<?= $data['id_dokter']; ?>">
					</td>
					<td><?= $no++; ?></td>
					<td><?= $data['nama_dokter']; ?></td>
					<td><?= $data['spesialis']; ?></td>
					<td><?= $data['alamat']; ?></td>
					<td><?= $data['no_telp']; ?></td>
					<td align="center">
						<a href="edit.php?id=<?= $data['id_dokter']; ?>" class="btn btn-warning"><i class="glyphicon glyphicon-cog"></i> Edit</a>
					</td>
				</tr>
			<?php
				}

			?>
			</tbody>
		</table>
	</div>
	</form>
	<div class="box pull-right">
		<button class="btn btn-danger" onclick="hapus()"><i class="glyphicon glyphicon-trash"></i> Hapus</button>
	</div>
</div>
<script src="<?= base_url(); ?>assets/js/jquery.js"></script>
<script>
	$(document).ready(function() {
    $('#datatables').DataTable( {
    	"columnDefs": [{
    		"searchable": false,
    		"orderable": false,
    		"targets": [0,1,6]
    		}
    	],
    	"order": [2, "asc"]
    });

		// menyeleksi semua checkbox
		$('#select_all').click(function() {
			if(this.checked) {
				$('.check').each(function() {
					this.checked = true;
				});
			} else {
				$('.check').each(function() {
					this.checked = false;
				});
			}
		});

		// menyeleksi salah satu, jika semua di ceklis otomatis akan terpilih select all
		$('.check').click(function() {
			if($('.check:checked').length == $('.check').length) {
				$('#select_all').prop('checked', true);
			} else {
				$('#select_all').prop('checked', false);
			}
		});



	});

		function hapus() {
			const conf = confirm('Yakin ?');
			if(conf) {
				document.proses.action = 'del.php';
				document.proses.submit();
			}
			
	}
</script>

<?php include_once "../dashboard/footer.php"; ?>