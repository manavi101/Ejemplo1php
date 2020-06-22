<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {
	private function verificacion(){
		define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
		if(!IS_AJAX) {
			http_response_code(403);
			die;
		}
	}

	public function index()
	{   
        $this->load->view('header.php');
        $this->load->view('index.php');
        $this->load->view('footer.php');
	}


}
?>
