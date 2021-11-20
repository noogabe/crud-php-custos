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
        /* Continua apos o HTML */

?>

    <!DOCTYPE HTML>
    <html lang="pt-br">

        <head>

            <title>Editar - Distribuição de custo</title>
            <?php $menu->getHead(); ?>

        </head>

        <body>

            <!--Sidebar-->
            <?php $menu->getNavbar(); ?>
            <section class='container'>
                <form action="confirma.php" method="POST">
                    <div class="m-2">

                        <?php
                        $id_pagamento = $_GET['id_pagamento'];
                        $numero = $_GET['numero'];
                        $data_emissao = $_GET['data_emissao'];
                        $fornecedor = $_GET['fornecedor'];
                        $descricao = $_GET['descricao'];
                        $classificacao = $_GET['classificacao'];
                        $qtd = $_GET['qtd'];
                        $valor_unitario = $_GET['valor_unitario'];
                        $valor_total = $_GET['valor_total'];
                        $obra_geral = $_GET['obra_geral'];
                        $empresa = $_GET['empresa'];
                        $observacao = $_GET['observacao'];
                        ?>

                        <legend class="title h1 text-center mb-4 mt-4">Editar distribuição de custo</legend>

                        <div class="p-2 card">
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="hidden" name="id_pagamento" value='<?php echo ($id_pagamento); ?>'>
                                    <div>
                                        <strong>Fornecedor:</strong><br>
                                        <input autocomplete="off" class='text-box form-control' type="text" name="emitente_nome" rows="1" placeholder="Fornecedor" required value="<?php echo ($fornecedor); ?>">
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <strong>Nº da nota:</strong><br>
                                            <input autocomplete="off" class='text-box form-control' name="numero" rows="1" placeholder="Número da nota" required value="<?php echo ($numero); ?>">
                                        </div>
                                        <div class="col">
                                            <strong>Data de emissão:</strong><br>
                                            <input class='text-box form-control' type="date" name="data_emissao" rows="1" placeholder=" dd/mm/yyyy" required value="<?php echo ($data_emissao); ?>">
                                        </div>
                                    </div>
                                    <div>
                                        <strong>Descrição:</strong><br>
                                        <input autocomplete="off" class='text-box form-control' name="descricao" rows="1" placeholder="Digite a descrição" value="<?php echo ($descricao); ?>">
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <strong>Quantidade:</strong><br>
                                            <input class='text-box form-control' id="qtd_servico_editar6" type='number' name="qtd" rows="1" placeholder="Digite a quantidade" value="<?php echo ($qtd); ?>">
                                        </div>
                                        <div class="col">
                                            <strong>Classificação:</strong><br>
                                            <select required class="custom-select" name="classificacao">
                                                <option value="" disabled>Selecione uma classificação</option>
                                                <option selected><?php echo ($classificacao); ?></option>
                                                <?php
                                                    $query_select = "SELECT classificacao FROM classificacoes ORDER BY classificacao ASC";
                                                    $select = mysqli_query($link, $query_select);
                                                    while ($classificacao2 = mysqli_fetch_array($select)) { 
                                                        if ($classificacao2['classificacao'] != $classificacao) {?>
                                                        <option value="<?php echo ($classificacao2['classificacao']); ?>"><?php echo ($classificacao2['classificacao']); ?></option>   
                                                <?php } 
                                                } ?>
                                            </select>
                                        </div>
                                    </div>  
                                    <div class="row">
                                        <div class="col">
                                            <strong>Valor unitário:</strong><br>
                                            <input class='text-box form-control' id="vunitario_servico_editar6" type="text" min="0" step="0.010" name="valor_unitario" rows="1" placeholder="R$" value="<?php echo ($valor_unitario); ?>" onkeyup="formatarMoeda('vunitario_servico_editar6')">
                                        </div>
                                        <div class="col">
                                            <strong>Valor total:</strong><br>
                                            <input class='text-box form-control' id="vtotal_servico_editar6" type="text" min="0" step="0.010" name="valor_total" rows="1" placeholder="R$" value="<?php echo ($valor_total); ?>" onkeyup="formatarMoeda('vtotal_servico_editar6')">
                                        </div>
                                    </div>
                                    <div>
                                        <strong>Obra geral:</strong><br>
                                        <select required class="custom-select" name="obra_geral">
                                            <option value="" disabled>Selecione uma obra geral</option>
                                            <option selected><?php echo ($obra_geral); ?></option>
                                            <?php
                                            $query_select = "SELECT obra_geral FROM obras_gerais ORDER BY obra_geral ASC";
                                            $select = mysqli_query($link, $query_select);
                                            while ($obra = mysqli_fetch_array($select)) {
                                                if ($obra['obra_geral'] != $obra_geral) { ?>
                                                <option value="<?php echo ($obra['obra_geral']); ?>"><?php echo ($obra['obra_geral']); ?></option>
                                                <?php }
                                                } ?>
                                        </select>
                                    </div>
                                    <div>
                                        <strong>Empresa:</strong><br>
                                        <select required class="custom-select" name="empresa">
                                            <option value="" disabled>Selecione uma empresa</option>
                                            <option selected><?php echo ($empresa); ?></option>
                                            <?php
                                            $query_select = "SELECT empresa FROM empresas ORDER BY empresa ASC";
                                            $select = mysqli_query($link, $query_select);
                                            while ($empresa2 = mysqli_fetch_array($select)) { 
                                                if ($empresa2['empresa'] != $empresa) { ?>
                                                <option value="<?php echo ($empresa2['empresa']); ?>"><?php echo ($empresa2['empresa']); ?></option>
                                                <?php }
                                                } ?>
                                        </select>
                                    </div>
                                    <div>
                                        <strong>Observação:</strong><br>
                                        <input class='text-box form-control' name="observacao" rows="2" placeholder="Digite uma observação" value="<?php echo ($observacao); ?>">
                                    </div><br>

                                    <div class="d-flex justify-content-center">
                                        <button type="button" class='btn btn-default small p-2 m-1 mb-2' onclick="window.location.href='./listar_servicos.php'">
                                            <strong>Cancelar</strong>
                                            <span class="material-icons align-middle">close</span>
                                        </button>

                                        <button name="btn_editar_item_servico" class="btn btn-success small p-2 m-1 mb-2" value='<?php echo ($id_pagamento); ?>'>
                                            <strong>Concluir</strong>
                                            <span class="material-icons align-middle">check</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                    </div>
                </form>
            <section>

                <script>

                    //Formatar moeda
                    function formatarMoeda(identity) {
                    var elemento = document.getElementById(identity);
                    var valor = elemento.value;

                    valor = valor + '';
                    valor = parseInt(valor.replace(/[\D]+/g, ''));
                    valor = valor + '';
                    valor = valor.replace(/([0-9]{2})$/g, ".$1");

                    if (valor.length > 6) {
                        valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, "$1.$2");
                    }

                    elemento.value = valor;
                    if (valor == 'NaN') elemento.value = '';
                    }

                    //Função obter valor total através da quantidade e valor unitário
                    $(document).ready(function() {
                        $("#vunitario_servico_editar, #qtd_servico_editar").change(function() {
                            var valor_unit = $("#vunitario_servico_editar").val();
                            var qtd = $("#qtd_servico_editar").val();
                            var calculo = parseFloat(valor_unit.replace(',', '.'), 2) * parseFloat(qtd.replace(',', '.'), 2);
                            $("#vtotal_servico_editar").val(calculo.toFixed(2));
                        });
                    });              
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