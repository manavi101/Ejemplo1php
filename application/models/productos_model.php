<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class productos_model extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }

   public function putProducto($nombreprod,$preciopesos){
      $this->db->select('nombre');
      $this->db->from('productos');
      $this->db->where('nombre',$nombreprod);
      $query = $this->db->get();
      $query = $query->num_rows();
      if($query>0){
         http_response_code(401);
         die;
      }else{
         $data = array(
            'preciopesos' => $preciopesos,
            'nombre' => $nombreprod
         );          
         $this->db->insert('productos', $data);
      }
   }

   public function postProducto($nombreprod,$preciopesos,$idprod){
      $this->db->select('nombre');
      $this->db->from('productos');
      $this->db->where('nombre',$nombreprod);
      $this->db->where('id',$idprod);
      $query = $this->db->get();
      $query = $query->num_rows();
      $this->db->select('nombre');
      $this->db->from('productos');
      $this->db->where('nombre',$nombreprod);
      $query2 = $this->db->get();
      $query2 = $query2->num_rows();
      if($query2>0&&$query==0){
         http_response_code(401);
         die;
      }else{
         $this->db->set('nombre',$nombreprod);
         $this->db->set('preciopesos',$preciopesos);
         $this->db->where('id',$idprod);
         $this->db->update('productos');
      }
   }

   public function delProducto($idprod){
      $this->db->where('id',$idprod);
      $this->db->delete('productos');
   }

   public function getProductos(){
      $this->db->select('*');
      $this->db->from('productos');
      $this->db->order_by('id','asc');
      $query = $this->db->get();
      $query = $query->result_array();
      return $query;
   }
}
?>