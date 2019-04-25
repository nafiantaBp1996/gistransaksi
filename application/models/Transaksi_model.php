<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {
    public function insert($data)
    {
        $this->db->insert("transaksi_sort",$data);
       
        return "succes";
    }
    public function dataProduk()
    {
        $q=$this->db->get("produk");
        return $q->result();
    }
}    

?>