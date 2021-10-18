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

            <title>Custo - Sub Obras</title>
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
                            <input type="text" class="form-control input-group-append placeholder" placeholder="Buscar sub obra" name="pesquisa" id="pesquisa" required>

                            <button type="submit" class="btn btn-info small" data-toggle="collapse" href="#error_not_found" role="button" aria-expanded="false" aria-controls="error_not_found">
                                <strong>Buscar</strong>
                                <span class="material-icons align-middle">search</span>
                            </button>
                        </div>

                    <br>

                    <br>

                    <?php

                    /* BUSCAR SUB OBRA */
                    $pesquisa = filter_input(INPUT_POST, 'pesquisa', FILTER_SANITIZE_STRING);
                    $pesquisa = isset($_POST['pesquisa']) ? $_POST['pesquisa'] : null;

                    $select_sub_obra = "SELECT * FROM sub_obras AS S
                                    INNER JOIN obras_gerais AS O ON O.id_obra_geral=S.fk_obra_geral
                                    WHERE sub_obra LIKE '%" . $pesquisa . "%' ORDER BY sub_obra ASC";

                    $query_sub_obra = mysqli_query($link, $select_sub_obra);
                    $num_results = mysqli_num_rows($query_sub_obra);


                    /* Alerta obra não encontrada */
                    if (empty($num_results) && $pesquisa != '') {
                        echo "
                            <div id='error_not_found'>
                                <div class='alert alert-warning' role='alert'>

                                    <span class='material-icons align-middle'>warning</span>

                                    <strong>Sub obra não encontrada!</strong> Verifique se a palavra foi digitada corretamente.
                                    
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>
                            </div>
                            ";
                    }
                    /* FIM BUSCAR SUB OBRA */
                    ?>
                </form>

                <legend  class="title h1 text-center mb-4 mt-4">Sub Obras</legend>
                
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success small m-1 ml-2" data-bs-toggle="modal" data-bs-target="#exampleModa4">
                        <strong>Adicionar</strong>
                        <span class='material-icons align-middle'>add</span>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModa4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Adicionar sub obra</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="" , id=formIncSubObra>

                                        <!-- Campo obra geral -->
                                        <strong>Obra geral:</strong> <br>
                                        <input type="text" list="obras_g" autocomplete="off" class="text-box form-control" id="campo_obra_g" name="obra_geral" placeholder="Selecione uma obra geral" required>
                                            <datalist id="obras_g">
                                                <?php
                                                $query_select = "SELECT * FROM obras_gerais ORDER BY obra_geral ASC";
                                                $select = mysqli_query($link, $query_select);
                                                while ($obra_g = mysqli_fetch_array($select)) { ?>
                                                    <option data-value="<?php echo ($obra_g['id_obra_geral']); ?>" value=" <?php echo ($obra_g['obra_geral']); ?> ">
                                                <?php } ?>
                                            </datalist>

                                        <!-- Campo hidden para receber como value o id_obra_geral -->
                                        <input type="hidden" id="id_obg" name="id_obg">
                                        
                                        <!-- Campo sub obra -->
                                        <strong>Sub Obra:</strong> <br>
                                        <input type="text" class="text-box form-control" id="campo_sub_obra" name="sub_obra" placeholder="Digite a sub obra" required>
                                </div>

                                


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default small" data-bs-dismiss="modal">
                                        <strong>Cancelar</strong>
                                        <span class='material-icons align-middle'>close</span>
                                    </button>

                                    <button type="submit" class="btn btn-success form-control small" name="sub-obra-salva">
                                        <strong>Concluir</strong>
                                        <span class='material-icons align-middle'>check</span>
                                    </button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Fim modal -->

                    <?php

                    $sub_obra = filter_input(INPUT_POST, 'sub_obra', FILTER_SANITIZE_STRING);
                    $id_obg = filter_input(INPUT_POST, 'id_obg', FILTER_SANITIZE_STRING);

                    if ($sub_obra != NULL && $id_obg != NULL) {

                        $sub_obra = $_POST['sub_obra'];
                        $id_obg = $_POST['id_obg'];
                        $id_obg = (int)$id_obg;
                        //var_dump($sub_obra);
                        //var_dump($id_obg);
                        $sql = " INSERT INTO sub_obras (sub_obra, fk_obra_geral) VALUES ('$sub_obra', '$id_obg') ";
                        $insert2 = mysqli_query($link, $sql);
                    }

                    //executar query
                    if (!empty($sub_obra) && !empty($id_obg)) {
                        if ($insert2) {
                            echo "<script type='text/javascript'>alert('Cadastro efetuado com sucesso!')
                            window.location.href='listar_sub_obras.php';</script>";
                        } else {
                            echo "<script type='text/javascript'>alert('Erro ao efetuar cadastro!')
                        //window.location.href='listar_sub_obras.php';</script>";
                        }
                    }
                    ?>

                <div class="card ml-2">

                <?php
            
                //Verificando se a página atual está sendo passada na URL, senão é atribuido o valor 1
                $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1; 

                //Selecionando todos os registros
                $select_sub_obra2 = "SELECT * FROM sub_obras AS S
                                INNER JOIN obras_gerais AS O ON O.id_obra_geral=S.fk_obra_geral
                                WHERE sub_obra LIKE '%" . $pesquisa . "%' ORDER BY sub_obra ASC";
                $select2 = mysqli_query($link, $select_sub_obra2);

                //Contando o total de registros
                $total_sub_obras = mysqli_num_rows($select2);

                //Definindo o total de registros que serão exibidos na página   
                $qtd_paginas = "15";

                //Calcular numero de páginas necessárias para apresentar todos os registros
                $num_paginas = ceil($total_sub_obras/$qtd_paginas);

                //Calcular o inicio da visualização
                $inicio =   ($qtd_paginas*$pagina)-$qtd_paginas;
                
                //Selecionar os  registros a serem apresentados na página
                $result_sub_obras = "SELECT * FROM sub_obras AS S
                            INNER JOIN obras_gerais AS O ON O.id_obra_geral=S.fk_obra_geral
                            WHERE sub_obra LIKE '%" . $pesquisa . "%' ORDER BY sub_obra ASC
                            LIMIT $inicio, $qtd_paginas";

                $resultado_sub_obras = mysqli_query($link, $result_sub_obras);

                $total_sub_obras = mysqli_num_rows($resultado_sub_obras);

                ?>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">Sub obra</th>
                                <th scope="col" class="text-center col-5"></th>
                            </tr>

                        </thead>

                        <?php
                        $tag_de_contagem = 0;
                        while ($array = mysqli_fetch_array($resultado_sub_obras)) {
                        ?>

                            <tbody>
                                <form action="confirma.php" method="post">
                                    <tr>
                                        <td class="text-center"> <?php echo $array['obra_geral'] . ' - ' . ($array['sub_obra']); ?> </td>

                                        <td class="text-center col-5">

                                            <button name="btn_editar_sub_obras" type="submit" class="btn btn-link p-1" value="<?php echo ($tag_de_contagem); ?>">
                                                <span class="material-icons btn_acoes cor_editar">edit</span>
                                            </button>

                                            <button name="btn_apagar_sub_obras" type="submit" class="btn btn-link p-1" value="<?php echo ($tag_de_contagem); ?>"><span class="material-icons btn_acoes cor_editar2">delete_forever</span></button>

                                            <?php
                                            $fk_obras_gerais = $array['fk_obra_geral'];
                                            $nome_sub_obras = $array['sub_obra'];
                                            $id_sub_obras = $array['id_sub_obra'];
                                            ?>
                                            
                                            <input type="hidden" name="fk_obra_geral[]" value='<?php echo ($fk_obras_gerais); ?>'>
                                            <input type="hidden" name="sub_obra[]" value='<?php echo ($nome_sub_obras); ?>'>
                                            <input type="hidden" name="id_sub_obra[]" value='<?php echo ($id_sub_obras); ?>'>


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
							<a class="page-link text-success" href="listar_sub_obras.php?pagina=<?php echo ($pagina_anterior);?>" aria-label="Previous">
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
                            <a class="page-link text-success" href="listar_sub_obras.php?pagina=<?php echo ($i);?>"><?php echo ($i);?></a>
                        </li>

                    <?php }?>

                    <li class="page-item">
                    <?php
						if($pagina_posterior <= $num_paginas){ ?>
							<a class="page-link text-success" href="listar_sub_obras.php?pagina=<?php echo ($pagina_posterior);?>" aria-label="Next">
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

            <script>

                //Pegando id_obra_geral do data-value do input
                //Atribuido id ao value do input hidden
                let input = document.getElementById('campo_obra_g')
                let id_out = document.getElementById('id_obg')

                input.addEventListener('input', function(evt) {
                    let selector = document.querySelector('option[value="'+this.value+'"]')
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