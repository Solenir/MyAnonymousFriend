<?php

//require_once($_SERVER["DOCUMENT_ROOT"]."/HomeService-master/persistencia/UsuarioDAO.php");
//require_once ($_SERVER["DOCUMENT_ROOT"]."/HomeService-master/application/model/Usuario.php");

require_once(__DIR__."/../util/MostrarErros.php"); // Descomentar para capturar erros

require_once(__DIR__."/../../persistencia/UsuarioDAO.php");
require_once(__DIR__."/../../persistencia/ServicoDAO.php");
require_once(__DIR__."/../../persistencia/QualificacaoServicoDAO.php");
require_once(__DIR__."/../../persistencia/QualificacaoContratanteDAO.php");
require_once(__DIR__."/../../persistencia/RequisicaodeServicoDAO.php");
require_once(__DIR__."/../../persistencia/ContratacaoDAO.php");
require_once (__DIR__."/../../application/model/Contratacao.php");
require_once (__DIR__."/../../application/model/Usuario.php");
require_once (__DIR__."/../../application/model/QualificacaoServico.php");
require_once (__DIR__."/../../application/model/QualificacaoContratante.php");
require_once (__DIR__."/../../application/model/RequisicaoDeServico.php");
require_once(__DIR__."/../../persistencia/MensagemDAO.php");
require_once(__DIR__."/../../persistencia/FavoritoDAO.php");
require_once(__DIR__."/../../application/model/DenunciaServico.php");
require_once(__DIR__."/../../persistencia/DenunciaServicoDAO.php");

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
		public function cadastrar($nome, $email, $senha) {
			return  UsuarioDAO::getInstance()->inserirNovoUsuario( new Usuario($nome,$email,$senha));
		}

		/**
		 * Este método é responsável por solcicitar a atenticação de um usuário no sistema
		 * @param $login login do usuário que deseja acessar o sistema
		 * @param $senha senha do usuário que deseja acessar o sistema
		 * @return bool identifica se a autenticação foi realizada com sucesso
		 */
		public function fazerLogin($login, $senha) {
 			return UsuarioDAO::getInstance()->autenticarUsuario(new Usuario('',$login, '',$senha));

		}

		public function editarPerfil($login, $nome, $email, $telefone, $datadenascimento, $senha) {
			return  UsuarioDAO::getInstance()->EditarPerfil($login, $nome, $email, $telefone, $datadenascimento, $senha);
		}

		/**
		* Esse método busca por serviços cadastrados no sistema
		*
		* @param $servicoNome Nome do serviço buscado
		* @param $latitude Coordenada geográfica latitude
		* @param $longitude Coordenada geográfica longitude
		* @param $pag Index para paginação da busca. Valores inteiros entre 0..(n - 1)
		* @return resposta em JSON representando osserviços encontrados
		*/
		public function buscarServico($servicoNome, $latitude, $longitude, $pag) {
			$limite = 10;
			$resposta = ServicoDAO::getInstance()->buscarServicoComLimite($servicoNome, $latitude, $longitude, $pag, $limite);
			$total = ServicoDAO::getInstance()->buscarServico($servicoNome, $latitude, $longitude);
			$arr = array('pag' => array( 'atual' => $pag,
																	 'total' => (count($resposta) == 0) ? 0 : (ceil( count($total) / $limite ))
																 ),
										'total' => count($total),
										'servicos' => $resposta);
			return json_encode($arr);
		}

		public function recuperarMensagens($idRemetente, $IdDestinatario) {
			$resposta = MensagemDAO::getInstance()->recuperarMensagens(new Mensagem(-1, $idRemetente, $IdDestinatario, '', -1));
			return json_encode($resposta);
		}

		public function inserirMensagem($idRemetente, $IdDestinatario, $mensagem) {
			return MensagemDAO::getInstance()->inserirMensagem(new Mensagem(-1, $idRemetente, $IdDestinatario, $mensagem, date("Y-m-d H:i:s")));
		}

		public function fazerLoginRedeSocial() {
			# code...
		}

		public  function sairDoSistema() {
			unset($_SESSION['logado']);
			unset($_SESSION['ID_Usuario']);
			session_destroy();
			return isset($_SESSION);
		}

			public function recuperarSenha($email) {

		  $resposta = UsuarioDAO::getInstance()->recuperarSenha($email);

			if ($resposta != null) {
				//enviar um email para variavel email juntamente com a variável senha;

				$mensage = "Você solicitou a recuperação de senhha, confira seus dados.";
				$mensage .="E-mail= " . $email;
				$mensage .="Senha:" . $resposta;

				mail($email, "HomeService comunicação, recuperação de senha", $resposta);

				echo "<script>alert('Sua senha foi enviada para o e-mail indicado'.),window.open('recuperarSenha.php','_self')</script>";

				return true;
			}else{

				echo "<script>alert('E-mail não cadastrado em nosso sistema'),window.open('recuperarSenha.php','_self')</script>";
				return false;
			}

		}



		public function acessarConta() {
			# code...
		}

		public function acessarPerfil() {
			# code...
		}

		public function aceitarContratacao($idContratante, $idServico) {

			$data = date ("Y-m-d");

			$contratacao = new Contratacao($idContratante, $idServico, $data, '');

			ContratacaoDAO::getInstance()->removerContratacaoPendente($idServico);

			// Armazena a qualificacao no BD.
			return ContratacaoDAO::getInstance()->inserirContratacao($contratacao);

		}

		public function utilizarBatePapo() {
			# code...
		}

		public function buscaNotificacaoContratacao($idUsuario){

			return ContratacaoDAO::getInstance()->buscaNotificacao($idUsuario);
		}


		public function comprarPlano($idCompra, $quantidade, $precoTotal) {
			return  CompraDAO::getInstance()->InserirCompra( new Compra($idCompra, $quantidade, $precoTotal));
		}

		//Funções de manipulação com as coleções, todas elas devem ser privadas.
		private function buscarUsuario($idUsuario) {

			return json_encode(UsuarioDAO::getInstance()->montarPerfilTopo($idUsuario));


		}

		public function qualificarContratante($idContratante, $idPrestador, $notaDeAvaliacao, $comentario) {
			// Instancia uma qualificacao.
			$qualificacao = new QualificacaoContratante($idContratante, $idPrestador, $notaDeAvaliacao, $comentario);

			// Armazena a qualificacao no BD.
			return QualificacaoContratanteDAO::getInstance()->InserirQualificacaoContratante($qualificacao);
		}

		public function qualificarServico($idServico, $idContratante, $notaDeAvaliacao, $comentario) {
			// Instancia uma qualificacao.
			$qualificacao = new QualificacaoServico($idServico, $idContratante, $notaDeAvaliacao, $comentario);

			// Armazena a qualificacao no BD.
			return QualificacaoServicoDAO::getInstance()->inserirQualificacaoServico($qualificacao);
		}


		public function ofertarServico($categoria,$descricao,$latitude,$longitude) {


			return ServicoDAO::getInstance()->inserirOfertaDeServico(new Servico($categoria,$descricao,$latitude,$longitude));

		}

		public function contratarServico($idPrestador, $idServico, $idContratante) {

			return ContratacaoDAO::getInstance()->contratarServico(new Contratacao($idContratante, $idServico,date ("Y-m-d"),$idPrestador));


		}

		public function editarServico($descricao, $latitude, $longitude) {

			return  ServicoDAO::getInstance()->editarServico($descricao, $latitude, $longitude);
		}

		public function requisitarServico($Titulo, $LocalServ, $descricao, $idUsuario){
			//$novo = new RequisicaodeServicoDAO::getInstance()->InserirRequisicao($requisicao);
			$requisicao = new requisicaoDeServico($Titulo, $LocalServ, $descricao, $idUsuario);
			$novo = RequisicaodeServicoDAO::getInstance()->InserirRequisicao($requisicao);
			if($novo){
				return true;
			}else{
				return false;
			}
		}

		public function aceitarServico() {
			# code...
		}

		//public function editarRequisicaoDeServico() {
			# não precisa
		//}

		public function buscarRequisicoesDeServico($pag){
			$limite = 2;
			$resposta = RequisicaodeServicoDAO::getInstance()->mostrarRequisicaoComOffset($pag, $limite);
			$total = RequisicaodeServicoDAO::getInstance()->getTotalRequisicoes();
			$arr = array('pag' => array( 'atual' => $pag,
																	 'total' => (count($resposta) == 0) ? 0 : (ceil( $total / $limite ))
																 ),
										'total' => $total,
										'servicos' => $resposta);
			return json_encode($arr);
		}

		public function buscarMinhasRequisicoes($idUsuario){

			return RequisicaodeServicoDAO::getInstance()->exibirMinhasRequisicoes($idUsuario);
		}


		public function buscarContratacoes($idPrestador){

			return ContratacaoDAO::getInstance()->exibirContratacao($idPrestador);
		}

		public function buscarContratacoesAceitas($idPrestador){

			return ContratacaoDAO::getInstance()->exibirContratacaoAceitas($idPrestador);
		}

		public function alterarImagem($idUsuario, $name, $tmp_name){

			$login = UsuarioDAO::getInstance()->buscarLogin($idUsuario);

			$permitidas = array(".jpg", ".jpeg",".gif",".png", ".bmp");
			$pasta = (__DIR__.'/../fotosPerfil/');
			$extencao = strchr($name, '.');

			 // Verifica se a extensão está entre as extensões permitidas
			 if (in_array($extencao, $permitidas)) {
					// Move a imagem para a nova pasta e muda o nome.
					if(move_uploaded_file($tmp_name, $pasta.$login.$extencao)) {

		 				return UsuarioDAO::getInstance()->alterarImagem($idUsuario, $pasta.$login.$extencao);
		 			}
			 }

			 return false;
		}

    public function excluirConta($idUsuario){
    	ControladorUsuario::sairDoSistema();
		return UsuarioDAO::getInstance()->excluirConta($idUsuario);
    }


		public function assinarBoletim($email){
			return UsuarioDAO::getInstance()->assinarBoletim($email);

		}

		public function adicionarFotos($idUsuario, $name, $tmp_name, $indice) {

			$login = UsuarioDAO::getInstance()->buscarLogin($idUsuario);

			$permitidas = array(".jpg", ".jpeg",".gif",".png", ".bmp");
			$pasta = (__DIR__.'/../Galerias/');
			$extencao = strchr($name, '.');

			// Verifica se a extensão está entre as extensões permitidas
			if (in_array($extencao, $permitidas)) {
				// Move a imagem para a nova pasta e muda o nome.
				if(move_uploaded_file($tmp_name, $pasta.$login.$indice.$extencao)) {

					return UsuarioDAO::getInstance()->adicionarFotos($idUsuario, $pasta.$login.$indice.$extencao);
				}
			}

			return false;
		}


		public function buscaContratacoesRequisitadas($idContratante){

			return ContratacaoDAO::getInstance()->buscaContratacoesRequisitadas($idContratante);
		}

		public function cancelaContratacao($idContratacao){

			return ContratacaoDAO::getInstance()->removerContratacaoPendente($idContratacao);
		}

		public function favoritarServico($idServico, $idContratante){
			return ServicoDAO::getInstance()->favoritarServico($idServico, $idContratante);
		}




		public  function validarServicoOfertado($idUsuario)
		{


			return ServicoDAO::getInstance()->validarServicoOfertado($idUsuario);

		}

		public function listaFavoritos($idContratante){

			return FavoritoDAO::getInstance()->listaFavoritos($idContratante);
		}
		public function denunciarServico($motivo, $descricao, $idServico, $idUsuario){
			return DenunciaServicoDAO::getInstance()->inserirDenunciaServ(new DenunciaServico($motivo, $descricao, $idServico, $idUsuario));
		}


		public function porcentagemQualificacao($idServico){
			return QualificacaoServicoDAO::getInstance()->porcentagemQualificacao($idServico);
		}


		public function porcentagemQualificacaoContratante($idPerfil){
			return QualificacaoContratanteDAO::getInstance()->porcentagemQualificacaoContratante($idPerfil);
		}



	}
?>
