<?php
require_once 'conexao.php';
//cria a classe de usuarios
class cUsuario extends Conexao {

  /*protected $nome;
  protected $usuario;
  protected $senha;*/
  private $conexao;

  function __construct(){
    $this->conexao = new Conexao();
  }
   //Buscar o usuário no banco
   public function getLogin() {  
    $sql = 'SELECT * FROM "usuarios" ORDER BY id ASC';
    $query = $this->conexao->conectar()->prepare($sql);
    $query->execute();
    $dados = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach($dados as $row){
      $id = $row['id'];
      $nome = $row['nome'];
      $usuario = $row['usuario'];
      $senha = $row['senha'];
      $email = $row['email'];
    }
    if($query) {
      $result = json_encode(['success'=> true, 'result'=>$dados]);
    }
    else {
      $result = json_encode(['success'=> false]); 
}
return $result;
}
 //Pesquisar o usuário no banco
 /*public function pesquisar($textoBuscar) {  
  $sql = 'SELECT * FROM "usuarios" WHERE nome = :nome or usuario = :usuario';
  $query = $this->conexao->conectar()->prepare($sql);
  $query->bindValue( ':nome', $textoBuscar);
  $query->bindValue( ':usuario', $textoBuscar);
  $query->execute();
  $dados = $query->fetch(PDO::FETCH_ASSOC);
  if($query) {
    $result = json_encode(['success'=> true, 'result'=>$dados]);
  }
  else {
    $result = json_encode(['success'=> false]); 
}
return $result;
}*/

      //cadastrar o usuário no Banco
  public function adicionar($nome, $usuario, $senha, $email) {
    $sql = 'INSERT INTO "usuarios" (nome,usuario,senha, email) VALUES (:nome,:usuario,:senha, :email)';
    $query = $this->conexao->conectar()->prepare($sql);
    $query->bindValue( ':nome', $nome);
    $query->bindValue( ':usuario', $usuario);
    $query->bindValue( ':senha', $senha);
    $query->bindValue( ':email', $email);
    $query->execute();

    $id = $this->conexao->conectar()->lastInsertId();
    $dados = $query->fetch(PDO::FETCH_ASSOC);

    foreach($dados as $row){
      $id = $row['id'];
      $nome = $row['nome'];
      $usuario = $row['usuario'];
      $senha = $row['senha'];
      $email = $row['email'];
    }
    if($query){
      $result = json_encode(['success'=> true, 'result'=>$dados]);
    }
    else {
      $result = json_encode(['success'=> false]); 
}
return $result;
}
   //editar o usuário no Banco
   public function editar($id, $nome, $usuario, $senha, $email) {
    $sql = 'UPDATE usuarios SET nome=:nome, usuario=:usuario, senha=:senha, email=:email WHERE id = :id';
    $query = $this->conexao->conectar()->prepare($sql);
    $query->bindValue( ':nome', $nome);
    $query->bindValue( ':usuario', $usuario);
    $query->bindValue( ':senha', $senha);
    $query->bindValue( ':email', $email);
    $query->bindValue( ':id', $id);
    $query->execute();

    if($query){
      $result = json_encode(['success'=> true, 'result'=>$id]);
    }
    else {
      $result = json_encode(['success'=> false]); 
}
return $result;
}
//excluir o usuário no Banco
public function excluir($id) {
  $sql = 'DELETE FROM usuarios WHERE id = :id';
  $query = $this->conexao->conectar()->prepare($sql);
  $query->bindValue( ':id', $id);
  $query->execute();

  if($query){
    $result = json_encode(['success'=> true, 'result'=>$id]);
  }
  else {
    $result = json_encode(['success'=> false]); 
}
return $result;
}
//Buscar o usuário no banco
public function login($usuario, $senha) {  
  $sql = 'SELECT * FROM "usuarios" WHERE usuario = :usuario, senha = :senha';
  $query = $this->conexao->conectar()->prepare($sql);
  $query->bindValue(':usuario', $usuario);
  $query->bindValue(':senha', $senha);
  $query->execute();
  $dados = $query->fetchAll(PDO::FETCH_ASSOC);
  foreach($dados as $row){
    $usuario = $row['usuario'];
    $senha = $row['senha'];
  }
  if($query) {
    $result = json_encode(['success'=> true, 'result'=>$dados]);
  }
  else {
    $result = json_encode(['success'=> false]); 
}
return $result;
}


  //Deletar o usuário no Banco
/*  public function deletar($id) {
    $sql = 'DELETE FROM "usuarios" WHERE id = :id';
    $sql = $this->conectar()->prepare($sql);
    $sql->execute([
      'id' => $id
    ]);
      return true;
  }
  public function totalRowCount() {
    $sql = $this->conectar()->query('SELECT * FROM "usuarios"');
    $sql->execute();
    $totalLinhas = $sql->rowCount();
      return $totalLinhas;
  }*/
}
//$obj = new cUsuario();
//print_r($obj->getLogin());
//print_r($obj->pesquisar('Showww'));
//print_r($obj->adicionar('oi','fabiano@gmail.com','123456', 'nic@gmail.com'));
//print_r($obj->editar(6, 'Conseguiiiii','Cris','1000000', 'nic@gmail.com'));
//print_r($obj->excluir(5));
//print_r($obj->login('Cissa','cissa.pmro'));

//print_r($obj->totalRowCount());
?>