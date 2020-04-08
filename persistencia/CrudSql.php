<?php
/**
 * Esta classe contém os scripts que serão utilizados pelo DAO
 */
class CrudSql
{

    private static $instance;

    private function __construct()
    {

    }

    public static function getInstance()
    {

        if (!isset(self::$instance)) {
            self::$instance = new CrudSql();
        }

        return self::$instance;
    }

    public function inserirNovoUsuario()
    {
        return "INSERT INTO USUARIO (Nome,Login,Senha,Logado) VALUES (?, ?, ?, ?)";
    }

    public function autenticarUsuario()
    {
        return "SELECT ID_Usuario, Nome, Login, Senha  FROM USUARIO WHERE Login = ?";
    }

    public function verificarCadastro()
    {
        return "SELECT Login FROM usuario WHERE Login= ?";
    }
    public function verificaAvaliarContratante(){
        return "SELECT * FROM CONTRATACAO WHERE idContratante = ?";
    }

    public function montarPerfilTopo()
    {
        return "SELECT Nome, Login, Email, FotoDoPerfil  FROM USUARIO WHERE ID_Usuario = ?";
    }

    public function montarPerfil() {
        return "SELECT * FROM USUARIO WHERE ID_Usuario = ?";
    }

    public function buscarIdUsuario()
    {
        return "SELECT ID_Usuario FROM USUARIO WHERE Login = ?";
    }

    public function buscarUsuario()
    {
        return "SELECT ID_Usuario FROM USUARIO WHERE Login = ?"; //Este método é semelhante ao que eu fiz acima
    }

    public function inserirOfertaDeServico()
    {
        return "INSERT INTO SERVICO (Categoria, Descricao, Latitude, Longitude, idUsuario) VALUES (?, ?, ?, ?, ?)";
    }

    public function inserirQualificacaoContratante() {
        return "INSERT INTO QUALIFICACAOCON (notaDeAvaliacao, comentario, idContratante, idPrestador) VALUES (?, ?, ?, ?)";
    }

    public function buscarQualificacaoContratante()
    {
        return "SELECT * FROM QUALIFICACAOCON WHERE ID_Usuario = ?";
    }

    public function atualizarQualificacaoContratante()
    {

    }

    public function inserirQualificacaoServico() {
        return "INSERT INTO QUALIFICACAOSERV (notaDeAvaliacao, comentario, idServico, idContratante) VALUES (?, ?, ?, ?)";
    }

    public function buscarQualificacaoServico()
    {
        return "SELECT * FROM QUALIFICACAOSERV WHERE ID_Servico = ?";
    }

    public function atualizarQualificacaoServico()
    {

    }

    public function buscarServico()
    {
        return "SELECT * FROM SERVICO WHERE idUsuario = ?";
    }

