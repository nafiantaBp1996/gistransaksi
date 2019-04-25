<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File_model extends CI_Model {
    public function insert($data)
    {
        $this->db->insert("data_file",$data);
        return true;
    }

    public function getId($kode)
    {
    	$q = $this->db->query("select id_file,tgl from data_file where kode_file='$kode'");
    	return $q->result();
    }
}    

?>