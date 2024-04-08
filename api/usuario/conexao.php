<?php
//Instruir os navegadores acesso aos recursos
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json; charset-utf-8');
header('Access-Control-Allow-Credentials: true');

date_default_timezone_set('America/Sao_Paulo');

class Conexao {
    private $usuario;
    private $senha;
    private $banco;
    private $servidor; 
    private $porta;
    private static $pdo;
    //Método construtor conexao
    public function __construct() {
     //  $this->servidor = "179.191.207.112";  
    //   $this->banco = "crud-app";
   //    $this->usuario = "desenv";   
   //    $this->senha = "desenv@dm2021"; 
   //    $this->porta = "5432";

    $this->servidor = "192.168.22.13";  
    $this->banco = "contatos";
    $this->usuario = "desenv";   
    $this->senha = "desenv@dm2021"; 
    $this->porta = "5432";
    }
    //Método para conexão
    public function conectar(){
        try {
            //verificando se atributo pdo está estanciado
            if (is_null(self::$pdo)) {
                //Instanciando conexao
                self::$pdo = new \PDO("pgsql:host=".$this->servidor.";port=".$this->porta.";dbname=".$this->banco, $this->usuario, $this->senha);
            //    self::$pdo = new \PDO("pgsql:host=".$this->servidor.";dbname=".$this->banco, $this->usuario, $this->senha);
             
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            }
        //   echo "conectado com sucesso";
            return self::$pdo;// se já estiver instanciado, retorna.

        } catch (PDOException $e) {
            die('Falha na conexão:'. $e->getMessage()); 
        }
    }
    //Método para tratar Inputs
    public function testarInput($data){
        $data = strip_tags($data);
        $data = htmlspecialchars($data);
        $data = stripcslashes($data);
        $data = trim($data);
        return $data;
    }
    //Método para retornar mensagem e status de erro no formato JSON
    public function message($content, $status){
        return json_encode(['message' => $content, 'error' => $status]);
    }

}
//$db = new Conexao;
//$db->conectar();
?>