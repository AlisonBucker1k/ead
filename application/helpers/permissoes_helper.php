<?php

if (!function_exists('getOrInsertOnSession')) {
    function getOrInsertOnSession($f, $action = 'listar')
    {
        $CI = &get_instance();

        $permissao = $CI->session->userdata($f . '_' . $action);

        if ($permissao == "") {
            $adm = $CI->model->setTable('admin')
                ->get($CI->session->userdata('id'));

            if (!$adm) return false;

            $field = $CI->model->setTable('fields')
                ->where('nome', $f)
                ->fetch('array');

            if (!$field) return true;

            $search = $CI->model->setTable('permissoes')
                ->where('id_cargo', $adm[0]['id_cargo'])
                ->where('id_field', $field[0]['id'])
                ->where('action', $action)
                ->fetch('array');

            if ($search) {
                $CI->session->set_userdata([
                    $f . '_' . $action => 2
                ]);
                return true;
            }
            $CI->session->set_userdata([
                $f . '_' . $action => 1
            ]);
            return false;
        } else if ($permissao == 2){
            return true;
        }
        return false;
    }
}


if (!function_exists('buscaPermissoes')) {
    #$field => campo de busca (admin, curso, aluno, professor... etc.)
    #$action => tipo de ação (listar, cadastro, editar, remover... etc.)

    ###############################################
    # PADRÃO DE INSERÇÃO DE PERMISSÃO #
    ###############################################
    ### listar
    ### cadastro
    ### editar
    ### remover
    ###############################################
    # INSERIR PERMISSÕES OPCIONAIS AQUI #
    ###############################################
    #
    #
    #
    #
    function buscaPermissao($field, $action = 'listar')
    {
        return getOrInsertOnSession($field, $action);
    }
}


# RETORNA AS POSSÍVEIS AÇÕES DE UM FIELD
#
#
#
function getActions($field)
{
    switch ($field) {
        case 'rede':
            return [
                'visualizar',
                'configurar',
                'administrar'
            ];
            break;
        case 'saque':
            return [
                'listar',
                'administrar',
            ];
            break;
        case 'senha':
            return [
                'editar',
            ];
            break;
        default:
            return [
                'listar',
                'cadastro',
                'editar',
                'remover'
            ];
    }
    return null;
}











######################################################################################
# GERADOR MENU FOOTER
######################################################################################


# GERA O MENU DO FOOTER
#
#
#
function geraMenuFooter($permissoes, $menus)
{
    $headings = getHeadings();
    $actualH = 0;
    $endheading = false;
    $menuFooter = '';
    for ($i = 0; $i < count($menus); $i++) {
        if (
            isset($headings[$actualH])
            && $headings[$actualH]['start'] == $i
        ) {
            if ($actualH > 0) {
                $menuFooter .= '</ul>';
            }
            $menuFooter .= $headings[$actualH]['h'];
            $endheading = true;
            $actualH++;
        }

        $menuFooter .= geraMenu($i, $menus[$i]['f'], $menus[$i]['c'], $permissoes);
    }
    if ($endheading) $menuFooter .= '</ul>';

    return $menuFooter;
}



# RETORNA O MENU DO FOOTER
#
#
#
function getFooterNavbar()
{
    $CI = &get_instance();
    $adm = $CI->model->selecionaBusca('admin', "WHERE id='" . $CI->session->userdata('id') . "' ");

    if (!$adm) return '';

    $permissoes = $CI->model->selecionaBusca('permissoes', "WHERE id_cargo='" . $adm[0]['id_cargo'] . "' ");

    if (!$permissoes) return '';

    $setP = [];
    foreach ($permissoes as $p) {
        $setP[$p['id_field']][$p['action']] = true;
    }
    return geraMenuFooter($setP, getMenuAdminFields());
}

# RETORNA OS HEADINGS DE CADA MENU
#
#
function getHeadings()
{
    $headings = [
        [
            'h' => '<div class="sidebar-heading">Navegação</div><ul class="sidebar-menu">
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="' . site_url('admin/index'), '">
                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">home</span>
                            <span class="sidebar-menu-text">Inicio</span>
                        </a>
                    </li>',
            'start' => 0
        ],
        [
            'h' => '<div class="sidebar-heading">Cursos</div><ul class="sidebar-menu">',
            'start' => 4
        ],
        [
            'h' => '<div class="sidebar-heading"></div><ul class="sidebar-menu">',
            'start' => 7
        ],
        [
            'h' => '<div class="sidebar-heading">Extras</div><ul class="sidebar-menu">',
            'start' => 10
        ]
    ];
    return $headings;
}


