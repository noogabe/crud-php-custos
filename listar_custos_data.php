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
            <title>Custo - Meus custos</title>
            <?php $menu->getHead(); ?>
        </head>

        <body>

            <!--Sidebar-->
            <?php $menu->getNavbar(); ?>

            <?php
            $tempIni = $_GET['dataInicio'];
            $tempFim = $_GET['dataFim'];

            $data_inicio = $_GET['dataInicio'];
            $data_fim = $_GET['dataFim'];
            $data_inicio = str_replace("-", "", $data_inicio);
            $data_fim = str_replace("-", "", $data_fim);

            ?>

            <section class='container col-12'>

                <!-- BARRA BUSCAR REGISTRO -->
                <form method="post" action="" id="formBuscaCusto">

                    <br>

                    <div class="ml-2 input-group">
                        <input type="text" class="form-control input-group-append placeholder" placeholder="Digite sua busca" name="pesquisa" id="pesquisa_custo">

                        <button type="submit" class="btn btn-info small" data-toggle="collapse" href="#error_not_found" role="button" aria-expanded="false" aria-controls="error_not_found">
                            <strong>Buscar</strong>
                            <span class="material-icons align-middle">search</span>
                        </button>
                    </div>

                    <ul class="nav nav-pills justify-content-center">

                        <li class="nav-item">
                            <a class="btn nav active" onclick="window.location.href='listar_custos_data.php?dataInicio=<?php echo ($tempIni); ?>&dataFim=<?php echo ($tempFim); ?>'">Geral</a>
                        </li>                        

                        <li class="nav-item dropdown">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Empresas</a>
                            <div class="dropdown-menu">
                                <?php
                                $query_select = "SELECT DISTINCT(empresa) FROM pgtos_obras
                                                ORDER BY empresa ASC";
                                $select = mysqli_query($link, $query_select);
                                while ($empresa2 = mysqli_fetch_array($select)) { ?>
                                    <button name="name_empresas2[]" type="submit" value="<?php echo ($empresa2['empresa']); ?>" class="btn-light dropdown-item"><?php echo ($empresa2['empresa']); ?></button>
                                <?php } ?>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Obras</a>
                            <div class="dropdown-menu">
                                <?php
                                $query_select = "SELECT DISTINCT(obra_geral) FROM pgtos_obras
                                                ORDER BY obra_geral ASC";
                                $select = mysqli_query($link, $query_select);
                                while ($obra_geral2 = mysqli_fetch_array($select)) { ?>
                                    <button name="name_obras_gerais2[]" type="submit" value="<?php echo ($obra_geral2['obra_geral']); ?>" class="btn-light dropdown-item"><?php echo ($obra_geral2['obra_geral']); ?></button>
                                <?php } ?>
                        </li>


                        <li class="nav-item dropdown">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Classificações</a>
                            <div class="dropdown-menu">
                                <?php
                                $query_select = "SELECT DISTINCT(classificacao) FROM pgtos_obras
                                                ORDER BY classificacao ASC";
                                $select = mysqli_query($link, $query_select);
                                while ($classificacao = mysqli_fetch_array($select)) { ?>
                                    <button name="name_classificacoes[]" type="submit" value="<?php echo $classificacao['classificacao']; ?>" class="btn-light dropdown-item"><?php echo $classificacao['classificacao']; ?></button>
                                <?php } ?>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Fornecedores</a>
                            <div class="dropdown-menu">
                                <?php
                                $query_select = "SELECT DISTINCT(fornecedor) FROM pgtos_obras 
                                                ORDER BY fornecedor ASC";
                                $select = mysqli_query($link, $query_select);
                                while ($fornecedores = mysqli_fetch_array($select)) { ?>
                                    <button name="name_fornecedores2[]" type="submit" value="<?php echo ($fornecedores['fornecedor']); ?>" class="btn-light dropdown-item"><?php echo ($fornecedores['fornecedor']); ?></button>
                                <?php } ?>
                        </li>


                    </ul>

                    <?php

                    /* BUSCAR CUSTOS */
                    $name_classificacoes = filter_input(INPUT_POST, 'name_classificacoes[]', FILTER_SANITIZE_STRING);
                    $name_classificacoes = isset($_POST['name_classificacoes']) ? $_POST['name_classificacoes'] : null;

                    $name_obras_gerais = filter_input(INPUT_POST, 'name_obras_gerais2[]', FILTER_SANITIZE_STRING);
                    $name_obras_gerais = isset($_POST['name_obras_gerais2']) ? $_POST['name_obras_gerais2'] : null;

                    $name_empresas = filter_input(INPUT_POST, 'name_empresas2[]', FILTER_SANITIZE_STRING);
                    $name_empresas = isset($_POST['name_empresas2']) ? $_POST['name_empresas2'] : null;

                    $name_fornecedores = filter_input(INPUT_POST, 'name_fornecedores2[]', FILTER_SANITIZE_STRING);
                    $name_fornecedores = isset($_POST['name_fornecedores2']) ? $_POST['name_fornecedores2'] : null;
                    
                    $pesquisa = filter_input(INPUT_POST, 'pesquisa', FILTER_SANITIZE_STRING);
                    $pesquisa = isset($_POST['pesquisa']) ? $_POST['pesquisa'] : null;
                    
                    $num_results = 1;

                    if(!empty($name_classificacoes)){
                        $pesquisa = $name_classificacoes[0];

                    } elseif(!empty($name_obras_gerais)){
                        $pesquisa = $name_obras_gerais[0];
                        $pagina = 1;

                    } elseif(!empty($name_empresas)){
                        $pesquisa = $name_empresas[0];
                        $pagina = 1;

                    } elseif(!empty($name_fornecedores)){
                        $pesquisa = $name_fornecedores[0];
                        $pagina = 1;

                    }


                    $select_custos_obras = "SELECT * FROM pgtos_obras
                                            WHERE (numero LIKE '%" . $pesquisa . "%' OR
                                            classificacao LIKE '%" . $pesquisa . "%' OR                                           
                                            obra_geral LIKE '%" . $pesquisa . "%' OR                                            
                                            empresa LIKE '%" . $pesquisa . "%' OR
                                            fornecedor LIKE '%" . $pesquisa . "%') AND
                                            data_emissao BETWEEN $data_inicio AND $data_fim
                                            
                                            ORDER BY data_emissao ASC";

                    $select = mysqli_query($link, $select_custos_obras);
                    $num_results = mysqli_num_rows($select);

                    /* Alerta registro não encontrado */
                    if (empty($num_results) && $pesquisa != '') {
                        echo "
                            <div id='error_not_found'>
                                <div class='alert alert-warning' role='alert'>
                                    <span class='material-icons align-middle'>warning</span>
                                    <strong>Registro não encontrado!</strong> Por favor, tente novamente.                                    
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>
                            </div>
                            ";
                    }
                    /* FIM BUSCAR BUSCAR REGISTRO */
                    ?>
                </form>

                <br><br>

                <legend class="title h1 text-center mb-4 mt-4">Meus Custos<?php if(!empty($pesquisa)) echo ( ' ' . '- ' . $pesquisa); ?></legend>

                <?php
                //Calculando o custo total de compras + servicos
                $select_sum = "SELECT SUM(valor_total) AS TOTAL FROM pgtos_obras
                                    WHERE (numero LIKE '%" . $pesquisa . "%' OR
                                            classificacao LIKE '%" . $pesquisa . "%' OR
                                            obra_geral LIKE '%" . $pesquisa . "%' OR
                                            empresa LIKE '%" . $pesquisa . "%' OR
                                            fornecedor LIKE '%" . $pesquisa . "%') AND
                                            data_emissao BETWEEN $data_inicio AND $data_fim ";

                $query_sum = mysqli_query($link, $select_sum);
                $row_sum   = mysqli_fetch_assoc($query_sum);

                $custo_total = $row_sum['TOTAL'];
                $custo_total = number_format($custo_total, 2, ',', '.');

                ?>

                <!-- INSERIR AQUI O GASTO TOTAL-->
                <h2 id="gasto-total-exibir" class="text-left ml-2 mt-4">Custo total R$ <?php echo ($custo_total); ?></h2>

                <!-- LISTA DE CUSTOS COMPRAS E SERVIÇOS -->
                <div class="card ml-2">

                <?php
            
                //Verificando se a página atual está sendo passada na URL, senão é atribuido o valor 1
                $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1; 

                //Selecionando todos os registros
                $select_compra2 = "SELECT * FROM pgtos_obras
                                WHERE (numero LIKE '%" . $pesquisa . "%' OR
                                classificacao LIKE '%" . $pesquisa . "%' OR                                           
                                obra_geral LIKE '%" . $pesquisa . "%' OR                                            
                                empresa LIKE '%" . $pesquisa . "%' OR
                                fornecedor LIKE '%" . $pesquisa . "%') AND
                                data_emissao BETWEEN $data_inicio AND $data_fim
                                ORDER BY data_emissao ASC";
                $select2 = mysqli_query($link, $select_compra2);

                //Contando o total de registros
                $total_custos = mysqli_num_rows($select2);

                //Definindo o total de registros que serão exibidos na página   
                $qtd_paginas = "10";

                //Calcular numero de páginas necessárias para apresentar todos os registros
                $num_paginas = ceil($total_custos/$qtd_paginas);

                //Calcular o inicio da visualização
                $inicio =   ($qtd_paginas*$pagina)-$qtd_paginas;
                
                //Selecionar os  registros a serem apresentados na página
                $result_custos = "SELECT * FROM pgtos_obras
                                WHERE (numero LIKE '%" . $pesquisa . "%' OR
                                classificacao LIKE '%" . $pesquisa . "%' OR                                           
                                obra_geral LIKE '%" . $pesquisa . "%' OR                                            
                                empresa LIKE '%" . $pesquisa . "%' OR
                                fornecedor LIKE '%" . $pesquisa . "%') AND
                                data_emissao BETWEEN $data_inicio AND $data_fim
                                ORDER BY data_emissao ASC LIMIT $inicio, $qtd_paginas";

                $resultado_custos = mysqli_query($link, $result_custos);

                $total_custos = mysqli_num_rows($resultado_custos);
                

                ?>

                    <table class="table table-bordered table-responsive" style="white-space:nowrap;">
                        <thead>
                            <tr>
                    
                                <th scope="col" class="text-center align-middle">Data de Emissão</th>
                                <th scope="col" class="text-center align-middle">Fornecedor</th>
                                <th scope="col" class="text-center align-middle">Nota</th>
                                <th scope="col" class="text-center align-middle">Descrição</th>
                                <th scope="col" class="text-center align-middle">Qtde</th>
                                <th scope="col" class="text-center align-middle">Valor unitário</th>
                                <th scope="col" class="text-center align-middle">Valor total</th>
                                <th scope="col" class="text-center align-middle">Observação</th>     
                                
                            </tr>

                        </thead>

                        <?php
                        $tag_de_contagem = 0;
                        while ($array = mysqli_fetch_array($resultado_custos)) {
                        ?>

                            <tbody>
                                <form action="confirma.php" method="post">
                                    <tr> 
                                        <?php
                                            $str_obs = $array['observacao'];
                                            
                                            if($str_obs == null) $str_obs = '-';
                                        ?>
                                        
                                        <td class="text-center"><?php echo date('d/m/Y', strtotime($array['data_emissao'])); ?></td>
                                        <td class="text-left"><?php echo ($array['fornecedor']); ?></td>
                                        <td class="text-center"><?php echo ($array['numero']); ?></td>
                                        <td class="text-left"><?php echo ($array['descricao']); ?></td>
                                        <td class="text-center"><?php echo ($array['qtd']); ?></td>
                                        <td class="text-center"><?php echo ($array['valor_unitario'] = number_format($array['valor_unitario'], 2, ',', '.')); ?></td>
                                        <td class="text-center"><?php echo ($array['valor_total']= number_format($array['valor_total'], 2, ',', '.')); ?></td>
                                        <td class="text-center"><?php echo ($str_obs); ?></td>        

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
							<a class="page-link text-success" href="listar_custos_data.php?dataInicio=<?php echo ($tempIni); ?>&dataFim=<?php echo ($tempFim); ?>&pagina=<?php echo ($pagina_anterior);?>" aria-label="Previous">
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
                            <a class="page-link text-success" href="listar_custos_data.php?dataInicio=<?php echo ($tempIni); ?>&dataFim=<?php echo ($tempFim); ?>&pagina=<?php echo ($i);?>"><?php echo ($i);?></a>
                        </li>

                    <?php }?>
            

                    <li class="page-item">
                    <?php
						if($pagina_posterior <= $num_paginas){ ?>
							<a class="page-link text-success" href="listar_custos_data.php?dataInicio=<?php echo ($tempIni); ?>&dataFim=<?php echo ($tempFim); ?>&pagina=<?php echo ($pagina_posterior);?>" aria-label="Next">
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

            <br>

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