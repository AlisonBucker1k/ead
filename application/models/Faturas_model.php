<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Redes_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    protected $table = 'fatura_aluno_rede';
}