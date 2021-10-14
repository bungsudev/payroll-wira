<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Outlet_detail extends CI_Controller {

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

	public function index($id = ''){
		$data['outlet'] = $this->Outlet_m->data_outlet_detail_wParam($id);
		$data['title'] = 'Outlet '.$data['outlet']->nama_outlet;
		$data['content'] = "admin/outlet-detail/page-outlet-detail";
		$this->load->view('admin/layout/layout',$data);
	}

	public function print($id_outlet){
		require_once './vendor/autoload.php';
		// $mpdf = new \Mpdf\Mpdf(['format' => 'Legal']);
		$mpdf= new \Mpdf\Mpdf(['mode' => 'utf-8','format' => 'Legal','margin_left' => 10,'margin_right' => 10,'margin_top' => 8,'margin_bottom' => 15,'margin_header' => 0,'margin_footer' => 0]); 
		$data['title'] = 'Daftar Karyawan Outlet ';
		$data['data'] = $this->Outlet_m->data_outlet_detail_karyawanWParam($id_outlet);
		// echo json_encode($data['data']); die();
		$html = $this->load->view('admin/outlet-detail/page-print',$data,true);
		$mpdf->SetTitle('Daftar Karyawan Outlet '.$data['data'][0]['nama_outlet'].' - '.$id_outlet);
		$mpdf->WriteHTML($html);
		$mpdf->Output('Daftar Karyawan Outlet  '.$data['data'][0]['nama_outlet'].' ('.date('d F Y').') - '.$id_outlet.'.pdf', 'I');
    }
	
	public function get_data(){
		echo json_encode($this->Outlet_m->data_outlet_detail_karyawan());
	}
	
	public function get_data_detail(){
		echo json_encode($this->Outlet_m->data_ByID());
	}

	function simpan_outlet_karyawan($act, $id = ''){
		if ($act == 'Tambah') {
				echo json_encode([
					'res' => $this->Outlet_m->simpan_outlet_karyawan(), 
					'msg' =>  'Data di tambahkan'
				]);
		}else if ($act == 'Edit'){
			echo json_encode([
				'res' => $this->Outlet_m->edit_outlet_karyawan($id), 
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
                    $tunjangan_outlet = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                  
                    if ($nik != ''  ) {
                        $data = [ 
                            "nama_outlet" => $nama_outlet,
                            "tunjangan_outlet" => $tunjangan_outlet,
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
