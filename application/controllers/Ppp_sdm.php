<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ppp_sdm extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username')){
			$this->session->set_flashdata('message', 'Anda harus login terlebih dahulu.');
			redirect('auth');
		}
		$this->load->library('excel');
		$this->load->model('Logs_m');
		$this->load->model('PppSDM_m');
		$this->load->model('Outlet_m');
	}

	public function index(){
		$data['title'] = 'Perhitungan Penghasilan dan Pengeluaran SDM';
		$data['content'] = "admin/ppp/page-ppp";
		$data['outlet'] = $this->Outlet_m->data_outlet();
		$data['data_default'] = $this->PppSDM_m->dataDefault();
		$this->load->view('admin/layout/layout',$data);
	}
	public function  printtes($id_outlet, $periode){
		$data['title'] = 'Perhitungan Penghasilan dan Pengeluaran SDM';
		$data['data'] = $this->dataLaporanPPP($id_outlet, $periode);
		$data['data_default'] = $this->PppSDM_m->dataDefault();
		$this->load->view('admin/ppp/print-ppp',$data);
	}

	public function print($id_outlet, $periode){
		require_once './vendor/autoload.php';
		// $mpdf = new \Mpdf\Mpdf(['format' => 'Legal']);
		$mpdf= new \Mpdf\Mpdf(['mode' => 'utf-8','format' => 'Legal-L','margin_left' => 10,'margin_right' => 10,'margin_top' => 8,'margin_bottom' => 15,'margin_header' => 0,'margin_footer' => 0]); 
		$data['title'] = 'Perhitungan Penghasilan dan Pengeluaran SDM';
		$data['data'] = $this->dataLaporanPPP($id_outlet, $periode);
		$data['outlet'] = $this->PppSDM_m->data_outlet_detail_wParam($id_outlet);
		$data['data_default'] = $this->PppSDM_m->dataDefault();
		$html = $this->load->view('admin/ppp/print-ppp',$data,true);
		$mpdf->SetTitle('Perhitungan Penghasilan dan Pengeluaran SDM - '.$id_outlet);
		$mpdf->WriteHTML($html);
		$mpdf->Output('Perhitungan Penghasilan dan Pengeluaran SDM ('.$periode.') - '.$id_outlet.'.pdf', 'I');
    }

	public function dataLaporanPPP($id_outlet, $periode){
		// $id_outlet = 'OUTL202108260001';
		// $periode = '2021-09';
		$data_absen = $this->db->query("SELECT a.*,b.nama, b.jabatan,b.nis, c.* FROM absensi a LEFT JOIN karyawan b ON a.id_karyawan = b.id_karyawan LEFT JOIN karyawan_detail c ON a.id_karyawan = c.id_karyawan WHERE a.id_outlet = '$id_outlet' AND a.periode = '$periode' ORDER BY b.nama")->result_array();
		
		//ambil id_lembur
		$id_lembur_arr = [];
		$sett_default = $this->db->query("SELECT * FROM outlet WHERE id_outlet ='$id_outlet'")->row();
		foreach ($data_absen as $key => $val) {		
			// echo $data_absen[$key]['g_pkk']; die();	
			(empty($data_absen[$key]['shift_outlet']))?$data_absen[$key]['shift_outlet'] = $sett_default->shift_outlet : '';
			(empty($data_absen[$key]['b_spkwt']))?$data_absen[$key]['b_spkwt'] = $sett_default->b_spkwt : '';
			(empty($data_absen[$key]['g_pkk']))?$data_absen[$key]['g_pkk'] = $sett_default->g_pkk : '';
			(empty($data_absen[$key]['t_jbt']))?$data_absen[$key]['t_jbt'] = $sett_default->t_jbt : '';
			(empty($data_absen[$key]['t_trans']))?$data_absen[$key]['t_trans'] = $sett_default->t_trans : '';
			(empty($data_absen[$key]['t_ot']))?$data_absen[$key]['t_ot'] = $sett_default->t_ot : '';
			(empty($data_absen[$key]['lhk']))?$data_absen[$key]['lhk'] = $sett_default->lhk : '';
			(empty($data_absen[$key]['lbu']))?$data_absen[$key]['lbu'] = $sett_default->lbu : '';
			(empty($data_absen[$key]['llr']))?$data_absen[$key]['llr'] = $sett_default->llr : '';
			(empty($data_absen[$key]['jst']))?$data_absen[$key]['jst'] = $sett_default->jst : '';
			(empty($data_absen[$key]['dpst']))?$data_absen[$key]['dpst'] = $sett_default->dpst : '';
			(empty($data_absen[$key]['srg']))?$data_absen[$key]['srg'] = $sett_default->srg : '';
			(empty($data_absen[$key]['bpdd']))?$data_absen[$key]['bpdd'] = $sett_default->bpdd : '';
			(empty($data_absen[$key]['dab']))?$data_absen[$key]['dab'] = $sett_default->dab : '';
			(empty($data_absen[$key]['diz']))?$data_absen[$key]['diz'] = $sett_default->diz : '';
			(empty($data_absen[$key]['dis']))?$data_absen[$key]['dis'] = $sett_default->dis : '';
			(empty($data_absen[$key]['lain']))?$data_absen[$key]['lain'] = $sett_default->lain : '';

			// $lhk = 0;
			// $lbu = 0;
			// $llr = 0;
			// $data_lembur = explode(",", $val['lembur']);
			// foreach ($data_lembur as $k => $lembur){
			// 	$detail_lembur = explode("|", $lembur);
			// 	$id = trim($detail_lembur[0]);
			// 	if ($data_absen[$key]['shift_outlet'] == 2) {
			// 		$shift = 20;
			// 	}else if($data_absen[$key]['shift_outlet'] == 3){
			// 		$shift = 26;
			// 	}
			// 	//menentukan lembur lhk lbu llr
			// 	$lembur = $this->db->query("SELECT * FROM lembur WHERE id_lembur='$id'")->row();
			// 	if (!empty($sel_lembur)) {
			// 		if ($sel_lembur->id_lembur == 'LMBR202109030001') {
			// 			//Lembur HK
			// 			$lhk = $lhk + $sel_lembur->nilai;
			// 		}else if($sel_lembur->id_lembur == 'LMBR202109030002'){
			// 			// Lembur Backup
			// 			$lbu = $lbu + ($data_absen[$key]['g_pkk']/$shift);
			// 		}else if($sel_lembur->id_lembur == 'LMBR202109030003'){
			// 			// Lembur Libur
			// 			$llr = $llr + $lembur->nilai;
			// 		}
			// 	}

			// 	$data_absen[$key]['lhk'] = $lhk;
			// 	$data_absen[$key]['lbu'] = $lbu;
			// 	$data_absen[$key]['llr'] = $llr;
			// }
		}

		// echo json_encode($data_absen);
		return $data_absen;
	}


	public function json_dataPPP($periode, $id_karyawan){
		echo json_encode($this->PppSDM_m->json_dataPPP($periode, $id_karyawan));
	}

	public function json_dataLaporanPPP(){
		echo json_encode($this->dataLaporanPPP());
	}

	public function get_karyawanOutlet(){
		echo json_encode($this->PppSDM_m->get_karyawanOutlet());
	}

	public function get_data(){
		echo json_encode($this->PppSDM_m->data_pppsdm());
	}

	public function total_karyawan_pppsdm($id){
		echo json_encode($this->PppSDM_m->total_karyawan_pppsdm($id));
	}
	
	public function get_data_detail(){
		echo json_encode($this->PppSDM_m->data_pppsdm_detail());
	}

	public function getIDPppSDM(){
		echo json_encode($this->PppSDM_m->getIDPppSDM());
	}

	function simpan_pppsdm($act, $id = ''){
		if ($act == 'Tambah') {
				echo json_encode([
					'res' => $this->PppSDM_m->simpan_pppsdm(), 
					'msg' =>  'Data di tambahkan'
				]);
		}else if ($act == 'Edit'){
			echo json_encode([
				'res' => $this->PppSDM_m->edit_pppsdm($id), 
				'msg' =>  'Data telah di edit'
			]);
		}else{
			echo json_encode([
				'res' => false, 
				'msg' =>  'Error'
			]);
		}
	}

	//update detail before print 
	
	public function update_detail_cek(){
		$this->Logs_m->save('Update PPP Karyawan => nik : '.$_POST['nik']);
		echo json_encode([
			'res' => $this->PppSDM_m->update_detail_cek(),
			'msg' =>  'Data telah di edit'
		]);
	}

	public function hapus_pppsdm(){
		$this->Logs_m->save('hapus Karyawan => id : '.$_POST['id']);
		echo json_encode($this->PppSDM_m->hapus_pppsdm());
	}

	function import_pppsdm()
    {
        if (isset($_FILES["uploadFile"]["name"])) {
            $path = $_FILES["uploadFile"]["tmp_name"];
            // get data from table where the date is tracking date, if exist delete the data
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $nik = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $nama_pppsdm = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $t_ot = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                  
                    if ($nik != ''  ) {
                        $data = [ 
                            "nama_pppsdm" => $nama_pppsdm,
                            "t_ot" => $t_ot,
							"created" => date('Y-m-d H:i:s'),
                        ];
                        $this->db->insert("pppsdm",$data);
                    }
                }
            }
			$this->Logs_m->save('Import PppSDM => file : '. $_FILES["uploadFile"]["name"]);
			redirect(base_url().'pppsdm');
        }
        
        
    }
}
