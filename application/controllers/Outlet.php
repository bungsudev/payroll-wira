<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Outlet extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username')){
			$this->session->set_flashdata('message', 'Anda harus login terlebih dahulu.');
			redirect('auth');
		}
		$this->load->library('excel');
		$this->load->model('Logs_m');
		$this->load->model('Outlet_m');
	}

	public function index(){
		$data['title'] = 'Outlet';
		$data['content'] = "admin/outlet/page-outlet";
		$this->load->view('admin/layout/layout',$data);
	}

	public function get_data(){
		echo json_encode($this->Outlet_m->data_outlet());
	}

	public function total_karyawan_outlet($id){
		echo json_encode($this->Outlet_m->total_karyawan_outlet($id));
	}
	
	public function get_data_detail(){
		echo json_encode($this->Outlet_m->data_outlet_detail());
	}

	public function getIDOutlet(){
		echo json_encode($this->Outlet_m->getIDOutlet());
	}

	function simpan_outlet($act, $id = ''){
		if ($act == 'Tambah') {
				echo json_encode([
					'res' => $this->Outlet_m->simpan_outlet(), 
					'msg' =>  'Data di tambahkan'
				]);
		}else if ($act == 'Edit'){
			echo json_encode([
				'res' => $this->Outlet_m->edit_outlet($id), 
				'msg' =>  'Data telah di edit'
			]);
		}else{
			echo json_encode([
				'res' => false, 
				'msg' =>  'Error'
			]);
		}
	}

	public function hapus_outlet(){
		$this->Logs_m->save('hapus Karyawan => id : '.$_POST['id']);
		echo json_encode($this->Outlet_m->hapus_outlet());
	}
	public function hapus_outlet_detail(){
		$this->Logs_m->save('hapus Karyawan Detail => id : '.$_POST['id']);
		echo json_encode($this->Outlet_m->hapus_outlet_detail());
	}

	function import_outlet()
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
                    $nama_outlet = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $t_ot = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                  
                    if ($nik != ''  ) {
                        $data = [ 
                            "nama_outlet" => $nama_outlet,
                            "t_ot" => $t_ot,
							"created" => date('Y-m-d H:i:s'),
                        ];
                        $this->db->insert("outlet",$data);
                    }
                }
            }
			$this->Logs_m->save('Import Outlet => file : '. $_FILES["uploadFile"]["name"]);
			redirect(base_url().'outlet');
        }
        
        
    }
}
