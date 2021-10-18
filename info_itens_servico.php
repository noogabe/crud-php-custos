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

            <title>Custo - Serviços da Nota</title>
            <?php $menu->getHead(); ?>

        </head>

        <body>

            <!--Sidebar-->
            <?php $menu->getNavbar(); ?>


            <!-- INSIRA OS ELEMENTOS AQUI -->

            <section class='container'>

                <legend class="title h1 text-center mb-4 mt-4">Serviços da nota</legend>

                <!-- LISTA DE COMPRAS E SERVIÇOS -->
                <div class="card ml-2">

                    <?php
                    $numero = $_GET['numero'];
                    $select_compra2 = "SELECT * FROM pgtos_obras 
                                    WHERE numero = $numero ORDER BY descricao ASC";
                    $select2 = mysqli_query($link, $select_compra2);

                    $tag_de_contagem = 0;
                    while ($array = mysqli_fetch_array($select2)) {

                    ?>

                        <form action="confirma.php" method="post">
                            <div class="card shadow-small p-3 mb-2 bg-white rounded">
                                <div class="row">
                                    <legend class="font-weight-bold text-center mb-3"> <?php echo ($array['descricao']); ?></legend>
                                    <div class="left m-3">

                                        <?php
                                            //Se observação estiver vazia, atribuir caractere - para visualização
                                            $str_obs = $array['observacao'];
                                            if($str_obs == null) $str_obs = '-';
                                        ?>
                                        
                                        <strong>Classificação:</strong> <?php echo ($array['classificacao']); ?><br>
                                        <strong>Quantidade:</strong> <?php echo ($array['qtd']); ?><br>
                                        <strong>Valor unitário:</strong> <?php echo ($array['valor_unitario']); ?><br>
                                        <strong>Valor total:</strong> <?php echo ($array['valor_total']); ?><br>
                                        <strong>Obra geral:</strong> <?php echo ($array['obra_geral']); ?><br>
                                        <strong>Empresa:</strong> <?php echo ($array['empresa']); ?><br>
                                        <strong>Observação:</strong> <?php echo ($str_obs); ?><br>
                                        <br>
                                    </div>
                                </div>
                                <div class='justify-content-center text-center'>
                                    <button name="btn_editar_itens_servico" type="submit" class="btn btn-link p-1" value="<?php echo ($tag_de_contagem); ?>">
                                        <span class="material-icons btn_acoes cor_editar">edit</span>
                                    </button>
                                    <button name="btn_apagar_itens_servico" type="submit" class="btn btn-link p-1" value="<?php echo ($tag_de_contagem); ?>">
                                        <span class="material-icons btn_acoes cor_editar2">delete_forever</span>
                                    </button>
                                </div>
                            </div>

                            <input type="hidden" name="id_pagamento[]" value='<?php echo ($array['id_pagamento']); ?>'>
                            <input type="hidden" name="fornecedor[]" value='<?php echo ($array['fornecedor']); ?>'>
                            <input type="hidden" name="numero[]" value='<?php echo ($array['numero']); ?>'>
                            <input type="hidden" name="data_emissao[]" value='<?php echo ($array['data_emissao']); ?>'>
                            <input type="hidden" name="descricao[]" value='<?php echo ($array['descricao']); ?>'>
                            <input type="hidden" name="classificacao[]" value='<?php echo ($array['classificacao']); ?>'>
                            <input type="hidden" name="qtd[]" value='<?php echo ($array['qtd']); ?>'>
                            <input type="hidden" name="valor_unitario[]" value='<?php echo ($array['valor_unitario']); ?>'>
                            <input type="hidden" name="valor_total[]" value='<?php echo ($array['valor_total']); ?>'>
                            <input type="hidden" name="obra_geral[]" value='<?php echo ($array['obra_geral']); ?>'>
                            <input type="hidden" name="empresa[]" value='<?php echo ($array['empresa']); ?>'>
                            <input type="hidden" name="observacao[]" value='<?php echo ($array['observacao']); ?>'>

                        </form>

                    <?php
                        $tag_de_contagem = $tag_de_contagem + 1;
                    } ?>
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