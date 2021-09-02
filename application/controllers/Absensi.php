<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {

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
	}

	public function index(){
		$data['title'] = 'Absensi';
		$data['content'] = "admin/absensi/page-absensi";
		$data['outlet'] = $this->Outlet_m->data_outlet();
		$this->load->view('admin/layout/layout',$data);
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
