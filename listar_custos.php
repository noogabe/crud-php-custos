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


            <!-- INSIRA OS ELEMENTOS AQUI -->

            <section class='container col-12'>

                <!-- BARRA BUSCAR NOTA -->
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
                            <a class="btn nav active" onclick="window.location.href='./listar_custos.php'">Geral</a>
                        </li>                        

                        <li class="nav-item dropdown">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Empresas</a>
                            <div class="dropdown-menu">
                                <?php
                                $query_select = "SELECT empresa FROM notas_compras UNION
                                                SELECT empresa FROM notas_servicos 
                                                ORDER BY empresa ASC";
                                $select = mysqli_query($link, $query_select);
                                while ($empresa2 = mysqli_fetch_array($select)) { ?>
                                    <button name="name_empresas[]" type="submit" value="<?php echo ($empresa2['empresa']); ?>" class="btn-light dropdown-item"><?php echo ($empresa2['empresa']); ?></button>
                                <?php } ?>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Obras</a>
                            <div class="dropdown-menu">
                                <?php
                                $query_select = "SELECT obra_geral FROM notas_compras UNION
                                                SELECT obra_geral FROM notas_servicos 
                                                ORDER BY obra_geral ASC";
                                $select = mysqli_query($link, $query_select);
                                while ($obra_geral2 = mysqli_fetch_array($select)) { ?>
                                    <button name="name_obras_gerais[]" type="submit" value="<?php echo ($obra_geral2['obra_geral']); ?>" class="btn-light dropdown-item"><?php echo ($obra_geral2['obra_geral']); ?></button>
                                <?php } ?>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sub obras</a>
                            <div class="dropdown-menu">
                                <?php
                                $query_select = "SELECT sub_obra FROM notas_compras UNION
                                                SELECT sub_obra FROM notas_servicos 
                                                ORDER BY sub_obra ASC";
                                $select = mysqli_query($link, $query_select);
                                while ($sub_obra4 = mysqli_fetch_array($select)) { ?>
                                    <button name="name_sub_obras[]" type="submit" value="<?php echo ($sub_obra4['sub_obra']); ?>" class=" btn-light dropdown-item"><?php echo ($sub_obra4['sub_obra']); ?></button>
                                <?php } ?>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Veículos</a>
                            <div class="dropdown-menu">
                                <?php
                                $query_select = "SELECT frota_veiculo FROM notas_compras UNION
                                                SELECT frota_veiculo FROM notas_servicos 
                                                ORDER BY frota_veiculo ASC";
                                $select = mysqli_query($link, $query_select);
                                while ($frota_veiculo2 = mysqli_fetch_array($select)) { ?>
                                    <button name="name_veiculos[]" type="submit" value="<?php echo ($frota_veiculo2['frota_veiculo']); ?>" class="btn-light dropdown-item"><?php echo ($frota_veiculo2['frota_veiculo']); ?></button>
                                <?php } ?>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tipos de manutenção</a>
                            <div class="dropdown-menu">
                                <?php
                                $query_select = "SELECT tipo_produto AS TIPO FROM notas_compras UNION
                                                SELECT tipo_manutencao AS TIPO FROM notas_servicos 
                                                ORDER BY TIPO ASC";
                                $select = mysqli_query($link, $query_select);
                                while ($tipo = mysqli_fetch_array($select)) { ?>
                                    <button name="name_tipos[]" type="submit" value="<?php echo ($tipo['TIPO']); ?>" class="btn-light dropdown-item"><?php echo ($tipo['TIPO']); ?></button>
                                <?php } ?>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Fornecedores</a>
                            <div class="dropdown-menu">
                                <?php
                                $query_select = "SELECT fornecedor FROM notas_compras UNION
                                                SELECT fornecedor FROM notas_servicos 
                                                ORDER BY fornecedor ASC";
                                $select = mysqli_query($link, $query_select);
                                while ($fornecedores = mysqli_fetch_array($select)) { ?>
                                    <button name="name_fornecedores[]" type="submit" value="<?php echo ($fornecedores['fornecedor']); ?>" class="btn-light dropdown-item"><?php echo ($fornecedores['fornecedor']); ?></button>
                                <?php } ?>
                        </li>

                    </ul>

                    <?php

                    /* BUSCAR CUSTOS */
                    $name_tipos = filter_input(INPUT_POST, 'name_tipos[]', FILTER_SANITIZE_STRING);
                    $name_tipos = $_POST['name_tipos'];

                    $name_veiculos = filter_input(INPUT_POST, 'name_veiculos[]', FILTER_SANITIZE_STRING);
                    $name_veiculos = $_POST['name_veiculos'];

                    $name_sub_obras = filter_input(INPUT_POST, 'name_sub_obras[]', FILTER_SANITIZE_STRING);
                    $name_sub_obras = $_POST['name_sub_obras'];

                    $name_obras_gerais = filter_input(INPUT_POST, 'name_obras_gerais[]', FILTER_SANITIZE_STRING);
                    $name_obras_gerais = $_POST['name_obras_gerais'];

                    $name_empresas = filter_input(INPUT_POST, 'name_empresas[]', FILTER_SANITIZE_STRING);
                    $name_empresas = $_POST['name_empresas'];

                    $name_fornecedores = filter_input(INPUT_POST, 'name_fornecedores[]', FILTER_SANITIZE_STRING);
                    $name_fornecedores = $_POST['name_fornecedores'];
                    
                    $pesquisa = filter_input(INPUT_POST, 'pesquisa', FILTER_SANITIZE_STRING);
                    $pesquisa = isset($_POST['pesquisa']) ? $_POST['pesquisa'] : null;
                    
                    $num_results = 1;

                    if(!empty($name_tipos)){
                        $pesquisa = $name_tipos[0];

                    } elseif(!empty($name_veiculos)){
                        $pesquisa = $name_veiculos[0];

                    } elseif(!empty($name_sub_obras)){
                        $pesquisa = $name_sub_obras[0];

                    } elseif(!empty($name_obras_gerais)){
                        $pesquisa = $name_obras_gerais[0];

                    } elseif(!empty($name_empresas)){
                        $pesquisa = $name_empresas[0];

                    } elseif(!empty($name_fornecedores)){
                        $pesquisa = $name_fornecedores[0];

                    }


                    $select_servico_compra = "SELECT numero, fornecedor, data_emissao, nome_produto AS descricao, 
                                            tipo_produto AS tipo, qtd, valor_unitario, valor_total, frota_veiculo,
                                            marca_veiculo, sub_obra, obra_geral, empresa FROM notas_compras
                                            WHERE numero LIKE '%" . $pesquisa . "%' OR
                                            tipo_produto LIKE '%" . $pesquisa . "%' OR
                                            frota_veiculo LIKE '%" . $pesquisa . "%' OR
                                            obra_geral LIKE '%" . $pesquisa . "%' OR
                                            sub_obra LIKE '%" . $pesquisa . "%' OR
                                            empresa LIKE '%" . $pesquisa . "%' OR
                                            fornecedor LIKE '%" . $pesquisa . "%'

                                            UNION ALL

                                            SELECT numero, fornecedor, data_emissao, descricao_servico AS descricao, 
                                            tipo_manutencao AS tipo, qtd, valor_unitario, valor_total, frota_veiculo,
                                            marca_veiculo, sub_obra, obra_geral, empresa FROM notas_servicos
                                            WHERE numero LIKE '%" . $pesquisa . "%' OR
                                            tipo_manutencao LIKE '%" . $pesquisa . "%' OR
                                            frota_veiculo LIKE '%" . $pesquisa . "%' OR
                                            obra_geral LIKE '%" . $pesquisa . "%' OR
                                            sub_obra LIKE '%" . $pesquisa . "%' OR
                                            empresa LIKE '%" . $pesquisa . "%' OR
                                            fornecedor LIKE '%" . $pesquisa . "%'
                                            
                                            ORDER BY data_emissao ASC";

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





                <br><br>


                <legend class="title h1 text-center mb-4 mt-4">Meus Custos</legend>

                <?php
                //Calculando o custo total de compras + servicos
                $select_sum = "SELECT SUM(valor_total) AS TOTAL FROM
                                    (SELECT SUM(C.valor_total) AS valor_total FROM notas_compras AS C
                                    WHERE numero LIKE '%" . $pesquisa . "%' OR
                                            tipo_produto LIKE '%" . $pesquisa . "%' OR
                                            frota_veiculo LIKE '%" . $pesquisa . "%' OR
                                            obra_geral LIKE '%" . $pesquisa . "%' OR
                                            sub_obra LIKE '%" . $pesquisa . "%' OR
                                            empresa LIKE '%" . $pesquisa . "%' OR
                                            fornecedor LIKE '%" . $pesquisa . "%'
                                    UNION
                                    SELECT SUM(S.valor_total) AS valor_total FROM notas_servicos AS S
                                    WHERE numero LIKE '%" . $pesquisa . "%' OR
                                    tipo_manutencao LIKE '%" . $pesquisa . "%' OR
                                    frota_veiculo LIKE '%" . $pesquisa . "%' OR
                                    obra_geral LIKE '%" . $pesquisa . "%' OR
                                    sub_obra LIKE '%" . $pesquisa . "%' OR
                                    empresa LIKE '%" . $pesquisa . "%' OR
                                    fornecedor LIKE '%" . $pesquisa . "%') AS TAB";

                $query_sum = mysqli_query($link, $select_sum);
                $row_sum   = mysqli_fetch_assoc($query_sum);

                $custo_total = $row_sum['TOTAL'];
                $custo_total = number_format($custo_total, 2, '.', '');

                ?>

                <!-- INSERIR AQUI O GASTO TOTAL-->
                <h2 class="text-left ml-2 mt-4">Custo total R$ <?php echo ($custo_total); ?></h2>

                <!-- LISTA DE CUSTOS COMPRAS E SERVIÇOS -->
                <div class="card ml-2">

                    <?php
                    $select_compra2 = "SELECT numero, fornecedor, data_emissao, nome_produto AS descricao, 
                                        tipo_produto AS tipo, qtd, valor_unitario, valor_total, frota_veiculo,
                                        marca_veiculo, sub_obra, obra_geral, empresa FROM notas_compras
                                        WHERE numero LIKE '%" . $pesquisa . "%' OR
                                            tipo_produto LIKE '%" . $pesquisa . "%' OR
                                            frota_veiculo LIKE '%" . $pesquisa . "%' OR
                                            obra_geral LIKE '%" . $pesquisa . "%' OR
                                            sub_obra LIKE '%" . $pesquisa . "%' OR
                                            empresa LIKE '%" . $pesquisa . "%' OR
                                            fornecedor LIKE '%" . $pesquisa . "%'
                                    
                                        UNION ALL

                                        SELECT numero, fornecedor, data_emissao, descricao_servico AS descricao, 
                                        tipo_manutencao AS tipo, qtd, valor_unitario, valor_total, frota_veiculo,
                                        marca_veiculo, sub_obra, obra_geral, empresa FROM notas_servicos
                                        WHERE numero LIKE '%" . $pesquisa . "%' OR
                                        tipo_manutencao LIKE '%" . $pesquisa . "%' OR
                                        frota_veiculo LIKE '%" . $pesquisa . "%' OR
                                        obra_geral LIKE '%" . $pesquisa . "%' OR
                                        sub_obra LIKE '%" . $pesquisa . "%' OR
                                        empresa LIKE '%" . $pesquisa . "%' OR
                                        fornecedor LIKE '%" . $pesquisa . "%'

                                        
                                        ORDER BY data_emissao ASC";


                    $select2 = mysqli_query($link, $select_compra2);
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
                                <th scope="col" class="text-center align-middle">Veículo</th>
                                <th scope="col" class="text-center align-middle">Sub obra</th>
                                <th scope="col" class="text-center align-middle">Empresa</th>
                            </tr>

                        </thead>

                        <?php
                        $tag_de_contagem = 0;
                        while ($array = mysqli_fetch_array($select2)) {
                        ?>

                            <tbody>
                                <form action="confirma.php" method="post">
                                    <tr> 
                                        
                                        <td class="align-middle"><?php echo date('d/m/Y', strtotime($array['data_emissao'])); ?></td>
                                        <td class="align-middle"><?php echo ($array['fornecedor']); ?></td>
                                        <td class="align-middle"><?php echo ($array['numero']); ?></td>
                                        <td class="align-middle"><?php echo ($array['descricao']); ?></td>
                                        <td class="align-middle"><?php echo ($array['qtd']); ?></td>
                                        <td class="align-middle"><?php echo ($array['valor_unitario'] = number_format($array['valor_unitario'], 2, '.', '')); ?></td>
                                        <td class="align-middle"><?php echo ($array['valor_total']= number_format($array['valor_total'], 2, '.', '')); ?></td>
                                        <td class="align-middle"><?php echo ($array['frota_veiculo']); ?></td>
                                        <td class="align-middle"><?php echo ($array['sub_obra']); ?></td>
                                        <td class="align-middle"><?php echo ($array['empresa']); ?></td>


                                </form>
                                </tr>

                            </tbody>
                        <?php
                            $tag_de_contagem = $tag_de_contagem + 1;
                        } ?>

                    </table>

                </div>
                
            </section>
            <br>

            <script type="text/javascript">
                
                let filtro = document.getElementById('filtro_frota_veiculo')
                let pesquisa = document.getElementById('pesquisa_custo')
                let name_veiculos = <?php $name_veiculos;?>

                name_veiculos.addEventListener('click', function(evt) {
                    let selector_value = document.querySelector('a[value="'+this.value+'"]')
                    if (selector_value) {
                        let x = selector_value.getAttribute('value')
                        //pesquisa.setAttribute('value', x)
                        //console.log(pesquisa)
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