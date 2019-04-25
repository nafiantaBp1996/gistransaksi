<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

    // var $API ="";
    
    // function __construct() {
    //     parent::__construct();
    //     $this->API="https://api.thegadeareamalang.com/bpo/index.php/";
    //     $this->load->library('curl');
    // }

    public function index()
	{	
        $this->load->model('transaksi_model');
        $data['produk']=$this->transaksi_model->dataProduk();
        $this->load->view('partials/header');
        $this->load->view('home',$data);
        $this->load->view('partials/footer');
    }
    public function input(){
        $produk=$this->input->post('input-produk');
        if ($produk=="") {
            $this->session->set_flashdata('message', 'Pilih Produk !');
            $this->load->model('transaksi_model');
            $data['produk']=$this->transaksi_model->dataProduk();
            $this->load->view('partials/header');
            $this->load->view('home',$data);
            $this->load->view('partials/footer');
        }
        else{

            $fileName = date('ydmshh').".xls"; 
            $config['upload_path'] = './assets/file/'; //buat folder dengan nama assets di root folder
            $config['file_name'] = $fileName;
            $config['allowed_types'] = 'xls|xlsx|csv';
            $config['max_size'] = 10000;
             
            $this->load->library('upload');
            $this->upload->initialize($config);
             
            if(!$this->upload->do_upload('file')){
                $this->upload->display_errors();
            }
            else{
                $this->load->model('file_model');
                $rand=$this->rands(9);
                $tgl=date("Y-m-d", strtotime($this->input->post('tgl-input')));
                $data=array("kode_file"=>$rand,"nama_file"=>$fileName,"tgl"=>$tgl,"id_produk"=>$produk);
                $ins=$this->file_model->insert($data);
               if ($ins) {
                    $data=$this->file_model->getId($rand);
                    $this->inputDatabase($fileName,$data[0]->id_file);                    
                }
            }
        }
    }
    
    public function inputDatabase($input,$kode)
		{
		    $inputFileName="./assets/file/".$input;
		    
            $this->load->library('PHPExcel');
            $this->load->library('PHPExcel/IOFactory');
 			$this->load->model('transaksi_model');
 			try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.'": '.$e->getMessage());
            }
 
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            $th=''; 
            for ($row = 5; $row <= $highestRow-1; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);
                // $data = $sheet->rangeToArray('C50:C54' ,NULL,TRUE,FALSE);
                if($rowData[0][1]==null)
                {
                    $row=($highestColumn+1);
                    break;
                }         
                else
                {                     
                //Sesuaikan sama nama kolom tabel di database                                
                 $data = array(
                    "id_kode"=> $kode,
                    "id_upc"=> $rowData[0][0],
                    "id_target"=> 1,
                    "lastyear"=> str_replace(",", "", $rowData[0][3]) ,
                    "month_lastyear"=> str_replace(",", "", $rowData[0][4]),
                    "month_nowyear"=> str_replace(",", "", $rowData[0][5])
                     );
                $this->transaksi_model->insert($data);
                }
                
            }
            return true;
        }
    public function rands($id){
      $rand=substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", $id)), 0, $id);
      return $rand;
    }
}