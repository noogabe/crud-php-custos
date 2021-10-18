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

            <title>Editar - Obra Geral</title>
            <?php $menu->getHead(); ?>

        </head>

        <body>

            <!--Sidebar-->
            <?php $menu->getNavbar(); ?>

            <section class='container'>

            <form action="confirma.php" method="POST">
                <div class="m-2">

                    <?php

                    $obra_geral = $_GET['obra_geral'];
                    $id_obra_geral = $_GET['id_obra_geral'];

                    ?>

                    <legend class="title h1 text-center mb-4 mt-4">Editar obra geral</legend>

                    <div class="card">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="m-2">
                                    <strong>Obra geral:</strong><br>
                                    <input class='text-box form-control' name="txt_editar_obra" rows="1" placeholder="Digite a obra geral" value="<?php echo ($obra_geral); ?>">
                                </div>

                                <input type="hidden" name="txt_id_obra_geral" value='<?php echo ($id_obra_geral); ?>'><br>

                                <div class="d-flex justify-content-center">
                                    <button type="button" class='btn btn-default small p-2 m-1 mb-2' onclick="window.location.href='./listar_obras_gerais.php'">
                                        <strong>Cancelar</strong>
                                        <span class="material-icons align-middle">close</span>
                                    </button>

                                    <button name="btn_editar_obra" class="btn btn-success small p-2 m-1 mb-2" value='<?php echo ($id_obra_geral); ?>'>
                                        <strong>Concluir</strong>
                                        <span class="material-icons align-middle">check</span>
                                    </button>
                                </div>

                            </div>

                        </div>
                    </div><br>
                </div>
            </form>
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