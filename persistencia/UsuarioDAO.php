<?php
/***/

require_once ('Conexao.php');
require_once ('CrudSql.php');
if(!isset($_SESSION)){
  session_start();
}

require_once ('Criptografia.php');
//require_once ($_SERVER["DOCUMENT_ROOT"]."/HomeService-master/application/model/Usuario.php");
require_once (__DIR__."/../application/model/Usuario.php");


class UsuarioDAO {
   private static $instance;

  private function __construct()
  {

  }

  public static function getInstance(){
    if(!isset(self::$instance)){
        self::$instance = new UsuarioDAO();
    }
    return self::$instance;
  }


  public function inserirNovoUsuario($usuario){
    $stmt = Conexao::getInstance()->prepare(CrudSql::getInstance()->verificarCadastro());
    $stmt->bindValue(1,$usuario->getLogin());
    $stmt->execute();
    $linha = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($linha > 0){
      return false;
    }

    try{
    $stmt = Conexao::getInstance()->prepare(CrudSql::getInstance()->inserirNovoUsuario());
    $stmt->bindValue(1,$usuario->getNome());
    $stmt->bindValue(2, $usuario->getLogin());
    $stmt->bindValue(3,$usuario->getEmail());
    $stmt->bindValue(4,Criptografia::hash($usuario->getSenha()));
    $stmt->execute();

    $_SESSION['ID_Usuario'] = $this->buscarIdUsuario($usuario->getLogin())['ID_Usuario'];

    return true;

    }
    catch (PDOException $ex){
      return false;
    }

  }


  public function autenticarUsuario($usuario){
    $stmt = Conexao::getInstance()->prepare(CrudSql::getInstance()->autenticarUsuario());
    $stmt->bindValue(1, $usuario->getLogin());
    $stmt->execute();
    $linha = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($linha > 0){

      if(Criptografia::check($usuario->getSenha(), $linha['Senha'])){
        $_SESSION['ID_Usuario'] = $linha['ID_Usuario'];
        return true;
      }

    }
    return false;
  }

