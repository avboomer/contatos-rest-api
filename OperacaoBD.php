<?php

class OperacaoBD
{
    private $conexao_bd;

    function __construct() {
        require_once dirname(__FILE__).'/ConexaoBD.php';
        $bd = new ConexaoBD();
        $this->conexao_bd = $bd->conectar_bd();
    }

    function create_contato($nome, $email) {
        $declaracao_sql = "INSERT INTO tbContatos(nome, email) VALUES(?, ?);";
        $sql_preparado = $this->conexao_bd->prepare($declaracao_sql);
        $sql_preparado->bind_param("ss", $nome, $email);
        if ($sql_preparado->execute())
            return true;
        return false;
    }  

    function read_contato() {
        $declaracao_sql = "SELECT * FROM tbContatos;";
        $resultado = $this->conexao_bd->query($declaracao_sql);

        $resposta = array();
        while ($linha = $resultado->fetch_array(MYSQLI_ASSOC)) {
            array_push($resposta, array('nome' => $linha['nome'], 'email' => $linha['email']));
        }
        // echo json_encode($resposta);
        return $resposta;
    }

    function update_contato($nome, $email, $nome_alvo) {
        $declaracao_sql = "UPDATE tbContatos SET nome = ?, email = ? WHERE nome = ?;";
        $sql_preparado = $this->conexao_bd->prepare($declaracao_sql);
        $sql_preparado->bind_param("sss", $nome, $email, $nome_alvo);
        if ($sql_preparado->execute())
            return true;
        return false;
    }

    function delete_contato($nome_alvo) {
        $declaracao_sql = "DELETE FROM tbContatos WHERE nome = ?";
        $sql_preparado = $this->conexao_bd->prepare($declaracao_sql);
        $sql_preparado->bind_param("s", $nome_alvo);
        if ($sql_preparado->execute())
            return true;
        return false;
    }
}