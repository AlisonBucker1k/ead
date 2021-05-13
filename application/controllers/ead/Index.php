<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Index extends CI_Controller {

  public function __construct() {
    parent::__construct();
      if ($this->session->userdata('nivel_user') == ''){
        redirect('ead/login');
    }
  }

  public function index() {
      $data = array();

      $this->load->helper('general');
      $this->load->helper('curso');

      $data['courses'] = $this->model->getCourses();
      // $data['courses'] = array();
      $data['featured'] = $this->model->getDataCourse('curso', 'destaque', 1);

      $data['ttl_cursos'] = $this->model->ttlCourses();
    
      $data['tarefas'] = isset($data['courses'][0]['id_curso']) ? $this->model->getTarefasAluno($this->session->userdata('id'), $data['courses'][0]['id_curso']) : [];

      $data['provas'] = isset($data['courses'][0]['id_curso']) ? $this->model->getProvasAluno($this->session->userdata('id'), $data['courses'][0]['id_curso']) : [];

      for($q=0; $q<count($data['featured']);$q++){
          $data['featured'][$q]['modalidade'] = $this->model->getDataCourse('modalidade', 'id', $data['featured'][$q]['id_modalidade']);
          $data['featured'][$q]['professor'] = $this->model->getDataCourse('professor', 'id', $data['featured'][$q]['id_professor']);
      }
      
      $this->load->view('ead/index', $data);
  }
}