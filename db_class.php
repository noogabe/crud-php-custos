<?php

/*
	private $servername = "localhost";
    private $database   = "locaboxc";
    private $username   = "root";
    private $password   = "";

	private $host     = "localhost";
    private $database   = "locaboxc_erp-beta4";
    private $usuario   = "locaboxc_pedro";
    private $senha   = "]a_s4N9qk}h!";
*/

class Db {
	
	private $host = "localhost";
    private $database   = "empresa-dbo";
    private $usuario   = "root";
    private $senha   = "";

	function __construct()
	{
		
	}

	function conecta_mysql(){
		//criar a conexão
		$con = mysqli_connect($this->host, $this->usuario, $this->senha, $this->database);

		//ajustar o charset de comunicação entre a aplicação e o banco de dados 
		mysqli_set_charset($con, "utf8");

		//verificar se houve erro de conexao
		if(mysqli_connect_errno()){
			echo "Erro ao tentar conectar-se com o banco de dados".mysqli_connect_error();
		}
		return $con;
	}
}
?>