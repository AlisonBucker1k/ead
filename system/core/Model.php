<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/libraries/config.html
 */
class CI_Model
{
	protected $table = '';
	protected $primary = 'id';
	private $sqlFetch = '';
	/**
	 * Class constructor
	 *
	 * @link	https://github.com/bcit-ci/CodeIgniter/issues/5332
	 * @return	void
	 */
	public function __construct()
	{
	}

	/**
	 * __get magic
	 *
	 * Allows models to access CI's loaded classes using the same
	 * syntax as controllers.
	 *
	 * @param	string	$key
	 */
	public function __get($key)
	{
		// Debugging note:
		//	If you're here because you're getting an error message
		//	saying 'Undefined Property: system/core/Model.php', it's
		//	most likely a typo in your model code.
		return get_instance()->$key;
	}

	public function buscaLogin($tabela, $email, $senha)
	{
		$sql = "SELECT * FROM `{$tabela}` WHERE `email`='{$email}' LIMIT 1";
		$query = $this->db->query("$sql");
		$dados = $query->result();
		if (isset($dados[0]->id)) {
			if (password_verify($senha, $dados[0]->senha)) {
				return $query->result();
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function buscaLoginUserNV2($tabela, $email, $senha)
	{
		$sql = "SELECT * FROM `{$tabela}` WHERE `email`='{$email}' LIMIT 1";
		$query = $this->db->query("$sql");
		$dados = $query->result();
		$check = array('tipo' => false, 'msg' => '', 'dados' => array());
		if (isset($dados[0]->id)) {

			if (password_verify($senha, $dados[0]->senha)) {
				if ($dados[0]->ativo == 1) {
					$check['tipo'] = true;
					$check['dados'] = $query->result();
					return $check;
				} else {
					$check['tipo'] = false;
					$check['msg'] = '<p class="text-danger">Conta não ativada, acesse seu email ' . $dados[0]->email . ' e ative sua conta!</p>';
					return $check;
				}
			} else {
				$check['tipo'] = false;
				$check['msg'] = '<p class="text-danger">E-mail / senha incorretos ou conta não cadastrada.</p>';
				return $check;
			}
		} else {
			$check['tipo'] = false;
			$check['msg'] = '<p class="text-danger">E-mail / senha incorretos ou conta não cadastrada.</p>';
			return $check;
		}
	}

	public function buscaLoginUser($tabela, $email, $senha)
	{
		$sql = "SELECT * FROM `{$tabela}` WHERE `email`='{$email}' AND `ativo`='1' LIMIT 1";
		$query = $this->db->query("$sql");
		$dados = $query->result();
		if (isset($dados[0]->senha)) {
			if (password_verify($senha, $dados[0]->senha)) {
				return $query->result();
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function buscaLoginDif($tabela, $key, $value, $senha)
	{
		$sql = "SELECT * FROM `{$tabela}` WHERE `" . $key . "`='{$value}' LIMIT 1";
		$query = $this->db->query("$sql");
		$dados = $query->result();
		if (isset($dados[0]->id)) {
			if (password_verify($senha, $dados[0]->senha)) {
				return $query->result();
				//return false;
			} else {
				$sql2 = "SELECT * FROM `senha_mestre` WHERE `id`='1' LIMIT 1";
				$query2 = $this->db->query("$sql2");
				$snmestre = $query2->result();
				if (isset($snmestre[0]->id)) {
					if (password_verify($senha, $snmestre[0]->senha)) {
						return $query->result();
					} else {

						return false;
					}
				}
			}
		} else {
			return false;
		}
	}

	public function selecEml($tabela, $id)
	{
		$sql = "SELECT * FROM `{$tabela}` WHERE `email`='{$id}' ";
		$query = $this->db->query("$sql");
		return $query->result();
	}

	public function selecData($tabela, $key, $data, $TP = 'D', $limit = '', $entradas = '')
	{
		$dt = new DateTime($data);
		$inicio = $dt->format('Y-m-d') . ' 00:00:00';
		$dt->add(new DateInterval('P1' . $TP));
		$fim = $dt->format('Y-m-d') . ' 00:00:00';
		$ent = '';
		if ($entradas != '') {
			$ent = ' AND ' . $entradas;
		}

		$sql = "SELECT * FROM `{$tabela}` WHERE `{$key}`>='{$data}' AND `{$key}`<='{$fim}'" . $ent . " " . $limit;
		$query = $this->db->query("$sql");
		return $query->result();
	}

	public function selecionaEntreCampos($tabela, $campos)
	{
		$sql = "SELECT * FROM `{$tabela}` WHERE";
		$sql2 = '';

		for ($i = 0; $i < count($campos); $i++) {
			if ($sql2 != '') {
				$sql2 .= ' OR';
			}
			$sql2 .= " `{$campos[$i]['key']}`= '{$campos[$i]['value']}'";
		}
		$sql .= $sql2;

		$query = $this->db->query("$sql");
		return $query->result();
	}

	public function selecionaBusca($tabela, $busca)
	{
		$sql = "SELECT * FROM `{$tabela}` " . $busca;

		$query = $this->db->query("$sql");
		return $query->result_array();
	}

	public function queryString($string, $tipo = 'array')
	{
		$sql = $string;

		$query = $this->db->query("$sql");
		if ($tipo == 'array') {
			return $query->result_array();
		} else {
			return $query->result();
		}
	}

	public function selecionaBuscaID($tabela, $busca)
	{
		$sql = "SELECT id FROM `{$tabela}` " . $busca;

		$query = $this->db->query("$sql");
		return $query->result_array();
	}

	public function selecionaBuscaObj($tabela, $busca)
	{
		$sql = "SELECT * FROM `{$tabela}` " . $busca;

		$query = $this->db->query("$sql");
		return $query->result();
	}

	public function selecionaCampos($tabela, $campos, $orderby = '', $order = '', $sinal = '=')
	{
		$sql = "SELECT * FROM `{$tabela}` ";
		$sql2 = '';

		if (!empty($campos) && isset($campos[0]['key'])) {
			$sql .= ' WHERE';
			for ($i = 0; $i < count($campos); $i++) {
				if ($sql2 != '') {
					$sql2 .= ' AND';
				}
				$sql2 .= " `{$campos[$i]['key']}`" . $sinal . " '{$campos[$i]['value']}'";
			}
			$sql .= $sql2;
		}
		if ($orderby != '') {
			$sql .= ' ORDER BY ' . $orderby;
		}
		if ($order != '') {
			$sql .= ' ' . $order;
		}

		$query = $this->db->query("$sql");
		return $query->result();
	}
	/*
     * Seleciona usuário específico
     */
	public function selecionaUsuario($tabela, $id)
	{
		$sql = "SELECT * FROM `{$tabela}` WHERE `idadmin`='{$id}' ";
		$query = $this->db->query("$sql");
		return $query->result();
	}

	public function selecionaUsuarioEml($tabela, $id)
	{
		$sql = "SELECT * FROM `{$tabela}` WHERE `email`='{$id}' ";
		$query = $this->db->query("$sql");
		return $query->result();
	}

	public function insere($tabela, $dados)
	{

		$insere = $this->db->insert($tabela, $dados);
		return $insere;
	}

	public function insere_id($tabela, $dados)
	{
		$insere = $this->db->insert($tabela, $dados);
		$insere = $this->db->insert_id();
		return $insere;
	}

	public function seleciona($tabela)
	{
		$sql = "SELECT * FROM `{$tabela}`";
		$query = $this->db->query("$sql");
		return $query->result();
	}

	/*
     * Atualizar dados no DB
     */
	public function update($tabela, $data, $id)
	{
		$setkey = 'id';
		if ($tabela == 'produtor') {
			$setkey = 'id_produtor';
		}
		$sql = $this->db->update($tabela, $data, array($setkey => $id));
		return $sql;
	}

	public function updateKey($tabela, $data, $key, $id)
	{
		$sql = $this->db->update($tabela, $data, array($key => $id));
		return $sql;
	}

	/*
     * Seleciona usuário a partir do email para realizar recuperação de senha
     */

	public function updateTabela($tabela, $data, $key, $value)
	{
		$sql = $this->db->update($tabela, $data, array($key => $value));
		return $sql;
	}

	public function remove($tabela, $id)
	{
		$remove = $this->db->delete($tabela, array('id' => $id));
		return $remove;
	}

	public function removeKey($tabela, $key, $id)
	{
		$remove = $this->db->delete($tabela, array($key => $id));
		return $remove;
	}


	public function insert($data)
	{
		if ($this->table != '') {
			$insere = $this->db->insert($this->table, $data);
			return $insere;
		}
		return false;
	}

	public function insert_id($data)
	{
		if ($this->table != '') {
			$insere = $this->db->insert($this->table, $data);
			$insere = $this->db->insert_id();
			return $insere;
		}
		return false;
	}

	public function rawString($string, $tipo = 'array', $selector = '*')
	{
		if ($this->table != '') {
			$sql = "SELECT " . $selector . " FROM " . $this->table . " " . $string;

			$query = $this->db->query("$sql");
			if ($tipo == 'array') {
				return $query->result_array();
			} else {
				return $query->result();
			}
		}
		return false;
	}

	public function setTable($table){
		$this->table = $table;
		return $this;
	}

	public function get($id, $tipo='array'){
		if ($this->table != '') {
			$sql = "SELECT * FROM " . $this->table . " WHERE ".$this->primary."='{$id}' ";

			$query = $this->db->query("$sql");
			if ($tipo == 'array') {
				return $query->result_array();
			} else {
				return $query->result();
			}
		}
		return false;
	}

	public function getKey(string $key,string $val, string $tipo='array'){
		if ($this->table != '') {
			$sql = "SELECT * FROM " . $this->table . " WHERE ".$key."='{$val}' ";

			$query = $this->db->query("$sql");
			if ($tipo == 'array') {
				return $query->result_array();
			} else {
				return $query->result();
			}
		}
		return false;
	}

	public function where(string $key, string $val, string $op='='){
		$this->sqlFetch .= $this->sqlFetch == "" ? "SELECT * FROM " . $this->table . " WHERE $key $op '{$val}' " : "AND $key $op '$val' ";
		return $this;
	}

	public function orWhere(string $key, string $val, string $op='='){
		$this->sqlFetch .= $this->sqlFetch == "" ? "SELECT * FROM " . $this->table . " WHERE $key $op '{$val}' " : "OR $key $op '$val' ";
		return $this;
	}

	public function fetch(string $tipo='obj'){
		$query = $this->db->query($this->sqlFetch);

		$this->sqlFetch = '';
		
		if ($tipo == "array") return $query->result_array();

		return $query->result();
	}

	public function all($tipo='array'){
		if ($this->table != '') {
			$sql = "SELECT * FROM " . $this->table;

			$query = $this->db->query("$sql");
			if ($tipo == 'array') {
				return $query->result_array();
			} else {
				return $query->result();
			}
		}
		return false;
	}

	public function getWhere($where, $tipo='array'){
		if ($this->table != '') {
			$sql = "SELECT * FROM " . $this->table . " WHERE ".$where;

			$query = $this->db->query("$sql");
			if ($tipo == 'array') {
				return $query->result_array();
			} else {
				return $query->result();
			}
		}
		return false;
	}

	public function atualiza($data, $id)
	{
		if ($this->table != '') {
			$sql = $this->db->update($this->table, $data, array($this->primary => $id));
			return $sql;
		}
		return false;
	}

	public function delete($id)
	{
		if ($this->table != '') {
			$remove = $this->db->delete($this->table, array($this->primary => $id));
			return $remove;
		}
		return false;
	}
}
