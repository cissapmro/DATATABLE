<?php
//Instruir os navegadores acesso aos recursos
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json; charset-utf-8');
header('Access-Control-Allow-Credentials: true');
date_default_timezone_set('America/Sao_Paulo');
require_once 'apiUsuarioClass.php';

$form = json_decode(file_get_contents('php://input'), true);
//print "acao=".$_REQUEST['action'];
//$_REQUEST['action']="getlogin";
//$_POST['item']="teste de controle novo";
//Listar Registro
$VETFORM= print_r($form,true);
$fpx = fopen('datacontrole.txt', 'w');
    fwrite($fpx, "form=>".$VETFORM."<==");

$usuario = new cUsuario();
//print_r($usuario->getLogin());
//print_r($usuario->pesquisar('Cissa'));
//print_r($usuario->adicionar('Legal','legal@gmail.com','123', 'legal@gmail.com'));
//print_r($usuario->editar(1, 'Cristiane','uhuuu','222222', 'cissa@gmail.com'));
//print_r($usuario->excluir(9));
//print_r($usuario->login('d','d'));

   //if($postjson['requisicao'] == 'getLogin'){
    if(isset($_REQUEST['action']) && $_REQUEST['action'] == "getLogin"){
    $result = $usuario->getLogin();
    echo $result;
}
/*if($postjson['textoBuscar'] !== ''){
    $result = $usuario->pesquisar($postjson['nome'] or $postjson['usuario']);
    echo $result;
} */

//if($form['requisicao'] == 'add') {
if(isset($_REQUEST['action']) && $_REQUEST['action'] == "adicionar"){
 $result = $usuario->adicionar($form['nome'], $form['usuario'], $form['senha'], $form['email']);
 echo $result;
}
//if($form['requisicao'] == 'editar') {
if(isset($_REQUEST['action']) && $_REQUEST['action'] == "editar"){
    $result = $usuario->editar($form['id'], $form['nome'], $form['usuario'], $form['senha'], $form['email']);
    echo $result;
}
//if($form['requisicao'] == 'excluir') {
if(isset($_REQUEST['action']) && $_REQUEST['action'] == "excluir"){
    $result = $usuario->excluir($form['id']);
    echo $result;
}
//if($form['requisicao'] == 'login') {
if(isset($_REQUEST['action']) && $_REQUEST['action'] == "login"){
    $result = $usuario->login($form['usuario'], $form['senha'], $form['email']);
    echo $result;
}

//Buscar pela url
/*	$api = $_SERVER['REQUEST_METHOD'];
	// GET ID
	$id = intval($_GET['id'] ?? '');
	// GET ALL
	if ($api == 'GET') {
	  if ($id != 0) {
	    $data = $usuario->buscar($id);
	  } else {
	    $data = $usuario->buscar();
	  }
	  echo json_encode($data);
	}
//Adiciona um novo usuário no banco
if($api == 'POST'){
    $nome = $usuario->testarInput($_POST['nome']);
    $sobrenome = $usuario->testarInput($_POST['sobrenome']);
    $email = $usuario->testarInput($_POST['email']);
    $telefone = $usuario->testarInput($_POST['telefone']);
    $concluida = $usuario->testarInput($_POST['concluida']);

    if($usuario->cadastrar($nome, $sobrenome, $email, $telefone, $concluida)){
        echo $usuario->messsage('Usuário adicionado com sucesso!', false);
    } else {
        echo $usuario->messsage('Falha ao adicionar usuário!', true);
    }
}
//Alterar usuário no banco
if($api == 'PUT'){
    parse_str(file_get_contents('php://input'), $post_input); //atribuir o valor dos campos de entrada

    $nome = $usuario->testarInput($post_input['nome']);
    $sobrenome = $usuario->testarInput($post_input['sobrenome']);
    $email = $usuario->testarInput($post_input['email']);
    $telefone = $usuario->testarInput($post_input['telefone']);
    $concluida = $usuario->testarInput($_POST['concluida']);

    //Verifica se o id não é nulo
    if($id != null){
        if($usuario->alterar($nome, $sobrenome, $email, $telefone, $concluida, $id)){
            echo $usuario->messsage('Usuário alterado com sucesso!', false);
        } else {
            echo $usuario->messsage('Falha ao alterar o usuário!', true);
        }
    } else {
        echo $usuario->messsage('Usuário não existe!', true);
    }
}
//Excluir usuário no banco
if($api == 'DELETE'){
    //Verifica se o id não é nulo
    if($id != null){
        if($usuario->deletar($id)){
            echo $usuario->messsage('Usuário excluído com sucesso!', false);
        } else {
            echo $usuario->messsage('Falha ao excluir o usuário!', true);
        }
    } else {
            echo $usuario->messsage('Usuário não existe!', true);
        }
    } */
?>