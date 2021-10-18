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
            <title>Custo - Visualizar custos</title>
            <?php $menu->getHead(); ?>
        </head>

        <body>

            <!--Sidebar-->
            <?php $menu->getNavbar(); ?>

            <section class='container col-md-5'>
            <legend class="title h1 text-center mb-4 mt-4">Visualizar custos</legend>
                    <div class="justify-content-md-center">
                        <form action="confirma.php" method="POST">
                            
                            <div class="mb-3 input-group">
                                <span class="input-group-text">Início: </span>
                                <input class="text-box form-control"  type="date" name="dataInicio" id="dataInicio" value="<?php echo (date('Y-m-d')); ?>">
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text">Fim: </span>
                                <input class="text-box form-control"  type="date" name="dataFim" id="dataFim" value="<?php echo (date('Y-m-d')); ?>">
                            </div>

                            <div class="d-flex justify-content-center">

                                <button type='submit' class='bt-click btn btn-success btn-lg' name='btn_resultado_periodo'>
                                    Confirmar
                                </button>

                            </div>
                        </form>

                    </div>


                </form><br>


            <script type="text/javascript">
                
            </script>


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