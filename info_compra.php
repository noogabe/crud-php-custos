<?php

session_cache_expire(60);
session_start();

include_once('menu.php');
include_once('db_class.php');

$menu = new Menu();

if (!$_SESSION['ativo']) {
    header("Location: login.php");
} else {
    $logado = $_SESSION['ativo'];

    if (!empty($logado)) {
        $objDB = new Db();
        $link = $objDB->conecta_mysql();
        /* CONTINUA APOS O HTML */

?>

<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <title>Custo - Informações da Compra</title>
        <?php $menu->getHead(); ?>
    </head>
    <body>
        <!--Sidebar-->
        <?php $menu->getNavbar(); ?>
        <!-- INSIRA OS ELEMENTOS AQUI -->
        <section class='container'>
            <legend  class="title h1 text-center mb-4 mt-4">Informações da Compra</legend>
            
            
            <!-- LISTA DE COMPRAS E SERVIÇOS -->
            <div class="card shadow-small p-3 mb-2 bg-white rounded">

                <?php

                    $id_compra = $_GET['id_compra'];
                    $numero = $_GET['numero'];
                    $data_emissao = $_GET['data_emissao'];
                    $fornecedor = $_GET['fornecedor'];
                    $produto = $_GET['nome_produto'];
                    $qtd = $_GET['qtd'];
                    $valor_unitario = $_GET['valor_unitario'];
                    $valor_desconto = $_GET['valor_desconto'];
                    $valor_total = $_GET['valor_total'];
                    $forma_pagamento = $_GET['forma_pagamento'];
                    $frota_veiculo = $_GET['frota_veiculo'];
                    $obra_geral = $_GET['obra_geral'];
                    $sub_obra = $_GET['sub_obra'];
                    $observacao = $_GET['observacao'];

                ?>

                <div class="row">

                    <legend class="font-weight-bold text-center mb-3"> <?php echo ("Nota $numero"); ?></legend>

                    <div class="text-left m-3">

                        <strong>Data de emissão:</strong> <?php echo ($data_emissao); ?><br>
                        <strong>Fornecedor:</strong> <?php echo ($fornecedor); ?><br>
                        <strong>Produto:</strong> <?php echo ($produto); ?><br>
                        <strong>Quantidade:</strong> <?php echo ($qtd); ?><br>
                        <strong>Valor unitário:</strong> <?php echo ($valor_unitario); ?><br>
                        <strong>Valor de desconto:</strong> <?php echo ($valor_desconto); ?><br>
                        <strong>Valor total:</strong> <?php echo ($valor_total); ?><br>
                        <strong>Forma de pagamento:</strong> <?php echo ($forma_pagamento); ?><br>
                        <strong>Veículo/Frota:</strong> <?php echo ($frota_veiculo); ?><br>
                        <strong>Obra geral:</strong> <?php echo ($obra_geral); ?><br>
                        <strong>Sub obra:</strong> <?php echo ($sub_obra); ?><br>
                        <strong>Observação:</strong> <?php echo ($observacao); ?><br>

                        <br>
                    </div>
                </div>
            </div>

        </section>

        <?php $menu->getFooter(); ?>

    </body>

    </html>

<?php
    /* Continuação da validação da pagina */
} else {
    echo "Bem-Vindo, convidado <br>";
    echo "Essas informações <font color='red'>NÃO PODEM</font> ser acessadas por você";
    echo "<br><a href='login.php'>Faça Login</a> Para ler o conteúdo";
    exit;
    }
}
?>