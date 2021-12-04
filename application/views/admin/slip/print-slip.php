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

		.v-top {
			vertical-align: top;
		}
		.wrap{
			width: 100%;
			height: 100%;
			border: 2px solid #000;
			font-family: "sans-serif" !important;
		}
		hr{
			border: none;
			height: 3px;
			color: #000; /* old IE */
			background-color: #000; /* Modern Browsers */
		}
		table{
			font-size: 11px;
		}
	</style>
</head>

<body>
	<?php
		$this->load->model('PppSDM_m');
		foreach ($data as $key => $val): 
			$ppp = $this->PppSDM_m->json_dataPPP($val['periode'],$val['id_karyawan']);
			$lhk = 0;
			$lbu = 0;
			$llr = 0;
			$data_lembur = explode(",", $val['lembur']);
			if ($val['shift_outlet'] == 2) {
				$shift = 20;
			}else if($val['shift_outlet'] == 3){
				$shift = 26;
			}
			// foreach ($data_lembur as $k => $lembur){
			// 	$detail_lembur = explode("|", $lembur);
			// 	$id = trim($detail_lembur[0]);

			// 	$qry = $this->db->query("SELECT * FROM lembur where id_lembur = '$id'")->row();
			// 	if ($qry) {
			// 		if ($qry->id_lembur == 'LMBR202109030001') {
			// 			//Lembur HK
			// 			$lhk = $lhk + $qry->nilai;
			// 		}else if($qry->id_lembur == 'LMBR202109030002'){
			// 			// Lembur Backup
			// 			$lbu = $lbu + $val['g_pkk']/$shift;
			// 		}else if($qry->id_lembur == 'LMBR202109030003'){
			// 			// Lembur Libur
			// 			$llr = $llr + $qry->nilai;
			// 		}
			// 	}
			// }
			// $penghasilan = $val['g_pkk'] + $val['t_jbt'] + $ppp->kbl + $ppp->lhk + $ppp->lbu + $ppp->llr;
			// $potongan = $val['bpjs_kesehatan'] + $val['bpjs_tk'] + $val['bpjs_jp'] + $ppp->dpst + $ppp->bpdd + $val['dab'] + $val['diz'] + $data_default->t_urine + $ppp->lain + $ppp->sp;

			// $saldo = $penghasilan - $potongan;
			if ($val['shift_outlet'] == 1 || $val['shift_outlet'] == 2) {
				$hari_kerja = 20;
			}elseif ($val['shift_outlet'] == 3){
				$hari_kerja = 26;
			}else{
				$hari_kerja = 20;
			}
			$dab = ($val['g_pkk']/$hari_kerja) * $val['absen'];
			$penghasilan = $val['g_pkk'] + $val['t_jbt'] + $ppp->kbl + $ppp->lhk + $ppp->lbu + $ppp->llr;
			$potongan = $val['bpjs_kesehatan'] + $val['bpjs_tk'] + $val['bpjs_jp'] + $ppp->dpst + $ppp->bpdd + $dab + $val['diz'] + $data_default->t_urine + $ppp->lain + $ppp->sp;
			$saldo = $penghasilan - $potongan;
	?>
	<div class="wrap">
		<h4 class="tc">
			<?= $title; ?> <br>
			PT WIRA PRADANA MUKTI
			<hr>
		</h4>
		<table width="100%">
			<tr>
				<td width="250">Bulan/Tahun</td>
				<td width="1">:</td>
				<td><?= date('F Y', strtotime($val['periode'])) ?></td>
			</tr>
			<tr>
				<td width="250">Nama</td>
				<td width="1">:</td>
				<td><?= $val['nama'] ?></td>
			</tr>
			<tr>
				<td width="250">NIS</td>
				<td width="1">:</td>
				<td><?= $val['nis'] ?></td>
			</tr>
			<tr>
				<td width="250">Unit</td>
				<td width="1">:</td>
				<td><?= $val['nama_outlet'] ?></td>
			</tr>
			<tr>
				<td width="250">Nama</td>
				<td width="1">:</td>
				<td><?= $val['jabatan'] ?></td>
			</tr>
		</table>
		<table width="100%" style="margin-top: 30px;">
			<tr>
				<td width="5%">A.</td>
				<td width="60%">Gaji + Tunjangan Tetap</td>
				<td width="1%">Rp. </td>
				<td width="34%" align="right"><?= number_format($val['g_pkk'] + $val['t_jbt']) ?></td>
			</tr>
			<tr>
				<td width="5%">&nbsp;</td>
				<td width="60%">Lembur KBL</td>
				<td width="1%">Rp. </td>
				<td width="34%" align="right"><?= number_format($ppp->kbl) ?></td>
			</tr>
			<tr>
				<td width="5%">&nbsp;</td>
				<td width="60%">Lembur LHK</td>
				<td width="1%">Rp. </td>
				<td width="34%" align="right"><?= number_format($ppp->lhk) ?></td>
			</tr>
			<tr>
				<td width="5%">&nbsp;</td>
				<td width="60%">Lembur tgl merah</td>
				<td width="1%">Rp. </td>
				<td width="34%" align="right"><?= number_format($ppp->llr) ?></td>
			</tr>
			<tr>
				<td width="5%">&nbsp;</td>
				<td width="60%">Lembur Backup</td>
				<td width="1%">Rp. </td>
				<td width="34%" align="right"><?= number_format($ppp->lbu) ?></td>
			</tr>
			<tr>
				<td width="5%">&nbsp;</td>
				<td width="60%">&nbsp;</td>
				<td width="1%">&nbsp;</td>
				<td width="34%" align="right"><hr></td>
			</tr>
			<tr>
				<td width="5%">&nbsp;</td>
				<td width="60%" align="right"><b>Jumlah</b> &nbsp;&nbsp;</td>
				<td width="1%">Rp. </td>
				<?php 
					$jumlahA = $val['g_pkk'] + $val['t_jbt'] + $ppp->kbl + $ppp->lhk + $ppp->lbu + $ppp->llr;
				?>
				<td width="34%" align="right"><?= number_format($jumlahA) ?></td>
			</tr>
		</table>

		<table width="100%" style="margin-top: 30px;">
			<tr>
				<td width="5%">B.</td>
				<td width="60%" colspan="2"><b>Potongan</b></td>
			</tr>
			<tr>
				<td width="5%">&nbsp;</td>
				<td width="60%">BPJS Kesehatan</td>
				<td width="1%">Rp. </td>
				<td width="34%" align="right"><?= number_format($val['bpjs_kesehatan']) ?></td>
			</tr>
			<tr>
				<td width="5%">&nbsp;</td>
				<td width="60%">BPJS Ketenaga Kerjaan</td>
				<td width="1%">Rp. </td>
				<td width="34%" align="right"><?= number_format($val['bpjs_tk']) ?></td>
			</tr>
			<tr>
				<td width="5%">&nbsp;</td>
				<td width="60%">BPJS JP</td>
				<td width="1%">Rp. </td>
				<td width="34%" align="right"><?= number_format($val['bpjs_jp']) ?></td>
			</tr>
			<tr>
				<td width="5%">&nbsp;</td>
				<td width="60%">Biaya Deposito</td>
				<td width="1%">Rp. </td>
				<td width="34%" align="right"><?= number_format($ppp->dpst) ?></td>
			</tr>
			<tr>
				<td width="5%">&nbsp;</td>
				<td width="60%">Biaya Pendidikan</td>
				<td width="1%">Rp. </td>
				<td width="34%" align="right"><?= number_format($ppp->bpdd) ?></td>
			</tr>
			<?php 
				if ($val['shift_outlet'] == 1 || $val['shift_outlet'] == 2) {
					$hari_kerja = 20;
				}elseif ($val['shift_outlet'] == 3){
					$hari_kerja = 26;
				}else{
					$hari_kerja = 20;
				}
				$dab = ($val['g_pkk']/$hari_kerja) * $val['absen'];
			?>
			<tr>
				<td width="5%">&nbsp;</td>
				<td width="60%">Absen</td>
				<td width="1%"></td>
				<td width="34%" align="right"><?= number_format($dab) ?></td>
			</tr>
			<tr>
				<td width="5%">&nbsp;</td>
				<td width="60%">Denda Izin</td>
				<td width="1%">Rp. </td>
				<td width="34%" align="right"><?= number_format($ppp->diz) ?></td>
			</tr>
			<tr>
				<td width="5%">&nbsp;</td>
				<td width="60%">Tes Urin</td>
				<td width="1%">Rp. </td>
				<td width="34%" align="right"><?= number_format($ppp->urine) ?></td>
			</tr>
			<tr>
				<td width="5%">&nbsp;</td>
				<td width="60%">SP</td>
				<td width="1%">Rp. </td>
				<td width="34%" align="right"><?= number_format($ppp->sp) ?></td>
			</tr>
			<tr>
				<td width="5%">&nbsp;</td>
				<td width="60%">Lainnya</td>
				<td width="1%">Rp. </td>
				<td width="34%" align="right"><?= number_format($ppp->lain) ?></td>
			</tr>
			<tr>
				<td width="5%">&nbsp;</td>
				<td width="60%">&nbsp;</td>
				<td width="1%">&nbsp;</td>
				<td width="34%" align="right"><hr></td>
			</tr>
			<tr>
				<td width="5%">&nbsp;</td>
				<td width="60%" align="right"><b>Jumlah potong</b> &nbsp;&nbsp;</td>
				<td width="1%">Rp. </td>
				<?php 
					$jumlahB = $val['bpjs_kesehatan'] +$val['bpjs_tk'] +$val['bpjs_jp'] + $ppp->dpst + $ppp->bpdd + $dab + $ppp->diz + $ppp->urine + $ppp->lain + $ppp->sp;
				?>
				<td width="34%" align="right"><?= number_format($jumlahB) ?></td>
			</tr>
		</table>

		<table width="100%" style="margin:0 5px 0 5px;">
			<tr>
				<td width="5%">&nbsp;</td>
				<td width="60%" align="right"><b>Sisa gaji yang dibayarkan</b></td>
				<td width="1%"><b>Rp. </b></td>
				<td width="34%" align="right"><u><b><?= number_format($jumlahA - $jumlahB) ?></b></u></td>
			</tr>
		</table>

		<table width="100%" style="margin:0 5px 0 5px;">
			<tr>
				<td width="50%">Diterima oleh,</td>
				<td width="50%">Kasir,</td>
			</tr>
			<tr>
				<td colspan="2" height="30"></td>
			</tr>
			<tr>
				<td><?= $val['nama'] ?></td>
			</tr>
		</table>
	</div>
	<?php endforeach; ?>
</body>

</html>