# RETORNA OS FIELDS DO MENU INFERIOR FORMATADOS
#
#
# AO ALTERAR O MENU DO ADMIN, ALTERAR AQUI!
function getMenuAdminFields()
{
    return [ #array de menus
        [ #MENU 1 - ADMINISTRADORES
            'f' => 1, #ID DO FIELD CORRESPONDENTE NO BANCO DE DADOS
            'a' => 'listar', #PERMISSÃO NECESSÁRIA PRO MENU PRINCIPAL APARECER
            'c' => [
                'listar',      #PERMISSÃO NECESSÁRIA PRO MENU SECUNDÁRIO 1 (LISTAR ADMINISTRADORES)
                'cadastro',    #PERMISSÃO NECESSÁRIA PRO MENU SECUNDÁRIO 2 (CADASTRAR ADMINISTRADOR)
                'listar',      #PERMISSÃO NECESSÁRIA PRO MENU SECUNDÁRIO 3 (LISTAR CARGOS)
                'cadastro'     #PERMISSÃO NECESSÁRIA PRO MENU SECUNDÁRIO 4 (CADASTRAR CARGO)
            ]
        ],
        [ #MENU 2 - PROFESSORES
            'f' => 3,
            'a' => 'listar',
            'c' => [
                'listar',
                'cadastro'
            ]
        ],
        [ #MENU 3 - ALUNOS
            'f' => 2,
            'a' => 'listar',
            'c' => [
                'listar',
                'cadastro'
            ]
        ],
        [ #MENU 4 - MENSAGENS AVA
            'f' => 11,
            'a' => 'listar',
            'c' => [
                'listar',
                'cadastro'
            ]
        ],
        [ #MENU 5 - MODALIDADE
            'f' => 5,
            'a' => 'listar',
            'c' => [
                'listar',
                'cadastro',
                'listar',
                'cadastro'
            ]
        ],
        [ #MENU 6 - CURSOS
            'f' => 4,
            'a' => 'listar',
            'c' => [
                'listar',
                'cadastro'
            ]
        ],
        [ #MENU 7 - PROVAS E TAREFAS
            'f' => 4,
            'a' => 'editar',
            'c' => [
                'editar',
                'editar'
            ]
        ],
        [ #MENU 8 - REDE
            'f' => 6,
            'a' => 'visualizar',
            'c' => [
                'configurar',
                'configurar',
                'administrar',
                'administrar',
                'visualizar',
                'visualizar'
            ]
        ],
        [ #MENU 9 - SAQUES
            'f' => 7,
            'a' => 'listar',
            'c' => [
                'listar',
                'listar'
            ]
        ],
        [ #MENU 10 - SERVIÇOS
            'f' => 8,
            'a' => 'listar',
            'c' => [
                'cadastro',
                'cadastro',
                'listar',
                'listar',
                'cadastro'
            ]
        ],
        [ #MENU 11 - SENHA MESTRE
            'f' => 9,
            'a' => 'editar',
            'c' => [
                'editar',
            ]
        ],
        [ #MENU 12 - FAQS
            'f' => 10,
            'a' => 'listar',
            'c' => [
                'listar',
                'listar',
                'listar'
            ]
        ]
    ];
}

