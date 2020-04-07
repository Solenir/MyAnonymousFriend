<?php
/***/

require_once ('Conexao.php');
require_once ('CrudSql.php');
if(!isset($_SESSION)){
  session_start();
}

require_once ('Criptografia.php');
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
    $stmt->bindValue(3,Criptografia::hash($usuario->getSenha()));
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


}
 ?>
