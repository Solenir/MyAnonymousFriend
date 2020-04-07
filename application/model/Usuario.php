<?php
/**
 * Description of Usuario
 *
 * @author Hélter Cordeiro
 */
class Usuario {
    /**
     * Numero identificador de Usuario.
     * @var integer $id
     */
    private $id;
    /**
     * Nome de usuario.
     * @var string $nome
     */
    private $nome;
    /**
    * Login de Usuario.
    * @var string $login
    */
    private $login;
    /**
     * Armazena o email do usuário
     * @var String email do usuário
     */
    private $email;
    /**
    * Senha de Usuario
    * @var string $senha
    */
    private $senha;
    /**
     * Numero do telefone do Usuario.
     * @var string $telefone
     */
    private $telefone;
    /**
     * Servicos ofertado pelo o usuario.
     * @var Servico $servicos
     */
    private $servicosOfertados;
    private $servicosContratados;

    /**
     * Endereco do usario
     * @var Endereco $endereco
     */
    private $endereco;
    private $nascimento;

    /**
     * Contrutor da classe.

     * @param string $nome Nome do usuario.
     * @param string $login Login de Usuario.
     * @param string $senha Senha de Usuario.
     * @param string $telefone Número do telefone do usuario.
     */


    public function __construct($nome, $login, $senha){
        $this->nome = $nome;
        $this->login = $login;
        $this->senha = $senha;

    }




    public function getNascimento(){
        return $this->nascimento;
    }
    /**
     * Modifica o atributo $id.
     * @param integer $id Novo valor para o atributo.
     */
    public function setId ($id){
        $this->id = $id;
    }
    /**
     * Retorna o valor do atributo $id.
     * @return integer
     */
    public function getId (){
        return $this->id;
    }
    /**
     * Modifica o atributo $nome.
     * @param string $nome Novo valor para o atributo.
     */
    public function setNome($nome){
        $this->nome = $nome;
    }
    /**
     * Retorna o valor do atributo $nome.
     * @return string
     */
    public function getNome(){
        return $this->nome;
    }
    /**
     * Modifica o atributo $senha.
     * @param string $senha Novo valor para o atributo.
     */
    public function setSenha($senha){
        $this->senha = $senha;
    }
    /**
     * Retorna o valor do atributo $senha.
     * @return string
     */
    public function getSenha(){
        return $this->senha;
    }
    /**
     * Modifica o atributo $telefone.
     * @param string $telefone Novo valor para o atributo
     */
    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }
    /**
     * Retorna o valor do atributo $telefone.
     * @return string
     */
    public function getTelefone() {
        return $this->telefone;
    }
    /**
     *
     * @param Endereco $endereco
     */
    public function setEndereco($endereco){
    	$this->endereco = $endereco;
    }
    /**
     *
     * @return Endereco
     */
    public function getEndereco(){
    	return $this->endereco;
    }

    public function getEmail(){
        return $this->email;
    }
    /**
     * Valida a senha e o login, se tiverem validos retorna verdadeiro.
     * @param  string $login Login para login
     * @param  string $senha Senha para login
     * @return boolean falso para errou ou true para tudo ok
     */
    public function fazerLogin($login, $senha) {
    	//analisar melhor
    	if ($this->$login == $login && $this->senha == $senha){
          return true;
        }
        return false;
    }

    public function ofertarServico($servico){
    	$this->servicosOfertados = $servico;
    }
    /*
    public function removerServico($idServico){

    }
    public function buscarServicoOfertados($idServico){
      for ($i = 0; $i < count($this->$servicosOfertados); $i++) {
          if ($idServico == $this->$servicosOfertados[$i]->getId()) {
              return $this->$servicosOfertados[$i];
          }
      }
    }
    public function listarServicosOfertados(){
    	return $this->servicosOfertados;
    }
    */
    public function contratarServico(){

    }
    public function listarServicosContratados(){
    	return $this->servicosContratados;
    }
    public function requisitarServico(){

    }
    public function editarCompromisso(){

    }
    public function finalizarBatePapo(){

    }
    public function aceitarServico(){

    }
    public function alterarFoto(){

    }

    public function getLogin(){
        return $this->login;
    }


}
?>