    public function buscarServicosComOffset($servicoNome, $latitude, $longitude, $raio, $pag, $limite) {
			$query = sprintf("SELECT SERVICO.ID_Servico, SERVICO.Categoria AS Titulo, SERVICO.Descricao, SERVICO.Latitude, SERVICO.Longitude,
			SERVICO.idUsuario, USUARIO.ID_Usuario, USUARIO.Nome, USUARIO.Telefone, USUARIO.Email, USUARIO.FotoDoPerfil,
			MAISVISIBILIDADE.idUsuario AS IdMaisVisibilidadeUsuario,
			( 6371 * acos( cos( radians('%s') ) * cos( radians( SERVICO.Latitude ) ) *
			cos( radians( SERVICO.Longitude ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( SERVICO.Latitude ) ) ) ) AS distance
			FROM SERVICO, USUARIO
			LEFT OUTER JOIN MAISVISIBILIDADE ON USUARIO.ID_Usuario = MAISVISIBILIDADE.idUsuario
			WHERE SERVICO.Categoria LIKE '%%%s%%' AND SERVICO.idUsuario = USUARIO.ID_Usuario
			HAVING distance < '%s'
			ORDER BY ISNULL(MAISVISIBILIDADE.idUsuario) ASC, distance ASC
			LIMIT %s , %s",
				$latitude,
				$longitude,
				$latitude,
				$servicoNome,
				$raio,
				$pag * $limite,
				$limite);
			return $query;
    }



    public function inserirRequisicao()
    {
        return "INSERT INTO REQUISICAOSERVICO (Titulo,LocalServ,Descricao,idUsuario) VALUES (?, ?, ?, ?)";
    }

		// Usado atualmente somente para contar o total de rows para a paginação
    public function exibirRequisicaoGeral(){
        return "SELECT * FROM REQUISICAOSERVICO order by ID_Requisicao desc";
    }

    public function exibirRequisicaoGeralComOffset($offset, $limite){
        return sprintf("SELECT REQUISICAOSERVICO.*, USUARIO.Nome
												FROM REQUISICAOSERVICO, USUARIO
												WHERE REQUISICAOSERVICO.idUsuario = USUARIO.ID_Usuario
												ORDER BY REQUISICAOSERVICO.ID_Requisicao DESC
												LIMIT %s , %s",
												$offset * $limite,
												$limite);
    }

    public function inserirContratacao() {
        return "INSERT INTO CONTRATACAO (idContratante, idServico, data) VALUES (?, ?, ?)";
    }
    public function inserirMensagem() {
        return "INSERT INTO MENSAGEM(idRemetente, idDestinatario, Texto, HoraMensagem) VALUES(?, ?, ?, ?)";
    }

    public function buscarMensagem(){
				return "SELECT MENSAGEM.ID_Mensagem, MENSAGEM.idRemetente, MENSAGEM.idDestinatario, MENSAGEM.Texto, MENSAGEM.HoraMensagem,
								USUARIO.ID_Usuario, USUARIO.Nome AS NomeDestinatario
								FROM MENSAGEM
								INNER JOIN USUARIO ON USUARIO.ID_Usuario = MENSAGEM.idDestinatario
								WHERE MENSAGEM.idRemetente = ? AND MENSAGEM.idDestinatario = ? OR
											MENSAGEM.idRemetente = ? AND MENSAGEM.idDestinatario = ? ORDER BY MENSAGEM.ID_Mensagem";
    }

    public function editarPerfil() {
        return "UPDATE USUARIO SET Login = ?, Nome = ?, Email = ?, Telefone = ?, DataDeNascimento = ?, Senha = ? WHERE ID_Usuario = ?";
    }
	  public function recuperarSenha() {
      return "SELECT * FROM USUARIO WHERE Email = ?";
    }

    public function alterarSenha() {
      return "UPDATE USUARIO SET Senha = ? WHERE Email = ?";
    }


    public function exibirRequisicaoIndex() {
        return "SELECT * FROM REQUISICAOSERVICO ORDER BY RAND() LIMIT 3";
    }

    public function buscarNome(){
        return "SELECT Nome FROM USUARIO WHERE ID_Usuario = ?";
    }


    public function exibirServico(){
        return "SELECT * FROM SERVICO WHERE ID_Servico= ?";
    }

    public function exibirContratacoes() {
        return "SELECT * FROM CONTRATACAOPENDENTE WHERE idPrestador = ? order by ID_ContratacaoPendente desc";
    }

    public function excluirUsuario() {
        return "DELETE FROM USUARIO WHERE ID_Usuario = ?";
    }

    public function buscarLogin() {

       return "SELECT Login FROM USUARIO WHERE ID_Usuario = ?";
   }




   public function listaFavoritos(){
       return "SELECT * FROM FAVORITOS WHERE idContratante = ? order by ID_Favorito desc";
   }



   public function buscaIdPrestador(){
       return "SELECT idUsuario FROM SERVICO WHERE ID_Servico = ?";
   }

    public   function exibirMinhasRequisicoes(){
        return "SELECT * FROM REQUISICAOSERVICO WHERE idUsuario = ? order by ID_Requisicao desc";

    }

    public function buscaCountNotificacao(){

        return "SELECT * FROM notificacaocontracacao WHERE idContratacao in (SELECT ID_Contratacao FROM CONTRATACAO WHERE idContratante = ? ) and Status = 0";
    }

    public function buscaServNotificacao(){
        return "SELECT * FROM SERVICO WHERE ID_Servico IN(SELECT idServico FROM CONTRATACAO WHERE ID_Contratacao = ?)";
    }





    public function buscarTodosUsuarios(){
        return "SELECT * FROM USUARIO ORDER BY ID_Usuario DESC";
    }

    public function verificarAssociacao(){
        return "SELECT * FROM CONTRATACAO WHERE idContratante = ? and idServico = ?";
    }

}

?>
