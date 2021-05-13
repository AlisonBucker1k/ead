<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Quadro_de_notas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('nivel_user') == ''){
            redirect('ead/login');
        }
        $this->load->model('ProvasAlunos_model', 'provas_alunos');
        $this->load->model('Provas_model', 'provas');
        $this->load->model('Curso_model', 'curso');
        $this->load->model('AlunoCurso_model', 'aluno_curso');
    }

    public function index() {
        $alncurso = $this->aluno_curso->where('id_aluno', $this->session->userdata('id'))->fetch('array');

        $data['quadro'] = [];
        foreach($alncurso as $c){
            $curso = $this->curso
            ->where('id', $c['id_curso'])
            ->fetch('array');

            if (!$curso) continue;

            $quadro['curso'] = $curso[0];

            $provas = $this->provas
            ->where('id_curso', $c['id_curso'])
            ->where('ativo', 1)
            ->fetch('array');

            $notaAtual = 0;
            $nprovas = 0;
            $notaMaxima = 0;
            foreach($provas as &$p){
                $notaAluno = $this->provas_alunos
                ->where('id_aluno', $this->session->userdata('id'))
                ->where('id_prova', $p['id'])
                ->fetch('array');
                
                $p['notaAluno'] = $notaAluno[0] ?? [];

                if (isset($p['notaAluno']['nota'])){
                    
                    if ($p['notaAluno']['nota'] > ($p['nota_maxima'] / 2)){
                        $p['notaAluno']['classe'] = 'text-primary';
                    } else if ($p['notaAluno']['nota'] < ($p['nota_maxima'] / 2)) {
                        $p['notaAluno']['classe'] = 'text-accent';
                    }
                }

                $notaAtual += $notaAluno[0]['nota'] ?? 0;
                $notaMaxima += $p['nota_maxima'];
                $nprovas++;
            }
            
            

            $quadro['media'] = $nprovas > 0 ? $notaAtual / $nprovas : 0;
            $quadro['nota_maxima'] = @($notaMaxima / $nprovas);
            $quadro['provas'] = $provas;

            $quadro['classe'] = $quadro['media'] > ($quadro['nota_maxima'] / 2) ? 'text-primary' : 'text-accent';

            $data['quadro'][] = $quadro;

        }
        

        $this->load->view('ead/quadro_de_notas', $data);
    }
}