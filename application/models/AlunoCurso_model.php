<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AlunoCurso_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    protected $table = 'aluno_curso';
}