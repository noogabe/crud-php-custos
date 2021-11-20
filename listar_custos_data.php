<?php

use Mpdf\Tag\Em;

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
        /* Continua apos o HTML */

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
            $pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : null;
            $data_inicio = $_GET['dataInicio'];
            $data_fim = $_GET['dataFim'];
            $data_inicio = str_replace("-", "", $data_inicio);
            $data_fim = str_replace("-", "", $data_fim);
            ?>

            <section class='container col-12'>
                <!-- Barra buscar registro -->
                <form method="post"><br>
                    <div class="ml-2 input-group">
                        <input type="text" class="form-control input-group-append placeholder" placeholder="Digite sua busca" name="pesquisa">
                        <button type="submit" class="btn btn-info small" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="error_not_found">
                            <strong>Buscar</strong>
                            <span class="material-icons align-middle">search</span>
                        </button>
                    </div>
                    <ul class="nav nav-pills justify-content-center">
                        <li class="nav-item">
                            <a class="btn nav active" id="geral2" type="submit" style="color: #212529;" href="./listar_custos_data.php?dataInicio=<?php echo ($tempIni); ?>&dataFim=<?php echo ($tempFim); ?>">Geral</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Empresas</a>
                            <div class="dropdown-menu">
                                <?php
                                $query_select = "SELECT DISTINCT(empresa) FROM pgtos_obras ORDER BY empresa ASC";
                                $select = mysqli_query($link, $query_select);
                                while ($empresa2 = mysqli_fetch_array($select)) { ?>
                                    <a class="btn-light dropdown-item" type="submit" name="name_empresas[]" href="./listar_custos_data.php?dataInicio=<?php echo ($tempIni); ?>&dataFim=<?php echo ($tempFim); ?>&pesquisa=<?php echo ($empresa2['empresa']); ?>"><?php echo ($empresa2['empresa']); ?></a>
                                <?php } ?>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Obras</a>
                            <div class="dropdown-menu">
                                <?php
                                $query_select = "SELECT DISTINCT(obra_geral) FROM pgtos_obras ORDER BY obra_geral ASC";
                                $select = mysqli_query($link, $query_select);
                                while ($obra_geral2 = mysqli_fetch_array($select)) { ?>
                                    <a class="btn-light dropdown-item" type="submit" name="name_obras_gerais[]" href="./listar_custos_data.php?dataInicio=<?php echo ($tempIni); ?>&dataFim=<?php echo ($tempFim); ?>&pesquisa=<?php echo ($obra_geral2['obra_geral']); ?>"><?php echo ($obra_geral2['obra_geral']); ?></a>
                                <?php } ?>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Classificações</a>
                            <div class="dropdown-menu">
                                <?php
                                $query_select = "SELECT DISTINCT(classificacao) FROM pgtos_obras ORDER BY classificacao ASC";
                                $select = mysqli_query($link, $query_select);
                                while ($classificacao = mysqli_fetch_array($select)) { ?>
                                    <a class="btn-light dropdown-item" type="submit" name="name_classificacoes[]" href="./listar_custos_data.php?dataInicio=<?php echo ($tempIni); ?>&dataFim=<?php echo ($tempFim); ?>&pesquisa=<?php echo ($classificacao['classificacao']); ?>"><?php echo ($classificacao['classificacao']); ?></a>
                                <?php } ?>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Fornecedores</a>
                            <div class="dropdown-menu">
                                <?php
                                $query_select = "SELECT DISTINCT(fornecedor) FROM pgtos_obras ORDER BY fornecedor ASC";
                                $select = mysqli_query($link, $query_select);
                                while ($fornecedores = mysqli_fetch_array($select)) { ?>
                                    <a class="btn-light dropdown-item" type="submit" name="name_fornecedores[]" href="./listar_custos_data.php?dataInicio=<?php echo ($tempIni); ?>&dataFim=<?php echo ($tempFim); ?>&pesquisa=<?php echo ($fornecedores['fornecedor']); ?>"><?php echo ($fornecedores['fornecedor']); ?></a>
                                <?php } ?>
                            </div>
                        </li>
                    </ul>

                    <?php
                    /* Buscar */
                    $name_classificacoes = isset($_POST['name_classificacoes']) ? $_POST['name_classificacoes'] : null;
                    $name_obras_gerais = isset($_POST['name_obras_gerais']) ? $_POST['name_obras_gerais'] : null;
                    $name_empresas = isset($_POST['name_empresas']) ? $_POST['name_empresas'] : null;
                    $name_fornecedores = isset($_POST['name_fornecedores']) ? $_POST['name_fornecedores'] : null;

                    /* Pegando valor da pesquisa */
                    $pesquisa = isset($_POST['pesquisa']) ? $_POST['pesquisa'] : null;

                    /* Se o valor da pesquisa via posto for null, pega pesquisa passada via GET */
                    if(empty($pesquisa)) $pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : null;

                    $num_results = 1;

                    if (!empty($name_classificacoes)) {
                        $pesquisa = $name_classificacoes[0];
                        $pagina = 1;
                    } elseif (!empty($name_obras_gerais)) {
                        $pesquisa = $name_obras_gerais[0];
                        $pagina = 1;
                    } elseif (!empty($name_empresas)) {
                        $pesquisa = $name_empresas[0];
                        $pagina = 1;
                    } elseif (!empty($name_fornecedores)) {
                        $pesquisa = $name_fornecedores[0];
                        $pagina = 1;
                    }

                    $select_custos = "SELECT * FROM pgtos_obras
                                            WHERE (numero LIKE '%" . $pesquisa . "%' OR
                                            classificacao LIKE '%" . $pesquisa . "%' OR                                           
                                            obra_geral LIKE '%" . $pesquisa . "%' OR                                            
                                            empresa LIKE '%" . $pesquisa . "%' OR
                                            fornecedor LIKE '%" . $pesquisa . "%') AND
                                            data_emissao BETWEEN $data_inicio AND $data_fim
                                            
                                            ORDER BY data_emissao ASC";

                    $select = mysqli_query($link, $select_custos);
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
                    ?>
                </form>
                <br><br>
                <legend class="title h1 text-center mb-4 mt-4">Meus Custos<?php if (!empty($pesquisa)) echo (' ' . '- ' . $pesquisa); ?></legend>
                <!-- Barra de navegacao entre tipos de movimento -->
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-despesas-tab" data-toggle="tab" href="#nav-despesas" role="tab" aria-controls="nav-despesas" aria-selected="true">Despesas</a>
                        <a class="nav-item nav-link" id="nav-receitas-tab" data-toggle="tab" href="#nav-receitas" role="tab" aria-controls="nav-despesas" aria-selected="false">Receitas</a>
                        <a class="nav-item nav-link" id="nav-resultado-tab" data-toggle="tab" href="#nav-resultado" role="tab" aria-controls="nav-resultados" aria-selected="false">Resultado</a>
                        <a class="nav-item nav-link" id="nav-relatorio-tab" data-toggle="tab" href="#nav-relatorio" role="tab" aria-controls="nav-relatorio" aria-selected="false">Relatório</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-despesas" role="tabpanel" aria-labelledby="nav-despesas-tab"><br>
                        <?php
                        /* Calculando o custo total */
                        $select_sum = "SELECT SUM(valor_total) AS TOTAL FROM pgtos_obras
                                    WHERE (numero LIKE '%" . $pesquisa . "%' OR
                                    classificacao LIKE '%" . $pesquisa . "%' OR
                                    obra_geral LIKE '%" . $pesquisa . "%' OR
                                    empresa LIKE '%" . $pesquisa . "%' OR
                                    fornecedor LIKE '%" . $pesquisa . "%') AND
                                    data_emissao BETWEEN $data_inicio AND $data_fim AND
                                    tipo_movimento = 1";

                        $query_sum = mysqli_query($link, $select_sum);
                        $row_sum   = mysqli_fetch_assoc($query_sum);
                        $despesas_total = $row_sum['TOTAL'];
                        $despesas_total_format = number_format($despesas_total, 2, ',', '.');
                        ?>
                        <!-- Gasto total-->
                        <h2 id="despesas_total_exibir" class="text-left ml-2 mt-0">Despesas R$ <?php echo ($despesas_total_format); ?></h2><br>
                        <!-- Listagem de registros -->
                        <div class="table-responsive">
                            <?php

                            $resultado_despesas = mysqli_query($link, $select_custos);

                            ?>
                            <table class="table table-hover" style="white-space:nowrap;">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center align-middle">Data de Emissão</th>
                                        <th scope="col" class="text-center align-middle">Fornecedor</th>
                                        <th scope="col" class="text-center align-middle">Nota</th>
                                        <th scope="col" class="text-center align-middle">Descrição</th>
                                        <th scope="col" class="text-center align-middle">Qtde</th>
                                        <th scope="col" class="text-center align-middle">Valor unitário</th>
                                        <th scope="col" class="text-center align-middle">Valor total</th>
                                    </tr>
                                </thead>
                                <?php

                                $tag_de_contagem = 0;
                                while ($array = mysqli_fetch_array($resultado_despesas)) {
                                    if ($array['tipo_movimento'] == 1) {

                                ?>
                                    <tbody>
                                        <form action="confirma.php" method="post">
                                            <tr>
                                                <?php
                                                $str_qtd = $array['qtd'];
                                                $str_unitario = $array['valor_unitario'];
                                                $str_numero = $array['numero'];
                                                if ($str_qtd == '0' && $str_unitario == '0' && $str_numero == '0') {
                                                    $str_qtd = '-';
                                                    $str_unitario = '-';
                                                    $str_numero = '-';
                                                } elseif ($str_unitario != '0' && $str_numero == '0') {
                                                    $str_unitario = number_format($array['valor_unitario'], 2, ',', '.');
                                                    $str_numero = '-';
                                                } elseif ($str_qtd == '0' && $str_unitario == '0' && $str_numero != '0') {
                                                    $str_qtd = '-';
                                                    $str_unitario = '-';
                                                } elseif ($str_numero == '0') {
                                                    $str_numero = '-';
                                                } else {
                                                    $str_unitario = number_format($str_unitario, 2, ',', '.');
                                                }
                                                ?>

                                                <td class="text-center"><?php echo date('d/m/Y', strtotime($array['data_emissao'])); ?></td>
                                                <td class="text-left"><?php echo ($array['fornecedor']); ?></td>
                                                <td class="text-center"><?php echo ($str_numero); ?></td>
                                                <td class="text-left"><?php echo ($array['descricao']); ?></td>
                                                <td class="text-center"><?php echo ($str_qtd); ?></td>
                                                <td class="text-center"><?php echo ($str_unitario); ?></td>
                                                <td class="text-center"><?php echo ($array['valor_total'] = number_format($array['valor_total'], 2, ',', '.')); ?></td>
                                            </tr>
                                        </form>
                                    </tbody>
                                <?php
                                    }
                                    $tag_de_contagem = $tag_de_contagem + 1;
                                } ?>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-receitas" role="tabpanel" aria-labelledby="nav-receitas-tab"><br>
                        <?php

                        /* Calculando o custo total */
                        $select_sum = "SELECT SUM(valor_total) AS TOTAL FROM pgtos_obras
                                    WHERE (numero LIKE '%" . $pesquisa . "%' OR
                                    classificacao LIKE '%" . $pesquisa . "%' OR
                                    obra_geral LIKE '%" . $pesquisa . "%' OR
                                    empresa LIKE '%" . $pesquisa . "%' OR
                                    fornecedor LIKE '%" . $pesquisa . "%') AND
                                    data_emissao BETWEEN $data_inicio AND $data_fim AND
                                    tipo_movimento = 0";

                        $query_sum = mysqli_query($link, $select_sum);
                        $row_sum   = mysqli_fetch_assoc($query_sum);
                        $receitas_total = $row_sum['TOTAL'];
                        $receitas_total_format = number_format($receitas_total, 2, ',', '.');
                        ?>
                        <!-- Gastos total-->
                        <h2 id="receitas_total_exibir" class="text-left ml-2 mt-0">Receitas R$ <?php echo ($receitas_total_format); ?></h2><br>
                        <!-- Listagem de registros -->
                        <div class="table-responsive">
                            <?php

                            $resultado_receitas = mysqli_query($link, $select_custos);

                            ?>
                            <table class="table table-hover" style="white-space:nowrap;">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center align-middle">Data de Emissão</th>
                                        <th scope="col" class="text-center align-middle">Fornecedor</th>
                                        <th scope="col" class="text-center align-middle">Nota</th>
                                        <th scope="col" class="text-center align-middle">Descrição</th>
                                        <th scope="col" class="text-center align-middle">Qtde</th>
                                        <th scope="col" class="text-center align-middle">Valor unitário</th>
                                        <th scope="col" class="text-center align-middle">Valor total</th>
                                    </tr>
                                </thead>
                                <?php
                                $tag_de_contagem = 0;
                                while ($array = mysqli_fetch_array($resultado_receitas)) {
                                    if ($array['tipo_movimento'] == 0) {
                                ?>
                                    <tbody>
                                        <form action="confirma.php" method="post">
                                            <tr>
                                                <?php
                                                $str_qtd = $array['qtd'];
                                                $str_unitario = $array['valor_unitario'];
                                                $str_numero = $array['numero'];
                                                if ($str_qtd == '0' && $str_unitario == '0' && $str_numero == '0') {
                                                    $str_qtd = '-';
                                                    $str_unitario = '-';
                                                    $str_numero = '-';
                                                } elseif ($str_unitario != '0' && $str_numero == '0') {
                                                    $str_unitario = number_format($array['valor_unitario'], 2, ',', '.');
                                                    $str_numero = '-';
                                                } elseif ($str_qtd == '0' && $str_unitario == '0' && $str_numero != '0') {
                                                    $str_qtd = '-';
                                                    $str_unitario = '-';
                                                } elseif ($str_numero == '0') {
                                                    $str_numero = '-';
                                                } else {
                                                    $str_unitario = number_format($str_unitario, 2, ',', '.');
                                                }
                                                ?>

                                                <td class="text-center"><?php echo date('d/m/Y', strtotime($array['data_emissao'])); ?></td>
                                                <td class="text-left"><?php echo ($array['fornecedor']); ?></td>
                                                <td class="text-center"><?php echo ($str_numero); ?></td>
                                                <td class="text-left"><?php echo ($array['descricao']); ?></td>
                                                <td class="text-center"><?php echo ($str_qtd); ?></td>
                                                <td class="text-center"><?php echo ($str_unitario); ?></td>
                                                <td class="text-center"><?php echo ($array['valor_total'] = number_format($array['valor_total'], 2, ',', '.')); ?></td>
                                            </tr>
                                        </form>
                                    </tbody>
                                <?php
                                    }
                                    $tag_de_contagem = $tag_de_contagem + 1;
                                } ?>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-resultado" role="tabpanel" aria-labelledby="nav-resultado-tab"><br>
                        <!-- Resultados-->
                        <?php
                        $resultado_total = ($receitas_total - $despesas_total);
                        $resultado_total_format = number_format($resultado_total, 2, ',', '.');
                        ?>
                        <h2 id="resultado_total_exibir" class="text-left ml-2 mt-0">
                            Resultado R$
                            <strong class="<?= $resultado_total < 0 ? 'negativo' : 'positivo' ?>" id="resultado2">
                                <?php echo ($resultado_total_format); ?>
                                <span class="material-icons"><?= $resultado_total < 0 ? 'south' : 'north' ?></span>
                            </strong>
                        </h2>
                        <br>

                        <?php
                        $nomeData = "$tempIni" . " até " . "$tempFim";
                        $despesas_grafico = number_format($despesas_total, 2, '.', '');
                        $receitas_grafico = number_format($receitas_total, 2, '.', '');
                        $dataPoints1[0] = array("label" =>  $nomeData, "y" => $despesas_grafico);
                        $dataPoints2[0] = array("label" =>  $nomeData, "y" => $receitas_grafico);
                        ?>
                        
                        <section class="container">
                            <div class="row">
                                <div class="col-12">
                                    <!-- Div grafico -->
                                    <div id="chartContainer" style="height: 400px; width: 100%;"></div>
                                </div>
                            </div>
                        </section>   
                        <br>
                    </div>

                    <div class="tab-pane fade" id="nav-relatorio" role="tabpanel" aria-labelledby="nav-relatorio-tab"><br>
                        <h2 id="despesas_class_exibir" class="text-left ml-2 mt-0">Despesas por Classificação</h2>
                        <?php
                            $select_classificacao = "SELECT classificacao, SUM(valor_total) AS TOTAL 
                            FROM pgtos_obras WHERE (numero LIKE '%" . $pesquisa . "%' OR
                            classificacao LIKE '%" . $pesquisa . "%' OR                                           
                            obra_geral LIKE '%" . $pesquisa . "%' OR                                            
                            empresa LIKE '%" . $pesquisa . "%' OR
                            fornecedor LIKE '%" . $pesquisa . "%') AND
                            data_emissao BETWEEN $data_inicio AND $data_fim AND
                            tipo_movimento = 1
                            GROUP BY classificacao
                            ORDER BY classificacao ASC";
                            $linha_relatorio = mysqli_query($link, $select_classificacao);
                        ?>
                        <div class="table-responsive">
                            <table class="table table-hover" style="white-space:nowrap;">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center align-middle">Classificação</th>
                                        <th scope="col" class="text-center align-middle">Total</th>
                                        <th scope="col" class="text-center align-middle">&nbsp;</th>
                                        <th scope="col" class="text-center align-middle">&nbsp;</th>
                                    </tr>
                                </thead>
                                <?php
                                    $tag_de_contagem = 0;
                                    while ($array = mysqli_fetch_array($linha_relatorio)) {
                                        if (!empty($array['classificacao'])){
                                ?>
                                <tbody>
                                    <form action="confirma.php" method="post">
                                        <tr>
                                            <td class="text-center"><?php echo ($array['classificacao']); ?></td>
                                            <td class="text-center"><?php echo ("R$ " . $array['TOTAL'] = number_format($array['TOTAL'], 2, ',', '.')); ?></td>
                                            <td class="text-center">&nbsp;</td>
                                            <td class="text-center">&nbsp;</td>
                                        </tr>
                                    </form>
                                </tbody>
                                <?php
                                        }
                                    $tag_de_contagem = $tag_de_contagem + 1;
                                }   
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <div class='fab'>
                <button name="btn_subir" id="myScroll" type="submit" class="btn btn-link p-1" onclick="irParaTopo()" value='<?php echo ($tag_de_contagem); ?>'>
                    <span class='material-icons align-middle text-center' alt='Botão rolar inicio' style='font-size: 40px;'>
                        arrow_upward
                    </span>
                </button>
            </div>
            <br>

            <!-- Funcao de rolar para topo da pagina -->
            <script type="text/javascript">

                var mybutton = document.getElementById("myScroll");

                /* quando rolar a página 20px do topo para baixo, o botão será exibido */
                window.onscroll = function() {
                    scrollFunction()
                };

                function scrollFunction() {
                    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                        mybutton.style.display = "block";
                    } else {
                        mybutton.style.display = "none";
                    }
                }
                /* Rolar para o topo */
                const irParaTopo = () => window.scrollTo(0, 0);
            </script>

            <script>
                /* Grafico */
                window.onload = function() {

                    var chart = new CanvasJS.Chart("chartContainer", {
                        animationEnabled: true,
                        theme: "light2",
                        title: {
                            text: "Despesas Vs Receitas"
                        },
                        axisY: {
                            includeZero: true,
                            valueFormatString: "R$ ##0.00"
                        },
                        legend: {
                            cursor: "pointer",
                            verticalAlign: "center",
                            horizontalAlign: "right",
                            itemclick: toggleDataSeries
                        },
                        width: 1100,
                        dataPointWidth: 60,
                        data: [{
                            type: "column",
                            name: "Despesas",
                            indexLabel: "{y}",
                            color: "#ff0000",
                            yValueFormatString: "R$ ##0.00",
                            showInLegend: true,
                            dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
                        }, {
                            type: "column",
                            name: "Receitas",
                            indexLabel: "{y}",
                            color: "#009900",
                            yValueFormatString: "R$ ##0.00",
                            showInLegend: true,
                            dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
                        }]
                    });
                    chart.render();

                    function toggleDataSeries(e) {
                        if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                            e.dataSeries.visible = false;
                        } else {
                            e.dataSeries.visible = true;
                        }
                        chart.render();
                    }
                }
            </script>

            <?php $menu->getFooter(); ?>
            <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
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