<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {
	private function verificacion(){
		define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
		if(!IS_AJAX) {
			http_response_code(403);
			die;
		}
	}

	public function index()
	{
		http_response_code(403);
		die;
	}

	public function putProducto()
	{
		$this->verificacion();
		$preciopesos = $this->input->post("preciopesos");
		$nombreprod = $this->input->post("nombreprod");
		if(!is_null($preciopesos) && !empty($preciopesos) && is_numeric($preciopesos) && !is_null($nombreprod) && !empty($nombreprod)){
			$this->load->model("productos_model");
			$this->productos_model->putProducto($nombreprod,$preciopesos);
		}else{
			http_response_code(400);
			die;
		}
	}
	public function postProducto()
	{
		$this->verificacion();
		$preciopesos = $this->input->post("preciopesos");
		$nombreprod = $this->input->post("nombreprod");
		$idprod = $this->input->post("idprod");
		if(!is_null($preciopesos) && !empty($preciopesos) && is_numeric($preciopesos) && !is_null($nombreprod) && !empty($nombreprod) && !is_null($idprod) && !empty($idprod) && is_numeric($idprod) ){
			$this->load->model("productos_model");
			$this->productos_model->postProducto($nombreprod,$preciopesos,$idprod);
		}else{
			http_response_code(400);
			die;
		}
	}
	public function delProducto()
	{
		$this->verificacion();
		$idprod = $this->input->post("idprod");
		if(!is_null($idprod) && !empty($idprod) && is_numeric($idprod) ){
			$this->load->model("productos_model");
			$this->productos_model->delProducto($idprod);
		}else{
			http_response_code(400);
			die;
		}
	}
	public function getProductos()
	{ 
		$this->verificacion();
		$this->load->model("productos_model");
		$productos = $this->productos_model->getProductos();
		echo json_encode($productos);
	}
}
?>