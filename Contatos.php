<?php

require_once dirname(__FILE__).'/OperacaoBD.php';
$operacao_bd = new OperacaoBD();
$chave_api = $_GET['api'];
$chave_api_existe = isset($chave_api);
$resposta = array();

if ($chave_api_existe) {
	switch ($chave_api) {
		case 'create':
			$resultado = $operacao_bd->create_contato($_POST['nome'], $_POST['email']);
			if ($resultado) {
				$resposta['erro'] = "false";
				$resposta['mensagem'] = "Contato adicionado";
				$resposta['contatos'] = $operacao_bd->read_contato();
			} else {
				$resposta['erro'] = "true";
				$resposta['mensagem'] = "Algo deu errado com a requisicao POST";
			}
			break;

		case 'read':
			$resultado = $operacao_bd->read_contato();
			if ($resultado) {
				$resposta['erro'] = "false";
				$resposta['mensagem'] = "Contatos retornados";
				$resposta['contatos'] = $operacao_bd->read_contato();
			} else {
				$resposta['erro'] = "true";
				$resposta['mensagem'] = "Algo deu errado com a requisicao GET";
			}
			break;

		case 'update':
			$_PUT = array();
			if ($_SERVER['REQUEST_METHOD'] === 'PUT')
				$corpo_requisicao = file_get_contents('php://input');
			parse_str($corpo_requisicao, $_PUT);
			
			$resultado = $operacao_bd->update_contato($_PUT['nome'], $_PUT['email'], $_PUT['nome_alvo']);
			if ($resultado) {
				$resposta['erro'] = "false";
				$resposta['mensagem'] = "Contato atualizado";
				$resposta['contatos'] = $operacao_bd->read_contato();
			} else {
				$resposta['erro'] = "true";
				$resposta['mensagem'] = "Algo deu errado com a requisicao PUT";
			}
			
			break;

		case 'delete':
			$resultado = $operacao_bd->delete_contato($_GET['nome_alvo']);
			if ($resultado) {
				$resposta['erro'] = "false";
				$resposta['mensagem'] = "Contato deletado";
				$resposta['contatos'] = $operacao_bd->read_contato();
			} else {
				$resposta['erro'] = "true";
				$resposta['mensagem'] = "Algo deu errado com a requisicao DELETE";
			}
			break;
		
		default:
			$resposta['razao_mensagem'] = "Você se esqueceu do valor da chave da API!";
			break;
	}
} else {
	$resposta['error'] = true; 
	$resposta['mensagem'] = 'Erro: Chamada de API invalida';
	$resposta['razao_mensagem'] = 'Razao: Chave api nao existe nesse codigo';
}

echo json_encode($resposta);








