<?php

//require_once($_SERVER["DOCUMENT_ROOT"]."/HomeService-master/persistencia/UsuarioDAO.php");
//require_once ($_SERVER["DOCUMENT_ROOT"]."/HomeService-master/application/model/Usuario.php");


require_once(__DIR__."/../../persistencia/UsuarioDAO.php");


	class ControladorUsuario {



		public function __construct() {

		}

		/**
		 * Este método é responsável por solicitar o cadastro de um usuário. Nele invocamos o Dao
		 * responsável por armazenar os dados do usuario que deseja se cadastrar
		 * @param $nome nome do usuario que deseja ser cadastrado
		 * @param $login login do usuario que deseja ser cadastrado
		 * @param $email email do usuario que deseja ser cadastrado
		 * @param $senha senha do usuario que deseja ser cadastrado
		 * @return bool identifica se o cadastrado foi efetuado com sucesso
		 */
		 public function cadastrar($nome, $login, $senha) {
			 return  UsuarioDAO::getInstance()->inserirNovoUsuario( new Usuario($nome,$login,$senha));
		 }

		/**
		 * Este método é responsável por solcicitar a atenticação de um usuário no sistema
		 * @param $login login do usuário que deseja acessar o sistema
		 * @param $senha senha do usuário que deseja acessar o sistema
		 * @return bool identifica se a autenticação foi realizada com sucesso
		 */
		public function fazerLogin($login, $senha) {
 			return UsuarioDAO::getInstance()->autenticarUsuario(new Usuario('',$login,$senha));

		}




	}
?>
