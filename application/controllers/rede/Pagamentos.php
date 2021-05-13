<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Pagamentos extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function ipn()
  {
    $data['post'] = print_r($this->input->post(null, TRUE), true);
    $data['json'] = $this->input->raw_input_stream;

    $this->model->insere('ipn_juno', $data);
  }
}
