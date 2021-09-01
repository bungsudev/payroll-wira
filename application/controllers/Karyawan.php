<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username')){
			$this->session->set_flashdata('message', 'Anda harus login terlebih dahulu.');
			redirect('auth');
		}
		$this->load->library('excel');
		$this->load->model('Logs_m');
		$this->load->model('Karyawan_m');
		$this->load->model('Jabatan_m');
	}

	public function index(){
		$data['title'] = 'Data Karyawan';
		$data['content'] = "admin/karyawan/page-karyawan";
		$data['jabatan'] = $this->Jabatan_m->data_jabatan();
		$this->load->view('admin/layout/layout',$data);
	}

	public function get_data(){
		echo json_encode($this->Karyawan_m->data_karyawan());
	}
	
	public function get_data_detail(){
		echo json_encode($this->Karyawan_m->data_karyawan_detail());
	}

	function simpan_karyawan($act, $id = ''){
		$error = '';
        $config['upload_path']="./assets/img/karyawan";
        $config['allowed_types']='jpg|png|jpeg|JPEG';
		$config['max_size']=500;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);
		if ($act == 'Tambah') {
			if ( ! $this->upload->do_upload('gambar_karyawan')){
				$error = $this->upload->display_errors();
				echo json_encode([
					'res' => false,
					'msg' => $error
				]);
			}else{
				$data = $this->upload->data();
				$this->Logs_m->save('Tambah Karyawan => nik : '.$_POST['nik']);
				echo json_encode([
					'res' => $this->Karyawan_m->simpan_karyawan($data['file_name']), 
					'msg' =>  'Data di tambahkan'
				]);
			}
		}else if ($act == 'Edit' && !empty($_FILES['gambar_karyawan']['name'])){
			if ( ! $this->upload->do_upload('gambar_karyawan')){
				$error = $this->upload->display_errors();
				echo json_encode([
					'res' => false,
					'msg' => $error
				]);
			}else{
				$data = $this->upload->data();
				$this->Logs_m->save('Edit Karyawan => nik : '.$_POST['nik']);
				echo json_encode([
					'res' => $this->Karyawan_m->edit_karyawan($data['file_name'], $id), 
					'msg' =>  'Data telah di edit'
				]);
			}
		}else if ($act == 'Edit' && empty($_FILES['gambar_karyawan']['name'])){
			$this->Logs_m->save('Edit Karyawan => nik : '.$_POST['nik']);
			echo json_encode([
				'res' => $this->Karyawan_m->edit_karyawan(NULL, $id), 
				'msg' =>  'Data telah di edit'
			]);
		}else{
			echo json_encode([
				'res' => false, 
				'msg' =>  'Error'
			]);
		}
		($error)?$this->Logs_m->save('Karyawan => error : '. $error): '';
	}

	public function hapus_karyawan(){
		$this->Logs_m->save('hapus Karyawan => id : '.$_POST['id']);
		echo json_encode($this->Karyawan_m->hapus_karyawan());
	}

	public function getIDKaryawan()
    {
        // Example KRYW201912130001;
        $date = date("Ymd");
        $queryLength = "SELECT id_absensi FROM absensi WHERE MID(id_absensi,5,8) = '$date'";
        $curLength = ($this->db->query($queryLength)->num_rows()) + 1;
        if ($curLength <= 9) {
            $returnId = "KRYW" . $date . "000" . $curLength;
        } else if ($curLength <= 99) {
            $returnId = "KRYW" . $date . "00" . $curLength;
        } else if ($curLength <= 99) {
            $returnId = "KRYW" . $date . "0" . $curLength;
        } else {
            $returnId = "KRYW" . $date . $curLength;
        }
        return $returnId;
    }

	function import_karyawan()
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
                            "id_karyawan" => $this->getIDKaryawan(),
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
                        $this->db->insert("karyawan",$data);
                    }
                }
            }
			$this->Logs_m->save('Import Karyawan => file : '. $_FILES["uploadFile"]["name"]);
			redirect(base_url().'karyawan');
        }
        
        
    }
}
