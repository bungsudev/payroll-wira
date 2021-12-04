<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slip extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username')){
			$this->session->set_flashdata('message', 'Anda harus login terlebih dahulu.');
			redirect('auth');
		}
		$this->load->library('excel');
		$this->load->model('Logs_m');
		$this->load->model('Absensi_m');
		$this->load->model('Lembur_m');
		$this->load->model('Outlet_m');
		$this->load->model('PppSDM_m');
	}

	public function index(){
		$data['title'] = 'Slip Gaji';
		$data['content'] = "admin/slip/page-slip";
		$data['outlet'] = $this->Outlet_m->data_outlet();
		$this->load->view('admin/layout/layout',$data);
	}

	public function print($id_outlet, $periode, $id_karyawan = ''){
		require_once './vendor/autoload.php';
		$mpdf= new \Mpdf\Mpdf(['mode' => 'utf-8','format' => [140, 200],'margin_left' => 2,'margin_right' => 2,'margin_top' => 2,'margin_bottom' => 2,'margin_header' => 0,'margin_footer' => 0]); 
		$data['title'] = 'Slip Gaji';
		$data['data'] = $this->dataLaporanPPP($id_outlet, $periode, $id_karyawan);

		// echo json_encode($data['data']); die();

		$data['data_default'] = $this->PppSDM_m->dataDefault();
		$html = $this->load->view('admin/slip/print-slip',$data,true);
		$mpdf->SetTitle('Slip Gaji - '.$id_outlet);
		$mpdf->WriteHTML($html);
		$mpdf->Output('Slip Gaji ('.$periode.') - '.$id_outlet.'.pdf', 'I');
    }

	public function dataLaporanPPP($id_outlet, $periode, $id_karyawan = ''){
		// $id_outlet = 'OUTL202108260001';
		// $periode = '2021-09';
		(empty($id_karyawan))? $qry = "" : $qry = " AND c.id_karyawan = '".$id_karyawan."'";
		$data_absen = $this->db->query("SELECT a.*,b.nama, b.jabatan,b.nis, c.*, d.nama_outlet 
		FROM absensi a 
		LEFT JOIN karyawan b ON a.id_karyawan = b.id_karyawan 
		LEFT JOIN karyawan_detail c ON a.id_karyawan = c.id_karyawan 
		LEFT JOIN outlet d ON a.id_outlet = d.id_outlet 
			WHERE a.id_outlet = '$id_outlet' AND a.periode = '$periode' 
			$qry
			ORDER BY b.nama")->result_array();

		//ambil id_lembur
		$id_lembur_arr = [];
		$sett_default = $this->db->query("SELECT * FROM outlet WHERE id_outlet ='$id_outlet'")->row();
		foreach ($data_absen as $key => $val) {		
			// echo $data_absen[$key]['g_pkk']; die();	
			(empty($data_absen[$key]['shift_outlet']))?$data_absen[$key]['shift_outlet'] = $sett_default->shift_outlet : '';
			(empty($data_absen[$key]['b_spkwt']))?$data_absen[$key]['b_spkwt'] = $sett_default->b_spkwt : '';
			(empty($data_absen[$key]['g_pkk']))?$data_absen[$key]['g_pkk'] = $sett_default->g_pkk : '';
			(empty($data_absen[$key]['t_jbt']))?$data_absen[$key]['t_jbt'] = $sett_default->t_jbt : '';
			// (empty($data_absen[$key]['t_trans']))?$data_absen[$key]['t_trans'] = $sett_default->t_trans : '';
			// (empty($data_absen[$key]['t_ot']))?$data_absen[$key]['t_ot'] = $sett_default->t_ot : '';
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
			(empty($data_absen[$key]['bpjs_kesehatan']))?$data_absen[$key]['bpjs_kesehatan'] = $sett_default->bpjs_kesehatan : '';
			(empty($data_absen[$key]['bpjs_tk']))?$data_absen[$key]['bpjs_tk'] = $sett_default->bpjs_tk : '';
			(empty($data_absen[$key]['bpjs_jp']))?$data_absen[$key]['bpjs_jp'] = $sett_default->bpjs_jp : '';
		}
		return $data_absen;
	}

	public function print_all($id_outlet, $periode){
		require_once './vendor/autoload.php';
		$mpdf= new \Mpdf\Mpdf(['mode' => 'utf-8','format' => [140, 200],'margin_left' => 2,'margin_right' => 2,'margin_top' => 2,'margin_bottom' => 2,'margin_header' => 0,'margin_footer' => 0]); 
		$data['title'] = 'Slip Gaji';
		$data['data'] = $this->dataLaporanPPPAll($id_outlet, $periode);

		// echo json_encode($data['data']); die();

		$data['data_default'] = $this->PppSDM_m->dataDefault();
		$html = $this->load->view('admin/slip/print-slip-all',$data,true);
		$mpdf->SetTitle('Slip Gaji - '.$id_outlet);
		$mpdf->WriteHTML($html);
		$mpdf->Output('Slip Gaji ('.$periode.') - '.$id_outlet.'.pdf', 'I');
    }

	public function dataLaporanPPPAll($id_outlet, $periode){
		// $id_outlet = 'OUTL202108260001';
		// $periode = '2021-09';
		$data_absen = $this->db->query("SELECT a.*,b.nama, b.jabatan,b.nis, c.*, d.nama_outlet 
		FROM absensi a 
		LEFT JOIN karyawan b ON a.id_karyawan = b.id_karyawan 
		LEFT JOIN karyawan_detail c ON a.id_karyawan = c.id_karyawan 
		LEFT JOIN outlet d ON a.id_outlet = d.id_outlet 
			WHERE a.id_outlet = '$id_outlet' AND a.periode = '$periode' ORDER BY b.nama")->result_array();
		
		//ambil id_lembur
		$id_lembur_arr = [];
		$sett_default = $this->db->query("SELECT * FROM outlet WHERE id_outlet ='$id_outlet'")->row();
		foreach ($data_absen as $key => $val) {		
			// echo $data_absen[$key]['g_pkk']; die();	
			(empty($data_absen[$key]['shift_outlet']))?$data_absen[$key]['shift_outlet'] = $sett_default->shift_outlet : '';
			(empty($data_absen[$key]['b_spkwt']))?$data_absen[$key]['b_spkwt'] = $sett_default->b_spkwt : '';
			(empty($data_absen[$key]['g_pkk']))?$data_absen[$key]['g_pkk'] = $sett_default->g_pkk : '';
			(empty($data_absen[$key]['t_jbt']))?$data_absen[$key]['t_jbt'] = $sett_default->t_jbt : '';
			// (empty($data_absen[$key]['t_trans']))?$data_absen[$key]['t_trans'] = $sett_default->t_trans : '';
			// (empty($data_absen[$key]['t_ot']))?$data_absen[$key]['t_ot'] = $sett_default->t_ot : '';
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
			(empty($data_absen[$key]['bpjs_kesehatan']))?$data_absen[$key]['bpjs_kesehatan'] = $sett_default->bpjs_kesehatan : '';
			(empty($data_absen[$key]['bpjs_tk']))?$data_absen[$key]['bpjs_tk'] = $sett_default->bpjs_tk : '';
			(empty($data_absen[$key]['bpjs_jp']))?$data_absen[$key]['bpjs_jp'] = $sett_default->bpjs_jp : '';
		}

		// echo json_encode($data_absen);
		return $data_absen;
	}

	public function test(){
		echo json_encode($this->PppSDM_m->dataDefault());
	}

	public function get_data(){
		echo json_encode($this->Absensi_m->data_absensi());
	}

	public function getAbsensiDtl(){
		echo json_encode($this->Absensi_m->getAbsensiDtl());
	}

	public function get_karyawanOutlet(){
		echo json_encode($this->Absensi_m->get_karyawanOutlet());
	}

	public function total_karyawan_absensi($id){
		echo json_encode($this->Absensi_m->total_karyawan_absensi($id));
	}
	
	public function get_data_detail(){
		echo json_encode($this->Absensi_m->data_absensi_detail());
	}

	public function getIDAbsensi(){
		echo json_encode($this->Absensi_m->getIDAbsensi());
	}

	//get data lembur
	public function getLemburAktif(){
		echo json_encode($this->Lembur_m->getLemburAktif());
	}
	//get data lembur

	function simpan_absensi($act, $id = ''){
		if ($act == 'Tambah') {
				echo json_encode([
					'res' => $this->Absensi_m->simpan_absensi(), 
					'msg' =>  'Data di tambahkan'
				]);
				$this->Logs_m->save('tambah Absensi => id_karyawan : '.$_POST['id_karyawan']);
		}else if ($act == 'Edit'){
			echo json_encode([
				'res' => $this->Absensi_m->edit_absensi($id), 
				'msg' =>  'Data telah di edit'
			]);
			$this->Logs_m->save('edit Absensi => id_karyawan : '.$_POST['id_karyawan']);
		}else{
			echo json_encode([
				'res' => false, 
				'msg' =>  'Error'
			]);
		}
	}

	public function hapus_absensi(){
		$this->Logs_m->save('hapus Absensi => id : '.$_POST['id']);
		echo json_encode($this->Absensi_m->hapus_absensi());
	}

	function import_absensi()
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
                    $nama_absensi = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $t_ot = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                  
                    if ($nik != ''  ) {
                        $data = [ 
                            "nama_absensi" => $nama_absensi,
                            "t_ot" => $t_ot,
							"created" => date('Y-m-d H:i:s'),
                        ];
                        $this->db->insert("absensi",$data);
                    }
                }
            }
			$this->Logs_m->save('Import Absensi => file : '. $_FILES["uploadFile"]["name"]);
			redirect(base_url().'absensi');
        }
        
        
    }
}
