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
        /* CONTINUA APOS O HTML */

?>

        <!DOCTYPE HTML>
        <html lang="pt-br">

        <head>
            <title>Gestão de Custos</title>
            <?php $menu->getHead(); ?>
        </head>

        <body>
            <!--Sidebar-->
            <?php $menu->getNavbar(); ?>

            <!--Logo-->
            <?php $menu->getIcon(); ?>

            <section class='container col-9'>
                <div class='row'>

                    <legend class="title h1 text-center mb-4 mt-4">Gestão de Custos</legend>

                    <div class='col col-sm mb-4'>
                        <a href="./obras.php" class="btn btn-success btn-block shadow">
                            <img src="img/worker.png" style="max-width: 60px;"></img>
                            <hr>
                            <h3>Obras</h3>
                        </a>
                    </div>

                    <div class='col col-sm mb-4'>
                        <a href="./alocar_custos.php" class="btn btn-success btn-block shadow">
                            <img src="img/money.png" style="max-width: 60px;"></img>
                            <hr>
                            <h3>Distribuir Custos</h3>
                        </a>
                    </div>

                    <div class='col col-sm mb-4'>
                        <a href="./filtro_data.php" class="btn btn-success btn-block shadow">
                            <img src="img/cost-list.png" style="max-width: 60px;"></img>
                            <hr>
                            <h3>Visualizar Custos</h3>
                        </a>
                    </div>

                    <br>
                </div> <br>
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