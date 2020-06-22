<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dolar_model extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }

   public function putDolar($dolar){
    $data = array(
        'precio' => $dolar
    );          
    $this->db->insert('dolar', $data);
   }

   public function getDolar(){
      $this->db->select('precio');
      $this->db->from('dolar');
      $this->db->order_by('id','desc');
      $this->db->limit(1);
      $query = $this->db->get();
      $query = $query->row();
      return $query->precio;
     }
}