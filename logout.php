<?php
include_once('db_class.php');
$objDB = new Db();
$link = $objDB->conecta_mysql();

//Iniciando a sessão
session_start();
//Apagando todos os dados de uma sessão:
session_unset();
//Destruindo todas as sessões
session_destroy();

$user = $_SESSION['usuario'];


$userAtivo = "UPDATE usuarios 
                SET ativo = 0
                WHERE  usuario =  '$user'";

mysqli_query($link, $userAtivo);

//Direciona para pagina de login
header("Location: login.php");

?>