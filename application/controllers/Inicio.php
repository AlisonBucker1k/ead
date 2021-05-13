<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inicio extends CI_Controller
{
    
	public function index()
	{
	    $data['ref'] = "";
	    if (isset($_GET['ref']) && !empty($_GET['ref'])){
	        $busca = $this->model->selecionaBusca('cadastro', "WHERE `minha_url`='".$_GET['ref']."' ");
	        if (isset($busca[0]['id'])){
	            $data['ref'] = $busca[0]['id'];
	            $data['indicador'] = $busca[0]['nome'];
	        }
	    }
		$this->load->view('index_landing', $data);
	}

	public function sair()
	{
		$this->session->sess_destroy();
		redirect('https://backoffice.moneybemoney.com', 'refresh');
	}

	public function cadastrar()
	{
	    $data = $_POST;
	    $pass = true;
	    foreach($data as $key => $value){
    		if (!$this->db->field_exists($key, 'cadastro'))
            {
                $pass = false;
                break;
            }
	    }
	    $fields = $this->db->field_data('cadastro');

        foreach ($fields as $field)
        {
             if ($field->name != "id" && $field->name != "id_link" && $field->name!="minha_url"){
                 if (!isset($data[$field->name])){
                     $pass = false;
                     break;
                 }
             }
            
        }
	    if ($pass){
	        $data['minha_url'] = RandomStringMaiusculas(25);
	        $busca = $this->model->selecionaBusca('cadastro', "WHERE `minha_url`='{$data['minha_url']}' ");
	        $maxi = 4000;
	        $i = 0;
	        while(isset($busca[0]['id'])){
	            $data['minha_url'] = RandomStringMaiusculas(25);
	            $busca = $this->model->selecionaBusca('cadastro', "WHERE `minha_url`='{$data['minha_url']}' ");
	            $i++;
	            if ($i > $maxi){
	                break;
	            }
	        }
	        $data['cpf'] = preg_replace('/[^0-9]/', '', $data['cpf']); 
	        $busca = $this->model->selecionaBusca('cadastro', "WHERE `email`='{$data['email']}' OR `cpf`='{$data['cpf']}' ");
	        if (!isset($busca[0]['id'])){
	            $options = array("cost"=>4);
                $hashPassword = password_hash($data['senha'],PASSWORD_BCRYPT,$options);
	            $data['senha'] = $hashPassword;
    	        $insert = $this->model->insere('cadastro', $data);
    	        if ($insert){
    	           $this->session->set_userdata(array(
    	                'aviso-tipo' => 'success',
    	                'aviso' => "Cadastro efetuado com sucesso! Você ja pode fazer login em nosso <a href='https://agenciaennove.com.br/clientes/keroser/login'>ambiente virtual</a>"
    	            ));
    	            redirect('');
    	        } else {
    	            $this->session->set_userdata(array(
    	                'aviso-tipo' => 'danger',
    	                'aviso' => "Falha ao cadastrar usuário, tente novamente"
    	            ));
    	            redirect('');
    	        }
	        } else {
	            $this->session->set_userdata(array(
	                'aviso-tipo' => 'danger',
	                'aviso' => "Já existe um cadastro com este cpf ou este email!"
	            ));
	        }
	    } else {
	        $this->session->set_userdata(array(
    	                'aviso-tipo' => 'danger',
    	                'aviso' => "Campos inválidos, tente novamente."
    	    ));
	        redirect('');
	    }
	}
}
