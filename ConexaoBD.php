<?php

class ConexaoBD 
{
    private $conexao_bd;

    function __construct() {

    }

    function conectar_bd() {
        require_once dirname(__FILE__).'/Constantes.php';
        if (defined('db_host') && defined('db_user') && defined('db_pass') && defined('db_name')) {
            $this->conexao_bd = new mysqli(db_host, db_user, db_pass, db_name);
        }
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        return $this->conexao_bd;
    }
}