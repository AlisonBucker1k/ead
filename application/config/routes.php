<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'inicio';
$route['404_override'] = '';
$route['admin/nova_senha/(:any)'] = 'admin/login/nova_senha/$1';
$route['admin/professores/inserir'] = 'admin/professor/insere';
$route['admin/perfil'] = 'admin/administradores/perfil';


//rotas aulas
$route['admin/cursos/aulas/(:any)'] = 'admin/aulas/index/$1';
$route['admin/cursos/getAula/(:num)'] = 'admin/aulas/getAula/$1';
$route['admin/cursos/ativar_aula/(:num)'] = 'admin/aulas/ativar_aula/$1';
$route['admin/cursos/desativar_aula/(:num)'] = 'admin/aulas/desativar_aula/$1';
$route['admin/cursos/mudaAula/(:num)/(:num)'] = 'admin/aulas/mudaAula/$1/$2';
$route['admin/cursos/inserir_aulaAjax'] = 'admin/aulas/inserir_aulaAjax';
$route['admin/cursos/update_aulaAjax/(:num)'] = 'admin/aulas/update_aulaAjax/$1';
$route['admin/cursos/remover_aula/(:num)'] = 'admin/aulas/remover_aula/$1';

//rotas tarefas
$route['admin/cursos/tarefas/(:any)'] = 'admin/tarefas/index/$1';
$route['admin/cursos/tarefas/cadastrar/(:any)'] = 'admin/tarefas/cadastrar/$1';
$route['admin/cursos/tarefas/ativar/(:num)'] = 'admin/tarefas/ativar/$1';
$route['admin/cursos/tarefas/desativar/(:num)'] = 'admin/tarefas/desativar/$1';
$route['admin/cursos/tarefas/editar/(:num)'] = 'admin/tarefas/editar/$1';
$route['admin/cursos/tarefas/remover/(:num)'] = 'admin/tarefas/remover/$1';

//rotas provas
$route['admin/cursos/provas/(:any)'] = 'admin/provas/index/$1';
$route['admin/cursos/provas/cadastrar/(:any)'] = 'admin/provas/cadastrar/$1';
$route['admin/cursos/provas/ativar/(:num)'] = 'admin/provas/ativar/$1';
$route['admin/cursos/provas/desativar/(:num)'] = 'admin/provas/desativar/$1';
$route['admin/cursos/provas/editar/(:num)'] = 'admin/provas/editar/$1';
$route['admin/cursos/provas/remover/(:num)'] = 'admin/provas/remover/$1';

//rotas faq
$route['admin/faq/ead'] = 'admin/faq/index/ead';
$route['admin/faq/professor'] = 'admin/faq/index/professor';
$route['admin/faq/rede'] = 'admin/faq/index/rede';


/*PROFESSOR*/
//rotas aulas
$route['professor/cursos/aulas/(:any)'] = 'professor/aulas/index/$1';
$route['professor/cursos/getAula/(:num)'] = 'professor/aulas/getAula/$1';
$route['professor/cursos/ativar_aula/(:num)'] = 'professor/aulas/ativar_aula/$1';
$route['professor/cursos/desativar_aula/(:num)'] = 'professor/aulas/desativar_aula/$1';
$route['professor/cursos/mudaAula/(:num)/(:num)'] = 'professor/aulas/mudaAula/$1/$2';
$route['professor/cursos/inserir_aulaAjax'] = 'professor/aulas/inserir_aulaAjax';
$route['professor/cursos/update_aulaAjax/(:num)'] = 'professor/aulas/update_aulaAjax/$1';
$route['professor/cursos/remover_aula/(:num)'] = 'professor/aulas/remover_aula/$1';

//rotas tarefas
$route['professor/cursos/tarefas/(:any)'] = 'professor/tarefas/index/$1';
$route['professor/cursos/tarefas/cadastrar/(:any)'] = 'professor/tarefas/cadastrar/$1';
$route['professor/cursos/tarefas/ativar/(:num)'] = 'professor/tarefas/ativar/$1';
$route['professor/cursos/tarefas/desativar/(:num)'] = 'professor/tarefas/desativar/$1';
$route['professor/cursos/tarefas/editar/(:num)'] = 'professor/tarefas/editar/$1';
$route['professor/cursos/tarefas/remover/(:num)'] = 'professor/tarefas/remover/$1';

//rotas provas
$route['professor/cursos/provas/(:any)'] = 'professor/provas/index/$1';
$route['professor/cursos/provas/cadastrar/(:any)'] = 'professor/provas/cadastrar/$1';
$route['professor/cursos/provas/ativar/(:num)'] = 'professor/provas/ativar/$1';
$route['professor/cursos/provas/desativar/(:num)'] = 'professor/provas/desativar/$1';
$route['professor/cursos/provas/editar/(:num)'] = 'professor/provas/editar/$1';
$route['professor/cursos/provas/remover/(:num)'] = 'professor/provas/remover/$1';

/* REDE */
//rota nova conta
$route['rede/nova_conta'] = 'rede/LinkCadastro/nova_conta';

$route['rede/visualizar'] = 'rede/network/visualizar';
$route['rede/visualizar/(:any)'] = 'rede/network/visualizar/$1';
$route['rede/unilevel'] = 'rede/network/unilevel';
$route['rede/unilevel/(:any)'] = 'rede/network/unilevel/$1';
$route['rede/meus_diretos'] = 'rede/network/meus_diretos';

$route['rede/dependentes/(:any)'] = 'rede/familiares/$1';

/* ALUNOS */
//rota alunos cursos
$route['ead/cursos'] = 'ead/cursos/index';
$route['ead/cursos/'] = 'ead/cursos/index';
$route['ead/cursos/meusCursos'] = 'ead/cursos/meusCursos';
$route['ead/cursos/meusCursos/'] = 'ead/cursos/meusCursos';
$route['ead/cursos/concluidos'] = 'ead/cursos/concluidos';
$route['ead/cursos/(:any)'] = 'ead/cursos/visualizar/$1';

$route['ead/aula/(:num)/(:any)'] = 'ead/aula/index/$1/$2';

$route['ead/tarefas/(:any)'] = 'ead/tarefas/index/$1';
$route['ead/provas/(:any)'] = 'ead/provas/index/$1';

$route['ead/certificado_de_conclusao/(:any)'] = 'ead/certificado_de_conclusao/index/$1';


$route['translate_uri_dashes'] = FALSE;
