<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProvasRespostasAluno_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    protected $table = 'prova_aluno';
}