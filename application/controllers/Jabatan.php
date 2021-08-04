<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username')){
			$this->session->set_flashdata('message', 'Anda harus login terlebih dahulu.');
			redirect('auth');
		}
		$this->load->library('excel');
		$this->load->model('Logs_m');
		$this->load->model('Jabatan_m');
	}

	public function index(){
		$data['title'] = 'Jabatan';
		$data['content'] = "admin/jabatan/page-jabatan";
		$this->load->view('admin/layout/layout',$data);
	}

	public function get_data(){
		echo json_encode($this->Jabatan_m->data_jabatan());
	}
	
	public function get_data_detail(){
		echo json_encode($this->Jabatan_m->data_jabatan_detail());
	}

	function simpan_jabatan($act, $id = ''){
		if ($act == 'Tambah') {
				echo json_encode([
					'res' => $this->Jabatan_m->simpan_jabatan(), 
					'msg' =>  'Data di tambahkan'
				]);
		}else if ($act == 'Edit'){
			echo json_encode([
				'res' => $this->Jabatan_m->edit_jabatan($id), 
				'msg' =>  'Data telah di edit'
			]);
		}else{
			echo json_encode([
				'res' => false, 
				'msg' =>  'Error'
			]);
		}
	}

	public function hapus_jabatan(){
		$this->Logs_m->save('hapus Karyawan => id : '.$_POST['id']);
		echo json_encode($this->Jabatan_m->hapus_jabatan());
	}

	function import_jabatan()
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
                    $nama = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $jekel = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $status = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $tempat_lahir = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $tanggal_lahir = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $agama = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $tinggi = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $berat = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $suku = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $alamat = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                    $handphone = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                    $pendidikan = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                    $pengalaman = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                    $pelatihan = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                  
                    if ($nik != ''  ) {
                        $data = [ 
                            "nik" => $nik,
							"nama" => $nama,
							"status" => $status,
							"tempat_lahir" => $tempat_lahir,
							"tanggal_lahir" => $tanggal_lahir,
							"agama" => $agama,
							"suku" => $suku,
							"handphone" => $handphone,
							"tinggi" => $tinggi,
							"berat" => $berat,
							"alamat" => $alamat,
							"pendidikan" => $pendidikan,
							"pengalaman" => $pengalaman,
							"pelatihan" => $pelatihan,
							"foto" => 'default.png',
							"created" => date('Y-m-d H:i:s'),
                        ];
                        $this->db->insert("jabatan",$data);
                    }
                }
            }
			$this->Logs_m->save('Import Karyawan => file : '. $_FILES["uploadFile"]["name"]);
			redirect(base_url().'jabatan');
        }
        
        
    }
}
