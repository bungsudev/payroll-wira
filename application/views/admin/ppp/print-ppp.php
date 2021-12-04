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
<?php 
function numberToRomanRepresentation($number) {
    $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
    $returnValue = '';
    while ($number > 0) {
        foreach ($map as $roman => $int) {
            if($number >= $int) {
                $number -= $int;
                $returnValue .= $roman;
                break;
            }
        }
    }
    return $returnValue;
}
?>
<body>
	<h4 class="tc"><?= $title; ?></h4>
	<table>
		<tr>
			<td>Nama Outlet</td>
			<td width="1">:</td>
			<td><?= $outlet->nama_outlet ?></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td><?= $outlet->alamat ?></td>
		</tr>
		<tr>
			<td>Kode Outlet</td>
			<td>:</td>
			<td><?= $outlet->id_outlet ?>/<?= numberToRomanRepresentation(date('m')) ?>/<?= date('Y') ?></td>
		</tr>
	</table>
	<table class="table" width="100%">
		<thead>
			<tr>
				<th rowspan="3">NO</th>
				<th rowspan="3">NAMA SDM</th>
				<th rowspan="3">JBT</th>
				<th rowspan="3">NIS</th>
				<th rowspan="3">B.SPKWT</th>
				<th colspan="6">PENGHASILAN</th>
				<th rowspan="3">JUMLAH</th>
				<th colspan="10" rowspan="2">POTONGAN</th>
				<th rowspan="3">JUMLAH</th>
				<th rowspan="3">SALDO</th>
			</tr>
			<tr>
				<th rowspan="2">G.PKK</th>
				<th rowspan="2">T.JBT</th>
				<!-- <th rowspan="2">T.TRANS</th> -->
				<!-- <th rowspan="2">T.OT</th> -->
				<th rowspan="2">KBL</th>
				<th rowspan="2">LHK</th>
				<th rowspan="2">LBU</th>
				<th width="50">LLR</th>
			</tr>
			<tr>
				<th>&nbsp;</th>
				<th width="50">BPJS KESEHATAN</th>
				<th width="50">BPJS KETENAGA KERJAAN</th>
				<th width="50">BPJS JP</th>
				<th>DPST</th>
				<th>BPDD/SRG</th>
				<th>DAB</th>
				<th>DIZ</th>
				<th>T.URINE</th>
				<th>LL</th>
				<th>SP</th>
			</tr>

		</thead>
		<tbody>
			<?php
				$this->load->model('PppSDM_m');

				$this->load->helper('daycount_helper');
				$ttl_gaji_pokok = 0;
				$ttl_penghasilan = 0;
				$ttl_bpjs_kesehatan = 0;
				$ttl_bpjs_tk = 0;
				$ttl_bpjs_jp = 0;
				$ttl_dab = 0;
				$ttl_potongan = 0;
				$ttl_saldo = 0;
				$ttl_t_jbt = 0;
				$ttl_kbl = 0;
				$ttl_lhk = 0;
				$ttl_lbu = 0;
				$ttl_llr = 0;
				$ttl_dpst = 0;
				$ttl_bpdd = 0;
				$ttl_diz = 0;
				$ttl_urine = 0;
				$ttl_lain = 0;
				$ttl_sp = 0;
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
					foreach ($data_lembur as $k => $lembur){
						$detail_lembur = explode("|", $lembur);
						$id = trim($detail_lembur[0]);

						$qry = $this->db->query("SELECT * FROM lembur where id_lembur = '$id'")->row();
						if ($qry) {
							if ($qry->id_lembur == 'LMBR202109030001') {
								//Lembur HK
								$lhk = $lhk + $qry->nilai;
							}else if($qry->id_lembur == 'LMBR202109030002'){
								// Lembur Backup
								$lbu = $lbu + $val['g_pkk']/$shift;
							}else if($qry->id_lembur == 'LMBR202109030003'){
								// Lembur Libur
								$llr = $llr + $qry->nilai;
							}
						}
					}
					// $data_default = $this->db-query("SELECT * FROM outlet where ")
					$dab = ($val['g_pkk']/20) * $val['absen'];
					$penghasilan = $val['g_pkk'] + $val['t_jbt'] + $ppp->kbl + $ppp->lhk + $ppp->lbu + $ppp->llr;
					$potongan = $val['bpjs_kesehatan'] +$val['bpjs_tk'] +$val['bpjs_jp'] + $ppp->dpst + $ppp->bpdd + $dab + $ppp->diz + $ppp->urine + $ppp->lain + $ppp->sp;
					$saldo = $penghasilan - $potongan;

					$ttl_gaji_pokok = $ttl_gaji_pokok + $val['g_pkk'];
					$ttl_t_jbt = $ttl_t_jbt + $val['t_jbt'];
					$ttl_kbl = $ttl_kbl + $ppp->kbl;
					$ttl_lhk = $ttl_lhk + $ppp->lhk;
					$ttl_lbu = $ttl_lbu + $ppp->lbu;
					$ttl_llr = $ttl_llr + $ppp->llr;
					$ttl_dpst = $ttl_dpst + $ppp->dpst;
					$ttl_bpdd = $ttl_bpdd + $ppp->bpdd;
					$ttl_diz = $ttl_diz + $ppp->diz;
					$ttl_urine = $ttl_urine + $ppp->urine;
					$ttl_lain = $ttl_lain + $ppp->lain;
					$ttl_sp = $ttl_sp + $ppp->sp;
					$ttl_penghasilan = $ttl_penghasilan + $penghasilan;
					$ttl_bpjs_kesehatan = $ttl_bpjs_kesehatan +$val['bpjs_kesehatan'];
					$ttl_bpjs_tk = $ttl_bpjs_tk +$val['bpjs_tk'];
					$ttl_bpjs_jp = $ttl_bpjs_jp +$val['bpjs_jp'];
					$ttl_dab = $ttl_dab + $dab;
					$ttl_potongan = $ttl_potongan + $potongan;
					$ttl_saldo = $ttl_saldo + $saldo;
				?>
			<tr>
				<td><?= $key + 1?></td>
				<td><?= $val['nama'] ?></td>
				<td><?= $val['jabatan'] ?></td>
				<td><?= $val['nis'] ?></td>
				<td><?= date("d-m-Y", strtotime($val['b_spkwt'])) ?></td>
				<td><?= number_format($val['g_pkk']) ?></td>
				<td><?= number_format($val['t_jbt']) ?></td>
				<td><?= number_format($ppp->kbl) ?></td>
				<td><?= number_format($ppp->lhk) ?></td>
				<td><?= number_format($ppp->lbu) ?></td>
				<td><?= number_format($ppp->llr) ?></td>
				<td><?= number_format($penghasilan) ?></td>
				
				<td><?= number_format($val['bpjs_kesehatan']) ?></td>
				<td><?= number_format($val['bpjs_tk']) ?></td>
				<td><?= number_format($val['bpjs_jp']) ?></td>
				<td><?= number_format($ppp->dpst) ?></td>
				<td><?= number_format($ppp->bpdd) ?></td>
				<td><?= number_format($dab) ?></td>
				<td><?= number_format($ppp->diz) ?></td>
				<td><?= number_format($ppp->urine) ?></td>
				<td><?= number_format($ppp->lain) ?></td>
				<td><?= number_format($ppp->sp) ?></td>
				<td><?= number_format($potongan) ?></td>
				<td><?= number_format($saldo) ?></td>
			</tr>
			<?php endforeach; ?>
			<tr>
				<td colspan="5" align="center">TOTAL</td>
				<td><?= number_format($ttl_gaji_pokok) ?></td>
				<td><?= number_format($ttl_t_jbt) ?></td>
				<td><?= number_format($ttl_kbl) ?></td>
				<td><?= number_format($ttl_lhk) ?></td>
				<td><?= number_format($ttl_lbu) ?></td>
				<td><?= number_format($ttl_llr) ?></td>
				<td><?= number_format($ttl_penghasilan) ?></td>
				
				<td><?= number_format($ttl_bpjs_kesehatan) ?></td>
				<td><?= number_format($ttl_bpjs_tk) ?></td>
				<td><?= number_format($ttl_bpjs_jp) ?></td>
				<td><?= number_format($ttl_dpst) ?></td>
				<td><?= number_format($ttl_bpdd) ?></td>
				<td><?= number_format($ttl_dab) ?></td>
				<td><?= number_format($ttl_diz) ?></td>
				<td><?= number_format($ttl_urine) ?></td>
				<td><?= number_format($ttl_lain) ?></td>
				<td><?= number_format($ttl_sp) ?></td>
				<td><?= number_format($ttl_potongan) ?></td>
				<td><?= number_format($ttl_saldo) ?></td>
			</tr>
		</tbody>
	</table>

	<!-- keterangan -->
	<div style="margin-top:30px;">
		<table style="font-size:12px;">
			<tr>
				<td colspan="3">Keterangan</td>
			</tr>
			<tr>
				<td class="v-top">
					<table>
						<tr>
							<td width="80">B.SPKWT</td>
							<td>BERAKHIR SPKWT</td>
						</tr>
						<tr>
							<td width="80">G.PKK</td>
							<td>GAJI POKOK</td>
						</tr>
						<tr>
							<td width="80">T.JBT</td>
							<td>TUNJANGAN JABATAN</td>
						</tr>
						<tr>
							<td width="80">T.TRANS</td>
							<td>TUNJANGAN TRANSPORTASI</td>
						</tr>
						<tr>
							<td width="80">T.OT</td>
							<td>TUNJANGAN OUTLET</td>
						</tr>
						<tr>
							<td width="80">LHK</td>
							<td>LEMBUR HK</td>
						</tr>
						<tr>
							<td width="80">LBU</td>
							<td>LEMBUR BACKUP</td>
						</tr>
						<tr>
							<td width="80">LLR</td>
							<td>LEMBUR LIBUR</td>
						</tr>
					</table>
				</td>
				<td width="75"></td>
				<td class="v-top">
					<table>
						<tr>
							<td width="80">JST</td>
							<td>JAMSOSTEK</td>
						</tr>
						<tr>
							<td width="80">DPST</td>
							<td>DEPOSITO PERLENGKAPAN</td>
						</tr>
						<tr>
							<td width="80">SRG</td>
							<td>SERAGAM</td>
						</tr>
						<tr>
							<td width="80">BPDD/SRG</td>
							<td>BIAYA PENDIDIKAN</td>
						</tr>
						<tr>
							<td width="80">DAB</td>
							<td>DENDA ABSEN</td>
						</tr>
						<tr>
							<td width="80">DIZ</td>
							<td>DENDA IZIN</td>
						</tr>
						<tr>
							<td width="80">DS</td>
							<td>DENDA SAKIT</td>
						</tr>
						<tr>
							<td width="80">LL</td>
							<td>LAIN-LAIN</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>

	<div style="margin-top:30px;">
		<table style="font-size:12px;" width='100%'>
			<tr>
				<td>
					Diperiksa Oleh, <br>
					Ke Pembukuan
				</td>
				<td>
					Dibuat Oleh, <br>
					Adm Penggajian
				</td>
				<td>
					Diketahui Oleh, <br>
					Direktur
				</td>
			</tr>
			<tr>
				<td height="100px">&nbsp;</td>
				<td height="100px">&nbsp;</td>
				<td height="100px">&nbsp;</td>
			</tr>
			<tr>
				<td>(LISA)</td>
				<td>(ELISA)</td>
				<td>(ANDRIASAN S.S,Mn,MM)</td>
			</tr>
		</table>
	</div>
</body>

</html>