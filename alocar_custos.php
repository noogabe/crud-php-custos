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

            <title>Custo de Obras - Alocar custos</title>
            <?php $menu->getHead(); ?>

        </head>

        <body>

            <!--Sidebar-->
            <?php $menu->getNavbar(); ?>

            <section class='container col-9'>
                <div class='row'>
                    <legend class="title h1 text-center mb-4 mt-4">Distribuir Custos</legend>

                    <!-- Button  -->
                    <button type="button" class="btn btn-success btn-block shadow col-sm m-1" onclick="window.location.href='./listar_compras.php'">
                        <h3>NFe</h3>
                    </button>

                    <!-- Button  -->
                    <button type="button" class="btn btn-success btn-block shadow col-sm m-1" onclick="window.location.href='./listar_servicos.php'">
                        <h3>NFs</h3>
                    </button>
                    
                </div><br>

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