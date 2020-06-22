<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dolares extends CI_Controller {
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
	public function putDolar()
	{
		$this->verificacion();
		$dolar = $this->input->post("dolar");
		if(!is_null($dolar)&&!empty($dolar)&&is_numeric($dolar)){
			$this->load->model("dolar_model");
			$this->dolar_model->putDolar($dolar);
		}else{
			http_response_code(400);
			die;
		}
		$data =  array("csrfName" => $this->security->get_csrf_token_name(),"csrfHash" =>$this->security->get_csrf_hash());
		echo json_encode($data);
	}
	public function getDolar()
	{
		$this->verificacion();
		$this->load->model("dolar_model");
		$dolar = $this->dolar_model->getDolar();
		echo json_encode($dolar);
	}
}
?>
