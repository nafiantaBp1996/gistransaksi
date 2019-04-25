<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends CI_Controller {
    public function ex($bulan,$tahun,$link,$id,$level){ 
			// load excel library
			$this->load->library('excel');
			$this->load->library('curl');
			$API="https://api.thegadeareamalang.com/bpo/index.php/TransaksiFilter/";
			$sessData = $this->session->userdata('login');
			
            if($level=='admin'){
                $data = array(
                    "bulan" => $bulan,
                    "tahun" => $tahun,
                );
                $jsonString=$this->curl->simple_get($API.$link,$data, array(CURLOPT_BUFFERSIZE => 10));
			    $dat=json_decode($jsonString);
			    
            }
            else{
                $data = array(
                    "bulan" => $bulan,
                    "tahun" => $tahun,
                    "id"=>$id,
                );
                $jsonString=$this->curl->simple_get($API.$link,$data, array(CURLOPT_BUFFERSIZE => 10));
			    $dat=json_decode($jsonString);
            }
            
            $datalist = $dat->data;

			$objPHPExcel = new PHPExcel();
			$objPHPExcel->setActiveSheetIndex(0);
			// set Header
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
			
			$objset = $objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->mergeCells('A1:I1'); 
            $objset->setCellValue("A".'1', "DAFTAR TRANSAKSI BULAN ".$bulan." - ".$tahun);
            
			$objPHPExcel->getActiveSheet()->SetCellValue('A3', 'NO');
			$objPHPExcel->getActiveSheet()->SetCellValue('B3', 'NO KREDIT');
			$objPHPExcel->getActiveSheet()->SetCellValue('C3', 'NASABAH');
			$objPHPExcel->getActiveSheet()->SetCellValue('D3', 'PRODUK');
			$objPHPExcel->getActiveSheet()->SetCellValue('E3', 'TANGGAL TRANSAKSI');  
			$objPHPExcel->getActiveSheet()->SetCellValue('F3', 'PINJAMAN');
			$objPHPExcel->getActiveSheet()->SetCellValue('G3', 'TENOR');
			$objPHPExcel->getActiveSheet()->SetCellValue('H3', 'CABANG');
			$objPHPExcel->getActiveSheet()->SetCellValue('I3', 'SALES');
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true); 
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true); 
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true); 
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true); 
			// set Row
			$rowCount = 4;
			$i=1;
			$total=0;
			foreach ($datalist as $element) {
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element->nomer_kredit);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element->nama_nasabah);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element->produk);
				$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element->tgl_transaksi);
				$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element->uang_pinjaman);
				$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element->jangka_waktu);
				$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element->nama_cabang);
				$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element->nama);
				$i++;
				$rowCount++;
			}
			$style = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER));
            $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($style);
            
            $objPHPExcel->getActiveSheet()->getStyle('A1:I3')->getFont()->setBold(true)->setSize(12);
            
// 			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $total);
			$object_writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Laporan Transaksi -'.$bulan.'-'.$tahun.'.xls"');
			$object_writer->save('php://output');   
		}
		
	 public function exall($id){ 
			// load excel library
			$this->load->library('excel');
			$this->load->library('curl');
			
			$data = array('id'=>$id);
            $jsonString=$this->curl->simple_get('https://api.thegadeareamalang.com/bpo/index.php/insert',$data, array(CURLOPT_BUFFERSIZE => 10));
            $dat=json_decode($jsonString);
            $datalist = $dat->data;
            
            //var_dump($datalist);
            
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->setActiveSheetIndex(0);
			// set Header
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
			
			$objset = $objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->mergeCells('A1:I1'); 
            $objset->setCellValue("A".'1', "DAFTAR TRANSAKSI");
            
			$objPHPExcel->getActiveSheet()->SetCellValue('A3', 'NO');
			$objPHPExcel->getActiveSheet()->SetCellValue('B3', 'NO KREDIT');
			$objPHPExcel->getActiveSheet()->SetCellValue('C3', 'NASABAH');
			$objPHPExcel->getActiveSheet()->SetCellValue('D3', 'PRODUK');
			$objPHPExcel->getActiveSheet()->SetCellValue('E3', 'TANGGAL TRANSAKSI');  
			$objPHPExcel->getActiveSheet()->SetCellValue('F3', 'PINJAMAN');
			$objPHPExcel->getActiveSheet()->SetCellValue('G3', 'TENOR');
			$objPHPExcel->getActiveSheet()->SetCellValue('H3', 'CABANG');
			$objPHPExcel->getActiveSheet()->SetCellValue('I3', 'SALES');
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true); 
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true); 
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true); 
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true); 
			// set Row
			$rowCount = 4;
			$i=1;
			$total=0;
			foreach ($datalist as $element) {
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element->nomer_kredit);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element->nama_nasabah);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element->produk);
				$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element->tgl_transaksi);
				$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element->uang_pinjaman);
				$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element->jangka_waktu);
				$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element->nama_cabang);
				$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element->nama);
				$i++;
				$rowCount++;
			}
			$style = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER));
            $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($style);
            
            $objPHPExcel->getActiveSheet()->getStyle('A1:I3')->getFont()->setBold(true)->setSize(12);
            
// 			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $total);
			$object_writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Laporan Total.xls"');
			$object_writer->save('php://output');   
		}
	
}