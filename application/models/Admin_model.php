<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    protected $table = 'admin';


    public function getPermissoes($id){
        $permissoes = $this->setTable('permissoes')->where('id_cargo', $id)->fetch('array');
        return $permissoes[0] ?? [];
    }

    public function getCargo($id){
        $cargo = $this->setTable('cargo')->get($id);
        if ($cargo){
            $permissoes = $this->getPermissoes($cargo[0]['id']);
            $cargo[0]['permissoes'] = $permissoes;
        }
        return $cargo[0] ?? [];
    }

    public function get($id, $type="array"){
        $admin = parent::get($id, $type);
        if ($admin){
            $admin[0]['cargo'] = $this->getCargo($admin[0]['id_cargo']);
        }
    }
}