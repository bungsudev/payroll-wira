<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="<?= base_url(); ?>assets/admin/images/favicon.png">
	<title><?= $title; ?></title>
	<style>
		.tc {
			text-align: center;
		}

		.table {
			border-collapse: collapse
		}

		.table,
		.table tr,
		.table td,
		.table th {
			border: 1px solid black;
			padding: 4px;
			font-size: 11px;
			height: 28px;
		}
		.v-top{
			vertical-align: top;
		}
	</style>
</head>
<body>
	<h3 class="tc"><?= $title; ?> <?= $data[0]['nama_outlet']; ?>, <?= date('d F Y') ?></h3>
    <div class="tc" style="font-size:10px;"><b>PT Wira Pradana Mukti</b></div class="tc">
    <div class="tc" style="font-size:10px;">Jl. Gatot Subroto No.325 A, Sei Sikambing D, Kec. Medan Petisah, Kota Medan, Sumatera Utara 20119</div class="tc">
    <hr>

	<div style="margin-top:30px;">
		<table class="table" style="font-size:12px;" width='100%'>
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>TTL</th>
                    <th>Alamat</th>
                    <th>Pendidikan</th>
                    <th>Gaji Pokok</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($data as $key => $val): 
                    $id_karyawan = $val['id_karyawan'];
                    $data_akhir = $this->db->query("SELECT * FROM karyawan_detail WHERE id_karyawan ='$id_karyawan'")->row();
                    (!empty($data_akhir->g_pkk))?$val['g_pkk'] = $data_akhir->g_pkk : '';
                ?>
                <tr>
                    <td><?= $val['nik'] ?></td>
                    <td><?= $val['nama'] ?></td>
                    <td><?= $val['tempat_lahir'].', '.date('d F Y', strtotime($val['tanggal_lahir'])) ?></td>
                    <td><?= $val['alamat'] ?></td>
                    <td><?= $val['pendidikan'] ?></td>
                    <td><?= $val['g_pkk'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
		</table>
	</div>
</body>

</html>