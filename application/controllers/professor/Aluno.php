<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Aluno extends CI_Controller
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

  public function getById($id)
  {
    $aluno = $this->aluno->get($id);

    $echo = [
      'nome' => '',
      'email' => '',
      'telefone' => '',
      'img' => ''
    ];
    if ($aluno) {
      $aluno = $aluno[0];
      $echo = [
        'nome' => $aluno['nome'] ?? '',
        'email' => $aluno['email'] ?? '',
        'telefone' => $aluno['telefone'] ?? '',
        'img' => ($aluno['foto']) ? returnPath2($aluno['foto'], 'aluno', $aluno['id'], $aluno['login']) : returnPath2('padrao.jpg', 'aluno', $aluno['id'], $aluno['login'])
      ];
    }
    echo json_encode($echo);
  }

  function aprovar_ou_reprovar()
  {
    setRedirect('professor/aluno/aprovar_ou_reprovar');

    $id_curso = $this->session->userdata('curso_selecionado_id') ?? 0;
    $id_prof = $this->session->userdata('id') ?? 0;

    $curso = $this->curso
      ->where('id', $id_curso)
      ->where('id_professor', $id_prof)
      ->fetch('array');

    if (!$curso) {
      gera_aviso('erro', 'Curso não encontrado.', getRedirect());
      return '';
    }

    $assinaturas = $this->aluno_curso
      ->where('id_curso', $id_curso)
      ->where('concluido', 0)
      ->fetch('array');

    foreach ($assinaturas as &$ass) {
      $aluno = $this->aluno->get($ass['id_aluno']);
      $ass['aluno'] = $aluno[0] ?? [];
    }

    $this->load->view('professor/aprovar_reprovar', [
      'curso' => $curso,
      'assinaturas' => $assinaturas,
      'tables' => true
    ]);
  }

  protected function getMediaAluno(array $ass, array $aluno)
  {
    $curso = $this->curso->get($ass['id_curso']);
    if (!$curso) return false;

    $p = $this->provas
      ->where('id_curso', $curso[0]['id'])
      ->where('ativo', 1)
      ->fetch('array');

    $mediaF = 0;
    $ttlProvas = 0;
    foreach ($p as $pr) {
      $provasAln = $this->provas_alunos
        ->where('id_aluno', $aluno['id'])
        ->where('id_prova', $pr['id'])
        ->fetch('array');

      if (isset($provasAln[0]['id'])) {
        $mediaF += $provasAln[0]['nota'];
      }
      $ttlProvas++;
    }
    return $mediaF / $ttlProvas;
  }

  protected function finalizaAluno(array $ass, array $aluno)
  {
    $curso = $this->curso->get($ass['id_curso']);
    if (!$curso) return false;

    $p = $this->provas
      ->where('id_curso', $curso[0]['id'])
      ->fetch('array');

    $t = $this->model->setTable('tarefa_curso')
      ->where('id_curso', $curso[0]['id'])
      ->fetch('array');

    //remove provas feitas
    foreach ($p as $pr) {
      $provasAln = $this->provas_alunos
        ->where('id_aluno', $aluno['id'])
        ->where('id_prova', $pr['id'])
        ->fetch('array');

      if (isset($provasAln[0]['id'])) {
        $this->model->remove('provaFinalizada', $provasAln[0]['id']);
      }


      $provasEx = $this->provas_respostas
        ->where('id_aluno', $aluno['id'])
        ->where('id_prova', $pr['id'])
        ->fetch('array');

      if (isset($provasEx[0]['id'])) {
        $this->model->remove('prova_aluno', $provasEx[0]['id']);
      }
    }


    //remove tarefas feitas
    foreach ($t as $tr) {
      $tarefasAln = $this->model->setTable('tarefa_aluno')
        ->where('id_aluno', $aluno['id'])
        ->where('id_tarefa', $tr['id'])
        ->fetch('array');

      if (isset($tarefasAln[0]['id'])) {
        $this->model->remove('tarefa_aluno', $tarefasAln[0]['id']);
      }
    }


    return $this->model->remove('aluno_curso', $ass['id']);
  }

  protected function reprova(array $ass, array $curso, array $aluno)
  {
    $token = geraTokenTable('aluno_conclusao', 30);
    $c = [
      'id_aluno' => $aluno['id'],
      'id_curso' => $ass['id_curso'],
      'id_ass' => $ass['id'],
      'media_final' => $this->getMediaAluno($ass, $aluno),
      'codigo' => $token,
      'resultado' => 'reprovado',
      'data_ini' => $ass['criado_em']
    ];

    $insere = $this->model->insere('aluno_conclusao', $c);

    if (!$insere) return false;

    if ($this->finalizaAluno($ass, $aluno)) {
      $newAviso = [
        'id_aluno' => $aluno['id'],
        'titulo' => "Reprovado",
        'texto' => "Que pena... infelizmente você foi <b>reprovado</b> no curso <b>" . $curso['nome'] . "</b>, mas não desanime, você pode tentar novamente!",
        'delete_on_read' => 1
      ];

      return $this->model->insere('aviso_ead', $newAviso);
    }
    return false;
  }

  protected function aprova(array $ass, array $curso, array $aluno)
  {
    $token = geraTokenTable('aluno_conclusao', 30);
    $c = [
      'id_aluno' => $aluno['id'],
      'id_curso' => $ass['id_curso'],
      'id_ass' => $ass['id'],
      'media_final' => $this->getMediaAluno($ass, $aluno),
      'codigo' => $token,
      'resultado' => 'aprovado',
      'data_ini' => $ass['criado_em']
    ];

    $insere = $this->model->insere('aluno_conclusao', $c);

    if (!$insere) return false;

    if ($this->finalizaAluno($ass, $aluno)) {
      $linkCertificado = site_url('ead/certificado_de_conclusao/' . $token);
      $texto = "<b>PARABÉNS!</b><br/>Você foi <b>aprovado</b> no curso <b>" . $curso['nome'] . "</b>!
      <br/>Um link para acessar seu certificado foi enviado por email, você também pode acessa-lo clicando <a href='$linkCertificado'>AQUI!</a>";
      $newAviso = [
        'id_aluno' => $aluno['id'],
        'titulo' => "Aprovado",
        'texto' => $texto,
        'delete_on_read' => 1
      ];

      $this->model->insere('aviso_ead', $newAviso);

      $textoEmail = "<b>PARABÉNS!</b><br/>Você foi <b>aprovado</b> no curso <b>" . $curso['nome'] . "</b>!
      <br/>Clique no botão a seguir para acessar seu certificado virtual. Lembre-se de imprimir e assinar seu nome no certificado!
      <br/><a href='$linkCertificado'><button style='background: #3D94F6;
      background-image: -webkit-linear-gradient(top, #3D94F6, #1E62D0);
      background-image: -moz-linear-gradient(top, #3D94F6, #1E62D0);
      background-image: -ms-linear-gradient(top, #3D94F6, #1E62D0);
      background-image: -o-linear-gradient(top, #3D94F6, #1E62D0);
      background-image: -webkit-gradient(to bottom, #3D94F6, #1E62D0);
      -webkit-border-radius: 20px;
      -moz-border-radius: 20px;
      border-radius: 20px;
      color: #FFFFFF;
      font-family: Arial;
      font-size: 20px;
      font-weight: 100;
      padding: 20px;
      border: solid #337FED 1px;
      text-decoration: none;
      display: inline-block;
      cursor: pointer;
      text-align: center;'>ACESSAR CERTIFICADO</button></a>";

      $this->submail->enviar($aluno['email'], "Aprovado no curso " . $curso['nome'], $textoEmail, $aluno['nome']);

      return true;
    }
    return false;
  }

  public function enviarCertificado($id)
  {
    $id_prof = $this->session->userdata('id') ?? 0;
    $busca = $this->model->selecionaBusca('aluno_conclusao', "WHERE id='{$id}' ");
    if (!$busca) {
      gera_aviso('erro', 'Certificado não encontrado.', getRedirect());
      return '';
    }

    $curso = $this->curso
      ->where('id', $busca[0]['id_curso'])
      ->where('id_professor', $id_prof)
      ->fetch('array');

    if (!$curso) {
      gera_aviso('erro', 'Curso não encontrado.', getRedirect());
      return '';
    }

    $aluno = $this->aluno
      ->where('id', $busca[0]['id_aluno'])
      ->where('ativo', 1)
      ->fetch('array');

    if (!$aluno) {
      gera_aviso('erro', 'Aluno não encontrado.', getRedirect());
      return '';
    }

    $linkCertificado = site_url('ead/certificado_de_conclusao/' . $busca[0]['codigo']);

    $textoEmail = "<b>PARABÉNS!</b><br/>Você foi <b>aprovado</b> no curso <b>" . $curso[0]['nome'] . "</b>!
      <br/>Clique no botão a seguir para acessar seu certificado virtual. Lembre-se de imprimir e assinar seu nome no certificado!
      <br/><a href='$linkCertificado'><button style='background: #3D94F6;
      background-image: -webkit-linear-gradient(top, #3D94F6, #1E62D0);
      background-image: -moz-linear-gradient(top, #3D94F6, #1E62D0);
      background-image: -ms-linear-gradient(top, #3D94F6, #1E62D0);
      background-image: -o-linear-gradient(top, #3D94F6, #1E62D0);
      background-image: -webkit-gradient(to bottom, #3D94F6, #1E62D0);
      -webkit-border-radius: 20px;
      -moz-border-radius: 20px;
      border-radius: 20px;
      color: #FFFFFF;
      font-family: Arial;
      font-size: 20px;
      font-weight: 100;
      padding: 20px;
      border: solid #337FED 1px;
      text-decoration: none;
      display: inline-block;
      cursor: pointer;
      text-align: center;'>ACESSAR CERTIFICADO</button></a>";

    $this->submail->enviar($aluno[0]['email'], "Aprovado no curso " . $curso[0]['nome'], $textoEmail, $aluno[0]['nome']);

    gera_aviso('success', 'Email reenviado com sucesso!', getRedirect());
  }

  public function aprovar($id_aluno)
  {
    $id_curso = $this->session->userdata('curso_selecionado_id') ?? 0;
    $id_prof = $this->session->userdata('id') ?? 0;

    $curso = $this->curso
      ->where('id', $id_curso)
      ->where('id_professor', $id_prof)
      ->fetch('array');

    if (!$curso) {
      gera_aviso('erro', 'Curso não encontrado.', getRedirect());
      return '';
    }

    $ass = $this->aluno_curso
      ->where('id_curso', $id_curso)
      ->where('id_aluno', $id_aluno)
      ->where('concluido', 0)
      ->fetch('array');

    if (!$ass) {
      gera_aviso('erro', 'Aluno não encontrado.', getRedirect());
      return '';
    }

    $aluno = $this->aluno
      ->where('id', $id_aluno)
      ->where('ativo', 1)
      ->fetch('array');

    if (!$aluno) {
      gera_aviso('erro', 'Aluno não encontrado.', getRedirect());
      return '';
    }

    if ($this->aprova($ass[0], $curso[0], $aluno[0])) {
      gera_aviso('sucesso', 'Aluno definido como aprovado com sucesso.', getRedirect());
    }
  }

  public function reprovar($id_aluno)
  {
    $id_curso = $this->session->userdata('curso_selecionado_id') ?? 0;
    $id_prof = $this->session->userdata('id') ?? 0;

    $curso = $this->curso
      ->where('id', $id_curso)
      ->where('id_professor', $id_prof)
      ->fetch('array');

    if (!$curso) {
      gera_aviso('erro', 'Curso não encontrado.', getRedirect());
      return '';
    }

    $ass = $this->aluno_curso
      ->where('id_curso', $id_curso)
      ->where('id_aluno', $id_aluno)
      ->where('concluido', 0)
      ->fetch('array');

    if (!$ass) {
      gera_aviso('erro', 'Aluno não encontrado.', getRedirect());
      return '';
    }

    $aluno = $this->aluno
      ->where('id', $id_aluno)
      ->where('ativo', 1)
      ->fetch('array');

    if (!$aluno) {
      gera_aviso('erro', 'Aluno não encontrado.', getRedirect());
      return '';
    }

    if ($this->reprova($ass[0], $curso[0], $aluno[0])) {
      gera_aviso('sucesso', 'Aluno definido como reprovado com sucesso.', getRedirect());
    }
  }

  public function aprovar_reprovar()
  {
    $id_aluno = $this->input->post('aluno');
    $resultado = $this->input->post('acao');

    if ($resultado == 1) {
      $this->aprovar($id_aluno);
    } else {
      $this->reprovar($id_aluno);
    }
  }

  public function reprovados()
  {
    $data['data_inicio'] = $this->input->get('data_inicial');
    $data['data_fim'] = $this->input->get('data_final');
    $data_inicial = formataSql($data['data_inicio'], false) . ' 00:00:00';
    $data_final = formataSql($data['data_fim'], false) . ' 23:59:59';

    $id_curso = $this->session->userdata('curso_selecionado_id') ?? 0;
    $id_prof = $this->session->userdata('id') ?? 0;

    $curso = $this->curso
      ->where('id', $id_curso)
      ->where('id_professor', $id_prof)
      ->fetch('array');

    if (!$curso) {
      gera_aviso('erro', 'Curso não encontrado.', getRedirect());
      return '';
    }

    $concluidos = $this->model->selecionaBusca('aluno_conclusao', "WHERE data >= '" . $data_inicial . "' AND data <= '" . $data_final . "' AND resultado='reprovado' AND id_curso='" . $id_curso . "' ");

    foreach ($concluidos as &$c) {
      $aluno = $this->aluno->get($c['id_aluno']);
      $c['aluno'] = $aluno[0] ?? [];
    }

    $this->load->view('professor/alunos_reprovados', [
      'aprovacoes' => $concluidos,
      'curso' => $curso,
      'data_inicio' => $data['data_inicio'],
      'data_fim' => $data['data_fim']
    ]);
  }

  public function aprovados()
  {
    $currentURL = current_url();
    setRedirect(str_replace(site_url(), '', $currentURL));
    $data['data_inicio'] = $this->input->get('data_inicial');
    $data['data_fim'] = $this->input->get('data_final');
    $data_inicial = formataSql($data['data_inicio'], false) . ' 00:00:00';
    $data_final = formataSql($data['data_fim'], false) . ' 23:59:59';

    $id_curso = $this->session->userdata('curso_selecionado_id') ?? 0;
    $id_prof = $this->session->userdata('id') ?? 0;

    $curso = $this->curso
      ->where('id', $id_curso)
      ->where('id_professor', $id_prof)
      ->fetch('array');

    if (!$curso) {
      gera_aviso('erro', 'Curso não encontrado.', getRedirect());
      return '';
    }

    $concluidos = $this->model->selecionaBusca('aluno_conclusao', "WHERE data >= '" . $data_inicial . "' AND data <= '" . $data_final . "' AND resultado='aprovado' AND id_curso='" . $id_curso . "' ");

    foreach ($concluidos as &$c) {
      $aluno = $this->aluno->get($c['id_aluno']);
      $c['aluno'] = $aluno[0] ?? [];
    }

    $this->load->view('professor/alunos_aprovados', [
      'aprovacoes' => $concluidos,
      'curso' => $curso,
      'data_inicio' => $data['data_inicio'],
      'data_fim' => $data['data_fim']
    ]);
  }
}
