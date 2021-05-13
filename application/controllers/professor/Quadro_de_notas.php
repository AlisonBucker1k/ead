<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Quadro_de_notas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('nivel_prof') != 1) {
            redirect('professor/login');
        }
        $this->load->model('Curso_model', 'curso');
        $this->load->model('AlunoCurso_model', 'aluno_curso');
        $this->load->model('Aluno_model', 'aluno');
        $this->load->model('Provas_model', 'provas');
        $this->load->model('ProvasAlunos_model', 'provas_alunos');
        $this->load->model('ProvasRespostasAluno_model', 'provas_respostas');
    }

    /* ADCIONA OS DADOS DO QUADRO DE NOTAS À ARRAY */
    protected function arrangeArray($aluno, $provas)
    {
        $notaAtual = 0;
        $notaMaxima = 0;
        $nprovas = 0;
        $ass = [];
        foreach ($provas as &$prv) {
            $p = $this->provas_alunos
                ->where('id_aluno', $aluno[0]['id'])
                ->where('id_prova', $prv['id'])
                ->fetch('array');

            $prv['notaAluno'] = $p[0] ?? [];

            if (isset($prv['notaAluno']['nota'])) {

                if ($prv['notaAluno']['nota'] > ($prv['nota_maxima'] / 2)) {
                    $prv['notaAluno']['classe'] = 'text-primary';
                } else if ($prv['notaAluno']['nota'] < ($prv['nota_maxima'] / 2)) {
                    $prv['notaAluno']['classe'] = 'text-accent';
                }
            }

            $notaAtual += $p[0]['nota'] ?? 0;
            $notaMaxima += $prv['nota_maxima'];
            $nprovas++;
        }
        $ass['provas'] = $provas;
        $ass['media'] = $nprovas > 0 ? $notaAtual / $nprovas : 0;
        $ass['nota_maxima'] = $notaMaxima / $nprovas;
        $ass['provas'] = $provas;

        $ass['classe'] = $ass['media'] > ($ass['nota_maxima'] / 2) ? 'text-primary' : 'text-accent';
        return $ass;
    }

    /* INDEX DO QUADRO DE NOTAS DO PROFESSOR */
    public function index()
    {
        setRedirect('professor/quadro_de_notas');
        $id_curso = $this->session->userdata('curso_selecionado_id') ?? 0;
        $id_prof = $this->session->userdata('id') ?? 0;
        $curso = $this->curso
            ->where('id', $id_curso)
            ->where('id_professor', $id_prof)
            ->fetch('array');

        if (!$curso) {
            gera_aviso('erro', 'Curso não encontrado.', 'professor/index');
            return '';
        }


        $assinaturas = $this->aluno_curso
            ->where('id_curso', $id_curso)
            ->where('concluido', 0)
            ->fetch('array');

        $provas = $this->provas
            ->where('id_curso', $id_curso)
            ->where('ativo', 1)
            ->fetch('array');

        foreach ($assinaturas as &$ass) {
            $aluno = $this->aluno->get($ass['id_aluno']);
            $ass['aluno'] = $aluno[0] ?? [];
            $ass['provas'] = [];

            if ($aluno && $aluno[0]['ativo'] == 1) {
                $ass = array_merge($ass, $this->arrangeArray($aluno, $provas));
            }
        }

        //echo '<pre>';
        //print_r($assinaturas);
        //echo '</pre>';
        

        $this->load->view('professor/quadro_de_notas', [
            'assinaturas' => $assinaturas,
            'curso' => $curso,
            'provas' => $provas,
            'tables' => true,
            'colunas' => '0,1,2,3,4'
        ]);
    }

    /* QUADRO DE NOTAS DE 1 ALUNO */
    public function aluno($url)
    {
        $id = getIdString($url);

        setRedirect('professor/quadro_de_notas');
        $id_curso = $this->session->userdata('curso_selecionado_id') ?? 0;
        $id_prof = $this->session->userdata('id') ?? 0;
        $curso = $this->curso
            ->where('id', $id_curso)
            ->where('id_professor', $id_prof)
            ->fetch('array');

        if (!$curso) {
            gera_aviso('erro', 'Curso não encontrado.', 'professor/index');
            return '';
        }


        $assinaturas = $this->aluno_curso
            ->where('id_curso', $id_curso)
            ->where('id_aluno', $id)
            ->where('concluido', 0)
            ->fetch('array');

        $provas = $this->provas
            ->where('id_curso', $id_curso)
            ->where('ativo', 1)
            ->fetch('array');

        foreach ($assinaturas as &$ass) {
            $aluno = $this->aluno->get($ass['id_aluno']);
            $ass['aluno'] = $aluno[0] ?? [];
            $ass['provas'] = [];

            if ($aluno && $aluno[0]['ativo'] == 0) {
                $ass = array_merge($ass, $this->arrangeArray($aluno, $provas));
            }
        }

        $this->load->view('professor/quadro_de_notas', [
            'assinaturas' => $assinaturas,
            'curso' => $curso,
            'provas' => $provas,
            'tables' => true,
            'colunas' => '0,1,2,3,4'
        ]);
    }
}
