<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Curso extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('nivel_user') == ''){
            redirect('ead/login');
        }
    }

    public function index($id) {
        $data = array();

        if($this->model->verifyStudentCourse($id, $this->session->userdata('nivel_user'))){
            $data['course'] = $this->model->getDataCourse('curso', 'id', $id);
            $data['modalidade'] = $this->model->getDataCourse('modalidade', 'id', $data['course'][0]['id_modalidade']);
            $data['professor'] = $this->model->getDataCourse('professor', 'id', $data['course'][0]['id_professor']);
            $data['aulas'] = $this->model->getOrderBy('aula', 'id_curso', $data['course'][0]['id'], 'n_aula', 'ASC');

            $this->load->view('ead/curso', $data);
        }else{
            redirect('ead/curso/matricular/'.$id);
        }
    }

    public function matricular($id){
        echo "Tela de matricula";
    }
}