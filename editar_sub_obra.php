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

            <title>Editar - Sub Obra</title>
            <?php $menu->getHead(); ?>

        </head>

        <body>

            <!--Sidebar-->
            <?php $menu->getNavbar(); ?>

            <section class="container">

                <form action="confirma.php" method="POST">
                    <div class="m-2">

                        <?php

                        $sub_obra = $_GET['sub_obra'];
                        $id_sub_obra = $_GET['id_sub_obra'];
                        $fk_obra_geral = $_GET['fk_obra_geral'];
                        $select = "SELECT obra_geral FROM obras_gerais WHERE id_obra_geral = $fk_obra_geral";

                        $query_select = mysqli_query($link, $select);
                        $row_obra   = mysqli_fetch_assoc($query_select);

                        $obra_geral = $row_obra['obra_geral'];

                        ?>

                        <legend class="title h1 text-center mb-4 mt-4">Editar sub obra</legend>

                        <div class="card">
                            <div class="row">
                                <div class="col-sm-12">

                                    <!-- Campo obra geral -->
                                    <div class="m-2">
                                        <strong>Obra geral:</strong><br>
                                        <select required class="custom-select" id="obg_sub" name="obra_geral">
                                            <option value="" disabled selected>Selecione uma obra geral</option>
                                            <option selected><?php echo ($obra_geral); ?></option>
                                            <?php
                                            $query_select = "SELECT * FROM obras_gerais ORDER BY obra_geral ASC";
                                            $select = mysqli_query($link, $query_select);
                                            while ($obra = mysqli_fetch_array($select)) { 
                                                if ($obra['obra_geral'] != $obra_geral) { ?>
                                                <option data-value="<?php echo ($obra['id_obra_geral']); ?>" value="<?php echo ($obra['obra_geral']); ?>"><?php echo ($obra['obra_geral']); ?></option>
                                            <?php } 
                                            } ?>
                                        </select>
                                    </div>

                                    <!-- Campo hidden para receber como value o id_obra_geral -->
                                    <input type="hidden" id="fk_obg_sub" name="fk_obg_sub" value="<?php echo ($fk_obra_geral); ?>">

                                    <!-- Campo sub obra -->
                                    <div class="m-2">
                                        <strong>Sub obra:</strong><br>
                                        <input class='text-box form-control' name="txt_editar_sub_obra" rows="1" placeholder="Digite a sub obra" value="<?php echo ($sub_obra); ?>">
                                    </div>

                                    <!-- Campo hidden para id sub obra -->
                                    <input type="hidden" name="txt_id_sub_obra" value='<?php echo ($id_sub_obra); ?>'><br>

                                    <div class="d-flex justify-content-center">
                                        <button type="button" class='btn btn-default small p-2 m-1 mb-2' onclick="window.location.href='./listar_sub_obras.php'">
                                            <strong>Cancelar</strong>
                                            <span class="material-icons align-middle">close</span>
                                        </button>

                                        <button name="btn_editar_sub_obra" class="btn btn-success small p-2 m-1 mb-2" value='<?php echo ($id_sub_obra); ?>'>
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

            <script>
                //Pegando id_obra_geral do data-value do input
                //Atribuido id ao value do input hidden
                let input = document.getElementById('obg_sub')
                let id_out = document.getElementById('fk_obg_sub')

                input.addEventListener('input', function(evt) {
                    let selector = document.querySelector('option[value="' + this.value + '"]')
                    if (selector) {
                        id_out.setAttribute('value', selector.getAttribute('data-value'))
                        console.log(id_out)
                    }
                }, false)
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