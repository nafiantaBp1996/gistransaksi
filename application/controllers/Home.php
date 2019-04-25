<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    var $API ="";
    
    function __construct() {
        parent::__construct();
        $this->API="https://api.thegadeareamalang.com/bpo/index.php/";
        $this->load->library('curl');
    }
    
//     public function login()
// 	{	
// 	    $jsonString=$this->curl->simple_get('https://api.thegadeareamalang.com/bpo/index.php/register/spv', array(CURLOPT_BUFFERSIZE => 10));
//         $data['spv']=json_decode($jsonString);
// 		$this->load->view('login',$data);
//     }

//     public function login_aksi(){
        
//         $data = array(
//         "username" => $this->input->post('username'),
//         "password" => $this->input->post('password')
//         );

//         $login = json_decode($this->curl->simple_post($this->API.'/login', $data, array(CURLOPT_BUFFERSIZE => 10))); 
//         if($login){
//             if($login->status=="success"){
//                 $sess_arr = array(
// 					'id' => $login->data->id,
//                     'username' => $login->data->username,
//                     'nama' => $login->data->nama,
//                     'level'=>$login->data->level,
//                     'idspv'=>$login->data->idspv,
                    
// 				);
//                 $this->session->set_userdata('login',$sess_arr);
//                 echo "sukses";
//             }else{
//                 echo "error";
//             }
//         }else{
//             echo "koneksi Error";
//         }
//     }

//     public function logout(){
        
//         $this->session->unset_userdata('login');
        
//         redirect('Home/login','refresh');
        
        
//     }

}