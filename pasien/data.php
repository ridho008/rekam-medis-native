<?php include_once "../dashboard/header.php"; 
include_once "../config/koneksi.php";
?>

<div class="box">
	<h1>Pasien</h1>
	<h4>
		<small>Data Pasien</small>
		<div class="pull-right">
			<a href="" class="btn btn-default"><i class="glyphicon glyphicon-refresh"></i></a>
			<a href="add.php" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i>Tambah Pasien</a>
			<a href="import.php" class="btn btn-info"><i class="glyphicon glyphicon-import"></i>Import</a>
		</div>
	</h4>
	<div class="table-responsive" style="margin-top: 70px;">
		<table class="table table-hover table-striped table-bordered" id="pasien">
			<thead>
				<tr>
					<th>Nomor Identitas</th>
					<th>Nama Pasien</th>
					<th>Jenis Kelamin</th>
					<th>Alamat</th>
					<th>Telepon</th>
					<th><i class="glyphicon glyphicon-cog"></i></th>
				</tr>
			</thead>
		</table>
	</div>
<script src="<?= base_url(); ?>assets/js/jquery.js"></script>
	<script>
		$(document).ready(function() {
		    $('#pasien').DataTable( {
		        "processing": true,
		        "serverSide": true,
		        "ajax": "pasien_data.php",
		        // scrollY: '250px',
		        dom: 	'lBfrtip',
		        buttons: [
		        	{
		        		extend: 'pdf',
		        		orientation: 'potrait',
		        		pageSize: 'legal',
		        		title: 'Data Pasien',
		        		download: 'open'
		        	},
		        	'csv', 'excel', 'print', 'copy'
		        ],
		        columnDefs: [
		        	{
		        		"searchable": false,
		        		"orderable": false,
		        		"targets": 5,
		        		"render": function(data, type, row) {
		        			const btn = "<center><a href=\"edit.php?id="+ data +"\" class=\"btn btn-info\"><i class=\"glyphicon glyphicon-edit\"></i></a><a href=\"del.php?id="+ data +"\" style=\"margin-left:8px;\" class=\"btn btn-danger\"><i class=\"glyphicon glyphicon-trash\" onclick=\"return confirm('Yakin?')\"></i></a></center>";
		        			return btn;
		        		}
		        	}
		        ]
		    } );
		} );
	</script>
</div>
<?php include_once "../dashboard/footer.php"; ?>