  public function buscarIdUsuario($loginUsuario){
    $stmt = Conexao::getInstance()->prepare(CrudSql::getInstance()->buscarIdUsuario());
    $stmt->bindValue(1,$loginUsuario);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function montarPerfilTopo($idUsuario){
    $stmt = Conexao::getInstance()->prepare(CrudSql::getInstance()->montarPerfilTopo());
    $stmt->bindValue(1, $idUsuario);
    $stmt->execute();
    return json_encode($stmt->fetch(PDO::FETCH_ASSOC));

  }

  public function montarPerfil($idUsuario){
    $stmt = Conexao::getInstance()->prepare(CrudSql::getInstance()->montarPerfil());
    $stmt->bindValue(1, $idUsuario);
    $stmt->execute();
    return json_encode($stmt->fetch(PDO::FETCH_ASSOC));

  }


  public function buscarUsuario($login){
    $query = Conexao::getInstance()->prepare(CrudSql::getInstance()->buscarUsuario());
    $query->bindValue(1, $login);
    $query->execute();
    $linha = $query->fetch(PDO::FETCH_ASSOC);

    return $linha[0];
  }

  public function recuperarSenha($email) {

    $stmt = Conexao::getInstance()->prepare(CrudSql::getInstance()->recuperarSenha());
    $stmt->bindValue(1, $email);
    $stmt->execute();

    $linha = $stmt->fetch(PDO::FETCH_ASSOC);

    if($linha > 1){

     return  $this->alterarSenha($email);
   }

    return null;
 }

 public function editarPerfil($login, $nome, $email, $telefone, $datadenascimento, $senha){

    try{
      $conexao = Conexao::getInstance();//verificar
      $stmt = $conexao->prepare(CrudSql::getInstance()->editarPerfil());

      $stmt->bindValue(1,$login);
      $stmt->bindValue(2, $nome);
      $stmt->bindValue(3,$email);
      $stmt->bindValue(4,$telefone);
      $stmt->bindValue(5,$datadenascimento);
      $stmt->bindValue(6,Criptografia::hash($senha));
      $stmt->bindValue(7,$_SESSION['ID_Usuario']);
      $stmt->execute();

      return true;

      } catch (PDOException $Exception){
        return $Exception;
      }
  }


 /**
* Metodo que gera senha aleatória para enviar para o usuário:
*baseado em:http://blog.thiagobelem.net/gerando-senhas-aleatorias-com-php
*/
private function alterarSenha($email) {

  // Declaração dos tipos de caracteres que a senha será composta.
  $tamanho = 6;
  $maiusculas = true;
  $numeros = true;
  $simbolos = false;
  $letMinuscula = 'abcdefghijklmnopqrstuvwxyz';
  $letMaiuscula = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $numero = '1234567890';
  $simbolo = '!@#$%*-';

  $novaSenha = '';
  $caracteres = '';
  // Agrupamos todos os caracteres que poderão ser utilizados
  $caracteres .= $letMinuscula;
  if ($maiusculas)
     $caracteres .= $letMaiuscula;

  if ($numeros)
     $caracteres .= $numero;

  if ($simbolos)
      $caracteres .= $simbolo;
  // Calculamos o total de caracteres possíveis
  $sortAle = strlen($caracteres);

  for ($i = 1; $i <= $tamanho; $i++) {
    // Criamos um número aleatório de 1 até $sortAle para pegar um dos caracteres
    $rand = mt_rand(1, $sortAle);
    // Concatena um dos caracteres na variável $retorno
    $novaSenha .= $caracteres[$rand-1];
  }

  $senhaNova = Criptografia::hash($novaSenha);

  $stmt = Conexao::getInstance()->prepare(CrudSql::getInstance()->alterarSenha());
  $stmt->bindValue(1, $senhaNova);
  $stmt->bindValue(2, $email);
  $stmt->execute();

  return $novaSenha;
  }

  public function alterarImagem($idUsuario, $dir){

    try {

     $query = Conexao::getInstance()->prepare(CrudSql::getInstance()->alterarImagem());
     $query->bindValue(1, $dir);
     $query->bindValue(2, $idUsuario);
     $query->execute();

     return true;
   } catch (PDOException $Exception){
     return false;
   }
  }

  public function assinarBoletim($email){

    try{
      $stmt = Conexao::getInstance()->prepare(CrudSql::getInstance()->assinarBoletim());
      $stmt->bindValue(1, $email);
      $stmt->execute();
      return true;

    }catch (PDOException $ex){
      return false;
    }


  }

  public function excluirConta($idUsuario) {
    try {

      $query = Conexao::getInstance()->prepare(CrudSql::getInstance()->excluirUsuario());
      $query->bindValue(1, $idUsuario);
      $query->execute();
      return true;
    } catch (PDOException $e) {
       echo 'Error: ' . $e->getMessage();
       return false;
    }
  }

  public function buscarLogin($idUsuario) {

   try {

     $stmt = Conexao::getInstance()->prepare(CrudSql::getInstance()->buscarLogin());
     $stmt->bindValue(1, $idUsuario);
     $stmt->execute();

     return $stmt->fetch(PDO::FETCH_ASSOC)['Login'];
   } catch(PDOException $exp) {

     return null;
   }

 }

 public function adicoinarFotos($idUsuario, $dir) {

   try {

    $query = Conexao::getInstance()->prepare(CrudSql::getInstance()->adicionarFotos());
    $query->bindValue(1, $idUsuario);
    $query->bindValue(2, $dir);
    $query->execute();

    return true;
  } catch (PDOException $Exception){

    return false;
  }
 }

 public function buscarUsuarios(){

      $stmt = Conexao::getInstance()->prepare(CrudSql::getInstance()->buscarTodosUsuarios());
      $stmt->execute();
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return json_encode($rows);
 }

}
 ?>
