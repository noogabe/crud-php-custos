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
            <title>Custo - Distribuir Custo NFs</title>
            <?php $menu->getHead(); ?>
        </head>

        <body>
            <!--Sidebar-->
            <?php $menu->getNavbar(); ?>

            <section class='container'>

                <legend class="title h1 text-center mb-4 mt-4">Distribuir Custo (NFs)</legend>
                <form method="post" action="confirma.php">
                    <div class="p-2 card">
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="hidden" name="tipo_documento" value="NFS">
                                <div>
                                    <strong>Fornecedor:</strong><br>
                                    <input autocomplete="off" class='text-box form-control' type="text" name="emitente_nome" rows="1" placeholder="Fornecedor" required>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <strong>Nº da nota:</strong><br>
                                        <input autocomplete="off" class='text-box form-control' name="numero" rows="1" placeholder="Número da nota" required>
                                    </div>
                                    <div class="col">
                                        <strong>Data de emissão:</strong><br>
                                        <input class='text-box form-control' type="date" name="data_emissao" rows="1" placeholder=" dd/mm/yyyy" required>
                                    </div>
                                </div>
                                <div>
                                    <strong>Descrição do serviço:</strong><br>
                                    <input autocomplete="off" class='text-box form-control' id="id_descricao" type="text" name="descricao_servico" rows="1" placeholder="Digite a descrição" required>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <strong>Qtde:</strong><br>
                                        <input autocomplete="off" class='text-box form-control' id="qtd_servico" type="number" min="0" name="qtd" rows="1" placeholder="Digite a quantidade" required>
                                    </div>
                                    <div class="col">
                                        <strong>Classificação:</strong><br>
                                        <select required class="custom-select" name="classificacao">
                                            <option value="" disabled selected>Selecione uma classificação</option>
                                            <?php
                                            $query_select = "SELECT classificacao FROM classificacoes ORDER BY classificacao ASC";
                                            $select = mysqli_query($link, $query_select);
                                            while ($classificacao2 = mysqli_fetch_array($select)) { ?>
                                                <option><?php echo ($classificacao2['classificacao']); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <strong>Valor unitário:</strong><br>
                                        <input list="val" class='text-box form-control' autocomplete="off" id="vunitario_servico" type="text" min="0" step="0.010" name="valor_unitario" rows="1" placeholder="R$" onkeyup="formatarMoeda('vunitario_servico')" required>
                                    </div>
                                    <div class="col">
                                        <strong>Valor total:</strong><br>
                                        <input class='text-box form-control' id="vtotal_servico" autocomplete="off" type="text" min="0" step="0.010" name="valor_total" rows="1" placeholder="R$" onkeyup="formatarMoeda('vtotal_servico')" required>
                                    </div>
                                </div>
                                <div>
                                    <strong>Obra geral:</strong><br>
                                    <select required class="custom-select" name="obra_geral">
                                        <option value="" disabled selected>Selecione uma obra geral</option>
                                        <?php
                                        $query_select = "SELECT obra_geral FROM obras_gerais ORDER BY obra_geral ASC";
                                        $select = mysqli_query($link, $query_select);
                                        while ($obra = mysqli_fetch_array($select)) { ?>
                                            <option><?php echo ($obra['obra_geral']); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div>
                                    <strong>Empresa:</strong><br>
                                    <select required class="custom-select" name="empresa">
                                        <option value="" disabled selected>Selecione uma empresa</option>
                                        <?php
                                        $query_select = "SELECT empresa FROM empresas ORDER BY empresa ASC";
                                        $select = mysqli_query($link, $query_select);
                                        while ($empresa = mysqli_fetch_array($select)) { ?>
                                            <option><?php echo ($empresa['empresa']); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div>
                                    <strong>Observação (opcional):</strong><br>
                                    <textarea class='text-box form-control' autocomplete="off" type="text" name="observacao" rows="2" placeholder=" Digite uma observação"></textarea>
                                </div><br>
                                <div class="d-flex justify-content-center">
                                    <button type="button" class='btn btn-default small p-2 m-1 mb-2' onclick="window.location.href='./listar_servicos2.php'">
                                        <strong>Cancelar</strong>
                                        <span class="material-icons align-middle">close</span>
                                    </button>
                                    <button type='submit' id='concluir-servico' name="btn_servico_salva" class="btn bt-click btn-success small p-2 m-1 mb-2" value="1">
                                        <strong>Concluir</strong>
                                        <span class="material-icons align-middle">check</span>
                                    </button>
                                    <br>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><br>
            </section>

            <script type="text/javascript">
                
                $(document).ready(function() {
                    //Função para desabilitar a tecla ENTER e não enviar formulário por acidente
                    $('#concluir-servico').keypress(function(e) {
                        var code = null;
                        code = (e.keyCode ? e.keyCode : e.which);
                        return (code == 13) ? false : true;
                    });

                    //Função obter valor total através da quantidade e valor unitário
                    $("#vunitario_servico, #qtd_servico").change(function() {
                        var valor_unit = $("##vunitario_servico").val();
                        var qtd = $("#qtd_servico").val();
                        var calculo = parseFloat(valor_unit.replace(',', '.'), 2) * parseFloat(qtd.replace(',', '.'), 2);
                        $("#vtotal_servico").val(calculo.toFixed(2));

                    });
                });

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