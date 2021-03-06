<?php
/**
 * Classe de conexão ao banco de dados usando PDO no padrão Singleton.
 * Modo de Usar:
 * require_once './Database.class.php';
 * $db = Database::conexao();
 * E agora use as funções do PDO (prepare, query, exec) em cima da variável $db.
 */
class Conexao
{
    # Variável que guarda a conexão PDO.
    private static $db;
    # Private construct - garante que a classe só possa ser instanciada internamente.
    private function __construct()
    {
        # Informações sobre o banco de dados:
        $host = "localhost";
        $nome = "DB_myanonymousfriend";
        $usuario = "root";
        $senha = "";
        $driver = "mysql";
        # Informações sobre o sistema:
        $sistema_titulo = "My Anonymous Friend";
        $sistema_email = "myanonymousfriend.uefs@gmail.com";
        try
        {
            # Atribui o objeto PDO à variável $db.
            self::$db = new PDO("$driver:host=$host; dbname=$nome",$usuario,$senha);
            # Garante que o PDO lance exceções durante erros.
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }
        catch (PDOException $e)
        {
            # Envia um e-mail para o e-mail oficial do sistema, em caso de erro de conexão.
            # Então não carrega nada mais da página.
            die("Connection Error: " . $e->getMessage());
        }
    }
    # Método estático - acessível sem instanciação.
    public static function getInstance()
    {
        # Garante uma única instância. Se não existe uma conexão, criamos uma nova.
        if (!self::$db)
        {
            new Conexao();
        }
        # Retorna a conexão.
        return self::$db;
    }

    public function lastInsertId(){
        return $this->db->lastInsertId();
    }
}
