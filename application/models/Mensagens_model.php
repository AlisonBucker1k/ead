<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mensagens_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    protected $table = 'mensagem_ava';
}