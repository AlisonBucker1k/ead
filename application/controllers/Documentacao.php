<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documentacao extends CI_Controller {
  
  
  public function index()
	{
		$this->load->view('documentacao.php');
	}
}
