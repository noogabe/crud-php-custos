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

            <title>Custo - Listar NFe</title>
            <?php $menu->getHead(); ?>

        </head>

        <body>

            <!--Sidebar-->
            <?php $menu->getNavbar(); ?>


            <!-- INSIRA OS ELEMENTOS AQUI -->

            <section class='container'>

                <!-- BARRA BUSCAR NOTA -->
                <form method="post" action="" id=formBuscaNota>

                    <br>

                        <div class="ml-2 input-group">
                            <input type="text" class="form-control input-group-append placeholder" placeholder="Buscar nota" name="pesquisa" id="pesquisa_nota" required>

                            <button type="submit" class="btn btn-info small" data-toggle="collapse" href="#error_not_found" role="button" aria-expanded="false" aria-controls="error_not_found">
                                <strong>Buscar</strong>
                                <span class="material-icons align-middle">search</span>
                            </button>
                        </div>

                    <br><br>

                    <?php

                    /* BUSCAR NOTA PELO NÚMERO */
                    $pesquisa = filter_input(INPUT_POST, 'pesquisa', FILTER_SANITIZE_STRING);
                    $pesquisa = isset($_POST['pesquisa']) ? $_POST['pesquisa'] : null;

                    $select_servico_compra = "SELECT DISTINCT(numero), data_emissao, fornecedor FROM pgtos_obras 
                                WHERE numero LIKE '%" . $pesquisa . "%' 
                                AND tipo_documento = 'nfe' ORDER BY data_emissao ASC";

                    $select = mysqli_query($link, $select_servico_compra);
                    $num_results = mysqli_num_rows($select);

                    /* Alerta nota não encontrada */ 
                    if (empty($num_results) && $pesquisa != '') {
                        echo "
                            <div id='error_not_found'>
                                <div class='alert alert-warning' role='alert'>
                                    <span class='material-icons align-middle'>warning</span>
                                    <strong>Nota não encontrada!</strong> Por favor, tente outro número.                                    
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>
                            </div>
                            ";
                    }
                    /* FIM BUSCAR NOTA PELO NÚMERO */
                    ?>
                </form>

                <legend  class="title h1 text-center mb-4 mt-4">Minhas notas (NFe)</legend>
                
                <!-- BOTÃO ADD -->
                <button type="button" class="btn btn-success small m-1 ml-2" onclick="window.location.href='./adicionar_compra2.php'">
                        <strong>Adicionar</strong>
                        <span class='material-icons align-middle'>add</span>
                </button>


                <!-- LISTA DE COMPRAS -->
                <div class="card ml-2">

                <?php
            
                //Verificando se a página atual está sendo passada na URL, senão é atribuido o valor 1
                $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1; 

                //Selecionando todos os registros
                $select_compra2 = "SELECT DISTINCT(numero), data_emissao, fornecedor FROM pgtos_obras 
                                    WHERE numero LIKE '%" . $pesquisa . "%' 
                                    AND tipo_documento = 'nfe' ORDER BY data_emissao ASC";
                $select2 = mysqli_query($link, $select_compra2);

                //Contando o total de registros
                $total_compras = mysqli_num_rows($select2);

                //Definindo o total de registros que serão exibidos na página   
                $qtd_paginas = "15";

                //Calcular numero de páginas necessárias para apresentar todos os registros
                $num_paginas = ceil($total_compras/$qtd_paginas);

                //Calcular o inicio da visualização
                $inicio =   ($qtd_paginas*$pagina)-$qtd_paginas;
                
                //Selecionar os  registros a serem apresentados na página
                $result_compras = "SELECT DISTINCT(numero), data_emissao, fornecedor FROM pgtos_obras 
                                WHERE numero LIKE '%" . $pesquisa . "%' 
                                AND tipo_documento = 'nfe' ORDER BY data_emissao ASC
                                LIMIT $inicio, $qtd_paginas";

                $resultado_compras = mysqli_query($link, $result_compras);

                $total_compras = mysqli_num_rows($resultado_compras);

                ?>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">Nota</th>
                                <th scope="col" class="text-center">Data de Emissão</th>
                                <th scope="col" class="text-center">Fornecedor</th>
                            </tr>

                        </thead>

                        <?php
                        $tag_de_contagem = 0;
                        while ($array = mysqli_fetch_array($resultado_compras)) {
                        ?>

                        <tbody>
                            <form action="confirma.php" method="post">
                                <tr>

                                    <td class="text-center"><?php echo ($array['numero']); ?></td>
                                    <td class="text-center"><?php echo date('d/m/Y',strtotime($array['data_emissao'])); ?></td>
                                    <td class="text-center"><?php echo ($array['fornecedor']); ?></td>
                                    
                                    <td class="text-center col-3">


                                        <button name="btn_info_compras" class="btn btn-link p-1" value="<?php echo ($tag_de_contagem); ?>">
                                            <span class="material-icons btn_acoes">info</span>
                                        </button>


                                        <?php $numeros = $array['numero']; ?>
                                        
                                        <input type="hidden" name="numero[]" value='<?php echo ($numeros); ?>'>  
                                        
                                    </td>
                            </form>
                            </tr>

                        </tbody>
                    <?php
                        $tag_de_contagem = $tag_de_contagem + 1;
                    } ?>

                </table>

            </div>

            <?php  
            //Verificar a página anterior e posterior
            $pagina_anterior = $pagina-1;
            $pagina_posterior = $pagina+1; 
            ?>

            <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item">
						<?php
						if($pagina_anterior != 0){ ?>
							<a class="page-link text-success" href="listar_compras.php?pagina=<?php echo ($pagina_anterior);?>" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
							</a>
						<?php }else{ ?>
                            <a class="page-link text-muted disabled" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
					<?php }  ?>
					</li>

                    <?php
                    //Apresentar a paginação
                    for($i = 1; $i < $num_paginas +1 ; $i++){ ?>
                        <li <?php if($i == $pagina) { ?> class="page-item active" <?php } ?> class="page-item">
                            <a class="page-link text-success" href="listar_compras.php?pagina=<?php echo ($i);?>"><?php echo ($i);?></a>
                        </li>

                    <?php }?>

                    <li class="page-item">
                    <?php
						if($pagina_posterior <= $num_paginas){ ?>
							<a class="page-link text-success" href="listar_compras.php?pagina=<?php echo ($pagina_posterior);?>" aria-label="Next">
								<span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
							</a>
						<?php }else{ ?>
                            <a class="page-link text-muted disabled" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
					<?php }  ?>
                    </li>
                </ul>
            </nav>
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