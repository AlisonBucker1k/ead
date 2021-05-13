<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cursos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('nivel_user') == '') {
            redirect('ead/login');
        }
    }

    public function index()
    {
        $data = array();

        $modalidades = $this->model->simpleGet('modalidade');

        $data['modalidades'] = [];
        foreach($modalidades as $mod){
            $cursos = $this->model->selecionaBusca('curso', "WHERE id_modalidade='".$mod['id']."' AND status='ativo' ");
            if (!$cursos) continue;

            $enter = $mod;

            for ($i=0; $i<count($cursos); $i++){
                $enter['courses'][$i]['dataCourse'][0] = $cursos[$i];
                $enter['courses'][$i]['modalidade'][0] = $mod;
                $enter['courses'][$i]['professor'] = $this->model->setTable('professor')->get($cursos[$i]['id_professor']);
                $enter['courses'][$i]['qtAulas'] = count($this->model->setTable('aula')->getWhere("id_curso='{$cursos[$i]['id']}' "));
                $inscrito = $this->model->setTable('aluno_curso')->getWhere("id_aluno='".$this->session->userdata('id')."' AND id_curso='".$cursos[$i]['id']."' ");
                $enter['courses'][$i]['inscrito'] = ($inscrito);
                $enter['courses'][$i]['alunos_vis'] = $this->db->query("SELECT id FROM aluno_curso WHERE id_curso='{$cursos[$i]['id']}' ")->num_rows();
            }
            $data['modalidades'][] = $enter;
        }

        $this->load->view('ead/todosCursos', $data);
    }

    public function meusCursos()
    {
        $data = array();

        $this->load->helper('general');
        $this->load->helper('curso');

        $data['courses'] = $this->model->getCourses();

        $this->load->view('ead/meusCursos', $data);
    }

    protected function inscreverCurso($id_curso){
        $aula = $this->model->setTable('aula')->getWhere("id_curso='".$id_curso."' ORDER BY n_aula ASC LIMIT 1");
        if (!$aula) return false;
        $ac = [
            'id_curso' => $id_curso,
            'id_aluno' => $this->session->userdata('id'),
            'id_aula' => $aula[0]['id'],
            'json' => '{}',
            'concluido' => 0,
        ];
        $inserted = $this->model->insere_id('aluno_curso', $ac);
        $ac['id'] = $inserted;
        return $ac;
    }

    protected function updateInscricao($id_aula, $id_inscricao){
        $inscrito = $this->model->setTable('aluno_curso')->get($id_inscricao);
        if (!$inscrito || $inscrito[0]['id_aluno'] != $this->session->userdata('id')) return false;

        $ac = [
            'id_aula' => $id_aula,
        ];
        return $this->model->update('aluno_curso', $ac, $id_inscricao);
    }

    public function setAula($id, $id_inscricao){
        $this->updateInscricao($id, $id_inscricao);
        return 0;
    }

    public function inscrever($id){
        $curso = $this->model->setTable('curso')->get($id);
        if (!$curso || $curso[0]['status'] != 'ativo') {
            gera_aviso('erro', 'Curso não encontrado.', 'ead/cursos');
            return '';
        }

        $this->inscreverCurso($id);
        redirect('ead/cursos/visualizar/'.$id.'-'.rawurlencode($curso[0]['nome']));
    }

    public function concluidos(){
        $aprovacoes = $this->model->setTable('aluno_conclusao')
            ->where('id_aluno', $this->session->userdata('id'))
            ->where('resultado', 'aprovado')
            ->fetch('array');

        foreach($aprovacoes as &$a){
            $curso = $this->model->setTable('curso')
            ->get($a['id_curso']);
            $a['curso'] = $curso[0] ?? [];
        }
        
        $this->load->view('ead/cursos_concluidos', [
            'aprovacoes' => $aprovacoes,
            'tables' => true,
            'colunas' => '0,1,2,3'
        ]);
    }

    /* PÁGINA DE VISUALIZAÇÃO DO CURSO */
    public function visualizar($uri){
        $id = getIdString($uri);
        $curso = $this->model->getDataCourse('curso', 'id', $id);
        
        if (!$curso || $curso[0]['status'] != 'ativo') {
            gera_aviso('erro', 'Curso não encontrado.', 'ead/cursos');
            return '';
        }
        $inscrito = $this->model->setTable('aluno_curso')->getWhere("id_aluno='".$this->session->userdata('id')."' AND id_curso='".$id."' ");
        $modalidade = $this->model->getDataCourse('modalidade', 'id', $curso[0]['id_modalidade']);
        $professor = $this->model->getDataCourse('professor', 'id', $curso[0]['id_professor']);
        $aulas = $this->model->getOrderBy('aula', 'id_curso', $id, 'n_aula', 'ASC');

        if (!$inscrito){ //CASO O USUÁRIO NÃO ESTEJA INSCRITO NO CURSO AINDA E SEJA DO TIPO REDE, É POSSÍVEL SE INSCREVER \/
            $jaConcluiu = $this->model->setTable('aluno_conclusao')
            ->where('id_aluno', $this->session->userdata('id'))
            ->where('id_curso', $id)
            ->where('resultado', 'aprovado')
            ->fetch('array');

            if ($jaConcluiu){
                gera_aviso('success', 'Você já concluiu esse curso, caso deseje, você pode visualizar seu certificado no menu<br/><a href="'.site_url('ead/cursos/concluidos').'">CURSOS CONCLUÍDOS</a>!', 'ead/cursos');
            } else if ($this->session->userdata('tipo') == 'rede' || usuarioDependente()){
                $this->load->view('ead/inscricao', [ 
                    'course' => $curso,
                    'modalidade' => $modalidade,
                    'professor' => $professor,
                    'aulas' =>$aulas
                ]);
            } else {
                /* CASO FAÇA A COMPRA VIA SISTEMA, INSERIR A LÓGICA AQUI \/ */
                gera_aviso('erro', 'Você precisa comprar esse curso para ter acesso a ele', 'ead/cursos');
            }
        } else { 
            //CASO O USUÁRIO SEJA INSCRITO NO CURSO, VISUALIZA A PÁGINA DO CURSO
            $inscrito = $inscrito[0];
            
            $aulaAtual = $this->model->setTable('aula')->get($inscrito['id_aula']);

            $tarefas = $this->model->getTarefasAluno($this->session->userdata('id'), $id, true) ?? [];

            $provas = $this->model->getProvasAluno($this->session->userdata('id'), $id, true) ?? [];

            
            $this->load->view('ead/curso', [ 
                'course' => $curso,
                'inscricao' => $inscrito,
                'aulaAtual' => $aulaAtual,
                'modalidade' => $modalidade,
                'professor' => $professor,
                'aulas' =>$aulas,
                'tarefas' => $tarefas,
                'provas' => $provas
            ]);
        }
    }
}