#####################################################################################
# GERA O MENU DO ADMIN
#####################################################################################
# ADCIONAR NOVAS ENTRADAS AQUI
#
#
# ENVIAR AS PERMISSÕES REQUERIDAS NA FUNÇÃO DE CIMA /\ (getMenuAdminFields())
function geraMenu($modMenu, $id_field, $permissoes_requeridas, $permissoes_submenus)
{
    $title = "";
    $submenu = "";
    switch ($modMenu) {
        case 0:
            if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[0]])
            ||  isset($permissoes_submenus[$id_field][$permissoes_requeridas[1]])
            ||  isset($permissoes_submenus[$id_field][$permissoes_requeridas[2]])
            ||  isset($permissoes_submenus[$id_field][$permissoes_requeridas[3]])):
                $title = '<span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">supervisor_account</span>
                    Administradores
                    <span class="ml-auto sidebar-menu-toggle-icon"></span>';
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[0]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="' . site_url('admin/administradores') . '">
                                <span class="sidebar-menu-text">Listar administradores</span>
                            </a>
                        </li>';
                }
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[1]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="' . site_url('admin/administradores/cadastrar') . '">
                            <span class="sidebar-menu-text">Cadastrar administrador</span>
                        </a>
                    </li>';
                }
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[2]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="' . site_url('admin/administradores/cargos') . '">
                            <span class="sidebar-menu-text">Listar cargos</span>
                        </a>
                    </li>';
                }
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[3]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="' . site_url('admin/administradores/cadastrar_cargo') . '">
                            <span class="sidebar-menu-text">Cadastrar cargo</span>
                        </a>
                    </li>';
                }
            endif;
            break;
        case 1:
            if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[0]])
            ||  isset($permissoes_submenus[$id_field][$permissoes_requeridas[1]])):
                $title = '<span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">format_shapes</span>
                        Professores
                        <span class="ml-auto sidebar-menu-toggle-icon"></span>';
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[0]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="' . site_url('admin/professor') . '">
                                <span class="sidebar-menu-text">Listar professores</span>
                            </a>
                        </li>';
                }
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[1]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="' . site_url('admin/professor/cadastrar') . '">
                                <span class="sidebar-menu-text">Cadastrar professor</span>
                            </a>
                        </li>';
                }
            endif;
            break;
        case 2:
            if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[0]])
            ||  isset($permissoes_submenus[$id_field][$permissoes_requeridas[1]])):
                $title = '<span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">school</span>
                    Alunos
                    <span class="ml-auto sidebar-menu-toggle-icon"></span>';
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[0]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="' . site_url('admin/alunos') . '">
                                <span class="sidebar-menu-text">Listar alunos</span>
                            </a>
                        </li>';
                }
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[1]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="' . site_url('admin/alunos/cadastrar') . '">
                                <span class="sidebar-menu-text">Cadastrar aluno</span>
                            </a>
                        </li>';
                }
            endif;
            break;
        case 3:
            if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[0]])
            ||  isset($permissoes_submenus[$id_field][$permissoes_requeridas[1]])):
                $title = '<span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">message</span>
                    Mensagens AVA
                    <span class="ml-auto sidebar-menu-toggle-icon"></span>';
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[0]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="' . site_url('admin/mensagens') . '">
                                <span class="sidebar-menu-text">Listar mensagens</span>
                            </a>
                        </li>';
                }
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[1]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="' . site_url('admin/mensagens/cadastrar') . '">
                                <span class="sidebar-menu-text">Cadastrar mensagem</span>
                            </a>
                        </li>';
                }
            endif;
            break;
        case 4:
            if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[0]])
            ||  isset($permissoes_submenus[$id_field][$permissoes_requeridas[1]])):
                $title = '<span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">dvr</span>
                    Modalidades
                    <span class="ml-auto sidebar-menu-toggle-icon"></span>';
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[0]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="' . site_url('admin/modalidades') . '">
                                <span class="sidebar-menu-text">Listar modalidades</span>
                            </a>
                        </li>';
                }
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[1]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="' . site_url('admin/modalidades/cadastrar') . '">
                                <span class="sidebar-menu-text">Cadastrar modalidade</span>
                            </a>
                        </li>';
                }
            endif;
            break;
        case 5:
            if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[0]])
            ||  isset($permissoes_submenus[$id_field][$permissoes_requeridas[1]])):
                $title = '<span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">class</span>
                    Cursos
                    <span class="ml-auto sidebar-menu-toggle-icon"></span>';
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[0]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="' . site_url('admin/cursos') . '">
                                <span class="sidebar-menu-text">Listar cursos</span>
                            </a>
                        </li>';
                }
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[1]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="' . site_url('admin/cursos/cadastrar') . '">
                                <span class="sidebar-menu-text">Cadastrar cursos</span>
                            </a>
                        </li>';
                }
            endif;
            break;
        case 6:
            if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[0]])
            ||  isset($permissoes_submenus[$id_field][$permissoes_requeridas[1]])):
                $title = '<span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">import_contacts</span>
                    Provas e tarefas
                    <span class="ml-auto sidebar-menu-toggle-icon"></span>';
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[0]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" data-toggle="modal" data-target="#modal_tarefas_admin1" href="javascript:void(0)">
                                <span class="sidebar-menu-text">Tarefas</span>
                            </a>
                        </li>';
                }
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[1]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" data-toggle="modal" data-target="#modal_provas_admin1" href="javascript:void(0)">
                                <span class="sidebar-menu-text">Provas</span>
                            </a>
                        </li>';
                }
            endif;
            break;
        case 7:
            if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[0]])
            ||  isset($permissoes_submenus[$id_field][$permissoes_requeridas[1]])
            ||  isset($permissoes_submenus[$id_field][$permissoes_requeridas[2]])
            ||  isset($permissoes_submenus[$id_field][$permissoes_requeridas[3]])
            ||  isset($permissoes_submenus[$id_field][$permissoes_requeridas[4]])
            ||  isset($permissoes_submenus[$id_field][$permissoes_requeridas[5]])):
                $title = '<span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">graphic_eq</span>
                    
                    <span class="ml-auto sidebar-menu-toggle-icon"></span>';
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[0]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="' . site_url('admin/rede/configuracoes') . '">
                                <span class="sidebar-menu-text">Configurações</span>
                            </a>
                        </li>';
                }
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[1]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="' . site_url('admin/rede/planos') . '">
                                <span class="sidebar-menu-text">Planos</span>
                            </a>
                        </li>';
                }
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[2]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="' . site_url('admin/rede/listar_usuarios') . '">
                                <span class="sidebar-menu-text">Listar usuários</span>
                            </a>
                        </li>';
                }
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[3]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="' . site_url('admin/rede/ativar_usuarios') . '">
                                <span class="sidebar-menu-text">Ativar usuários</span>
                            </a>
                        </li>';
                }
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[4]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="' . site_url('admin/rede/unilevel') . '">
                                <span class="sidebar-menu-text">Unilevel</span>
                            </a>
                        </li>';
                }
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[5]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="' . site_url('admin/rede/visualizar') . '">
                                <span class="sidebar-menu-text">Visualizar</span>
                            </a>
                        </li>';
                }
            endif;
            break;
        case 8:
            if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[0]])
            ||  isset($permissoes_submenus[$id_field][$permissoes_requeridas[1]])):
                $title = '<span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">local_atm</span>
                    Saques
                    <span class="ml-auto sidebar-menu-toggle-icon"></span>';
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[0]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="' . site_url('admin/saques/em_aberto') . '">
                                <span class="sidebar-menu-text">Saques em aberto</span>
                            </a>
                        </li>';
                }
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[1]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="' . site_url('admin/saques/concluidos') . '">
                                <span class="sidebar-menu-text">Saques concluídos</span>
                            </a>
                        </li>';
                }
            endif;
            break;
        case 9:
            if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[0]])
            ||  isset($permissoes_submenus[$id_field][$permissoes_requeridas[1]])
            ||  isset($permissoes_submenus[$id_field][$permissoes_requeridas[2]])
            ||  isset($permissoes_submenus[$id_field][$permissoes_requeridas[3]])
            ||  isset($permissoes_submenus[$id_field][$permissoes_requeridas[4]])
            ) :
                $title = '<span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">assignment_ind</span>
                    Serviços
                    <span class="ml-auto sidebar-menu-toggle-icon"></span>';
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[0]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="' . site_url('admin/fornecedores/cadastrar') . '">
                                <span class="sidebar-menu-text">Cadastrar Fornecedor</span>
                            </a>
                        </li>';
                }
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[1]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="' . site_url('admin/servicos/cadastrar') . '">
                                <span class="sidebar-menu-text">Cadastrar Serviço</span>
                            </a>
                        </li>';
                }
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[2]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="' . site_url('admin/fornecedores') . '">
                                <span class="sidebar-menu-text">Listar Fornecedores</span>
                            </a>
                        </li>';
                }
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[3]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="' . site_url('admin/servicos') . '">
                                <span class="sidebar-menu-text">Listar Serviços</span>
                            </a>
                        </li>';
                }
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[4]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="' . site_url('admin/fornecedores/cadastrarContrato') . '">
                                <span class="sidebar-menu-text">Contratos</span>
                            </a>
                        </li>';
                }
            endif;
            break;
        case 10:
            if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[0]])){
                $title = '<span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">https</span>
                    Senha Mestre
                    <span class="ml-auto sidebar-menu-toggle-icon"></span>';
                $submenu .= '<li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="' . site_url('admin/senha_mestre') . '">
                            <span class="sidebar-menu-text">Alterar</span>
                        </a>
                    </li>';
            }
            break;
        case 11:
            if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[0]])
            ||  isset($permissoes_submenus[$id_field][$permissoes_requeridas[1]])
            ||  isset($permissoes_submenus[$id_field][$permissoes_requeridas[2]])
            ) :
                $title = '<span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">help_outline</span>
                    FAQ
                    <span class="ml-auto sidebar-menu-toggle-icon"></span>';
                // if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[0]])) {
                //     $submenu .= '<li class="sidebar-menu-item">
                //             <a class="sidebar-menu-button" href="' . site_url('admin/faq/rede') . '">
                //                 <span class="sidebar-menu-text"></span>
                //             </a>
                //         </li>';
                // }
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[1]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="' . site_url('admin/faq/professor') . '">
                                <span class="sidebar-menu-text">Professores</span>
                            </a>
                        </li>';
                }
                if (isset($permissoes_submenus[$id_field][$permissoes_requeridas[2]])) {
                    $submenu .= '<li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="' . site_url('admin/faq/ead') . '">
                                <span class="sidebar-menu-text">EAD</span>
                            </a>
                        </li>';
                }
            endif;
            break;
        default:
            $submenu .= '';
    }
    $texto = '<li class="sidebar-menu-item">
                    <a class="sidebar-menu-button js-sidebar-collapse" data-toggle="collapse" href="#menu' . $modMenu . '">
                    ' . $title . '
                    </a>
                    <ul class="sidebar-submenu collapse sm-indent" id="menu' . $modMenu . '">
                        ' . $submenu . '
                    </ul>
                </li>';
    return $texto;
}
