<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Painel extends CI_Controller
{


	public function index()
	{
		if ($this->session->userdata('suporte_logado') == 1) {

			$data['cadastros'] = $this->model->selecionaBusca("cadastro", "WHERE `id_link`='".$this->session->userdata('id')."' ");

			$this->load->view('header.php');
			$this->load->view('index.php', $data);
		} else {
			redirect('login');
		}
	}
}
